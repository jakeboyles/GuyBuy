@extends('app')

{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

{{-- Content --}}
@section('content')

<div class="container-fluid">

    <div class="col-md-12 main-section dashboard">

    	<h2>Dashboard</h2>

        <div class="col-md-3 dashboardSidebar">
            <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#offers" aria-controls="offers" role="tab" data-toggle="tab">Offers</a></li>
            <li role="presentation"><a href="#userSettings" aria-controls="userSettings" role="tab" data-toggle="tab">User Profile</a></li>
            <li role="presentation"><a href="#feedback" aria-controls="feedback" role="tab" data-toggle="tab">Feedback Received</a></li>
            <li role="presentation"><a href="#feedbackGiven" aria-controls="feedbackGiven" role="tab" data-toggle="tab">Feedback Given</a></li>
        </div>

    	<div class="tab-content col-md-9">



            <div role="tabpanel" class="tab-pane" id="feedback" class="feedbackGiven">
                <div class="col-md-12">

                    @if(sizeOf($feedbacks)==0)

                        <div class="offer noOffer col-md-12">

                        <div>
                            <h2>No Feedback</h2>
                            <p>You Currently Don't Have Any Feedback.</p>
                        </div>
                    </div>

                    @endif


                    @foreach($feedbacks as $feedback)
                    <div class="feedback col-md-12">

                        <div class="row">  
                        <div class="col-md-2">
                            <a href="/user/profile/{{$feedback->giver()->first()->id}}"><img src="{{Helper::makeAvatar($feedback->giver()->first()->profile_picture)}}"></a><br>
                        </div>
                        <div class="col-md-10">
                        <P>
                            @if($feedback->positive=='1')
                            <h4><i class="fa fa-thumbs-up"></i> Positive Feedback Received</h4>
                            @else
                            <h4><i class="fa fa-thumbs-down"></i> Negative Feedback Received</h4>
                            @endif
                            <a href="/{{$feedback->post()->first()->category_id}}/post/{{$feedback->post()->first()->id}}">{{$feedback->post()->first()->title}}</p></a>
                        </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>



            <div role="tabpanel" class="tab-pane" id="feedbackGiven" class="feedbackGiven">
                <div class="col-md-12">

                    @if(sizeOf($feedbacksGiven)==0)

                        <div class="offer noOffer col-md-12">

                        <div>
                            <h2>No Feedback</h2>
                            <p>You Currently Don't Have Any Feedback To Give.</p>
                        </div>
                    </div>

                    @endif


                    @foreach($feedbacksGiven as $feedbackSaved)
                    <div class="feedback col-md-12">

                        <div class="row">  
                        <div class="col-md-2">
                            <a href="/user/profile/{{$feedbackSaved->receiver()->first()->id}}"><img src="{{Helper::makeAvatar($feedbackSaved->receiver()->first()->profile_picture)}}"></a><br>
                        </div>
                        <div class="col-md-10">
                        <P>
                            @if($feedbackSaved->positive=='1')
                                <h4><i class="fa fa-thumbs-up"></i> Positive Feedback Left</h4>
                            @elseif($feedbackSaved->positive=='0')
                                <h4><i class="fa fa-thumbs-down"></i> Negative Feedback Left</h4>
                            @else
                               <h4>No Feedback Left Yet</h4>
                               <br>
                                <a href="/feedback/{{$feedbackSaved->id}}" class="btn-primary">Leave Feedback</a><br><br>
                            @endif

                            <a href="/{{$feedbackSaved->post()->first()->category_id}}/post/{{$feedbackSaved->post()->first()->id}}">{{$feedbackSaved->post()->first()->title}}
                            </p></a>

                        </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>





            <div role="tabpanel" class="tab-pane active" id="offers" class="offers">
                <div class="col-md-12">

                    @if(sizeOf($offers)==0)

                        <div class="offer noOffer col-md-12">

                        <div>
                            <h2>No Offers</h2>
                            <p>You Currently Don't Have Any Offers.</p>
                        </div>
                    </div>

                    @endif


                    @foreach($offers as $offer)
                    <div class="offer col-md-12">

                        <div class="pull-left">  
                            <a href="/user/profile/{{$offer->author()->first()->id}}"><img src="{{Helper::makeAvatar($offer->author()->first()->profile_picture)}}"></a><br>            
                        </div>

                        <div class="pull-left">
                            <h4>{{$offer->content}}</h4>
                            <p>Post: <a href="/{{$offer->post()->first()->category_id}}/post/{{$offer->post()->first()->id}}">{{$offer->post()->first()->title}}</a></p>
                            <p>{{$offer->created_at->diffForHumans()}}</p>

                            <form class="pull-left" role="form" method="POST" action="{{ URL::to('/offer/accept/'.$offer->id) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary acceptOffer">Accept Offer</button>
                            </form>

                            <form class="pull-left denyButton" role="form" method="POST" action="{{ URL::to('/offer/deny/'.$offer->id) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-primary acceptOffer">Deny Offer</button>
                            </form>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>


        	<div id="userSettings" role="tabpanel" class="tab-pane" class="userSettings">
        		<div class="row">
        			<div class="col-md-12">
        				<form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ URL::to('/user/update') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @include('errors.list')
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Name</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name"
                                               value="{{{ Input::old('name', isset($user) ? $user->name : null) }}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Email</label>

                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" value="{{{ Input::old('email', isset($user) ? $user->email : null) }}}">
                                    </div>
                                </div>

                                <br>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Home Community</label>

                                    <div class="col-md-6">

                                    {!! Form::select('community_id', $communities, $user->community_id, ['class'=>'selectAuto']) !!}


                      
                                    </div>
                                </div>

                                <br>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Profile Picture</label>

                                    <div class="col-md-4">
                                        <input type="file" name="filefield">
                                    </div>

                                    <div class='col-md-2'>
                                    @if($user->profile_picture!=='null')
                                    <img src="{{Helper::makeAvatar($user->profile_picture)}}">
                                    @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Change Password</label>

                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Confirm Changed Password</label>

                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
        			</div>
        		</div>
        	</div>

    	</div>

    </div>
</div>


@endsection