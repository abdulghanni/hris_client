$(document).ready(function() {				
	$(".select2").select2();
	$('.input-append.date').datepicker({
                autoclose: true,
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
            var exit_url = baseurl+'hris_client/form_exit';

	    $('#formaddexit').submit(function(response){
                    $.post($('#formaddexit').attr('action'), $('#formaddexit').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad').html(json.errors).fadeIn();
                        }else{
                            window.location.href = exit_url;
                        }
                    }, 'json');
                    return false;
                });

	    $('#btn_app_mgr').click(function(){
                  $('#formApp').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: exit_url+'/do_approve/'+url.segment(4)+'/mgr',
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

	    $('#btn_app_koperasi').click(function(){
                  $('#formApp').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: exit_url+'/do_approve/'+url.segment(4)+'/koperasi',
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

	    $('#btn_app_perpus').click(function(){
                  $('#formApp').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: exit_url+'/do_approve/'+url.segment(4)+'/perpus',
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

	    $('#btn_app_hrd').click(function(){
                  $('#formApp').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: exit_url+'/do_approve/'+url.segment(4)+'/hrd',
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

	    $('#btn_app_admin').click(function(){
                  $('#formApp').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: exit_url+'/do_approve_admin/'+url.segment(4),
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
                
});

	 