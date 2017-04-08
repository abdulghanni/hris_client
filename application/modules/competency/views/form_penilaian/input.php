<div class="page-content">
  	<div id="portlet-config" class="modal hide">
      <div class="modal-header">
          <button data-dismiss="modal" class="close" type="button"></button>
           <h3>Widget Settings</h3>
      </div>
      <div class="modal-body">Widget settings form goes here</div>
  	</div>
  	<div class="clearfix"></div>
 	<div class="content">
	    <div class="page-title">
	        <i class="icon-custom-left"></i>
	        <h3>Kompetensi - <a href="<?=base_url($controller)?>">Human Valule Matrix - Input</a></h3> 
	    </div>
	    <div class="row">
	     	<div class="col-md-12">
		        <div class="grid simple">
		          	<div class="grid-body no-border">
		            <br/>
			            <div class="row-fluid">
					    	<?php
					    	$att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
					    	echo form_open_multipart($controller.'/add/', $att);
					   		?>
							<!-- <input type="hidden" id="form" value="form_penilaian"> -->
					   		<div class="row">
					            <div class="col-md-6">
					            	<div class="row form-row">
						            	<div class="col-md-3">
					                        <label class="form-label text-right">Periode</label>
					                    </div>
					                    <div class="col-md-9">
							            	<select class="select2" style="width:100%" id="comp_session_id" name="comp_session_id" required>
					                    		<option value="">-- Pilih Periode --</option>
							            		<?php foreach($periode as $u){?>
							            			<option value="<?=$u->id?>"><?=$u->year?></option>
							            		<?php } ?>
							            	</select>
					                    </div>
					                </div>
					            	<div class="row form-row">
						            	<div class="col-md-3">
					                        <label class="form-label text-right">Karyawan Yang Dinilai</label>
					                    </div>
					                    <div class="col-md-9">
					                    	<?php if(is_admin()){?>
					                            <select id="emp" class="select2" style="width:100%" name="nik">
					                              <option value="0">-- Pilih Karyawan --</option>
					                              <?php
					                              foreach ($users as $u) : ?>
					                                <option value="<?php echo $u->nik?>" ><?php echo $u->username.' - '.$u->nik; ?></option>
					                              <?php endforeach; ?>
					                            </select>
					                          <?php }elseif($subordinate->num_rows() > 0){?>
					                          <input type="hidden" id="empSess" value="<?= $sess_id ?>">
					                            <select id="emp" class="select2" style="width:100%" name="nik">
					                              <option value="0">-- Pilih Karyawan --</option>
					                              <?php foreach($subordinate->result() as $row):?>
					                                <option value="<?php echo get_nik($row->id)?>"><?php echo get_name($row->id).' - '.get_nik($row->id)?></option>
					                              <?php endforeach;?>
					                            </select>
					                          <?php }else{ ?>
					                            <select id="emp" class="select2" style="width:100%" name="nik">
					                              <option value="0">-- Anda tidak mempunyai bawahan --</option>
					                            </select>
					                        <?php } ?>

							            	<!-- <select class="select2" style="width:100%" id="emp" name="nik">
							            		<?php foreach($users as $u){?>
							            			<option value="<?=$u->nik?>"><?=$u->nik.' - '.$u->username?></option>
							            		<?php } ?>
							            	</select> -->
					                    </div>
					                </div>
					            	<div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('start_working') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="seniority_date" id="seniority_date" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('dept_div') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="organization" id="organization" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('position') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="position" id="position" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                      </div>
				                    </div>
					            </div>
					        </div>
				            <div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="5%" rowspan="2" valign="center">
								                    No.
												</th>
												<th width="25%" rowspan="2">Kompetensi</th>
												<th width="25%" colspan="2" class="text-center">Kemampuan</th>
												<th width="25%" colspan="2" class="text-center">Kemauan</th>
												<th width="25%" rowspan="2">Alasan</th>
											</tr>
											<tr>
												<th class="text-center">Kurang</th>
												<th class="text-center">Mampu</th>
												<th class="text-center">Kurang</th>
												<th class="text-center">Mau</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1;foreach ($competency_penilaian as $r) { ?>
												<tr>
													<td><?=$i++?></td>
													<td>
														<?=$r->title?>
														<input type="hidden" name="competency_penilaian_id[<?=$r->id?>]" value="<?=$r->id?>">
													</td>
													<td class="text-center">
														<input id="kemampuan_kurang<?=$r->id?>" name="kemampuan[<?=$r->id?>]" value="0" type="radio">
													</td>
													<td class="text-center">
														<input id="kemampuan_mampu<?=$r->id?>" name="kemampuan[<?=$r->id?>]" value="1" type="radio">
													</td>
													<td class="text-center">
														<input id="kemauan_kurang<?=$r->id?>" name="kemauan[<?=$r->id?>]" value="0" type="radio">
													</td>
													<td class="text-center">
														<input id="kemauan_mampu<?=$r->id?>" name="kemauan[<?=$r->id?>]" value="1" type="radio">
													</td>
													<td><textarea name="alasan[<?=$r->id?>]" class="form-control"></textarea></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
								<div class="col-md-12">
									<h3>Kolom dibawah ini untuk HR</h3>
									<?php $myk = ($sess_id != 118) ? 'disabled="disabled"' : '';?>
								</div>
								<div class="col-md-12">
									<h4>Kuadran :</h4>
									<?php foreach($kuadran as $s){?>
									
										<div class="radio radio-success">
					                        <input id="<?php echo 'kuadran_id_'.$s->id?>" name="kuadran_id" value="<?=$s->id?>" type="radio" <?php echo $myk?>>
					                        <label for="<?php echo 'kuadran_id_'.$s->id?>"><?=$s->id.'. '.$s->title?></label>
					                     </div>
									<?php } ?>
								</div>
								<div class="col-md-12">
									<h4>Rekomendasi :</h4>
									<?php foreach($rekomendasi as $r){?>
									<?php if($r->id == 1) { 
										$label_rek = 'A';
									}elseif($r->id == 2) {
										$label_rek = 'B';
									}elseif($r->id == 3) {
										$label_rek = 'C';
									}else{
										$label_rek = 'D';
									} ?>
										<div class="radio radio-success">
					                        <input id="<?=$r->id?>" name="rekomendasi_id" value="<?=$r->id?>" type="radio" <?php echo $myk?>>
					                        <label for="<?=$r->id?>"><?=$label_rek.'. '.$r->title?></label>
					                     </div>
									<?php } ?>
								</div>
				            	<div id="approver">
				            		<fieldset>
				            			<legend>Atasan</legend>
						            	<div class="col-md-12">
						            		<button id="btnAddApprover" type="button" class="btn btn-primary" onclick="addApprover('tblApprover')"><i class="icon-plus"></i> Tambah Atasan</button>
						            	</div>
						            	<div class="col-md-7">
						            		<table class="table" id="tblApprover">
						            			<thead>
						            				<tr>
					                					<th width="1%"></th>
						                				<th width="29%"></th>
						                				<th width="70%"></th>
						                			</tr>
						            			</thead>
						            			<tbody>
						            				
						            			</tbody>
						            		</table>
						            	</div>
						            </fieldset>					            
								</div>
				            </div>
			            	<div id="submit" class="form-actions">
			                 	<div class="pull-right">
			                    	<button class="btn btn-success btn-cons" type="submit"><i class="icon-ok"></i> <?php echo lang('save_button') ?></button>
			                    	<a href="<?php echo site_url($controller) ?>"><button class="btn btn-white btn-cons" type="button"><?php echo lang('cancel_button') ?></button></a>
			                  	</div>
			                </div>
			              	<?php echo form_close(); ?>
			            </div>
		          	</div>
		        </div>
	      	</div>
	    </div>
  	</div>
</div>
