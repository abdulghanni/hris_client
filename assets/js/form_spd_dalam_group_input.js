$(document).ready(function() {
    //$("div#myId").dropzone({ url: "/file/post" });
    
    $('.timepicker-24').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false
     });
                    
    $(".select2").select2();

    //denimaru
    function get_employee_org(empId)
    {
        $.ajax({
                type: 'POST',
                url: 'get_emp_org',
                data: {id : empId},
                success: function(data) {
                    $('#org_tr').val(data);
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
                    $('#pos_tr').val(data);
                }
            });
    }

    $("#emp_tc").change(function() {
        var empId = $(this).val();
        get_employee_org_tc(empId);
        get_employee_pos_tc(empId);
    })
    .change();

    function get_employee_org_tc(empId)
    {
        $.ajax({
                type: 'POST',
                url: 'get_emp_org',
                data: {id : empId},
                success: function(data) {
                    $('#org_tc').val(data);
                }
            });
    }

    function get_employee_pos_tc(empId)
    {
        $.ajax({
                type: 'POST',
                url: 'get_emp_pos',
                data: {id : empId},
                success: function(data) {
                    $('#pos_tc').val(data);
                }
            });
    }


    $("#employee_sel").change(function() {
        var empId = $(this).val();
        get_employee_org(empId);
        get_employee_pos(empId);
    })
    .change();

    //add spd_dalam_group
    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/hris_client/';
    var spd_dalam_group_url = baseurl+'form_spd_dalam_group';
                $('#add_spd_dalam_group').submit(function(response){
                    $.post($('#add_spd_dalam_group').attr('action'), $('#add_spd_dalam_group').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad').html(json.errors).fadeIn();
                        }else{
                            window.location.href = spd_dalam_group_url;
                        }
                    }, 'json');
                    return false;
                });

    //add spd_dalam_group_report
    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/hris_client/';
    var spd_dalam_group_url = baseurl+'form_spd_dalam_group';
                $('#add_spd_dalam_group_report').submit(function(response){
                    $.post($('#add_spd_dalam_group_report').attr('action'), $('#add_spd_dalam_group_report').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad').html(json.errors).fadeIn();
                        }else{
                            window.location.href = spd_dalam_group_url;
                        }
                    }, 'json');
                    return false;
                });


    //Date Pickers
      $('.input-append.date').datepicker({
                autoclose: true,
                todayHighlight: true
       });

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
}); 
     