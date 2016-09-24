@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-1">
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h3 class="panel-title">Edit User</h3>
	        </div>
	       <div class="panel-body">
	    		<div class="row">
	    			<div class="col-md-6 col-md-offset-3">
	    				{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}
				   			@include('admin._form', ['class'=>'disabled="disabled" readonly="readonly"'])
				    		{{ Form::submit('Edit the User!', array('class' => 'btn btn-primary pull-right')) }}
						{{ Form::close() }}
	    			</div>
	    		</div>
	       </div>
       </div>
    </div>
</div>
@stop