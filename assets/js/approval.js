$(document).ready(function() {				
	$(".select2").select2();
	 $('#limit').select2();

	 $('#btnadd').click(function(){
        var $btn = $(this).button('loading');
        $('#formadd').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: 'approval_khusus/add',
                data: $('#formadd').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

     $("#bu").change(function() {
        var id = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'approval/get_table',
            data: {id : id},
            success: function(data) {
                $('#table').html(data);
            }
        });
    })
    .change(); 


});

function edit(form_id){
    var bu = $('#bu option:selected').val();
    $('#formEdit')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "approval/get_modal/" + bu + '/' + form_id,
        type: "GET",
        //dataType: "JSON",
        success: function(data)
        {
//alert(data);
            //var dat = "P0586";
            $('[name="id"]').val(bu);
            $('[name="form_type_id"]').select2().select2('val',form_id);
            $("#nik").select2().select2('val',data);
            //$('[name="nik"]').select2().select2('val',form_id);
            $('#editModal').modal('show'); // show bootstrap modal when complete loaded

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url = "approval/update"
    $.ajax({
        url : url,
        type: "POST",
        data: $('#formEdit').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#editModal').modal('hide');
                location.reload();
            }


        $('#btnSave').text('save'); //change button text
        $('#btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');

        $('#btnSave').text('save'); //change button text
        $('#btnSave').attr('disabled',false); //set button enable 
        }

    });
}