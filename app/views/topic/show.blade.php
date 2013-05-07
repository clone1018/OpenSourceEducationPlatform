@extends('layouts.master')

@section('content')

<h2>{{$topic->topic}}</h2>
<p>{{$topic->body}}</p>

<hr>


@foreach($replies as $reply)
{{Sentry::getUserProvider()->findById($reply->user_id)->username}} says:
{{$reply->body}}

<hr><br>
@endforeach

@if(Sentry::check())
<h4>Your Response</h4>
{{Form::open(array('url' => '/topic/reply', 'method' => 'POST'))}}
<input type="hidden" name="topic_id" value="{{$topic->id}}"/>
<textarea name="body" id="responseBody" cols="30" rows="10"></textarea><br>
<input type="submit" class="btn btn-primary"/>
{{Form::close()}}
@endif

@stop