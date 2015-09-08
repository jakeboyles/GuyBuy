@extends('app')

{{-- Web site Title --}}
@section('title') {{{ trans('Login') }}} :: @parent @stop

{{-- Content --}}
@section('content')

<div class="container-fluid">

    <div class="col-md-12 main-section dashboard login minContainer">

        <h2>Login</h2>
             @include('errors.list')

            <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('/auth/login') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail Address</label>

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
                    <div class="col-md-6 col-md-offset-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                                <br>

                                <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                    Login
                                </button>

                                <a href="{{ URL::to('/password/email') }}">Forgot Your Password?</a>

                            </div>

                            <div class='col-md-6'>
                                <a href="/facebook/login"><img src="/images/facebook.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>
@endsection