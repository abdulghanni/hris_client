<div class="page-content"> 
	    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	    <div id="portlet-config" class="modal hide">
	      <div class="modal-header">
	        <button data-dismiss="modal" class="close" type="button"></button>
	        <h3>Widget Settings</h3>
	      </div>
	      <div class="modal-body"> Widget settings form goes here </div>
	    </div>
	    <div class="clearfix"></div>
	    <div class="content">  
			<div class="page-title">	
				<h3>Paid slip monthly</h3>	
			</div>
			
		   
				<div class="row">
			   		
					<div class="col-md-12">
						<div class="grid simple">
							<div class="grid-body no-border">
							<br/>
					            <?php 
					          	$data = get_filenames('c://HRD');
					          	//$key = array_search(get_nik($this->session->userdata('user_id')).'-01012017.pdf',$data);
					          	
					          	echo '<ul>';
								foreach ($data as $key => $value) {
									if(substr($value,0,5) == get_nik($this->session->userdata('user_id')))
									{
										echo '<li><a href="c:\\HRD/'.$value.'">'.$value.'</a></li>';
									}
								}
								echo '</ul>';
								?>
							</div>
						</div>
		        	</div>		
				</div>
			
			</div>  
		<!-- END PAGE --> 
		</div>
	</div>

	<!-- Birthday Reminder -->
	<?php if(date("m-d")===date('m-d',strtotime($bod)) && $is_birthday_reminder == 0){?>
	    <div id="boxes">
		  <div id="dialog" class="window">
		  	<div class="bd-month"><?php echo date('M',strtotime($bod))?></div>
		  	<div class="bd-date"><?php echo date('d',strtotime($bod))?></div>
		  	<div class="bd-text">Happy<br/>Birthday</div>
		  </div>
		  <div id="mask"></div>
		</div>
	<?php } ?>

	<!--end modal-->