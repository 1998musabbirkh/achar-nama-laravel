@extends('layouts.dashboard')

@section('title', 'Order Details #{{ $order->id }}')

@section('content')
<div class="p-6 bg-surface rounded-sm border border-main-border shadow-md">

    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h1 class="text-3xl font-semibold text-text-primary">Order #{{ $order->id }} Details</h1>
        <a href="{{ route('orders.index') }}" class="text-sm text-text-secondary hover:text-brand-red">
            &larr; All Orders List
        </a>
    </div>

    {{-- Order Summary and Customer Information --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        {{-- Customer Info --}}
        <div class="p-4 border rounded-sm bg-bg">
            <h3 class="font-bengali text-lg font-semibold mb-2 text-brand-green">গ্রাহকের তথ্য</h3>
            <p class="text-sm text-text-primary">
                <span class="font-bold font-bengali ">নাম:</span> {{ $order->customer_name }}
            </p>
            <p class="text-sm text-text-primary">
                <span class="font-bold font-bengali ">মোবাইল:</span> {{ $order->phone }}
            </p>
            <p class="text-sm text-text-primary mt-2">
                <span class="font-bold font-bengali">ঠিকানা:</span> {{ $order->address }}
            </p>
        </div>

        {{-- Status and Date --}}
        <div class="p-4 border rounded-sm bg-bg">
            <h3 class="font-bengali text-lg font-semibold mb-2 text-brand-green">স্ট্যাটাস ও সময়</h3>
            <p class="text-sm text-text-primary">
                <span class="font-bold font-bengali">অর্ডার তারিখ:</span> {{ $order->created_at->format('Y-m-d H:i A') }}
            </p>
            <p class="text-sm text-text-primary">
                <span class="font-bold font-bengali">পেমেন্ট:</span> {{ $order->payment_method }}
            </p>
            <p class="text-sm mt-2">
                <span class="font-bold font-bengali text-text-primary">বর্তমান স্ট্যাটাস:</span>
                <span class="px-2 py-0.5 text-xs rounded-full font-semibold 
                    @if($order->status == 'delivered') bg-green-200 text-green-800
                    @elseif($order->status == 'cancelled') bg-red-200 text-red-800
                    @else bg-yellow-200 text-yellow-800
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
        </div>

        {{-- Order Summary --}}
        <div class="p-4 border border-brand-red rounded-sm bg-bg">
            <h3 class="font-bengali text-lg font-semibold mb-2 text-brand-red">মোট মূল্য</h3>
            <p class="text-sm flex justify-between">
                <span class="text-text-primary">সাবটোটাল:</span>
                <span class="font-sans text-text-primary">৳{{ number_format($order->total_price, 0, '.', ',') }}</span>
            </p>
            <p class="text-sm flex justify-between border-t mt-2 pt-2 font-bold text-lg text-brand-red">
                <span>মোট:</span>
                <span class="font-sans">৳{{ number_format($order->total_price, 0, '.', ',') }}</span>
            </p>
        </div>
    </div>

    <div class="border-t pt-4">
        {{-- Status Update Dropdown (Copied from index for easy access) --}}
        <h3 class="font-bengali text-xl font-semibold mb-2 text-brand-green">স্ট্যাটাস আপডেট করুন</h3>
        <form action="{{ route('orders.update', $order) }}" method="POST" class="inline-block">
            @csrf
            @method('PUT')
            <select name="status"
                class="border-main-border text-text-primary bg-bg rounded-md text-base py-1 px-3 focus:ring-brand-red focus:border-brand-red"
                onchange="this.form.submit()">

                @php
                $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
                @endphp

                @foreach ($statuses as $status)
                <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
                @endforeach
            </select>
        </form>
    </div>

    <hr class="my-6 border-main-border border-dashed">

    {{-- Order Items Table --}}
    <h2 class="font-bengali text-2xl font-semibold mb-4 text-brand-green">পণ্য তালিকা</h2>

    <div class="overflow-x-auto border rounded-sm">
        <table class="min-w-full divide-y divide-main-border">
            <thead>
                <tr class="bg-bg">
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Product Name (Variant)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Unit Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Quantity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Subtotal</th>
                </tr>
            </thead>
            <tbody class="bg-surface divide-y divide-main-border">
                @foreach ($order->items as $item)
                <tr class="hover:bg-bg transition duration-150">
                    <td class="px-6 py-4 text-sm font-medium font-bengali text-text-primary">
                        {{ $item->product_name }}
                        <span class="text-xs text-gray-500 block">
                            SKU: {{ $item->productVariant->sku ?? 'N/A' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary font-sans">
                        ৳{{ number_format($item->price, 0, '.', ',') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary font-sans">
                        x {{ $item->quantity }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary font-sans font-bold">
                        ৳{{ number_format($item->price * $item->quantity, 0, '.', ',') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection