$(document).ready(function() {	
	
	var empId = $("#id").val();

	$('#boxes').click(function () {
		$.ajax({
          type: 'POST',
          url: '../update_bd_reminder',
          data: {id : empId},
          success: function(data) { 
			$(this).hide();
			$('#mask').hide();
			$('.window').hide();
          }
      });
	});
});



var base_url = $("#base_url").val(),
    id2 = $("#id").val();
    load_icon = base_url+"assets/img/loading.gif"
    loading  = '<img src='+load_icon+'> loading...';

function loadPerson(){
        $('#tabdetail').html(loading);
        var url = base_url+'person/personnel/'+id2;
        $('#tabdetail').load(url);
        $("li").removeClass("active");
        $("#tabpersonnel").addClass("active");
        return false;
};

function load(tab){
        $('#tabdetail').html(loading);
        var url = base_url+'person/'+tab+'/'+id2;
        $('#tabdetail').load(url);
        $("li").removeClass("active");
        $("#tab"+tab).addClass("active");
        return false;
};



window.onload = loadPerson();