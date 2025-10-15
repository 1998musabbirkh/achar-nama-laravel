@extends('layouts.layout')

@section('title', 'Contact Us')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-12 md:px-0">
    
    <!-- 🛑 1. SUCCESS MESSAGE DISPLAY 🛑 -->
    @if (session('success'))
        <div class="p-4 mb-6 text-md font-medium text-white bg-green-600 rounded-sm font-bengali" role="alert">
            <span class="font-semibold">সফল!</span> {{ session('success') }}
        </div>
    @endif

    <!-- 🛑 2. VALIDATION ERROR SUMMARY 🛑 -->
    @if ($errors->any())
        <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 border border-red-300 rounded-sm font-bengali" role="alert">
            <p class="font-bold mb-1">ফর্ম পূরণে ভুল আছে:</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-bengali font-extrabold text-red-700 mb-3">
            আচার নিয়ে কোন প্রশ্ন?
        </h1>
        <p class="text-text-secondary font-bengali text-lg md:text-xl">
            ডেলিভারি, কাস্টম অর্ডার, বা পণ্য সম্পর্কে বিস্তারিত জানতে আমাদের সাথে যোগাযোগ করুন।
        </p>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

        <div class="bg-surface p-6 md:p-8 border border-main-border rounded-sm  shadow-lg">
            <h2 class="text-2xl font-semibold mb-6 text-text-primary border-b font-bengali pb-3">
                বার্তা পাঠান
            </h2>
            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-text-secondary font-bengali">আপনার নাম</label>
                    <input type="text" id="name" name="name" required value="{{ old('name') }}"
                        class="mt-1 block w-full border border-main-border rounded-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-brand-red focus:border-brand-red text-text-secondary p-2.5 transition duration-150">
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-1 font-bengali">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-text-secondary font-bengali">ইমেল</label>
                    <input type="email" id="email" name="email" required value="{{ old('email') }}"
                        class="mt-1 block w-full border border-main-border rounded-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-brand-red focus:border-brand-red text-text-secondary p-2.5 transition duration-150">
                    @error('email')
                        <p class="text-red-500 text-xs italic mt-1 font-bengali">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-text-secondary font-bengali">বার্তার বিষয়</label>
                    <textarea id="message" name="message" rows="5" required
                        class="mt-1 block w-full border border-main-border rounded-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-brand-red focus:border-brand-red p-2.5 transition duration-150 font-bengali text-text-secondary placeholder:font-bengali placeholder:text-text-secondary placeholder:text-opacity-70"
                        placeholder="আপনার প্রশ্ন বা মতামত লিখুন...">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-xs italic mt-1 font-bengali">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full py-3 px-4 rounded-sm text-text-primary font-medium text-md bg-brand-red hover:bg-brand-green cursor-pointer font-bengali focus:outline-none transition duration-300">
                    বার্তা পাঠান
                </button>
            </form>
        </div>

        <!-- 2. Direct Contact Details & Info -->
        <div class="space-y-6">
            <div class="bg-brand-red p-6 md:p-8 rounded-sm">
                <h3 class="text-xl font-bold text-text-primary font-bengali mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.717 21 3 14.283 3 6V5z"></path>
                    </svg>
                    সরাসরি যোগাযোগ
                </h3>
                <div class="space-y-3">
                    <p class="text-text-secondary">
                        <strong class="font-semibold font-bengali">ফোন (জরুরি):</strong> <br>
                        <span class="text-text-secondary text-lg font-sans">+880 1401383238</span>
                    </p>
                    <p class="text-text-secondary">
                        <strong class="font-semibold font-bengali">ইমেল (বিস্তারিত):</strong> <br>
                        <a href="mailto:acharnama@gmail.com" class="text-text-secondary font-sans text-lg hover:underline">acharnama@gmail.com</a>
                    </p>
                    <p class="text-text-secondary">
                        <strong class="font-semibold font-sans">WhatsApp:</strong> <br>
                        <span class="text-text-secondary text-lg font-sans">+880 1401383238</span>
                    </p>
                </div>
            </div>

            <!-- Hours & Location Box -->
            <div class="bg-brand-green p-6 md:p-8 rounded-sm  shadow-lg">
                <h3 class="text-xl font-bold text-text-primary mb-4 flex items-center font-bengali">
                    <svg class="w-6 h-6 mr-3 text-text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    সময়সূচী ও ঠিকানা
                </h3>
                <div class="space-y-3 text-text-primary font-bengali">
                    <p>
                        <strong class="font-semibold">সেবা প্রদানের সময়:</strong> <br>
                        শনি - বৃহস্পতি: সকাল ১০টা - সন্ধ্যা ৭টা
                    </p>
                    <p>
                        <strong class="font-semibold">ঠিকানা (শুধুমাত্র পিকআপ):</strong> <br>
                        ১/এ, আচারের গলি, ঢাকা, বাংলাদেশ
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
