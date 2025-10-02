@extends('layouts.layout')

@section('title', 'Home Page')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 md:px-0 mt-4 rounded-sm">
    <img src="{{ Vite::asset('resources/images/banner.webp') }}" alt="" class="rounded-sm">
</div>

<div class="max-w-[1200px] mx-auto px-4 md:p-0 mt-8">

    <h2 class="text-center font-bold text-brand-red text-xl md:text-2xl lg:text-4xl font-sans mb-4">Featured Product</h2>

    @php
    $products = [
    [
    'title' => 'জলপাই আচার',
    'short_description' => 'তাজা জলপাই দিয়ে তৈরি ঝাল স্বাদের আচার।',
    'description' => 'আমাদের জলপাই এর তেল ঝাল আচার তাজা জলপাই এবং খাঁটি সরিষার তেল দিয়ে তৈরি। এটি ভাত, খিচুড়ি বা পরোটা সঙ্গে দারুণ মানিয়ে যায়।',
    'price' => 250,
    'cover_image' => 'https://ik.imagekit.io/4welo1mtc/1737786448506_WhatsApp_Image_2024-12-15_at_08.11.46_dd85fefd_bfY3IROwt.jpg',
    ],
    [
    'title' => 'রসুনের আচার',
    'short_description' => 'সুগন্ধি রসুনের মজাদার আচার।',
    'description' => 'সেরা মানের রসুন ও বিশেষ মশলার মিশ্রণে তৈরি। ঝাল-মিষ্টি স্বাদের অনন্য সংমিশ্রণ।',
    'price' => 180,
    'cover_image' => 'https://ik.imagekit.io/4welo1mtc/1737786448506_WhatsApp_Image_2024-12-15_at_08.11.46_dd85fefd_bfY3IROwt.jpg',
    ],
    [
    'title' => 'তেঁতুলের আচার',
    'short_description' => 'টক-ঝাল-মিষ্টি স্বাদের বিশেষ তেঁতুল আচার।',
    'description' => 'তেঁতুলের প্রাকৃতিক টক স্বাদ, গুঁড় ও মশলার ঝাল মিষ্টি মিশ্রণে তৈরি। ভাত বা স্ন্যাকসের সঙ্গে দারুণ।',
    'price' => 200,
    'cover_image' => 'https://ik.imagekit.io/4welo1mtc/1737786448506_WhatsApp_Image_2024-12-15_at_08.11.46_dd85fefd_bfY3IROwt.jpg',
    ],
    [
    'title' => 'চুইঝালের আচার',
    'short_description' => 'চুইঝাল দিয়ে তৈরি খাঁটি আচার।',
    'description' => 'চুইঝাল এর অনন্য ঘ্রাণ ও স্বাদে তৈরি এই আচার, খাঁটি সরিষার তেলে সংরক্ষিত।',
    'price' => 300,
    'cover_image' => 'https://ik.imagekit.io/4welo1mtc/1737786448506_WhatsApp_Image_2024-12-15_at_08.11.46_dd85fefd_bfY3IROwt.jpg',
    ],
    ];
    @endphp

    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-2 md:gap-4">
        @foreach ($products as $product)
        <div class="p-3 sm:p-4 border border-main-border rounded-sm flex flex-col gap-2 md:gap4 text-center">
            <img src="{{ $product['cover_image'] }}" alt="{{ $product['title'] }}" class="rounded-sm">
            <div>
                <h3 class="text-text-primary font-bengali text-sm md:text-base">{{ $product['title'] }}</h3>
                <p class="text-text-secondary font-bold text-[10px] md:text-sm font-sans">৳{{ $product['price'] }}</p>
            </div>
            <button class="text-text-primary bg-brand-red py-[6px] text-sm md:text-base font-bengali cursor-pointer hover:bg-brand-orange transition-colors duration-300 rounded-sm">অর্ডার করুন</button>
        </div>
        @endforeach
    </div>

</div>

<div class="max-w-[1200px] mx-auto px-4 md:p-0 mt-8">

    <h2 class="text-center font-bold text-brand-red text-xl md:text-2xl lg:text-4xl font-sans mb-4">Best Selling Products</h2>

    @php
    $products = [
    [
    'title' => 'জলপাই আচার',
    'short_description' => 'তাজা জলপাই দিয়ে তৈরি ঝাল স্বাদের আচার।',
    'description' => 'আমাদের জলপাই এর তেল ঝাল আচার তাজা জলপাই এবং খাঁটি সরিষার তেল দিয়ে তৈরি। এটি ভাত, খিচুড়ি বা পরোটা সঙ্গে দারুণ মানিয়ে যায়।',
    'price' => 250,
    'cover_image' => 'https://ik.imagekit.io/4welo1mtc/1737786448506_WhatsApp_Image_2024-12-15_at_08.11.46_dd85fefd_bfY3IROwt.jpg',
    ],
    [
    'title' => 'রসুনের আচার',
    'short_description' => 'সুগন্ধি রসুনের মজাদার আচার।',
    'description' => 'সেরা মানের রসুন ও বিশেষ মশলার মিশ্রণে তৈরি। ঝাল-মিষ্টি স্বাদের অনন্য সংমিশ্রণ।',
    'price' => 180,
    'cover_image' => 'https://ik.imagekit.io/4welo1mtc/1737786448506_WhatsApp_Image_2024-12-15_at_08.11.46_dd85fefd_bfY3IROwt.jpg',
    ],
    [
    'title' => 'তেঁতুলের আচার',
    'short_description' => 'টক-ঝাল-মিষ্টি স্বাদের বিশেষ তেঁতুল আচার।',
    'description' => 'তেঁতুলের প্রাকৃতিক টক স্বাদ, গুঁড় ও মশলার ঝাল মিষ্টি মিশ্রণে তৈরি। ভাত বা স্ন্যাকসের সঙ্গে দারুণ।',
    'price' => 200,
    'cover_image' => 'https://ik.imagekit.io/4welo1mtc/1737786448506_WhatsApp_Image_2024-12-15_at_08.11.46_dd85fefd_bfY3IROwt.jpg',
    ],
    [
    'title' => 'চুইঝালের আচার',
    'short_description' => 'চুইঝাল দিয়ে তৈরি খাঁটি আচার।',
    'description' => 'চুইঝাল এর অনন্য ঘ্রাণ ও স্বাদে তৈরি এই আচার, খাঁটি সরিষার তেলে সংরক্ষিত।',
    'price' => 300,
    'cover_image' => 'https://ik.imagekit.io/4welo1mtc/1737786448506_WhatsApp_Image_2024-12-15_at_08.11.46_dd85fefd_bfY3IROwt.jpg',
    ],
    ];
    @endphp

    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-2 md:gap-4">
        @foreach ($products as $product)
        <div class="p-3 sm:p-4 border border-main-border rounded-sm flex flex-col gap-2 md:gap4 text-center">
            <img src="{{ $product['cover_image'] }}" alt="{{ $product['title'] }}" class="rounded-sm">
            <div>
                <h3 class="text-text-primary font-bengali text-sm md:text-base">{{ $product['title'] }}</h3>
                <p class="text-text-secondary font-bold text-[10px] md:text-sm font-sans">৳{{ $product['price'] }}</p>
            </div>
            <button class="text-text-primary bg-brand-red py-[6px] text-sm md:text-base font-bengali cursor-pointer hover:bg-brand-orange transition-colors duration-300 rounded-sm">অর্ডার করুন</button>
        </div>
        @endforeach
    </div>

</div>
@endsection