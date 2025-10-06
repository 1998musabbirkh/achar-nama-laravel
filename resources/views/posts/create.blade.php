@extends('layouts.dashboard')

@section('title', 'Create Blog Post')

@section('content')
<div class="p-6 bg-surface rounded-sm shadow-md border border-main-border">
    <h1 class="text-3xl font-semibold text-text-primary mb-6">Create New Blog Post</h1>

    <a href="{{ route('admin.posts.index') }}" class="text-brand-red hover:text-red-700 flex items-center mb-4">
        <x-heroicon-o-arrow-left class="w-4 h-4 mr-1" /> Back to Posts
    </a>

    {{-- Error/Success Display (Standard Laravel practice) --}}
    @if ($errors->any())
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.posts.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf

        <h2 class="text-xl font-semibold text-text-primary border-b pb-2 mb-4">Post Details</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-text-secondary">Title (Bengali or English)</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
            </div>

            {{-- Slug (Manual Input) --}}
            <div>
                <label for="slug" class="block text-sm font-medium text-text-secondary">URL Slug (English Only)</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required
                    class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">
                <p class="mt-1 text-xs text-text-tertiary">Must be unique and URL-safe (e.g., `my-post-title`).</p>
            </div>
        </div>

        {{-- Featured Image Upload --}}
        <div>
            <label for="image" class="block text-sm font-medium text-text-secondary">Featured Image</label>
            <input type="file" name="image" id="image" required accept="image/*"
                class="mt-1 block w-full text-sm text-text-primary border border-main-border rounded-md p-1.5 cursor-pointer focus:outline-none">
        </div>

        {{-- Body (Raw HTML Content) --}}
        <div>
            <label for="body" class="block text-sm font-medium text-text-secondary">Body (Raw HTML Content)</label>
            <textarea name="body" id="body" rows="15" required
                class="mt-1 block w-full border border-main-border bg-bg text-text-primary rounded-md shadow-sm p-2 focus:border-brand-red focus:ring-brand-red">{{ old('body') }}</textarea>
            <p class="mt-1 text-xs text-text-tertiary">Enter your content using semantic HTML tags (`
            <h2>`, `<p>`, `
                <ul>`, `<a>`, etc.).</p>
        </div>

        <h2 class="text-xl font-semibold text-text-primary border-b pb-2 mb-4">Publishing</h2>

        {{-- Publishing Status Checkbox --}}
        <div class="flex items-center">
            <input type="checkbox" name="is_published" id="is_published" value="1"
                class="h-4 w-4 text-brand-red border-main-border rounded focus:ring-brand-red"
                {{ old('is_published') ? 'checked' : '' }}>
            <label for="is_published" class="ml-2 block text-sm font-medium text-text-secondary">
                Publish Immediately (set as Live)
            </label>
        </div>

        <div class="pt-6">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-green hover:bg-green-700 transition duration-300">
                Save Post
            </button>
        </div>
    </form>
</div>
@endsection