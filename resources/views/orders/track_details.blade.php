@extends('layouts.layout')

@section('title')
    Order Tracking #{{ $order->id }}
@endsection

@section('content')
<div class="max-w-4xl mx-auto p-6 my-8 bg-surface rounded-lg border border-main-border shadow-xl">

    <div class="text-center mb-6 border-b border-main-border pb-4">
        <h1 class="text-3xl font-bengali font-bold text-brand-red">অর্ডার ট্র্যাকিং (Order #{{ $order->id }})</h1>
        <p class="text-text-secondary mt-2 font-bengali">আপনার অর্ডারের বর্তমান অবস্থা দেখুন।</p>
    </div>

    {{-- Order Summary and Customer Information (Simplified) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        {{-- Customer Info (Showing minimal secure info) --}}
        <div class="p-4 border border-brand-green/50 rounded-lg bg-bg">
            <h3 class="font-bengali text-lg font-semibold mb-2 text-brand-green">গ্রাহকের তথ্য</h3>
            <p class="text-sm text-text-primary">
                <span class="font-bold font-bengali">নাম:</span> {{ $order->customer_name }}
            </p>
            <p class="text-sm text-text-primary mt-2">
                <span class="font-bold font-bengali">মোবাইল:</span> {{ $order->phone }}
            </p>
            <p class="text-sm text-text-primary mt-2">
                <span class="font-bold font-bengali">ঠিকানা:</span> {{ $order->address }}
            </p>
        </div>

        {{-- Status and Date --}}
        <div class="p-4 border border-brand-green/50 rounded-lg bg-bg">
            <h3 class="font-bengali text-lg font-semibold mb-2 text-brand-green">স্ট্যাটাস ও সময়</h3>
            <p class="text-sm text-text-primary">
                <span class="font-bold font-bengali">অর্ডার তারিখ:</span> {{ $order->created_at->format('Y-m-d H:i A') }}
            </p>
            <p class="text-sm text-text-primary">
                <span class="font-bold font-bengali">পেমেন্ট:</span> {{ $order->payment_method }}
            </p>
            <div class="text-sm mt-3 p-2 bg-yellow-50 rounded-md border border-yellow-200">
                <span class="font-bold font-bengali block mb-1 text-surface">বর্তমান স্ট্যাটাস:</span>
                <span class="px-3 py-1 text-sm rounded-full font-bold 
                    @if($order->status == 'delivered' || $order->status == 'completed') bg-green-200 text-green-800
                    @elseif($order->status == 'cancelled') bg-red-200 text-red-800
                    @else bg-yellow-200 text-yellow-800
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="p-4 border border-brand-red rounded-lg bg-bg">
            <h3 class="font-bengali text-lg font-semibold mb-2 text-brand-red">মোট মূল্য</h3>
            <p class="text-sm flex justify-between text-text-primary">
                <span class="font-bengali">পণ্য মূল্য:</span>
                <span class="font-sans">৳{{ number_format($order->total_price, 0, '.', ',') }}</span>
            </p>
             <p class="text-sm flex justify-between text-text-primary">
                <span class="font-bengali">ডেলিভারি চার্জ:</span>
                <span class="font-sans">৳0</span> {{-- Assuming delivery charge is zero or included in total_price --}}
            </p>
            <p class="text-lg flex justify-between border-t border-brand-red mt-2 pt-2 font-bold text-brand-red">
                <span class="font-bengali">মোট পরিশোধ:</span>
                <span class="font-sans">৳{{ number_format($order->total_price, 0, '.', ',') }}</span>
            </p>
        </div>
    </div>

    <hr class="my-6 border-main-border border-dashed">

    {{-- Order Items Table --}}
    <h2 class="font-bengali text-2xl font-bold mb-4 text-brand-green">পণ্য তালিকা</h2>

    <div class="overflow-x-auto border border-main-border rounded-lg shadow-inner">
        <table class="min-w-full divide-y divide-main-border">
            <thead>
                <tr class="bg-bg/80">
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">পণ্য (Product/Variant)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">দাম (Unit Price)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">পরিমাণ (Quantity)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">মোট (Subtotal)</th>
                </tr>
            </thead>
            <tbody class="bg-surface divide-y divide-main-border">
                @foreach ($order->items as $item)
                <tr class="hover:bg-bg transition duration-150">
                    <td class="px-6 py-4 text-sm font-medium font-bengali text-text-primary">
                        {{ $item->product_name }}
                        <span class="text-xs text-gray-500 block font-sans">
                            SKU: {{ $item->productVariant->sku ?? 'N/A' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary font-sans">
                        ৳{{ number_format($item->price, 0, '.', ',') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary font-sans">
                        x {{ $item->quantity }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-brand-red font-sans font-bold">
                        ৳{{ number_format($item->price * $item->quantity, 0, '.', ',') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center mt-6">
        <a href="{{ route('order.track') }}" class="text-sm text-brand-red hover:text-brand-orange font-bengali font-medium underline">
            &larr; নতুন করে অর্ডার ট্র্যাক করুন
        </a>
    </div>

</div>
@endsection
