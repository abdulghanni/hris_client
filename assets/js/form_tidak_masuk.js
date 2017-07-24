var base_url    = $("#base_url").val(),
        form        = $("#form").val(),       
        id          = $("#id").val(),       
        uri1        = base_url+form+'/do_approve/'+id+'/lv1';
        uri2        = base_url+form+'/do_approve/'+id+'/lv2';
        uri3        = base_url+form+'/do_approve/'+id+'/lv3';
        uri4        = base_url+form+'/do_approve/'+id+'/hrd';
    
$(document).ready(function() {              
//$(".select2").select2();
//approval absen
    $('button[data-loading-text]').click(function () {
        $(this).button('loading');
    });

    $('#btn_app_lv1').click(function(){
        var $btn = $(this).button('loading');
        $.ajax({
            url : uri1,
            type: "POST",
            data: $('#formAppLv1').serialize(),
            success: function(data)
            {
                reload_status('lv1');
                $("[data-dismiss=modal]").trigger({ type: "click" });
                $btn.button('reset');   
                send_notif('lv1');  
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Terjadi Kesalahan, Silakan Refresh Halaman Ini');
                $btn.button('reset');
            }
        });
    });

    $('#btn_app_lv2').click(function(){
        var $btn = $(this).button('loading');
        $('#formAppLv2').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: uri2,
                data: $('#formAppLv2').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     reload_status('lv2');
                     $btn.button('reset');
                     send_notif('lv2');  
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_lv3').click(function(){
        var $btn = $(this).button('loading');
        $('#formAppLv3').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: uri3,
                data: $('#formAppLv3').serialize(),
                success: function() {
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                     reload_status('lv3');
                     $btn.button('reset');
                     send_notif('lv3');  
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_hrd').click(function(){
        var $btn = $(this).button('loading');
        $('#formAppHrd').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: uri4,
                data: $('#formAppHrd').serialize(),
                success: function() {
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                     reload_status('hrd');
                     $btn.button('reset');
                     send_notif('hrd');  
                }
            });
            ev.preventDefault(); 
        });  
    });



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
});

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

function approve1()
    {
        $('#btnApp').text('saving...'); //change button text
        $('#btnApp').attr('disabled',true); //set button disable 
        var url = uri1;
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#formAppLv1').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if(data) //if success close modal and reload ajax table
                {
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                    location.reload()
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnApp').text('save'); //change button text
                $('#btnApp').attr('disabled',false); //set button enable 


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnApp').text('save'); //change button text
                $('#btnApp').attr('disabled',false); //set button enable 

            }
        });
    }

