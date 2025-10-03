@extends('layouts.dashboard')

@section('title', 'All Products')

@section('content')
<div class="p-6 bg-surface rounded-sm border border-main-border shadow-md">

    {{-- Display Success/Error Messages (from store/update/destroy redirects) --}}
    @if (session('success'))
    <div class="bg-brand-green/20 text-brand-green p-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="bg-brand-red/20 text-brand-red p-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-text-primary">Products List</h1>

        <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-brand-red hover:bg-red-700 transition duration-300">
            <x-heroicon-o-plus class="w-5 h-5 mr-2 -ml-1" />
            Create New Product
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-main-border">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Product Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 text-text-secondary">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-surface divide-y divide-main-border">
                @forelse ($products as $product)
                <tr class="hover:bg-bg transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium font-bengali text-text-primary">{{ $product->product_name }}</td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary">
                        @if ($product->variants->isNotEmpty())
                        ${{ number_format($product->variants->first()->regular_price, 2) }}
                        @else
                        ${{ number_format($product->regular_price, 2) }}
                        @endif
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary">
                        @if ($product->variants->isNotEmpty())
                        {{ $product->variants->sum('stock') }}
                        @else
                        {{ $product->stock }}
                        @endif
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-3">
                        <a href="{{ route('products.edit', $product) }}" class="text-brand-red hover:text-red-700">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-text-secondary">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination Links --}}
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection