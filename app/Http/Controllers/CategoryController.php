<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Category;
use App\City;
use App\Community;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller {

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



	public function showPosts($community,$category)
    {
    	$posts = Post::with('author','comments.author','community')->where('sold',NULL)->where('category_id',$category)->where('community_id',$community)->paginate(12);
    	$category = Category::where('id',$category)->get();
    	$community = Community::where("id",$community)->get();
    	$city = City::where('id',$community[0]->city_id)->get();
    	$communities = Community::all();
        return view('category.home',['posts' => $posts,'category'=>$category,'community'=>$community,'city'=>$city,"communities"=>$communities]);
    }


    public function showCityPosts($city,$category)
    {
    	$posts = Post::with('author','comments.author','community')->where('sold',NULL)->where('category_id',$category)->where('city_id',$city)->paginate(12);
    	$category = Category::where('id',$category)->get();
    	$community = City::where("id",$city)->get();
    	$communities = Community::all();
    	$city = $community;
        return view('category.home',['posts' => $posts,'category'=>$category,'community'=>$community,'city'=>$city,'communities'=>$communities]);
    }


    public function filter(Request $request)
    {

        $allCommunities = $request->communities;
    	$communities = Community::where('city_id',$request->city)->get();
    	$requestedInfo = $request;
    	$category = Category::where('id',$request->category)->get();
    	$community = Community::where("id",$request->community)->get();

    	if($request->from=='' || $request->from == 0)
    	{
    		$from = 99999999999999999.00;
    	}
    	else
    	{
    		$from = $request->from;
    	}

    	if(sizeof($allCommunities)>0)
    	{
    		$posts = Post::with('author','comments.author','community')->where('category_id',$request->category)->where('sold',NULL)->whereBetween('price', array( $request->to , $from))->whereIn('community_id', $allCommunities)->where('city_id',$request->city)->paginate(12);

    	}
    	else
    	{
    		$posts = Post::with('author','comments.author','community')->where('category_id',$request->category)->where('sold',NULL)->whereBetween('price', array( $request->to , $from))->where('city_id',$request->city)->paginate(12);

    	}
    	$city = City::where('id',$request->city)->get();
        return view('category.home',['posts' => $posts,'category'=>$category,'city'=>$city, 'communities'=>$communities,'request'=>$requestedInfo,'community'=>$community]); 
    }






    public function cityFilter(Request $request)
    {

        $allCommunities = $request->communities;
    	$communities = Community::where('city_id',$request->city)->get();
    	$requestedInfo = $request;
    	$category = Category::where('id',$request->category)->get();
    	$community = City::where("id",$request->city)->get();


    	if($request->from=='' || $request->from == 0)
    	{
    		$from = 99999999999999999.00;
    	}
    	else
    	{
    		$from = $request->from;
    	}

    	if(sizeof($allCommunities)>0)
    	{
    		$posts = Post::with('author','comments.author','community')->where('category_id',$request->category)->where('sold',NULL)->whereBetween('price', array( $request->to , $from))->whereIn('community_id', $allCommunities)->where('city_id',$request->city)->paginate(12);

    	}
    	else
    	{
    		$posts = Post::with('author','comments.author','community')->where('category_id',$request->category)->where('sold',NULL)->whereBetween('price', array( $request->to , $from))->where('city_id',$request->city)->paginate(12);

    	}
    	$city = City::where('id',$request->city)->get();
        return view('category.home',['posts' => $posts,'category'=>$category,'city'=>$city, 'communities'=>$communities,'request'=>$requestedInfo,'community'=>$community]); 
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