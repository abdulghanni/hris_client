var base_url    = $("#base_url").val();
$(document).ready(function() {
    $(".select2").select2();
    $("#org").change(function() {
        var id = $(this).val();
        if(id!=0){
            $.ajax({
                url : base_url+'competency/mapping_standar/get_mapping_from_org/'+id,
                type: "POST",
                success: function(data)
                {  
                    $("#mapping-standar").html(data);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Terjadi Kesalahan, Silakan Refresh Halaman Ini');
                }
            });
        }
    })
    .change();
});