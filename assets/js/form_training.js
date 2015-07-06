$(document).ready(function() {
    $('#limit').select2();                  
    $(".select2").select2();

    $('.timepicker-24').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false
     });

    $("#tanggal_mulai").datepicker({format: "yyyy-mm-dd", todayHighlight: true});
    $("#tanggal_akhir").datepicker({format: "yyyy-mm-dd", todayHighlight: true});

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
     

    $('#besar_biaya').maskMoney({precision: 0});

    $('button[data-loading-text]').click(function () {
    $(this).button('loading');
    });

    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
    var uri1 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv1';
    var uri2 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv2';
    var uri3 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv3';
    var uri4 = url.segment(2)+'/do_approve_hrd/'+url.segment(4);

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

//add training
    $('#formaddtraining').submit(function(response){
        $.post($('#formaddtraining').attr('action'), $('#formaddtraining').serialize(),function(json){
            if(json.st == 0){
                $('#MsgBad').html(json.errors).fadeIn();
            }else{
                window.location.href = baseurl+url.segment(2);
            }
        }, 'json');
        return false;
    });

});	