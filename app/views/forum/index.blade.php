@extends('layouts.master')

@section('content')

@if(Sentry::check())
<a href="/forum/create" class="btn btn-primary">Create a Topic</a>
@endif


@foreach($topics as $topic)
<h2>{{$topic->title}}</h2>
<p>{{$topic->body}}</p>
@endforeach

@stop