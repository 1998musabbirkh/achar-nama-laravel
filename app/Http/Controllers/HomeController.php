<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with(['images', 'variants'])
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            $posts = Post::where('is_published', true)
                     ->orderByDesc('published_at')
                     ->take(3) 
                     ->get();

        return view('home', compact('products', 'posts'));
        } catch (\Exception $e) {
            Log::error('Error fetching products for homepage: ' . $e->getMessage());
            $products = collect();
            return view('home', compact('products'))->with('error', 'Could not load products at this time.');
        }
    }
}
