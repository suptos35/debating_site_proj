<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
{
    return $this->hasMany(Like::class);
}

public function likedPosts()
{
    return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id');
}

public function polls()
{
    return $this->hasMany(Poll::class);
}

public function pollVotes()
{
    return $this->hasMany(PollVote::class);
}

public function views()
{
    return $this->hasMany(View::class, 'user_id');
}

public function viewsAsWriter()
{
    return $this->hasMany(View::class, 'writer_id');
}
}
