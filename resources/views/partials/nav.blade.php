<nav class="container-fluid navbar">
<div class="row">

    <div class="col-md-3">
        <a class="logo" href="/"><img src="{{ asset('images/logo.png') }}"></a>
    </div>

    <div class="col-md-6 search">
        <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST"  action="{{ URL::to('/post/search') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="search" placeholder="I'm Looking For...">
            <select name="category" id="categories">
            <option value="0">All Categories</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
            </select>
            <input type="submit" class="search btn btn-primary" value="Search">
        </form>
    </div>

    <div class="collapse navbar-collapse col-md-3" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
<!--             <li class="{{ (Request::is('/') ? 'active' : '') }}">
                <a href="{{ URL::to('') }}"><i class="fa fa-home"></i> Home</a>
            </li> -->
        </ul>

        <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                <li class="{{ (Request::is('auth/login') ? 'active' : '') }}"><a href="{{ URL::to('auth/login') }}"><i
                                class="fa fa-sign-in"></i> Login</a></li>
                <li class="{{ (Request::is('auth/register') ? 'active' : '') }}"><a
                            href="{{ URL::to('auth/register') }}"><i class="fa fa-beer"></i> Register</a></li>
            @else

                @if($offers!=='')
                    <a class="offerLink" href="/admin/dashboard">
                    <li class="numOffers"><i class="fa fa-money"></i> {{$offers}}</li>
                    </a>
                @endif
                <li class="dropdown">
                    <a href="{{ URL::to('admin/dashboard') }}" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false"><i class="fa fa-user"></i> {{ Auth::user()->name }} <i
                                class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ URL::to('post/create') }}"><i class="fa fa-money"></i> Add Listing</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a>
                        </li>

                        <li>
                            <a href="{{ URL::to('auth/logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
    </div>
</nav>