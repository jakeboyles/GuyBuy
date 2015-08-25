@extends('app')

{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

{{-- Content --}}
@section('content')


<div class="col-md-12 main-section">

	<h2>User Settings</h2>

	<div class=" col-md-12">
		<div>
			<div class="row">
				<div class="col-md-12">
					<form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ URL::to('/user/update') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
 @include('errors.list')
                            <div class="form-group">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name"
                                           value="{{{ Input::old('name', isset($user) ? $user->name : null) }}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{{ Input::old('email', isset($user) ? $user->email : null) }}}">
                                </div>
                            </div>

                            <br>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Home Community</label>

                                <div class="col-md-6">

                                {!! Form::select('community_id', $communities, $user->community_id, ['class'=>'selectAuto']) !!}


                  
                                </div>
                            </div>

                            <br>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Profile Picture</label>

                                <div class="col-md-4">
                                    <input type="file" name="filefield">
                                </div>

                                <div class='col-md-2'>
                                @if($user->profile_picture!=='null')
                                <img src="/avatars/{{$user->profile_picture}}">
                                @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Change Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Confirm Changed Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
				</div>
			</div>
		</div>
	</div>

</div>



@endsection