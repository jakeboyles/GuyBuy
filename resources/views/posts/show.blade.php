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
        <?php $i=0; ?>
        @foreach($post[0]->photos as $photo)
                @if($i !== 0)
                 <div class="smallPhoto">
                    <img src="/uploads/{{$photo->name}}">
                 </div>
                @endif
                <?php $i++; ?>
        @endforeach
        </div>
        <div class="col-md-9">
        <h2>{{$post[0]->title}}</h2>
        <h4>${{$post[0]->price}}</h4>
        <p>{{$post[0]->body}}</p>

        <a href="#commentPost" class="btn-primary btn">Make Offer</a>
        </div>
        </div>

        <div class="commentSection">

            @if(sizeof($comments)>0)
                <h2><i class="fa fa-comments"></i> Comments</h2>

                @foreach($comments as $comment)
                @if($comment->user_id == $post[0]->user_id)
                    <div class="comment author clearfix">
                @else
                     <div class="comment clearfix">
                @endif
                        <div class="col-md-2">
                        <a href="/user/profile/{{$comment->author()->first()->id}}"><img class="avatar" src="/avatars/{{$comment->author()->first()->profile_picture}}"></a>
                        </div>
                        <div class="col-md-10">
                            <h4>{{$comment->body}}</h4>
                              @if($comment->offer()->first())
                            <h5><i class="fa fa-star"></i> {{$comment->offer()->first()->price}}</h5>
                            @endif

                            <p>{{$comment->created_at->diffForHumans()}}</p>
                        </div>
                    </div>
                @endforeach
            @endif



            <form role="form" id="commentPost" method="POST" action="{{ URL::to('/comment/store') }}">

                <h3><i class="fa fa-plus"></i> Add Comment or Offer</h3>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="control-label">Comment *</label>

                    <div>
                        <textarea class="form-control" name="body" value="{{ old('body') }}"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label">Want to make an offer?</label>

                    <div>
                        <input placeholder="What are you offering?" type="text" class="form-control" name="offer" value="{{ old('offer') }}">
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

