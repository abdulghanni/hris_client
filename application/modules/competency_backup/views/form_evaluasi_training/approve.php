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
							<!-- <input type="hidden" id="form" value="form_penilaian"> -->
					   		<div class="row">
					            <div class="col-md-6">
					            <div class="row form-row">
						            	<div class="col-md-3">
					                        <label class="form-label text-right">Kode Surat</label>
					                    </div>
					                    <div class="col-md-9">
							            	<input name="" id="" type="text"  class="form-control" placeholder="-" value="<?php echo $kode_surat ?>" disabled="disabled">
					                    </div>
					                </div>
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
					                        <label class="form-label text-right">Nama</label>
					                    </div>
					                    <div class="col-md-9">
							            	<input type="text" class="form-control" value="<?=get_name($form->nik)?>" readonly="readonly">
					                    </div>
					                </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('dept_div') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="" id="" type="text"  class="form-control" value="<?=get_organization_name($form->organization_id)?>" disabled="disabled">
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('position') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="" id="" type="text"  class="form-control" value="<?=get_position_name($form->position_id)?>" disabled="disabled">
				                      </div>
				                    </div>
					            </div>

					            <div class="col-md-6">
					        		<div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right">Nama Training</label>
				                      </div>
				                      <div class="col-md-9">
				                      <input name="training_notif_id" id="training_notif_id" type="hidden"  class="form-control" placeholder="-" value="<?=$form->training_notif_id?>" readonly>
				                        <input name="nama_training" id="nama_training" type="text"  class="form-control" placeholder="-" value="<?=$form->training_title?>" readonly>
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right">Tanggal Training</label>
				                      </div>
				                      <div class="col-md-9">
				                        <div id="datepicker_start" class="input-append date success no-padding">
				                          <input type="text" class="form-control" name="tgl_training" value="<?=dateIndo($form->date_start)?>" readonly>
				                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
				                        </div>
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right">Selesai Training</label>
				                      </div>
				                      <div class="col-md-9">
				                        <div id="datepicker_start" class="input-append success no-padding">
				                          <input type="text" class="form-control" name="tgl_selesai" value="<?=date('d M Y',strtotime($form->date_end))?>" required readonly>
				                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
				                        </div>
				                      </div>
				                    </div>
					        	</div>
					        </div>
					        <hr/>

					        <div class="row">
					        	<div class="col-md-12">
				                    <div class="row form-row">
				                      	<div class="col-md-12">
				                        	<h4 class="">Sasaran Training :</h4>
				                      	</div>
				                      	<div class="col-md-12">
					                        <textarea name="sasaran" class="form-control" placeholder="isi sasaran training disini....." readonly="readonly"><?=$form->sasaran?></textarea>
					                   	</div>
				                    </div>
					        	</div>
					        </div>
					        <hr/>

					        <div class="row">
					        	<div class="col-md-12">
				                    <div class="row form-row">
				                      	<div class="col-md-12">
				                        	<h4 class="">Evaluasi Training :</h4>
				                      	</div>
					               		<div class="col-md-12">
				                      		<input type="text" class="form-control" name="" value="<?=getValue('title', 'competency_evaluasi_training', array('id'=>'where/'.$form->competency_evaluasi_training_id))?>" readonly>
					               		</div>
					               		<?php if($form->competency_evaluasi_training_id == 5 && !empty($form->competency_evaluasi_training_lain)){?>
					               		<div class="col-md-12">
					                    	<input type="text" class="form-control" id="competency_evaluasi_training_lain" name="competency_evaluasi_training_lain" placeholder="Isi Evaluasi Training Lainnya Disini ....." value="<?=$form->competency_evaluasi_training_id?>">
					                   	</div>
					                   	<?php } ?>
				                    </div>
					        	</div>
					        </div>
					        <hr/>

					        <div class="row">
					        	<div class="col-md-12">
				                    <div class="row form-row">
				                    	<div class="col-md-12">
				                        	<h4 class="">Metode Evaluasi :</h4>
				                      	</div>
				                      	<?php foreach($competency_metode as $key=>$v){?>
					                      	<div class="col-md-12">
				                      		<input type="text" class="form-control" name="" value="<?=getValue('title','competency_metode_evaluasi', array('id'=>'where/'.$v));?>" readonly>
					               		</div>
						                <?php } ?>
				                    </div>
					        	</div>
					        </div>
					        <hr/>

					        <!-- POINT EVALUASI -->
					        <div class="row">
					        	<div class="col-md-12">
					        		<div class="row form-row">
				                    	<div class="col-md-12">
				                        	<h4 class="">Point Evaluasi :</h4>
				                      	</div>
				                      	<div class="row col-md-12">
				                      		<div class="col-md-1">
				                      			Nilai:
				                      		</div>
				                      		<div class="col-md-2">
				                      			1 = Sangat Kurang
				                      		</div>
				                      		<div class="col-md-2">
				                      			2 = Kurang
				                      		</div>
				                      		<div class="col-md-2">
				                      			3 = Cukup
				                      		</div>
				                      		<div class="col-md-2">
				                      			4 = Baik
				                      		</div>
				                      		<div class="col-md-2">
				                      			5 = Sangat Baik
				                      		</div>
				                      	</div>
				                      	<div class="row">
								        	<div class="col-md-12">
								        		<table class="table table-bordered">
													<thead>
														<tr>
															<th width="5%">
											                    No.
															</th>
															<th width="75%">Pengetahuan</th>
															<th width="10%" class="text-center">Sebelum Training</th>
															<th width="10%" class="text-center">Sesudah Training</th>
														</tr>
													</thead>
													<tbody>
														<?php $i = 1;foreach ($competency_pengetahuan as $p) { ?>
															<tr>
																<td><?=$i++?></td>
																<td>
																	<?=getValue('title', 'competency_pengetahuan', array('id'=>'where/'.$p->competency_pengetahuan_id))?>
																</td>
																<td class="text-center">
																	<?=$p->point_sebelum?>
																</td>
																<td class="text-center">
																	<?=$p->point_sesudah?>
																	</select>
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>

												<table class="table table-bordered">
													<thead>
														<tr>
															<th width="5%">
											                    No.
															</th>
															<th width="75%">Sikap</th>
															<th class="text-center" width="10%">Sebelum Training</th>
															<th class="text-center" width="10%">Sesudah Training</th>
														</tr>
													</thead>
													<tbody>
														<?php $i = 1;foreach ($competency_sikap as $p) { ?>
															<tr>
																<td><?=$i++?></td>
																<td>
																	<?=getValue('title', 'competency_sikap', array('id'=>'where/'.$p->competency_sikap_id))?>
																</td>
																<td class="text-center">
																	<?=$p->point_sebelum?>
																</td>
																<td class="text-center">
																	<?=$p->point_sesudah?>
																	</select>
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>

												<table class="table table-bordered" id="tbl_keterampilan">
													<thead>
														<tr>
															<th width="5%">
											                    No.
															</th>
															<th width="75%">Keterampilan</th>
															<th class="text-center" width="10%">Sebelum Training</th>
															<th class="text-center" width="10%">Sesudah Training</th>
														</tr>
													</thead>
													<tbody>
														<?php $i = 1;foreach ($competency_keterampilan as $p) { ?>
															<tr>
																<td><?=$i++?></td>
																<td>
																	<?=$p->title?>
																</td>
																<td class="text-center">
																	<?=$p->point_sebelum?>
																</td>
																<td class="text-center">
																	<?=$p->point_sesudah?>
																	</select>
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>

									        	<br/>
									        	<br/>

												<table class="table table-bordered">
													<thead>
														<tr>
															<th width="80%">Hasil / Output Pekerjaan</th>
															<th class="text-center" width="10%">Sebelum Training</th>
															<th class="text-center" width="10%">Sesudah Training</th>
														</tr>
													</thead>
													<tbody>
														<?php $i = 1;foreach ($competency_output as $p) { ?>
															<tr>
																<td>
																	<?=$p->title?>
																</td>
																<td class="text-center">
																	<?=$p->point_sebelum?>
																</td>
																<td class="text-center">
																	<?=$p->point_sesudah?>
																	</select>
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>
							                </div>
							            </div>
				                    </div>
					        	</div>
					        </div>
					        <!-- //POINT EVALUASI -->

					        <div class="row">
					        	<div class="col-md-12">
				                    <div class="row form-row">
				                      	<div class="col-md-8">
				                        	<h4 class="">Tindak Lanjut dari Evaluasi :</h4>
				                      	</div>

					                   	<div class="col-md-4">
				                        	<h4 class="">Realisasi Tanggal :</h4>
				                      	</div>
				                      	<div class="col-md-8">
					                        <textarea name="tindak_lanjut" class="form-control" placeholder="isi tindak lanjut dari evaluasi disini....." readonly="readonly"><?=$form->tindak_lanjut?></textarea>
					                   	</div>
				                      	<div class="col-md-4">
					                        <div id="datepicker_start" class="input-append date success no-padding">
					                          <input type="text" class="form-control" name="realisasi_tgl" value="<?=dateIndo($form->realisasi_tgl)?>" readonly>
					                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
					                        </div>
					                   	</div>
				                    </div>
					        	</div>
					        </div>
					        <hr/>
			              	<?php echo form_close(); ?>

			              	<div class="form-actions">
					        	<div class="col-md-12 text-center">
					        		<div class="row">
					        			<div class="col-md-4 text-center"><span class="semi-bold">Evaluator,</span><br/><br/><br/></div>
					        			<div class="col-md-4 text-center"><span class="semi-bold">HRD,</span><br/><br/><br/></div>
					        			<div class="col-md-4 text-center"><span class="semi-bold">HRD Lainnya,</span><br/><br/><br/></div>
					        		</div>
					              	<div class="row wf-cuti">
					                	<div class="col-md-4" id="lv1">
					                  		<p class="wf-approve-sp">
					                      	<span class="small"></span><br/>
					                          <span class="semi-bold"><?php echo get_name($form->created_by)?></span><br/>
					                          <span class="small"><?php echo dateIndo($form->created_on)?></span><br/>
					                          <span class="semi-bold"><?=get_user_position($form->created_by)?></span>
					                  		</p>
					                	</div>

					                	<div class="col-md-4" id="<?=sessId()?>">
					                  		<p class="wf-approve-sp">
					                      	<?php 
					                  			if($form->hrd == sessNik() && $form->hrd == 0){ ?>
					                  				<div class="btn btn-success btn-cons" id="" type="button" data-toggle="modal" data-target="#submitModal<?=sessId()?>" style="margin-top: -15px;"><i class="icon-ok"></i>Submit</div><br/>
					                  				<span class="semi-bold"><?php echo get_name($form->hrd)?></span><br/>
					                          		<span class="small"><?php echo dateIndo($form->date_app)?></span><br/>
					                          		<span class="semi-bold"><?=get_user_position(get_nik($form->hrd))?></span>
					                  			<?php }else{ 
					                  				echo ($form->app_status_id == 1)?"<img class=approval-img src=$approved>": (($form->app_status_id == 2) ? "<img class=approval-img src=$rejected>"  : (($form->app_status_id == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));
					                  			?>
					                      	  <span class="small"></span><br/>
					                          <span class="semi-bold"><?php echo get_name($form->hrd)?></span><br/>
					                          <span class="small"><?php echo dateIndo($form->date_app)?></span><br/>
					                          <span class="semi-bold"><?=get_user_position(get_nik($form->hrd))?></span>
					                         <?php } ?>
					                  		</p>
					                	</div>


					                	<div class="col-md-4" id="<?=sessId()?>">
					                  		<p class="wf-approve-sp">
					                      	<?php 
					                  			if($form->hrd2 == sessNik() && $form->hrd2 == 0){ ?>
					                  				<div class="btn btn-success btn-cons" id="" type="button" data-toggle="modal" data-target="#submitModal2<?=sessId()?>" style="margin-top: -15px;"><i class="icon-ok"></i>Submit</div><br/>
					                  				<span class="semi-bold"><?php echo $form->hrd2.' - '.sessNik().' - '.get_name($form->hrd2)?></span><br/>
					                          		<span class="small"><?php echo dateIndo($form->hrd2_date_app)?></span><br/>
					                          		<span class="semi-bold"><?=get_user_position(get_nik($form->hrd2))?></span>
					                  			<?php }else{ 
					                  				echo ($form->hrd2_app_status_id == 1)?"<img class=approval-img src=$approved>": (($form->hrd2_app_status_id == 2) ? "<img class=approval-img src=$rejected>"  : (($form->hrd2_app_status_id == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));
					                  			?>
					                      	  <span class="small"></span><br/>
					                          <span class="semi-bold"><?php echo get_name($form->hrd2)?></span><br/>
					                          <span class="small"><?php echo dateIndo($form->hrd2_date_app)?></span><br/>
					                          <span class="semi-bold"><?=get_user_position(get_nik($form->hrd2))?></span>
					                         <?php } ?>
					                  		</p>
					                	</div>
					                	
					              	</div>
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
<!--end approve modal--> 


<!--approval2 Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="submitModal2<?=sessId()?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formApp2<?=sessId()?>">
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
                  <input id="app_status_lv2<?php echo $app->id?>" type="radio" name="hrd2_app_status_id" value="<?php echo $app->id?>" <?php echo (!empty($checked))?$checked:$checked2;?>>
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
                <textarea name="hrd2_note" class="custom-txtarea-form" placeholder="Note isi disini...."></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="btnApp2<?=sessId()?>" onclick="approve2(<?=sessId()?>)" type="button" class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve2 modal--> 

