$(document).ready(function() {
    $(".select2").select2();

    //Date Pickers
    $(".datepicker_start").datepicker({format: "yyyy-mm-dd", todayHighlight: true})
    $(".datepicker_end").datepicker({format: "yyyy-mm-dd", todayHighlight: true})

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


    function get_employee_org(empId)
    {
        $.ajax({
                type: 'POST',
                url: 'get_emp_org',
                data: {id : empId},
                success: function(data) {
                    $('#organization').val(data);
                }
            });
    }

    function get_employee_pos(empId)
    {
        $.ajax({
                type: 'POST',
                url: 'get_emp_pos',
                data: {id : empId},
                success: function(data) {
                    $('#position').val(data);
                }
            });
    }

    function get_employee_sen_date(empId)
    {
        $.ajax({
                type: 'POST',
                url: 'get_emp_sen_date',
                data: {id : empId},
                success: function(data) {
                    $('#seniority_date').val(data);
                }
            });
    }

    function get_employee_nik(empId)
    {
        $.ajax({
                type: 'POST',
                url: 'get_emp_nik',
                data: {id : empId},
                success: function(data) {
                    $('#nik').val(data);
                }
            });
    }

    function get_employee_sisa_cuti(empId)
    {
        $.ajax({
                type: 'POST',
                url: 'get_emp_sisa_cuti',
                data: {id : empId},
                success: function(data) {
                    $('#sisa_cuti').val(data);
                }
            });
    }

    $("#emp_id").change(function() {
        var empId = $(this).val();
        get_employee_org(empId);
        get_employee_pos(empId);
        get_employee_sen_date(empId);
        get_employee_nik(empId);
        get_employee_sisa_cuti(empId);
    })
    .change();

});