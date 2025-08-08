<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'followable_type',
        'followable_id'
    ];

    /**
     * Get the user that owns the follow.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the followable model (User or Category).
     */
    public function followable()
    {
        return $this->morphTo();
    }
}
