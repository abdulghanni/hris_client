$(document).ready(function() {              
	$(".select2").select2();

	$('.input-append.date').datepicker({
	    format: "dd-mm-yyyy",
	    autoclose: true,
	    todayHighlight: true
	});


    $( "#formadd" ).validate({
	    rules: {
	      atasan1: {notEqual:0}
	    },

	    messages: {
	          atasan1 : "Silakan Pilih Atasan"
	    }
  });
});