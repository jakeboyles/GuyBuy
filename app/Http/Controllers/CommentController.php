<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\Offer;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
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
        
        if($request->offer!=='')
        {
            $offer = new Offer();
            $offer->price = $request->offer;
            $offer->post_id = $request->post_id;
            $offer->type = 1;
            $offer->user_id = Auth::user()->id;
            $offer->save();
        }
        

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;
         if($request->offer!==''){
            $comment->offer_id = $offer->id;
         }
        $comment->save();

        if($request->offer!=='')
        {
        $offer->comment_id = $comment->id;
        $offer->save();
        }

        $post = Post::where('id',$request->post_id)->get();

        return Redirect($post[0]->community_id.'/post/'.$request->post_id)->with('message', 'Post created');

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
