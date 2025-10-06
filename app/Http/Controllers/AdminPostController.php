<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'        => 'required|max:255',
            'slug'         => [
                'required',
                'max:255',
                Rule::unique('posts', 'slug'),
                'alpha_dash',
            ],
            'body'         => 'required',
            'image'        => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'is_published' => 'nullable|boolean',
        ]);


        $imagePath = $request->file('image')->store('images/posts', 'public');
        $validatedData['image'] = $imagePath;


        $validatedData['user_id'] = Auth::id();

        $validatedData['is_published'] = $request->boolean('is_published');

        if ($validatedData['is_published']) {
            $validatedData['published_at'] = now();
        }

        Post::create($validatedData);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title'        => 'required|max:255',
            'slug'         => [
                'required',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($post),
                'alpha_dash',
            ],
            'body'         => 'required',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($post->image);

            $imagePath = $request->file('image')->store('images/posts', 'public');
            $validatedData['image'] = $imagePath;
        }

        $validatedData['is_published'] = $request->boolean('is_published');

        if ($validatedData['is_published'] && is_null($post->published_at)) {
            $validatedData['published_at'] = now();
        } elseif (!$validatedData['is_published']) {
            $validatedData['published_at'] = null;
        }

        $post->update($validatedData);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::disk('public')->delete($post->image);
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }
}
