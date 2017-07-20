var save_method; //for save method string
var table;

$(document).ready(function(){
	var url_ajax_list = $('#url_ajax_list').val();
	var url_ajax_add = $('#url_ajax_add').val();
	var url_ajax_edit = $('#url_ajax_edit').val();

  $("#date_start").datepicker({format: "yyyy-mm-dd", todayHighlight: true});
  $('#date_end').datepicker({format: "yyyy-mm-dd", todayHighlight: true});
  //$('.select2').select2();

	table = $('#table').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": url_ajax_list,
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],

      });

  $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

    $('#besar_biaya').maskMoney({precision: 0, allowZero:true});
});

function add()
{
  save_method = 'add';
  $('#form-competency')[0].reset(); // reset form on modals
  $('.form-group').removeClass('has-error'); // clear error class
  $('.help-block').empty(); // clear error string
  $('#modal_form').modal('show'); // show bootstrap modal
  $('.modal-title').text('Add'); // Set Title to Bootstrap modal title
}

function reload_table()
{
  table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
  $('#btnSave').text('saving...'); //change button text
  $('#btnSave').attr('disabled',true); //set button disable 
  
  var url_ajax_add = $('#url_ajax_add').val();
  var url_ajax_update = $('#url_ajax_update').val();
  var url;
  
  if(save_method == 'add') 
  {
      url = url_ajax_add;
  }
  else
  {
    url = url_ajax_update;
  }

   // ajax adding data to database
      $.ajax({
        url : url,
        type: "POST",
        data: $('#form-competency').serialize(),
        dataType: "JSON",
        success: function(data)
        {
           //if success close modal and reload ajax table
           /*$('#modal_form').modal('hide');
           reload_table();*/
           if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                $('#vendor_id').val(0);
                $('#training_type_id').val(0);
                $('#penyelenggara_id').val(0);
                $('#pembiayaan_id').val(0);
                $('#ikatan_dinas_id').val(0);
                $('#waktu_id').val(0);
                reload_table();
                //location.reload(false);
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert("Error adding / updating data");
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
        }
    });
}

function delete_(id)
{
  var url_ajax_delete = $('#url_ajax_delete').val();
  if(confirm('Are you sure delete this data?'))
  {
    // ajax delete data to database
      $.ajax({
        url : url_ajax_delete+"/"+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
           //if success reload ajax table
           $('#modal_form').modal('hide');
           reload_table();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error deleting data');
        }
    });
     
  }
}

function edit_(id)
{
  //alert('here');
  var url_ajax_edit = $('#url_ajax_edit').val();
  save_method = 'update';
  $('#form-competency')[0].reset(); // reset form on modals
  $('.form-group').removeClass('has-error'); // clear error class
  $('.help-block').empty(); // clear error string

  //Ajax Load data from ajax
  $.ajax({
    url : url_ajax_edit+"/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
        $('[name="id"]').val(data.id);
        $('[name="training_title"]').val(data.training_title);
        $('[name="training_deskripsi"]').val(data.description);
        $('[name="date_start"]').val(data.date_start);
        $('[name="date_end"]').val(data.date_end);
        $('[name="jam_mulai"]').val(data.jam_mulai);
        $('[name="jam_akhir"]').val(data.jam_akhir);
        $('[name="vendor_id"]').select2().select2('val',data.vendor_id);
        $('[name="training_type_id"]').select2().select2('val',data.training_type_id);
        $('[name="pembiayaan_id"]').select2().select2('val',data.pembiayaan_id);
        $('[name="penyelenggara_id"]').select2().select2('val',data.penyelenggara_id);
        $('[name="ikatan_dinas_id"]').select2().select2('val',data.ikatan_dinas_id);
        $('[name="waktu_id"]').select2().select2('val',data.waktu_id);
        $('[name="besar_biaya"]').val(data.besar_biaya);
        $('[name="tempat"]').val(data.tempat);
        $('[name="narasumber"]').val(data.narasumber);

        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit'); // Set title to Bootstrap modal title
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Error get data from ajax');
    }
});
}