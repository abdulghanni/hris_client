var baseurl = $("#base_url").val();
$(document).ready(function() {
    $(".select2").select2();

   	$("#emp").change(function() {
    	var empId = $(this).val();
        var comp_session_id = $('#comp_session_id').val();
    	if(empId!=0)getEmpData(empId,comp_session_id);
    	
    });

    $('.tanggal')
        .datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "yyyy-mm-dd"
        });
});

function getEmpData(empId,comp_session_id)
{
    if(empId != 0)
    {
        $('#loading_kompetensi').show();
        $.ajax({
            url : baseurl+'competency/personal_assesment/get_mapping/'+empId+'/'+comp_session_id,
            type: "POST",
            success: function(data2)
            {   
                $('#loading_kompetensi').hide();
                $("#savebutton").prop('disabled', false);
                $("#result").html(data2);
                $(document).find("select.select2").select2({
                dropdownAutoWidth : true
            });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $('#loading_kompetensi').hide();
                alert('Terjadi Kesalahan, Silakan Refresh Halaman Ini');
            }
        });
    }else
    {
        $('#loading_kompetensi').hide();
    }        
}
