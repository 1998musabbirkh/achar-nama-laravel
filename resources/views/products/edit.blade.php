@extends('layouts.dashboard')

@section('title', 'Edit Product: ' . $product->title)

@section('content')
<div class="p-6 bg-surface rounded-sm shadow-md border border-main-border">
    <h1 class="text-3xl font-semibold text-text-primary mb-6">Edit Product: {{ $product->title }}</h1>

    <a href="{{ route('products.index') }}" class="text-brand-red hover:text-red-700 flex items-center mb-4">
        <x-heroicon-o-arrow-left class="w-4 h-4 mr-1" /> Back to Products
    </a>

    <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-6" enctype="multipart/form-data" id="edit-product-form" data-existing-images="{{ $product->images->count() }}">
        @csrf
        @method('PATCH')

        <h2 class="text-xl font-semibold text-text-primary border-b pb-2 mb-4">Basic Details</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="product_name" class="block text-sm font-medium text-text-secondary">Product Name</label>
                <input type="text" name="product_name" id="product_name" required
                    class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red"
                    value="{{ old('product_name', $product->product_name) }}">
            </div>
            <div>
                <label for="title" class="block text-sm font-medium text-text-secondary">SEO Title</label>
                <input type="text" name="title" id="title" required
                    class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red"
                    value="{{ old('title', $product->title) }}">
            </div>
            <div>
                <label for="subtitle" class="block text-sm font-medium text-text-secondary">Subtitle</label>
                <input type="text" name="subtitle" id="subtitle" required
                    class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red"
                    value="{{ old('subtitle', $product->subtitle) }}">
            </div>
        </div>

        <div>
            <label for="primary_description" class="block text-sm font-medium text-text-secondary">Primary Description</label>
            <textarea name="primary_description" id="primary_description" rows="4" required
                class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">{{ old('primary_description', $product->primary_description) }}</textarea>
        </div>

        <div>
            <label for="sub_description" class="block text-sm font-medium text-text-secondary">Sub Description</label>
            <textarea name="sub_description" id="sub_description" rows="2" required
                class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">{{ old('sub_description', $product->sub_description) }}</textarea>
        </div>

        <h2 class="text-xl font-semibold text-text-primary border-b pb-2 mb-4">Product Images</h2>

        <div class="space-y-4">
            <label class="block text-sm font-medium text-text-secondary">Current Images</label>

            @if ($product->images->isEmpty())
            <p class="text-xs text-text-secondary">No images currently uploaded for this product.</p>
            @else
            <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-4">
                @foreach ($product->images as $image)
                <div>
                    <div class="relative border border-main-border p-1 rounded-md group">
                        <img src="{{ asset('storage/' . $image->path) }}" alt="Product Image"
                            class="w-full h-20 object-cover rounded-sm">

                        <label class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer rounded-sm">
                            <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="form-checkbox h-5 w-5 text-brand-red bg-bg border-main-border focus:ring-brand-red">
                            <span class="ml-2 text-white text-xs font-semibold">Delete</span>
                        </label>
                    </div>
                </div>
                @endforeach
            </div>

            <p class="text-xs text-text-secondary mt-2">
                Hover and check 'Delete' on an image to remove it when updating the product.
            </p>
            @endif
        </div>


        <div>
            <label for="images" class="block text-sm font-medium text-text-secondary">Add New Product Images (Max 5 total)</label>
            <input type="file" name="images[]" id="images" multiple
                class="mt-1 block w-full text-sm text-text-primary border border-main-border rounded-md p-1.5 cursor-pointer focus:outline-none">
            <p class="text-xs text-text-secondary mt-1">Select one or more new images to add to the gallery.</p>
        </div>

        <h2 class="text-xl font-semibold text-text-primary border-b pb-2 mb-4">Variants (Price & Stock)</h2>

        <div id="variants-container" class="space-y-4">
            @foreach ($product->variants as $index => $variant)
            <div class="variant-row p-4 border border-main-border rounded-md bg-bg-light relative" data-id="{{ $variant->id }}">
                <button type="button" class="remove-variant-btn absolute top-2 right-2 text-red-500 hover:text-red-700" title="Remove Variant">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 10-2 0v6a1 1 0 102 0V8z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 pr-10">
                    <div>
                        <label>Variant Name</label>
                        <input type="text" name="variants[{{ $index }}][variant_name]" value="{{ old('variants.'.$index.'.variant_name', $variant->variant_name) }}" required class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
                        <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant->id }}">
                    </div>
                    <div>
                        <label>Regular Price ($)</label>
                        <input type="number" step="0.01" name="variants[{{ $index }}][regular_price]" value="{{ old('variants.'.$index.'.regular_price', $variant->regular_price) }}" required class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
                    </div>
                    <div>
                        <label>Selling Price</label>
                        <input type="number" step="0.01" name="variants[{{ $index }}][sell_price]" value="{{ old('variants.'.$index.'.sell_price', $variant->sell_price) }}" class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
                    </div>
                    <div>
                        <label>Stock Quantity</label>
                        <input type="number" name="variants[{{ $index }}][stock]" value="{{ old('variants.'.$index.'.stock', $variant->stock) }}" required class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" id="add-variant-btn" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-brand-red hover:bg-red-700 transition duration-300">
            <x-heroicon-o-plus class="w-4 h-4 mr-1" /> Add Variant
        </button>

        <div class="pt-6">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-green hover:bg-green-700 transition duration-300">
                Update Product
            </button>
        </div>
    </form>
