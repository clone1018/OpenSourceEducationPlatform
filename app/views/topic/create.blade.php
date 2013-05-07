@extends('layouts.master')

@section('content')

{{Form::open(array('url' => '/topic', 'method' => 'POST'))}}
<div class="control-group">
    <label class="control-label" for="inputTitle">Topic Title</label>
    <div class="controls">
        <input type="text" id="inputTitle" name="topic" placeholder="Your Title">
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputBody">Body</label>
    <div class="controls">
        <textarea name="body" id="inputBody" cols="30" rows="10"></textarea>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <button type="submit" class="btn">Create Topic</button>
    </div>
</div>
{{Form::close()}}

@stop