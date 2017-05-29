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
				<h3>Dashboard User</h3>	
			</div>
			
		   <div id="container">
		   	<div id="absen"></div>
			<div class="row">
		   		<div <?php ( ! empty($message)) && print('class="alert alert-info text-center"'); ?> id="infoMessage"><?php echo $message;?></div>
				<div class="col-md-12">
		          <div class="tabbable tabs-left">
		            <ul class="nav nav-tabs" id="tab-1">
		              <li class="active" id="tabpersonnel" onclick="load('personnel')"><a href="#">Employee Identity</a></li>
		              <li id="tabslip" onclick="load('payroll')"><a href="#">Slip Gaji Bulanan</a></li>
		              <li id="tabcourse" onclick="load('course')"><a href="#">Company Sponsor Course</a></li>
		              <li id="tabcertificate" onclick="load('certificate')"><a href="#">Certificate</a></li>
		              <li id="tabeducation" onclick="load('education')"><a href="#">Education</a></li>
		              <li id="tabexperience" onclick="load('experience')"><a href="#">Experience</a></li>
		              <li id="tabsk" onclick="load('sk')"><a href="#">Surat Keputusan</a></li>
		              <li id="tabsti" onclick="load('sti')"><a href="#">Serah Terima Ijazah</a></li>
		              <li id="tabjabatan" onclick="load('jabatan')"><a href="#">Riwayat Jabatan</a></li>
		              <li id="tabaward" onclick="load('award')"><a href="#">Award & Warning</a></li>
		              <li id="tabikatan" onclick="load('ikatan')"><a href="#">Ikatan Dinas</a></li>
		              <li id="tabinv" onclick="load('inv')"><a href="#">Inventaris</a></li>
		            </ul>
		            <div class="tab-content">
		              <div class="tab-pane active" id="tabdetail"></div>
		            </div>
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