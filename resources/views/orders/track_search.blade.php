@extends('layouts.layout')

@section('title', 'Track Your Order')

@section('content')
<div class="max-w-md mx-auto my-12 p-6 bg-surface rounded-lg border border-main-border shadow-xl">
    <h1 class="text-2xl font-bengali font-bold mb-6 text-brand-red text-center">আপনার অর্ডার ট্র্যাক করুন</h1>
    <p class="text-center text-text-secondary mb-8">অর্ডারের সর্বশেষ অবস্থা জানতে নিচে আপনার অর্ডার আইডি দিন।</p>

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 font-bengali px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    
    <form action="{{ route('order.track.details') }}" method="POST">
        @csrf
        <div class="mb-6">
            <label for="order_id" class="block text-sm font-bengali font-medium text-text-primary mb-2">অর্ডার আইডি (Order ID)</label>
            <input type="text" 
                   name="order_id" 
                   id="order_id" 
                   value="{{ old('order_id') }}"
                   required
                   placeholder="যেমন: 101, 102, 500"
                   class="w-full px-4 py-2 border border-main-border rounded-lg focus:ring-brand-red focus:border-brand-red bg-bg text-text-primary placeholder-gray-400">
            @error('order_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-brand-red text-white py-2.5 px-4 rounded-lg font-bengali font-semibold text-lg hover:bg-brand-orange transition duration-200 shadow-md">
            ট্র্যাক করুন
        </button>
    </form>
</div>
@endsection
