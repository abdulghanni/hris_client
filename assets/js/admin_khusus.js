$(document).ready(function() {				
	$(".select2").select2();
	 $('#limit').select2();

     $("#nik").keyup(function(){
          if($("#nik").val().length >= 4)
          {
          $.ajax({
           type: "POST",
           url: "admin_khusus/check_user",
           data: "nik="+$("#nik").val(),
           success: function(msg){
            if(msg=="true")
            {
             $("#verify").hide();
            }
            else
            {
             $("#verify").show();
            }
           }
          });
          }
          else 
          {
           $("#verify").css({ "background-image": "none" });
          }
    });

     $( "#formadd" ).validate({
      rules: {
        email : {email:true},
        password: {
          minlength: 8,
          notEqual : "password",
        },

        password_confirm: {
          minlength: 8,
          equalTo : password,
        },

        bu: {notEqual:0},
        org: {notEqual:0}
      },
        messages: {
            //password: "Password harus berisi delapan karakter atau lebih",
            password_confirm: "Password Konfirmasi harus sama dengan password baru",
            bu : "Silakan Pilih BU",
            org : "Silakan Pilih Dept/Bagian",
        }
    });

	  $('#btnadd').click(function(){
        $('#formadd').submit(function(ev){
        var $btn = $('#btnadd').button('loading'); 
            $.ajax({
                type: 'POST',
                url: 'admin_khusus/add',
                data: $('#formadd').serialize(),
                success: function() {
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                    location.reload(),
                    $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $.validator.addMethod('notEqual',function(value, element, param){
        return this.optional(element)||value != param;
    });


});