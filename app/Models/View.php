<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class View extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'view_count',
        'session_id',
        'ip_address',
    ];

    /**
     * Get the user that owns the view.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post that owns the view.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
