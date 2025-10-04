@extends('layouts.layout')

@section('title', $product->product_name)

@section('content')
<div class="max-w-[1200px] mx-auto px-4 md:p-0 mt-8">

    @php
    $primaryImage = $product->primary_image;
    @endphp

    <div class="flex flex-col gap-4 md:flex-row justify-between items-center">

        <div class="flex flex-col order-2 gap-4 md:order-1 md:w-[52%]">

            <h1 class="font-bengali text-brand-red text-center md:text-left text-2xl md:text-3xl lg:text-4xl font-semibold order-2 md:order-none leading-6 md:leading-10">
                {{ $product->title }}
            </h1>

            <h2 class="text-xl text-center md:text-left md:text-[22px] lg:text-2xl text-brand-green font-semibold font-bengali order-3 md:order-none leading-6 md:leading-10">
                {{ $product->subtitle }}
            </h2>

            <p class="font-bengali text-text-primary text-center md:text-left text-sm md:text-base order-4 md:order-none">
                {{ $product->primary_description }}
            </p>

            <div class="flex gap-4 justify-center md:justify-start order-1 md:order-none">
                <a href="#" class="px-5 text-center py-2 bg-brand-red hover:bg-brand-orange transition-colors duration-300 text-white font-bengali text-sm md:text-base rounded-sm flex-1 md:flex-none">এখনই অর্ডার করুন</a>
                <a href="#" class="px-5 text-center py-2 border border-brand-green text-brand-green hover:bg-brand-green hover:text-white transition-colors duration-300 font-bengali text-sm md:text-base rounded-sm flex-1 md:flex-none">আমাদের কল করুন</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 order-4">
                <div class="flex items-center justify-center gap-2 border py-2 border-dashed border-brand-red rounded-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 md:size-8 text-brand-red">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 8.25.22-.22a.75.75 0 0 1 1.28.53v6.441c0 .472.214.934.64 1.137a3.75 3.75 0 0 0 4.994-1.77c.205-.428-.152-.868-.627-.868h-.507m-6-2.25h7.5M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <h5 class="text-text-primary font-bengali text-sm md:text-base">ফ্রি ডেলিভারি</h5>
                </div>
                <div class="flex items-center justify-center gap-2 border py-2 border-dashed border-brand-red rounded-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 md:size-8 text-brand-red">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                    </svg>
                    <h5 class="text-text-primary font-bengali text-sm md:text-base">ক্যাশ অন ডেলিভারি</h5>
                </div>
                <div class="flex items-center justify-center gap-2 border py-2 border-dashed border-brand-red rounded-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 md:size-8 text-brand-red">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                    </svg>
                    <h5 class="text-text-primary font-bengali text-sm md:text-base">শতভাগ অরগানিক</h5>
                </div>
            </div>
        </div>

        <div class="order-1 md:order-2 md:w-[45%] flex justify-end">
            <img src="{{ asset('storage/' . $primaryImage->path) }}"
                alt="{{ $product->product_name }}"
                class="rounded-sm">
        </div>
    </div>
</div>

