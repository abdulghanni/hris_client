$(document).ready(function() {
	$(".select2").select2();
	$('#limit').select2();
//fahmi
$(".namechange").change(function(){
 	$(this).find("option:selected").each(function(){
					if($(this).attr("class")=="showname"){
							 $(".nameform").show();
					 }
					 else{
							 $(".nameform").hide();
					 }
			 });
			}).change();
//endfahmi


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
