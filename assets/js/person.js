$(document).ready(function() {	
	
	$("#first_name").select2({
		/*placeholder: "Search for a user",
		minimumInputLength: 3,*/
	});

	$("#first_name").change(function(){
		if($(this).val() != 0){
			window.location = $(this).val();
		}
	});

	$("#relation").select2();

	$("#emplstatus").select2();

	$("#status").select2();

	$("#marital").select2();

	/***** Tabs *****/
	//Normal Tabs - Positions are controlled by CSS classes
    $('#tab-1 a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});

	$('#tab-1 li:eq(0) a').tab('show'); 
  
    $('#tab-2 a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
	
	$('#tab-2 li:eq(1) a').tab('show'); 
	  
	$('#tab-3 a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
	
	$('#tab-3 li:eq(2) a').tab('show'); 
	  
	$('#tab-4 a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});

	$('#tab-4 li:eq(3) a').tab('show'); 
	  
	$('#tab-5 a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});

	$('#tab-5 li:eq(4) a').tab('show'); 

	$('#tab-6 a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});

	$('#tab-6 li:eq(5) a').tab('show'); 

	//datepicker
	$('.input-append.date').datepicker({
  			format: "dd/mm/yyyy",
			autoclose: true,
			todayHighlight: true
	   });

	$("tr.itemjobass").each(function() {
        var iditemjobass = $(this).attr('id');
        $('#viewdetail-' + iditemjobass).click(function (e){
	     	e.preventDefault();
	      	$('#detail-' + iditemjobass).toggle();
	    });
	});

	$("tr.itemtraining").each(function() {
        var iditemtraining = $(this).attr('id');
        $('#viewtraining-' + iditemtraining).click(function (e){
	     	e.preventDefault();
	      	$('#trainingdetail-' + iditemtraining).toggle();
	    });
	});

	$("tr.itemcertificate").each(function() {
        var iditemcertificate = $(this).attr('id');
        $('#viewcertificate-' + iditemcertificate).click(function (e){
	     	e.preventDefault();
	      	$('#certificatedetail-' + iditemcertificate).toggle();
	    });
	});

	$("tr.itemeducation").each(function() {
        var iditemeducation = $(this).attr('id');
        $('#vieweducation-' + iditemeducation).click(function (e){
	     	e.preventDefault();
	      	$('#educationdetail-' + iditemeducation).toggle();
	    });
	});

	$("tr.itemexperience").each(function() {
        var iditemexperience = $(this).attr('id');
        $('#viewexperience-' + iditemexperience).click(function (e){
	     	e.preventDefault();
	      	$('#experiencedetail-' + iditemexperience).toggle();
	    });
	});

	$("tr.itemsk").each(function() {
        var iditemsk = $(this).attr('id');
        $('#viewsk-' + iditemsk).click(function (e){
	     	e.preventDefault();
	      	$('#skdetail-' + iditemsk).toggle();
	    });
	});

	$("tr.itemsertijah").each(function() {
        var iditemsertijah = $(this).attr('id');
        $('#viewsertijah-' + iditemsertijah).click(function (e){
	     	e.preventDefault();
	      	$('#sertijahdetail-' + iditemsertijah).toggle();
	    });
	});

	$("tr.itemjabatan").each(function() {
        var iditemjabatan = $(this).attr('id');
        $('#viewjabatan-' + iditemjabatan).click(function (e){
	     	e.preventDefault();
	      	$('#jabatandetail-' + iditemjabatan).toggle();
	    });
	});

	$("tr.itemaward").each(function() {
        var iditemaward = $(this).attr('id');
        $('#viewaward-' + iditemaward).click(function (e){
	     	e.preventDefault();
	      	$('#awarddetail-' + iditemaward).toggle();
	    });
	});

	$("tr.itemikatandinas").each(function() {
        var iditemikatandinas = $(this).attr('id');
        $('#viewikatandinas-' + iditemikatandinas).click(function (e){
	     	e.preventDefault();
	      	$('#ikatandinasdetail-' + iditemikatandinas).toggle();
	    });
	});

});