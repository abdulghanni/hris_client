$(document).ready(function() {				
	$(".select2").select2();
	$('#limit').select2();

	$( "#formadd" ).validate({
	  rules: {
	    file: {
	      filesize: 2048000,
	    }
	  }
	});

	$( "#formupdate" ).validate({
	  rules: {
	    file: {
	      filesize: 2048000,
	    }
	  }
	});

	$.validator.addMethod('filesize', function(value, element, param) {
    // param = size (en bytes) 
    // element = element to validate (<input>)
    // value = value of the element (file name)
    return this.optional(element) || (element.files[0].size <= param) 
	}, "Ukuran file harus kurang dari 2 MegaBytes");

});