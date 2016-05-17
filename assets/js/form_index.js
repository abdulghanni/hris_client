var save_method; //for save method string
var table;
$(document).ready(function() {
	
    $('#limit').select2();
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
