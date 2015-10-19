$(document).ready(function() {				
	 $('#btnedit').click(function(){
        var $btn = $(this).button('loading');
        $('#formedit').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: 'pengumuman/edit',
                data: $('#formedit').serialize(),
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