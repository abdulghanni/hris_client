$( "#formadd" ).validate({
    rules: {
      atasan1: {notEqual: 0}
    },

    messages: {
          atasan1: "Silakan Pilih Atasan",
      }
  });

$.validator.addMethod('notEqual',function(value, element, param){
    return this.optional(element)||value != param;
  });
