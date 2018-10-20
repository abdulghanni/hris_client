
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
	        <h3>Kompetensi - <a href="<?=base_url($controller)?>">Form Penilaian KPI - User</a></h3> 
	        <!-- <input type="hidden" name="url_ajax_add" id="url_ajax_add" value="<?php echo $url_ajax_add ?>">
	        <input type="hidden" name="url_ajax_update" id="url_ajax_update" value="<?php echo $url_ajax_update ?>">
	        <input type="hidden" name="url_ajax_edit" id="url_ajax_edit" value="<?php echo $url_ajax_edit ?>">
	        <input type="hidden" name="url_ajax_delete" id="url_ajax_delete" value="<?php echo $url_ajax_delete ?>"> -->
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
					                  <option value="0">-- Pilih Departement/Bagian --</option>
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
				            <div class="row form-row">
				              	<label class="control-label col-md-3">Jabatan</label>
				              	<div class="col-md-9">
					              	<input type="text" class="form-control" value="<?=get_position_name($mapping_kpi['position_group_id'])?>" readonly>
					                <input type="hidden" id="org_id" name="org_id" value="<?=$org_id?>">
					            </div>
				            </div>
				            <!-- <div class="row form-row">
				              	<label class="control-label col-md-3">Nama</label>
				              	<div class="col-md-9">
					              	<?php //$count = count($users);?>
					                <select id="user_id" class="select2" style="width:100%" name="user_id">
					                	<?php //foreach ($users as $key => $value) { ?>
					                		<option value="<?php //echo get_id($value['EMPLID'])?>" ><?php //echo $value['NAME']?></option>
					                	<?php //} ?>
					                </select>
				              	</div>
				            </div> -->

				            <div class="row form-row">
				            	<div class="col-md-12">
					              	<table class="table table-bordered">
					              		<thead>
					              			<tr>
					              				<th>Area Kinerja Utama</th>		
												<th>Key Performance Indicator</th>		
												<th>Target</th>		
												<th>Sumber Info</th>		
					              			</tr>
										</thead>
										<tbody>
											<tr>
												<td><?php echo $mapping_kpi['area_kinerja_utama']?></td>
												<td><?php echo $mapping_kpi['kpi']?></td>
												<td><?php echo $mapping_kpi['target_kpi']?> %</td>
												<td><?php echo $mapping_kpi['sumber_info']?></td>
											</tr>
										</tbody>
					              	</table>
				           		</div>
				            </div>

				            <div class="row form-row">
				            	<div class="col-md-12">
				            		<table class="table table-bordered">
				            			<thead>
				            				<tr>
				            					<th>NAMA</th>
				            				</tr>
				            			</thead>
				            			<tbody>
				            				<?php foreach ($users as $key => $value) { ?>
					            				<?php if($this->ion_auth->is_admin()) { ?>
						            				<?php $kpi_detail = $kpi_detail = getAll('competency_form_kpi_detail',array('competency_mapping_kpi_detail_id'=>'where/'.$competency_mapping_kpi_detail_id,'is_deleted'=>'where/0','comp_session_id'=>'where/'.$comp_session_id,'organization_id'=>'where/'.$org_id,'user_id'=>'where/'.get_id($value['EMPLID'])));
													if($kpi_detail->num_rows() > 0)
													{
														$val_kpi_detail = $kpi_detail->row_array();
														$url_red = 'competency/form_kpi/edit_detail/'.$org_id.'/'.$comp_session_id.'/'.$competency_mapping_kpi_detail_id.'/'.$val_kpi_detail['id'].'/'.get_id($value['EMPLID']);
													}else
													{
														$url_red = 'competency/form_kpi/input_detail/'.$org_id.'/'.$comp_session_id.'/'.$competency_mapping_kpi_detail_id.'/'.get_id($value['EMPLID']);
													}?>
						            				<tr>
						            					<td><a href="<?php echo site_url($url_red)?>"><?php echo $value['NAME']?></a></td>
						            				</tr>
					            				<?php }elseif(get_id($value['EMPLID']) == $this->session->userdata('user_id')){ ?>
					            					<?php $kpi_detail = $kpi_detail = getAll('competency_form_kpi_detail',array('competency_mapping_kpi_detail_id'=>'where/'.$competency_mapping_kpi_detail_id,'is_deleted'=>'where/0','comp_session_id'=>'where/'.$comp_session_id,'organization_id'=>'where/'.$org_id,'user_id'=>'where/'.get_id($value['EMPLID'])));
													if($kpi_detail->num_rows() > 0)
													{
														$val_kpi_detail = $kpi_detail->row_array();
														$url_red = 'competency/form_kpi/edit_detail/'.$org_id.'/'.$comp_session_id.'/'.$competency_mapping_kpi_detail_id.'/'.$val_kpi_detail['id'].'/'.get_id($value['EMPLID']);
													}else
													{
														$url_red = 'competency/form_kpi/input_detail/'.$org_id.'/'.$comp_session_id.'/'.$competency_mapping_kpi_detail_id.'/'.get_id($value['EMPLID']);
													}?>
						            				<tr>
						            					<td><a href="<?php echo site_url($url_red)?>"><?php echo $value['NAME']?></a></td>
						            				</tr>
				            					<?php }else{ ?>
				            					<?php } ?>
				            				<?php } ?>
				            			</tbody>
				            		</table>
				            	</div>
				            </div>

