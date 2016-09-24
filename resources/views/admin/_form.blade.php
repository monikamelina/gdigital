<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('email', 'Email') }}
    {{ Form::email('email', null, array('class' => 'form-control ', $class)) }}
</div>
<div class="form-group">
    {{ Form::label('admin', 'Admin') }}
    {{ Form::checkbox('admin', null, array('class' => 'form-control')) }}
</div>