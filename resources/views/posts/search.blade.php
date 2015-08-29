@extends('app')

{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

{{-- Content --}}
@section('content')

<!-- <div class="col-md-3">
</div>
 -->
<div class="container-fluid">

	<div class="col-md-12 main-section search">

		<h2>{{$search}} Listings</h2>


		@if(sizeOf($posts)==0)
		<div class="homePost noPost col-md-4">
			<div>
				<div class="row">
					<div class="col-md-12">
						<h2>No Listings Yet!</h2>
						<h4>How About You Add One?</h4>
					</div>
				</div>
			</div>
		</div>
		@endif
		

		@foreach ($posts as $post)
		<div class="homePost col-md-3">
			<div>
				<div class="row">
					<div class="col-md-12">
						<a href="/{{$post->community()->first()->id}}/post/{{$post->id}}"><img src="/uploads/{{$post->photos()->first()->name}}"></a>
					</div>

					<div class="col-md-12">
					<h4><a href="/{{$post->community()->first()->id}}/post/{{$post->id}}">{{$post->title}}</a></h4>
					<h4>${{$post->price}}</h4>

					
					<p class="bodyText">{{$post->body}}</p>

					<p class="commentCount pull-left">{{$post->commentsCount()}} <i class="fa fa-comments"></i></p>
					<p class="pull-right"><i class='fa fa-home'></i> {{$post->community()->first()->name}}, {{$post->community()->first()->state}}</p>
			<!-- 		<p>{{$post->author()->first()->name}} in {{$post->community()->first()->name}}, {{$post->community()->first()->state}}</p>
			 -->		</div>
				</div>
			</div>
		</div>
		@endforeach


	</div>

</div>


@endsection