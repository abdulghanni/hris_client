$(document).ready(function() {				
	$(".select2").select2();

	 $('#btnadd').click(function(){
        var $btn = $(this).button('loading');
        $('#formadd').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: 'inventory_type/add',
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