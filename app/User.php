<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'community_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function Post()
    {
        return $this->hasMany('App\Post');
    }

    public function Comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function Community()
    {
        return $this->belongsTo('App\Community', 'community_id');
    }


    public function Feedback()
    {
        return $this->hasMany('App\Feedback','receiver_id');
    }

    public function countPosts()
    {
        return $this->Post()->count();
    }

    public function countComments()
    {
        return $this->Comment()->count();
    }
}
