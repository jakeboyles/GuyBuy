<?php namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Community;
use App\City;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CityController extends Controller {

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



	public function showPosts($city)
    {
    	$communities = Community::where('city_id',$city)->get();
    	$posts = Post::with('author','comments.author','community')->where('sold',NULL)->orderBy('created_at', 'desc')->where('city_id',$city)->paginate(12);
    	$city = City::where('id',$city)->get();
        return view('city.home',['posts' => $posts,'city'=>$city, 'communities'=>$communities]);
    }



    public function choose(Request $request)
    {
    	return Redirect('/city/'.$request->communties);
    }


    public function filter(Request $request)
    {

    	$allCommunities = $request->communities;
    	$communities = Community::where('city_id',$request->city)->get();
    	$requestedInfo = $request;

    	if($request->from=='' || $request->from == 0)
    	{
    		$request->from = 99999999999999999.00;
    	}

    	if(sizeof($allCommunities)>0)
    	{
    		$posts = Post::with('author','comments.author','community')->where('sold',NULL)->whereBetween('price', array( $request->to , $request->from))->whereIn('community_id', $allCommunities)->where('city_id',$request->city)->paginate(12);

    	}
    	else
    	{
    		$posts = Post::with('author','comments.author','community')->where('sold',NULL)->whereBetween('price', array( $request->to , $request->from))->where('city_id',$request->city)->paginate(12);

    	}
    	$city = City::where('id',$request->city)->get();
        return view('city.home',['posts' => $posts,'city'=>$city, 'communities'=>$communities,'request'=>$requestedInfo]);    
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