@extends('layouts.layout')

@section('title')
    অর্ডার সফল! (Order #{{ $order->id }})
@endsection

@section('content')
<div class="max-w-4xl mx-auto p-6 my-8 bg-surface rounded-sm border border-main-border shadow-2xl">

    {{-- Success Header --}}
    <div class="text-center mb-8 border-b border-brand-green/50 pb-6">
        {{-- Success Icon (Using an SVG for a clean look) --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-16 mx-auto text-brand-green">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15c.6.6 1.5.6 2.1 0l4.5-4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>

        <h1 class="text-4xl font-bengali font-bold text-brand-red mt-3">ধন্যবাদ! আপনার অর্ডার সফল হয়েছে।</h1>
        <p class="text-text-secondary mt-2 font-bengali text-lg">অর্ডার নম্বর: <span class="text-brand-green font-sans font-bold">#{{ $order->id }}</span></p>
        <p class="text-sm text-text-secondary font-bengali mt-1">আমরা দ্রুত আপনার পণ্য পাঠানোর ব্যবস্থা করছি।</p>
    </div>

    {{-- Order Summary and Customer Information (Mirroring the Tracking Page Structure) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        {{-- Customer Info --}}
        <div class="p-4 border border-brand-green/50 rounded-sm bg-bg">
            <h3 class="font-bengali text-lg font-semibold mb-2 text-brand-green">গ্রাহকের তথ্য</h3>
            <p class="text-sm text-text-primary">
                <span class="font-bold font-bengali">নাম:</span> {{ $order->customer_name }}
            </p>
            <p class="text-sm text-text-primary mt-2">
                <span class="font-bold font-bengali">মোবাইল:</span> {{ $order->phone }}
            </p>
            <p class="text-sm text-text-primary mt-2">
                <span class="font-bold font-bengali">ডেলিভারি ঠিকানা:</span> {{ $order->address }}
            </p>
        </div>

        {{-- Status and Date --}}
        <div class="p-4 border border-brand-green/50 rounded-sm bg-bg">
            <h3 class="font-bengali text-lg font-semibold mb-2 text-brand-green">সময় ও পেমেন্ট</h3>
            <p class="text-sm text-text-primary">
                <span class="font-bold font-bengali">অর্ডার তারিখ:</span> {{ $order->created_at->format('Y-m-d H:i A') }}
            </p>
            <p class="text-sm text-text-primary mt-2">
                <span class="font-bold font-bengali">পেমেন্ট মাধ্যম:</span> <span class="font-semibold text-brand-red">{{ $order->payment_method }}</span>
            </p>
            <div class="text-sm mt-3 p-2 bg-brand-green/20 rounded-sm border border-brand-green/50">
                <span class="font-bold font-bengali text-text-primary">বর্তমান স্ট্যাটাস:</span>
                <span class="px-3 py-1 text-sm rounded-full font-bold bg-brand-green text-surface/90">
                    {{ ucfirst($order->status) ?? 'Pending' }}
                </span>
            </div>
        </div>

        {{-- Final Price Summary --}}
        <div class="p-4 border border-brand-red rounded-sm bg-bg">
            <h3 class="font-bengali text-lg font-semibold mb-2 text-brand-red">মোট পরিশোধ</h3>
            <p class="text-sm flex justify-between text-text-primary">
                <span class="font-bengali">পণ্য মূল্য:</span>
                <span class="font-sans">৳{{ number_format($order->total_price, 0, '.', ',') }}</span>
            </p>
             <p class="text-sm flex justify-between text-text-primary">
                <span class="font-bengali">ডেলিভারি চার্জ:</span>
                <span class="font-sans text-brand-green font-semibold">ফ্রি</span>
            </p>
            <p class="text-lg flex justify-between border-t border-brand-red mt-2 pt-2 font-bold text-brand-red">
                <span class="font-bengali">সর্বমোট:</span>
                <span class="font-sans">৳{{ number_format($order->total_price, 0, '.', ',') }}</span>
            </p>
        </div>
    </div>

    <hr class="my-6 border-main-border border-dashed">

    {{-- Order Items Table --}}
    <h2 class="font-bengali text-2xl font-bold mb-4 text-brand-green">অর্ডারকৃত পণ্য</h2>

    <div class="overflow-x-auto border border-main-border rounded-sm shadow-inner">
        <table class="min-w-full divide-y divide-main-border">
            <thead>
                <tr class="bg-bg/80">
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">পণ্য (Product/Variant)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">দাম (Price)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">পরিমাণ (Qty)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">মোট (Subtotal)</th>
                </tr>
            </thead>
            <tbody class="bg-surface divide-y divide-main-border">
                @foreach ($order->items as $item)
                <tr class="hover:bg-bg transition duration-150">
                    <td class="px-6 py-4 text-sm font-medium font-bengali text-text-primary">
                        {{ $item->product_name }}
                        <span class="text-xs text-gray-500 block font-sans">
                            {{ $item->productVariant->variant_name ?? 'N/A' }}
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

    {{-- Action Buttons --}}
    <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
        {{-- Back to Home/Shop --}}
        <a href="{{ url('/') }}" class="w-full sm:w-auto px-6 py-2 text-center bg-brand-green hover:bg-opacity-90 transition-colors duration-300 text-text-primary font-bengali text-lg rounded-sm font-semibold">
            শপিং চালিয়ে যান
        </a>
    </div>

</div>
@endsection