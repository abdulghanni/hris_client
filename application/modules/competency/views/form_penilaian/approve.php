<input type="hidden" id="controller" value="<?=$controller?>">
<input type="hidden" id="org_id" name="org_id" value="<?=$id?>">
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
	        <h3>Kompetensi - <a href="<?=base_url($controller)?>">Human Value Matrix - Detail</a></h3> 
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
				            <div class="row">
					            <div class="col-md-8">
					            	<div class="row form-row">
						            	<div class="col-md-3">
					                        <label class="form-label text-right">Periode</label>
					                    </div>
					                    <div class="col-md-9">
							            	<input name="" id="" type="text"  class="form-control" placeholder="-" value="<?=get_year_session($form->comp_session_id)?>" disabled="disabled">
							            	<input type="hidden" value="<?=$form->comp_session_id?>" id="comp_session_id">
					                    </div>
					                </div>
					            	<div class="row form-row">
						            	<div class="col-md-3">
					                        <label class="form-label text-right">Karyawan Yang Dinilai</label>
					                    </div>
					                    <div class="col-md-9">
							            	<input name="" id="" type="text"  class="form-control" placeholder="-" value="<?=get_name($form->nik)?>" disabled="disabled">
							            	<input type="hidden" value="<?=$form->nik?>" id="emp">
					                    </div>
					                </div>
					            	<div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('start_working') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="seniority_date" id="seniority_date" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('dept_div') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="organization" id="organization" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('position') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="position" id="position" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                      </div>
				                    </div>
					            </div>
					        </div>
				            <div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="5%" rowspan="2" valign="center">
													<!-- <div class="checkbox check-default">
								                      <input id="checkbox" type="checkbox" value="0"> 
								                      <label for="checkbox"></label>
								                    </div> -->
								                    No.
												</th>
												<th width="25%">Kompetensi</th>
												<th width="25%" class="text-center">Kemampuan</th>
												<th width="25%" class="text-center">Kemauan</th>
											</tr>
											<!-- <tr>
												<th class="text-center">Kurang</th>
												<th class="text-center">Mampu</th>
												<th class="text-center">Kurang</th>
												<th class="text-center">Mampu</th>
											</tr> -->
										</thead>
										<tbody>
											<?php $i = 1;foreach ($detail->result() as $r) { ?>
												<tr>
													<td><?=$i++?></td>
													<td>
														<?=getValue('title', 'competency_def', array('id'=>'where/'.$r->competency_penilaian_id))?>
														<input type="hidden" name="competency_penilaian_id[<?=$r->id?>]" value="<?=$r->id?>">
													</td>
													<td class="text-center">
														<?=($r->kemampuan == 1) ? "Mampu" : "Kurang";?>
													</td>
													
													<td class="text-center">
														<?=($r->kemauan == 1) ? "Mau" : "Kurang";?>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>

								<div class="col-md-12">
									<h4>Kuadran :</h4>
										<div class="radio radio-success">
											<?php $qkuadran = getAll('competency_kuadran',array('id'=>'where/'.$form->kuadran_id));?>
											<?php if($qkuadran->num_rows() > 0) { $val = $qkuadran->row_array() ?>
					                        <input id="kuad" name="kuadran_id" value="" type="radio" checked="checked">
					                        <label for="kuad"><?=$val['id'].'. '.$val['title']?></label>
					                        <?php } else {}?>
					                    </div>
								</div>

								<div class="col-md-12">
									<h4>Rekomendasi :</h4>
										<div class="radio radio-success">
											<?php $qrekomendasi = getAll('competency_rekomendasi',array('id'=>'where/'.$form->rekomendasi_id));?>
											<?php if($qrekomendasi->num_rows() > 0) { $val = $qrekomendasi->row_array(); ?>
											<?php if($val['id'] == 1) { 
										$label_rek = 'A';
									}elseif($val['id'] == 2) {
										$label_rek = 'B';
									}elseif($val['id'] == 3) {
										$label_rek = 'C';
									}else{
										$label_rek = 'D';
									} ?>
					                        <input id="rek" name="rekomendasi_id" value="" type="radio" checked="checked">
					                        <label for="rek"><?=$val['id'].'. '.$val['title']?></label>
					                        <?php } else {}?>
					                        <!-- <input id="rek" name="rekomendasi_id" value="" type="radio" checked="checked">
					                        <label for="rek"><?=getValue('title', 'competency_rekomendasi', array('id'=>'where/'.$form->rekomendasi_id))?></label> -->
					                    </div>
								</div>
				            </div>
			              	<?php echo form_close(); ?>
			            </div>
		          	</div>
		        </div>
	      	</div>
	    </div>
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
                          <span class="semi-bold"><?php echo get_name($form->created_by)?></span><br/>
                          <span class="small"><?php echo dateIndo($form->created_on)?></span><br/>
                          <span class="semi-bold"><?=get_user_position($form->created_by)?></span>
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

