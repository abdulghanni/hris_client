$(document).ready(function() {
    $(".select2").select2();
    //Date Pickers
    $(".datepicker_start").datepicker({format: "yyyy-mm-dd", todayHighlight: true})
    $(".datepicker_end").datepicker({format: "yyyy-mm-dd", todayHighlight: true})

      $('.input-append.date')
        .datepicker({todayHighlight: true})
        .on('changeDate', function(ev){
            days();
            var x = parseInt($("#jml_cuti").val());
            var y = parseInt($("#sisa_cuti").val());
            if( x > y ){
              alert('Jumlah cuti melebihi sisa cuti yang diizinkan');
            }
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
     

      $("#jml_hari").val(iDateDiff + 1);// add 1 because dates are inclusive
      $("#jml_cuti").val(iDateDiff + 1);                  
    }


    function formatDate(_d){
         var d = new Date(_d);
        var curr_date = d.getDate();
        if(curr_date < 10)
            curr_date = "0" + curr_date;
        
        var curr_month = d.getMonth() + 1; //Months are zero based
        if(curr_month < 10)
            curr_month = "0" + curr_month;
        
        var curr_year = d.getFullYear();   
        return curr_month + '/' + curr_date + '/' + curr_year;
    }

    $('#jml_hari').change(function(){        
        if($(this).val() != ''){
            var days = $(this).val();
            var start= new Date($("#datepicker_start").val());
            var newStart = start.setDate(start.getDate() + parseInt(days));    
            $("#datepicker_end").val(formatDate(newStart));
        }else{
            $("#datepicker_end").val($("#datepicker_start").val());
        }        
    });
});


  $( "#formaddcuti" ).validate({
    rules: {
      sisa_cuti: {
        required: true,
        notEqual : 0,
      },

      alasan_cuti: {
        required : true,
        notEqual : 0,
      }
    },

    messages: {
          alasan_cuti: "This field is required.",
      }
  });

  $.validator.addMethod('notEqual',function(value, element, param){
    return this.optional(element)||value != param;
  }, "Sisa Cuti Anda 0" );


    /*   
    $(document).ready(function(){
        $('#formaddcuti').submit(function(response){
            $.post($('#formaddcuti').attr('action'), $('#formaddcuti').serialize(),function(json){
                if(json.st == 0){
                    $('#MsgBad').html(json.errors).fadeIn();
                }else{
                    window.location.href = json.cuti_url;
                }
            }, 'json');
            return false;
        });
    });
    */