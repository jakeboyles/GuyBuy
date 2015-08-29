<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Category;
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
        return view('category.home',['posts' => $posts,'category'=>$category,'community'=>$community]);
    }


    public function filter(Request $request)
    {
        $posts = Post::with('author','comments.author','community')->where('sold',NULL)->where('category_id',$request->category)->whereBetween('price', array( $request->to , $request->from))->where('community_id',$request->community)->get();
    	$category = Category::where('id',$request->category)->get();
    	$community = Community::where("id",$request->community)->get();
        return view('category.home',['posts' => $posts,'category'=>$category,'community'=>$community]);   
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