@extends('app')

{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

{{-- Content --}}
@section('content')

<div class="container-fluid">

	<div class="col-md-3">
	    @include('partials.sidebar')
	</div>


	<div class="col-md-9 main-section">

		<h2>{{$category[0]->name}} Listings in {{$community[0]->name}},{{$community[0]->state}}</h2>

		@if(sizeOf($posts)==0)
		<div class="homePost noPost col-md-4">
			<div>
				<div class="row">
					<div class="col-md-12">
						<h2>No Listings Yet!</h2>
						<h4>How About You <a href="/post/create">Add One</a>?</h4>
					</div>
				</div>
			</div>
		</div>
		@endif

		@foreach ($posts as $post)
		<div class="homePost col-md-4">
			<div>
				<div class="row">
					<div class="col-md-12">
						<div class="mainPhoto">
							<a href="/{{$post->community()->first()->id}}/post/{{$post->id}}"><img src="/uploads/{{$post->photos()->first()->name}}"></a>
						</div>
					</div>

					<div class="col-md-12">
					<h4><a href="/{{$post->community()->first()->id}}/post/{{$post->id}}">{{$post->title}}</a></h4>
					<h4>${{$post->price}}</h4>
					
					<p class="bodyText">{{str_limit($post->body,90)}}</p>

					<p class="commentCount pull-left">{{$post->commentsCount()}} <i class="fa fa-comments"></i></p>
			<!-- 		<p>{{$post->author()->first()->name}} in {{$post->community()->first()->name}}, {{$post->community()->first()->state}}</p>
			 -->		</div>
				</div>
			</div>
		</div>
		@endforeach

		<div class="col-md-12">
			<?php echo $posts->render(); ?>
		</div>

	</div>
</div>


@endsection