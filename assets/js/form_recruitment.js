$(document).ready(function() {				
	$(".select2").select2();
  $('#limit').select2();

	 $('#formaddrecruitment').submit(function(response){
        $.post($('#formaddrecruitment').attr('action'), $('#formaddrecruitment').serialize(),function(json){
            if(json.st == 0){
                $('#MsgBad').html(json.errors).fadeIn();
            }else{
                window.location.href = json.recruitment_url;
            }
        }, 'json');
        return false;
    });

	  var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
    var uri1 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv1';
    var uri2 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv2';
    var uri3 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv3';
    var uri4 = url.segment(2)+'/do_approve/'+url.segment(4)+'/hrd';

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

   $('#jumlah').keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8 ) {
            // let it happen, don't do anything
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault(); 
            }   
        }
    });
});	
	 