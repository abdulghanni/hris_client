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
												
						</div>
						<div class="progress transparent progress-small no-radius">
							<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="<?php echo $persen_hadir;?>%"></div>
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
							<div class="heading">
								<span class="animate-number" data-value="<?php echo $rekap_hadir['cuti'];?>" data-animation-duration="1200">0</span> Kali
							</div>
							<div class="progress transparent progress-white progress-small no-radius">
								<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="<?php echo $rekap_hadir['cuti'];?>%"></div>
							</div>
						</div>
						<!--<div class="description"><i class="icon-male"></i><span class="text-white mini-description ">&nbsp; Mengajukan Cuti </span></div>	-->
						
					 </div>
					</div>
				</div>			
			</div>
			
			<div class="row">		
				
				<div class="col-md-12">
		          <div class="tabbable tabs-left">
		            <ul class="nav nav-tabs" id="tab-1">
		              <li class="active"><a href="#tabpersonnel">Employee Identity</a></li>
		              <li><a href="#tabcourse">Company Sponsor Course</a></li>
		              <li><a href="#tabcertificate">Certificate</a></li>
		              <li><a href="#tabeducation">Education</a></li>
		              <li><a href="#tabexperience">Experience</a></li>
		              <li><a href="#tabsk">Surat Keputusan</a></li>
		              <li><a href="#tabsertijah">Serah Terima Ijazah</a></li>
		              <li><a href="#tabjabatan">Riwayat Jabatan</a></li>
		              <li><a href="#tabaward">Award & Warning</a></li>
		              <li><a href="#tabikatandinas">Ikatan Dinas</a></li>
		            </ul>
		            <div class="tab-content">

		              <!-- tabpersonnel -->

		              <div class="tab-pane active" id="tabpersonnel">
			                <div class="row column-seperation row-seperation" style="padding-bottom: 30px;">
			                	<div class="col-md-8">
				                  <h4>Employee Identity
								  
								  
								  </h4>
								  
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <?php echo lang('register_nik_label', 'nik');?>
				                      </div>
				                      <div class="col-md-9">
                                        <input type="text" class="form-control" value="<?php echo $nik?>" disabled="disabled">           
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                     <div class="col-md-3">
				                       <?php echo lang('register_firstname_label', 'firstname');?>
				                      </div>
				                      <div class="col-md-9">
				                        <input type="text" class="form-control" value="<?php echo $first_name?>" disabled="disabled">
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                     <div class="col-md-3">
				                       <?php echo lang('register_lastname_label', 'lasttname');?>
				                      </div>
				                      <div class="col-md-9">
				                        <input type="text" class="form-control" value="<?php echo $last_name?>" disabled="disabled">
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <?php echo lang('register_dob_label', 'dob');?>
				                      </div>
				                      <div class="col-md-9">
							               <input type="text" class="form-control" value="<?php echo dateIndo($bod)?>" disabled="disabled">
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <?php echo lang('register_marital_label', 'marital');?>
				                      </div>
				                      <div class="col-md-9">
				                      	<input type="text" class="form-control" value="<?php echo $marital?>" disabled="disabled">
				                      </div>
				                    </div>
									<div class="row form-row">
				                      <div class="col-md-3">
				                        <?php echo lang('aviva_number', 'aviva');?>
				                      </div>
				                      <div class="col-md-9">
				                      	<input type="text" class="form-control" value="<?php echo $aviva?>" disabled="disabled">
				                      </div>
				                    </div>

				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <?php echo 'BPJS Tenaga Kerja';?>
				                      </div>
				                      <div class="col-md-9">
				                      	<input type="text" class="form-control" value="<?php echo $bpjs_kerja?>" disabled="disabled">
				                      </div>
				                    </div>

				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <?php echo 'BPJS Kesehatan';?>
				                      </div>
				                      <div class="col-md-9">
				                      	<input type="text" class="form-control" value="<?php echo $bpjs_kesehatan?>" disabled="disabled">
				                      </div>
				                    </div>

				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <?php echo 'Bumida';?>
				                      </div>
				                      <div class="col-md-9">
				                      	<input type="text" class="form-control" value="<?php echo $bumida?>" disabled="disabled">
				                      </div>
				                    </div>
									
									<div class="row form-row">
				                      <div class="col-md-3">
				                        <?php echo lang('ktp_number', 'ktp');?>
				                      </div>
				                      <div class="col-md-9">
				                      	<input type="text" class="form-control" value="<?php echo $ktp?>" disabled="disabled">
				                      </div>
				                    </div>

				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        KTP Valid Date
				                      </div>
				                      <div class="col-md-9">
				                      	<input type="text" class="form-control" value="<?php echo dateIndo($ktp_valid_date)?>" disabled="disabled">
				                      </div>
				                    </div>

				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <?php echo 'NPWP';?>
				                      </div>
				                      <div class="col-md-9">
				                      	<input type="text" class="form-control" value="<?php echo $npwp?>" disabled="disabled">
				                      </div>
				                    </div>
									
									<div class="row form-row">
				                      <div class="col-md-3">
				                        <?php echo lang('tax_category', 'tax');?>
				                      </div>
				                      <div class="col-md-9">
				                      	<input type="text" class="form-control" value="<?php echo $tax?>" disabled="disabled">
				                      </div>
				                    </div>

				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <?php echo 'Scan Kartu Keluarga';?>
				                      </div>
				                      <div class="col-md-3">
				                      	<?php if($s_kk && file_exists('./uploads/'.$u_folder.'/kk/'.$s_kk)) {?>
                                        <a href="<?php echo base_url()?>uploads/<?php echo $u_folder.'/kk/'.$s_kk?>" rel="prettyPhoto"><img alt="" height="80" width="80" src="<?php echo base_url()?>uploads/<?php echo $u_folder.'/kk/'.$s_kk?>" /></a>
                                        <?php }else{ ?>
                                        <img alt="" src="<?php echo base_url()?>assets/img/no-file.png" height="80" width="80">
                                        <?php } ?>
				                      </div>

				                      <div class="col-md-3">
				                        <?php echo 'Scan Akta Kelahiran';?>
				                      </div>
				                      <div class="col-md-3">
				                      	<?php if($s_akta && file_exists('./uploads/'.$u_folder.'/akta/'.$s_akta)) {?>
                                        <a href="<?php echo base_url()?>uploads/<?php echo $u_folder.'/akta/'.$s_akta?>" rel="prettyPhoto"><img alt="" height="80" width="80" src="<?php echo base_url()?>uploads/<?php echo $u_folder.'/akta/'.$s_akta?>"></a>
                                        <?php }else{ ?>
                                        <img alt="" src="<?php echo base_url()?>assets/img/no-file.png" height="80" width="80">
                                        <?php } ?>
				                      </div>

				                    </div>

				                </div>
				                

			                  	<div class="col-md-4">
			                  		<div class="grid simple" style="margin-bottom : 0px !important;">
				                   		<h4>Picture</h4>
					            	</div>
                                	 <?php if($s_photo && file_exists('./uploads/'.$u_folder.'/'.$s_photo)) {?>
                                                <img alt="" src="<?php echo base_url()?>uploads/<?php echo $u_folder.'/225x225/'.$s_photo?>">
                                                <?php }else{ ?>
                                                <img alt="" src="<?php echo base_url()?>assets/img/no-image-big.png" class="img-responsive">
                                                <?php } ?>
			                 	</div>
			                </div>
			           
			                
			                <div class="row row-seperation" style="margin-top: 20px;padding-bottom: 30px;">
			                	<div class="col-md-12">
			                		<h4>Employement</h4>
			                		<div class="row form-row">
				                		<div class="col-md-3">
					                      <label class="form-label"><?php echo lang('seniority_date')?></label>
					                    </div>
					                   	<div class="col-md-9">
				                        	<input type="text" class="form-control" value="<?php echo dateIndo($seniority_date)?>" disabled="disabled">
				                      	</div>
						        	</div>
						        	<div class="row form-row">
				                		<div class="col-md-3">
					                      <label class="form-label"><?php echo lang('position')?></label>
					                    </div>
					                   	<div class="col-md-9">
				                      	<input type="text" class="form-control" value="<?php echo $position?>" disabled="disabled">
				                        </div>
						        	</div>

						        	<div class="row form-row">
				                		<div class="col-md-3">
					                      <label class="form-label"><?php echo lang('organization')?></label>
					                    </div>
					                   	<div class="col-md-9">
				                      	<input type="text" class="form-control" value="<?php echo $organization?>" disabled="disabled">
				                        </div>
						        	</div>

						        	<div class="row form-row">
				                		<div class="col-md-3">
					                      <label class="form-label"><?php echo 'Business Unit'?></label>
					                    </div>
					                   	<div class="col-md-9">
				                      	<input type="text" class="form-control" value="<?php echo $bu?>" disabled="disabled">
				                        </div>
						        	</div>

						        	<div class="row form-row">
				                		<div class="col-md-3">
					                      <label class="form-label"><?php echo lang('empl_status')?></label>
					                    </div>
					                    <div class="col-md-9">
				                      		<input type="text" class="form-control" value="<?php 
											if($empl_status == 1){
												echo 'Probation';
											}elseif($empl_status == 2){
												echo 'Permanent';
											}elseif($empl_status == 3){
												echo 'Contract';
											}elseif($empl_status == 4){
												echo 'Part Time';
											}elseif($empl_status == 5){
												echo 'Expat Contract';
											}elseif($empl_status == 6){
												echo 'Sick';
											}elseif($empl_status == 7){
												echo 'UPLeave';
											}elseif($empl_status == 8){
												echo 'Ahli';
											}elseif($empl_status == 9){
												echo 'Daily Contract';
											}elseif($empl_status == 10){
												echo 'Daily Permanent';
											}elseif($empl_status == 11){
												echo 'Job Training';
											}else{
												echo '-';
											}
											
											?>" disabled="disabled">
				                        </div>
						        	</div>
						        	<div class="row form-row">
				                		<div class="col-md-3">
					                      <label class="form-label"><?php echo lang('employee_status')?></label>
					                    </div>
					                    <div class="col-md-9">
				                      		<input type="text" class="form-control" value="<?php

															if($employee_status == 0){
																echo 'Work Center';
															}elseif($employee_status == 1){
																echo 'Employed';
															}elseif($employee_status == 2){
																echo 'Terminated';
															}elseif($employee_status == 3){
																echo 'Honorarium';
															}else{
																echo '-';
															}
															
															?>" disabled="disabled">
				                        </div>
						        	</div>
						        	<div class="row form-row">
				                		<div class="col-md-3">
					                      <label class="form-label"><?php echo lang('cost_center')?></label>
					                    </div>
					                    <div class="col-md-9">
				                        	<input type="text" class="form-control" value="<?php echo $cost_center?>" disabled="disabled">
				                      	</div>
						        	</div>
						        	<div class="row form-row">
				                		<div class="col-md-3">
					                      <label class="form-label"><?php echo lang('position_group')?></label>
					                    </div>
					                    <div class="col-md-9">
				                      		<input type="text" class="form-control" value="<?php echo $position_group?>" disabled="disabled">
				                        </div>
						        	</div>
						        	<div class="row form-row">
				                		<div class="col-md-3">
					                      <label class="form-label"><?php echo lang('grade')?></label>
					                    </div>
					                    <div class="col-md-9">
				                      		<input type="text" class="form-control" value="<?php echo $grade?>" disabled="disabled">
				                        </div>
						        	</div>
						        	<div class="row form-row">
				                		<div class="col-md-3">
					                      <label class="form-label"><?php echo lang('resign_reason')?></label>
					                    </div>
					                    <div class="col-md-9">
				                      		<input type="text" class="form-control" value="<?php echo $resign_reason?>" disabled="disabled">
				                        </div>
						        	</div>
						        	<div class="row form-row">
				                		<div class="col-md-3">
					                      <label class="form-label"><?php echo lang('active_inactive')?></label>
					                    </div>
					                    <div class="col-md-9">
				                      		<input type="text" class="form-control" value="<?php
			                      															 if($active_inactive==0){
			                      															 	echo 'Active';
			                      															 }elseif($active_inactive == 1){
			                      															 	echo 'Inactive';
			                      															 }else{
			                      															 	echo 'Active By Term';
			                      															 }?>"  disabled="disabled">
				                        </div>
						        	</div>
						        	
			                	</div>
			                </div>
			                
			                <div class="row " style="margin-top:20px;">
			                	<div class="col-md-12">
			                		<h4>CONTACT</h4>
			                		<div class="row form-row">
				                		<div class="col-md-3">
					                      <?php echo lang('edit_user_mobile_phone_label', 'phone');?>
					                    </div>
					                    <div class="col-md-9">
				                        	<input type="text" class="form-control" value="<?php echo $phone?>" disabled="disabled">
				                      	</div>
						        	</div>
						        	<div class="row form-row">
				                		<div class="col-md-3">
					                      <?php echo lang('create_user_email_label', 'email');?>
					                    </div>
					                    <div class="col-md-9">
				                        	<input class="form-control" type="text" value="<?php echo $email?>" disabled="disabled">
				                      	</div>
						        	</div>
						        	<div class="row form-row">
				                		<div class="col-md-3">
					                      <?php echo lang('edit_user_previous_email_label', 'previous_email');?>
					                    </div>
					                    <div class="col-md-9">
				                        	<input type="text" class="form-control" value="<?php echo $previous_email?>" disabled="disabled">
				                      	</div>
						        	</div>
						        	<div class="row form-row">
				                		<div class="col-md-3">
					                      <?php echo lang('edit_user_bb_pin_label', 'bb_pin');?>
					                    </div>
					                    <div class="col-md-9">
				                        	<input type="text" class="form-control" value="<?php echo $bb_pin?>" disabled="disabled">
				                      	</div>
						        	</div>
			                	</div>
			                </div>
		              </div>

		              <!-- tabcourse -->
		              <div class="tab-pane" id="tabcourse">
		                <form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Company Sponsor Course</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="20%"><?php echo lang('course_id');?></th>
			                                                <th width="40%"><?php echo lang('description');?></th>
			                                                <th width="20%"><?php echo lang('course_registration_date');?></th>
			                                                <th width="20%"><?php echo lang('course_status');?></th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                         <?php
			                                       		if( !empty( $course ) ){
			                                        		foreach($course as $key => $row) {        
													 ?>
			                                            <tr class="itemtraining" id="<?php echo $row['ID']?>">
			                                                <td valign="middle"><a href="#" id="viewtraining-<?php echo $row['ID']?>"><?php echo $row['COURSEID']?></a></td>
			                                                <td valign="middle"><span class="muted"><?php echo $row['DESCRIPTION']?></span></td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['REGISTRATIONDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted">
			                                                    <?php
																		if($row['STATUS'] == 0){
																			$course_status = 'Registration';
																		}elseif($row['STATUS'] == 1){
																			$course_status = 'Confirmation';
																		}elseif($row['STATUS'] == 2){
																			$course_status = 'Completed';
																		}elseif($row['STATUS'] == 3){
																			$course_status = 'Passed';
																		}elseif($row['STATUS'] == 4){
																			$course_status = 'Waiting List';
																		}elseif($row['STATUS'] == 5){
																			$course_status = 'Canceled';
																		}elseif($row['STATUS'] == 6){
																			$course_status = 'Drop Out';
																		}else{
																			$course_status = '-';
																		}
																		
																		echo $course_status;
																?>
                                       							 </span>
			                                                </td>
			                                            </tr>
			                                            <tr id="trainingdetail-<?php echo $row['ID']?>" style="display:none">
			                                            	<td class="detail" colspan="5">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['COURSEID']?></h4>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <?php echo lang('course_id', 'course_id');?>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="courseid" id="courseid" type="text"  class="form-control" placeholder="courseid" value="<?php echo $row['COURSEID']?>" disabled="disabled">
													                      </div>
													                    </div>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <?php echo lang('description', 'description');?>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="description" id="description" type="text"  class="form-control" placeholder="Description" value="<?php echo $row['DESCRIPTION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    
													                    
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <?php echo lang('course_registration_date', 'course_registration_date');?>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="registration_date" id="registration_date" type="text"  class="form-control" placeholder="Registration Date" value="<?php echo $row['REGISTRATIONDATE']?>" disabled="disabled">
													                      </div>
													                    </div>

													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <?php echo lang('course_status', 'course_status');?>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="status" id="status" type="text"  class="form-control" placeholder="Status" value="<?php echo $course_status?>" disabled="disabled">
													                      </div>
													                    </div>
													                    
												                  	</div>
												                  	<!-- <div class="form-actions">
																		<div class="pull-right">
																		  <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
																		  <button class="btn btn-white btn-cons" type="button">Cancel</button>
																		</div>
																	  </div> -->
												                  </form>
												                  </div>
			                                            </tr>
			                                            <?php }}else{?>
			                                            <tr>
			                                                <td valign="middle">No Data</td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"> <span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                            </tr>

			                                            <?php } ?>
			                                        </tbody>
			                                    </table>
			                            </div>
			                        </div>
			                    </div>
	                		</div>
		                </form>
		              </div>

		              <!-- tabcertificate -->
		              <div class="tab-pane" id="tabcertificate">
		              	<form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Certificate</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="20%">Certificate type</th>
			                                                <th width="40%">Description</th>
			                                                <th width="20%">Start Date</th>
			                                                <th width="20%">End Date</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        <?php
			                                        	if( !empty( $certificate ) ){
			                                        		foreach($certificate as $key => $row) {        
													?>
			                                            <tr class="itemcertificate" id="<?php echo $row['ID']?>">
			                                                <td valign="middle"><a href="#" id="viewcertificate-<?php echo $row['ID']?>">
			                                                	<?php echo $row['CERTIFICATETYPE']?>
			                                                </a></td>
			                                                <td valign="middle"><span class="muted"><?php echo $row['DESCRIPTION']?></span></td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['STARTDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['ENDDATE']?></span>
			                                                </td>
			                                            </tr>
			                                            <tr id="certificatedetail-<?php echo $row['ID']?>" style="display:none">
			                                            	<td class="detail" colspan="5">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['CERTIFICATETYPE']?></h4>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Certificate Type</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="certificate_type" id="certificate_type" type="text"  class="form-control" placeholder="certificate_type" value="<?php echo $row['CERTIFICATETYPE']?>" disabled="disabled">
													                      </div>
													                    </div>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Description</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="description" id="description" type="text"  class="form-control" placeholder="Description" value="<?php echo $row['DESCRIPTION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    
													                    
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Start Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="start_date" id="start_date" type="text"  class="form-control" placeholder="Start Date" value="<?php echo $row['STARTDATE']?>" disabled="disabled">
													                      </div>
													                    </div>

													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">End Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="end_date" id="end_date" type="text"  class="form-control" placeholder="End Date" value="<?php echo $row['ENDDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    
												                  	</div>
												                  	<!-- <div class="form-actions">
																		<div class="pull-right">
																		  <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
																		  <button class="btn btn-white btn-cons" type="button">Cancel</button>
																		</div>
																	</div> -->
												                  </form>
												                  </div>
			                                            	</td>
			                                            </tr>
			                                           <?php }}else{?>
			                                            <tr>
			                                                <td valign="middle">No Data</td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"> <span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                            </tr>

			                                            <?php } ?>
			                                        </tbody>
			                                    </table>
			                            </div>
			                        </div>
			                    </div>
	                		</div>
		                </form>
		              </div>

		              <!-- tabeducation -->
		              <div class="tab-pane" id="tabeducation">
		                <form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Education</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="20%">Education</th>
			                                                <th width="20%">Description</th>
			                                                <th width="10%">Start Date</th>
			                                                <th width="10%">End Date</th>
			                                                <th width="10%">Degree</th>
			                                                <th width="10%">Education Group</th>
			                                                <th width="20%">Institution</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        <?php
			                                       		if( !empty( $education ) ){
			                                        		foreach($education as $key => $row) {        
													 ?>
			                                            <tr class="itemeducation" id="<?php echo $row['ID']?>">
			                                                <td valign="middle"><a href="#" id="vieweducation-<?php echo $row['ID']?>"><?php echo $row['EDUCATIONTYPE']?></a></td>
			                                                <td valign="middle"><span class="muted"><?php echo $row['DESCRIPTION']?></span></td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['STARTDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['ENDDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['EDUCATIONDEGREE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['EDUCATIONGROUP']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['EDUCATIONCENTER']?></span>
			                                                </td>
			                                            </tr>
			                                            <tr id="educationdetail-<?php echo $row['ID']?>" style="display:none">
			                                            	<td class="detail" colspan="7">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['ID']?></h4>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Education</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="education" id="education" type="text"  class="form-control" placeholder="education" value="<?php echo $row['EDUCATIONTYPE']?>" disabled="disabled">
													                      </div>
													                    </div>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Description</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="description" id="description" type="text"  class="form-control" placeholder="Description" value="<?php echo $row['DESCRIPTION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Start Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="start_date" id="start_date" type="text"  class="form-control" placeholder="Start Date" value="<?php echo $row['STARTDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">End Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="end_date" id="end_date" type="text"  class="form-control" placeholder="End Date" value="<?php echo $row['ENDDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Degree</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="degree" id="degree" type="text"  class="form-control" placeholder="Degree" value="<?php echo $row['EDUCATIONDEGREE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Education Group</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="education_group" id="education_group" type="text"  class="form-control" placeholder="Education Group" value="<?php echo $row['EDUCATIONGROUP']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Institution</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="istitution" id="institution" type="text"  class="form-control" placeholder="Institution" value="<?php echo $row['EDUCATIONCENTER']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    
												                  	</div>
												                  </form>
												                  </div>
			                                            	</td>
			                                            </tr>
			                                            <?php }}else{?>
			                                            <tr>
			                                                <td valign="middle">No Data</td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"> <span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"> <span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                            </tr>

			                                            <?php } ?>
			                                        </tbody>
			                                    </table>
			                            </div>
			                        </div>
			                    </div>
	                		</div>
		                </form>
		              </div>

		               <!-- tabexperience -->
		              <div class="tab-pane" id="tabexperience">
		                <form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Experience</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="20%">Company</th>
			                                                <th width="10%">Start Date</th>
			                                                <th width="10%">End Date</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        <?php
			                                       		if( !empty( $experience ) ){
			                                        		foreach($experience as $key => $row) {        
													 ?>
			                                            <tr class="itemexperience" id="<?php echo $row['ID']?>">
			                                                <td valign="middle"><a href="#" id="viewexperience-<?php echo $row['ID']?>"><?php echo $row['COMPANY']?></a></td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['STARTDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['ENDDATE']?></span>
			                                                </td>
			                                            </tr>
			                                            <tr id="experiencedetail-<?php echo $row['ID']?>" style="display:none">
			                                            	<td class="detail" colspan="3">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['ID']?></h4>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Company</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="company" id="company" type="text"  class="form-control" placeholder="company" value="<?php echo $row['COMPANY']?>" disabled="disabled">
													                      </div>
													                    </div>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Position</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="position" id="position" type="text"  class="form-control" placeholder="Position" value="<?php echo $row['POSITION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Start Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="start_date" id="start_date" type="text"  class="form-control" placeholder="Start Date" value="<?php echo $row['STARTDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">End Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="end_date" id="end_date" type="text"  class="form-control" placeholder="End Date" value="<?php echo $row['ENDDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Street</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="street" id="street" type="text"  class="form-control" placeholder="street" value="<?php echo $row['ADDRESS']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Line of Business</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="lineofbusiness" id="lineofbusiness" type="text"  class="form-control" placeholder="Line of Business" value="<?php echo $row['LINEOFBUSSINESS']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Resignation Reason</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="resignation_reason" id="resignation_reason" type="text"  class="form-control" placeholder="Resignation Reason" value="<?php echo $row['RESIGNATIONREASON']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Last Salary</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="last_salary" id="last_salary" type="text"  class="form-control" placeholder="Last Salary" value="<?php echo $row['LASTSALARY']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    
												                  	</div>
												                  </form>
												                  </div>
			                                            	</td>
			                                            </tr>
			                                            <?php }}else{?>
			                                            <tr>
			                                                <td valign="middle">No Data</td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"> <span class="muted">No Data</span></td>
			                                            </tr>

			                                            <?php } ?>
			                                        </tbody>
			                                    </table>
			                            </div>
			                        </div>
			                    </div>
	                		</div>
		                </form>
		              </div>

		              <!-- tabsk -->
		              <div class="tab-pane" id="tabsk">
		                <form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Surat Keputusan</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="20%">SK Date</th>
			                                                <th width="15%">Nomor SK</th>
			                                                <th width="15%">Position</th>
			                                                <th width="10%">Departement</th>
			                                                <th width="10%">Tanggal Efektif</th>
			                                                <th width="10%">Tempat</th>
			                                                <th width="10%">Penandatangan</th>
			                                                <th width="10%">Posisi Penandatangan</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                       <?php
			                                       		if( !empty( $sk ) ){
			                                        		foreach($sk as $key => $row) {        
													 ?>
			                                            <tr class="itemsk" id="<?php echo $row['RECID']?>">
			                                                <td valign="middle"><a href="#" id="viewsk-<?php echo $row['RECID']?>"><?php echo $row['SKDATE']?></a></td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['TCN_SKNUMBER']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['POSITION']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['HRSDEPARTMENTID']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['EFFECTIVEDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['PLACE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['HRSSIGNNAME']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['HRSSIGNPOSITION']?></span>
			                                                </td>
			                                            </tr>
			                                            <tr id="skdetail-<?php echo $row['RECID']?>" style="display:none">
			                                            	<td class="detail" colspan="8">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['RECID']?></h4>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">SK Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="sk_date" id="sk_date" type="text"  class="form-control" placeholder="sk_date" value="<?php echo $row['SKDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Nomor SK</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="nomor_sk" id="nomor_sk" type="text"  class="form-control" placeholder="nomor SK" value="<?php echo $row['TCN_SKNUMBER']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Position</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="position" id="position" type="text"  class="form-control" placeholder="Position" value="<?php echo $row['HRSPOSITIONID']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Departement</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="departement" id="departement" type="text"  class="form-control" placeholder="Departement" value="<?php echo $row['HRSDEPARTMENTID']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Tanggal Efektif</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="tanggal_efektif" id="tanggal_efektif" type="text"  class="form-control" placeholder="Tanggal Efektif" value="<?php echo $row['EFFECTIVEDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Tempat</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="tempat" id="tempat" type="text"  class="form-control" placeholder="penandatangan" value="<?php echo $row['PLACE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Penandatangan</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="penandatangan" id="penandatangan" type="text"  class="form-control" placeholder="Penandatangan" value="<?php echo $row['HRSSIGNNAME']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Posisi Penandatangan</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['HRSSIGNPOSITION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    
												                  	</div>
												                  </form>
												                  </div>
			                                            	</td>
			                                            </tr>
			                                            <?php }}else{?>
			                                            <tr>
			                                                <td valign="middle">No Data</td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                            </tr>

			                                            <?php } ?>
			                                        </tbody>
			                                    </table>
			                            </div>
			                        </div>
			                    </div>
	                		</div>
		                </form>
		              </div>

		              <!-- tabsertijah -->
		              <div class="tab-pane" id="tabsertijah">
		            	<form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Serah Terima Ijazah</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="5%">No Identitas</th>
			                                                <th width="10%">Ijazah Name</th>
			                                                <th width="5%">Ijazah No</th>
			                                                <th width="10%">Tempat/tanggal dikeluarkan</th>
			                                                <th width="10%">Dikeluarkan oleh</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        <?php
			                                       		if( !empty( $sti ) ){
			                                        		foreach($sti as $key => $row) {          
													?>
			                                            <tr class="itemsertijah" id="<?php echo $row['RECID']?>">
			                                                <td valign="middle"><a href="#" id="viewsertijah-<?php echo $row['RECID']?>"><?php echo $row['IDENTITYNO']?></a></td>
			                                               
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['IJAZAH']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['NOMOR']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['IJAZAHHISTORY']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['INSTITUTION']?></span>
			                                                </td>
			                                            </tr>

			                                            <tr id="sertijahdetail-<?php echo $row['RECID']?>" style="display:none">
			                                            	<td class="detail" colspan="12">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['RECID']?></h4>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Tempat/tanggal diterbitkan</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="penandatangan" id="penandatangan" type="text"  class="form-control" placeholder="Penandatangan" value="<?php echo $row['PUBLISHEDPLACE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['AKTIFASIDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Sebagai</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['POSITION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Description</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['RECEIVEDBY']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Acknowledge by</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['ACKNOWLEDGEBY']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    
												                  	</div>
												                  </form>
												                  </div>
			                                            	</td>
			                                            </tr>
			                                            <?php }}else{?>
			                                            <tr>
			                                                <td valign="middle">No Data</td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                            </tr>

			                                            <?php } ?>
			                                        </tbody>
			                                    </table>
			                            </div>
			                        </div>
			                    </div>
	                		</div>
		                </form> 
		              </div>

		              <!-- tabjabatan -->
		              <div class="tab-pane" id="tabjabatan">
		            	<form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Riwayat Jabatan</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="10%">Organization Unit</th>
			                                                <th width="10%">Position Description</th>
			                                                <th width="10%">Empl Group</th>
			                                                <th width="10%">Grade</th>
			                                                <th width="10%">Branch ID</th>
			                                                <th width="10%">Personnel Action ID</th>
			                                                <th width="10%">Tanggal SK</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        <?php
			                                       		if( !empty( $jabatan ) ){
			                                        		foreach($jabatan as $key => $row) {        
													?>
			                                            <tr class="itemjabatan" id="<?php echo $row['ID']?>">
			                                                <td valign="middle"><a href="#" id="viewjabatan-<?php echo $row['ID']?>"><?php echo $row['ORGANIZATION']?></a></td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['POSITION']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['EMPLGROUP']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['GRADE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['BRANCH']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['PERSONACTION']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['SKDATE']?></span>
			                                                </td>
			                                            </tr>
			                                            <tr id="jabatandetail-<?php echo $row['ID']?>" style="display:none">
			                                            	<td class="detail" colspan="8">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['ID']?></h4>
													                   
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Organization Unit</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['ORGANIZATION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Position Description</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['POSITION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Empl Group</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['EMPLGROUP']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Grade</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['GRADE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">branch ID</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['BRANCH']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Personnel Action ID</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['PERSONACTION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">tanggal SK</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['SKDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    
												                  	</div>
												                  </form>
												                  </div>
			                                            	</td>
			                                            </tr>
			                                            <?php }}else{?>
			                                            <tr>
			                                                <td valign="middle">No Data</td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                            </tr>

			                                            <?php } ?>
			                                        </tbody>
			                                    </table>
			                            </div>
			                        </div>
			                    </div>
	                		</div>
		                </form> 
		              </div>

		              <!-- tabaward -->
		              <div class="tab-pane" id="tabaward">
		                <form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Award / Warning</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="15%">Award/Warning Type</th>
			                                                <th width="15%">Award/Warning ID</th>
			                                                <th width="15%">Description</th>
			                                                <th width="15%">Approved Date</th>
			                                                <th width="15%">SK Number</th>
			                                                <th width="10%">From Date</th>
			                                                <th width="10%">To Date</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        <?php
			                                       		if( !empty( $award ) ){
			                                        		foreach($award as $key => $row) {        
													?>
			                                            <tr class="itemaward" id="<?php echo $row['EMPLID']?>">
			                                                <td valign="middle"><a href="#" id="viewaward-<?php echo $row['EMPLID']?>"><?php echo $row['HRSAWARDWARNING']?></a></td>
			                                                
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['HRSEMPLAWARDWARNINGID']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['DESCRIPTION']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['SKAPPROVEDDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['SKDOCUMENTNUMBER']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['FROMDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['TODATE']?></span>
			                                                </td>
			                                            </tr>
			                                            <tr id="awarddetail-<?php echo $row['EMPLID']?>" style="display:none">
			                                            	<td class="detail" colspan="7">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['HRSEMPLAWARDWARNINGID']?></h4>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Award/Warning Type</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="penandatangan" id="penandatangan" type="text"  class="form-control" placeholder="Penandatangan" value="<?php echo $row['HRSAWARDWARNING']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Award/Warning ID</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['HRSEMPLAWARDWARNINGID']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Description</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['DESCRIPTION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Approved Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['SKAPPROVEDDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">SK Number</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['SKDOCUMENTNUMBER']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">From Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['FROMDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">To Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['TODATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    
												                  	</div>
												                  </form>
												                  </div>
			                                            	</td>
			                                            </tr>
			                                            <?php }}else{?>
			                                           <tr>
			                                                <td valign="middle">No Data</td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                            </tr>

			                                            <?php } ?>
			                                        </tbody>
			                                    </table>
			                            </div>
			                        </div>
			                    </div>
	                		</div>
		                </form> 
		              </div>

		               <!-- tabikatandinas -->
		              <div class="tab-pane" id="tabikatandinas">
		                <form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Ikatan Dinas</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="15%">ID</th>
			                                                <th width="15%">Type</th>
			                                                <th width="15%">Employee</th>
			                                                <th width="15%">Description</th>
			                                                <th width="15%">To Date</th>
			                                                <th width="15%">From Date</th>
			                                                <th width="10%">Amount</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        <?php
			                                       		if( !empty($ikatan_dinas) ){
			                                        		foreach($ikatan_dinas as $key => $row) {        
													?>
			                                            <tr class="itemikatandinas" id="<?php echo $row['RECID']?>">
			                                                <td valign="middle"><a href="#" id="viewikatandinas-<?php echo $row['RECID']?>"><?php echo $row['HRSEMPLODPID']?></a></td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['TYPE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['EMPLOYEE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['DESCRIPTION']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['FROMDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['TODATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['AMOUNT']?></span>
			                                                </td>
			                                            </tr>
			                                            <tr id="ikatandinasdetail-<?php echo $row['RECID']?>" style="display:none">
			                                            	<td class="detail" colspan="6">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['HRSEMPLODPID']?></h4>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">ID</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="penandatangan" id="penandatangan" type="text"  class="form-control" placeholder="Penandatangan" value="<?php echo $row['HRSEMPLODPID']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Type</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['TYPE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Employee</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['EMPLOYEE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Description</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['DESCRIPTION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">To Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['FROMDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">From Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['TODATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Amount</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['AMOUNT']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    
												                  	</div>
												                  </form>
												                  </div>
			                                            	</td>
			                                            </tr>
			                                            <?php }}else{?>
			                                            <tr>
			                                                <td valign="middle">No Data</td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                            </tr>

			                                            <?php } ?>
			                                        </tbody>
			                                    </table>
			                            </div>
			                        </div>
			                    </div>
	                		</div>
		                </form> 
		              </div>

		            </div>
		          </div>
		        </div>
					
				</div>
			</div> 
			</div>  
		<!-- END PAGE --> 
		</div>
	</div>