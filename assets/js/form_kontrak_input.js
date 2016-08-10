$(document).ready(function() {
    $('.input-append.date')
        .datepicker({todayHighlight: true})
        .on('changeDate', function(ev){
            $(this).datepicker('hide').blur();
    });

                    
    $(".select2").select2();
            
    $( "#formadd" ).validate({
    rules: {
      atasan1: {notEqual:0}
    },

    messages: {
          atasan1 : "Silakan Pilih Atasan"
      }
    }); 
}); 