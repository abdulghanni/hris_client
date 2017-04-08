$(document).ready(function() { 
$(".select2").select2();   
$('.input-append.date')
    .datepicker({todayHighlight: true})
    .on('changeDate', function(ev){
        $(this).datepicker('hide').blur();
});
var startDate = new Date('01/01/2015');
var FromEndDate = new Date();
var ToEndDate = new Date();

$('#datepicker_start').datepicker({
    
    weekStart: 1,
    startDate: '01/01/2012',
    //endDate: FromEndDate,
    format: "yyyy-mm-dd",
    autoclose: true
})
    .on('changeDate', function(selected){
    
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#datepicker_end').datepicker('setStartDate', startDate);
    
    }); 
$('#datepicker_end')
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
        $('#datepicker_start').datepicker('setEndDate', FromEndDate);
    
    });


ToEndDate.setDate(ToEndDate.getDate()+365);
    
      $('#btnRemove').show();
      $('#btnSave').show();
      $('#btnCancel').show();
  
    
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
