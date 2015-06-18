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

    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
    var medical_url = baseurl+'form_medical';
    var uri1 = medical_url+'/do_approve/'+url.segment(4);

    $('#btnAppMedical').click(function(){
        $('#formApp').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: uri1,
                data: $('#formApp').serialize(),
                success: function() {
                    setTimeout(function(){
                        location.reload()},
                        500
                    )
                }
            });
            ev.preventDefault(); 
        });  
    });

});	


