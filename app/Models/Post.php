<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * This ensures security against mass assignment vulnerabilities.
     * The 'slug' is typically not fillable if it's generated automatically, but we'll include it for now.
     */
    protected $fillable = [
        'title',
        'slug',
        'body',
        'image',
        'is_published',
        'published_at',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     * This automatically converts database values to convenient PHP types.
     */
    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Define the relationship to the User model (the Author).
     * This allows you to call $post->user to get the author's details.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}