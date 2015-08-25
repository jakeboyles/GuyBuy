@extends('app')

{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

{{-- Content --}}
@section('content')

<div class="home">
	<div class="photo">
		<div class="container-fluid">
			<div class="col-md-7 col-md-offset-4">
			<h2>Need a new beer sign?</h2>
			<h2>Selling that old pac man game?</h2> 
			<h4>You're in the right place.</h4>
			<form class="form-horizontal" role="form" method="POST" action="{{ URL::to('/community/choose') }}">
			 <input type="hidden" name="_token" value="{{ csrf_token() }}">
			<select placeholder="Where Do You Live?" data-placeholder="Where Do You Live?" class="selectAuto" name="communties">
			<option></option>
			@foreach($communities as $community)
				<option value="{{$community->id}}">{{$community->name}},{{$community->state}}</option>
			@endforeach
			</select>
			<button class="btn btn-primary"><i class="fa fa-search"></i> Find Listings</button>
			</form>
			</div>
		</div>
	</div>



	<div class="col-md-6">
		<h3>Recent Listings</h2>
		@foreach ($posts as $post)
		<div class="homePost">
			<div class="row">
				<div class="col-md-3">
					<a href="/{{$post->community()->first()->id}}/post/{{$post->id}}"><img src="uploads/{{$post->photos()->first()->name}}"></a>
				</div>

				<div class="col-md-9">
				<h4><a href="/{{$post->community()->first()->id}}/post/{{$post->id}}">{{$post->title}}</a> <span class="pull-right">${{$post->price}}</span></h4>
				
				<p class="bodyText">{{$post->body}}</p>

				<p class="commentCount pull-left">{{$post->commentsCount()}} <i class="fa fa-comments"></i></p>
				<p class="commentCount pull-right"><i class="fa fa-home"></i> {{$post->community()->first()->name}}, {{$post->community()->first()->state}}</p>

		<!-- 		<p>{{$post->author()->first()->name}} in {{$post->community()->first()->name}}, {{$post->community()->first()->state}}</p>
		 -->		</div>
			</div>
		</div>
		@endforeach
	</div>

	<div class="col-md-5 col-md-offset-1">
		<h3>Most Popular Listings</h2>
		@foreach ($mostPopular as $post)
		<div class="homePost">
			<div class="row">
				<div class="col-md-3">
					<a href="/{{$post->community()->first()->id}}/post/{{$post->id}}"><img src="uploads/{{$post->photos()->first()->name}}"></a>
				</div>

				<div class="col-md-9">
				<h4><a href="/{{$post->community()->first()->id}}/post/{{$post->id}}">{{$post->title}}</a> <span class="pull-right">${{$post->price}}</span></h4>
				
				<p class="bodyText">{{$post->body}}</p>

				<p class="commentCount pull-left">{{$post->commentsCount()}} <i class="fa fa-comments"></i></p>
				<p class="commentCount pull-right"><i class="fa fa-home"></i> {{$post->community()->first()->name}}, {{$post->community()->first()->state}}</p>

		<!-- 		<p>{{$post->author()->first()->name}} in {{$post->community()->first()->name}}, {{$post->community()->first()->state}}</p>
		 -->		</div>
			</div>
		</div>
		@endforeach
	</div>
</div>



@endsection