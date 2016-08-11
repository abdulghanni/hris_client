$(document).ready(function() {              

//approval absen
$('button[data-loading-text]').click(function () {
    $(this).button('loading');
    });

    var base_url    = $("#base_url").val(),
        form        = $("#form").val(),       
        id          = $("#id").val(),       
        uri1        = base_url+form+'/do_approve/'+id+'/lv1';
        uri2        = base_url+form+'/do_approve/'+id+'/lv2';
        uri3        = base_url+form+'/do_approve/'+id+'/lv3';
        uri4        = base_url+form+'/do_approve/'+id+'/hrd';
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
                url: uri4,
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
