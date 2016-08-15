var base_url    = $("#base_url").val(),
    form        = $("#form").val(),       
    id          = $("#id").val();

$(document).ready(function() {

    $('button[data-loading-text]').click(function () {
    $(this).button('loading');
    });

    var uriSubmit = base_url+form+'/do_submit/'+id;
    var uriCancel = base_url+form+'/do_cancel/'+id;

    $('#btn_submit').click(function(){
        $('#formSpdLuar').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: uriSubmit,
                data: $('#formSpdLuar').serialize(),
                success: function() {
                     location.reload()
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_cancel').click(function(){
        var $btn = $(this).button('loading');
        $('#formcancel').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: uriCancel,
                data: $('#formcancel').serialize(),
                success: function() {
                      $("[data-dismiss=modal]").trigger({ type: "click" });
                    location.reload(),
                    $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });
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
    uri = base_url+form+'/submit/'+id+'/'+lv;
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
	 