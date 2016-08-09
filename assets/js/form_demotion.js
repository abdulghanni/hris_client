$(document).ready(function() {
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

    //approval script
    var base_url    = $("#base_url").val(),
        form        = $("#form").val(),       
        id          = $("#id").val(),       
        uri1        = base_url+form+'/do_approve/'+id+'/lv1';
        uri2        = base_url+form+'/do_approve/'+id+'/lv2';
        uri3        = base_url+form+'/do_approve/'+id+'/lv3';
        uri4        = base_url+form+'/do_approve/'+id+'/lv4';
        uri5        = base_url+form+'/do_approve/'+id+'/lv5';
        urihrd      = base_url+form+'/do_approve/'+id+'/hrd';
    
    $('button[data-loading-text]').click(function () {
    $(this).button('loading');
    });

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
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_lv4').click(function(){
        var $btn = $(this).button('loading');
        $('#formAppLv4').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: uri4,
                data: $('#formAppLv4').serialize(),
                success: function() {
                      reload_status('lv4');
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                    $btn.button('reset');   
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_lv5').click(function(){
        var $btn = $(this).button('loading');
        $('#formAppLv5').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: uri5,
                data: $('#formAppLv5').serialize(),
                success: function() {
                      reload_status('lv5');
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                    $btn.button('reset');   
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
                url: urihrd,
                data: $('#formAppHrd').serialize(),
                success: function() {
                     reload_status('hrd');
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                    $btn.button('reset');   
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

    $( "#formadd" ).validate({
        rules: {
          atasan1: {notEqual:0}
    },

    messages: {
          atasan1 : "Silakan Pilih Atasan"
      }
  });
}); 