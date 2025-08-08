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
        'description',
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

/**
 * Follow relationships
 */
public function follows()
{
    return $this->hasMany(Follow::class);
}

public function notifications()
{
    return $this->hasMany(Notification::class);
}

public function followers()
{
    return $this->morphMany(Follow::class, 'followable');
}

public function followedCategories()
{
    return $this->morphedByMany(Category::class, 'followable', 'follows');
}

public function followedUsers()
{
    return $this->morphedByMany(User::class, 'followable', 'follows');
}

/**
 * Check if this user is following a given model.
 */
public function isFollowing($followable)
{
    return $this->follows()
        ->where('followable_type', get_class($followable))
        ->where('followable_id', $followable->id)
        ->exists();
}

/**
 * Follow a user or category.
 */
public function follow($followable)
{
    if (!$this->isFollowing($followable)) {
        return $this->follows()->create([
            'followable_type' => get_class($followable),
            'followable_id' => $followable->id,
        ]);
    }
    return false;
}

/**
 * Unfollow a user or category.
 */
public function unfollow($followable)
{
    return $this->follows()
        ->where('followable_type', get_class($followable))
        ->where('followable_id', $followable->id)
        ->delete();
}

/**
 * Get count of unread notifications.
 */
public function getUnreadNotificationsCount()
{
    return $this->notifications()->where('is_read', false)->count();
}

/**
 * Get followers count for this user.
 */
public function getFollowersCount()
{
    return $this->followers()->count();
}

/**
 * Check if user is admin.
 */
public function isAdmin()
{
    return $this->role === 'admin';
}

/**
 * Check if user is regular user.
 */
public function isUser()
{
    return $this->role === 'user';
}

/**
 * Get the user's role display name.
 */
public function getRoleDisplayName()
{
    return match($this->role) {
        'admin' => 'Administrator',
        'user' => 'User',
        default => ucfirst($this->role)
    };
}
}
