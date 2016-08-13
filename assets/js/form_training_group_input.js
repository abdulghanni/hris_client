$(document).ready(function() {    
    $('#btnAdd').on('click', function () {
      $(document).find("select.select2").select2();
      $('#btnRemove').show();
      $('#btnSave').show();
      $('#btnCancel').show();
    });
    
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
