//Common Event Trigger for emails app
$(document).ready(function() {
			var selectedItems=0;
			var url = $.url();
    		var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
			var email_url = baseurl+'email/';
			var email_sent_url = baseurl+'email/sent';
			//Table Row Click Event
			$('.clickable').click( function() {
				$('#inbox-wrapper').addClass('animated fadeOut');
				$('#inbox-wrapper').hide();					
				$('#preview-email-wrapper').addClass('animated fadeIn ');			
				$('#preview-email-wrapper').show();			
				$('.page-title').show();	
				//Load email details
				$('#inbox-wrapper').removeClass('animated fadeOut');			
				$('#inbox-wrapper').removeClass('animated fadeIn');			
			});
			
			//Back Button Event 
			$('#btn-back').click( function() {							
				$('#inbox-wrapper').addClass('animated fadeIn');
				$('#inbox-wrapper').show();									
				$('#preview-email-wrapper').addClass('animated fadeOut');			
				$('#preview-email-wrapper').hide();			
				$('.page-title').hide();				
				$('#preview-email-wrapper').removeClass('animated fadeIn ');				
				$('#preview-email-wrapper').removeClass('animated fadeOut ');				
			});
			
			//Check box select Event
			//Trigger Quick bar
			$('#email-list .checkbox input').click( function() {			
				if($(this).is(':checked')){
					selectedItems++;
					console.log(selectedItems);
					$("#quick-access").css("bottom","0px");	
					$(this).parent().parent().parent().toggleClass('row_selected');					
				}
				else{					
						selectedItems--;
						console.log(selectedItems);
						$("#quick-access").css("bottom","0px");	
						$(this).parent().parent().parent().toggleClass('row_selected');		
				}
				if(selectedItems==0){
						$("#quick-access").css("bottom","-115px");
				}
			});
			
			//Adjust Page layout to condensed
			$('.page-content').css('margin-left','50');
			
			//Quick action dismiss Event
			$('#quick-access .btn-cancel').click( function() {
					$("#quick-access").css("bottom","-115px");
					$('#email-list .checkbox').children('input').attr('checked', false);
					$("#emails tbody tr").removeClass('row_selected');			
			});

				resetcheckbox();
                $('#selectall').click(function(event) {  //on click
                    if (this.checked) { // check select status
                        $('.checkbox1').each(function() { //loop through each checkbox
                            this.checked = true;  //select all checkboxes with class "checkbox1"              
                        });
                    } else {
                        $('.checkbox1').each(function() { //loop through each checkbox
                            this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                        });
                    }
                });

			$("#delBtn").on('click', function(e) {
                    e.preventDefault();
                    var checkValues = $('.checkbox1:checked').map(function()
                    {
                        return $(this).val();
                    }).get();
                    console.log(checkValues);
                    
                    $.each( checkValues, function( i, val ) {
                        $("#"+val).remove();
                        });
//                    return  false;
                    $.ajax({
                        url: email_url+'delete',
                        type: 'post',
                        data: 'ids=' + checkValues
                    }).done(function(data) {
                        $("#message").text('Mails Deleted').fadeIn().delay(3000).fadeOut("slow");
                        $('#selectall').attr('checked', false);
                        setTimeout(function(){
                        	location.reload()},
                      	 	200
                    	)
                    });
                });	


			function  resetcheckbox(){
                $('input:checkbox').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                   });
                }
	//Accordians
	$('.panel-group').collapse({
		toggle: false
	})	

/***** Tabs *****/
	

});

function activate(id)
				{
				    $('#btnActive').text('Activating...'); //change button text
				    $('#btnActive').attr('disabled',true); //set button disable 
				    var url = "email/load_body/"+id;
				    // ajax adding data to database
				    $.ajax({
				        url : url,
				        type: "POST",
				        data: $('#form').serialize(),
				        dataType: "html",
				        success: function(data)
				        {
				            $("#content").html(data);
				            $(".msg").show('slow').fadeIn().delay(3000).fadeOut("slow");
				            $('#btnActivate').text('Activate'); //change button text
				            $('#btnActivate').attr('disabled',false); //set button enable 


				        },
				        error: function (jqXHR, textStatus, errorThrown)
				        {
				            alert('Proses Aktifasi Gagal');
				            $('#btnActivate').text('save'); //change button text
				            $('#btnActivate').attr('disabled',false); //set button enable 

				        }
				    });
				}