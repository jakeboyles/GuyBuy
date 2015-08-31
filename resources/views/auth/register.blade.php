@extends('app')

{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

{{-- Content --}}
@section('content')

<div class="container-fluid">

    <div class="col-md-12 main-section dashboard minContainer">

        <h2>Register</h2>

            @include('errors.list')

            <div class="col-md-6 facebookLogin">

                <p>Selling, buying and trading online can be a real pain. Not only can it take a good chunk of any of the money you will potentially make 
                but it can be dangerous too. Once you find the thing you are actually looking for you either have to hope the person selling it is an actual person, 
                or you have to buy it and pay for it before you can even see it. It's time for the process to change, let's make it better!</p>

                <a href="/facebook/login"><img src="/images/facebook.png"></a>
            </div>



            <form class="registerForm form-horizontal col-md-6" role="form" method="POST" action="{{ URL::to('/auth/register') }}">
            <h3><i class="fa fa-rocket"></i> Register For Free</h3>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                <div class="form-group">
                    <label class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name"
                               value="{{ old('name') }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-4 control-label">Email</label>

                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Confirm Password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

