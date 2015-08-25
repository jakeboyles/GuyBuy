<div class="sidebar clearfix">
	<h2>Categories</h2>
	<ul>

	@foreach($categories as $categoryNames)
		<li><a href="/{{$community[0]->id}}/category/{{$categoryNames->id}}">{{$categoryNames->name}}</a></li>
	@endforeach
	</ul>

	@if (Request::segment(2) !== 'post' && Request::segment(2) !== 'category' && Request::segment(1) != 'category')
			<hr>
		<h2>Pricing</h2>

		<div class="pricing">

		<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST"  action="{{ URL::to('/community/filter') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="col-md-5">
				<span>$</span><input name="to" type="text"> 
			</div>

			<div class="to col-md-1"><span>to</span></div>

			<div class="col-md-5">
				<span>$</span><input name="from" type="text"> 
			</div>

			<input type="hidden" value="{{$community[0]->id}}" name="community">


			<button class="btn btn-primary">Filter Results</button>
		</form>

		</div>

	@endif



	@if (Request::segment(2) == 'category' || Request::segment(1) == 'category' )

			<hr>

		<h2>Pricing</h2>

		<div class="pricing">

		<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST"  action="{{ URL::to('/category/filter') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="col-md-5">
				<span>$</span><input name="to" type="text"> 
			</div>

			<div class="to col-md-1"><span>to</span></div>

			<div class="col-md-5">
				<span>$</span><input name="from" type="text"> 
			</div>

			<input type="hidden" value="{{$community[0]->id}}" name="community">
			<input type="hidden" value="{{$category[0]->id}}" name="category">


			<button class="btn btn-primary">Filter Results</button>
		</form>

		</div>

	@endif





</div>