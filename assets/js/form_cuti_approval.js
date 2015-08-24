$(document).ready(function() {

    //Date Pickers
    for(var i=1;i<5;i++){
    $("#datepicker_start"+i).datepicker({format: "yyyy-mm-dd", todayHighlight: true})
    $("#datepicker_end"+i).datepicker({format: "yyyy-mm-dd", todayHighlight: true})
    }
      $('.input-append.date')
        .datepicker({todayHighlight: true})
        .on('changeDate', function(ev){
            days();
            $(this).datepicker('hide').blur();
    });

    function days() 
    {   
      for(var i=1;i<5;i++){
        var dDate1 = new Date($("#datepicker_start"+i).datepicker('getFormattedDate')); 
        var dDate2 = new Date($("#datepicker_end"+i).datepicker('getFormattedDate'));

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

        $("#jml_hari"+i).val(iDateDiff + 1);// add 1 because dates are inclusive
        $("#jml_cuti"+i).val(iDateDiff + 1);
      }                         
         
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

    //approval script

    $('button[data-loading-text]').click(function () {
    $(this).button('loading');
    });

    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
    var uri1 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv1';
    var uri2 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv2';
    var uri3 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv3';
    var uri4 = url.segment(2)+'/do_approve/'+url.segment(4)+'/hrd';

    $('#btn_app_lv1').click(function(){
        var $btn = $(this).button('loading');
        $('#formAppLv1').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri1,
                data: $('#formAppLv1').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_lv2').click(function(){
        var $btn = $(this).button('loading');
        $('#formAppLv2').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri2,
                data: $('#formAppLv2').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_lv3').click(function(){
        var $btn = $(this).button('loading');
        $('#formAppLv3').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri3,
                data: $('#formAppLv3').serialize(),
                success: function() {
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                    location.reload(),
                    $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_hrd').click(function(){
        var $btn = $(this).button('loading');
        $('#formAppHrd').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri4,
                data: $('#formAppHrd').serialize(),
                success: function() {
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                    location.reload(),
                    $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });
});	
