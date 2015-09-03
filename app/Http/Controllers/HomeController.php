<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Community;
use App\User;
use App\Comment;
use App\Media;
use App\City;
use App\Category;
use App\Feedback;
use App\Offer;
use Storage;
use File;
use Auth;
use Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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

		$posts = Post::with('author','comments.author','community')->where('sold',NULL)->orderBy('created_at', 'desc')->take(4)->get();   
		$mostPopular = Post::with('author','comments.author','community')->where('sold',NULL)->take(4)->get(); 
		$communities = Community::all();
		$cities = City::all();


		return view('pages.home',['posts'=>$posts, 'mostPopular'=>$mostPopular,'communities'=>$communities,'cities'=>$cities]);
	}



	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		$user = User::find(Auth::user()->id);
		$communitys = Community::all() ->lists('name', 'id');
		$feedbacksGiven = Feedback::where('giver_id',Auth::user()->id)->get();
		$feedbacks = Feedback::where('receiver_id',Auth::user()->id)->get();
		$activePosts = Post::where('user_id',Auth::user()->id)->where('sold',null)->get();
		$offers = Offer::where('post_creator',Auth::user()->id)->whereHas('post', function($q){ $q->where('sold', NULL);})->orderBy('created_at', 'desc')->get();   
		return view('pages.dashboard',['user'=>$user, 'communities'=>$communitys,'offers'=> $offers,'feedbacks'=>$feedbacks,'activePosts'=> $activePosts, 'feedbacksGiven'=>$feedbacksGiven]);
	}


	public function updateUser(Request $request)
	{

		$this->validate($request, [
        'email' => 'required|email|unique:users,email,'.Auth::user()->id,
        'name' => 'required',
        ]);

		$name = null;
        if($request->hasFile('filefield')) {
            $file = $request->file('filefield');
            $name = time(). '-' .$file->getClientOriginalName();
            $file->move(public_path().'/avatars/', $name);
        }

        $user = User::find(Auth::user()->id);

        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->name = $request->name;
        $user->community_id = $request->community_id;

        if(!empty($file))
        {
            $user->profile_picture = $name;
        }

        $user->save();

        return Redirect('/')->with('message', 'User Saved');
	}

}