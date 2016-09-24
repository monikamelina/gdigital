@extends('layouts.app')

@section('content')
	{{ Form::open( ['route' => ['user.store', $user->id], 'method' => 'POST']) }}
     	@include('admin._form')
    {{ Form::submit('Create the User!', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}
@stop