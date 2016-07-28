$(document).ready(function() {
	$('#limit').select2();
 	$(".select2").select2();
    $("#admin_type_id").change(function() {
        var id = $(this).val();
        if(id == 3){
            $("#type_inventaris").show();
        }else{
            $("#type_inventaris").hide();
        }
    })
    .change();

 	/*
 	var len = $('#len').value;
 	for(var i = 0; i<len;i++){
 	$('#btnDel'+i).click(function(){
        var $btn = $(this).button('loading');
        $('#formDel'+i).submit(function(ev){
            $.ajax({
                type: 'POST',
                url: './delete_group',
                data: $('#formDel'+i).serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     //location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });
 	}*/

});