$(document).ready(function() {	
	$(".select2").select2();
	//Date Pickers
	  $('.input-append.date').datepicker({
  			format: "dd-mm-yyyy",
			autoclose: true,
			todayHighlight: true
	   });

	  $( "#formedituser" ).validate({
	  rules: {
	    password: {
	      minlength: 8,
	      notEqual : "password",
	    },

	    password_confirm: {
	      minlength: 8,
	      equalTo : password,
	    }
	  },
	    messages: {
	        //password: "Password harus berisi delapan karakter atau lebih",
	        password_confirm: "Password Konfirmasi harus sama dengan password baru",
	    }
	});

	$( "#formkk" ).validate({
	  rules: {
	    kk: {
	      required : true,
	      extension: "jpg|jpeg|png|gif",
	      filesize: 2048000,
	    }
	  },
	    messages: {
	        kk: "Tipe file harus berformat jpg/jpeg/png & Kurang dari 2MB",
	    }
	});

	$( "#formakta" ).validate({
	  rules: {
	    akta: {
	      required : true,
	      extension: "jpg|jpeg|png|gif",
	      filesize: 2048000,
	    }
	  },

	  messages: {
	        akta: "Tipe file harus berformat jpg/jpeg/png & Kurang dari 2MB",
	    }

	});

	$.validator.addMethod('filesize', function(value, element, param) {
    // param = size (en bytes) 
    // element = element to validate (<input>)
    // value = value of the element (file name)
    return this.optional(element) || (element.files[0].size <= param) 
	}, "Ukuran file harus kurang dari 2 MegaBytes");

	$.validator.addMethod('notEqual',function(value, element, param){
		return this.optional(element)||value != param;
	}, "Password yang anda masukan tidak diizinkan, coba password lainnya" );

	$("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});

      

});

