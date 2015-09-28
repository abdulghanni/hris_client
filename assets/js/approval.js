$(document).ready(function() {				
	$(".select2").select2();
	 $('#limit').select2();

	 $('#btnadd').click(function(){
        var $btn = $(this).button('loading');
        $('#formadd').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: 'approval_khusus/add',
                data: $('#formadd').serialize(),
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