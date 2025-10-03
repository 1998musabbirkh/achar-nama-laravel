<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::with('images')->orderBy('created_at', 'desc')->paginate(10);
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
            'images'            => 'required|array|max:5',
            'images.*'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'regular_price'     => 'required|numeric|min:0',
            'sell_price'        => 'nullable|numeric|min:0',
            'stock'             => 'required|integer|min:0',
        ]);

        $productData = $request->except('images');
        $storedImagePaths = [];

        DB::beginTransaction();

        try {

            $product = Product::create($productData);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $imageFile) {
                    $imagePath = $imageFile->store('products/gallery', 'public');
                    $storedImagePaths[] = $imagePath;

                    ProductImage::create([
                        'product_id' => $product->id,
                        'path'       => $imagePath,
                        'sort_order' => $index,
                    ]);
                }
            }
            DB::commit();

            return redirect()->route('products.index')->with('success', 'Product "' . $product->title . '" created successfully with images!');
        } catch (\Exception $e) {
            DB::rollBack();

            foreach ($storedImagePaths as $path) {
                Storage::disk('public')->delete($path);
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
        $product = Product::with('images')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('images')->findOrFail($id);
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

            'images'            => 'nullable|array|max:5', // New images are optional
            'images.*'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'delete_images'     => 'nullable|array', // Optional array of image IDs to delete
            'delete_images.*'   => 'exists:product_images,id',

            'regular_price'     => 'required|numeric|min:0',
            'sell_price'        => 'nullable|numeric|min:0',
            'stock'             => 'required|integer|min:0',
        ]);

        $newImagePaths = []; // Track new paths for cleanup

        DB::beginTransaction();

        try {
            $product = Product::findOrFail($id);

            $productData = $request->except(['images', 'delete_images']);


            $product->update($productData);


            if ($request->has('delete_images') && is_array($validatedData['delete_images'])) {

                $imagesToDelete = ProductImage::whereIn('id', $validatedData['delete_images'])
                    ->where('product_id', $product->id)
                    ->get();

                foreach ($imagesToDelete as $image) {
                    Storage::disk('public')->delete($image->path);
                    $image->delete();
                }
            }


            if ($request->hasFile('images')) {

                $nextSortOrder = $product->images()->max('sort_order') ?? 0;
                $nextSortOrder++;

                foreach ($request->file('images') as $imageFile) {
                    $imagePath = $imageFile->store('products/gallery', 'public');
                    $newImagePaths[] = $imagePath;

                    ProductImage::create([
                        'product_id' => $product->id,
                        'path'       => $imagePath,
                        'sort_order' => $nextSortOrder++,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('products.index')
                ->with('success', 'Product "' . $product->title . '" updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();


            foreach ($newImagePaths as $path) {
                Storage::disk('public')->delete($path);
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

            $productImages = $product->images;

            foreach ($productImages as $image) {
                Storage::disk('public')->delete($image->path);
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
