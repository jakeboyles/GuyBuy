@extends('app')

@section('content')
<div class="container-fluid">
    <div class="col-md-12 main-section dashboard minContainer">

        <h2>Forgot Password</h2>
       
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @include('errors.list')

            <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('/password/email') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Send Password Reset Link
                        </button>
                    </div>
                </div>
            </form>
     </div>
</div>
@endsection
