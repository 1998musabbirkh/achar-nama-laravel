@extends('layouts.dashboard')

@section('title', 'Blog Posts List')

@section('content')
<div class="p-6 bg-surface rounded-sm shadow-md border border-main-border">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-text-primary">Blog Posts</h1>
        <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-brand-red hover:bg-red-700 transition duration-300">
            <x-heroicon-o-plus class="w-4 h-4 mr-1" /> Create New Post
        </a>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-main-border">
            <thead class="bg-bg-light">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Title</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Author</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Published Date</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-text-secondary uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-main-border">
                @forelse ($posts as $post)
                    <tr class="hover:bg-bg-light transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-text-primary">{{ $post->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $post->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $post->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary">{{ $post->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary">
                            {{ $post->published_at ? $post->published_at->format('M d, Y') : 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-brand-red hover:text-red-700 mr-3">Edit</a>

                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-text-secondary">
                            No blog posts found. Start by creating one!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination Links --}}
    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection