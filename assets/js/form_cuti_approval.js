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

    var base_url    = $("#base_url").val(),
        form        = $("#form").val(),       
        id          = $("#id").val(),       
        uri1        = base_url+form+'/do_approve/'+id+'/lv1';
        uri2        = base_url+form+'/do_approve/'+id+'/lv2';
        uri3        = base_url+form+'/do_approve/'+id+'/lv3';
        urihrd      = base_url+form+'/do_approve/'+id+'/hrd';

    $('#btn_app_lv1').click(function(){
        var $btn = $(this).button('loading');
        $('#formAppLv1').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: uri1,
                data: $('#formAppLv1').serialize(),
                success: function() {
                     reload_status('lv1');
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                    $btn.button('reset');  
                    send_notif('lv1'); 
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
                url: uri2,
                data: $('#formAppLv2').serialize(),
                success: function() {
                     reload_status('lv2');
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                    $btn.button('reset'); 
                    send_notif('lv2');  
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
                url: uri3,
                data: $('#formAppLv3').serialize(),
                success: function() {
                    reload_status('lv3');
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                    $btn.button('reset'); 
                    send_notif('lv3');  
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
                url: urihrd,
                data: $('#formAppHrd').serialize(),
                success: function() {
                    reload_status('hrd');
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                    $btn.button('reset'); 
                    send_notif('hrd');  
                }
            });
            ev.preventDefault(); 
        });  
    });

    function reload_status(lv)
    {
        uri = base_url+form+'/detail/'+id+'/'+lv;
        $('#'+lv).html('<img src="/hris_client/assets/img/loading.gif"> loading...');
        $('#note').html('<img src="/hris_client/assets/img/loading.gif"> loading...');
        $.ajax({
            type: 'POST',
            url: uri,
            dataType: "JSON",
            success: function(data) {
                $('#'+lv).html(data.app);
                $('#note').html(data.note);
            }
        });
    }

    function send_notif(lv)
    {
        uri = base_url+form+'/send_notif/'+id+'/'+lv;
        $.ajax({
            type: 'POST',
            url: uri,
            // dataType: "JSON",
            success: function() {
                console.log('y');
            },
            error: function(){
                console.log('e');
            }
        });
    }
});	
