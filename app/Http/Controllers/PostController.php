<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Community;
use App\Comment;
use App\Media;
use App\City;
use App\Category;
use Storage;
use File;
use Auth;
use Form;
use Redirect;
use Validator;
use Illuminate\Support\Str;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
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
        $communitys = Community::all();
        $cities = City::all();
        $categories = Category::all();

        return view('posts.create',['communitys'=>$communitys,'categories'=>$categories, 'cities'=>$cities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
        'title' => 'required|max:90',
        'body' => 'required',
        'price' => 'required',
        'category'=>'required',
        'community' => 'required',
        'city' => 'required',
        ]);


        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;
        $post->price = $request->price;
        $post->category_id = $request->category;
        $post->community_id = $request->community;
        $post->city_id = $request->city_id;
        $post->save();


        $files = $request->file('filefield');
        foreach ($files as $file) {
            // Validate each file
                $file = $file;
                $name = time(). '-' .$file->getClientOriginalName();
                $upload_success = $file->move(public_path().'/uploads/', $name);
                $media = new Media();
                $media->name = $name;
                $media->post_id = $post->id;
                $media->save();
        }

        return Redirect('/')->with('message', 'Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($community,$id)
    {
        $post = Post::with('author','comments.author','community')->where('id',$id)->get();
        $comments = Comment::with('author')->where('post_id',$id)->get();
        $community = Community::where("id",$community)->get();
        return view('posts.show',['post' => $post, "comments"=>$comments,'community'=>$community]);
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



    public function search(Request $request)
    {


        $search = $request->search;
        if($request->category != 0)
        {
        $posts = Post::search($request->search)->where('sold',NULL)->where('category_id',$request->category)->get();
        }
        else
        {
        $posts = Post::search($request->search)->where('sold',NULL)->get();    
        }
        return view('posts.search',['posts' => $posts, 'search'=>Str::title($search)]);
    }

    
}
