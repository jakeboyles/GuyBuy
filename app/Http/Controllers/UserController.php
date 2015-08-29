<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Community;
use App\User;
use App\Comment;
use App\Media;
use App\Category;
use App\Feedback;
use Storage;
use File;
use Auth;
use Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller {

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
	public function showProfile($id)
	{

		$user= User::find($id);

		$posts= Post::where("user_id",$id)->get();

		$comments = Comment::where('user_id',$id)->get();


		return view('user.profile',['user'=>$user, 'comments'=>$comments, 'posts'=>$posts]);
	}


	public function leaveFeedback($id)
	{
		$feedback = Feedback::find($id);

		if($feedback->giver_id==Auth::user()->id && $feedback->positive==null)
		{
			return view('feedback.show',['feedback'=>$feedback]);
		}
		else
		{
			return Redirect('/auth/login');
    	}
		
	}


	public function storeFeedback(Request $request)
	{
		$feedback = Feedback::find($request->feedback_id);

		$feedback->positive = $request->positive;

		$feedback->save();

		return Redirect('/')->with('message', 'Feedback Has Been Saved, Thank You!');
    }
	


}