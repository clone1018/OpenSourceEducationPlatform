@extends('layouts.master')

@section('content')

{{Form::open(array('url' => '/account/register', 'method' => 'POST'))}}
<div class="control-group">
    <label class="control-label" for="inputUsername">Username</label>
    <div class="controls">
        <input type="text" id="inputUsername" name="username" placeholder="Your Username">
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
        <input type="email" id="inputEmail" name="email" placeholder="Your Email">
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
        <input type="password" id="inputPassword" name="password" placeholder="Password">
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <button type="submit" class="btn">Register</button>
    </div>
</div>
{{Form::close()}}

@stop