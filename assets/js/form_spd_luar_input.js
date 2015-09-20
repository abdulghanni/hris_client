$(document).ready(function() {
  $(".select2").select2();

  //Date Pickers
  $('.input-append.date').datepicker({
            autoclose: true,
            todayHighlight: true
   });

  $('.rupiah').maskMoney({precision: 0});

  $('#btnAddBiaya').on('click', function () {
    $(document).find("select.select2").select2();
    $('.rupiah').maskMoney({precision: 0});
    $('#btnRemove').show();
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
      }
    },

    messages: {
          employee: "Silakan Pilih Karyawan",
      }
  });

  $.validator.addMethod('notEqual',function(value, element, param){
    return this.optional(element)||value != param;
  });

}); 
     