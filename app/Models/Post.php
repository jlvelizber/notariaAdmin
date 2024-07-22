<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'content',
        'status',
    ];

    /**
     * Releations
     */
    public function category()
    {
        return $this->hasOne(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Generate an event when store a new post in the database the slug is automatically generated and user in session the owner of the post
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });

        static::creating(function ($post) {
            $post->user_id = auth()->id();
        });
    }


    /**
     * Get the post's image path.
     */
    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }

    /**
     * Get the post's content in a readable format.
     */
    public function getFormattedContentAttribute()
    {
        return nl2br($this->content);
    }
}
