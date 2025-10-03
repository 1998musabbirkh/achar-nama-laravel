@extends('layouts.dashboard')

@section('title', 'Create Product')

@section('content')
<div class="p-6 bg-surface rounded-sm shadow-md border border-main-border">
    <h1 class="text-3xl font-semibold text-text-primary mb-6">Create New Product</h1>

    <a href="{{ route('products.index') }}" class="text-brand-red hover:text-red-700 flex items-center mb-4">
        <x-heroicon-o-arrow-left class="w-4 h-4 mr-1" /> Back to Products
    </a>

    <form action="{{ route('products.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data" id="create-product-form">
        @csrf

        <h2 class="text-xl font-semibold text-text-primary border-b pb-2 mb-4">Basic Details</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="product_name" class="block text-sm font-medium text-text-secondary">Product Name</label>
                <input type="text" name="product_name" id="product_name" required
                    class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
            </div>
            <div>
                <label for="title" class="block text-sm font-medium text-text-secondary">SEO Title</label>
                <input type="text" name="title" id="title" required
                    class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
            </div>
            <div>
                <label for="subtitle" class="block text-sm font-medium text-text-secondary">Subtitle</label>
                <input type="text" name="subtitle" id="subtitle" required
                    class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
            </div>
        </div>

        <div>
            <label for="primary_description" class="block text-sm font-medium text-text-secondary">Primary Description</label>
            <textarea name="primary_description" id="primary_description" rows="4" required
                class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red"></textarea>
        </div>

        <div>
            <label for="sub_description" class="block text-sm font-medium text-text-secondary">Sub Description</label>
            <textarea name="sub_description" id="sub_description" rows="2" required
                class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red"></textarea>
        </div>

        <h2 class="text-xl font-semibold text-text-primary border-b pb-2 mb-4">Product Images</h2>

        {{-- MAIN IMAGE INPUT --}}
        <div>
            <label for="primary_image_file" class="block text-sm font-medium text-text-secondary">⭐ Main Product Image (Sets order 0)</label>
            <input type="file" name="primary_image_file" id="primary_image_file" required accept="image/*"
                class="mt-1 block w-full text-sm text-text-primary border border-main-border rounded-md p-1.5 cursor-pointer focus:outline-none">
        </div>

        {{-- GALLERY IMAGES INPUT --}}
        <div>
            <label for="gallery_images" class="block text-sm font-medium text-text-secondary">Gallery Images (Max 4)</label>
            <input type="file" name="gallery_images[]" id="gallery_images" multiple accept="image/*"
                class="mt-1 block w-full text-sm text-text-primary border border-main-border rounded-md p-1.5 cursor-pointer focus:outline-none">
        </div>

        <h2 class="text-xl font-semibold text-text-primary border-b pb-2 mb-4">Variants (Price & Stock)</h2>

        <div id="variants-container" class="space-y-4">
            <div class="variant-row p-4 border border-main-border rounded-md bg-bg-light relative" data-id="0">
                <button type="button" class="remove-variant-btn absolute top-2 right-2 text-red-500 hover:text-red-700" title="Remove Variant">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 10-2 0v6a1 1 0 102 0V8z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 pr-10">
                    <div>
                        <label class="block text-sm font-medium text-text-secondary">Variant Name</label>
                        <input type="text" name="variant_name[]" required placeholder="e.g. 500gm"
                            class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text-secondary">Regular Price ($)</label>
                        <input type="number" step="0.01" name="variant_regular_price[]" required placeholder="0.00"
                            class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text-secondary">Selling Price</label>
                        <input type="number" step="0.01" name="variant_sell_price[]" placeholder="0.00"
                            class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text-secondary">Stock Quantity</label>
                        <input type="number" name="variant_stock[]" required placeholder="0"
                            class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
                    </div>
                </div>
            </div>
        </div>

        <button type="button" id="add-variant-btn" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-brand-red hover:bg-red-700 transition duration-300">
            <x-heroicon-o-plus class="w-4 h-4 mr-1" /> Add Variant
        </button>

        <div class="pt-6">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-green hover:bg-green-700 transition duration-300">
                Save Product
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
                <label class="block text-sm font-medium text-text-secondary">Variant Name</label>
                <input type="text" name="variant_name[]" required placeholder="e.g. 500gm"
                    class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
            </div>
            <div>
                <label class="block text-sm font-medium text-text-secondary">Regular Price ($)</label>
                <input type="number" step="0.01" name="variant_regular_price[]" required placeholder="0.00"
                    class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
            </div>
            <div>
                <label class="block text-sm font-medium text-text-secondary">Selling Price</label>
                <input type="number" step="0.01" name="variant_sell_price[]" placeholder="0.00"
                    class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
            </div>
            <div>
                <label class="block text-sm font-medium text-text-secondary">Stock Quantity</label>
                <input type="number" name="variant_stock[]" required placeholder="0"
                    class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
            </div>
        </div>
    </div>
</template>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const variantsContainer = document.getElementById('variants-container');
        const addVariantBtn = document.getElementById('add-variant-btn');
        const template = document.getElementById('variant-template');
        const galleryImagesInput = document.getElementById('gallery_images');
        const primaryImageInput = document.getElementById('primary_image_file');

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
            const removeBtn = clone.querySelector('.remove-variant-btn');
            bindRemove(removeBtn);
            variantsContainer.appendChild(clone);
        });

        // Gallery image limit check
        galleryImagesInput.addEventListener('change', function() {
            if (this.files.length > 4) {
                alert('You can upload a maximum of 4 gallery images.');
                this.value = '';
            }
        });

        // Ensure primary image is selected if gallery images are present
        galleryImagesInput.addEventListener('change', function() {
            if (this.files.length > 0 && primaryImageInput.files.length === 0) {
                 // The 'required' attribute on primary_image_file handles the validation on submit, 
                 // but this provides a helpful warning.
            }
        });

        document.getElementById('create-product-form').addEventListener('submit', function(e) {
            if (variantsContainer.querySelectorAll('.variant-row').length === 0) {
                e.preventDefault();
                alert('Please add at least one variant.');
            }
        });
    });
</script>
@endsection