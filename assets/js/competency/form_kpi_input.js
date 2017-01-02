var base_url    = $("#base_url").val();
$(document).ready(function() {
    $(".select2").select2();
});

function addApprover(tableID){
    var table=document.getElementById(tableID);
    var rowCount=table.rows.length;
    $("#btnAddApprover").attr('disabled',true);
    $("#btnAddApprover").text('loading....');
    $.ajax({
        url: base_url+'competency/general/get_approver/'+rowCount,
        success: function(response){
            $("#"+tableID).find('tbody').append(response);
            $("#submit").show();	
            $("#btnAddApprover").attr('disabled',false);
            $("#btnAddApprover").text('Tambah Approver');
            $(document).find("select.select2").select2({
                dropdownAutoWidth : true
            });
         },
         dataType:"html"
    });
}

function addkpi(){
    var org_id = $("#org_id").val();
    $.ajax({
        url : base_url+'competency/form_kpi/add_kpi/'+org_id,
        type: "POST",
        success: function(data)
        {  
            $("#mapping-kpi").html(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Terjadi Kesalahan, Silakan Refresh Halaman Ini');
        }
    });
}

function addkpi_()
{
  save_method = 'add';
  $('#form-competency')[0].reset(); // reset form on modals
  $('.form-group').removeClass('has-error'); // clear error class
  $('.help-block').empty(); // clear error string
  $('#modal_form').modal('show'); // show bootstrap modal
  $('.modal-title').text('Add'); // Set Title to Bootstrap modal title
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
                $('#compentency-kpi').html(data.html_detail);
                //reload_table();
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

function edit_(id)
{
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
        $('[name="org_id"]').val(data.organization_id);
        $('[name="position_group_id"]').select2().select2('val',data.position_group_id);
        $('[name="area_kinerja_utama"]').val(data.area_kinerja_utama);
        $('[name="kpi"]').val(data.kpi);
        $('[name="bobot_kpi"]').val(data.bobot_kpi);
        $('[name="target_kpi"]').val(data.target_kpi);
        $('[name="sumber_info"]').val(data.sumber_info);
        $('[name="competency_monitoring_id"]').select2().select2('val',data.competency_monitoring_id);

        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit'); // Set title to Bootstrap modal title
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Error get data from ajax');
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
           if(data.status) //if success close modal and reload ajax table
            {
              $('#modal_form').modal('hide');
              $('#compentency-kpi').html(data.html_detail);
              //reload_table();
            }else
            {
              alert('Error deleting data');
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error deleting data');
        }
    });
     
  }
}

$(document).on('click', 'button.removebutton', function () {
 $(this).closest('tr').remove();
 return false;
});