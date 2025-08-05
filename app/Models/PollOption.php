<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PollOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'poll_id',
        'option_text',
        'votes_count'
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class);
    }

    public function getVotePercentageAttribute()
    {
        if ($this->poll->multiple_choice) {
            // For multiple choice: percentage based on total users who voted
            $totalUsers = $this->poll->total_users_voted;
            if ($totalUsers == 0) return 0;
            return round(($this->votes_count / $totalUsers) * 100, 1);
        } else {
            // For single choice: percentage based on total votes
            $totalVotes = $this->poll->total_votes;
            if ($totalVotes == 0) return 0;
            return round(($this->votes_count / $totalVotes) * 100, 1);
        }
    }
}
