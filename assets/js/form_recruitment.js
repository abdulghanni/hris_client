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
	 