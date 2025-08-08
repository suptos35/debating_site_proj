<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'post_id',
        'triggered_by_user_id',
        'notifiable_type',
        'notifiable_id',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Get the user that owns the notification.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post that triggered the notification.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the user who triggered the notification.
     */
    public function triggeredBy()
    {
        return $this->belongsTo(User::class, 'triggered_by_user_id');
    }

    /**
     * Get the notifiable model (User or Category).
     */
    public function notifiable()
    {
        return $this->morphTo();
    }

    /**
     * Scope for unread notifications.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for read notifications.
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }
}
