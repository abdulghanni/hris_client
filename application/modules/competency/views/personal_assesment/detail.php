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
	        <a href="<?=base_url($controller)?>"><i class="icon-custom-left"></i></a>
	        <h3>Kompetensi - <a href="<?=base_url($controller)?>"><?=$title?> - Detail</a></h3> 
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
					                        <label class="form-label text-right">Nama</label>
					                    </div>
					                    <div class="col-md-9">
							            	<input name="" id="" type="text"  class="form-control" placeholder="-" value="<?=get_name($form->nik)?>" disabled="disabled">
							            	<input type="hidden" value="<?=$form->nik?>" id="emp">
					                    </div>
					                </div>
					            <!-- 	<div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('start_working') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="seniority_date" id="seniority_date" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                      </div>
				                    </div> -->
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
				                        <label class="form-label text-right">Position Group</label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="position" id="position-group" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
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
									<div class="table-responsive">
										<table class="table table-bordered" width="100%">
											<thead>
												<tr>
													<td width="5%" rowspan="2">
														<div class="checkbox check-default">
										                  <input id="checkbox" type="checkbox" value="0"> 
										                  <label for="checkbox"></label>
										                </div>
													</td>
													<td width="20%" rowspan="2">Kompetensi</td>
													<td width="5%" rowspan="2" class="text-center">Standar Komp. (SK)</td>
													<td width="5%" rowspan="2" class="text-center">Aktual Komp. (AK)</td>
													<td width="5%" rowspan="2" class="text-center">Score GAP (AK-SK)</td>
													<td width="60%" colspan="4" class="text-center">Program Improvement</td>
												</tr>
												<tr>
													<td width="15%" class="text-center">Tindakan</td>
													<td width="15%" class="text-center">Tanggal Pelaksanaan</td>
													<td width="15%" class="text-center">PIC</td>
													<td width="15%" class="text-center">Hasil</td>
												</tr>
											</thead>
											<tbody>
													<?php $j = 1;foreach($detail as $d){?>
													<tr>
														<td width="5%" class="text-center">
															<?=$j++?>
														</td>
														<td class="text-left" width="25%">
															<?=getValue('title', 'competency_def', array('id'=>'where/'.$d->competency_def_id))?>		
														</td>
														<td class="text-center">
															<?=$d->sk?>	
														</td>
														<td class="text-center">
															<?=$d->ak?>	
														</td>
														<td class="text-center">
															<?=$d->gap?>	
														</td>
														<td>
															<?=getValue('title', 'competency_tindakan', array('id'=>'where/'.$d->competency_tindakan_id))?>	
														</td>
														<td><?=dateIndo($d->tgl)?></td>
														<td><?=$d->pic?>	</td>
														<td><?=$d->hasil?>	</td>
													</tr>
													<?php } ?>
											</tbody>
										</table>
									<div>
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