<div class="max-w-[1200px] mx-auto px-4 md:p-0 mt-8">

    @php
    $allImages = $product->images;
    $secondImage = $allImages->get(1);
    @endphp

    <div class="flex flex-col gap-4 md:flex-row justify-between items-center">

        <div class="flex flex-col order-2 gap-4 md:w-[52%]">

            <h2 class="font-bengali text-brand-red text-center md:text-left text-2xl md:text-3xl lg:text-4xl font-semibold order-2 md:order-none leading-6 md:leading-10">
                আমাদের আচার কেন নিবেন?
            </h2>

            <p class="font-bengali text-text-primary text-center md:text-left text-sm md:text-base order-2 md:order-none">
                {{ $product->sub_description }}
            </p>

            <div class="flex gap-4 justify-center md:justify-start order-3 md:order-none">
                <a href="#" class="px-5 text-center py-2 bg-brand-red hover:bg-brand-orange transition-colors duration-300 text-white font-bengali text-sm md:text-base rounded-sm md:flex-none">এখনই অর্ডার করুন</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 order-4">
                <div class="flex items-center justify-center gap-2 border py-2 border-dashed border-brand-green rounded-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 md:size-8 text-brand-green">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                    <h5 class="text-text-primary font-bengali text-sm md:text-base">স্বাস্থ্যসম্মত</h5>
                </div>
                <div class="flex items-center justify-center gap-2 border py-2 border-dashed border-brand-green rounded-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 md:size-8 text-brand-green">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 1 0-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 0 1 3.15 0v1.5m-3.15 0 .075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 0 1 3.15 0V15M6.9 7.575a1.575 1.575 0 1 0-3.15 0v8.175a6.75 6.75 0 0 0 6.75 6.75h2.018a5.25 5.25 0 0 0 3.712-1.538l1.732-1.732a5.25 5.25 0 0 0 1.538-3.712l.003-2.024a.668.668 0 0 1 .198-.471 1.575 1.575 0 1 0-2.228-2.228 3.818 3.818 0 0 0-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0 1 16.35 15m.002 0h-.002" />
                    </svg>
                    <h5 class="text-text-primary font-bengali text-sm md:text-base">হাতে বানানো</h5>
                </div>
                <div class="flex items-center justify-center gap-2 border py-2 border-dashed border-brand-green rounded-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 md:size-8 text-brand-green">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                    </svg>
                    <h5 class="text-text-primary font-bengali text-sm md:text-base">শতভাগ অরগানিক</h5>
                </div>
            </div>
        </div>

        <div class="order-1 md:w-[45%] flex justify-end">
            <img src="{{ asset('storage/' . $secondImage->path) }}"
                alt="{{ $product->product_name }}"
                class="rounded-sm">
        </div>
    </div>
</div>

<div class="max-w-[1200px] mx-auto px-4 md:p-0 mt-8">
    <h2 class="font-bengali text-brand-red text-center text-2xl md:text-3xl lg:text-4xl font-semibold leading-6 md:leading-10 mb-4">
        আমাদের {{ $product->product_name }} কেন খাবেন?
    </h2>

    <div class="flex gap-4 flex-col md:flex-row">
        <div class="flex flex-col gap-2 justify-center items-center text-center bg-brand-green py-4 px-4 rounded-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 md:size-10 text-text-primary">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
            </svg>
            <h4 class="text-text-primary font-semibold font-bengali text-base md:text-xl">ঐতিহ্যবাহী স্বাদ ও রুচি বৃদ্ধি</h4>
            <p class="text-text-primary text-sm font-bengali">খাবারে অতিরিক্ত রুচি আনতে এবং পাতে ঐতিহ্যবাহী স্বাদের ছোঁয়া দিতে আচারের জুড়ি নেই। দেশীয় মশলার মিশ্রণে তৈরি এই আচার খাবারকে করে তোলে আরও আকর্ষণীয়।</p>
        </div>

        <div class="flex flex-col gap-2 justify-center items-center text-center bg-brand-green py-4 px-4 rounded-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 md:size-10 text-text-primary">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
            </svg>
            <h4 class="text-text-primary font-semibold font-bengali text-base md:text-xl">ঐতিহ্যবাহী স্বাদ ও রুচি বৃদ্ধি</h4>
            <p class="text-text-primary text-sm font-bengali">খাবারে অতিরিক্ত রুচি আনতে এবং পাতে ঐতিহ্যবাহী স্বাদের ছোঁয়া দিতে আচারের জুড়ি নেই। দেশীয় মশলার মিশ্রণে তৈরি এই আচার খাবারকে করে তোলে আরও আকর্ষণীয়।</p>
        </div>

        <div class="flex flex-col gap-2 justify-center items-center text-center bg-brand-green py-4 px-4 rounded-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 md:size-10 text-text-primary">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
            <h4 class="text-text-primary font-semibold font-bengali text-base md:text-xl">ঐতিহ্যবাহী স্বাদ ও রুচি বৃদ্ধি</h4>
            <p class="text-text-primary text-sm font-bengali">খাবারে অতিরিক্ত রুচি আনতে এবং পাতে ঐতিহ্যবাহী স্বাদের ছোঁয়া দিতে আচারের জুড়ি নেই। দেশীয় মশলার মিশ্রণে তৈরি এই আচার খাবারকে করে তোলে আরও আকর্ষণীয়।</p>
        </div>
    </div>
