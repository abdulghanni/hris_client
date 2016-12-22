<div class="row">
	<div class="col-md-12">

		<?php 
			if($data->num_rows>0){?>
			<table class="table table-bordered">
				<thead>
					
				</thead>
				<tbody id="compentency-kpi">
					<?php foreach($users as $user) { ?>
					
						<tr>
							<!-- <td><?php //echo $user['EMPLID'].' - '.$user['NAME'].' ['.get_pos_id($user['EMPLID'])['POSITION'].']'?></td> -->
							<td>
								<?php echo '<h4>'.$user['EMPLID'].' - '.$user['NAME'].' ['.get_pos_id($user['EMPLID'])['POSITION'].'] '.'</h4>'?>
								<?php $qkpi_detail = $this->main->get_kpi_detail_by_userid(get_id($user['EMPLID'])); ?>
								
								<?php if($qkpi_detail->num_rows() > 0) { ?>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>KPI</th>
											<th>target</th>
											<th>Jan</th>
											<th>Feb</th>
											<th>Mar</th>
											<th>Apr</th>
											<th>May</th>
											<th>Jun</th>
											<th>Jul</th>
											<th>Aug</th>
											<th>Sept</th>
											<th>Oct</th>
											<th>Nov</th>
											<th>Dec</th>
											<th>Rata-rata</th>
											<th>Keterangan</th>
										</tr>
									</thead>
									<tbody>
										<?php $kpi_detail = $qkpi_detail->result_array();?>
										<?php foreach ($kpi_detail as $key => $value) { ?>	
											<tr>
												<td><?php echo $value['kpi']?></td>
												<td><?php echo $value['target_kpi']?></td>
												<td><?php echo $value['jan']?></td>
												<td><?php echo $value['feb']?></td>
												<td><?php echo $value['mar']?></td>
												<td><?php echo $value['apr']?></td>
												<td><?php echo $value['may']?></td>
												<td><?php echo $value['jun']?></td>
												<td><?php echo $value['jul']?></td>
												<td><?php echo $value['aug']?></td>
												<td><?php echo $value['sept']?></td>
												<td><?php echo $value['oct']?></td>
												<td><?php echo $value['nov']?></td>
												<td><?php echo $value['dece']?></td>
												<td><?php echo $value['rata_rata']?></td>
												<td><?php echo $value['keterangan']?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
								<?php }else{ ?>
									<thead>
										<!-- <tr>
											<th>KPI</th>
											<th>target</th>
											<th>Jan</th>
											<th>Feb</th>
											<th>Mar</th>
											<th>Apr</th>
											<th>May</th>
											<th>Jun</th>
											<th>Jul</th>
											<th>Aug</th>
											<th>Sept</th>
											<th>Oct</th>
											<th>Nov</th>
											<th>Dec</th>
											<th>Rata-rata</th>
											<th>Keterangan</th>
										</tr> -->
									</thead>
									<tbody>
									</tbody>
								<?php } ?>
							</td>
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
	                          <span class="semi-bold"><?=($data->row()->created_by != 1) ? get_user_position($data->row()->created_by) : '';?></span>
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
				<h3 class="label label-warning">Form Penilaian KPI Untuk Departemen <?= get_organization_name($org_id)?> Belum Tersedia</h3>
				<br/>
				<br/>
				<a href="<?=base_url($ci->controller.'/input/'.$org_id.'/'.$comp_session_id)?>"><button class="btn btn-primary"><i class="icon-plus"></i> Buat Mapping baru</button></a>
		<?php
			}
		?>
	</div>
</div>