<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of all PUBLISHED posts.
     */
    public function index()
    {
        $posts = Post::with('user')
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->paginate(10);

        return view('blog.index', compact('posts'));
    }

    /**
     * Display the specified PUBLISHED post.
     */
    public function show(Post $post)
    {
        if (!$post->is_published) {
            abort(404);
        }

        return view('blog.show', compact('post'));
    }
}
