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
	        <h3>Kompetensi - <a href="<?=base_url($controller)?>">Mapping KPI - Input</a></h3> 
	        <input type="hidden" name="url_ajax_add" id="url_ajax_add" value="<?php echo $url_ajax_add ?>">
	        <input type="hidden" name="url_ajax_update" id="url_ajax_update" value="<?php echo $url_ajax_update ?>">
	        <input type="hidden" name="url_ajax_edit" id="url_ajax_edit" value="<?php echo $url_ajax_edit ?>">
	        <input type="hidden" name="url_ajax_delete" id="url_ajax_delete" value="<?php echo $url_ajax_delete ?>">
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
				            		<p><button type="button" id="addkpi" class="btn btn-primary" onClick="addkpi_()">Tambah KPI</button></p>
				            	</div>
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="12.5%">Jabatan</th>
												<th width="12.5%">Area Kinerja Utama</th>
												<th width="12.5%">Key Performance Indicators (KPI)</th>
												<th width="12.5%">Bobot KPI</th>
												<th width="12.5%">Target</th>
												<th width="12.5%">Sumber Info</th>
												<th width="12.5%">Monitoring</th>
												<th width="12.5%">Aksi</th>
											</tr>
										</thead>
										<tbody id="compentency-kpi">
											<?php foreach ($kpi->result_array() as $key => $value) { ?>
												<tr>
													<td width="12.5%"><?php echo get_position_name($value['position_group_id'])?></th>
													<td width="12.5%"><?php echo $value['area_kinerja_utama']?></th>
													<td width="12.5%"><?php echo $value['kpi']?></th>
													<td width="12.5%"><?php echo $value['bobot_kpi']?></th>
													<td width="12.5%"><?php echo $value['target_kpi']?></th>
													<td width="12.5%"><?php echo $value['sumber_info']?></th>
													<td width="12.5%"><?php echo $value['competency_monitoring']?></th>
													<td width="12.5%">
														<a class="btn btn-sm btn-primary btn-mini" href="javascript:void()" title="Edit" onclick="edit_(<?php echo $value['id']?>)"><i class="icon-edit"></i> Edit</a>
            											<a class="btn btn-sm btn-danger btn-mini" href="javascript:void()" title="Hapus" onclick="delete_(<?php echo $value['id']?>,'<?php echo $org_id?>')"><i class="icon-remove"></i> Delete</a>'
													</th>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
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

<!-- Bootstrap modal -->
  <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Form</h3>
        </div>
        <form action="#" id="form-competency" class="form">
          <div class="modal-body">
              <div class="row form-row">
                <label class="control-label col-md-3">Jabatan</label>
                  <div class="col-md-9">
                  <?php 
                    $js = 'class="select2" style="width:50%"';
                    echo form_dropdown('position_group_id', $pos_group,'',$js); 
                  ?>
                  <input type="hidden" id="org_id" name="org_id" value="<?=$org_id?>">
                </div>
                  <span class="help-block"></span>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">Area Kinerja Utama</label>
                <div class="col-md-9">
                  <input name="area_kinerja_utama" placeholder="" class="form-control" type="text">
                  <span class="help-block"></span>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">KPI</label>
                <div class="col-md-9">
                  <input name="kpi" placeholder="" class="form-control" type="text">
                  <span class="help-block"></span>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">Bobot KPI</label>
                <div class="col-md-9">
                  <input name="bobot_kpi" placeholder="" class="form-control" type="text">
                  <span class="help-block"></span>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">Target KPI</label>
                <div class="col-md-9">
                  <input name="target_kpi" placeholder="" class="form-control" type="text">
                  <span class="help-block"></span>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">Sumber Info</label>
                <div class="col-md-9">
                  <input name="sumber_info" placeholder="" class="form-control" type="text">
                  <span class="help-block"></span>
                </div>
              </div>

              

              <div class="row form-row">
                <label class="control-label col-md-3">Monitoring</label>
                <div class="col-md-9">
                  <?php 
                    $js = 'class="select2" style="width:50%"';
                    echo form_dropdown('competency_monitoring_id', $options_competency_monitoring_id,'',$js); 
                  ?>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" value="" name="id" class="form-control"> 
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Bootstrap modal -->