</div>

<div class="max-w-[1200px] mx-auto px-4 md:p-0 mt-8" id="checkout-form">
    <h2 class="font-bengali text-brand-red text-center text-3xl font-semibold mb-6">
        অর্ডার সম্পন্ন করুন
    </h2>

    <form action="#" method="POST" class="bg-surface p-6 md:p-10 rounded-lg shadow-xl">
        @csrf

        <div id="variant-selection-area" class="space-y-4">
            <h3 class="font-bengali text-xl font-semibold mb-4 text-brand-green">পণ্য ও ওজন নির্বাচন</h3>

            @php
                $defaultVariant = $product->variants->first();
                $defaultPrice = $defaultVariant->sell_price ?? $defaultVariant->regular_price ?? 0;
            @endphp

            <input type="hidden" name="variant_id" id="selected_variant_id" value="{{ $defaultVariant->id ?? '' }}" required>
            <input type="hidden" name="quantity" id="selected_quantity" value="1" required>
            <input type="hidden" id="product_name_for_summary" value="{{ $product->product_name }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                @forelse ($product->variants as $index => $variant)
                @php
                $isDefault = ($index === 0);
                $displayPrice = $variant->sell_price ?? $variant->regular_price;
                $regularPrice = $variant->regular_price;
                @endphp

                <div class="variant-card flex items-center p-4 border border-dashed transition-all duration-300 cursor-pointer rounded-sm
                {{ $isDefault 
                    ? 'border-brand-red bg-bg shadow-xl text-brand-red' 
                    : 'border-gray-300 hover:border-brand-green' }}"
                    data-variant-id="{{ $variant->id }}"
                    data-base-price="{{ $displayPrice }}"
                    data-variant-name="{{ $variant->variant_name }}">

                    <input type="radio" name="variant_radio_select" id="variant_{{ $variant->id }}" value="{{ $variant->id }}"
                        class="hidden" {{ $isDefault ? 'checked' : '' }}>

                    <label for="variant_{{ $variant->id }}" class="flex items-center justify-between w-full cursor-pointer flex-col md:flex-row">

                        <div class="flex items-center gap-2">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/' . $product->primary_image?->path) }}"
                                    alt="{{ $product->product_name }} - {{ $variant->variant_name }}"
                                    class="size-16 rounded object-cover border border-gray-200">
                            </div>

                            <div class="flex flex-col flex-grow">
                                <span class="font-bengali font-semibold text-sm md:text-lg {{ $isDefault ? 'text-brand-red' : 'text-text-primary' }}" id="name-{{ $variant->id }}">
                                    {{ $product->product_name }} - {{ $variant->variant_name }}
                                </span>

                                <div class="flex items-baseline space-x-2 text-sm">
                                    <span class="font-bold text-base md:text-xl font-sans text-brand-red" id="price-display-{{ $variant->id }}">
                                        ৳{{ number_format($displayPrice, 0, '.', ',') }}
                                    </span>
                                    @if ($variant->sell_price)
                                    <span class="line-through font-sans {{ $isDefault ? 'text-red-500' : 'text-gray-500' }}">
                                        ৳{{ number_format($regularPrice, 0, '.', ',') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-2 flex-shrink-0" id="quantity-control-{{ $variant->id }}"
                            style="{{ $isDefault ? '' : 'display: none;' }}">
                            <button type="button" class="quantity-btn cursor-pointer bg-white text-gray-700 size-6 md:size-8 rounded-full flex items-center justify-center hover:bg-gray-100 transition" data-action="decrement" data-variant-id="{{ $variant->id }}">
                                –
                            </button>
                            <span class="quantity-value text-base md:text-lg font-semibold font-sans min-w-8 text-center {{ $isDefault ? 'text-brand-red' : 'text-text-primary' }}" id="quantity-{{ $variant->id }}">1</span>
                            <button type="button" class="quantity-btn cursor-pointer bg-brand-red text-white size-6 md:size-8 rounded-full flex items-center justify-center hover:bg-brand-orange transition" data-action="increment" data-variant-id="{{ $variant->id }}">
                                +
                            </button>
                        </div>
                    </label>
                </div>
                @empty
                <div class="md:col-span-2">
                    <p class="text-gray-500 font-bengali text-center">এই পণ্যের জন্য কোনো ওজন বা সাইজ সেট করা হয়নি।</p>
                </div>
                @endforelse

            </div>

            @error('variant_id') <p class="text-red-500 text-sm mt-1 font-bengali">অনুগ্রহ করে পণ্যের ওজন নির্বাচন করুন।</p> @enderror
            @error('quantity') <p class="text-red-500 text-sm mt-1 font-bengali">পণ্যের সংখ্যা অবশ্যই ১ বা তার বেশি হতে হবে।</p> @enderror
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

            <div class="lg:col-span-1">

                <h3 class="font-bengali text-xl font-semibold mb-4 text-brand-green">আপনার তথ্য</h3>

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-text-primary font-bengali mb-2" for="customer_name">নাম</label>
                        <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required
                            class="w-full border border-dashed border-brand-red p-3 rounded-md focus:border-brand-red">
                        @error('customer_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-text-primary font-bengali mb-2" for="phone">মোবাইল নম্বর</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                            class="w-full border border-dashed border-brand-red p-3 rounded-sm focus:border-brand-red">
                        @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-text-primary font-bengali mb-2" for="address">ডেলিভারি ঠিকানা</label>
                    <textarea name="address" id="address" rows="3" required
                        class="w-full border border-brand-red p-3 rounded-sm focus:border-brand-red border-dashed">{{ old('address') }}</textarea>
                    @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <h3 class="font-bengali text-xl font-semibold mb-4 text-brand-green mt-4">পেমেন্ট</h3>
                <div class="p-4 border border-brand-green rounded-md bg-bg">
                    <label class="flex items-center">
                        <input type="radio" name="payment_method" value="COD" checked class="form-radio text-brand-green size-5">
                        <span class="ml-3 text-text-primary font-bengali font-semibold">ক্যাশ অন ডেলিভারি (COD)</span>
                    </label>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="border-dashed border border-gray-200 p-4 rounded-sm bg-bg shadow-sm h-fit mb-4">
                    <h3 class="font-bengali text-xl font-semibold mb-4 text-brand-red border-dashed border-b pb-2">
                        অর্ডার সারসংক্ষেপ
                    </h3>

                    <div class="space-y-3">
                        <div class="flex justify-between items-start text-text-primary">
                            <div class="flex-1 font-bengali text-base">
                                <span id="summary-product-name">{{ $product->product_name }} - {{ $defaultVariant->variant_name ?? 'N/A' }}</span>
                                <span id="summary-quantity" class="font-sans text-sm text-gray-500 block">x 1</span>
                            </div>
                            <span id="summary-product-price" class="font-sans text-lg font-semibold whitespace-nowrap">
                                ৳{{ number_format($defaultPrice * 1, 0, '.', ',') }}
                            </span>
                        </div>

                        <div class="flex justify-between font-bengali pt-2 border-t border-text-secondary border-dashed">
                            <span class="text-text-primary">সাবটোটাল</span>
                            <span id="summary-subtotal" class="font-sans text-base font-semibold text-text-primary">
                                ৳{{ number_format($defaultPrice * 1, 0, '.', ',') }}
                            </span>
                        </div>

                        <div class="flex justify-between font-bengali text-lg font-bold border-t border-dashed pt-2 border-brand-red">
                            <span class="text-brand-red">মোট</span>
                            <span id="summary-total" class="font-sans text-xl text-brand-red">
                                ৳{{ number_format($defaultPrice * 1, 0, '.', ',') }}
                            </span>
                        </div>

                        <p class="font-bengali text-xs text-brand-green mt-4 text-center">
                            (ডেলিভারি চার্জ: ফ্রি)
                        </p>
                    </div>
                </div>

                <button type="submit"
                    class="w-full px-5 py-3 bg-brand-red hover:bg-brand-orange transition-colors duration-300 text-white font-bengali text-lg rounded-sm">
                    অর্ডার কনফার্ম করুন
                </button>
            </div>

        </div>

    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const variantCards = document.querySelectorAll('.variant-card');
        const hiddenVariantIdInput = document.getElementById('selected_variant_id');
        const hiddenQuantityInput = document.getElementById('selected_quantity');
        const quantityButtons = document.querySelectorAll('.quantity-btn');

        const summaryProductName = document.getElementById('summary-product-name');
        const summaryQuantity = document.getElementById('summary-quantity');
        const summaryProductPrice = document.getElementById('summary-product-price');
        const summarySubtotal = document.getElementById('summary-subtotal');
        const summaryTotal = document.getElementById('summary-total');
        const baseProductName = document.getElementById('product_name_for_summary').value;

        const selectedBorderClass = 'border-brand-red';
        const unselectedBorderClass = 'border-gray-300';
        const hoverBorderClass = 'hover:border-brand-green';
        const selectedBgClass = 'bg-bg';
        const selectedTextColorClass = 'text-brand-red';
        const unselectedTextColorClass = 'text-text-primary';
        const selectedLineThroughColorClass = 'text-red-500';
        const unselectedLineThroughColorClass = 'text-gray-500';

        const variantQuantities = {};
        variantCards.forEach(card => {
            const id = card.dataset.variantId;
            variantQuantities[id] = 1;
        });

        const formatPrice = (price) => '৳' + new Intl.NumberFormat('en-BD').format(price);

        const updateOrderSummary = (variantId, quantity) => {
            const card = document.querySelector(`.variant-card[data-variant-id="${variantId}"]`);
            if (!card) return;

            const basePrice = parseFloat(card.dataset.basePrice);
            const variantName = card.dataset.variantName;
            const totalPrice = basePrice * quantity;

            summaryProductName.textContent = `${baseProductName} - ${variantName}`;
            summaryQuantity.textContent = `x ${quantity}`;
            summaryProductPrice.textContent = formatPrice(totalPrice);
            summarySubtotal.textContent = formatPrice(totalPrice);
            summaryTotal.textContent = formatPrice(totalPrice);
        };

        variantCards.forEach(card => {
            card.addEventListener('click', function() {
                const selectedId = this.dataset.variantId;
                const basePrice = parseFloat(this.dataset.basePrice);
                const currentQuantity = variantQuantities[selectedId];

                hiddenVariantIdInput.value = selectedId;
                hiddenQuantityInput.value = currentQuantity;

                variantCards.forEach(c => {
                    const variantId = c.dataset.variantId;
                    const control = document.getElementById(`quantity-control-${variantId}`);
                    const priceDisplay = document.getElementById(`price-display-${variantId}`);
                    const nameDisplay = document.getElementById(`name-${variantId}`);
                    const quantityValue = c.querySelector('.quantity-value');
                    const regularPriceSpan = c.querySelector('.line-through');

                    if (variantId === selectedId) {
                        c.classList.add(selectedBorderClass, selectedBgClass, 'shadow-xl', selectedTextColorClass);
                        c.classList.remove(unselectedBorderClass, hoverBorderClass);

                        if (control) {
                            control.style.display = 'flex';
                        }
                        if (nameDisplay) {
                            nameDisplay.classList.add(selectedTextColorClass);
                            nameDisplay.classList.remove(unselectedTextColorClass);
                        }
                        if (quantityValue) {
                            quantityValue.classList.add(selectedTextColorClass);
                            quantityValue.classList.remove(unselectedTextColorClass);
                        }
                        if (regularPriceSpan) {
                            regularPriceSpan.classList.add(selectedLineThroughColorClass);
                            regularPriceSpan.classList.remove(unselectedLineThroughColorClass);
                        }

                    } else {
                        c.classList.remove(selectedBorderClass, selectedBgClass, 'shadow-xl', selectedTextColorClass);
                        c.classList.add(unselectedBorderClass, hoverBorderClass);

                        if (control) control.style.display = 'none';

                        if (nameDisplay) {
                            nameDisplay.classList.remove(selectedTextColorClass);
                            nameDisplay.classList.add(unselectedTextColorClass);
                        }
                        if (quantityValue) {
                            quantityValue.classList.remove(selectedTextColorClass);
                            quantityValue.classList.add(unselectedTextColorClass);
                        }
                        if (regularPriceSpan) {
                            regularPriceSpan.classList.remove(selectedLineThroughColorClass);
                            regularPriceSpan.classList.add(unselectedLineThroughColorClass);
                        }

                        const variantQuantity = variantQuantities[variantId];
                        const variantBasePrice = parseFloat(c.dataset.basePrice);
                        if (priceDisplay) {
                            priceDisplay.textContent = formatPrice(variantBasePrice * variantQuantity);
                        }
                    }
                });

                document.getElementById(`variant_${selectedId}`).checked = true;
                document.getElementById(`quantity-${selectedId}`).textContent = currentQuantity;

                const priceDisplay = document.getElementById(`price-display-${selectedId}`);
                if (priceDisplay) {
                    priceDisplay.textContent = formatPrice(basePrice * currentQuantity);
                }

                updateOrderSummary(selectedId, currentQuantity);
            });

            const defaultCardRadio = document.getElementById(`variant_${card.dataset.variantId}`);
            if (defaultCardRadio && defaultCardRadio.checked) {
                card.classList.add(selectedBorderClass, selectedBgClass, 'shadow-xl', selectedTextColorClass);
                card.classList.remove(unselectedBorderClass, hoverBorderClass);

                const nameDisplay = document.getElementById(`name-${card.dataset.variantId}`);
                const quantityValue = card.querySelector('.quantity-value');
                const regularPriceSpan = card.querySelector('.line-through');

                if (nameDisplay) {
                    nameDisplay.classList.add(selectedTextColorClass);
                    nameDisplay.classList.remove(unselectedTextColorClass);
                }
                if (quantityValue) {
                    quantityValue.classList.add(selectedTextColorClass);
                    quantityValue.classList.remove(unselectedTextColorClass);
                }
                if (regularPriceSpan) {
                    regularPriceSpan.classList.add(selectedLineThroughColorClass);
                    regularPriceSpan.classList.remove(unselectedLineThroughColorClass);
                }

                const control = document.getElementById(`quantity-control-${card.dataset.variantId}`);
                if (control) control.style.display = 'flex';

                updateOrderSummary(card.dataset.variantId, 1);
            }
        });

        quantityButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();

                const variantId = button.dataset.variantId;
                const action = button.dataset.action;
                const quantityElement = document.getElementById(`quantity-${variantId}`);
                const priceDisplayElement = document.getElementById(`price-display-${variantId}`);
                const cardElement = document.querySelector(`.variant-card[data-variant-id="${variantId}"]`);

                if (!cardElement) return;

                const basePrice = parseFloat(cardElement.dataset.basePrice);
                let currentQuantity = variantQuantities[variantId];

                if (action === 'increment') {
                    currentQuantity++;
                } else if (action === 'decrement' && currentQuantity > 1) {
                    currentQuantity--;
                } else if (action === 'decrement' && currentQuantity === 1) {
                    alert("পণ্যের সংখ্যা ১ এর নিচে হতে পারে না।");
                    return;
                }

                variantQuantities[variantId] = currentQuantity;

                quantityElement.textContent = currentQuantity;

                const newPrice = basePrice * currentQuantity;
                priceDisplayElement.textContent = formatPrice(newPrice);


                if (hiddenVariantIdInput.value === variantId) {
                    hiddenQuantityInput.value = currentQuantity;
                    updateOrderSummary(variantId, currentQuantity);
                }
            });
        });
    });
</script>
@endsection