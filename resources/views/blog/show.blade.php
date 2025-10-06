@extends('layouts.layout')

@section('title', $post->title)

@section('content')
<div class="max-w-[1200px] mx-auto px-4 md:px-0 mt-8 mb-12">
    
    <div class="p-6 bg-surface rounded-sm shadow-md border border-main-border">
        
        {{-- Post Header and Title --}}
        <h1 class="text-3xl md:text-5xl font-extrabold font-bengali text-text-primary mb-4 leading-tight">
            {{ $post->title }}
        </h1>
        
        {{-- Metadata --}}
        <div class="text-sm text-text-secondary mb-6 border-b border-main-border pb-3">
            Published on: 
            <span class="font-medium text-brand-red">{{ $post->published_at->format('F d, Y') }}</span> 
            by 
            <span class="font-medium text-text-primary">{{ $post->user->name }}</span>
        </div>

        {{-- Featured Image --}}
        @if ($post->image)
            <figure class="mb-8">
                <img src="{{ asset('storage/' . $post->image) }}" 
                    alt="{{ $post->title }}" 
                    class="w-full h-auto max-h-[500px] object-cover rounded-sm shadow-lg">
            </figure>
        @endif
        
        {{-- Post Body Content --}}
        <div class="prose max-w-none text-text-primary leading-relaxed">
            {!! $post->body !!}
        </div>

    </div>

    {{-- Back to Blog Link --}}
    <div class="mt-8">
        <a href="{{ route('blog.index') }}" class="text-brand-red hover:text-red-700 font-semibold flex items-center">
            <x-heroicon-o-arrow-left class="w-4 h-4 mr-1" /> Back to Blog Index
        </a>
    </div>

</div>
@endsection