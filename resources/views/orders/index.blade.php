@extends('layouts.dashboard')

@section('title', 'All Orders')

@section('content')
<div class="p-6 bg-surface rounded-sm border border-main-border shadow-md">

    {{-- Display Success/Error Messages --}}
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
        <h1 class="text-3xl font-semibold text-text-primary">Orders List</h1>
        {{-- No Create button needed here, as customers create orders --}}
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-main-border">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Order ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Customer Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Order Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-text-secondary">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-surface divide-y divide-main-border">
                @forelse ($orders as $order)
                <tr class="hover:bg-bg transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-text-primary">#{{ $order->id }}</td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary font-bengali">{{ $order->customer_name }}</td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary">
                        ৳{{ number_format($order->total_price, 0, '.', ',') }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary">
                        {{ $order->created_at->format('Y-m-d H:i') }}
                    </td>

                    {{-- STATUS DROPDOWN --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary">
                        <form action="{{ route('orders.update', $order) }}" method="POST" id="status-form-{{ $order->id }}">
                            @csrf
                            @method('PUT')
                            <select name="status" 
                                class="border-main-border rounded-md text-sm py-1 px-2 focus:ring-brand-red focus:border-brand-red"
                                onchange="document.getElementById('status-form-{{ $order->id }}').submit()">
                                
                                @php
                                    // Define your available statuses
                                    $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
                                @endphp

                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('orders.show', $order) }}" class="text-brand-red hover:text-red-700">View Details</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-text-secondary">No orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination Links --}}
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection