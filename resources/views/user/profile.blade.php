@extends('app')

{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

{{-- Content --}}
@section('content')

<div class="container-fluid">

    <div class="col-md-12 main-section profile">

    	<div class="row userInfo">
            <h2>{{$user->name}} Profile</h2>

                <div class="col-md-6">
        	         <div class="pull-left">

                         <img src="{{Helper::makeAvatar($user->profile_picture)}}">
        	         </div>
                    <div class="pull-left userInfo">
                        <h3>{{$user->name}}</h3>
                         @if($user->Feedback()->first())
                        <h4>Feedback:  {{$user->Feedback()->first()->getAverage($user->id)}}</h4>
                        @else
                        <h4>Feedback:  0%</h4>
                        @endif
                        @if($user->community()->first())
                        <h4>Community: {{$user->community()->first()->name}}, {{$user->community()->first()->state}}</h4>
                        @else
                          <h4>Community: N/A</h4>
                        @endif
                    </div>
                </div>

                <div class="col-md-6 counts">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>{{$user->countComments()}}</h2>
                            <h4>Comments</h4>
                        </div>
                        <div class="col-md-6">
                            <h2>{{$user->countPosts()}}</h2>
                            <h4>Posts</h4>
                        </div>
                    </div>
                </div>
        </div>


        <div class="col-md-5">
            <div role="tabpanel" class="tab-pane active row" id="posts">
                <h2><i class="fa fa-money"></i> Listings</h2>

                @if(sizeof($posts)==0)
                    <div class="post noPost">
                        <div class="pull-left">
                            <h2>No Posts</h2>
                        </div>
                    </div>

                @endif

                @foreach($posts as $post)
                    <div class="post clearfix row">
                        <div class="col-md-3">
                            <img src="/uploads/{{$post->photos()->first()->name}}">
                        </div>
                        <div class="col-md-9">
                            <h2>{{$post->title}}</h2>
                            <p>{{$post->body}}</p>
                            <p><i class="fa fa-clock-o"></i> {{$post->created_at->diffForHumans()}}</p>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>


        <div class="col-md-5 col-md-offset-2">
            
            <div role="tabpanel" class="tab-pane active" id="posts">
                <h2><i class="fa fa-commenting"></i> Comments</h2>

                @foreach($comments as $comment)
                    <div class="post clearfix col-md-12">
                        <div class="pull-left">
                            <h2>"{{$comment->body}}"</h2>
                            <h4>in... <a href="/{{$comment->post()->first()->community_id}}/post/{{$comment->post()->first()->id}}">{{$comment->post()->first()->title}}</a></h4>
                            <p><i class="fa fa-clock-o"></i> {{$comment->created_at->diffForHumans()}}</p>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </div>

</div>


@endsection