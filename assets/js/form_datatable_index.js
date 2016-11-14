var save_method; //for save method string
var table;
var form = $("#form_name").val();
var is_admin = $("#is_admin").val();
var bfliter = false; 
$(document).ready(function() {
	// $(".select2").select2();
    //var opt_id = $('#opt option:selected').val();
    var opt_id = $('#status').val();
	 $("#opt").change(function() {
        if(opt_id == ''){
            opt_id = 1;
        }

        var id = $(this).val();
        //alert(opt_id);
        if(opt_id!=id){
            $.ajax({
                url : 'dropdown/status/'+id,
                type: "POST",
                success: function(data)
                {  
                    location.reload(); 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Terjadi Kesalahan, Silakan Refresh Halaman Ini');
                    $btn.button('reset');
                }
            });
        }
    })
    .change();

    

    if(is_admin == 1){
        bfilter = true;
    }else{
        bfilter = false;
    }

    table = $('#table').DataTable({ 
            oLanguage: {
                sProcessing: "<img src='assets/images/loading_spinner.gif'>"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "bFilter": bfilter,
            //"retrieve": true,

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "form_"+form+"/ajax_list/"+opt_id,
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [-1,-2,-3,-4,-5], //last column
                "orderable": false, //set not orderable
            },
            { "sClass": "text-center", "aTargets": [-1,-2,-3,-4,-5,-6] }
            ],

        });

    table_inv = $('#table_inv').DataTable({ 

        oLanguage: {
            sProcessing: "<img src='assets/images/loading_spinner.gif'>"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": form+"/ajax_list",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [-1,-2,-3], //last column
            "orderable": false, //set not orderable
        },
        { "sClass": "text-center", "aTargets": [-1,-2] }
        ],

    });
	
	
});

function showModal(id)
    {
        var form = $("#form-name").val();
        var form_no = $("#form-no"+id).val();
        //alert(form_no);
        //$('#form')[0].reset(); // reset form on modals
        $('[name="id"]').val(id);
        $('[name="form"]').val(form);
        $('[name="form-no"]').val(form_no);
        //Ajax Load data from ajax
        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Konfirmasi Pembatalan Pengajuan'); // Set title to Bootstrap modal title
    }
var base_url    = $("#base_url").val();
function del()
    {
        $('#remove').text('Deleting...'); //change button text
        $('#remove').attr('disabled',true); //set button disable 
        url  = base_url+'dropdown/remove';
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form-delete').serialize(),
            //dataType: "JSON",
            success: function()
            {
                reload_table();
                $('#remove').text('Delete'); //change button text
                $('#remove').attr('disabled',false); //set button enable
                $("[data-dismiss=modal]").trigger({ type: "click" }); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#remove').text('Delete'); //change button text
                $('#remove').attr('disabled',false); //set button enable 

            }
        });
    }

    function del_cuti()
    {
        $('#remove').text('Deleting...'); //change button text
        $('#remove').attr('disabled',true); //set button disable 
        url  = base_url+'form_cuti/remove';
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form-delete').serialize(),
            //dataType: "JSON",
            success: function()
            {
                reload_table();
                $('#remove').text('Delete'); //change button text
                $('#remove').attr('disabled',false); //set button enable
                $("[data-dismiss=modal]").trigger({ type: "click" }); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#remove').text('Delete'); //change button text
                $('#remove').attr('disabled',false); //set button enable 

            }
        });
    }

    function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}