<!-- 				            <div class="row form-row">
				              	<table class="table table-bordered">
				              		<thead>
				              			<tr>
				              				<th>Area Kinerja Utama</th>		
											<th>Key Performance Indicator</th>		
											<th>Target</th>		
											<th>Sumber Info</th>		
				              			</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo $mapping_kpi['area_kinerja_utama']?></td>
											<td><?php echo $mapping_kpi['kpi']?></td>
											<td><?php echo $mapping_kpi['target_kpi']?> %</td>
											<td><?php echo $mapping_kpi['sumber_info']?></td>
										</tr>
									</tbody>
				              	</table>
				            </div>

				            <div class="row form-row">
				              	<table class="table table-bordered">
				              		<thead>
				              			<tr>
				              				<th>Bulan</th>		
											<th>Sasaran KPI</th>		
											<th>Real KPI</th>		
											<th>Pencapaian</th>		
				              			</tr>
									</thead>
									<tbody>
										<tr>
											<td>Januari</td>
											<td><?php echo $mapping_kpi['target_kpi']?> %</td>
											<td><input type="text" id="jan" name="jan"></td>
											<td><input type="text" id="pencapaian_jan" name="pencapaian_jan"></td>
										</tr>
										<tr>
											<td>Februari</td>
											<td><?php echo $mapping_kpi['target_kpi']?> %</td>
											<td><input type="text" id="feb" name="feb"></td>
											<td><input type="text" id="pencapaian_feb" name="pencapaian_feb"></td>
										</tr>
										<tr>
											<td>Maret</td>
											<td><?php echo $mapping_kpi['target_kpi']?> %</td>
											<td><input type="text" id="mar" name="mar"></td>
											<td><input type="text" id="pencapaian_mar" name="pencapaian_mar"></td>
										</tr>
										<tr>
											<td>April</td>
											<td><?php echo $mapping_kpi['target_kpi']?> %</td>
											<td><input type="text" id="apr" name="apr"></td>
											<td><input type="text" id="pencapaian_apr" name="pencapaian_apr"></td>
										</tr>
										<tr>
											<td>Mei</td>
											<td><?php echo $mapping_kpi['target_kpi']?> %</td>
											<td><input type="text" id="may" name="may"></td>
											<td><input type="text" id="pencapaian_may" name="pencapaian_may"></td>
										</tr>
										<tr>
											<td>Juni</td>
											<td><?php echo $mapping_kpi['target_kpi']?> %</td>
											<td><input type="text" id="jun" name="jun"></td>
											<td><input type="text" id="pencapaian_jun" name="pencapaian_jun"></td>
										</tr>
										<tr>
											<td>Juli</td>
											<td><?php echo $mapping_kpi['target_kpi']?> %</td>
											<td><input type="text" id="jul" name="jul"></td>
											<td><input type="text" id="pencapaian_jul" name="pencapaian_jul"></td>
										</tr>
										<tr>
											<td>Agustus</td>
											<td><?php echo $mapping_kpi['target_kpi']?> %</td>
											<td><input type="text" id="aug" name="aug"></td>
											<td><input type="text" id="pencapaian_aug" name="pencapaian_aug"></td>
										</tr>
										<tr>
											<td>September</td>
											<td><?php echo $mapping_kpi['target_kpi']?> %</td>
											<td><input type="text" id="sept" name="sept"></td>
											<td><input type="text" id="pencapaian_sept" name="pencapaian_sept"></td>
										</tr>
										<tr>
											<td>Oktober</td>
											<td><?php echo $mapping_kpi['target_kpi']?> %</td>
											<td><input type="text" id="oct" name="oct"></td>
											<td><input type="text" id="pencapaian_oct" name="pencapaian_oct"></td>
										</tr>
										<tr>
											<td>November</td>
											<td><?php echo $mapping_kpi['target_kpi']?> %</td>
											<td><input type="text" id="nov" name="nov"></td>
											<td><input type="text" id="pencapaian_nov" name="pencapaian_nov"></td>
										</tr>
										<tr>
											<td>Desember</td>
											<td><?php echo $mapping_kpi['target_kpi']?> %</td>
											<td><input type="text" id="dece" name="dece"></td>
											<td><input type="text" id="pencapaian_dece" name="pencapaian_dece"></td>
										</tr>
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
				            
			            	<div id="submit" class="form-actions">
			                 	<div class="pull-right">
			                 		<input type="hidden" id="kpi" name="kpi" value="<?=$mapping_kpi['kpi']?>">
			                 		<input type="hidden" id="target_kpi" name="target_kpi" value="<?=$mapping_kpi['target_kpi']?>">
			                 		<input type="hidden" id="competency_mapping_kpi_detail_id" name="competency_mapping_kpi_detail_id" value="<?=$competency_mapping_kpi_detail_id?>">
			                 		<button class="btn btn-success btn-cons" type="submit"><i class="icon-ok"></i> <?php echo lang('save_button') ?></button>
			                    	<a href="<?php echo site_url($controller) ?>"><button class="btn btn-info btn-cons" type="button"><?php echo lang('cancel_button') ?></button></a>
			                  	</div>
			                </div>-->
			              	<?php echo form_close(); ?>
			            </div> 
		          	</div>
		        </div>
	      	</div>
	    </div>
  	</div>
</div>
