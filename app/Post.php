<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Post extends Model
{
    use CrudTrait;

    protected $fillable = ['body', 'created_at'];
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

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = \Date::parse($value);
    }
}
