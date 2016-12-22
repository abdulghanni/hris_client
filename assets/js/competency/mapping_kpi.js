var base_url    = $("#base_url").val();
$(window).load(function() {
    $("#org-field").html('Memuat data....');
    $.ajax({
        url : base_url+'competency/mapping_kpi/get_organization/',
        type: "POST",
        success: function(data)
        {  
            $("#org-field").html(data);
            $(document).find("select.select2").select2({
                dropdownAutoWidth : true
            });
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Terjadi Kesalahan, Silakan Refresh Halaman Ini');
        }
    });
});

$(document).ready(function() {
    $(".select2").select2();
    $("#org").change(function() {
        var id = $(this).val();
        if(id!=0){
            $.ajax({
                url : base_url+'competency/mapping_kpi/get_mapping_from_org/'+id,
                type: "POST",
                success: function(data)
                {  
                    $("#mapping-kpi").html(data);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Terjadi Kesalahan, Silakan Refresh Halaman Ini org');
                }
            });
        }
    })
    .change();
});