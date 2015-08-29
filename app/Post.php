<?php

namespace App;
use Nicolaslopezj\Searchable\SearchableTrait;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Post extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, SearchableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    protected $searchable = [
        'columns' => [
            'title' => 10,
            'body' => 10,
        ]
    ];

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

    public function offers()
    {
        return $this->hasMany('App\Offer');
    }

    public function accepted()
    {
        return $this->hasOne('App\Offer','sold');
    }

    public function feedback()
    {
        return $this->hasMany('App\Feedback');
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
