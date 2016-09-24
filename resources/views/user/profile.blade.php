@extends('layouts.app')
@section('content')
  <div class="row">
    <div class="col-md-7 col-md-offset-2">
    {!! Form::model($user, ['url'=>'/profile','class'=>'form-horizontal', 'role'=>'form', 'method'=>'PUT', "id"=>'info-form', "data-toggle"=>"validator"]) !!}
        <fieldset>
          <legend>Info Details</legend>
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
               {!! Form::text('name', null, ['placeholder'=>'Name', 'class'=>'form-control', 'required'=>'required']) !!}
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
          </div>
          <!-- Text input-->
          <div class="form-group">
            {!! Form::label('email', 'Email', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
              {!! Form::text('email', null, ['placeholder'=>'Email', 'class'=>'form-control', 'disabled'=>'disabled', 'readonly'=>'readonly']) !!}
            </div>
          </div>
          <!-- Text input-->
          <div class="form-group">
          {!! Form::label('state', 'State', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('profile[state]', null, ['placeholder'=>'State', 'class'=>'form-control']) !!}
            </div>
            {!! Form::label('city', 'City', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('profile[city]', null, ['placeholder'=>'City', 'class'=>'form-control']) !!}
            </div>
          </div>
          <!-- Text input-->
          <div class="form-group">
          {!! Form::label('country', 'Country', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
              {!! Form::text('profile[country]', null, ['placeholder'=>'Country', 'class'=>'form-control']) !!}
            </div>
          </div>
          <div class="form-group">
            {!! Form::label('website', 'Website', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
              {!! Form::text('profile[website]', null, ['placeholder'=>'Website', 'class'=>'form-control']) !!}
            </div>
          </div>
          <div class="form-group">
            {!! Form::label('ocupation', 'Ocupation', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
              {!! Form::text('profile[ocupation]', null, ['placeholder'=>'Ocupation', 'class'=>'form-control']) !!}
              @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="pull-right">
                <a href="/" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </fieldset>
       {!! Form::close() !!}
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
@stop

@push('footer.page.level.scripts')
<script type="text/javascript">
  $('#info-form').validator()
</script>
@endpush