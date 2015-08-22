@extends('app')

{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

{{-- Content --}}
@section('content')

    <div>
        <div class="page-header">
            <h2>Create Post</h2>
        </div>
    </div>


    <div>

        @include('errors.list')

        <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST"  action="{{ URL::to('/post/store') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label class="col-md-4 control-label">Title</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="title"
                           value="{{ old('title') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Body</label>

                <div class="col-md-6">
                    <textarea class="form-control" name="body"
                           value="{{ old('body') }}"></textarea>
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-4 control-label">Image</label>

                <div class="col-md-6">
                    <input type="file" name="filefield">
                </div>
            </div>



            <div class="form-group">
                <label class="col-md-4 control-label">Category</label>

                <div class="col-md-6">
                    <select name="category" id="categories">
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-4 control-label">Community</label>

                <div class="col-md-6">
                     <select name="community">
                     @foreach($communitys as $community)
                      <option value="{{$community->id}}">{{$community->name}}</option>
                      @endforeach
                    </select> 
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Price</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="price"
                           value="{{ old('price') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection

