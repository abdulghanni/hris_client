$(document).ready(function() {				
	$(".select2").select2();

	 $('#formaddrecruitment').submit(function(response){
        $.post($('#formaddrecruitment').attr('action'), $('#formaddrecruitment').serialize(),function(json){
            if(json.st == 0){
                $('#MsgBad').html(json.errors).fadeIn();
            }else{
                window.location.href = json.recruitment_url;
            }
        }, 'json');
        return false;
    });

	 var url = $.url();
     var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/';
     var recruitment_url = baseurl+'hris_client/form_recruitment';

	 $('#btn_app_hrd').click(function(){
                  $('#formApp').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: recruitment_url+'/do_approve/'+url.segment(4)+'/hrd',
                          data: $('#formApp').serialize(),
                          success: function() {
                              setTimeout(function(){
                                  location.reload()},
                                  1000
                              )
                          }
                      });
                      ev.preventDefault(); 
                  });  
              });
	 
	 jQuery.validator.addMethod("name", function(value, element)
		{
			valid = false;
			check = /[^-\.a-zA-Z\s\u00C0-\u00D6\u00D8-\u00F6\u00F8-\u02AE]/.test(value);
			if(check==false)
				valid = true;
			return this.optional(element) || valid;
		},jQuery.format("Please enter a proper name."));

	 $("#toefl").keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8 ) {
            // let it happen, don't do anything
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault(); 
            }   
        }
    });

   $('#jumlah').keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8 ) {
            // let it happen, don't do anything
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault(); 
            }   
        }
    });
});	
	 