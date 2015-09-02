<div class="sidebar clearfix">
	<h2>Categories</h2>
	<ul>
		@foreach($categories as $categoryNames)
			<li><a href="/city/{{$city[0]->id}}/category/{{$categoryNames->id}}">{{$categoryNames->name}}</a></li>
		@endforeach
	</ul>

	@if (Request::segment(2) !== 'post' && Request::segment(2) !== 'category' && Request::segment(1) != 'category' && Request::segment(1) != 'city')
		<h2>Pricing</h2>

		<div class="pricing">

		<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST"  action="{{ URL::to('/community/filter') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="col-xs-5">
				<span>$</span><input class="money" name="to" type="text"> 
			</div>

			<div class="to col-xs-1"><span>to</span></div>

			<div class="col-xs-5">
				<span>$</span><input class="money" name="from" type="text"> 
			</div>

			<input type="hidden" value="{{$community[0]->id}}" name="community">


			<button class="btn btn-primary">Filter Results</button>
		</form>

		</div>

	@endif


	@if (Request::segment(1) == 'city' && Request::segment(3) != 'category' && Request::segment(2)!='category')
		<h2>Pricing</h2>


		<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST"  action="{{ URL::to('/city/filter') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        	<div class="pricing clearfix">
				<div class="col-xs-5">
					<span>$</span><input value="{{isset($request) ? $request->to : ''}}" class="money" name="to" type="text"> 
				</div>

				<div class="to col-xs-1"><span>to</span></div>

				<div class="col-xs-5">
					<span>$</span><input value="{{isset($request) ? $request->from : ''}}" class="money" name="from" type="text"> 
				</div>

				<input type="hidden" value="{{$city[0]->id}}" name="city">
			</div>

			<h2>Communities</h2>


				<select class="js-example-basic-multiple" data-placeholder="Filter By Community" name="communities[]" multiple="multiple">
					@foreach($communities as $community)
					  <option value="{{$community->id}}">{{$community->name}}</option>
					@endforeach
				</select>

			<br>
			<button class="btn btn-primary">Filter Results</button>
		</form>


	@endif



	@if ( (Request::segment(2) == 'category' && Request::segment(1) === 'city' && Request::segment(3)=="filter") || (Request::segment(1) == 'city' && Request::segment(3) =='category') )


		<h2>Pricing</h2>

		

		<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST"  action="{{ URL::to('/city/category/filter') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        	<div class="pricing clearfix">
				<div class="col-xs-5">
					<span>$</span><input name="to" class="money" type="text"> 
				</div>

				<div class="to col-xs-1"><span>to</span></div>

				<div class="col-xs-5">
					<span>$</span><input name="from" class="money" type="text"> 
				</div>

				<input type="hidden" value="{{$city[0]->id}}" name="city">
				<input type="hidden" value="{{$category[0]->id}}" name="category">
			</div>

			<h2>Communities</h2>

			<select class="js-example-basic-multiple" data-placeholder="Filter By Community" name="communities[]" multiple="multiple">
				@foreach($communities as $community)
				  <option value="{{$community->id}}">{{$community->name}}</option>
				@endforeach
			</select>

			<br>



			<button class="btn btn-primary">Filter Results</button>
		</form>

	@endif



	@if (Request::segment(1) == 'category' && Request::segment(2) == 'filter')
		<h2>Pricing</h2>

		<div class="pricing">

		<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST"  action="{{ URL::to('/community/filter') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="col-xs-5">
				<span>$</span><input class="money" name="to" type="text"> 
			</div>

			<div class="to col-xs-1"><span>to</span></div>

			<div class="col-xs-5">
				<span>$</span><input class="money" name="from" type="text"> 
			</div>

			<input type="hidden" value="{{$city[0]->id}}" name="community">


			<button class="btn btn-primary">Filter Results</button>
		</form>

		</div>

	@endif





</div>