@extends('layouts.app')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">{{ $user->name }}</h3>
  </div>
  <div class="panel-body">
    <p>
        <strong>Email:</strong> {{ $user->email }}<br>
        <strong>Level:</strong> {{ (($user->isAdmin()=="Yes")?"Administrator":"Normal User") }}
    </p><br>
    
	<div class="panel panel-default">
		<div class="panel-heading"><h3>Contact List</h3></div>
		<div class="panel-body">

		<div class="row" style="padding-bottom: 10px;">
		    <div class="col-md-3 center"><strong>Name</strong></div>
		    <div class="col-md-3 center"><strong>Surname</strong></div>
		    <div class="col-md-3 center"><strong>Email</strong></div>
		    <div class="col-md-3 center">&nbsp;</div>
		</div>
		@foreach ($contacts as $key => $contact)
			<div class="row top-line">
			    <div class="col-md-3 center">{{$contact->name}}</div>
			    <div class="col-md-3 center">{{$contact->surname}}</div>
			    <div class="col-md-3 center">{{$contact->email}}</div>
			    <div class="col-md-3 center">
			    	<a class="btn btn-primary btn-small" data-toggle="collapse" data-target="#collapse-{{$key}}" href="javascript:void(0);">
			    		<i class="fa fa-eye"></i>
			    	</a>
			    </div>
			</div>
			<div id="collapse-{{$key}}" class="row collapse">
				<div class="row">
					<div class="col-md-4 col-md-offset-1">
						<div class="row">
				    		<div class="col-md-6">
				    		@if (!$contact->fields->isEmpty())
				    			<table class="table">
				    				<thead>
				    					<tr>
					    					<th>Field name</th>
					    					<th>Field value</th>
					    				</tr>	
				    				</thead>
				    				<tbody>
				    					@foreach ($contact->fields as $field)
								       	<tr>
								       		<td>{{$field->name}}</td>
								       		<td>{{$field->value}}</td>
								       	</tr>
							       		@endforeach	
				    				</tbody>
						       </table>
				    		@endif
				    		</div>
				    	</div>
					</div>
				    <div class="col-md-7"></div>
				</div>
			</div>
		@endforeach
		</div>
	</div> 
	{{ $contacts->links() }}
  </div>
</div>
@stop