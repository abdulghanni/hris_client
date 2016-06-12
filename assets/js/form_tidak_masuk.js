

var url = $.url();
var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
var uri1 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv1';
var uri2 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv2';
var uri3 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv3';
var uri4 = url.segment(2)+'/do_approve/'+url.segment(4)+'/hrd';
$(document).ready(function() {              
$(".select2").select2();
//approval absen
    $('button[data-loading-text]').click(function () {
        $(this).button('loading');
    });

    $('#btn_app_lv1').click(function(){
        var $btn = $(this).button('loading');
        $.ajax({
            url : baseurl+uri1,
            type: "POST",
            data: $('#formAppLv1').serialize(),
            success: function(data)
            {
                reload_status('lv1');
                $("[data-dismiss=modal]").trigger({ type: "click" });
                $btn.button('reset');   
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Terjadi Kesalahan, Silakan Refresh Halaman Ini');
                $btn.button('reset');
            }
        });
    });

    function reload_status(lv)
    {
        uri = url.segment(2)+'/detail/'+url.segment(4)+'/'+lv;
        $('#'+lv).html('<img src="/hris_client/assets/img/loading.gif"> loading...');
        $('#note').html('<img src="/hris_client/assets/img/loading.gif"> loading...');
        $.ajax({
            type: 'POST',
            url: baseurl+uri,
            dataType: "JSON",
            success: function(data) {
                $('#'+lv).html(data.app);
                $('#note').html(data.note);
            }
        });
    }
    $('#btn_app_lv2').click(function(){
        var $btn = $(this).button('loading');
        $('#formAppLv2').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri2,
                data: $('#formAppLv2').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     reload_status('lv2');
                     $btn.button('reset')
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
                url: baseurl+uri3,
                data: $('#formAppLv3').serialize(),
                success: function() {
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                     reload_status('lv3');
                     $btn.button('reset')
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
                url: baseurl+uri4,
                data: $('#formAppHrd').serialize(),
                success: function() {
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                     reload_status('hrd');
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });
});

function approve1()
    {
        $('#btnApp').text('saving...'); //change button text
        $('#btnApp').attr('disabled',true); //set button disable 
        var url = baseurl+uri1;
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

    function reload_status()
    {
        $.ajax({
            type: 'POST',
            url: baseurl+uri5,
            success: function(data) {
                $('#lv1').html(data);
            }
        });
    }

