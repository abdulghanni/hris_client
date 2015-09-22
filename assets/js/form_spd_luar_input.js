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

var startDate = new Date('01/01/2015');
var FromEndDate = new Date();
var ToEndDate = new Date();

ToEndDate.setDate(ToEndDate.getDate()+365);

$('.from_date').datepicker({
    
    weekStart: 1,
    startDate: '01/01/2012',
    //endDate: FromEndDate,
    format: "yyyy-mm-dd",
    autoclose: true
})
    .on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('.to_date').datepicker('setStartDate', startDate);
    }); 
$('.to_date')
    .datepicker({
        
        weekStart: 1,
        startDate: startDate,
        endDate: ToEndDate,
        format: "yyyy-mm-dd",
        autoclose: true
    })
    .on('changeDate', function(selected){
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('.from_date').datepicker('setEndDate', FromEndDate);
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
     