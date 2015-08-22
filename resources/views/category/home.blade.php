@extends('app')

{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

{{-- Content --}}
@section('content')

<div class="col-md-3">
    @include('partials.sidebar')
</div>


<div class="col-md-9 main-section">

	<h2>{{$category[0]->name}} Listings in {{$community[0]->name}},{{$community[0]->state}}</h2>

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
				
				<p class="bodyText">{{$post->body}}</p>

				<p class="commentCount pull-left">{{$post->commentsCount()}} <i class="fa fa-comments"></i></p>
		<!-- 		<p>{{$post->author()->first()->name}} in {{$post->community()->first()->name}}, {{$post->community()->first()->state}}</p>
		 -->		</div>
			</div>
		</div>
	</div>
	@endforeach

</div>



@endsection