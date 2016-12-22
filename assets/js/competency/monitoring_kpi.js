var base_url    = $("#base_url").val();
$(window).load(function() {
    $("#org-field").html('Memuat data....');
    $("#periode").html('Memuat data....');

    $.ajax({
        url : base_url+'competency/monitoring_kpi/get_periode/',
        type: "POST",
        success: function(data)
        {  
            $("#periode").html(data);
            $(document).find("select.select2").select2({
                dropdownAutoWidth : true
            });
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Terjadi Kesalahan, Silakan Refresh Halaman Ini');
        }
    });

    $.ajax({
        url : base_url+'competency/monitoring_kpi/get_organization/',
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
        var comp_session_id = $("#comp_session_id").val();
        if(id!=0){
            $.ajax({
                url : base_url+'competency/form_kpi/get_kpi/'+id+'/'+comp_session_id,
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