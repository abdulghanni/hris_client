$(document).ready(function() {
	var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+':'+url.attr('port')+'/'+url.segment(1)+'/';
    var uri = url.segment(2)+'/do_approve/'+url.segment(4);

    $('#btn_app').click(function(){
        var $btn = $(this).button('loading');
        $('#formApp').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri,
                data: $('#formApp').serialize(),
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