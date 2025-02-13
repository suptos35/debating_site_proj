<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

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

public function catagory()
{
    return $this->belongsTo(Catagory::class);
}
}
