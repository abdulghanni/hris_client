$(document).ready(function() {				
	$(".select2").select2();

	var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
    var uri1 = url.segment(2)+'/update/'+url.segment(4)+'/hrd';
    var uri2 = url.segment(2)+'/update/'+url.segment(4)+'/it';
    var uri3 = url.segment(2)+'/update/'+url.segment(4)+'/logistik';
    var uri4 = url.segment(2)+'/update/'+url.segment(4)+'/koperasi';
    var uri5 = url.segment(2)+'/update/'+url.segment(4)+'/perpus';
    var uri6 = url.segment(2)+'/update/'+url.segment(4)+'/keuangan';
    var urilogistik = url.segment(2)+'/do_approve/'+url.segment(4)+'/logistik';
    var urikoperasi = url.segment(2)+'/do_approve/'+url.segment(4)+'/koperasi';
    var uriperpus = url.segment(2)+'/do_approve/'+url.segment(4)+'/perpus';
    var urihrd = url.segment(2)+'/do_approve/'+url.segment(4)+'/hrd';
    var uriit = url.segment(2)+'/do_approve/'+url.segment(4)+'/it';
    var urikeuangan = url.segment(2)+'/do_approve/'+url.segment(4)+'/keuangan';

    $('#btnUpdateInvhrd').click(function(){
        var $btn = $(this).button('loading');
        $('#formUpdateInvhrd').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri1,
                data: $('#formUpdateInvhrd').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btnUpdateInvit').click(function(){
        var $btn = $(this).button('loading');
        $('#formUpdateInvit').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri2,
                data: $('#formUpdateInvit').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btnUpdateInvlogistik').click(function(){
        var $btn = $(this).button('loading');
        $('#formUpdateInvlogistik').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri3,
                data: $('#formUpdateInvlogistik').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btnUpdateInvkoperasi').click(function(){
        var $btn = $(this).button('loading');
        $('#formUpdateInvkoperasi').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri4,
                data: $('#formUpdateInvkoperasi').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btnUpdateInvperpus').click(function(){
        var $btn = $(this).button('loading');
        $('#formUpdateInvperpus').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri5,
                data: $('#formUpdateInvperpus').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btnUpdateInvkeuangan').click(function(){
        var $btn = $(this).button('loading');
        $('#formUpdateInvkeuangan').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri6,
                data: $('#formUpdateInvkeuangan').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

	$('#btnAppLv1hrd').click(function(){
        var $btn = $(this).button('loading');
            $.ajax({
                type: 'POST',
                url: baseurl+urihrd,
                data: {'submit':true},
                success: function(result) {
                     location.reload(),
                     setTimeout(function(){
                     $btn.button('reset')},
                     5000)
                }
    		});
        });

    $('#btnAppLv1it').click(function(){
        var $btn = $(this).button('loading');
            $.ajax({
                type: 'POST',
                url: baseurl+uriit,
                data: {'submit':true},
                success: function(result) {
                     location.reload(),
                     setTimeout(function(){
                     $btn.button('reset')},
                     5000)
                }
            });
        });

    $('#btnAppLv1logistik').click(function(){
        var $btn = $(this).button('loading');
            $.ajax({
                type: 'POST',
                url: baseurl+urilogistik,
                data: {'submit':true},
                success: function(result) {
                     location.reload(),
                     setTimeout(function(){
                     $btn.button('reset')},
                     5000)
                }
            });
        });

    $('#btnAppLv1koperasi').click(function(){
        var $btn = $(this).button('loading');
            $.ajax({
                type: 'POST',
                url: baseurl+urikoperasi,
                data: {'submit':true},
                success: function(result) {
                     location.reload(),
                     setTimeout(function(){
                     $btn.button('reset')},
                     5000)
                }
            });
        });

    $('#btnAppLv1perpus').click(function(){
        var $btn = $(this).button('loading');
            $.ajax({
                type: 'POST',
                url: baseurl+uriperpus,
                data: {'submit':true},
                success: function(result) {
                     location.reload(),
                     setTimeout(function(){
                     $btn.button('reset')},
                     5000)
                }
            });
        });

    $('#btnAppLv1keuangan').click(function(){
        var $btn = $(this).button('loading');
            $.ajax({
                type: 'POST',
                url: baseurl+urikeuangan,
                data: {'submit':true},
                success: function(result) {
                     location.reload(),
                     setTimeout(function(){
                     $btn.button('reset')},
                     5000)
                }
            });
        });

    $(".cek:not(:checked)").each(function() {
        $("#btnRemove").hide();
    });

    $(".cek:checkbox").click(function(){
         $("#btnRemove").show();
    });

    $('#btnUpdateInv').click(function(){
        $(this).hide();
        $("#btnAdd").show();
        $(".no").hide();
        $(".cek").show();
        $("#update-button").show("slow");
        $("#atasan").show("slow");
        $("#ttd").hide("slow");
        $('.note').attr('disabled',false);
    });

    $("#btnRemove").on("click", function () {
        $('table tr').has('input[name="row"]:checked').remove();
    })

    $("#btnCancel").on("click", function () {
        $('#btnCancel').text('Canceling...'); //change button text
        location.reload();
    })

    $("#btnSave").on("click", function () {
        $('#btnSave').text('saving'); //change button text
        $('#btnSave').attr('disabled',true); //set button enable
        var exit_id = $("#exit_id").val(),
            type = $("#type").val();
        $.ajax({
            url : '../inventory/add_inventory/'+exit_id+"/"+type,
            type: "POST",
            data: $('#formInv').serialize(),
            dataType: "html",
            success: function(data)
            {
                $("#btnUpdateInv").show();
                $("#btnAdd").hide();
                $(".no").show();
                $(".cek").hide();
                $("#update-button").hide("slow");
                $("#atasan").hide("slow");
                $("#ttd").show("slow");
                $('#btnSave').text('saving'); //change button text
                $('#btnSave').attr('disabled',true); //set button enable
                $("#table").html(data);
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 

            }
        });
    })

});

function addRow(tableID){
    $("#col-null").remove();
    $("#update-button").show("slow");
    $("#atasan").show("slow");
    $("#ttd").hide("slow");
    
    var table=document.getElementById(tableID),
        isBaru = $("#baru").val(),
        rowCount = 1;
    if(isBaru == 1){
        rowCount=table.rows.length-1;
    }else{
        rowCount=table.rows.length;
    }
    $.ajax({
            url: '../inventory/add_row/'+rowCount,
            success: function(response){
                $("#"+tableID).find('tbody').append(response);
             },
             dataType:"html"
        });
    
}