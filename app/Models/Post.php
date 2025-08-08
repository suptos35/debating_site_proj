<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'parent_id',
        'user_id',
        'type',
        'like_count',
        'image_url'
    ];

    public function parent()
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }

    public function pros()
    {
        return $this->hasMany(Post::class, 'parent_id')->where('type', 'pro');
    }

    public function cons()
    {
        return $this->hasMany(Post::class, 'parent_id')->where('type', 'con');
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

public function categories()
{
    return $this->belongsToMany(Category::class, 'category_post');
}
public function likes()
{
    return $this->hasMany(Like::class);
}

public function likedByUsers()
{
    return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
}

// Check if a specific user has liked this post
public function isLikedByUser($userId)
{
    return $this->likes()->where('user_id', $userId)->exists();
}

public function references()
{
    return $this->hasMany(Reference::class);
}

public function views()
{
    return $this->hasMany(View::class);
}

/**
 * Get the total view count for this post.
 */
public function viewCount()
{
    return $this->views()->sum('view_count');
}

/**
 * Get the total comment count (including all sub-comments) for this post.
 */
public function totalCommentCount()
{
    // First, get immediate children count
    $count = $this->children()->count();

    // Then, recursively count all descendants
    foreach ($this->children as $child) {
        $count += $child->totalCommentCount();
    }

    return $count;
}

}
