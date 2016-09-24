<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add New Contact</h4>
      </div>
      <div class="modal-body">
          {!! Form::open(['url'=>'/contact', 'method'=>'POST', 'id'=>'add-form', "data-toggle"=>"validator"]) !!}
            <input type="hidden" name="id" id="edit-id" value="">
            <div class="form-group">
              {!! Form::label('name', 'Name', []) !!}
              {!! Form::text('name', null, ['class'=>'form-control', 'autocomplete'=>'off', 'id'=>'fname', "required"=>"required", 'autofocus'=>'autofocus']) !!}
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              {!! Form::label('surname', 'Surname', []) !!}
              {!! Form::text('surname', null, ['class'=>'form-control', 'autocomplete'=>'off', 'id'=>'fsurname']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('email', 'Email', []) !!}
              {!! Form::email('email', null, ['class'=>'form-control', 'autocomplete'=>'off', 'id'=>'femail', "required"=>"required", "data-error"=>"Email address is invalid" ]) !!}
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              {!! Form::label('phone', 'Phone', []) !!}
              {!! Form::text('phone', null, ['class'=>'form-control','autocomplete'=>'off', 'fphone']) !!}
            </div>
            <div class="form-group">
              <div id="fieldwrapper" class="row"></div>
            </div>
          {!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <input class="btn btn-primary btn-submit" type="submit" value="Save!">
        <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="modal fade" id="del-modal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete Contact</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger">
          <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Are you sure you want to delete this Contact?
        </div>
        <form id="del-form" action="{{ url('/contact/delete') }}" method="POST" style="display: none;">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" id="del-id" value="">
            {{ csrf_field() }}
        </form>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-success btn-submit" ><i class="fa fa-check" aria-hidden="true"></i> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> No</button>
      </div>
    </div>
  <!-- /.modal-content --> 
  </div>
<!-- /.modal-dialog --> 
</div>      