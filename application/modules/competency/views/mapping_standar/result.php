<div class="row">
	<div class="col-md-12" style="overflow-x: auto; overflow-y: hidden ">
		<?php 
			if($data->num_rows>0){
			if (is_admin_kompetensi()&&$this->ion_auth->is_admin()){
		?>
			<div class="row col-md-12">
				<a href="<?=base_url($ci->controller.'/input/'.$org_id)?>"><button class="btn btn-primary"><i class="icon-pencil"></i> Ubah Mapping</button></a>
			</div>
			<?php } ?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width="5%">
							No.
						</th>
						<th width="25%">Kompetensi</th>
						<th width="70%" colspan="<?=$pg_size?>" class="text-center">Level Jabatan</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;foreach($competency_group as $cg){
						$kompetensi = getAll('competency_def', array('comp_group_id'=>'where/'.$cg->id), array('id'=>$comp_def));
					?>
						<tr>
							<th colspan="2" width="30%"><?= $cg->title ?></th>
							<?php foreach ($pos_group as $key => $value) {
								echo '<th style="text-center" width="'.$col.'%">'.$value.'</th>';
								echo '<input type="hidden" name="position_group[]" value="'.$value.'">';
							}?>
						</tr>
						<?php $i = 1;foreach($kompetensi->result() as $k){
						?>
						<tr>
							<td width="5%">
								<?=$i++?>
							</td>
							<td class="text-left" width="25%"><?=$k->title?></td>
							<?php foreach ($pos_group as $key => $value) {
									$f = array('organization_id'=>'where/'.$org_id, 'competency_def_id'=>'where/'.$k->id, 'position_group_id'=>'where/'.$value);
								?>
								<td width="<?=$col?>%" class="text-center">
									<?=getValue('level', $ci->table.'_detail', $f)?>
								</td>
							<?php }?>
						</tr>
						<?php } ?>
						
					<?php } ?>
					<tr>
						<td colspan="2" class="text-center"><strong>TOTAL</strong></td>
						<?php foreach ($pos_group as $key => $value) {
									$f = array('organization_id'=>'where/'.$org_id, 'position_group_id'=>'where/'.$value);
								?>
								<td width="<?=$col?>%" class="text-center">
									<?=getValue('sum(level)', $ci->table.'_detail', $f)?>
								</td>
							<?php }?>
					</tr>
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
				<h3 class="label label-warning">Mapping Indikator Untuk Departemen <?= get_organization_name($org_id)?> Belum Tersedia</h3>
				<br/>
				<br/>
				<a href="<?=base_url($ci->controller.'/input/'.$org_id)?>"><button class="btn btn-primary"><i class="icon-plus"></i> Buat Mapping baru</button></a>
		<?php
			}
		?>
	</div>
</div>