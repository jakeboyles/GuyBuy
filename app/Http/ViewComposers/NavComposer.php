<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Users\Repository as UserRepository;
use App\Offer;
use App\Category;
use Auth;

class NavComposer {

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if(Auth::check())
        {
            $offers = Offer::where('post_creator',Auth::user()->id)->whereHas('post', function($q){ $q->where('sold', NULL);})->orderBy('created_at', 'desc')->count();   
   
        }
        else
        {
            $offers = "";
        }
        $categories = Category::all();
        $view->with(['categories'=> $categories, 'offers'=>$offers]);
    }

}