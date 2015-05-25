$(document).ready(function() {				
	$(".select2").select2();
	$('.input-append.date').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                todayHighlight: true
       });

	$("#emp").change(function() {
	        var empId = $(this).val();
	        get_employee_org(empId);
	        get_employee_pos(empId);
	        get_employee_nik(empId);
	        get_employee_bu(empId);
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

	    function get_employee_bu(empId)
	    {
	        $.ajax({
	                type: 'POST',
	                url: 'get_emp_bu',
	                data: {id : empId},
	                success: function(data) {
	                    $('#bu').val(data);
	                }
	            });
	    }

	    var url = $.url();
	    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/';
            var resign_url = baseurl+'hris_client/form_resignment';

	    $('#formaddresign').submit(function(response){
                    $.post($('#formaddresign').attr('action'), $('#formaddresign').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad').html(json.errors).fadeIn();
                        }else{
                            window.location.href = resign_url;
                        }
                    }, 'json');
                    return false;
                });
                
            $('#btn_app').click(function(){
                  $('#formAppHrd').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: resign_url+'/do_approve_hrd/'+url.segment(4),
                          data: $('#formAppHrd').serialize(),
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
});	
	 