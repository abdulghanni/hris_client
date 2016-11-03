var baseurl = $("#base_url").val();
$(document).ready(function() {
    $(".select2").select2();

   	$("#emp").change(function() {
    	var empId = $(this).val();
    	if(empId!=0)getEmpData(empId);
    	
    });
});

function getEmpData(empId)
    {
        $.ajax({
            url : baseurl+'competency/personal_assesment/get_mapping/'+empId,
            type: "POST",
            success: function(data2)
            {  
                $("#result").html(data2);
                $(document).find("select.select2").select2({
                dropdownAutoWidth : true
            });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Terjadi Kesalahan, Silakan Refresh Halaman Ini');
            }
        });
    }