$(document).ready(function() {				
  $(".select2").select2();
  $('#limit').select2();

	 $( "#formadd" ).validate({
    rules: {
      atasan1: {notEqual:0}
    },

    messages: {
          atasan1 : "Silakan Pilih Atasan"
      }
  });

	var base_url    = $("#base_url").val(),
        form        = $("#form").val(),       
        id          = $("#id").val(),       
        uri1        = base_url+form+'/do_approve/'+id+'/lv1';
        uri2        = base_url+form+'/do_approve/'+id+'/lv2';
        uri3        = base_url+form+'/do_approve/'+id+'/lv3';
        uri4        = base_url+form+'/do_approve/'+id+'/hrd';
    var uriJurusan  = base_url+form+'/add_jurusan/';
            
    //approval script

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
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btnAddJurusan').click(function(){
        var $btn = $(this).button('loading');
            $.ajax({
                url : uriJurusan,
                type: "POST",
                data: $('#formAddJurusan').serialize(),
                success: function(data)
                {
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                    $("#jurusan").html(data);
                    $btn.button('reset');
                }
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
/*
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
   */
   $("#atasan1").change(function() {
            var empId = $(this).val();
            getAtasan2(empId);
            //getAtasan3(empId);
        })
        .change();


    function getAtasan2(empId)
    {
     $.ajax({
            type: 'POST',
            url: 'dropdown/get_atasan2/'+empId,
            data: {id : empId},
            success: function(data) {
                $('#atasan2').html(data);
            }
        });
    }

    function getAtasan3(empId)
    {
     $.ajax({
            type: 'POST',
            url: 'dropdown/get_atasan3/'+empId,
            data: {id : empId},
            success: function(data) {
                $('#atasan3').html(data);
            }
        });
    }

    
  $.validator.addMethod('notEqual',function(value, element, param){
    return this.optional(element)||value != param;
  });

});	
	 