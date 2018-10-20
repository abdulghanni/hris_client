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
	        <h3>Kompetensi - <a href="<?=base_url($controller)?>"><?=$title?> - Input</a></h3> 
	    </div>
	    <div class="row">
	     	<div class="col-md-12">
		        <div class="grid simple">
		          	<div class="grid-body no-border">
		            <br/>
			            <div class="row-fluid">
					    	<?php
					    	$att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
					    	echo form_open_multipart($controller.'/do_edit/'.$id, $att);
					   		?>
							<!-- <input type="hidden" id="form" value="form_penilaian"> -->
					   		<div class="row">
					            <div class="col-md-6">
					            <div class="row form-row">
						            	<div class="col-md-3">
					                        <label class="form-label text-right">Kode HVM</label>
					                    </div>
					                    <div class="col-md-9">
							            	<input type="text" class="form-control" value="<?php echo $kode_surat ?>" readonly>
							            	
					                    </div>
					                </div>
					            	<div class="row form-row">
						            	<div class="col-md-3">
					                        <label class="form-label text-right">Periode</label>
					                    </div>
					                    <div class="col-md-9">
							            	<input type="text" class="form-control" value="<?=get_year_session($comp_session_id)?>" readonly>
							            	<input type="hidden" name="comp_session_id" value="<?=get_year_session($comp_session_id)?>">
					                    </div>
					                </div>
					            	<div class="row form-row">
						            	<div class="col-md-3">
					                        <label class="form-label text-right">Karyawan Yang Dinilai</label>
					                    </div>
					                    <div class="col-md-9">
							            	<input type="text" value="<?=get_name($form->nik)?>" class="form-control" readonly>
							            	<input type="hidden" value="<?=$form->nik?>" id="emp">
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
											</tr>
											<tr>
												<th class="text-center">Kurang</th>
												<th class="text-center">Mampu</th>
												<th class="text-center">Kurang</th>
												<th class="text-center">Mau</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1;foreach ($competency_penilaian as $r) { 
												$det = getAll('competency_form_penilaian_detail', array('competency_form_penilaian_id'=>'where/'.$id, 'competency_penilaian_id'=>'where/'.$r->id))->row();?>
												<tr>
													<td><?=$i++?></td>
													<td>
														<?=$r->title?>
														<input type="hidden" name="competency_penilaian_id[<?=$r->id?>]" value="<?=$r->id?>">
													</td>
													<td class="text-center">
														<input id="kemampuan_kurang<?=$r->id?>" name="kemampuan[<?=$r->id?>]" value="0" type="radio" <?=($det->kemampuan == 0) ? 'checked' : ''?>>
													</td>
													<td class="text-center">
														<input id="kemampuan_mampu<?=$r->id?>" name="kemampuan[<?=$r->id?>]" value="1" type="radio" <?=($det->kemampuan == 1) ? 'checked' : ''?>>
													</td>
													<td class="text-center">
														<input id="kemauan_kurang<?=$r->id?>" name="kemauan[<?=$r->id?>]" value="0" type="radio" <?=($det->kemauan == 0) ? 'checked' : ''?>>
													</td>
													<td class="text-center">
														<input id="kemauan_mampu<?=$r->id?>" name="kemauan[<?=$r->id?>]" value="1" type="radio" <?=($det->kemauan == 1) ? 'checked' : ''?>>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>

								<div class="col-md-12">
									<h4>Kuadran :</h4>
									<?php foreach($kuadran as $s){?>
										<div class="radio radio-success">
					                        <input id="<?php echo 'kuadran_id_'.$s->id?>" name="kuadran_id" value="<?=$s->id?>" type="radio" <?=($form->kuadran_id == $s->id) ? 'checked' : ''?>>
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
					                        <input id="<?=$r->id?>" name="rekomendasi_id" value="<?=$r->id?>" type="radio" <?=($form->rekomendasi_id == $r->id) ? 'checked' : ''?>>
					                        <label for="<?=$r->id?>"><?=$label_rek.'. '.$r->title?></label>
					                     </div>
									<?php } ?>
								</div>
								<div class="col-md-12">
				            	<div id="approver">
				            		<fieldset>
				            			<legend>Approver</legend>
						            	<div class="col-md-12">
						            		<button id="btnAddApprover" type="button" class="btn btn-primary" onclick="addApprover('tblApprover')"><i class="icon-plus"></i> Tambah Approver</button>
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
						            				<?php
						            				if($approver->num_rows>0){
						            					$i = 1;foreach ($approver->result() as $a) {
						            				?>
						            				<tr>
						            						<td><?=$i++?></td>
						            						<td>Nama Approver</td>
						            						<td><?=get_name($a->user_id)?>
						            							<input type="hidden" name="approver_id[]" value="<?=$a->user_id?>">
						            						</td>
						            						<td><button type="button" id="removebutton" class="btn btn-danger removebutton"><i class="icon-remove"></i></button></td>
						            				</tr>
						            				<?php 
						            					}
						            				} 
						            				?>
						            			</tbody>
						            		</table>
						            	</div>
						            </fieldset>					            
								</div>
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
