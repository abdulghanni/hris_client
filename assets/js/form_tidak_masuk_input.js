$(document).ready(function() {              
	$(".select2").select2();

	$("#datepicker_start").datepicker({format: "yyyy-mm-dd", todayHighlight: true})
    $("#datepicker_end").datepicker({format: "yyyy-mm-dd", todayHighlight: true})

      $('.input-append.date')
        .datepicker({todayHighlight: true})
        .on('changeDate', function(ev){
            days();
            $(this).datepicker('hide').blur();
    });

	function days() 
    {   
      var dDate1 = new Date($("#datepicker_start").datepicker('getFormattedDate')); 
      var dDate2 = new Date($("#datepicker_end").datepicker('getFormattedDate'));

      var iWeeks, iDateDiff, iAdjust = 0;
     
      if (dDate2 < dDate1) return -1;                 // error code if dates transposed
     
      var iWeekday1 = dDate1.getDay();                // day of week
      var iWeekday2 = dDate2.getDay();
     
      iWeekday1 = (iWeekday1 == 0) ? 7 : iWeekday1;   // change Sunday from 0 to 7
      iWeekday2 = (iWeekday2 == 0) ? 7 : iWeekday2;
     
      if ((iWeekday1 > 6) && (iWeekday2 > 6)) iAdjust = 1;  // adjustment if both days on weekend
     
      iWeekday1 = (iWeekday1 > 6) ? 6 : iWeekday1;    // only count weekdays
      iWeekday2 = (iWeekday2 > 6) ? 6 : iWeekday2;
     
      // calculate differnece in weeks (1000mS * 60sec * 60min * 24hrs * 7 days = 604800000)
      iWeeks = Math.floor((dDate2.getTime() - dDate1.getTime()) / 604800000)
     
      if (iWeekday1 <= iWeekday2) {
        iDateDiff = (iWeeks * 6) + (iWeekday2 - iWeekday1)
      } else {
        iDateDiff = ((iWeeks + 1) * 6) - (iWeekday1 - iWeekday2)
      }
     
      iDateDiff -= iAdjust// take into account both days on weekend
     

      $("#jml_hari").val(iDateDiff + 1);            
    }


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