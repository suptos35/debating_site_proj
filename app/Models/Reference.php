<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'url',
        'description',
        'is_valid',
        'is_reputable',
        'is_relevant',
        'similarity_score'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
