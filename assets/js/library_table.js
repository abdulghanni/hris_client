$(document).ready(function() {	

	$("#title").select2({
		/*placeholder: "Search for a user",
		minimumInputLength: 3,*/
	});

	$("#title").change(function(){
		if($(this).val() != 0){
			window.location = $(this).val();
		}
	});

	
});