$(document).ready(function() {              
    $(".select2").select2();

    //Date Pickers

      $('.input-append.date')
        .datepicker({todayHighlight: true})
        .on('changeDate', function(ev){
            days();
            $(this).datepicker('hide').blur();
    });


    function days() {
                var a = $("#datepicker_start").datepicker('getFormattedDate'),
                    b = $("#datepicker_end").datepicker('getFormattedDate'),
                    c = 24*60*60*1000,
                    diffDays = Math.floor(( Date.parse(b) - Date.parse(a) ) / c);
                $("#jml_hari").val(diffDays);
                $("#jml_cuti").val(diffDays);
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

$("#emp").change(function() {
        var empId = $(this).val();
        get_employee_org(empId);
    })
    .change();

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
      

//approval absen
var url = $.url();
var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/';
var absen_url = baseurl+'hris_client/form_absen';
var uri1 = absen_url+'/do_approve_spv/'+url.segment(4);
var uri2 = absen_url+'/do_approve_kbg/'+url.segment(4);
    $('#btn_app_lv1').click(function(){
        $('#formAppLv1').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: uri1,
                data: $('#formAppLv1').serialize(),
                success: function() {
                    setTimeout(function(){
                        location.reload()},
                       2000
                    )
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_lv2').click(function(){
        $('#formAppLv2').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: uri2,
                data: $('#formAppLv2').serialize(),
                success: function() {
                    setTimeout(function(){
                        location.reload()},
                       2000
                    )
                }
            });
            ev.preventDefault(); 
        });  
    });

//input absen
$(document).ready(function(){
                $('#formaddabsen').submit(function(response){
                    $.post($('#formaddabsen').attr('action'), $('#formaddabsen').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad').html(json.errors).fadeIn();
                        }else{
                            window.location.href = absen_url;
                        }
                    }, 'json');
                    return false;
                });
            });
