@extends('layouts.master')

@section('content')

@if(Sentry::check())
<a href="/topic/create" class="btn btn-primary">Create a Topic</a>
@endif


@foreach($topics as $topic)
<h2><a href="/topic/{{$topic->slug}}/{{$topic->id}}">{{$topic->topic}}</a></h2>
<p>{{$topic->body}}</p>
@endforeach

@stop