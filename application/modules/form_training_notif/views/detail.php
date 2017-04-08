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
              <h4>Detail Notifikasi <span class="semi-bold"><a href="<?php echo site_url('form_training_notif')?>">Pelatihan</a></span></h4>
              <!-- <a href="<?php //echo site_url('form_training_notif/form_training_notif_pdf/'.$id)?>" target="_blank"><button class="btn btn-primary pull-right"><i class="icon-print"> Cetak</i></button></a> --><br/>
              No : <?php echo get_form_no($id) ?>
            </div>
            <div class="grid-body no-border">
            <?php
              if($_num_rows>0){
                $peserta = getAll('users_training_group', array('id'=>'where/'.$user->id))->row('user_peserta_id');
                $p = explode(",", $peserta);
                $disabled = 'disabled="disabled"';
                ?>
              <form class="form-no-horizontal-spacing" id=""> 
                <div class="row column-seperation">
                  <div class="col-md-12">
                    <form class="form-no-horizontal-spacing" id=""> 
                    <div class="row column-seperation">
                      <div class="col-md-5">
                        <h4>Peserta Pelatihan</h4>
                        <input type="hidden" id="emp" value="<?=$user->user_peserta_id?>">      
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Nama</label>
                          </div>
                          <div class="col-md-9">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($user->user_peserta_id)?>" disabled="disabled">
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Dept/Bagian</label>
                          </div>
                          <div class="col-md-9">
                            <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Jabatan</label>
                          </div>
                          <div class="col-md-9">
                            <input name="form3LastName" id="position" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
                          </div>
                        </div>
                      </div> 

                    <div class="col-md-7">
                        <h4>Data Pelatihan</h4>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Periode</label>
                          </div>
                          <div class="col-md-9">
                            <select class="select2" style="width:100%" id="comp_session_id" name="comp_session_id" required disabled="disabled">
                                  <option value="">-- Pilih Periode --</option>
                              <?php foreach($periode as $u){?>
                              <?php $selected = ($u->year == $user->comp_session_id) ? 'selected="selected"' : '' ?>
                                <option value="<?php echo $u->year?>" <?php echo $selected?> ><?php echo $u->year?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Nama Pelatihan</label>
                          </div>
                          <div class="col-md-9">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama program pelatihan" value="<?php echo $user->training_name?>" disabled="disabled">
                          </div>
                        </div>
                        <!-- <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Tanggal Pelatihan</label>
                          </div>
                          <div class="col-md-9">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Tujuan pelatihan" value="<?php //echo $user->tujuan_training?>" disabled="disabled">
                          </div>
                        </div> -->
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-left">Tanggal Pelatihan</label>
                          </div>
                              <div class="col-md-4">
                                <div id="datepicker_start" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tanggal_mulai" required value="<?php echo $user->tanggal_mulai?>">
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
                              </div>
                              <div class="col-md-1">S/D</div>
                              <div class="col-md-4">
                                <div id="datepicker_end" class="input-append date success no-padding">
                                  <input type="text" class="form-control" name="tanggal_akhir" required value="<?php echo $user->tanggal_akhir?>">
                                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
                              </div>
                          </div>
                    <?php 
                        for($i=1;$i<4;$i++):
                          $note_lv = 'note_app_lv'.$i;
                          $user_lv = 'user_app_lv'.$i;
                          if(!empty($user->$note_lv)){?>
                          <div class="row form-row">
                            <div class="col-md-3">
                              <label class="form-label text-right">Note (<?php echo strtok(get_name($user->$user_lv), " ")?>):</label>
                            </div>
                            <div class="col-md-9">
                              <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $user->$note_lv ?></textarea>
                            </div>
                          </div>
                          <?php } ?>
                        <?php endfor;?>
                        <?php if(!empty($user->note_app_hrd)){?>
                          <div class="row form-row">
                            <div class="col-md-3">
                              <label class="form-label text-right">Note (<?php echo strtok(get_name($user->user_app_hrd), " ")?>):</label>
                            </div>
                            <div class="col-md-9">
                              <textarea name="notes_hrd" class="form-control" disabled="disabled"><?php echo $user->note_app_hrd ?></textarea>
                            </div>
                          </div>
                          <?php } ?>
                    </div>

                   

                     <!-- <div class="form-actions"> -->
                      <div class="row form-row">
                        <div class="col-md-12 text-center">
                          <?php  
                          for($i=1;$i<4;$i++):
                            $is_app = 'is_app_lv'.$i;
                            $user_app = 'user_app_lv'.$i;
                            if($user->$is_app == 1 && get_nik($sess_id) == $user->$user_app){?>
                              <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalLv<?php echo $i ?>"><i class='icon-edit'> Edit Approval</i></div>
                              <div class='btn btn-warning btn-small text-center' title='Kirim Notifikasi' onClick="send_notif_('lv<?php echo $i?>')"><i class='icon-mail-forward'> Kirim Notifikasi</i></div>
                          <?php }endfor;
                          if($user->is_app_hrd == 1 && get_nik($sess_id) == $this->approval->approver('training', $user_nik)){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalHrd"><i class='icon-edit'> Edit Approval</i></div>
                          <?php } ?>
                        </div>
                      </div>

                      <div class="col-md-12 text-center"><div class="col-md-12 text-center"><span class="semi-bold">Mengetahui,</span><br/><br/><br/></div>
                      <div class="row wf-training">
                        <div class="col-md-3" id="lv1">
                          <p class="wf-approve-sp">
                            <?php
                            $approved = assets_url('img/approved_stamp.png');
                            $rejected = assets_url('img/rejected_stamp.png');
                            $pending = assets_url('img/pending_stamp.png');

                            if(!empty($user->user_app_lv1) && $user->is_app_lv1 == 0 && get_nik($sess_id) == $user->user_app_lv1){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv1"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv1)?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo '('.get_user_position($user->user_app_lv1).')'?></span>
                            <?php }elseif(!empty($user->user_app_lv1) && $user->is_app_lv1 == 1){
                            echo ($user->approval_status_id_lv1 == 1)?"<img class=approval-img src=$approved>": (($user->approval_status_id_lv1 == 2) ? "<img class=approval-img src=$rejected>"  : (($user->approval_status_id_lv1 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv1)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_lv1)?></span><br/>
                              <span class="semi-bold"><?php echo '('.get_user_position($user->user_app_lv1).')'?></span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv1))?get_name($user->user_app_lv1):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv1))?'('.get_user_position($user->user_app_lv1).')':'';?></span>
                            <?php } ?>
                          </p>
                        </div>

                        <div class="col-md-3" id="lv2">
                        <?php if(!empty($user->user_app_lv2)): ?>
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($user->user_app_lv2) && $user->is_app_lv2 == 0 && get_nik($sess_id) == $user->user_app_lv2){?>
                             <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv2"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv2))?get_name($user->user_app_lv2):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo'('.get_user_position($user->user_app_lv2).')'?></span>
                            <?php }elseif(!empty($user->user_app_lv2) && $user->is_app_lv2 == 1){
                             echo ($user->approval_status_id_lv2 == 1)?"<img class=approval-img src=$approved>": (($user->approval_status_id_lv2 == 2) ? "<img class=approval-img src=$rejected>"  : (($user->approval_status_id_lv2 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv2)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_lv2)?></span><br/>
                              <span class="semi-bold"><?php echo '('.get_user_position($user->user_app_lv2).')'?></span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv2))?get_name($user->user_app_lv2):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv2))?'('.get_user_position($user->user_app_lv2).')':'';?></span>
                            <?php } ?>
                          </p>
                        <?php endif; ?>
                        </div>
                          
                        <div class="col-md-3" id="lv1">
                          <?php if(!empty($user->user_app_lv3)): ?>
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($user->user_app_lv3) && $user->is_app_lv3 == 0 && get_nik($sess_id) == $user->user_app_lv3){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv3"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo  get_name($user->user_app_lv3)?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($user->user_app_lv3)?>)</span>
                            <?php }elseif(!empty($user->user_app_lv3) && $user->is_app_lv3 == 1){
                            echo ($user->approval_status_id_lv3 == 1)?"<img class=approval-img src=$approved>": (($user->approval_status_id_lv3 == 2) ? "<img class=approval-img src=$rejected>"  : (($user->approval_status_id_lv3 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv3)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_lv3)?></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($user->user_app_lv3)?>)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv3))?get_name($user->user_app_lv3):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv3))?'('.get_user_position($user->user_app_lv3).')':'';?></span>
                            <?php } ?>
                          </p>
                        <?php endif; ?>
                        </div>
                          
                        <div class="col-md-3" id="hrd">
                          <p class="wf-approve-sp">
                            <?php
                            if($user->is_app_hrd == 0 && $this->approval->approver('training') == $sess_nik){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalHrd"><i class="icon-ok"></i>Submit</div>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }elseif($user->is_app_hrd == 1){
                             echo ($user->approval_status_id_hrd == 1)?"<img class=approval-img src=$approved>": (($user->approval_status_id_hrd == 2) ? "<img class=approval-img src=$rejected>"  : (($user->approval_status_id_hrd == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_hrd)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_hrd)?></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php } ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
               </div>
            </div>
          </div>
      </div> 
  </div>  
<!-- END PAGE --> 


<!-- Edit approval training Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="submitModalHrd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval HRD - Form Notifikasi Training</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <?php $att = array('class'=>'', 'id'=>'formApphrd');
        echo form_open('', $att);?>
        <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $user->approval_status_id_hrd) ? 'checked = "checked"' : '';
                      $checked2 = ($app->id == 1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_hrd<?php echo $app->id?>" type="radio" name="app_status_hrd" value="<?php echo $app->id?>" <?php echo (!empty($checked))?$checked:$checked2;?>>
                  <label for="app_status_hrd<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="app_status_hrd" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (HRD) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_hrd" class="custom-txtarea-form" placeholder="Note HRD isi disini"><?php echo $user->note_app_hrd?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="btnApphrd" onclick="approve('hrd')" type="button" class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end edit modal-->   


<?php for($i=1;$i<4;$i++):?>
  <!--approval  Modal atasan -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="<?php echo 'submitModalLv'.$i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Atasan</h4>
      </div>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="<?php echo 'formApplv'.$i?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $x = 'approval_status_id_lv'.$i;
                      $y = 'note_app_lv'.$i;
                      $checked = ($app->id <> 0 && $app->id == $user->$x) ? 'checked = "checked"' : '';
                      $checked2 = ($app->id == 1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv<?php echo $i.'-'.$app->id?>" type="radio" name="<?php echo 'app_status_lv'.$i?>" value="<?php echo $app->id?>" <?php echo (!empty($checked))?$checked:$checked2;?>>
                  <label for="app_status_lv<?php echo $i.'-'.$app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="<?php echo 'app_status_lv'.$i?>" value="0">
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
                <textarea name="<?php echo 'note_lv'.$i?>" class="form-control" placeholder="Isi note disini...."><?php echo $user->$y?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
         <button id="btnApplv<?=$i?>" onclick="approve('lv<?=$i?>')" type="button" class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal-->
<?php endfor;?>

<?php }else{
  echo '<div class="col-md-12 text-center">Pengajuan Ini Telah Di Batalkan Oleh Pengaju</div>';
  } ?>
