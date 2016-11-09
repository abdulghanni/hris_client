$(document).ready(function() {
    $(".select2").select2();
    $('.input-append.date')
        .datepicker({todayHighlight: true, format: "yyyy-mm-dd"})
        .on('changeDate', function(ev){
            $(this).datepicker('hide').blur();
    });

      $('input:radio[name=competency_evaluasi_training_id]').click(function() {
      var val = $('input:radio[name=competency_evaluasi_training_id]:checked').val();
      if(val==5){
        $('#competency_evaluasi_training_lain').show("slow");
      }else{
        $('#competency_evaluasi_training_lain').hide("slow");
      }
    });

});

function addKeterampilan(tableID){
    var table=document.getElementById(tableID);
    var rowCount=table.rows.length;
    $("#btnAdd").attr('disabled',true);
    $("#btnAdd").text('loading....');
    $.ajax({
        url: base_url+'competency/form_evaluasi_training/add_keterampilan/'+rowCount,
        success: function(response){
            $("#"+tableID).find('tbody').append(response);	
            $("#btnAdd").attr('disabled',false);
            $("#btnAdd").text('Tambah Point Keterampilan');
            $(document).find("select.select2").select2({
                dropdownAutoWidth : true
            });
         },
         dataType:"html"
    });
}