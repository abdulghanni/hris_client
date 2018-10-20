<div class="row">
	<div class="col-md-12">
		<?php 
			if($data->num_rows>0){?>
			<!-- <div class="row col-md-12">
				<a href="<?=base_url($ci->controller.'/input/'.$org_id.'/'.$comp_session_id)?>"><button class="btn btn-primary"><i class="icon-pencil"></i> Ubah Mapping</button></a>
			</div> -->
			<table class="table table-bordered">
										<thead>
											
										</thead>
										<tbody id="compentency-kpi">
											<?php foreach ($pos as $pos) { ?>
											<?php  if($this->ion_auth->is_admin()){ ?>
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
																		<td >
																			<?php 
																			$kpi_detail = $kpi_detail = getAll('competency_form_kpi_detail',array('competency_mapping_kpi_detail_id'=>'where/'.$kpi["id"],'is_deleted'=>'where/0','comp_session_id'=>'where/'.$comp_session_id,'organization_id'=>'where/'.$org_id));
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
											<?php }elseif($position==$pos['DESCRIPTION']){ ?>
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
																		<td >
																			<?php 
																			$kpi_detail = $kpi_detail = getAll('competency_form_kpi_detail',array('competency_mapping_kpi_detail_id'=>'where/'.$kpi["id"],'is_deleted'=>'where/0','comp_session_id'=>'where/'.$comp_session_id,'organization_id'=>'where/'.$org_id));
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


											<?php } }	?>
													
										</tbody>
									</table>

			<!-- <div class="form-actions">
            	<div class="col-md-12 text-center">
            		<div class="row">
            			<div class="col-md-3 text-center"><span class="semi-bold">Dibuat Oleh,</span><br/><br/><br/></div>
            			<div class="col-md-9 text-center"><span class="semi-bold">Mengetahui,</span><br/><br/><br/></div>
            		</div>
                  	<div class="row wf-cuti">
                    	<div class="col-md-3" id="lv1">
                      		<p class="wf-approve-sp">
                          	<span class="small"></span><br/>
	                          <span class="semi-bold"><?php echo get_name($data->row()->created_by)?></span><br/>
	                          <span class="small"><?php echo dateIndo($data->row()->created_on)?></span><br/>
	                          <span class="semi-bold"><?=get_user_position($data->row()->created_by)?></span>
                      		</p>
                    	</div>
                    	<?php 
                    		if($approver->num_rows()>0){
                    			foreach($approver->result() as $a):
                    	?>
                    	<div class="col-md-3" id="lv1">
                      		<p class="wf-approve-sp">
                          	<span class="small"></span><br/>
	                          <span class="semi-bold"><?php echo get_name($a->user_id)?></span><br/>
	                          <span class="small"><?php echo dateIndo($a->date_app)?></span><br/>
	                          <span class="semi-bold"><?=get_user_position(get_nik($a->user_id))?></span>
                      		</p>
                    	</div>
                    	<?php endforeach;}?>
                  	</div>
                </div> 
            </div> -->
		<?php
			}else{
		?>
				<h3 class="label label-warning">Form Penilaian KPI Untuk Departemen <?= get_organization_name($org_id)?> Belum Tersedia</h3>
				<br/>
				<br/>
				<a href="<?=base_url($ci->controller.'/input/'.$org_id.'/'.$comp_session_id)?>"><button class="btn btn-primary"><i class="icon-plus"></i> Buat Mapping baru</button></a>
		<?php
			}
		?>
	</div>
</div>