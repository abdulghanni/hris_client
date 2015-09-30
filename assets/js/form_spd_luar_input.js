$(document).ready(function() {
  $(".select2").select2();

  //Date Pickers
  $('.input-append.date')
        .datepicker({todayHighlight: true})
        .on('changeDate', function(ev){
            //days();
            $(this).datepicker('hide').blur();
    });

  $('.rupiah').maskMoney({precision: 0, allowZero:true});

  $('#btnAddBiaya').on('click', function () {
    $(document).find("select.select2").select2();
    $('#btnRemove').show();
    $('.rupiah').maskMoney({precision: 0});
    $(".angka").keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8 ) {
            // let it happen, don't do anything
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault(); 
            }   
        }
    });

    $(".biaya-tambahan").keyup(function() {
   
        var total = 0;
        var total2 = 0;
        $('.biaya').each(function (index, element) {
            total = total + parseInt($(element).val());
        });

        $('.biaya-tambahan').each(function (index, element) {
            total2 = total2 + parseInt($(element).val());
        });

        val = total+total2;
       $("#total").val(val);
    })
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

function days() 
{
  var a = $("#from_date").datepicker('getFormattedDate'),
                    b = $("#to_date").datepicker('getFormattedDate'),
                    c = 24*60*60*1000,
                    diffDays = Math.floor(( Date.parse(b) - Date.parse(a) ) / c);
                $("#jml_hari").val(diffDays+1);
}
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
     