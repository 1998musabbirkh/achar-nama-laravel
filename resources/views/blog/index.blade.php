@extends('layouts.layout')

@section('title', 'Our Blog')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 md:px-0 mt-8 mb-12">
    
    {{-- Main Page Title --}}
    <h1 class="text-4xl md:text-5xl font-extrabold text-brand-red text-center mb-10 border-b border-main-border pb-4">
        Latest Insights & Articles
    </h1>

    @if ($posts->isEmpty())
        <p class="text-center text-text-secondary font-bengali mt-16 text-xl">
            দুঃখিত, বর্তমানে কোনো ব্লগ পোস্ট পাওয়া যায়নি। আমরা শীঘ্রই নতুন লেখা নিয়ে আসছি!
        </p>
    @else
        {{-- Grid Layout for Blog Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @foreach ($posts as $post)
                <div class="border border-main-border bg-surface rounded-sm overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col">
                    
                    {{-- Featured Image --}}
                    @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}"
                        alt="{{ $post->title }}"
                        class="w-full h-48 object-cover object-center">
                    @else
                    <img src="https://via.placeholder.com/400x300/181818/cfcfcf?text=No+Image"
                        alt="Placeholder Image"
                        class="w-full h-48 object-cover object-center">
                    @endif
                    
                    <div class="p-4 flex flex-col flex-grow font-bengali">
                        
                        {{-- Post Title (Linked) --}}
                        <h2 class="text-text-primary font-bold text-xl mb-2 flex-shrink-0 leading-snug">
                            <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-brand-red transition-colors duration-200">
                                {{ $post->title }}
                            </a>
                        </h2>
                        
                        {{-- Metadata --}}
                        <div class="text-xs text-text-secondary mb-3">
                            Published: {{ $post->published_at->format('M d, Y') }} | By: {{ $post->user->name }}
                        </div>

                        {{-- Body Snippet --}}
                        <p class="text-text-secondary text-base mb-4 flex-grow">
                            {{-- Strip HTML tags and limit text to a clean summary --}}
                            {{ mb_strimwidth(strip_tags($post->body), 0, 150, '...') }}
                        </p>
                        
                        {{-- Read More Link --}}
                        <a href="{{ route('blog.show', $post->slug) }}" class="text-brand-red text-base font-semibold hover:text-red-700 transition duration-200 mt-auto">
                            সম্পূর্ণ পড়ুন &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination Links --}}
        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    @endif

</div>
@endsection
