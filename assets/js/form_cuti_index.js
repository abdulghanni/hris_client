$(document).ready(function() {
    $('#limit').select2();
	$("tr.itemcuti").each(function() {
	        var iditemcuti = $(this).attr('id');
	        $('#viewcuti-' + iditemcuti).click(function (e){
	            e.preventDefault();
	            $('#cutidetail-' + iditemcuti).toggle();
	        });
	    });
});