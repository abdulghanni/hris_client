var base_url    = $("#base_url").val(),
    form        = $("#form").val(),       
    id          = $("#id").val();

$(document).ready(function() {
    var businessunit = $('#bu').val();

    if(businessunit = 'BU Jakarta'){
        $('#akunting').hide();
        $('#audit').hide();
    }


});

function approve(lv)
{
    $('#btnApp'+lv).text('saving...'); //change button text
    $('#btnApp'+lv).attr('disabled',true); //set button disable 
    url  = base_url+form+'/do_approve/'+id+'/'+lv;
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#formApp'+lv).serialize(),
        //dataType: "JSON",
        success: function()
        {
            reload_status(lv);
            $('#btnApp'+lv).text('save'); //change button text
            $('#btnApp'+lv).attr('disabled',false); //set button enable
            $("[data-dismiss=modal]").trigger({ type: "click" });  
            send_notif(lv);   
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnApp'+lv).text('save'); //change button text
            $('#btnApp'+lv).attr('disabled',false); //set button enable 

        }
    });
}

function reload_status(lv)
{
    uri = base_url+form+'/detail/'+id+'/'+lv;
    $('#'+lv).html('<img src="/hris_client/assets/img/loading.gif"> loading...');
    $('#note').html('<img src="/hris_client/assets/img/loading.gif"> loading...');
    $.ajax({
        type: 'POST',
        url: uri,
        dataType: "JSON",
        success: function(data) {
            $('#'+lv).html(data.app);
            $('#note').html(data.note);
        }
    });
}

function send_notif(lv)
{
    uri = base_url+form+'/send_notif/'+id+'/'+lv;
    $.ajax({
        type: 'POST',
        url: uri,
        // dataType: "JSON",
        success: function() {
            console.log('y');
        },
        error: function(){
            console.log('e');
        }
    });
}   

function send_notif_(lv)
{
    uri = base_url+form+'/send_notif/'+id+'/'+lv;
    $.ajax({
        type: 'POST',
        url: uri,
        // dataType: "JSON",
        success: function() {
            console.log('y');
            alert('Email notifikasi ke approver berikutnya BERHASIL terkirim.');
        },
        error: function(){
            console.log('e');
            alert('Email notifikasi ke approver berikutnya GAGAL terkirim.');
        }
    });
}   
