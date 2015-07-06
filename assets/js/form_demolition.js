$(document).ready(function() {
    //$("div#myId").dropzone({ url: "/file/post" });
    
    $('.input-append.date')
        .datepicker({todayHighlight: true})
        .on('changeDate', function(ev){
            $(this).datepicker('hide').blur();
    });

                    
    $(".select2").select2();

    $("#org").select2({
        placeholder: "Search for a organization",
        //minimumInputLength: 3,
    });

    $("#pos").select2({
        placeholder: "Search for a position",
        //minimumInputLength: 3,
    });
                
    $('#formadddemolition').submit(function(response){
        $.post($('#formadddemolition').attr('action'), $('#formadddemolition').serialize(),function(json){
            if(json.st == 0){
                $('#MsgBad').html(json.errors).fadeIn();
            }else{
                window.location.href = json.demolition_url;
            }
        }, 'json');
        return false;
    });

    //approval script

    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
    var uri1 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv1';
    var uri2 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv2';
    var uri3 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv3';
    var uri4 = url.segment(2)+'/do_approve/'+url.segment(4)+'/hrd';
    
    $('button[data-loading-text]').click(function () {
    $(this).button('loading');
    });

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

    $("#emp").change(function() {
            var empId = $(this).val();
            get_employee_org(empId);
            get_employee_pos(empId);
            get_employee_orgid(empId);
            get_employee_posid(empId);
            get_employee_nik(empId);
            get_employee_bu(empId);
            get_employee_buid(empId);
            get_employee_sendate(empId);
        })
        .change();

    $("#empDemolition").change(function() {
            var empId = $(this).val();
            get_employee_org(empId);
            get_employee_pos(empId);
            get_employee_orgid(empId);
            get_employee_posid(empId);
            get_employee_nik(empId);
            get_employee_bu(empId);
            get_employee_buid(empId);
            get_employee_sendate(empId);
            getAtasan1(empId);
        })
        .change();

     function get_employee_org(empId)
        {
            $.ajax({
                    type: 'POST',
                    url: 'get_emp_org',
                    data: {id : empId},
                    success: function(data) {
                        $('#old_org2').val(data);
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
                        $('#old_pos2').val(data);
                    }
                });
        }

        function get_employee_orgid(empId)
        {
            $.ajax({
                    type: 'POST',
                    url: 'get_emp_orgid',
                    data: {id : empId},
                    success: function(data) {
                        $('#old_org').val(data);
                    }
                });
        }

        function get_employee_posid(empId)
        {
            $.ajax({
                    type: 'POST',
                    url: 'get_emp_posid',
                    data: {id : empId},
                    success: function(data) {
                        $('#old_pos').val(data);
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

        function get_employee_bu(empId)
        {
            $.ajax({
                    type: 'POST',
                    url: 'get_emp_bu',
                    data: {id : empId},
                    success: function(data) {
                        $('#old_bu2').val(data);
                    }
                });
        }

        function get_employee_buid(empId)
        {
            $.ajax({
                    type: 'POST',
                    url: 'get_emp_buid',
                    data: {id : empId},
                    success: function(data) {
                        $('#old_bu').val(data);
                    }
                });
        }

        function get_employee_sendate(empId)
        {
            $.ajax({
                    type: 'POST',
                    url: 'get_emp_sendate',
                    data: {id : empId},
                    success: function(data) {
                        $('#seniority_date').val(data);
                    }
                });
        }

        function getAtasan1(empId)
        {
         $.ajax({
                type: 'POST',
                url: baseurl+'dropdown/get_atasan/'+empId,
                data: {id : empId},
                success: function(data) {
                    $('#atasan1').html(data);
                }
            });
        }
}); 