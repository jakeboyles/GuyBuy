<div class="sidebar clearfix">
	<h2>Categories</h2>
	<ul>

	@foreach($categories as $category)
		<li><a href="/{{$community[0]->id}}/category/{{$category->id}}">{{$category->name}}</a></li>
	@endforeach
	</ul>

	<h2>Pricing</h2>

	<div class="pricing">

		<div class="col-md-5">
			<span>$</span><input type="text"> 
		</div>

		<div class="to col-md-1"><span>to</span></div>

		<div class="col-md-5">
			<span>$</span><input type="text"> 
		</div>


		<a class="btn btn-primary">Filter Results</a>

	</div>


</div>