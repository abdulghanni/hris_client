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
					                        <label class="form-label text-right">Nama</label>
					                    </div>
					                    <div class="col-md-9">
							            	<input type="text" class="form-control" value="<?=get_name($form->nik)?>" readonly="readonly">
							            	<input type="hidden" id="emp" class="form-control" value="<?=$form->nik?>" readonly="readonly">
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
				                        <label class="form-label text-right">Tanggal Mulai Bekerja</label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="position" id="seniority_date" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right">Periode Penilaian</label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="periode" id="" type="text"  class="form-control" placeholder="-" value="<?=get_year_session($form->comp_session_id)?>" readonly>
				                      </div>
				                    </div>
					        	</div>
					        </div>

					        <div class="row">
					        	<div class="col-md-12">
				                    <table class="table table-bordered" id="tbl_performance">
										<thead>
											<tr>
												<td width="5%" rowspan="2" valign="center">
								                    No.
												</td>
												<td width="65%" rowspan="2" class="text-center">Aspek Penilaian<br/> Performance(60%)</td>
												<td widtd="30%" colspan="3" class="text-center">Penilaian</td>
											</tr>
											<tr>
												<td class="text-center">Bobot</td>
												<td class="text-center">Nilai</td>
												<td class="text-center">(B/100) x N</td>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1; foreach($performance as $p){?>
											<tr>
												<td><?=$i++?></td>
												<td><?=$p->aspek?></td>
												<td><?=$p->bobot?></td>
												<td><?=$p->nilai?></td>
												<td><?=$p->persentase?></td>
											</tr>
											<?php } ?>
										</tbody>

										<tfoot id="tbl_performance_footer">
											<tr>
												<td></td>
												<td>Subtotal Nilai Performance</td>
												<td><input class="form-control text-right" type="text" id="sub_total_bobot_performance" name="sub_total_bobot_performance" value="<?=$form->sub_total_bobot_performance?>" readonly="readonly"></td>
												<td><input class="form-control text-right" id="sub_total_nilai_performance" type="text" name="sub_total_nilai_performance" value="<?=$form->sub_total_nilai_performance?>" readonly="readonly"></td>
												<td><input class="form-control text-right" id="sub_total_persentase_performance" type="text" name="sub_total_persentase_performance" value="<?=$form->sub_total_persentase_performance?>" readonly="readonly"></td>
											</tr>
										</tfoot>
									</table>
					        	</div>
					        </div>
					        <br/>
					        <br/>
					        <br/>
					        <div class="row">
					        	<div class="col-md-12">
				                    <table class="table table-bordered" id="tbl_kompetensi">
										<thead>
											<tr>
												<td width="5%" rowspan="2" valign="center">
								                    No.
												</td>
												<td width="65%" rowspan="2" class="text-center">Aspek Penilaian<br/> Kompetensi(40%)</td>
												<td widtd="30%" colspan="3" class="text-center">Penilaian</td>
											</tr>
											<tr>
												<td class="text-center">Bobot</td>
												<td class="text-center">Nilai</td>
												<td class="text-center">(B/100) x N</td>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1; foreach($kompetensi as $p){?>
											<tr>
												<td><?=$i++?></td>
												<td><?=$p->aspek?></td>
												<td><?=$p->bobot?></td>
												<td><?=$p->nilai?></td>
												<td><?=$p->persentase?></td>
											</tr>
											<?php } ?>
										</tbody>

										<tfoot id="tbl_kompetensi_footer">
											<tr>
												<td></td>
												<td>Subtotal Nilai Kompetensi</td>
												<td><input class="form-control text-right" type="text" id="sub_total_bobot_kompetensi" name="sub_total_bobot_kompetensi" value="<?=$form->sub_total_bobot_kompetensi?>" readonly="readonly"></td>
												<td><input class="form-control text-right" id="sub_total_nilai_kompetensi" type="text" name="sub_total_nilai_kompetensi" value="<?=$form->sub_total_nilai_kompetensi?>" readonly="readonly"></td>
												<td><input class="form-control text-right" id="sub_total_persentase_kompetensi" type="text" name="sub_total_persentase_kompetensi" value="<?=$form->sub_total_persentase_kompetensi?>" readonly="readonly"></td>
											</tr>
										</tfoot>
									</table>
					        	</div>
					        </div>
					        <hr/>
				            
				            <div class="row">
					        	<div class="col-md-12">
					        		<table id="" class="table-bordered">
										<tr>
											<td width="85%" class="">&nbsp;&nbsp; <h5>Total Nilai Kinerja = (Performance x 60%) + (Kompetensi x 40%)</h5></td>
											<td class="text-right"><input class="form-control text-right" id="total_nilai" type="text" name="total_nilai" readonly="readonly" value="<?=$form->total?>"></td>
										</tr>

										<tr>
											<td width="85%" class="">&nbsp;&nbsp; <h5>Konversi Nilai</h5></td>
											<td class="text-right"><input class="form-control text-right" id="konversi_nilai" type="text" name="konversi_nilai" readonly="readonly" value="<?=$form->konversi?>"></td>
										</tr>
									</table>
					        	</div>
					        </div>

					        <hr/>
					        <div class="row">
					        	<div class="row form-row">
					            	<div class="col-md-12">
				                        <label class="form-label">1. Potensi Promosi</label>
				                    </div>
				                    <div class="col-md-12">
						            	<textarea name="potensi_promosi" class="form-control" placeholder="Isi disini...." readonly="readonly"><?=$form->potensi_promosi?></textarea>
				                    </div>
				                </div>

				                <div class="row form-row">
					            	<div class="col-md-12">
				                        <label class="form-label">2. Catatan Pada Aspek Perilaku</label>
				                    </div>
				                    <div class="col-md-12">
						            	<textarea name="catatan_perilaku" class="form-control" placeholder="Isi disini...." readonly="readonly"><?=$form->catatan_perilaku?></textarea>
				                    </div>
				                </div>

				                <div class="row form-row">
					            	<div class="col-md-12">
				                        <label class="form-label">3. Kebutuhan Training</label>
				                    </div>
				                    <div class="col-md-12">
						            	<textarea name="kebutuhan_training" class="form-control" placeholder="Isi disini...." readonly="readonly"><?=$form->kebutuhan_training?></textarea>
				                    </div>
				                </div>

				                <div class="row form-row">
					            	<div class="col-md-12">
				                        <label class="form-label">4. Target Ke depan</label>
				                    </div>
				                    <div class="col-md-12">
						            	<textarea name="target_kedepan" class="form-control" placeholder="Isi disini...." readonly="readonly"><?=$form->target_kedepan?></textarea>
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
			              	<?php echo form_close(); ?>
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

