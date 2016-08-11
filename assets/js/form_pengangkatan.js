$(document).ready(function() {
    //$("div#myId").dropzone({ url: "/file/post" });
    
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

    $.validator.addMethod('notEqual',function(value, element, param){
        return this.optional(element)||value != param;
    });
}); 