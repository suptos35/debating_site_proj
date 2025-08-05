<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'is_active',
        'multiple_choice',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
        'multiple_choice' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function options()
    {
        return $this->hasMany(PollOption::class);
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class);
    }

    public function userVotes($userId)
    {
        return $this->votes()->where('user_id', $userId);
    }

    public function hasUserVoted($userId)
    {
        return $this->votes()->where('user_id', $userId)->exists();
    }

    public function getTotalVotesAttribute()
    {
        return $this->options->sum('votes_count');
    }

    public function getTotalUsersVotedAttribute()
    {
        return $this->votes()->distinct('user_id')->count('user_id');
    }

    public function getTotalSelectionsAttribute()
    {
        return $this->options->sum('votes_count');
    }

    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function canVote()
    {
        return $this->is_active && !$this->isExpired();
    }
}
