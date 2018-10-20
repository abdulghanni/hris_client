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
					    	$att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formedit');
					    	echo form_open_multipart($controller.'/do_edit/'.$id, $att);
					   		?>
							<!-- <input type="hidden" id="form" value="form_penilaian"> -->
					   		<div class="row">
					            <div class="col-md-6">
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
					                        <label class="form-label text-right">Nama</label>
					                    </div>
					                    <div class="col-md-9">
							            	<input type="text" class="form-control" value="<?=get_name($emp_id)?>" readonly>
							            	<input type="hidden" name="nik" value="<?=get_name($emp_id)?>">
					                    </div>
					                </div>
					                <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('dept_div') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="organization" id="organization" type="text"  class="form-control" placeholder="-" value="<?=get_organization_name($org_id)?>" disabled="disabled">
				                        <input name="organization_id" id="organization_id" type="hidden"  class="form-control" placeholder="-" value="<?=$org_id?>">
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right">Position Group</label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="position_group_id" id="position-group" type="text"  class="form-control" placeholder="-" value="<?=$pos_group_id?>" readonly>
				                      </div>
				                    </div>
				                    <!-- <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('position') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="position" id="position" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                      </div>
				                    </div> -->
					            </div>
					        </div>
				            <div class="row">
								<div class="col-md-12">
									<div id="result">
										<?php if($competency_mapping_indikator->num_rows > 0){ ?>
										<div class="table-responsive">
										<table class="table table-bordered" width="100%">
											<thead>
												<tr>
													<td width="5%" rowspan="2">
														<div class="checkbox check-default">
										                  <input id="checkbox" type="checkbox" value="0"> 
										                  <label for="checkbox"></label>
										                </div>
													</td>
													<td width="20%" rowspan="2">Kompetensi</td>
													<td width="5%" rowspan="2" class="text-center">Standar Komp. (SK)</td>
													<td width="5%" rowspan="2" class="text-center">Aktual Komp. (AK)</td>
													<td width="5%" rowspan="2" class="text-center">Score GAP (AK-SK)</td>
													<td width="60%" colspan="2" class="text-center">Program Improvement</td>
												</tr>
												<tr>
													<td width="30%" class="text-center">Tindakan</td>
													<!-- <td width="15%" class="text-center">Tanggal Pelaksanaan</td> -->
													<td width="30%" class="text-center">PIC</td>
													<!-- <td width="15%" class="text-center">Hasil</td> -->
												</tr>
											</thead>
											<tbody>
													<?php $i = 1;foreach($competency_group as $cg){
														$kompetensi = getAll('competency_def', array('comp_group_id'=>'where/'.$cg->id), array('id'=>$def_indikator));
													?>
														<tr>
															<th colspan="2" width="30%"><?= $cg->title ?></th>
														<?php $j = 1;foreach($kompetensi->result() as $k){
															$f = array('position_group_id'=>'where/'.$pos_group_id, 'competency_def_id'=>'where/'.$k->id);
															$sk = getValue('level', 'competency_mapping_standar_detail', $f);
															$pa = getAll('competency_personal_assesment_detail', array('competency_personal_assesment_id'=>'where/'.$id, 'competency_def_id'=>'where/'.$k->id))->row();

														?>
														<?php if(!empty($pa)){?>
														<tr>
															<td width="5%">
																<?=$j++?>
															</td>
															<td class="text-left" width="25%">
																<?=$k->title?>
																<input type="hidden" name="competency_def_id[]" value="<?=$k->id?>">		
															</td>
															<td class="text-center">
																<!-- <?=$sk?> -->
																<input type="text" id="sk<?=$k->id?>" name="sk[]" class="form-control text-center" value="<?=$sk?>" readonly>
															</td>
															<td>
																<select id="ak<?=$k->id?>" class="select2" name="ak[]" onchange='getGap("<?=$k->id?>")'>
																	<?php for ($i=0; $i <=4 ; $i++) { 
																		$selected = ($pa->ak == $i) ? 'selected="selected"' :'';
																		echo "<option value='$i' $selected>$i</option>";
																	}?>
																</select>
															</td>
															<td>
																<input id="gap<?=$k->id?>" type="text" name="gap[]" class="form-control text-center" value="<?=$pa->gap?>" readonly="readonly">
															</td>
															<td>
																<select id="" class="select2" name="competency_tindakan_id[]">
																	<option value="0">-- Pilih Tindakan --</option>
																	<?php foreach ($tindakan as $t) {
																		$selected = ($pa->competency_tindakan_id == $t->id) ? 'selected="selected"' : ''; 
																		echo "<option value='$t->id' $selected>$t->title</option>";
																	}?>
																</select>
															</td>
															<!-- <td><input name="tgl[]" class="tanggal form-control" value="<?=(($pa->tgl != '1970-01-01')) ? $pa->tgl : ''?>" ></td> -->
															<!-- <td><input name="tgl[]" class="tanggal form-control" value="<?=$pa->tgl?>" ></td> -->
															<td><input type="text" name="pic[]" class="form-control" value="<?=$pa->pic?>"></td>
															<!-- <td><input type="text" name="hasil[]" class="form-control" value="<?=$pa->hasil?>"></td> -->
															<!-- <td>
																<select id="" class="select2" name="hasil[]">
																	<option value="0" <?php //echo (($pa->hasil == '0') || (strlen($pa->hasil) == 0)) ? 'selected="selected"' : ''; ?> >-- Pilih --</option>
																	<option value="A" <?php //echo ($pa->hasil == 'A') ? 'selected="selected"' : ''; ?> >A</option>
																	<option value="B" <?php //echo ($pa->hasil == 'B') ? 'selected="selected"' : ''; ?> >B</option>
																	<option value="C" <?php //echo ($pa->hasil == 'C') ? 'selected="selected"' : ''; ?> >C</option>
																	<option value="D" <?php //echo ($pa->hasil == 'D') ? 'selected="selected"' : ''; ?> >D</option>
																	
																</select>
															</td> -->
														</tr>
														<?php } } ?>
													<?php } ?>
											</tbody>
										</table>
										<div>

										
										<script type="text/javascript">
											function getGap(id){
												var sk = parseInt($("#sk"+id).val());
												var ak = parseInt($("#ak"+id).val());
												$("#gap"+id).val(ak-sk);
											}

											/*$(document).ready(function() 
											{
												$('.tanggal')
												.datepicker({
													todayHighlight: true,
													autoclose: true,
													format: "yyyy-mm-dd"
												});
											});*/
										</script>
										<?php }else{ ?> 
											<label class="label label-warning">Departement <?=get_organization_name($org_id);?> Belum Mempunyai Mapping Kompetensi</label>
										<?php } ?>
									</div>
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
						            				<?php
						            				if($approver->num_rows>0){
						            					$i = 1;foreach ($approver->result() as $a) {
						            				?>
						            				<tr>
						            						
						            						<td>Atasan</td>
						            						<td><?=$i++?></td>
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
