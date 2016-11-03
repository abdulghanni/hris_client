<input type="hidden" id="controller" value="<?=$ci->controller?>">
<input type="hidden" id="org_id" name="org_id" value="<?=$org_id?>">
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
	        <h3>Kompetensi - <a href="<?=base_url($ci->controller)?>"><?=$ci->title?> - Detail</a></h3> 
	    </div>
	    <div class="row">
	     	<div class="col-md-12">
		        <div class="grid simple">
		          	<div class="grid-body no-border">
		            <br/>
			            <div class="row-fluid">
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
									<?php 
										if($data->num_rows>0){?>
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
							                    	<div class="col-md-3" id="<?=$a->user_id?>">
							                      		<p class="wf-approve-sp">
							                      		<?php 
							                      			if($a->user_id == sessId() && $a->is_app == 0){ ?>
							                      				<div class="btn btn-success btn-cons" id="" type="button" data-toggle="modal" data-target="#submitModal<?=sessId()?>" style="margin-top: -15px;"><i class="icon-ok"></i>Submit</div><br/>
							                      				<span class="semi-bold"><?php echo get_name($a->user_id)?></span><br/>
								                          		<span class="small"><?php echo dateIndo($a->date_app)?></span><br/>
								                          		<span class="semi-bold"><?=get_user_position(get_nik($a->user_id))?></span>
							                      			<?php }else{ 
							                      				echo ($a->app_status_id == 1)?"<img class=approval-img src=$approved>": (($a->app_status_id == 2) ? "<img class=approval-img src=$rejected>"  : (($a->app_status_id == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));
							                      			?>
							                          	  <span class="small"></span><br/>
								                          <span class="semi-bold"><?php echo get_name($a->user_id)?></span><br/>
								                          <span class="small"><?php echo dateIndo($a->date_app)?></span><br/>
								                          <span class="semi-bold"><?=get_user_position(get_nik($a->user_id))?></span>
								                          <?php } ?>
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
			            </div>
		          	</div>
		        </div>
	      	</div>
	    </div>
  	</div>
</div>

<!--approval Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="submitModal<?=sessId()?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formApp<?=sessId()?>">
        	<div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      // $checked = ($app->id <> 0 && $app->id == $user->approval_status_id_lv2) ? 'checked = "checked"' : '';
                      $checked = '';
                      $checked2 = ($app->id == 1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv2<?php echo $app->id?>" type="radio" name="app_status_id" value="<?php echo $app->id?>" <?php echo (!empty($checked))?$checked:$checked2;?>>
                  <label for="app_status_lv2<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="app_status_lv2" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note" class="custom-txtarea-form" placeholder="Note isi disini...."></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="btnApp<?=sessId()?>" onclick="approve(<?=sessId()?>)" type="button" class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal Lv2--> 
