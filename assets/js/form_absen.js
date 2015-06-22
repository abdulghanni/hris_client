$(document).ready(function() {              
$(".select2").select2();
$('#limit').select2();

$('.input-append.date').datepicker({
    format: "dd-mm-yyyy",
    autoclose: true,
    todayHighlight: true
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
        $('#formAbsen').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri1,
                data: $('#formAbsen').serialize(),
                success: function() {
                     location.reload()
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_lv2').click(function(){
        $('#formAbsen').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri2,
                data: $('#formAbsen').serialize(),
                success: function() {
                     location.reload()
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_lv3').click(function(){
        $('#formAbsen').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri3,
                data: $('#formAbsen').serialize(),
                success: function() {
                     location.reload()
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_hrd').click(function(){
        $('#formAbsen').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri4,
                data: $('#formAbsen').serialize(),
                success: function() {
                     location.reload()
                }
            });
            ev.preventDefault(); 
        });  
    });

//input absen
    $('#formaddabsen').submit(function(response){
        $.post($('#formaddabsen').attr('action'), $('#formaddabsen').serialize(),function(json){
            if(json.st == 0){
                $('#MsgBad').html(json.errors).fadeIn();
            }else{
                window.location.href = baseurl+url.segment(2);
            }
        }, 'json');
        return false;
    });
});
