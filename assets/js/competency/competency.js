var base_url    = $("#base_url").val();
function addApprover(tableID){
    var table=document.getElementById(tableID);
    var rowCount=table.rows.length;
    $("#btnAddApprover").attr('disabled',true);
    $("#btnAddApprover").text('loading....');
    $.ajax({
        url: base_url+'competency/general/get_approver/'+rowCount,
        success: function(response){
            $("#"+tableID).find('tbody').append(response);
            $("#submit").show();	
            $("#btnAddApprover").attr('disabled',false);
            $("#btnAddApprover").text('Tambah Atasan');
            $(document).find("select.select2").select2({
                dropdownAutoWidth : true
            });
         },
         dataType:"html"
    });
}


$(document).on('click', 'button.removebutton', function () {
 $(this).closest('tr').remove();
 return false;
});