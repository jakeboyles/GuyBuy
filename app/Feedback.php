<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Feedback extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feedback';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['post_id', 'giver_id', 'receiver_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }

    public function giver()
    {
        return $this->belongsTo('App\User', 'giver_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\User', 'receiver_id');
    }

    public function getAverage($id)
    {
        $positive = $this->where('positive',1)->where('receiver_id',$id)->count();
        $negative = $this->where('positive',0)->where('receiver_id',$id)->count();
        return ($positive/($positive+$negative)*100)."%";
    }

}
