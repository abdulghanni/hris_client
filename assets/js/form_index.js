var save_method; //for save method string
var table;
$(document).ready(function() {
	$(".select2").select2();
    $('#limit').select2();
	$("tr.itemcuti").each(function() {
	        var iditemcuti = $(this).attr('id');
	        $('#viewcuti-' + iditemcuti).click(function (e){
	            e.preventDefault();
	            $('#cutidetail-' + iditemcuti).toggle();
	        });
	    });

	table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "form_cuti/ajax_list",
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

function showModal(id)
	{
		var form = $("#form-name").val();
		var form_no = $("#form-no"+id).val();
		//alert(form_no);
	    $('#form')[0].reset(); // reset form on modals
	    $('[name="id"]').val(id);
	    $('[name="form"]').val(form);
	    $('[name="form-no"]').val(form_no);
	    //Ajax Load data from ajax
	    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
	    $('.modal-title').text('Konfirmasi Pembatalan Pengajuan'); // Set title to Bootstrap modal title
	}
