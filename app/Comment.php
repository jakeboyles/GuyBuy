<?php

namespace App;
use App\Offer;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Comment extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body','author','price','offer'];


    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }

    public function offer()
    {
        return $this->hasOne('App\Offer','comment_id');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}