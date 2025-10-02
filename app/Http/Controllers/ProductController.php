<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::orderBy('created_at', 'desc')->paginate(10);
            return view('products.index', compact('products'));
        } catch (\Exception $e) {
            Log::error("Failed to fetch: " . $e->getMessage());
            return redirect()->back()->with('error', 'could not load product');
        }
    }

    /**
     * Show the form for creating a new product. (C in CRUD)
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'short_description' => 'required|string|max:500',
            'image'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'regular_price'     => 'required|numeric|min:0',
            'sell_price'        => 'nullable|numeric|min:0',
            'stock'             => 'required|integer|min:0',
        ]);

        $imagePath = null;
        try {

            $imagePath = $request->file('image')->store('products/main', 'public');

            $validatedData['image'] = $imagePath;

            Product::create($validatedData);

            return redirect()->route('products.index')->with('success', 'Product "' . $validatedData['title'] . '" created successfully!');
        } catch (\Exception $e) {
            // If creation fails, clean up the file we just uploaded
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            Log::error("Product creation failed: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create product. Please try again.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'short_description' => 'required|string|max:500',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'regular_price'     => 'required|numeric|min:0',
            'sell_price'        => 'nullable|numeric|min:0',
            'stock'             => 'required|integer|min:0',
        ]);

        $newImagePath = null;
        $oldImagePath = null;
        try {
            $product = Product::findOrFail($id);
            $updateData = $validatedData;

            if ($request->hasFile('image')) {
                $oldImagePath = $product->image;

                $newImagePath = $request->file('image')->store('products/main', 'public');
                $updateData['image'] = $newImagePath;
            } else {
                unset($updateData['image']);
            }

            $product->update($updateData);

            if ($newImagePath && $oldImagePath) {
                Storage::disk('public')->delete($oldImagePath);
            }

            return redirect()->route('products.index')
                ->with('success', 'Product "' . $product->title . '" updated successfully!');
        } catch (\Exception $e) {
            if ($newImagePath) {
                Storage::disk('public')->delete($newImagePath);
            }
            Log::error("Product update failed for ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update product. Please try again.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $title = $product->title;

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();

            return redirect()->route('products.index')
                ->with('success', 'Product "' . $title . '" deleted successfully!');
        } catch (\Exception $e) {
            Log::error("Product deletion failed for ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete product.');
        }
    }
}
