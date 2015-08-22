<?php namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Community;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {

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

		$posts = Post::with('author','comments.author','community')->get();    
		$mostPopular = Post::with('author','comments.author','community')->get(); 
		$communities = Community::all();


		return view('pages.home',['posts'=>$posts, 'mostPopular'=>$mostPopular,'communities'=>$communities]);
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