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
    
   //approval script
    var base_url    = $("#base_url").val(),
        form        = $("#form").val(),       
        id          = $("#id").val(),       
        uri1        = base_url+form+'/do_approve/'+id+'/lv1';
        uri2        = base_url+form+'/do_approve/'+id+'/lv2';
        uri3        = base_url+form+'/do_approve/'+id+'/lv3';
        uri4        = base_url+form+'/do_approve/'+id+'/hrd';
        uri5        = base_url+form+'/kirim_undangan/'+id;

    $( "#formadd" ).validate({
        rules: {
          atasan1: {notEqual:0}
        },

        messages: {
              atasan1 : "Silakan Pilih Atasan"
          }
    });

    $("#hrd_list").change(function() {
        var empId = $(this).val();
        getHrdPhone(empId);
    })
    .change();

    function getHrdPhone(empId)
    {
        $.ajax({
            type: 'POST',
            url: '../get_hrd_phone',
            data: {id : empId},
            success: function(data) {
                $('#hrd_phone').val(data);
            }
        });
    }
            
    //approval script

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

    $('#btn_app_hrd').click(function(){
        $('#formAppHrd').submit(function(ev){
            var $btn = $('#btn_app_hrd').button('loading');
            $.ajax({
                type: 'POST',
                url: uri4,
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

    $('#btn_undangan').click(function(){
        $('#formUndangan').submit(function(ev){
            var $btn = $('#btn_undangan').button('loading');
            $.ajax({
                type: 'POST',
                url: uri5,
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
});	
	 