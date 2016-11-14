var base_url    = $("#base_url").val();
$(document).ready(function() {
    $(".select2").select2();
    $("#org").change(function() {
        var id = $(this).val();
        if(id!=0){
            $.ajax({
                url : base_url+'competency/mapping_indikator/get_mapping_from_org/'+id,
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

function addRow(tableID){
    var table=document.getElementById(tableID);
    var rowCount=table.rows.length;
    $("#btnAdd").attr('disabled',true);
    $.ajax({
        url: base_url+'competency/mapping_indikator/add_row/'+rowCount,
        success: function(response){
            $("#"+tableID).find('tbody').append(response);
            $("#submit").show();
            $("#btnAdd").attr('disabled',false);
            $("#approver").show();
            $(document).find("select.select2").select2({
                dropdownAutoWidth : true
            });
         },
         dataType:"html"
    });
}

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
            $("#btnAddApprover").text('Tambah Approver');
            $(document).find("select.select2").select2({
                dropdownAutoWidth : true
            });
         },
         dataType:"html"
    });
}

function deleteRow(tableID){
    try{
        var table=document.getElementById(tableID);
        var rowCount=table.rows.length;
        for(var i=0;i<rowCount;i++){
            var row=table.rows[i];
            var chkbox=row.cells[0].childNodes[0];
            if(null!=chkbox&&true==chkbox.checked){
                table.deleteRow(i);rowCount--;i--;}}}
    catch(e){alert(e);}}



$(document).on('click', 'button.removebutton', function () {
 $(this).closest('tr').remove();
 return false;
});
