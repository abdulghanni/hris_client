$(document).ready(function() {

    $('.timepicker-24').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false
     });
                    
    $(".select2").select2();


  //Date Pickers
  $('.input-append.date').datepicker({
            autoclose: true,
            todayHighlight: true
   });


    $('#btnAdd').on('click', function () {
      $(document).find("select.select2").select2();
      $('#btnRemove').show();
      $('#btnSave').show();
      $('#btnCancel').show();
    });

    $( "#formadd" ).validate({
    rules: {
      employee: {
        required: true,
        notEqual : 0,
      },
       atasan1: {notEqual:0}
    },

    messages: {
          employee: "Silakan Pilih Karyawan",
          atasan1 : "Silakan Pilih Atasan"
      }
  });

  $.validator.addMethod('notEqual',function(value, element, param){
    return this.optional(element)||value != param;
  });

}); 
     