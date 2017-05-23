$(document).ready(function() {	
	$(".select2").select2();
	var base_url = $("#base_url").val();
	$('#subtitute_user').click(function(){
        var user_id = $('#user_id').val();
        $.ajax({
            type: 'GET',
            url: base_url+'auth/change_user/'+user_id,
            dataType: "JSON",
            success: function(data) {
                if(data.st == 1)
                {
                	window.location.replace(base_url);
                }else{
                	alert('try again');
                }
            }
        });
    });
	
});

