@extends('app')

{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

{{-- Content --}}
@section('content')

<div class="offers">
	<div class="col-md-6">
		<h2>Recent Offers</h2>
		@foreach($offers as $offer)
		<div class="offer col-md-12">

			<div class="pull-left">
				<img src="/avatars/{{$offer->author()->first()->profile_picture}}"><br>
				<a href="#" class="btn btn-primary">Accept Offer</a>

			</div>

			<div class="pull-left">
				<h4>{{$offer->content}}</h4>

				<p>Post: <a href="/{{$offer->post()->first()->category_id}}/post/{{$offer->post()->first()->id}}">{{$offer->post()->first()->title}}</a></p>
				<p>{{$offer->created_at->diffForHumans()}}</a></p>
			</div>

		</div>
		@endforeach
	</div>

</div>



@endsection