$(document).ready(function() {            
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
    $('#besar_biaya').maskMoney({precision: 0, allowZero:true});
}); 