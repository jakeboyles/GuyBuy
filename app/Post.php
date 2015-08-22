<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Post extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body','user_id','price','category'];


    public function author()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function community()
    {
        return $this->belongsTo('App\Community', 'community_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function photos()
    {
        return $this->hasMany('App\Media');
    }

    public function commentsCount()
    {
        return $this->comments()->count();
    }

}
