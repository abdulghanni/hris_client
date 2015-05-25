$(document).ready(function() { 
    $(".select2").select2();
     
    $('.input-append.date').datepicker({
                autoclose: true,
                todayHighlight: true
       });

    $('#form_iconic_validation').validate({
                errorElement: 'span', 
                errorClass: 'error', 
                focusInvalid: false, 
                ignore: "",
                rules: {
                    form1username: {
                        minlength: 4,
                        required: true
                    },
                    form1password: {
                        minlength: 8,
                        required: true
                    },
                    form1passwordconf: {
                        required: true,
                        equalTo: "#form1password"
                    },
                    form1name: {
                        minlength: 4,
                        required: true
                    },
                    form1email: {
                        required: true,
                        email: true
                    },
                    form1dob: {
                        required: true,
                        date: true
                    },
                    form1cabang: {
                        required: true,
                    }
                },

                invalidHandler: function (event, validator) {
					//display error alert on form submit    
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-with-icon').children('i');
                    var parent = $(element).parent('.input-with-icon');
                    icon.removeClass('icon-ok').addClass('icon-exclamation');  
                    parent.removeClass('success-control').addClass('error-control');  
                },

                highlight: function (element) { // hightlight error inputs
					
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
                    var icon = $(element).parent('.input-with-icon').children('i');
					var parent = $(element).parent('.input-with-icon');
                    icon.removeClass("icon-exclamation").addClass('icon-ok');
					parent.removeClass('error-control').addClass('success-control'); 
                },

                submitHandler: function (form) {
                
                }
            });

        $('#kembali-login').click(function (){
                window.location.href = 'http://' + window.location.hostname + '/hris_erlangga/auth';
            });
})