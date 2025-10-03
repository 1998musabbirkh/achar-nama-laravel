<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        try {
            $products = Product::with(['images', 'variants'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('products.index', compact('products'));
        } catch (\Exception $e) {
            Log::error("Failed to fetch products: " . $e->getMessage());
            return redirect()->back()->with('error', 'Could not load products.');
        }
    }

    /**
     * Show the create product form.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a new product with images and variants.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name'            => 'required|string|max:255',
            'title'                   => 'required|string|max:255',
            'subtitle'                => 'required|string|max:255',
            'primary_description'     => 'required|string',
            'sub_description'         => 'required|string|max:500',
            // --- UPDATED IMAGE VALIDATION ---
            'primary_image_file'      => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'gallery_images'          => 'nullable|array|max:4', // 1 main + max 4 gallery = max 5 total
            'gallery_images.*'        => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            // --------------------------------
            'variant_name.*'          => 'required|string|max:255',
            'variant_regular_price.*' => 'required|numeric|min:0',
            'variant_sell_price.*'    => 'nullable|numeric|min:0',
            'variant_stock.*'         => 'required|integer|min:0',
        ]);

        $storedImagePaths = [];

        DB::beginTransaction();

        try {
            $product = Product::create([
                'product_name'        => $validatedData['product_name'],
                'title'               => $validatedData['title'],
                'subtitle'            => $validatedData['subtitle'],
                'primary_description' => $validatedData['primary_description'],
                'sub_description'     => $validatedData['sub_description'],
            ]);

            $sortOrder = 0;

            // 1. Store Primary Image (Guaranteed sort_order = 0)
            $primaryImageFile = $request->file('primary_image_file');
            $path = $primaryImageFile->store('products/gallery', 'public');
            $storedImagePaths[] = $path;

            ProductImage::create([
                'product_id' => $product->id,
                'path'       => $path,
                'sort_order' => $sortOrder++, // 0
            ]);

            // 2. Store Gallery Images (sort_order starts at 1)
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $imageFile) {
                    $path = $imageFile->store('products/gallery', 'public');
                    $storedImagePaths[] = $path;

                    ProductImage::create([
                        'product_id' => $product->id,
                        'path'       => $path,
                        'sort_order' => $sortOrder++,
                    ]);
                }
            }

            // 3. Store Variants
            $variantCount = count($validatedData['variant_name']);
            for ($i = 0; $i < $variantCount; $i++) {
                ProductVariant::create([
                    'product_id'    => $product->id,
                    'variant_name'  => $validatedData['variant_name'][$i],
                    'regular_price' => $validatedData['variant_regular_price'][$i],
                    'sell_price'    => $validatedData['variant_sell_price'][$i] ?? null,
                    'stock'         => $validatedData['variant_stock'][$i],
                ]);
            }

            DB::commit();

            return redirect()->route('products.index')
                ->with('success', 'Product "' . $product->title . '" created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            foreach ($storedImagePaths as $path) {
                Storage::disk('public')->delete($path);
            }

            Log::error("Product store failed: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Failed to create product. Check logs.')->withInput();
        }
    }

    /**
     * Show a single product.
     */
    public function show(string $id)
    {
        $product = Product::with(['images', 'variants'])->findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the edit form.
     */
    public function edit(string $id)
    {
        $product = Product::with(['images', 'variants'])->findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'product_name'      => 'required|string|max:255',
            'title'             => 'required|string|max:255',
            'subtitle'          => 'required|string|max:255',
            'primary_description' => 'required|string',
            'sub_description'   => 'required|string|max:500',
            'images'            => 'nullable|array|max:5',
            'images.*'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'delete_images'     => 'nullable|array',
            'delete_images.*'   => 'exists:product_images,id',
            'variants'          => 'required|array|min:1',
            'variants.*.id'     => 'nullable|integer|exists:product_variants,id',
            'variants.*.variant_name' => 'required|string|max:255',
            'variants.*.regular_price' => 'required|numeric|min:0',
            'variants.*.sell_price'    => 'nullable|numeric|min:0',
            'variants.*.stock'         => 'required|integer|min:0',
            'deleted_variant_ids'      => 'nullable|array',
            'deleted_variant_ids.*'    => 'exists:product_variants,id',
        ]);

        $newImagePaths = [];

        DB::beginTransaction();

        try {
            $product = Product::findOrFail($id);

            $product->update([
                'product_name'        => $validatedData['product_name'],
                'title'               => $validatedData['title'],
                'subtitle'            => $validatedData['subtitle'],
                'primary_description' => $validatedData['primary_description'],
                'sub_description'     => $validatedData['sub_description'],
            ]);

            if (!empty($validatedData['deleted_variant_ids'])) {
                $product->variants()->whereIn('id', $validatedData['deleted_variant_ids'])->delete();
            }

            foreach ($validatedData['variants'] as $variant) {
                if (!empty($variant['id'])) {
                    $product->variants()->where('id', $variant['id'])->update([
                        'variant_name'  => $variant['variant_name'],
                        'regular_price' => $variant['regular_price'],
                        'sell_price'    => $variant['sell_price'] ?? null,
                        'stock'         => $variant['stock'],
                    ]);
                } else {
                    $product->variants()->create([
                        'variant_name'  => $variant['variant_name'],
                        'regular_price' => $variant['regular_price'],
                        'sell_price'    => $variant['sell_price'] ?? null,
                        'stock'         => $variant['stock'],
                    ]);
                }
            }

            if (!empty($validatedData['delete_images'])) {
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
                foreach ($request->file('images') as $imageFile) {
                    $path = $imageFile->store('products/gallery', 'public');
                    $newImagePaths[] = $path;

                    ProductImage::create([
                        'product_id' => $product->id,
                        'path'       => $path,
                        'sort_order' => ++$nextSortOrder,
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

            Log::error("Product update failed for ID {$id}: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Failed to update product. Check logs.')->withInput();
        }
    }

    /**
     * Delete product and all associated images/variants.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $title = $product->title;

            foreach ($product->images as $image) {
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