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


	<div class="why clearfix">
		<div class="whyContent col-md-8 col-md-offset-2">
		<h2>Why Use <span>BuysGuys?</span></h2>
			<div class="row">

				<div class="col-md-4 whySection">
					<img src="/images/home1.png">
					<h4><span class="red">Find</span> What You Want.</h4>
					<p>No more digging through clothes and bows to find what you want!</p>
				</div>

				<div class="col-md-4 whySection">
					<img src="/images/home2.jpg">
					<h4><span class="red">Get</span> It Now.</h4>
					<p>UPS and Fedex take forever, get what you want today!</p>
				</div>

				<div class="col-md-4 whySection">
					<img src="/images/home3.jpg">
					<h4><span class="red">Save</span> Cash.</h4>
					<P>Barter and negotiate to get a price that you both like.</P>
				</div>

			</div>
		</div>
	</div>


<div class="listings container-fluid clearfix">
	<div class="col-md-6">
		<h3><i class="fa fa-newspaper-o"></i> Recent Listings</h3>

		@if(sizeOf($posts)==0)
		<div class="homePost">
			<div class="row">
				<div class="col-md-9">
				<h4>No Listings</h4>
				<h5>How About You <a href="/post/create">Add One?</a></h5>
				</div>
			</div>
		</div>
		@endif

		@foreach ($posts as $post)
		<div class="homePost">
			<div class="row">
				<div class="col-md-3">
					<a href="/{{$post->community()->first()->id}}/post/{{$post->id}}"><img src="uploads/{{$post->photos()->first()->name}}"></a>
				</div>

				<div class="col-md-9">
				<h4><a href="/{{$post->community()->first()->id}}/post/{{$post->id}}">{{$post->title}}</a> <span class="pull-right">${{$post->price}}</span></h4>
				
				<p class="bodyText">{{str_limit($post->body,90)}}</p>

				<p class="commentCount pull-left">{{$post->commentsCount()}} <i class="fa fa-comments"></i></p>
				<p class="commentCount pull-right"><i class="fa fa-home"></i> {{$post->community()->first()->name}}, {{$post->community()->first()->state}}</p>

		<!-- 		<p>{{$post->author()->first()->name}} in {{$post->community()->first()->name}}, {{$post->community()->first()->state}}</p>
		 -->		</div>
			</div>
		</div>
		@endforeach
	</div>

	<div class="col-md-5 col-md-offset-1">
		<h3><i class="fa fa-thumbs-up"></i> Most Popular Listings</h2>

		@if(sizeOf($mostPopular)==0)
		<div class="homePost">
			<div class="row">
				<div class="col-md-9">
				<h4>No Listings</h4>
				<h5>How About You <a href="/post/create">Add One?</a></h5>
				</div>
			</div>
		</div>
		@endif


		@foreach ($mostPopular as $post)
		<div class="homePost">
			<div class="row">
				<div class="col-md-3">
					<a href="/{{$post->community()->first()->id}}/post/{{$post->id}}"><img src="uploads/{{$post->photos()->first()->name}}"></a>
				</div>

				<div class="col-md-9">
				<h4><a href="/{{$post->community()->first()->id}}/post/{{$post->id}}">{{$post->title}}</a> <span class="pull-right">${{$post->price}}</span></h4>
				
				<p class="bodyText">{{str_limit($post->body,90)}}</p>

				<p class="commentCount pull-left">{{$post->commentsCount()}} <i class="fa fa-comments"></i></p>
				<p class="commentCount pull-right"><i class="fa fa-home"></i> {{$post->community()->first()->name}}, {{$post->community()->first()->state}}</p>

		<!-- 		<p>{{$post->author()->first()->name}} in {{$post->community()->first()->name}}, {{$post->community()->first()->state}}</p>
		 -->		</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
</div>


@endsection