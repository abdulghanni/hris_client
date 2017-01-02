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
	        <h3>Kompetensi - <a href="<?=base_url($controller)?>">Form Penilaian KPI - Input</a></h3> 
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
				              	<label class="control-label col-md-3">Periode</label>
				              	<div class="col-md-9">
					              	<?php if($comp_session_id == null){?>
					                <select id="org" class="select2" style="width:100%">
					                  <option value="0">Periode</option>
					                  <?php 
					                  	foreach($org as $r){
					                  	$selected = ($comp_session_id == $r['ID']) ? 'selected="selected"' : '';
					                  ?>
					                  <option value="<?=$r['ID']?>" <?=$selected?>><?php echo $r['YEAR']?></option>
					                  <?php } ?>
					                </select>
					                <?php }else{?>
					                <?php $periode = $periode->row_array(); $year = $periode['year'];?>
					                <input type="text" class="form-control" value="<?=$year?>" readonly>
					                <input type="hidden" id="comp_session_id" name="comp_session_id" value="<?=$comp_session_id?>">
					                <?php } ?>
				              	</div>
				            </div>
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
				            	<!-- <div class="col-md-12">
				            		<p><button type="button" id="addkpi" class="btn btn-primary" onClick="addkpi_()">Tambah KPI</button></p>
				            	</div> -->
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											
										</thead>
										<tbody id="compentency-kpi">
											<?php foreach ($pos as $pos) { ?>
													<tr>
														<td colspan="6">
															<h4><?php echo $pos['DESCRIPTION']?></h4>
															<table>
																<?php 
																$kpi = GetJoin('competency_mapping_kpi_detail as a','competency_monitoring as b','a.competency_monitoring_id = b.id','LEFT','
														            a.id as id, 
														            a.organization_id as organization_id, 
														            a.position_group_id as position_group_id, 
														            a.area_kinerja_utama as area_kinerja_utama, 
														            a.kpi as kpi, a.bobot_kpi as bobot_kpi, 
														            a.target_kpi as target_kpi, 
														            a.sumber_info as sumber_info, 
														            a.competency_monitoring_id as competency_monitoring_id,
														            a.is_deleted as is_deleted, 
														            b.title as competency_monitoring
														            ',array('a.organization_id'=>'where/'.$org_id,'a.is_deleted'=>'where/0','a.position_group_id'=>'where/'.$pos['ID']));
														            ?>
															        <tr>
																		<th >Area Kinerja Utama</th>
																		<th >KPI</th>
																		<th >Bobot KPI</th>
																		<th >Target KPI</th>
																		<th >Sumber Info</th>
																		<th >Monitoring</th>
																	</tr>    
																<?php foreach ($kpi->result_array() as $kpi) { ?>
																	<tr>
																		<td>
																			<?php 
																			/*$kpi_detail = $kpi_detail = getAll('competency_form_kpi_detail',array('competency_mapping_kpi_detail_id'=>'where/'.$kpi["id"],'is_deleted'=>'where/0','comp_session_id'=>'where/'.$comp_session_id,'organization_id'=>'where/'.$org_id));
																			if($kpi_detail->num_rows() > 0)
																			{
																				$val_kpi_detail = $kpi_detail->row_array();
																				$url_red = 'edit_detail/'.$org_id.'/'.$comp_session_id.'/'.$kpi["id"].'/'.$val_kpi_detail['id'].'/';
																			}else
																			{
																				$url_red = 'input_detail/'.$org_id.'/'.$comp_session_id.'/'.$kpi["id"].'/';
																			}*/
																			?>

																			<!-- <a href="<?php //echo site_url('competency/form_kpi/'.$url_red)?>">
																				<?php //echo $kpi['area_kinerja_utama']?>
																			</a> -->
																			<?php $kpi_detail = $kpi_detail = getAll('competency_form_kpi_detail',array('competency_mapping_kpi_detail_id'=>'where/'.$kpi["id"],'is_deleted'=>'where/0','comp_session_id'=>'where/'.$comp_session_id,'organization_id'=>'where/'.$org_id));
																			/*if($kpi_detail->num_rows() > 0)
																			{
																				$val_kpi_detail = $kpi_detail->row_array();
																				$url_red = 'edit_detail/'.$org_id.'/'.$comp_session_id.'/'.$kpi["id"].'/'.$val_kpi_detail['id'].'/';
																			}else
																			{
																				$url_red = 'input_detail/'.$org_id.'/'.$comp_session_id.'/'.$kpi["id"].'/';
																			}*/
																			$url_red = 'employee/'.$org_id.'/'.$comp_session_id.'/'.$kpi["id"].'/';
																			?>
																			<a href="<?php echo site_url('competency/form_kpi/'.$url_red)?>">
																				<?php echo $kpi['area_kinerja_utama']?>
																			</a>
																			</td>
																		<td ><?php echo $kpi['kpi']?></td>
																		<td ><?php echo $kpi['bobot_kpi']?></td>
																		<td ><?php echo $kpi['target_kpi']?></td>
																		<td ><?php echo $kpi['sumber_info']?></td>
																		<td ><?php echo $kpi['competency_monitoring']?></td>
																	</tr>
																<?php } ?>
															</table>
														</td>
													</tr>
											<?php }	?>
													
										</tbody>
									</table>
								</div>
				            	
				            </div>
			            	<div id="submit" class="form-actions">
			                 	<div class="pull-right">
			                    	
			                    	<a href="<?php echo site_url($controller) ?>"><button class="btn btn-info btn-cons" type="button"><?php echo lang('cancel_button') ?></button></a>
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
