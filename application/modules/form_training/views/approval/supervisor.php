<!-- BEGIN PAGE CONTAINER-->
  <div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content">  
		
		
	    <div id="container">
	    	<div class="row">
        <div class="col-md-12">
          <div class="grid simple">
            <div class="grid-title no-border">
              <h4>Form Pengajuan <a href="<?php echo site_url('form_training')?>"><span class="semi-bold">Pelatihan</span></a></h4>
            </div>
            <div class="grid-body no-border">
              <form class="form-no-horizontal-spacing" id="formAppLv1">
              <?php if($form_training->num_rows()>0){
                foreach($form_training->result() as $user){
                $session_nik = get_nik($this->session->userdata('user_id'));
                $session_id = get_nik($this->session->userdata('user_id'));
                $approval_id = $user->approval_status_id_lv1;
                $notes_spv = $user->note_app_lv1;
                ?> 
                 <div class="row column-seperation">
                <div class="col-md-12">
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">NIK</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" name="start_training" value="<?php echo (!empty($user_info))?$user_info['EMPLID']:'-';?>" disabled="disabled">
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Nama</label>
                    </div>
                    <div class="col-md-9">
                      <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->name?>" disabled="disabled">
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Jabatan</label>
                    </div>
                    <div class="col-md-9">
                      <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo (!empty($user_info))?$user_info['POSITION']:'-';?>" disabled="disabled">
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Dept/Bagian</label>
                    </div>
                    <div class="col-md-9">
                      <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo (!empty($user_info))?$user_info['ORGANIZATION']:'-';?>" disabled="disabled">
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Nama Program Pelatihan</label>
                    </div>
                    <div class="col-md-9">
                      <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama program pelatihan" value="<?php echo $user->training_name?>" disabled="disabled">
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Tujuan Pelatihan</label>
                    </div>
                    <div class="col-md-9">
                      <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Tujuan pelatihan" value="<?php echo $user->tujuan_training?>" disabled="disabled">
                    </div>
                  </div>
                  <!--
                  <?php if(!empty($user->is_app_lv1)){?>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Approval Status SPV</label>
                    </div>
                    <div class="col-md-9">
                      <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Tujuan pelatihan" value="tes" disabled="disabled">
                    </div>
                  </div>
                  <?php } ?>

                  <?php if(!empty($user->note_app_lv1)){?>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Note SPV</label>
                    </div>
                    <div class="col-md-9">
                      <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Tujuan pelatihan" value="<?php echo $user->tujuan_training?>" disabled="disabled">
                    </div>
                  </div>
                  <?php } ?>
                  -->

                  <?php if ($user->is_app_lv1 == 1 && cek_subordinate(is_have_subordinate($session_id),'id', $user->user_id) == TRUE) { ?>
                  <div class="row form-row">
                    <div class="col-md-6">
                      &nbsp;
                    </div>
                    <div class="col-md-6">
                      <div class='btn btn-info btn-small' class="text-center" title='Edit Approval' data-toggle="modal" data-target="#notapprovetrainingModal"><i class='icon-edit'> Edit Approval</i></div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
                <div class="form-actions">
                  <div class="col-md-12 text-center">
                    <div class="row wf-cuti">
                      <div class="col-md-4">
                        Diusulkan oleh,<br/><br/>
                         <p class="wf-approve-sp">
                            <span class="semi-bold"><?php echo $user->name?></span><br/>
                            <span class="small"><?php echo dateIndo($user->created_on)?></span><br/>
                          </p>
                      </div>
                      <div class="col-md-4">
                        Persetujuan atasan,<br/><br/>
                        <?php 
                            $approved = assets_url('img/approved_stamp.png');
                            $rejected = assets_url('img/rejected_stamp.png');
                            if($user->is_app_lv1==1){
                              echo ($user->approval_status_id_lv1 == 1)? "<img class=approval_img src=$approved>":(($user->approval_status_id_lv1 == 2) ? "<img class=approval_img src=$rejected>":'');?><br/>
                            <span class="semi-bold"><?php echo $name_app_lv1?></span><br/>
                            <span class="small"><?php echo dateIndo($user->date_app_lv1)?></span>
                            <br />
                          
                            <?php }elseif($user->is_app_lv1 == 1 && cek_subordinate(is_have_subordinate($session_id),'id', $user->user_id) == FALSE){?>
                            <span class="semi-bold"><?php echo $name_app_lv1?></span><br/>
                            <span class="small"><?php echo dateIndo($user->date_app_lv1)?></span>
                            <?php }elseif(cek_subordinate(is_have_subordinate($session_nik),'id', $user->user_id))
                                  {
                                    if($user->is_app_lv1 == 0){?>
                          <div class="btn btn-success btn-cons" data-toggle="modal" data-target="#notapprovetrainingModal"><i class="icon-ok"></i>Submit</div>
                          <?php }}?>
                      </div>
                       <div class="col-md-4">
                          Mengetahui HRD,<br/><br/>
                         <?php if($user->is_app_lv2==1){
                            echo ($user->approval_status_id_lv2 == 1)? "<img class=approval_img src=$approved>":(($user->approval_status_id_lv2 == 2) ? "<img class=approval_img src=$rejected>":'');?><br/>
                            <span class="semi-bold"><?php echo $name_app_lv2?></span><br/>
                          <span class="small"><?php echo dateIndo($user->date_app_lv2)?></span>
                          <?php }else{?>
                           <span class="semi-bold"></span><br/>
                           <span class="small"></span>
                          <?php }?>
                        </div>
                    </div>
                  </div>
                </div>
              </form>
              <?php }}?>
            </div>
          </div>
        </div>
      </div>
	          	
		
      </div>
		
	</div>  
	<!-- END PAGE --> 


  <!-- Edit approval training Modal -->
<div class="modal fade" id="notapprovetrainingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form training</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" method="POST" action="<?php echo site_url('form_training/not_approve_spv/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $approval_id) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status<?php echo $app->id?>" type="radio" name="app_status" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="app_status" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (spv) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_spv" class="custom-txtarea-form" placeholder="Note supervisor isi disini"><?=$notes_spv?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end edit modal--> 