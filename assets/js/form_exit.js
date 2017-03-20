$(document).ready(function() {				
	$(".select2").select2();
	$('.input-append.date').datepicker({
          autoclose: true,
          todayHighlight: true
  });
       
   $("#emp").change(function() {
      var empId = $(this).val();
      if(empId != 0){
        get_employee_org(empId);
        get_employee_pos(empId);
        get_employee_nik(empId);
        get_employee_bu(empId);
        get_employee_sen_date(empId);
        get_employee_stat_id(empId);
        getInvList(empId);
        getAsmen(empId);
        getAtasan3(empId);
      }
  })
  .change();


  $( "#formadd" ).validate({
    rules: {
      atasan1: {notEqual:0}
    },

    messages: {
          atasan1 : "Silakan Pilih Atasan"
      }
  });
    
  $("#empExit").change(function() {
      var empId = $(this).val();
      if(empId != 0){
        get_employee_org(empId);
        get_employee_pos(empId);
        get_employee_nik(empId);
        get_employee_bu(empId);
        get_employee_sen_date(empId);
        get_employee_stat_id(empId);
        getInvList(empId);
        getAtasan1(empId);
        getAtasan3(empId);
        getAsmen(empId);
      }
  })
  .change();

  var base_url    = $("#base_url").val(),
      form        = $("#form").val(),       
      id          = $("#id").val();

  function getInvList(empId)
   {
      $.ajax({
          type: 'POST',
          url: base_url+form+'/get_inventory_list',
          data: {id : empId},
          success: function(data) {
              $('#inventory').html(data);
          }
      });
   }

   function getAsmen(empId)
   {
      $.ajax({
          type: 'POST',
          url: base_url+'dropdown/get_asmen/',
          data: {id : empId},
          success: function(data) {
              $('#asmen').html(data);
          }
      });
   }

	 function get_employee_org(empId)
	    {
        $.ajax({
            type: 'POST',
            url: base_url+form+'/get_emp_org',
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
              url: base_url+form+'/get_emp_pos',
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
            url: base_url+form+'/get_emp_nik',
            data: {id : empId},
            success: function(data) {
                $('#nik').val(data);
            }
        });
	    }

      function get_employee_sen_date(empId)
      {
        $.ajax({
            type: 'POST',
            url: base_url+form+'/get_emp_sen_date',
            data: {id : empId},
            success: function(data) {
                $('#tgl_masuk').val(data);
            }
        });
      }

      function get_employee_stat_id(empId)
      {
        $.ajax({
            type: 'POST',
            url: base_url+form+'/get_emp_stat_id',
            data: {id : empId},
            success: function(data) {
                $('#old_status').val(data);
            }
        });
      }

	    function get_employee_bu(empId)
	    {
        $.ajax({
            type: 'POST',
            url: base_url+form+'/get_emp_bu',
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
              url: base_url+'dropdown/get_atasan/'+empId,
              data: {id : empId},
              success: function(data) {
                  $('#atasan1').html(data);
              }
          });
        }

    function getAtasan3(empId)
    {
     $.ajax({
          type: 'POST',
          url: base_url+'dropdown/get_atasan3/'+empId,
          data: {id : empId},
          success: function(data) {
              $('#atasan3').html(data);
          }
      });
    }

    $.validator.addMethod('notEqual',function(value, element, param){
        return this.optional(element)||value != param;
    });
});

	 