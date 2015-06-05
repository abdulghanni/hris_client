$(document).ready(function() {
    var date = $('#training_date_update').datepicker({ dateFormat: 'yyyy-mm-dd' }).val();

    $('.timepicker-24').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false
     });
     				
	$(".select2").select2();

      //Date Pickers
      $('.input-append.date')
        .datepicker({format: "yyyy-mm-dd", todayHighlight: true})
        .on('changeDate', function(ev){
            days();
            $(this).datepicker('hide').blur();
    });

    function days() {
    var From_date = new Date($("#tanggal_mulai").val());
    var To_date = new Date($("#tanggal_akhir").val());
    var diff_date =  To_date - From_date;
     
    var years = Math.floor(diff_date/31536000000);
    var months = Math.floor((diff_date)/2628000000);
    var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000 + 1);
    $("#lama_training_bulan").val(months+" Bulan");
    $("#lama_training_hari").val(days+" Hari");
    //alert( years+" year(s) "+months+" month(s) "+days+" and day(s)");
    var From_date_update = new Date($("#tanggal_mulai_update").val());
    var To_date_update = new Date($("#tanggal_akhir_update").val());
    var diff_date_update =  To_date_update - From_date_update;
     
    var months_update = Math.floor((diff_date_update)/2628000000);
    var days_update = Math.floor(((diff_date_update % 31536000000) % 2628000000)/86400000 + 1);
    $("#lama_training_bulan_update").val(months_update+" Bulan");
    $("#lama_training_hari_update").val(days_update+" Hari");
    }
      

	//Traditional form validation sample
	$('#form_traditional_validation').validate({
                focusInvalid: false, 
                ignore: "",
                rules: {
                    form1Amount: {
                        minlength: 2,
                        required: true
                    },
                    form1CardHolderName: {
						minlength: 2,
                        required: true,
                    },
                    form1CardNumber: {
                        required: true,
                        creditcard: true
                    }
                },

                invalidHandler: function (event, validator) {
					//display error alert on form submit    
                },

                errorPlacement: function (label, element) { // render error placement for each input type   
					$('<span class="error"></span>').insertAfter(element).append(label)
                    var parent = $(element).parent('.input-with-icon');
                    parent.removeClass('success-control').addClass('error-control');  
                },

                highlight: function (element) { // hightlight error inputs
					
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
					var parent = $(element).parent('.input-with-icon');
					parent.removeClass('error-control').addClass('success-control'); 
                },

                submitHandler: function (form) {
                
                }
            });	
	
	//Iconic form validation sample	
	   $('#form_iconic_validation').validate({
                errorElement: 'span', 
                errorClass: 'error', 
                focusInvalid: false, 
                ignore: "",
                rules: {
                    form1Name: {
                        minlength: 2,
                        required: true
                    },
                    form1Email: {
                        required: true,
                        email: true
                    },
                    form1Url: {
                        required: true,
                        url: true
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
	//Form Condensed Validation
	$('#form-condensed').validate({
                errorElement: 'span', 
                errorClass: 'error', 
                focusInvalid: false, 
                ignore: "",
                rules: {
                    form3FirstName: {
						name: true,
                        minlength: 3,
                        required: true
                    },
					form3LastName: {
                        minlength: 3,
                        required: true
                    },
                    form3Gender: {
                        required: true,
                    },
					form3DateOfBirth: {
                        required: true,
                    },
					form3Occupation: {
						 minlength: 3,
                        required: true,
                    },
					form3Email: {
                        required: true,
						email: true
                    },
                    form3Address: {
						minlength: 10,
                        required: true,
                    },
					form3City: {
						minlength: 5,
                        required: true,
                    },
					form3State: {
						minlength: 3,
                        required: true,
                    },
					form3Country: {
						minlength: 3,
                        required: true,
                    },
					form3PostalCode: {
						number: true,
						maxlength: 4,
                        required: true,
                    },
					form3TeleCode: {
						minlength: 3,
						maxlength: 4,
                        required: true,
                    },
					form3TeleNo: {
						maxlength: 10,
                        required: true,
                    },
                },

                invalidHandler: function (event, validator) {
					//display error alert on form submit    
                },

                errorPlacement: function (label, element) { // render error placement for each input type   
					$('<span class="error"></span>').insertAfter(element).append(label)
                },

                highlight: function (element) { // hightlight error inputs
					
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
                  
                },

                submitHandler: function (form) {
                
                }
            });	
	
	//Form Wizard Validations
	var $validator = $("#commentForm").validate({
		  rules: {
		    emailfield: {
		      required: true,
		      email: true,
		      minlength: 3
		    },
		    txtFullName: {
		      required: true,
		      minlength: 3
		    },
			txtFirstName: {
		      required: true,
		      minlength: 3
		    },
			txtLastName: {
		      required: true,
		      minlength: 3
		    },
			txtCountry: {
		      required: true,
		      minlength: 3
		    },
			txtPostalCode: {
		      required: true,
		      minlength: 3
		    },
			txtPhoneCode: {
		      required: true,
		      minlength: 3
		    },
			txtPhoneNumber: {
		      required: true,
		      minlength: 3
		    },
		    urlfield: {
		      required: true,
		      minlength: 3,
		      url: true
		    }
		  },
		  errorPlacement: function(label, element) {
				$('<span class="arrow"></span>').insertBefore(element);
				$('<span class="error"></span>').insertAfter(element).append(label)
			}
		});

	$('#rootwizard').bootstrapWizard({
	  		'tabClass': 'form-wizard',
	  		'onNext': function(tab, navigation, index) {
	  			var $valid = $("#commentForm").valid();
	  			if(!$valid) {
	  				$validator.focusInvalid();
	  				return false;
	  			}
				else{
					$('#rootwizard').find('.form-wizard').children('li').eq(index-1).addClass('complete');
					$('#rootwizard').find('.form-wizard').children('li').eq(index-1).find('.step').html('<i class="icon-ok"></i>');	
				}
	  		}
	 });	
	 
	 jQuery.validator.addMethod("name", function(value, element)
		{
			valid = false;
			check = /[^-\.a-zA-Z\s\u00C0-\u00D6\u00D8-\u00F6\u00F8-\u02AE]/.test(value);
			if(check==false)
				valid = true;
			return this.optional(element) || valid;
		},jQuery.format("Please enter a proper name."));

     
    $("#besar_biaya").keydown(function(event) {
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

    $("#besar_biaya_update").keydown(function(event) {
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

    $('#besar_biaya').maskMoney();
    $('#besar_biaya_update').maskMoney();


    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/';
    var training_url = baseurl+'hris_client/form_training';
    var uri1 = training_url+'/do_approve_spv/'+url.segment(4);
    var uri2 = training_url+'/do_approve_hrd/'+url.segment(4);
    $('#btn_app_lv1').click(function(){
        $('#formAppLv1').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: uri1,
                data: $('#formAppLv1').serialize(),
                success: function() {
                    setTimeout(function(){
                        location.reload()},
                       2000
                    )
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_lv2').click(function(){
        $('#formAppLv2').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: uri2,
                data: $('#formAppLv2').serialize(),
                success: function() {
                    setTimeout(function(){
                        location.reload()},
                        2000
                    )
                }
            });
            ev.preventDefault(); 
        });  
    });

//add training
     $('#formaddtraining').submit(function(response){
                    $.post($('#formaddtraining').attr('action'), $('#formaddtraining').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad').html(json.errors).fadeIn();
                        }else{
                            window.location.href = training_url;
                        }
                    }, 'json');
                    return false;
                });

});	

//get emp org

$("#emp").change(function() {
        var empId = $(this).val();
        get_employee_org(empId);
        get_employee_pos(empId);
        get_employee_nik(empId);
    })
    .change();

 function get_employee_org(empId)
    {
        $.ajax({
                type: 'POST',
                url: 'get_emp_org',
                data: {id : empId},
                success: function(data) {
                    $('#organization').val(data);
                }
            });
    }

    function get_employee_pos(empId)
    {
        $.ajax({
                type: 'POST',
                url: 'get_emp_pos',
                data: {id : empId},
                success: function(data) {
                    $('#position').val(data);
                }
            });
    }

    function get_employee_nik(empId)
    {
        $.ajax({
                type: 'POST',
                url: 'get_emp_nik',
                data: {id : empId},
                success: function(data) {
                    $('#nik').val(data);
                }
            });
    }
	 