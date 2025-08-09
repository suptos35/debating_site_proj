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
        'similarity_score',
        'ai_analysis',
        'supports_post',
        'confidence_score',
        'last_checked_at',
        'content_extracted'
    ];

    protected $casts = [
        'last_checked_at' => 'datetime',
        'is_valid' => 'boolean',
        'is_reputable' => 'boolean',
        'is_relevant' => 'boolean',
        'supports_post' => 'boolean',
        'confidence_score' => 'decimal:2'
    ];

    public function getSupportLevelDisplayAttribute()
    {
        if ($this->supports_post === true) {
            return '✅ Supports';
        } elseif ($this->supports_post === false) {
            return '❌ Contradicts';
        } else {
            return '🤖 Analyzing...';
        }
    }

    public function needsRecheck()
    {
        return !$this->last_checked_at ||
               $this->last_checked_at->lt(now()->subDays(7)); // Recheck weekly
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
