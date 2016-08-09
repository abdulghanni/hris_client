$(document).ready(function() {                
    $(".select2").select2();
    $('#limit').select2();  

    $('.timepicker-24').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false
     });

    $("#tanggal_mulai").datepicker({format: "yyyy-mm-dd", todayHighlight: true});
    $("#tanggal_akhir").datepicker({format: "yyyy-mm-dd", todayHighlight: true});

    $('#btnAdd').on('click', function () {
      $(document).find("select.select2").select2();
      $('#btnRemove').show();
      $('#btnSave').show();
      $('#btnCancel').show();
    });
    
  //Date Pickers
    $('.input-append.date')
        .datepicker({format: "yyyy-mm-dd", todayHighlight: true})
        .on('changeDate', function(ev){
            days();
            $(this).datepicker('hide').blur();
    });

    function days() {
    var From_date = new Date($("#tanggal_mulai").val());
    var To_date = new Date($("#tanggal_akhir").val());
    var diff_date =  To_date - From_date;
     
    var years = Math.floor(diff_date/31536000000);
    var months = Math.floor((diff_date)/2628000000);
    var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000 + 1);
    $("#lama_training_bulan").val(months+" Bulan");
    $("#lama_training_hari").val(days+" Hari");
    //alert( years+" year(s) "+months+" month(s) "+days+" and day(s)");
    /*var From_date_update = new Date($("#tanggal_mulai_update").val());
    var To_date_update = new Date($("#tanggal_akhir_update").val());
    var diff_date_update =  To_date_update - From_date_update;
     
    var months_update = Math.floor((diff_date_update)/2628000000);
    var days_update = Math.floor(((diff_date_update % 31536000000) % 2628000000)/86400000 + 1);
    $("#lama_training_bulan_update").val(months_update+" Bulan");
    $("#lama_training_hari_update").val(days_update+" Hari");
    */
    }
     

    $('#besar_biaya').maskMoney({precision: 0, allowZero:true});

    $('button[data-loading-text]').click(function () {
    $(this).button('loading');
    });

    //approval script
    var base_url    = $("#base_url").val(),
        form        = $("#form").val(),       
        id          = $("#id").val(),       
        uri1        = base_url+form+'/do_approve/'+id+'/lv1';
        uri2        = base_url+form+'/do_approve/'+id+'/lv2';
        uri3        = base_url+form+'/do_approve/'+id+'/lv3';
        uri4 = base_url+form+'/do_approve_hrd/'+id;
    $('#btn_app_lv1').click(function(){
        var $btn = $(this).button('loading');
        $('#formAppLv1').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: uri1,
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
                url: uri2,
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
                url: uri3,
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
                url: uri4,
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

$( "#formadd" ).validate({
    rules: {
      atasan1: {notEqual:0}
    },

    messages: {
          atasan1 : "Silakan Pilih Atasan"
      }
  });

});	