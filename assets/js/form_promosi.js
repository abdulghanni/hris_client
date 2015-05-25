$(document).ready(function() {
    //$("div#myId").dropzone({ url: "/file/post" });
    
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
                
    $('#formaddpromosi').submit(function(response){
        $.post($('#formaddpromosi').attr('action'), $('#formaddpromosi').serialize(),function(json){
            if(json.st == 0){
                $('#MsgBad').html(json.errors).fadeIn();
            }else{
                window.location.href = json.promosi_url;
            }
        }, 'json');
        return false;
    });

    
/*function myFunction(obj)
  {
    $('#pos').empty()
    var dropDown = document.getElementById("carId");
    var carId = dropDown.options[dropDown.selectedIndex].value;
    $.ajax({
            type: "POST",
            url: "/project/main/getcars",
            data: { 'carId': carId  },
            success: function(data){
                // Parse the returned json data
                var opts = $.parseJSON(data);
                // Use jQuery's each to iterate over the opts value
                $.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                    $('#emptyDropdown').append('<option value="' + d.ModelID + '">' + d.ModelName + '</option>');
                });
            }
        });
  }

  

    $("#org").remoteChained({
            parents : "#bu",
            url : "get_emp_org",
            loading : "Memuat..."
        });*/
}); 