$(document).ready(function() {
    //$("div#myId").dropzone({ url: "/file/post" });
    
    $('.timepicker-24').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false
     });
                    
    $(".select2").select2();
    $('#btnAdd').on('click', function () {
    $(document).find("select.select2").select2();
    $('#btnRemove').show();
    });

    $('button[data-loading-text]').click(function () {
    $(this).button('loading');
    });

    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
    var uri1 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv1';
    var uri2 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv2';
    var uri3 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv3';
    var uri4 = url.segment(2)+'/do_approve/'+url.segment(4)+'/hrd';
    var uriSubmit = url.segment(2)+'/do_submit/'+url.segment(4);

    $('#btn_submit').click(function(){
        $('#formSpdDalam').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uriSubmit,
                data: $('#formSpdDalam').serialize(),
                success: function() {
                     location.reload()
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_lv1').click(function(){
        $('#formSpdDalam').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri1,
                data: $('#formSpdDalam').serialize(),
                success: function() {
                     location.reload()
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_lv2').click(function(){
        $('#formSpdDalam').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri2,
                data: $('#formSpdDalam').serialize(),
                success: function() {
                     location.reload()
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_lv3').click(function(){
        $('#formSpdDalam').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri3,
                data: $('#formSpdDalam').serialize(),
                success: function() {
                     location.reload()
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_hrd').click(function(){
        $('#formSpdDalam').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri4,
                data: $('#formSpdDalam').serialize(),
                success: function() {
                     location.reload()
                }
            });
            ev.preventDefault(); 
        });  
    });


    //add spd_dalam_group
    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/hris_client/';
    var spd_dalam_group_url = baseurl+'form_spd_dalam_group';
                $('#add_spd_dalam_group').submit(function(response){
                    $.post($('#add_spd_dalam_group').attr('action'), $('#add_spd_dalam_group').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad').html(json.errors).fadeIn();
                        }else{
                            window.location.href = spd_dalam_group_url;
                        }
                    }, 'json');
                    return false;
                });

    //add spd_dalam_group_report
    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/hris_client/';
    var spd_dalam_group_url = baseurl+'form_spd_dalam_group';
                $('#add_spd_dalam_group_report').submit(function(response){
                    $.post($('#add_spd_dalam_group_report').attr('action'), $('#add_spd_dalam_group_report').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad').html(json.errors).fadeIn();
                        }else{
                            window.location.href = spd_dalam_group_url;
                        }
                    }, 'json');
                    return false;
                });


    //Date Pickers
      $('.input-append.date').datepicker({
                autoclose: true,
                todayHighlight: true
       });
}); 
     