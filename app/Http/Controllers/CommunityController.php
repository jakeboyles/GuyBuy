<?php namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Community;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CommunityController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');

		//parent::__construct();

		//$this->news = $news;
		//$this->user = $user;
	}


	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{

		$posts = Post::with('author','comments.author','community')->where('sold',NULL)->get();    


		return view('pages.home')->with('posts',$posts);
	}



	public function showPosts($community)
    {
    	$posts = Post::with('author','comments.author','community')->where('sold',NULL)->orderBy('created_at', 'desc')->where('community_id',$community)->paginate(12);
    	$community = Community::where('id',$community)->get();
        return view('community.home',['posts' => $posts,'community'=>$community]);
    }



    public function choose(Request $request)
    {
    	return Redirect('/community/'.$request->communties);
    }


    public function city(Request $request)
    {
    	return Redirect('/city/'.$request->communties);
    }


    public function filter(Request $request)
    {

        $posts = Post::with('author','comments.author','community')->where('sold',NULL)->whereBetween('price', array( $request->to , $request->from))->where('community_id',$request->community)->paginate(12);
    	$community = City::where('id',$request->city)->get();
        return view('community.home',['posts' => $posts,'community'=>$community]);    
    }


	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function dashboard()
	{

		return view('pages.dashboard');
	}

}