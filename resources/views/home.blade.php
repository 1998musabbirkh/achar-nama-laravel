@extends('layouts.layout')

@section('title', 'Home Page')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 md:px-0 mt-4 rounded-sm">
    <img src="{{ Vite::asset('resources/images/banner.webp') }}" alt="" class="rounded-sm">
</div>

{{-- ------------------------------------------------------------------------------------------------------ --}}
{{-- OUR PRODUCTS SECTION (Existing Code) --}}
{{-- ------------------------------------------------------------------------------------------------------ --}}
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

            @php
            // --- Price Aggregation and Discount Calculation ---
            $regularPrices = $product->variants
            ->map(fn($v) => $v->regular_price)
            ->filter(fn($p) => is_numeric($p));

            $sellingPricesOnly = $product->variants
            ->map(fn($v) => $v->sell_price)
            ->filter(fn($p) => is_numeric($p));

            $hasSellPrice = $sellingPricesOnly->isNotEmpty();

            $discountPercent = 0;
            if ($hasSellPrice) {
            $minRegular = $regularPrices->min();
            $minSelling = $sellingPricesOnly->min();

            if ($minRegular > 0 && $minSelling < $minRegular) {
                $discountPercent=round((($minRegular - $minSelling) / $minRegular) * 100);
                }
                }

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
                    <h3 class="text-text-primary font-bengali text-sm md:text-base">
                        {{ mb_strimwidth($product->product_name, 0, 20, '...') }}
                    </h3>


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

---

{{-- ------------------------------------------------------------------------------------------------------ --}}
{{-- RECENT BLOG POSTS SECTION (New Code) --}}
{{-- ------------------------------------------------------------------------------------------------------ --}}

@if (isset($posts) && $posts->isNotEmpty())
<div class="max-w-[1200px] mx-auto px-4 md:p-0 mt-12 mb-8">
    <h2 class="text-center font-semibold text-brand-red text-xl md:text-2xl lg:text-4xl font-sans mb-6 uppercase">Latest Blog</h2>
    
    {{-- Grid layout for blog cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @foreach ($posts as $post)
            <div class="border border-main-border rounded-sm overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col">
                
                {{-- 1. Image (Ratio preserved) --}}
                @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}"
                    alt="{{ $post->title }}"
                    class="w-full h-48 object-cover object-center">
                @else
                <img src="https://via.placeholder.com/400x300?text=Blog+Image"
                    alt="Placeholder Image"
                    class="w-full h-48 object-cover object-center">
                @endif
                
                <div class="p-4 flex flex-col flex-grow">
                    {{-- 2. Title (Linked) --}}
                    <h3 class="text-text-primary font-bold text-lg mb-2 flex-shrink-0 font-bengali">
                        {{-- The title is a link using the blog.show route with the post's slug --}}
                        <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-brand-red transition-colors duration-200">
                            {{ mb_strimwidth($post->title, 0, 60, '...') }}
                        </a>
                    </h3>
                    
                    {{-- 3. Body Snippet --}}
                    {{-- Strips HTML and limits the length for a clean snippet --}}
                    <p class="text-text-secondary text-sm mb-4 flex-grow font-bengali">
                        {{ mb_strimwidth(strip_tags($post->body), 0, 120, '...') }}
                    </p>
                    
                    {{-- Read More Link --}}
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-brand-red text-sm font-semibold hover:text-red-700 transition duration-200 mt-auto">
                        Read More &rarr;
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="text-center mt-8">
        <a href="{{ route('blog.index') }}" class="inline-block px-6 py-2 border border-brand-red text-brand-red hover:bg-brand-red hover:text-white rounded-sm transition duration-300 font-sans">
            View All Blogs
        </a>
    </div>

</div>
@endif

@endsection