@extends('layouts.layout')

@section('title', 'Home Page')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 md:px-0 mt-4 rounded-sm">
    <img src="{{ Vite::asset('resources/images/banner.webp') }}" alt="" class="rounded-sm">
</div>

<div class="max-w-[1200px] mx-auto px-4 md:p-0 mt-8">

    <h2 class="text-center font-semibold text-brand-red text-xl md:text-2xl lg:text-4xl font-sans mb-4 uppercase">Our Products</h2>

    @if (session('error'))
    <p class="text-center text-red-500 font-sans mb-4">{{ session('error') }}</p>
    @endif

    @if ($products->isEmpty())
    <p class="text-center text-text-secondary font-sans mt-8">No products are available at this time. Please check back later.</p>
    @else
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-2 md:gap-4">
        @foreach ($products as $product)
        <div class="p-3 sm:p-4 border border-main-border rounded-sm flex flex-col gap-2 md:gap4 text-center relative">

            {{-- Retrieve the primary image based on sort_order --}}
            @php
            // --- Price Aggregation and Discount Calculation ---

            // 1. Regular Prices
            $regularPrices = $product->variants
            ->map(fn($v) => $v->regular_price)
            ->filter(fn($p) => is_numeric($p));

            // 2. Selling Prices (if a sell_price exists, we know there's a deal)
            $sellingPricesOnly = $product->variants
            ->map(fn($v) => $v->sell_price)
            ->filter(fn($p) => is_numeric($p));

            $hasSellPrice = $sellingPricesOnly->isNotEmpty();

            // Calculate the discount percentage only if sell prices exist
            $discountPercent = 0;
            if ($hasSellPrice) {
            $minRegular = $regularPrices->min();
            $minSelling = $sellingPricesOnly->min();

            // Calculate percentage based on the difference between the cheapest regular and cheapest selling price
            if ($minRegular > 0 && $minSelling < $minRegular) {
                $discountPercent=round((($minRegular - $minSelling) / $minRegular) * 100);
                }
                }

                // 3. Format Display Strings
                $regularPriceDisplay='' ;
                if ($regularPrices->isNotEmpty()) {
                $minRegularFmt = number_format($regularPrices->min());
                $maxRegularFmt = number_format($regularPrices->max());
                $regularPriceDisplay = ($minRegularFmt === $maxRegularFmt) ? $minRegularFmt : $minRegularFmt . ' - ' . $maxRegularFmt;
                }

                $sellingPricesAll = $product->variants
                ->map(fn($v) => $v->sell_price ?? $v->regular_price)
                ->filter(fn($p) => is_numeric($p));

                $sellingPriceDisplay = 'No price set';
                if ($sellingPricesAll->isNotEmpty()) {
                $minSellingFmt = number_format($sellingPricesAll->min());
                $maxSellingFmt = number_format($sellingPricesAll->max());
                $sellingPriceDisplay = ($minSellingFmt === $maxSellingFmt) ? $minSellingFmt : $minSellingFmt . ' - ' . $maxSellingFmt;
                }

                $primaryImage = $product->images->sortBy('sort_order')->first();
                @endphp

                {{-- Discount Badge (Positioned absolutely) --}}
                @if ($discountPercent > 0)
                <div class="absolute top-0 right-0 bg-brand-red text-white text-xs font-bold px-2 py-1 rounded-bl-sm z-10">
                    -{{ $discountPercent }}%
                </div>
                @endif

                @if ($primaryImage)
                <img src="{{ asset('storage/' . $primaryImage->path) }}"
                    alt="{{ $product->product_name }}"
                    class="rounded-sm w-full h-auto object-cover aspect-square">
                @else
                <img src="https://via.placeholder.com/300?text=No+Image"
                    alt="{{ $product->product_name }}"
                    class="rounded-sm w-full h-auto object-cover aspect-square">
                @endif

                <div>
                    <h3 class="text-text-primary font-bengali text-sm md:text-base">{{ $product->product_name }}</h3>

                    <p class="font-bold font-sans flex flex-col items-center justify-center space-y-0.5">
                        @if ($hasSellPrice)
                        {{-- Display Regular Price with a strikethrough --}}
                        <span class="text-text-secondary text-[10px] md:text-sm line-through">
                            ৳{{ $regularPriceDisplay }}
                        </span>
                        {{-- Display the discounted Selling Price --}}
                        <span class="text-brand-red text-sm md:text-base">
                            ৳{{ $sellingPriceDisplay }}
                        </span>
                        @else
                        {{-- Only display the regular price if no sell price exists --}}
                        <span class="text-text-secondary text-[10px] md:text-sm">
                            ৳{{ $sellingPriceDisplay }}
                        </span>
                        @endif
                    </p>
                </div>
                <a href="{{ route('product.show', $product->id) }}"
                    class="text-text-primary bg-brand-red py-[6px] text-sm md:text-base font-bengali block w-full hover:bg-brand-orange transition-colors duration-300 rounded-sm">
                    অর্ডার করুন
                </a>
        </div>
        @endforeach
    </div>
    @endif

</div>
@endsection