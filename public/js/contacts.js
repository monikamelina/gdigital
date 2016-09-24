$(document).ready(function() {

    // =Contact's Datatable
    $datatable = $("#contact-datatable");
    
    // =Dynamic Contact's form fields
    var maxField    = 5;
    var minField    = 1; 
    $fieldwrapper   = $('#fieldwrapper');
    $addModal       = $("#add-modal");
    $delModal       = $("#del-modal");
    $addEditForm    = $('#add-form')
    $delForm        = $('#del-form');

    $datatable.DataTable({
        processing: true,
        serverSide: true,
        ajax: 'datatables/data',
        responsive: {
            details: {
                renderer: function ( api, rowIdx, columns ) {
                    var data = $.map( columns, function ( col, i ) {
                        if(col.hidden){
                            // Create Table with extra fields
                            var html = '';
                            $.each(col.data,function (index, field) {
                             html += '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td>'+field.name+':'+'</td> '+
                                '<td>'+field.value+'</td>'+
                            '</tr>';
                            }); 
                            return html;
                        }else{
                            return '';
                        }
                       
                    } ).join('');
 
                    return data ? $('<table/>', {class: 'more-info', width: '20%'}).append( data ) : false;
                }
            }
        },
        columns: [
            { data: 'id',       name: 'id',     "searchable": false },
            { data: 'name',     name: 'name',   "searchable": false },
            { data: 'surname',  name: 'surname' },
            { data: 'email',    name: 'email' },
            { data: 'phone',    name: 'phone' },
            { data: 'action',   name: 'action', orderable: false, searchable: false, 'class':'center'},
            { data: 'fields',   name: 'fields', "searchable": false,  },
            
        ]
    });

    
    // =Display Edit Modal
    $datatable.on('click', 'a.btn-edit', function() {
        
        var id = $(this).data('edit');
        minField    = 1;
        $fieldwrapper.empty();
        
        // Retrive data to edit
        $.getJSON($addEditForm.attr('action') +'/' + id, function(obj) {
            
            // Set fields value 
            $.each(obj, function(datakey, datavalue) {
                $addEditForm.find('input').each(function(key, value){
                    if( $(this).attr('name') == datakey) {
                        $(this).val(datavalue);
                    }
                });
            });

            // Set extra fields value
            $.each(obj.fields, function(index, field) {
                addfield(index, field);
            });

            $addModal.find("input[type='submit']").val('Update!');
            $addModal.find("h4.modal-title").text('Edit Contact');
            $addModal.modal("show");

        }).fail(function() { alert('Unable to fetch data, please try again later.') });
    });

    // =Display (Delete Contact) Modal
    $datatable.on('click', 'a.btn-del', function() {
        $("#del-id").val( $(this).data('remove'))
    });

    // =Display (Add new Contact) Modal
    $("#btn-add").click(function(){

        //Reset form and add default field
        $addEditForm[0].reset();
        $fieldwrapper.empty();    
        addfield(0);
        $('#fname').closest('.form-group').removeClass('has-error');
        $addModal.find("input[type='submit']").val('Save!');
        $addModal.find("h4.modal-title").text('Add New Contact');
        $addModal.modal("show");

    });

    // =Submit Form (Add/Edit)
    $addModal.validator().on('click', '.btn-submit', function(e){
        
        var firstName = $('#fname');
        if(!firstName.val()) {
            // Add errors highlight
            firstName.closest('.form-group').removeClass('has-success').addClass('has-error');
            e.preventDefault();
        }else {
          // Remove the errors highlight
          firstName.closest('.form-group').removeClass('has-error').addClass('has-success');
        }

        if (e.isDefaultPrevented()) {
            return false;
        }

        var url = $addEditForm.attr('action')
        var method = 'POST';

        if($(this).val()=='Update!'){
            url += '/' + $("#edit-id").val()
            method = 'PATCH' 
        }

        $.ajaxSetup({ header:$('meta[name="csrf-token"]').attr('content')});

        $.ajax({
            type: method,
            url:  url,
            data: $addEditForm.serialize(),
            success: function(data){
                if(data.status){
                    $addModal.modal('hide');  // On success close window
                } 
            },
            error: function(data){
                var errors = $.parseJSON(data.responseText);
                 $.each(errors, function(index, elem) {
                    console.log($("#"+elem))
                    $("#"+elem).closest('.form-group').removeClass('has-success').addClass('has-error');
                });
            }
        }).always(function (data) {
            $datatable.DataTable().draw(false);
        });
    });

    // = Submit Form (Delete)
    $delModal.on('click', '.btn-submit', function (e) { 
        
        e.preventDefault();

        $.ajaxSetup({
            header:$('meta[name="csrf-token"]').attr('content')
        });
       
        $.ajax({
            url: $delForm.attr('action')+'/'+$('#del-id').val(),
            type: 'DELETE',
            dataType: 'json',
            data: $delForm.serialize(),
            success: function(data){
                if(data.status){
                    $delModal.modal('hide');    // On success close window 
                }
            },
            error: function(data){
                if(!data.status){
                    alert(data.responseText);
                }
            }  
        }).always(function (data) {
            $datatable.DataTable().draw(false);
        });
    });   

    // Add new field
    $fieldwrapper.on('click', '.add_field', function(e){
       
        addfield(minField);

        if(minField<maxField){
            minField++
         } 
            
    });

    //Delete Field
    $fieldwrapper.on('click', '.del_field', function(e){ 
        e.preventDefault();
        $(this).closest('.input_fields_wrap').remove();
        minField--; 
    });


    function addfield(i, field){
        
        if(i >= maxField){ return;}

        name = value = id = '';
        
        if (field !== undefined) {
            id      = field.id
            name    = field.name
            value   = field.value
        }

        var html = '<div class="input_fields_wrap">'+
                           '<div class="col-md-5">'+
                            '<input type="text" name="field['+i+'][name]" value="'+name+'" placeholder="Field Name" autocomplete="off" class="input form-control" />'+
                          '</div>'+
                          '<div class="col-md-5">'+
                             '<input type="text" name="field['+i+'][value]" value="'+value+'" placeholder="Field Value" autocomplete="off" class="input form-control" />'+
                             '<input type="hidden" name="field['+i+'][id]" value="'+id+'"/>'+
                          '</div>'+
                          '<div class="col-md-2" style="text-align: left;">'+
                            '<button class="btn btn-sm btn-success add_field" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>';

            if(i){ html += '<button class="btn btn-sm btn-danger del_field" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button>';}

            html += '</div></div>';

        $fieldwrapper.append(html)             
    }

    // Validate Modal
    $('.modal').on('shown.bs.modal', function (e) {
        $(this).find('form').validator()
    });

    $('.modal').on('hidden.bs.modal', function (e) {
        $(this).find('form').off('submit').validator('destroy')
    });

});



  
