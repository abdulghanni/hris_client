var base_url    = $("#base_url").val(),   
    controller  = $("#controller").val(),
    org_id      = $("#org_id").val();
function approve(sessId)
{
    $('#btnApp'+sessId).text('saving...'); //change button text
    $('#btnApp'+sessId).attr('disabled',true); //set button disable 
    url  = base_url+controller+'/do_approve/'+org_id;
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#formApp'+sessId).serialize(),
        //dataType: "JSON",
        success: function()
        {
            reload_status(sessId);
            $('#btnApp'+sessId).text('save'); //change button text
            $('#btnApp'+sessId).attr('disabled',false); //set button enable
            $("[data-dismiss=modal]").trigger({ type: "click" });  
            //send_notif(sessId);   
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnApp'+sessId).text('save'); //change button text
            $('#btnApp'+sessId).attr('disabled',false); //set button enable 

        }
    });
}

function reload_status(sessId)
{
    uri = base_url+controller+'/approve/'+org_id+'/'+sessId;
    $('#'+sessId).html('<img src="/hris_client/assets/img/loading.gif"> loading...');
    $('#note').html('<img src="/hris_client/assets/img/loading.gif"> loading...');
    $.ajax({
        type: 'POST',
        url: uri,
        dataType: "JSON",
        success: function(data) {
            $('#'+sessId).html(data.app);
            $('#note').html(data.note);
        }
    });
}

