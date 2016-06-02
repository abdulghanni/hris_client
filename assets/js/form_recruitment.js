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

	var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
    var uri1 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv1';
    var uri2 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv2';
    var uri3 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv3';
    var uri4 = url.segment(2)+'/do_approve/'+url.segment(4)+'/hrd';
    var uriJurusan = url.segment(2)+'/add_jurusan/';
            
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

    $('#btnAddJurusan').click(function(){
        var $btn = $(this).button('loading');
            $.ajax({
                url : baseurl+uriJurusan,
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
            url: baseurl+'dropdown/get_atasan2/'+empId,
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
            url: baseurl+'dropdown/get_atasan3/'+empId,
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
	 