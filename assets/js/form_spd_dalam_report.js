$(document).ready(function() {

	$( "#formaddreport" ).validate({
	    rules: {
	      userfile: {filesize: 2048000}
	    }
  	});

  	$( "#formupdatereport" ).validate({
	    rules: {
	      userfile: {filesize: 2048000}
	    }
  	});

	$.validator.addMethod('filesize', function(value, element, param) {
		return this.optional(element) || (element.files[0].size <= param) 
	}, "Ukuran file harus kurang dari 2 MegaBytes");
});