<div class="row">
	<div class="col-md-12">
		<?php 
			if($data->num_rows>0){?>
			<div class="row col-md-12">
				<a href="<?=base_url($ci->controller.'/input/'.$org_id)?>"><button class="btn btn-primary"><i class="icon-pencil"></i> Ubah Mapping</button></a>
			</div>
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
						<!-- <th width="12.5%">Aksi</th> -->
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
							<!-- <td width="12.5%">
								<a class="btn btn-sm btn-primary btn-mini" href="javascript:void()" title="Edit" onclick="edit_(<?php echo $value['id']?>)"><i class="icon-edit"></i> Edit</a>
								<a class="btn btn-sm btn-danger btn-mini" href="javascript:void()" title="Hapus" onclick="delete_(<?php echo $value['id']?>,'<?php echo $org_id?>')"><i class="icon-remove"></i> Delete</a>'
							</th> -->
						</tr>
					<?php } ?>
				</tbody>
			</table>

			<div class="form-actions">
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
            </div>
		<?php
			}else{
		?>
				<h3 class="label label-warning">Mapping KPI Untuk Departemen <?= get_organization_name($org_id)?> Belum Tersedia</h3>
				<br/>
				<br/>
				<a href="<?=base_url($ci->controller.'/input/'.$org_id)?>"><button class="btn btn-primary"><i class="icon-plus"></i> Buat Mapping baru</button></a>
		<?php
			}
		?>
	</div>
</div>