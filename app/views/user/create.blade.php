@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
:: Account Signup
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h1>Signup</h1>
</div>
{{{ Confide::makeSignupForm() }}}
@stop
