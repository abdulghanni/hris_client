$(document).ready(function() {
    $('#limit').select2();
	$("tr.itemcuti").each(function() {
	        var iditemcuti = $(this).attr('id');
	        $('#viewcuti-' + iditemcuti).click(function (e){
	            e.preventDefault();
	            $('#cutidetail-' + iditemcuti).toggle();
	        });
	    });

	
	$("#remove").click(function(){
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
