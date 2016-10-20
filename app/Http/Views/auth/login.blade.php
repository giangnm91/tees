@extends('layout.auth')
@section('content')	
	<div class="container">
	{!! Form::open(array('method' => 'post','id' => 'LoginForm', 'class' => 'form-signin' )) !!}
		{{ csrf_field() }}
	    <h2 class="form-signin-heading">@lang('auth.please_sign_in')</h2>
	    {!! Form::label('inputEmail', trans("auth.Email_address"), array('class' => 'sr-only')) !!}
	    {!! Form::text('email', null, array('id' => 'inputEmail','class' => 'form-control', 'placeholder' => trans("auth.Email_address"), 'required', 'autofocus')) !!}
	    {!! Form::label('inputPassword', trans("auth.Password"), array('class' => 'sr-only')) !!}
	    {!! Form::password('password', array('id' => 'inputPassword','class' => 'form-control', 'placeholder' => trans("auth.Password"), 'required')) !!}
	    <div class="checkbox">
	      <label>
	        {!! Form::checkbox('remember', 'remember-me') !!} @lang('auth.Remember_me')
	      </label>
	    </div>
	    <button type="submit" class="btn btn-lg btn-primary btn-block">@lang('auth.Sign_in')</button>
	{!! Form::close() !!}

	</div>
@stop
