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
          getInvList(empId);
          getAtasan1(empId);
          getAtasan2(empId);
          getAtasan3(empId);
	    })
	    .change();

  function getInvList(empId)
   {
      $.ajax({
          type: 'POST',
          url: 'get_inventory_list',
          data: {id : empId},
          success: function(data) {
              $('#inventory').html(data);
          }
      });
   }
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

      function getAtasan1(empId)
        {
         $.ajax({
                type: 'POST',
                url: 'get_atasan',
                data: {id : empId},
                success: function(data) {
                    $('#atasan1').html(data);
                }
            });
        }

        function getAtasan2(empId)
        {
         $.ajax({
                type: 'POST',
                url: 'get_atasan',
                data: {id : empId},
                success: function(data) {
                    $('#atasan2').html(data);
                }
            });
        }

        function getAtasan3(empId)
        {
         $.ajax({
                type: 'POST',
                url: 'get_atasan',
                data: {id : empId},
                success: function(data) {
                    $('#atasan3').html(data);
                }
            });
        }
            
    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
    var uri1 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv1';
    var uri2 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv2';
    var uri3 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv3';
    var uriMgr = url.segment(2)+'/do_approve/'+url.segment(4)+'/mgr';
    var uriKoperasi = url.segment(2)+'/do_approve/'+url.segment(4)+'/koperasi';
    var uriPerpus = url.segment(2)+'/do_approve/'+url.segment(4)+'/perpus';
    var uriHrd = url.segment(2)+'/do_approve/'+url.segment(4)+'/hrd';
    var uriIt = url.segment(2)+'/do_approve/'+url.segment(4)+'/it';

    var exit_url = baseurl+url.segment(2);

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

    $('button[data-loading-text]').click(function () {
    $(this).button('loading');
    });

    $('#btnAppLv1').click(function(){
        var $btn = $(this).button('loading');
        $('#formAppLv1').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri1,
                data: $('#formAppLv1').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btnAppLv2').click(function(){
        var $btn = $(this).button('loading');
        $('#formAppLv2').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri2,
                data: $('#formAppLv2').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btnAppLv3').click(function(){
        var $btn = $(this).button('loading');
        $('#formAppLv3').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri3,
                data: $('#formAppLv3').serialize(),
                success: function() {
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                    location.reload(),
                    $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

	    $('#btnAppMgr').click(function(){
        var $btn = $(this).button('loading');
                  $('#formAppMgr').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: baseurl+uriMgr,
                          data: $('#formAppMgr').serialize(),
                          success: function() {
                              $("[data-dismiss=modal]").trigger({ type: "click" });
                              location.reload(),
                              $btn.button('reset')
                          }
                      });
                      ev.preventDefault(); 
                  });  
              });

	    $('#btnAppKoperasi').click(function(){
        var $btn = $(this).button('loading');
                  $('#formAppKoperasi').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: baseurl+uriMgr,
                          data: $('#formAppKoperasi').serialize(),
                          success: function() {
                              $("[data-dismiss=modal]").trigger({ type: "click" });
                              location.reload(),
                              $btn.button('reset')
                          }
                      });
                      ev.preventDefault(); 
                  });  
              });

	    $('#btnAppPerpus').click(function(){
        var $btn = $(this).button('loading');
                  $('#formAppPerpus').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: baseurl+uriPerpus,
                          data: $('#formAppPerpus').serialize(),
                          success: function() {
                              $("[data-dismiss=modal]").trigger({ type: "click" });
                              location.reload(),
                              $btn.button('reset')
                          }
                      });
                      ev.preventDefault(); 
                  });  
              });

	    $('#btnAppHrd').click(function(){
        var $btn = $(this).button('loading');
                  $('#formAppHrd').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: baseurl+uriHrd,
                          data: $('#formAppHrd').serialize(),
                          success: function() {
                              $("[data-dismiss=modal]").trigger({ type: "click" });
                              location.reload(),
                              $btn.button('reset')
                          }
                      });
                      ev.preventDefault(); 
                  });  
              });

      $('#btnAppIt').click(function(){
        var $btn = $(this).button('loading');
                  $('#formAppIt').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: baseurl+uriIt,
                          data: $('#formAppIt').serialize(),
                          success: function() {
                              $("[data-dismiss=modal]").trigger({ type: "click" });
                              location.reload(),
                              $btn.button('reset')
                          }
                      });
                      ev.preventDefault(); 
                  });  
              });
});

	 