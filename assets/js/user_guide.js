$(document).ready(function() {	
	
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

	$('#register').click(function(){
            var url = 'user_guide/get_register';
            $('#help').load(url);
            return false;
    });

    $('#lupa').click(function(){
            var url = 'user_guide/get_lupa';
            $('#help').load(url);
            return false;
    });

    $('#cuti').click(function(){
            var url = 'get_cuti';
            $('#help').load(url);
            return false;
    });

});