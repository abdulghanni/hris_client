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

    $("#emp").change(function() {
            var empId = $(this).val();
            get_employee_org(empId);
            get_employee_pos(empId);
            get_employee_orgid(empId);
            get_employee_posid(empId);
            get_employee_nik(empId);
            get_employee_bu(empId);
            get_employee_buid(empId);
            get_employee_sen_date(empId)
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
}); 