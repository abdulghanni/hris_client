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
              <h4>Form Izin Tidak <a href="<?php echo site_url('form_tidak_masuk')?>"><span class="semi-bold">Masuk Kerja</span></a></h4>
              <a href="<?php echo site_url('form_tidak_masuk/form_tidak_masuk_pdf/'.$id)?>" target="_blank"><button class="btn btn-primary pull-right"><i class="icon-print"> Cetak</i></button></a><br/>
              No : <?= get_form_no($id) ?>
            </div>
            <div class="grid-body no-border">
            <?php 
            if($_num_rows>0){
                ?>
              <form class="form-no-horizontal-spacing" id="form"> 
                <input name="emp" id="emp" type="hidden" value="<?php echo $tidak_masuk->user_id?>">
                <div class="row column-seperation">
                  <div class="col-md-12">
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">NIK</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="nik" type="text"  class="form-control" placeholder="Nama" value="" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($tidak_masuk->user_id)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="Nama" value="" disabled="disabled">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="position" id="position" type="text"  class="form-control" placeholder="position" value="" disabled="disabled">
                      </div>
                    </div>
                    
                    <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Tanggal Tidak Masuk</label>
                          </div>
                          <div class="col-md-3">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo dateIndo($tidak_masuk->dari_tanggal)?>" disabled="disabled">
                          </div>
                          <div class="col-md-1 form-label">s/d</div>  
                          <div class="col-md-3">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo dateIndo($tidak_masuk->sampai_tanggal)?>" disabled="disabled">
                          </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jumlah Hari</label>
                      </div>
                      <div class="col-md-1">
                        <input name="alasan" id="alasan" type="text"  class="form-control"  value="<?= $tidak_masuk->jml_hari?>" readonly="readonly">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Sisa Cuti</label>
                      </div>
                      <div class="col-md-1">
                        <input name="alasan" id="alasan" type="text"  class="form-control"  value="<?= $tidak_masuk->sisa_cuti?>" readonly="readonly">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Alasan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo $alasan?>" disabled="disabled">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Keterangan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo $tidak_masuk->keterangan?>" disabled="disabled">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Attachment</label>
                      </div>
                      <div class="col-md-9">
                        <a href="<?php echo base_url("uploads/izin/".$user_nik."/".$tidak_masuk->attachment)?>" target="_blank"><?php echo $tidak_masuk->attachment?></a>
                      </div>
                    </div> 
                    <?php if($tidak_masuk->potong_cuti == 1) :
                      $potong = ($tidak_masuk->potong_cuti == 1) ? 'Ya' : 'Tidak';
                    ?>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Izin Potong Cuti</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo $potong?>" disabled="disabled">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Tipe Cuti</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo $tipe_cuti?>" disabled="disabled">
                      </div>
                    </div>

                  <?php endif; ?>
                  <div id="note">
                  <?php 
                      for($i=1;$i<4;$i++):
                      $note_lv = 'note_lv'.$i;
                      $user_lv = 'user_app_lv'.$i;
                      if(!empty($tidak_masuk->$note_lv)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Note (<?php echo strtok(get_name($tidak_masuk->$user_lv), " ")?>):</label>
                        </div>
                        <div class="col-md-9">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $tidak_masuk->$note_lv ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                    <?php endfor;?>
                  <?php if(!empty($tidak_masuk->note_hrd)):?>
                    <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Note (HRD): </label>
                        </div>
                        <div class="col-md-9">
                          <textarea name="notes_hrd" placeholder="Note hrd isi disini" class="form-control" disabled="disabled"><?php echo $tidak_masuk->note_hrd ?></textarea>
                        </div>
                      </div>
                  <?php endif; ?>
                  </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="row form-row">
                    <div class="col-md-12 text-center">
                      <?php  
                      for($i=1;$i<4;$i++):
                        $is_app = 'is_app_lv'.$i;
                        $user_app = 'user_app_lv'.$i;
                        if($tidak_masuk->$is_app == 1 && sessNik() == $tidak_masuk->$user_app){?>
                          <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalLv<?php echo $i ?>"><i class='icon-edit'> Edit Approval</i></div>
                      <?php }endfor;
                      if($tidak_masuk->is_app_hrd == 1 && sessNik() == $this->approval->approver('absen', $user_nik)){?>
                        <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalHrd"><i class='icon-edit'> Edit Approval</i></div>
                      <?php } ?>
                    </div>
                  </div>

                  <div class="row wf-cuti">
                    <div class="col-md-12 text-center">
                      <div class="col-md-3">
                        <p class="wf-approve-sp">
                        <div class="col-md-12"><span class="semi-bold">Pemohon,</span><br/><br/></div>
                          <img class=approval-img src="<?=assets_url('img/signed.png');?>">
                          <span class="small"></span><br/>
                          <span class="semi-bold"><?php echo get_name($tidak_masuk->user_id)?></span><br/>
                          <span class="small"><?php echo dateIndo($tidak_masuk->created_on)?></span><br/>
                          <span class="semi-bold">(<?php echo get_user_position(get_nik($tidak_masuk->user_id))?>)</span>
                        </p>
                      </div>

                      <div class="col-md-3" id="lv1">
                        <p class="wf-approve-sp">
                        <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                          <?php 
                          if(!empty($tidak_masuk->user_app_lv1) && $tidak_masuk->is_app_lv1 == 0 && sessNik() == $tidak_masuk->user_app_lv1){?>
                          <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv1"><i class="icon-ok"></i>Submit</div>
                          <span class="small"></span>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"></span>
                            <span class="semi-bold">(<?php echo get_user_position($tidak_masuk->user_app_lv1)?>)</span>
                          <?php }elseif(!empty($tidak_masuk->user_app_lv1) && $tidak_masuk->is_app_lv1 == 1){
                           echo ($tidak_masuk->app_status_id_lv1 == 1)?"<img class=approval-img src=$approved>": (($tidak_masuk->app_status_id_lv1 == 2) ? "<img class=approval-img src=$rejected>"  : (($tidak_masuk->app_status_id_lv1 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                          <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_lv1)?></span><br/>
                            <span class="small"><?php echo dateIndo($tidak_masuk->date_app_lv1)?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($tidak_masuk->user_app_lv1)?>)</span>
                          <?php }else{?>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_lv1)?></span><br/>
                            <span class="small"><?php echo dateIndo($tidak_masuk->date_app_lv1)?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($tidak_masuk->user_app_lv1)?>)</span>
                          <?php } ?>
                        </p>
                      </div>
                      
                      <div class="col-md-3" id="lv2">
                      <?php if(!empty($tidak_masuk->user_app_lv2)):?>
                        <p class="wf-approve-sp">
                        <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                        <?php
                         if(!empty($tidak_masuk->user_app_lv2) && $tidak_masuk->is_app_lv2 == 0 && sessNik() == $tidak_masuk->user_app_lv2){?>
                            <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv2"><i class="icon-ok"></i>Submit</div>
                            <span class="small"></span>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold">(Atasan Tidak Langsung)</span>
                          <?php }elseif(!empty($tidak_masuk->user_app_lv2) && $tidak_masuk->is_app_lv2 == 1){
                            echo ($tidak_masuk->app_status_id_lv2 == 1)?"<img class=approval-img src=$approved>": (($tidak_masuk->app_status_id_lv2 == 2) ? "<img class=approval-img src=$rejected>"  : (($tidak_masuk->app_status_id_lv2 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                          <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_lv2)?></span><br/>
                            <span class="small"><?php echo dateIndo($tidak_masuk->date_app_lv2)?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($tidak_masuk->user_app_lv2)?>)</span>
                          <?php }else{?>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_lv2)?></span><br/>
                            <span class="small"><?php echo dateIndo($tidak_masuk->date_app_lv2)?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($tidak_masuk->user_app_lv2)?>)</span>
                          <?php } ?>
                        </p>
                      <?php endif;?>
                      </div>
                      
                      <div class="col-md-3" id="hrd">
                        <p class="wf-approve-sp">
                        <div class="col-md-12"><span class="semi-bold">Diterima HRD</span><br/><br/></div>
                          <?php if($tidak_masuk->is_app_hrd == 0 && $this->approval->approver('absen', $user_nik) == sessNik()){
                              if(cek_approval_atasan($id)):
                                  ?>
                                  <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalHrd"><i class="icon-ok"></i>Submit</div>
                                  <?php else: ?>
                                    <label>Menunggu approval dari atasan</label>
                                  <?php endif; ?>
                            <span class="small"></span>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold">(HRD)</span>
                          <?php }elseif($tidak_masuk->is_app_hrd == 1){
                            echo ($tidak_masuk->app_status_id_hrd == 1)?"<img class=approval-img src=$approved>": (($tidak_masuk->app_status_id_hrd == 2) ? "<img class=approval-img src=$rejected>"  : (($tidak_masuk->app_status_id_hrd == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                          <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_hrd)?></span><br/>
                            <span class="small"><?php echo dateIndo($tidak_masuk->date_app_hrd)?></span><br/>
                            <span class="semi-bold">(HRD)</span>
                          <?php }else{?>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($this->approval->approver('absen', $user_nik))?></span><br/>
                            <span class="small"><?php echo dateIndo($tidak_masuk->date_app_hrd)?></span><br/>
                            <span class="semi-bold">(HRD)</span>
                          <?php } ?>
                        </p>
                      </div>
                    </div>
                  </div> 
                  <br/>
                  <?php if(!empty($tidak_masuk->user_app_lv3)){?>
                  <div class="col-md-12 text-xenter"  id="lv3">
                    <div class="col-md-12 text-center">
                      <p class="wf-approve-sp">
                      <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                        <?php 
                        $approved = assets_url('img/approved_stamp.png');
                        $rejected = assets_url('img/rejected_stamp.png');
                        if(!empty($tidak_masuk->user_app_lv3) && $tidak_masuk->is_app_lv3 == 0 && sessNik() == $tidak_masuk->user_app_lv3){?>
                          <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv3"><i class="icon-ok"></i>Submit</div>
                          <span class="small"></span>
                          <span class="semi-bold"></span><br/>
                          <span class="small"></span><br/>
                          <span class="semi-bold"></span><br/>
                          <span class="semi-bold">(<?php echo get_user_position($tidak_masuk->user_app_lv3)?>)</span>
                        <?php }elseif(!empty($tidak_masuk->user_app_lv3) && $tidak_masuk->is_app_lv3 == 1){
                          echo ($tidak_masuk->app_status_id_lv3 == 1)?"<img class=approval-img src=$approved>": (($tidak_masuk->app_status_id_lv3 == 2) ? "<img class=approval-img src=$rejected>"  : (($tidak_masuk->app_status_id_lv3 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                          <span class="small"></span><br/>
                          <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_lv3)?></span><br/>
                          <span class="small"><?php echo dateIndo($tidak_masuk->date_app_lv3)?></span><br/>
                          <span class="semi-bold">(<?php echo get_user_position($tidak_masuk->user_app_lv3)?>)</span>
                        <?php }else{?>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_lv3)?></span><br/>
                            <span class="small"><?php echo dateIndo($tidak_masuk->date_app_lv3)?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($tidak_masuk->user_app_lv3)?>)</span>
                        <?php } ?>
                      </p>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
              
    
      </div>
    
  </div>  
  <!-- END PAGE --> 


<!--approval absen Modal Lv1 -->
<div class="modal fade" id="submitModalLv1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form - Atasan Langsung</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formAppLv1">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $tidak_masuk->app_status_id_lv1) ? 'checked = "checked"' : '';
                      $checked2 = ($app->id == 1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv1<?php echo $app->id?>" type="radio" name="app_status_lv1" value="<?php echo $app->id?>" <?php echo (!empty($checked))?$checked:$checked2;?>>
                  <label for="app_status_lv1<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="app_status_lv1" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Atasan Langsung) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_lv1" class="custom-txtarea-form" placeholder="Note Atasan Langsung isi disini"><?php echo $tidak_masuk->note_lv1?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="button" id="btn_app_lv1" class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;Save</button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal lv1--> 

<!--approval absen Modal Lv2 -->
<div class="modal fade" id="submitModalLv2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form - Atasan Tidak Langsung</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formAppLv2">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $tidak_masuk->app_status_id_lv2) ? 'checked = "checked"' : '';
                      $checked2 = ($app->id == 1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv2<?php echo $app->id?>" type="radio" name="app_status_lv2" value="<?php echo $app->id?>" <?php echo (!empty($checked))?$checked:$checked2;?>>
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
                <label class="form-label text-left">Note (Atasan Tidak Langsung) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_lv2" class="custom-txtarea-form" placeholder="Note Atasan Tidak Langsung isi disini"><?php echo $tidak_masuk->note_lv2?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="btn_app_lv2"  class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal Lv2--> 

<!--approval absen Modal Lv3 -->
<div class="modal fade" id="submitModalLv3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form - Atasan Lainnya</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formAppLv3">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $tidak_masuk->app_status_id_lv3) ? 'checked = "checked"' : '';
                      $checked2 = ($app->id == 1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv3<?php echo $app->id?>" type="radio" name="app_status_lv3" value="<?php echo $app->id?>" <?php echo (!empty($checked))?$checked:$checked2;?>>
                  <label for="app_status_lv3<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="app_status_lv3" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Atasan) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_lv3" class="custom-txtarea-form" placeholder="Note atasan isi disini"><?php echo $tidak_masuk->note_lv3?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="btn_app_lv3"  class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal Lv3--> 

  <!--approval cuti Modal HRD -->
<div class="modal fade" id="submitModalHrd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form - HRD</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" id="formAppHrd">
            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label text-left">Izin Potong Cuti </label>
              </div>
              <input type="hidden" name="insert" value="<?php echo $sisa_cuti['insert']?>">
              <div class="col-md-9">
                <div class="radio">
                  <input id="potong_cuti_1" type="radio" name="potong_cuti" value="1">
                  <label for="potong_cuti_1">Ya</label>
                  <input id="potong_cuti_0" type="radio" name="potong_cuti" value="0" checked>
                  <label for="potong_cuti_0">Tidak</label>
                </div>
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label text-left">Tipe Cuti</label>
              </div>
              <div class="col-md-9">
                <select name="type_cuti_id" id="alasan_cuti" class="select2" style="width:100%">
                        <option value="0">- Pilih Alasan Cuti -</option>
                  <?php if ($alasan_cuti->num_rows>0) { ?>
                      <?php foreach($alasan_cuti->result() as $a) : ?>
                        <option value="<?php echo $a->HRSLEAVETYPEID; ?>"><?php echo $a->title; ?></option>
                      <?php endforeach; ?>                      
                  <?php } else {?>
                        <option value="0">No Data</option>
                    <?php } ?>
                </select> 
              </div>
            </div>
            
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $tidak_masuk->app_status_id_hrd) ? 'checked = "checked"' : '';
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
                <textarea name="note_hrd" class="custom-txtarea-form" placeholder="Note hrd isi disini"><?php echo $tidak_masuk->note_hrd?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="btn_app_hrd" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal HRD--> 


              <?php }else{
  echo '<div class="col-md-12 text-center">Pengajuan Ini Telah Di Batalkan Oleh Pengaju</div>';
  } ?>