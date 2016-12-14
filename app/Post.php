<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['body'];
    protected $appends = ['likeCount', 'likedByCurrentUser', 'canBeLikedByCurrentUser'];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function getLikeCountAttribute()
    {
        return $this->likes->count();
    }

    public function getLikedByCurrentUserAttribute()
    {
        return $this->likes->where('user_id', \Auth::user()->id)->count() !== 0;
    }

    public function getCanBeLikedByCurrentUserAttribute()
    {
        return !$this->likedByCurrentUser && $this->user->id !== \Auth::user()->id;
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
