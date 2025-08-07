<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class View extends Model
{
    protected $fillable = [
        'writer_id',
        'post_id',
        'view_count',
    ];

    /**
     * Get the writer (post author) associated with the view.
     */
    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id');
    }

    /**
     * Get the post that owns the view.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
