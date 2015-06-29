$(document).ready(function() {

    $('.timepicker-24').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false
     });
                    
    $(".select2").select2();


  //Date Pickers
  $('.input-append.date').datepicker({
            autoclose: true,
            todayHighlight: true
   });



    $("#emp_tc").change(function() {
        var empId = $(this).val();
        get_employee_org_tc(empId);
        get_employee_pos_tc(empId);
        getAtasan1(empId);
    })
    .change();

    $("#employee_sel").change(function() {
        var empId = $(this).val();
        get_employee_org(empId);
        get_employee_pos(empId);
    })
    .change();

    function get_employee_org(empId)
    {
        $.ajax({
                type: 'POST',
                url: 'get_emp_org',
                data: {id : empId},
                success: function(data) {
                    $('#org_tr').val(data);
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
                    $('#pos_tr').val(data);
                }
            });
    }

    function get_employee_org_tc(empId)
    {
        $.ajax({
                type: 'POST',
                url: 'get_emp_org',
                data: {id : empId},
                success: function(data) {
                    $('#org_tc').val(data);
                }
            });
    }

    function get_employee_pos_tc(empId)
    {
        $.ajax({
                type: 'POST',
                url: 'get_emp_pos',
                data: {id : empId},
                success: function(data) {
                    $('#pos_tc').val(data);
                }
            });
    }

    function getAtasan1(empId)
    {
     $.ajax({
            type: 'POST',
            url: 'get_atasan',
            data: {id : empId},
            success: function(data) {
                $('#employee_sel').html(data);
            }
        });
    }

    //add spd_dalam
    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
    var spd_dalam_url = baseurl+'form_spd_dalam';
                $('#add_spd_dalam').submit(function(response){
                    $.post($('#add_spd_dalam').attr('action'), $('#add_spd_dalam').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad').html(json.errors).fadeIn();
                        }else{
                            window.location.href = spd_dalam_url;
                        }
                    }, 'json');
                    return false;
                });

    //add spd_dalam_report
    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/hris_client/';
    var spd_dalam_url = baseurl+'form_spd_dalam';
                $('#add_spd_dalam_report').submit(function(response){
                    $.post($('#add_spd_dalam_report').attr('action'), $('#add_spd_dalam_report').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad').html(json.errors).fadeIn();
                        }else{
                            window.location.href = spd_dalam_url;
                        }
                    }, 'json');
                    return false;
                });
}); 
     