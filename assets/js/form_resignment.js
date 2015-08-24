$(document).ready(function() {	
	$(".select2").select2();
	$('#limit').select2();
	$('.input-append.date').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                todayHighlight: true
       });

    $('.timepicker-24').timepicker({
                minuteStep: 1,
                //showSeconds: true,
                showMeridian: false
     });
    
    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
    var uri1 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv1';
    var uri2 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv2';
    var uri3 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv3';
    var uri4 = url.segment(2)+'/do_approve/'+url.segment(4)+'/hrd';
    var uri5 = url.segment(2)+'/kirim_undangan/'+url.segment(4);

    $('#formaddresign').submit(function(response){
        $.post($('#formaddresign').attr('action'), $('#formaddresign').serialize(),function(json){
            if(json.st == 0){
                $('#MsgBad').html(json.errors).fadeIn();
            }else{
                window.location.href = baseurl+url.segment(2);
            }
        }, 'json');
        return false;
    });
            
    //approval script

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
        $('#formAppHrd').submit(function(ev){
            var $btn = $('#btn_app_hrd').button('loading');
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

    $('#btn_undangan').click(function(){
        $('#formUndangan').submit(function(ev){
            var $btn = $('#btn_undangan').button('loading');
            $.ajax({
                type: 'POST',
                url: baseurl+uri5,
                data: $('#formUndangan').serialize(),
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
	 