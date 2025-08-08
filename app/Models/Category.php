<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function posts()
{
    return $this->belongsToMany(Post::class, 'category_post');
}

/**
 * Follow relationships
 */
public function followers()
{
    return $this->morphMany(Follow::class, 'followable');
}

/**
 * Get followers count for this category.
 */
public function getFollowersCount()
{
    return $this->followers()->count();
}
}
