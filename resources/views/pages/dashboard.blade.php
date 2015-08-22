@extends('app')

{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

{{-- Content --}}
@section('content')

<h3>Dashboard</h3>
<h4>Name</h4>
{{ Auth::user()->name }}
<h4>Email</h4>
{{ Auth::user()->email }}

<h3>Comments</h3>
{{ Auth::user()->countComments() }}


<h3>Posts</h3>
{{ Auth::user()->countPosts() }}




@endsection