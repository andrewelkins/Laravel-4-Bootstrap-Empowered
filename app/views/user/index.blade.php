@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
:: Account
@stop

{{-- New Laravel 4 Feature in use --}}
@section('styles')
@parent
body {
	background: #f2f2f2;
}
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h1>Your settings</h1>
</div>

<table class="table table-hover">
    <tbody>
    <tr>
        <td>User Id</td>
        <td>{{$user->id}}</td>
    </tr>
    <tr>
        <td>Username</td>
        <td>{{$user->username}}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>{{$user->email}}</td>
    </tr>
    </tbody>
</table>
@stop