</div>

<template id="variant-template">
    <div class="variant-row p-4 border border-main-border rounded-md bg-bg-light relative">
        <button type="button" class="remove-variant-btn absolute top-2 right-2 text-red-500 hover:text-red-700" title="Remove Variant">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 10-2 0v6a1 1 0 102 0V8z" clip-rule="evenodd" />
            </svg>
        </button>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 pr-10">
            <div>
                <label>Variant Name</label>
                <input type="text" name="variant_name[]" required class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
            </div>
            <div>
                <label>Regular Price ($)</label>
                <input type="number" step="0.01" name="variant_regular_price[]" required class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
            </div>
            <div>
                <label>Selling Price</label>
                <input type="number" step="0.01" name="variant_sell_price[]" class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
            </div>
            <div>
                <label>Stock Quantity</label>
                <input type="number" name="variant_stock[]" required class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
            </div>
        </div>
    </div>
</template>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const variantsContainer = document.getElementById('variants-container');
        const addVariantBtn = document.getElementById('add-variant-btn');
        const template = document.getElementById('variant-template');
        const imagesInput = document.getElementById('images');

        const existingImagesCount = parseInt(document.getElementById('edit-product-form').dataset.existingImages);
        let variantIndex = variantsContainer.querySelectorAll('.variant-row').length;

        function bindRemove(button) {
            if (!button) return;
            button.addEventListener('click', function() {
                if (variantsContainer.querySelectorAll('.variant-row').length <= 1) {
                    alert('At least one variant is required.');
                    return;
                }
                this.closest('.variant-row').remove();
            });
        }

        document.querySelectorAll('.remove-variant-btn').forEach(bindRemove);

        addVariantBtn.addEventListener('click', function() {
            const clone = template.content.cloneNode(true);

            clone.querySelectorAll('input').forEach(input => {
                if (input.name.includes('[]')) {
                    input.name = input.name.replace('[]', '[]');
                }
            });

            const removeBtn = clone.querySelector('.remove-variant-btn');
            bindRemove(removeBtn);
            variantsContainer.appendChild(clone);
            variantIndex++;
        });

        imagesInput.addEventListener('change', function() {
            const deleteCount = document.querySelectorAll('input[name="delete_images[]"]:checked').length;
            const currentTotal = existingImagesCount - deleteCount;

            if (this.files.length + currentTotal > 5) {
                alert('You can have a maximum of 5 images. Adding these files would result in ' + (this.files.length + currentTotal) + ' total images.');
                this.value = '';
            }
        });

        document.getElementById('edit-product-form').addEventListener('submit', function(e) {
            if (variantsContainer.querySelectorAll('.variant-row').length === 0) {
                e.preventDefault();
                alert('Please add at least one variant.');
            }
        });

        document.querySelectorAll('input[name="delete_images[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (imagesInput.files.length > 0) {
                    imagesInput.dispatchEvent(new Event('change'));
                }
            });
        });
    });
</script>
@endsection