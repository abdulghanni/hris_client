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
	        <h3>Kompetensi - <a href="<?=base_url($controller)?>">Mapping Indikator - Input</a></h3> 
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
				            <div class="row form-row">
				              	<label class="control-label col-md-3">Departement / Bagian</label>
				              	<div class="col-md-9">
					              	<?php if($org_id == null){?>
					                <select id="org" class="select2" style="width:100%">
					                  <option value="0">-- Pilih  Departement/Bagian --</option>
					                  <?php 
					                  	foreach($org as $r){
					                  	$selected = ($org_id == $r['ID']) ? 'selected="selected"' : '';
					                  ?>
					                  <option value="<?=$r['ID']?>" <?=$selected?>><?php echo $r['DESCRIPTION']?></option>
					                  <?php } ?>
					                </select>
					                <?php }else{?>
					                <input type="text" class="form-control" value="<?=get_organization_name($org_id)?>" readonly>
					                <input type="hidden" id="org_id" name="org_id" value="<?=$org_id?>">
					                <?php } ?>
				              	</div>
				            </div>
				            <div class="row">
				            	<div class="col-md-12">
				            		<ul>
				            			<li>
				            				<h4><span class="label label-warning">Check List pada kompetensi yang digunakan di Departemen / Bagian <?=get_organization_name($org_id)?></span></h4>
				            			</li>
				            		</ul>
				            	</div>
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="5%">
													<!-- <div class="checkbox check-default">
								                      <input id="checkbox" type="checkbox" value="0"> 
								                      <label for="checkbox"></label>
								                    </div> -->
												</th>
												<th width="25%">Kompetensi</th>
												<th width="70%" colspan="<?=$pg_size?>" class="text-center">Level Jabatan</th>
											</tr>
										</thead>
										<tbody>
											<?php if($competency_mapping_indikator->num_rows > 0){ ?>
												<?php $i = 1;foreach($competency_group as $cg){
													$kompetensi = getAll('competency_def', array('comp_group_id'=>'where/'.$cg->id), array('id'=>$def_indikator));
												?>
													<tr>
														<th colspan="2" width="30%"><?= $cg->title ?></th>
														<?php foreach ($pos_group as $key => $value) {
															echo '<th style="text-center" width="'.$col.'%">'.$value.'</th>';
															echo '<input type="hidden" name="position_group[]" value="'.$value.'">';
														}?>
													</tr>
													<?php $j = 1;foreach($kompetensi->result() as $k){
													?>
													<tr>
														<td width="5%">
															<?=$j++?>
														</td>
														<td class="text-left" width="25%">
															<?=$k->title?>
															<input type="hidden" name="competency_def_id[]" value="<?=$k->id?>">		
														</td>
														<?php foreach ($pos_group as $key => $value) {
															$filter = array('organization_id'=>'where/'.$org_id,
																		'competency_def_id'=>'where/'.$k->id,
																		'position_group_id'=>'where/'.$value
																		);
																	$standar = getValue('level', 'competency_mapping_standar_detail', $filter);
															?>
															<td width="<?=$col?>%">
																<select class="select2" name="level[<?=$k->id?>][]">
																<?php for ($i=0; $i<5 ; $i++) { ?>
																	<option value="<?=$i?>" <?=($standar == $i) ? 'selected="selected"' : ''?>><?=$i?></option>
																<?php } ?>
																</select>
															</td>
														<?php }?>
													</tr>
													<?php } ?>
												<?php } ?>
											<?php }else{ ?> 
												<?php $i = 1;foreach($competency_group as $cg){
													$kompetensi = getAll('competency_def', array('comp_group_id'=>'where/'.$cg->id));
												?>
													<tr>
														<th colspan="2" width="30%"><?= $cg->title ?></th>
														<?php foreach ($pos_group as $key => $value) {
															echo '<th style="text-center" width="'.$col.'%">'.$value.'</th>';
															echo '<input type="hidden" name="position_group[]" value="'.$value.'">';
														}?>
													</tr>
													<?php foreach($kompetensi->result() as $k){
													?>
													<tr>
														<td width="5%">
															<div class="checkbox check-default">
										                      <input id="checkbox<?=$k->id?>" type="checkbox" name="competency_def_id[]" value="<?=$k->id?>">
									                      	  <label for="checkbox<?=$k->id?>"></label>
										                    </div>
														</td>
														<td class="text-left" width="25%"><?=$k->title?></td>
														<?php foreach ($pos_group as $key => $value) {?>
															<td width="<?=$col?>%">
																<select class="select2" name="level[<?=$k->id?>][]">
																<?php for ($i=0; $i<5 ; $i++) { ?>
																	<option value="<?=$i?>"><?=$i?></option>
																<?php } ?>
																</select>
															</td>
														<?php }?>
													</tr>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</tbody>
									</table>
								</div>
				            	<div id="approver" class="col-md-12">
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
