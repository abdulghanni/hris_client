<div class="row">
	<div class="col-md-12">
		<?php 
			if($data->num_rows>0){?>
			<table class="table table-bordered">
				<thead>
					<?php foreach($users as $user) { ?>
						<tr>
							<th><?php echo $user?></th>
						</tr>
					<?php } ?>
				</thead>
				<tbody id="compentency-kpi">
					
							
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
				<h3 class="label label-warning">Form Penilaian KPI Untuk Departemen <?= get_organization_name($org_id)?> Belum Tersedia</h3>
				<br/>
				<br/>
				<a href="<?=base_url($ci->controller.'/input/'.$org_id.'/'.$comp_session_id)?>"><button class="btn btn-primary"><i class="icon-plus"></i> Buat Mapping baru</button></a>
		<?php
			}
		?>
	</div>
</div>