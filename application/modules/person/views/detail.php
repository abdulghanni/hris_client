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
		   	<!--DARI MESIN ABSEN-->
		   	<?php if(empty($user_att['max_date'])){?>
		   	<div class="row spacing-bottom 2col">	
				<div class="col-md-3 col-sm-6 spacing-bottom-sm">	
					<div class="tiles blue added-margin">
					  <div class="tiles-body">
						<div class="controller">								
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>		
						</div>		
						<div class="tiles-title">
							KEHADIRAN
						</div>	
						<div class="heading">
						<span class="animate-number" data-value="<?php echo $persen_hadir;?>" data-animation-duration="1200">0</span>%
												
						</div><!-- 
						<div class="progress transparent progress-small no-radius">
							<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="<?php echo $persen_hadir;?>%"></div>
						</div>	 -->	
						<div class="progress transparent progress-small no-radius">
							<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="<?php echo '0';?>%"></div>
						</div>					
						<!--<div class="description"><i class="icon-custom-up"></i><span class="text-white mini-description ">&nbsp; 4% lebih tinggi <span class="blend">dari rata-rata</span></span></div>--->
						</div>	
					</div>
				</div>
				<div class="col-md-3 col-sm-6 spacing-bottom-sm">
					<div class="tiles green added-margin">
					 <div class="tiles-body">
						<div class="controller">								
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>									
						</div>		
						<div class="tiles-title">
							KETERLAMBATAN
						</div>	
						<div class="heading">
							<span class="animate-number" data-value="<?php echo $persen_terlambat;?>" data-animation-duration="1000">0</span>%	
						</div>
						<div class="progress transparent progress-small no-radius">
								<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="<?php echo $persen_terlambat;?>%" ></div>
						</div>				
						<!--<div class="description"><i class="icon-custom-down"></i><span class="text-white mini-description ">&nbsp; 2% lebih rendah <span class="blend">dari rata-rata</span></span></div>	-->
					 </div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="tiles red added-margin">
					<div class="tiles-body">
						<div class="controller">								
								<a href="javascript:;" class="reload"></a>
								<a href="javascript:;" class="remove"></a>										
							</div>	
						<div class="tiles-title">
							TIDAK HADIR
						</div>	
						<div class="heading">
							<span class="animate-number" data-value="<?php echo $rekap_hadir['alpa'];?>" data-animation-duration="1200">0</span> Kali	
						</div>
						<div class="progress transparent progress-white progress-small no-radius">
							<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="2%" ></div>
						</div>
						<!--<div class="description"><i class="icon-male"></i><span class="text-white mini-description ">&nbsp;  Alpa</span></div>	-->
					</div>
					</div>
			
				</div> 
				<div class="col-md-3 col-sm-6">
					<div class="tiles purple added-margin">
					  <div class="tiles-body">
						<div class="controller">								
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>									
						</div>		
						<div class="tiles-title">
							CUTI
						</div>	
						<div class="row-fluid">
							<!-- <div class="heading">
								<span class="animate-number" data-value="<?php echo $rekap_hadir['cuti'];?>" data-animation-duration="1200">0</span> Kali
							</div> -->
							<div class="heading">
								<span class="animate-number" data-value="<?php echo '0';?>" data-animation-duration="1200">0</span> Kali
							</div>
							<div class="progress transparent progress-white progress-small no-radius">
								<!-- <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="<?php echo $rekap_hadir['cuti'];?>%"></div>
							</div> -->
							<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="<?php echo '0';?>%"></div>
							</div>
						</div>
						<!--<div class="description"><i class="icon-male"></i><span class="text-white mini-description ">&nbsp; Mengajukan Cuti </span></div>	-->
						
					 </div>
					</div>
				</div>			
			</div>
			<?php }else{ ?>
			<!-- dari axapta -->
			<div class="row spacing-bottom 2col">	
				<div class="col-md-3 col-sm-6 spacing-bottom-sm">	
					<div class="tiles blue added-margin">
					  	<div class="tiles-body">
							<div class="controller">								
								<a href="javascript:;" class="reload"></a>
								<a href="javascript:;" class="remove"></a>		
							</div>		
							<div class="tiles-title">
								KEHADIRAN (<?= date('M', strtotime($user_att['max_date']))?>)
							</div>	
							<div class="heading">
								<span class="animate-number" data-value="<?php echo $user_att['hadir'];?>" data-animation-duration="1200"><?=$user_att['hadir']?></span>x				
							</div>
							<div class="description"><i class="icon-custom-min"></i><span class="text-white mini-description ">&nbsp;Berdasarkan data AX s/d <?= dateIndo($user_att['max_date'])?> </span>
							</div>
						</div>	
					</div>
				</div>
				<div class="col-md-3 col-sm-6 spacing-bottom-sm">
					<div class="tiles green added-margin">
					 <div class="tiles-body">
						<div class="controller">								
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>									
						</div>		
						<div class="tiles-title">
							KETERLAMBATAN (<?= date('M', strtotime($user_att['max_date']))?>)
						</div>	
						<div class="heading">
							<span class="animate-number" data-value="<?php echo $user_att['telat'];?>" data-animation-duration="1000"><?=$user_att['telat']?></span>x	
						</div>
						<div class="description"><i class="icon-custom-min"></i><span class="text-white mini-description ">&nbsp;Berdasarkan data AX s/d <?= dateIndo($user_att['max_date'])?> </span></div>
					 </div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="tiles red added-margin">
					<div class="tiles-body">
						<div class="controller">								
								<a href="javascript:;" class="reload"></a>
								<a href="javascript:;" class="remove"></a>										
							</div>	
						<div class="tiles-title">
							TIDAK HADIR (<?= date('M', strtotime($user_att['max_date']))?>)
						</div>	
						<div class="heading">
							<span class="animate-number" data-value="<?php echo $user_att['tidak_hadir'];?>" data-animation-duration="1200"><?=$user_att['tidak_hadir']?></span>x	
						</div>
						<div class="description"><i class="icon-custom-min"></i><span class="text-white mini-description ">&nbsp;Berdasarkan data AX s/d <?= dateIndo($user_att['max_date'])?> </span></div>
					</div>
					</div>
			
				</div> 
				<div class="col-md-3 col-sm-6">
					<div class="tiles purple added-margin">
					  <div class="tiles-body">
						<div class="controller">								
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>									
						</div>		
						<div class="tiles-title">
							CUTI (<?= date('Y', strtotime($user_att['max_date']))?>)
						</div>	
						<div class="row-fluid">
							<div class="heading">
								<span class="animate-number" data-value="<?php echo (!empty($user_att['cuti'])) ? $user_att['cuti'] : 0;?>" data-animation-duration="1200"><?= (!empty($user_att['cuti'])) ? $user_att['cuti'] : 0;?></span>x
							</div>
						</div>
						<div class="description"><i class="icon-custom-min"></i><span class="text-white mini-description ">&nbsp;Berdasarkan data AX tahun <?= date('Y', strtotime($user_att['max_date']))?> </span>
						</div>
					 </div>
					</div>
				</div>			
			</div>
			<?php } ?>
			<div class="row">
		   		<div <?php ( ! empty($message)) && print('class="alert alert-info text-center"'); ?> id="infoMessage"><?php echo $message;?></div>
				<div class="col-md-12">
		          <div class="tabbable tabs-left">
		            <ul class="nav nav-tabs" id="tab-1">
		              <li class="active" id="tabpersonnel" onclick="load('personnel')"><a href="#">Employee Identity</a></li>
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