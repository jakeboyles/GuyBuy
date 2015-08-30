<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\Offer;
use App\User;
use Auth;
use Socialize;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FacebookController extends Controller
{
    
    public function redirectToProvider()
    {
        return Socialize::with('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $fbuser = Socialize::with('facebook')->user();


        $token = $fbuser->token;
        //$tokenSecret = $fbuser->tokenSecret;

        $uid = $fbuser->id;
        $user = User::firstOrCreate([
            'uid' => $uid
        ]);



        if(!empty($user->name))
        {
            Auth::login($user);
            return Redirect('/admin/dashboard')->with('message', 'User Saved');
        }
        else
        {
            $user->name = $fbuser->getName();
            $user->profile_picture = $fbuser->getAvatar();
            $user->email = $fbuser->getEmail();

            $user->save();

            Auth::login($user);

            return Redirect('/admin/dashboard')->with('message', 'User Saved');
        }

    }
}
