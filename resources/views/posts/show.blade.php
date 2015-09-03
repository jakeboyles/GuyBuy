@extends('app')

{{-- Web site Title --}}
@section('title')  :: @parent @stop

{{-- Content --}}
@section('content')

<div class="container-fluid">

    <div class="col-md-3">
        @include('partials.sidebar')
    </div>


    <div class="col-md-9">
        <div class="postShow">
            @include('errors.list')
            <div class="row">
            <div class="col-md-3 clearfix">
            <img class="mainImage" src="/uploads/{{$post[0]->photos()->first()->name}}">
            @foreach($post[0]->photos as $photo)
            @if(sizeOf($post[0]->photos)>1)
                     <div class="smallPhoto">
                        <img src="/uploads/{{$photo->name}}">
                     </div>
            @endif
            @endforeach
            </div>
            <div class="col-md-9">
            <div class="row">
                <h2 class="col-md-12">{{$post[0]->title}}</h2>
                <h5 class="col-md-6"><span class="pull-left">${{$post[0]->price}}</span> <span class="pull-right"><i class="fa fa-home"></i> {{$post[0]->community()->first()->name}}, {{$post[0]->community()->first()->state}}</span></h5>
                <br>
                <p class="col-md-12">{{$post[0]->body}}</p>
            </div>

            @if(Auth::check())
            @if($post[0]->user_id != Auth::user()->id)
            <button type="button" data-toggle="modal" data-target="#modal" href="#commentPost" class="btn-primary btn"><i class="fa fa-shopping-cart"></i> Make Offer</button>
            @endif

            @else
            <a class="btn btn-primary" href="/auth/register"><i class="fa fa-shopping-cart"></i> Register to Buy</a>
            @endif

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
                            <a href="/user/profile/{{$comment->author()->first()->id}}"><img class="avatar" src="{{Helper::makeAvatar($comment->author()->first()->profile_picture)}}"></a>
                            </div>
                            <div class="col-md-10">
                                <h4>{{$comment->body}}</h4>
                                <p>{{$comment->created_at->diffForHumans()}}</p>
                            </div>
                        </div>
                    @endforeach
                @endif


                @if(!Auth::check() && sizeof($comments)==0)

                <h2><i class="fa fa-comments"></i> Comments</h2>
                <h4><a href="/auth/register">Register</a> to Post Comments</h4>

                @endif


                @if(Auth::check())
                <form role="form" id="commentPost" method="POST" action="{{ URL::to('/comment/store') }}">

                    <h3><i class="fa fa-plus"></i> Add Comment</h3>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label class="control-label">Comment *</label>

                        <div>
                            <textarea class="form-control" name="body" value="{{ old('body') }}"></textarea>
                        </div>
                    </div>


                    <input type="hidden" name="post_id" value="{{$post[0]->id}}">

                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary">
                                Post Comment
                            </button>
                        </div>
                    </div>
                </form>
                @endif

            </div>
        </div>
    </div>




    <div id="modal" class="modal fade">
             <form role="form" id="offerPost" method="POST" action="{{ URL::to('/offer/store') }}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Make Offer</h4>
          </div>
          <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <p>You can offer either a trade or a cash offer. Please enter your offer below.</p>
                    <label class="control-label">Offer *</label>
                    <input type="hidden" name="post_id" value="{{$post[0]->id}}">
                    <input type="hidden" name="type" value="offer">
                    <div>
                        <textarea class="form-control" name="content" value="{{ old('content') }}"></textarea>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary">Submit Offer</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
              </form>

    </div><!-- /.modal -->

</div>



@endsection

