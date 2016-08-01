var save_method; //for save method string
var table;
var form = $("#form_name").val();
$(document).ready(function() {
	$(".select2").select2();
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

    table = $('#table').DataTable({ 
            oLanguage: {
                sProcessing: "<img src='assets/images/loading_spinner.gif'>"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
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
	
	$("#remove").click(function(){
    $('#remove').text('Deleting...'); //change button text
    $('#remove').attr('disabled',true); //set button disable 
        $.ajax({
            type: 'POST',
            url: 'dropdown/remove/',
            data: $('#form').serialize(),
        	dataType: "JSON",
            success: function(data) {
                location.reload();
            }
        });
	})
});

