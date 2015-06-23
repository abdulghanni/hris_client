$(document).ready(function() {				
	$(".select2").select2();

    $('#btnAdd').on('click', function () {
    $(document).find("select.select2").select2();

    $(".rupiah").keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8 ) {
            // let it happen, don't do anything
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault(); 
            }   
        }
    });


    $('.rupiah').maskMoney({precision: 0});
    $('#btnSaveMedical').show();
    $('#btnCancelMedical').show();
    $('#btnRemove').show();
    });

    //approval Medical
    $('button[data-loading-text]').click(function () {
    $(this).button('loading');
    });

    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
    var uri1 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv1';
    var uri2 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv2';
    var uri3 = url.segment(2)+'/do_approve/'+url.segment(4)+'/lv3';
    var uri4 = url.segment(2)+'/do_approve/'+url.segment(4)+'/hrd';

    $('#btn_app_lv1').click(function(){
        $('#formMedical').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri1,
                data: $('#formMedical').serialize(),
                success: function() {
                     location.reload()
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_lv2').click(function(){
        $('#formMedical').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri2,
                data: $('#formMedical').serialize(),
                success: function() {
                     location.reload()
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_lv3').click(function(){
        $('#formMedical').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri3,
                data: $('#formMedical').serialize(),
                success: function() {
                     location.reload()
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btn_app_hrd').click(function(){
        $('#formMedical').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri4,
                data: $('#formMedical').serialize(),
                success: function() {
                     location.reload()
                }
            });
            ev.preventDefault(); 
        });  
    });

});	


