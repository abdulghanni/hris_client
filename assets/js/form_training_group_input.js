$(document).ready(function() {  
    var base_url = $("#base_url").val();
    $("select.select2").select2();
    $('#btnAdd').on('click', function () {
      $(document).find("select.select2").select2();
      $('#btnRemove').show();
      $('#btnSave').show();
      $('#btnCancel').show();
    });
    
    $( "#formadd" ).validate({
        rules: {
          atasan1: {notEqual:0}
        },

        messages: {
              atasan1 : "Silakan Pilih Atasan"
          }
    });

    $.validator.addMethod('notEqual',function(value, element, param){
        return this.optional(element)||value != param;
    });

    $("#training_id").click(function(){
      var training_id = $("#training_id").val();
      $.ajax({
            type: 'POST',
            url: base_url+'form_training_group/get_training/',
            data: {id : training_id},
            dataType : "json",
            success: function(response) {
              if(response.status == true)
              {
                /*<!-- 'date_start'=>$date_start,
                                    'date_end'=>$date_end,
                                    'training_type_id'=>$training_type_id,
                                    'penyelenggara_id'=>$penyelenggara_id,
                                    'pembiayaan_id'=>$pembiayaan_id,
                                    'ikatan_dinas_id'=>$ikatan_dinas_id,
                                    'waktu_id'=>$waktu_id,
                                    'besar_biaya'=>$besar_biaya,
                                    'tempat'=>$tempat,
                                    'jam_mulai'=>$jam_mulai,
                                    'jam_akhir'=>$jam_akhir,
                                    'narasumber'=>$narasumber -->*/
                $('#training_name').val(response.training_name);
                $('#tujuan_training').val(response.tujuan_training);
                $('#date_start').val(response.date_start);
                $('#date_end').val(response.date_end);
                $('#training_type_id').val(response.training_type_id);
                $('#penyelenggara_id').val(response.penyelenggara_id);
                $('#pembiayaan_id').val(response.pembiayaan_id);
                $('#ikatan_dinas_id').val(response.ikatan_dinas_id);
                $('#waktu_id').val(response.waktu_id);
                $('#besar_biaya').val(response.besar_biaya);
                $('#tempat').val(response.tempat);
                $('#jam_mulai').val(response.jam_mulai);
                $('#jam_akhir').val(response.jam_akhir);
                $('#narasumber').val(response.narasumber);
                $('#vendor_id').val(response.vendor_id);
              }else
              {
                alert('Training data : ' + response.message);
              }
            }
        });
    });
   

});	
