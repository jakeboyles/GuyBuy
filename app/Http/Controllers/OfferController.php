<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\Post;
use App\User;
use Auth;
use Mail;
use App\Feedback;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $offer = new Offer();
        $offer->post_id = $request->post_id;
        $offer->type = $request->type;
        $offer->content = $request->content;
        $offer->user_id = Auth::user()->id;

        $post = Post::find($request->post_id);

        $offer->post_creator =$post->user_id;
        $offer->save();

        $user = User::findOrFail($post->user_id);

        Mail::send('emails.offer', ['user' => $user, 'offer'=>$offer], function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('New Offer!');
        });

        return Redirect($post->community_id.'/post/'.$request->post_id)->with('message', 'Post created');
    }


    public function accept($id)
    {
        $offer = Offer::find($id);

        $post = Post::find($offer->post_id);

        $post->sold = $id;

        $post->save();

        $user = User::findOrFail($offer->user_id);

        $poster = User::findOrFail($offer->post_creator);

        $feedback_seller = new Feedback();
        $feedback_seller->post_id = $offer->post_id;
        $feedback_seller->giver_id = $offer->user_id;
        $feedback_seller->receiver_id = $offer->post_creator;
        $feedback_seller->type = 'seller';
        $feedback_seller->save();


        $feedback_buyer = new Feedback();
        $feedback_buyer->post_id = $offer->post_id;
        $feedback_buyer->giver_id = $offer->post_creator;
        $feedback_buyer->receiver_id = $offer->user_id;
        $feedback_buyer->type = 'buyer';
        $feedback_buyer->save();

        Mail::send('emails.offerAccepted', ['user' => $user, 'offer'=>$offer, 'poster'=>$poster, 'feedback'=>$feedback_buyer], function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Offer Accepted!');
        });

        Mail::send('emails.listingSold', ['user' => $user, 'offer'=>$offer, 'poster'=>$poster, 'feedback'=>$feedback_seller], function ($m) use ($user) {
            $m->to($poster->email, $poster->name)->subject('Listing Sold!');
        });

        return Redirect($post->community_id.'/post/'.$post->id)->with('message', 'Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
