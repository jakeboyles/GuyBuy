@extends('app')

{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

{{-- Content --}}
@section('content')

<div class="container-fluid">
	<div class="offers">
		<div class="col-md-12">
			<h2>Leave Feedback</h2>

			<p>Please leave feedback for your recent transaction of: <a href="/{{$feedback->post()->first()->category_id}}/post/{{$feedback->post()->first()->id}}">{{$feedback->post()->first()->title}}</a> with <a href="/user/profile/{{$feedback->receiver()->first()->id}}">{{$feedback->receiver()->first()->name}}</a></p>
			
			<form class="form-horizontal feedbackForm" enctype="multipart/form-data" role="form" method="POST" action="{{ URL::to('/feedback/store') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" value="{{$feedback->id}}" name="feedback_id">
			<h4>I would say I had a
				<select name="positive" class="form-control" id="categories">
	            	<option value="0">Negative</option>
	            	<option value="1">Positive</option>
	            </select>
	             experience.</h4>
	             <button class="btn btn-primary">Submit Feedback</button>
			</form>

		</div>
	</div>
</div>


@endsection