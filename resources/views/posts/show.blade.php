@extends('app')

{{-- Web site Title --}}
@section('title')  :: @parent @stop

{{-- Content --}}
@section('content')


<div class="col-md-3">
    @include('partials.sidebar')
</div>


<div class="col-md-9">
    <div class="postShow">
        @include('errors.list')
        <div class="row">
        <div class="col-md-3">
        <img src="/uploads/{{$post[0]->photos()->first()->name}}">
        </div>
        <div class="col-md-9">
        <h2>{{$post[0]->title}}</h2>
        <h4>${{$post[0]->price}}</h4>
        <p>{{$post[0]->body}}</p>
        </div>
        </div>

        <div class="commentSection">

            @if(sizeof($comments)>0)
                <h2><i class="fa fa-comments"></i> Comments</h2>

                @foreach($comments as $comment)
                    <div class="comment">
                        <h5>{{$comment->body}}</h5>
                        @if(!empty($comment->offer))
                        <h5>{{$comment->offer}}</h5>
                        @endif
                    </div>
                @endforeach
            @endif



            <form role="form" method="POST" action="{{ URL::to('/comment/store') }}">

                <h3><i class="fa fa-plus"></i> Add Comment or Offer</h3>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="control-label">Comment *</label>

                    <div>
                        <textarea placeholder="Have something to say?" class="form-control" name="body" value="{{ old('body') }}"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label">Offer</label>

                    <div>
                        <input placeholder="Money or Barter" type="text" class="form-control" name="offer" value="{{ old('offer') }}">
                    </div>
                </div>

                <input type="hidden" name="post_id" value="{{$post[0]->id}}">

                <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

