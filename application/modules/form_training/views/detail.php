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
                <h4>View Permintaan <span class="semi-bold"><a href="<?php echo site_url('form_training')?>">Pelatihan</a></span></h4>
              </div>
                <div class="grid-body no-border">
                  <?php if($_num_rows>0){
                  foreach($form_training as $user):
                    $disabled = 'disabled';
                  ?>
                  <form class="form-no-horizontal-spacing" id=""> 
                    <div class="row column-seperation">
                      <div class="col-md-5">
                        <h4>Yang Mengajukan Pelatihan</h4>      
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Nama</label>
                          </div>
                          <div class="col-md-9">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($user->created_by)?>" disabled="disabled">
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Dept/Bagian</label>
                          </div>
                          <div class="col-md-9">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_organization(get_nik($user->created_by))?>" disabled="disabled">
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Jabatan</label>
                          </div>
                          <div class="col-md-9">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_position(get_nik($user->created_by))?>" disabled="disabled">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-7">
                        <h4>Memberi Pengajuan Pelatihan Kepada</h4>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Nama</label>
                          </div>
                          <div class="col-md-9">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($user->user_id)?>" disabled="disabled">
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Dept/Bagian</label>
                          </div>
                          <div class="col-md-9">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Dept/Bagian" value="<?php echo get_user_organization($user_nik)?>" disabled="disabled">
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Jabatan</label>
                          </div>
                          <div class="col-md-9">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Jabatan" value="<?php echo get_user_position($user_nik)?>" disabled="disabled">
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
                        <?php if(!empty($user->approval_status_id_lv1)){?>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Approval Status(Supervisor)</label>
                          </div>
                          <div class="col-md-9">
                            <input name="" id="alamat_training" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->approval_status_lv1; ?>" disabled="disabled">
                          </div>
                        </div>
                        <?php } ?>

                        <?php if(!empty($user->note_app_lv1)){?>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Note (Supervisor) : </label>
                          </div>
                          <div class="col-md-9">
                            <textarea name="" class="custom-txtarea-form"  disabled="disabled"><?php echo $user->note_app_lv1?></textarea>
                          </div>
                        </div>
                        <?php } ?>

                        <?php if(!empty($user->approval_status_id_lv2)){?>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Approval Status(Ka. Bagian)</label>
                          </div>
                          <div class="col-md-9">
                            <input name="" id="alamat_training" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->approval_status_lv2; ?>" disabled="disabled">
                          </div>
                        </div>
                        <?php } ?>

                        <?php if(!empty($user->note_app_lv2)){?>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Note (Ka. Bagian) : </label>
                          </div>
                          <div class="col-md-9">
                            <textarea name="" class="custom-txtarea-form"  disabled="disabled"><?php echo $user->note_app_lv2?></textarea>
                          </div>
                        </div>
                        <?php } ?>

                        <?php if(!empty($user->approval_status_id_lv3)){?>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Approval Status(Atasan Lainnya)</label>
                          </div>
                          <div class="col-md-9">
                            <input name="" id="alamat_training" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->approval_status_lv3; ?>" disabled="disabled">
                          </div>
                        </div>
                        <?php } ?>

                        <?php if(!empty($user->note_app_lv3)){?>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Note (Atasan Lainnya) : </label>
                          </div>
                          <div class="col-md-9">
                            <textarea name="" class="custom-txtarea-form"  disabled="disabled"><?php echo $user->note_app_lv3?></textarea>
                          </div>
                        </div>
                        <?php } ?>

                      </div>

                   <!-- Isian HRD-->
                    <?php if(!empty($user->is_app_hrd)){?>
                    &nbsp;
                    <hr/>
                    <div class="col-md-12">
                        <div class="grid-title no-border">
                          <h4>Diisi oleh HRD</h4>
                        </div>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Tipe Pelatihan</label>
                        </div>
                        <div class="col-md-7">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Tujuan pelatihan" value="<?php echo $user->training_type?>" disabled="disabled">
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Penyelenggara</label>
                        </div>
                        <div class="col-md-7">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Tujuan pelatihan" value="<?php echo $user->penyelenggara?>" disabled="disabled">
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Pembiayaan</label>
                        </div>
                        <div class="col-md-7">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Tujuan pelatihan" value="<?php echo $user->pembiayaan?>" disabled="disabled">
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Ikatan</label>
                        </div>
                        <div class="col-md-7">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Tujuan pelatihan" value="<?php echo $user->ikatan?>" disabled="disabled">
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Waktu</label>
                        </div>
                        <div class="col-md-7">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Tujuan pelatihan" value="<?php echo $user->waktu?>" disabled="disabled">
                        </div>
                      </div>


                      <div class="row form-row">
                        <div class="col-md-2">
                          <label for="besar_biaya" class="form-label text-right">Besar Biaya (Rp.)</label>
                        </div>
                        <div class="col-md-7">
                          <input name="" id="" type="text"  class="form-control" placeholder="Besar biaya (Rp.)" value="<?php echo $user->besar_biaya?>" <?php echo $disabled?> required>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Tempat Pelaksanaan</label>
                        </div>
                        <div class="col-md-7">
                          <input name="" id="tempat" type="text"  class="form-control" placeholder="Tempat Pelaksanaan" value="<?php echo $user->tempat?>" <?php echo $disabled?> required>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Nama Narasumber</label>
                        </div>
                        <div class="col-md-7">
                          <input name="" id="tempat" type="text"  class="form-control" placeholder="Nama Narasumber" value="<?php echo $user->narasumber?>" disabled="disabled">
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Nama Vendor</label>
                        </div>
                        <div class="col-md-7">
                          <input name="" id="vendor_update" type="text"  class="form-control" placeholder="Nama Vendor" value="<?php echo $user->vendor?>" disabled="disabled">
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Waktu Pelaksanaan</label>
                        </div>
                        <div class="col-md-2">
                          <input name="" id="" type="text"  class="form-control" value="<?php echo dateIndo($user->tanggal_mulai)?>" readonly>
                        </div>
                        <div class="col-md-1">
                          <label class="form-label text-center">s/d</label>
                        </div>
                        <div class="col-md-2">
                           <input name="" id="" type="text"  class="form-control" value="<?php echo dateIndo($user->tanggal_akhir)?>" readonly>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Lama Pelaksanaan</label>
                        </div>
                        <div class="col-md-2">
                          <input name="" id="" type="text"  class="form-control text-center" value="<?php echo $user->lama_training_bulan?> Bulan" readonly>
                        </div>
                        <div class="col-md-2">
                          <input name="" id="" type="text"  class="form-control text-center" value="<?php echo $user->lama_training_hari?> Hari" readonly>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Jam</label>
                        </div>
                        
                        <div class="col-md-2">
                          <div class="input-append bootstrap-timepicker">
                            <input name="" id="timepicker2" type="text" class="timepicker-24" value="<?php echo $user->jam_mulai?>" disabled="disabled">
                            <span class="add-on">
                                <i class="icon-time"></i>
                            </span>
                          </div>
                        </div>

                        <div class="col-md-1">
                          <label class="form-label text-center">s/d</label>
                        </div>

                        <div class="col-md-2">
                          <div class="input-append bootstrap-timepicker">
                            <input name="" id="timepicker2" type="text" class="timepicker-24" value="<?php echo $user->jam_akhir?>" disabled="disabled">
                            <span class="add-on">
                                <i class="icon-time"></i>
                            </span>
                          </div>
                        </div>
                      </div>

                      <?php if(!empty($user->approval_status_id_hrd)){?>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Approval Status(HRD)</label>
                        </div>
                        <div class="col-md-7">
                          <input name="" id="alamat_training" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->approval_status_hrd; ?>" disabled="disabled">
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($user->note_app_hrd)){?>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Note (HRD) : </label>
                        </div>
                        <div class="col-md-7">
                          <textarea name="" class="custom-txtarea-form" placeholder="Note HRD isi disini" disabled="disabled"><?php echo $user->note_app_hrd?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                    <?php } ?>
                  </div>

                    <div class="form-actions">
                      <div class="row form-row">
                          <div class="col-md-12 text-center">
                          <?php  if($user->is_app_lv1 == 1 && get_nik($sess_id) == $user->user_app_lv1){?>
                              <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submittrainingModalLv1"><i class='icon-edit'> Edit Approval</i></div>
                            <?php }elseif($user->is_app_lv2 == 1 && get_nik($sess_id) == $user->user_app_lv2){?>
                              <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submittrainingModalLv2"><i class='icon-edit'> Edit Approval</i></div>
                            <?php }elseif($user->is_app_lv3 == 1 && get_nik($sess_id) == $user->user_app_lv3){?>
                              <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submittrainingModalLv3"><i class='icon-edit'> Edit Approval</i></div>
                            <?php }elseif($user->is_app_hrd == 1 && get_nik($sess_id) == $user->user_app_hrd){?>
                              <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submittrainingModalHrd"><i class='icon-edit'> Edit Approval</i></div>
                            <?php } ?>
                          </div>
                      </div>

                      <div class="col-md-12 text-center"><div class="col-md-12 text-center"><span class="semi-bold">Mengetahui,</span><br/><br/><br/></div>
                      <div class="row wf-training">
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            $approved = assets_url('img/approved_stamp.png');
                            $rejected = assets_url('img/rejected_stamp.png');
                            if(!empty($user->user_app_lv1) && $user->is_app_lv1 == 0 && get_nik($sess_id) == $user->user_app_lv1){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submittrainingModalLv1"><i class="icon-ok"></i>Submit</div>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Supervisor)</span>
                            <?php }elseif(!empty($user->user_app_lv1) && $user->is_app_lv1 == 1){
                              echo ($user->approval_status_id_lv1 == 1)?"<img class=approval_img_md src=$approved>":(($user->approval_status_id_lv1 == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv1)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_lv1)?></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Supervisor)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv1))?'(Supervisor)':'';?></span>
                            <?php } ?>
                          </p>
                        </div>

                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($user->user_app_lv2) && $user->is_app_lv2 == 0 && get_nik($sess_id) == $user->user_app_lv2){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submittrainingModalLv2"><i class="icon-ok"></i>Submit</div>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Ka. Bagian)</span>
                            <?php }elseif(!empty($user->user_app_lv2) && $user->is_app_lv2 == 1){
                              echo ($user->approval_status_id_lv2 == 1)?"<img class=approval_img_md src=$approved>":(($user->approval_status_id_lv2 == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv2)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_lv2)?></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Ka. Bagian)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv2))?'(Ka. Bagian)':'';?></span>
                            <?php } ?>
                          </p>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($user->user_app_lv3) && $user->is_app_lv3 == 0 && get_nik($sess_id) == $user->user_app_lv3){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submittrainingModalLv3"><i class="icon-ok"></i>Submit</div>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($user->user_app_lv3)?>)</span>
                            <?php }elseif(!empty($user->user_app_lv3) && $user->is_app_lv3 == 1){
                              echo ($user->approval_status_id_lv3 == 1)?"<img class=approval_img_md src=$approved>":(($user->approval_status_id_lv3 == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv3)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_lv3)?></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($user->user_app_lv3)?>)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv3))?get_user_position($user->user_app_lv3):'';?></span>
                            <?php } ?>
                          </p>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if($user->is_app_hrd == 0 && is_admin()){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submittrainingModalHrd"><i class="icon-ok"></i>Submit</div>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }elseif($user->is_app_hrd == 1){
                              echo ($user->approval_status_id_hrd == 1)?"<img class=approval_img_md src=$approved>":(($user->approval_status_id_hrd == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_hrd)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_hrd)?></span><br/>
                              <span class="semi-bold"></span><br/>
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
<div class="modal fade" id="submittrainingModalHrd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Approval HRD - Form training</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" id="formAppHrd">
            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label text-right">Tipe Pelatihan</label>
              </div>
              <div class="col-md-9">
                <select name="training_type" class="select2" id="training_type" style="width:100%">
                    <?php 
                    $tanggal_mulai = ($user->tanggal_mulai == '0000-00-00')?date('Y-m-d'):$user->tanggal_mulai;
                    $tanggal_akhir = ($user->tanggal_akhir == '0000-00-00')?date('Y-m-d'):$user->tanggal_akhir;
                    if($training_type->num_rows()>0){
                        foreach ($training_type->result_array() as $key => $value) {
                        $selected = ($user->training_type_id <> 0 && $user->training_type_id == $value['id']) ? 'selected = selected' : '';
                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                        }}else{
                        echo '<option value="0">'.'No Data'.'</option>';
                        }
                        ?>
                </select>
              </div>
            </div>
            <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Penyelenggara</label>
                    </div>
                    <div class="col-md-9">
                      <div class="radio">
                          <?php if($penyelenggara->num_rows()>0){
                          foreach($penyelenggara->result() as $row){
                           $checked = ($user->penyelenggara_id<>0 && $user->penyelenggara_id == $row->id) ? 'checked = checked' : '';
                        ?>
                        <input id="penyelenggara-<?php echo $row->id?>" type="radio" name="penyelenggara" value="<?php echo $row->id?>"  <?php echo $checked?>>
                        <label for="penyelenggara-<?php echo $row->id?>"><?php echo $row->title?></label>
                        <?php }}else{?>
                        <input id="penyelenggara" type="radio" name="penyelenggara" value="0" checked="checked"  required>
                        <label for="penyelenggara">No Data</label>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Pembiayaan</label>
                    </div>
                    <div class="col-md-9">
                      <select name="pembiayaan" class="select2" id="pembiayaan" style="width:100%" >
                          <?php if($pembiayaan->num_rows()>0){
                              foreach ($pembiayaan->result_array() as $key => $value) {
                              $selected = ($user->pembiayaan_id <> 0 && $user->pembiayaan_id == $value['id']) ? 'selected = selected' : '';
                              echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                              }}else{
                              echo '<option value="0">'.'No Data'.'</option>';
                              }
                              ?>

                      </select>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Tipe Ikatan Dinas</label>
                    </div>
                    <div class="col-md-9">
                      <select name="ikatan" class="select2" id="ikatan" style="width:100%" >
                          <?php if($ikatan->num_rows()>0){
                              foreach ($ikatan->result_array() as $key => $value) {
                              $selected = ($user->ikatan_dinas_id <> 0 && $user->ikatan_dinas_id == $value['id']) ? 'selected = selected' : '';
                              echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                              }}else{
                              echo '<option value="0">'.'No Data'.'</option>';
                              }
                              ?>

                      </select>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Waktu</label>
                    </div>
                    <div class="col-md-9">
                      <select name="waktu" class="select2" id="waktu" style="width:100%" >
                          <?php if($waktu->num_rows()>0){
                              foreach ($waktu->result_array() as $key => $value) {
                              $selected = ($user->waktu_id <> 0 && $user->waktu_id == $value['id']) ? 'selected = selected' : '';
                              echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                              }}else{
                              echo '<option value="0">'.'No Data'.'</option>';
                              }
                              ?>

                      </select>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label for="besar_biaya" class="form-label text-right">Besar Biaya (Rp.)</label>
                    </div>
                    <div class="col-md-9">
                      <input name="besar_biaya" id="besar_biaya" type="text"  class="form-control" placeholder="Besar biaya (Rp.)" value="<?php echo $user->besar_biaya?>"  required>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Tempat Pelaksanaan</label>
                    </div>
                    <div class="col-md-9">
                      <input name="tempat" id="tempat" type="text"  class="form-control" placeholder="Tempat Pelaksanaan" value="<?php echo $user->tempat?>"  required>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Nama Narasumber</label>
                    </div>
                    <div class="col-md-9">
                      <input name="narasumber" id="tempat" type="text"  class="form-control" placeholder="Nama Narasumber" value="<?php echo $user->narasumber?>" required>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Nama Vendor</label>
                    </div>
                    <div class="col-md-9">
                      <input name="vendor" id="vendor" type="text"  class="form-control" placeholder="Nama Vendor" value="<?php echo $user->vendor?>" required>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Waktu Pelaksanaan</label>
                    </div>
                    <div class="col-md-3">
                      <div class="input-with-icon right">
                          <div class="input-append success date no-padding">
                              <input type="text" class="datepicker" id="tanggal_mulai" name="tanggal_mulai" value="<?php echo $tanggal_mulai?>" required>
                              <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                          </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label class="form-label text-center">s/d</label>
                    </div>
                    <div class="col-md-3">
                      <div class="input-with-icon right">
                          <div class="input-append success date no-padding">
                              <input type="text" class="datepicker" id="tanggal_akhir" name="tanggal_akhir" value="<?php echo $tanggal_akhir?>" required>
                              <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Lama Pelaksanaan</label>
                    </div>
                    <div class="col-md-2">
                      <input name="lama_training_bulan" id="lama_training_bulan" type="text"  class="form-control text-center" value="<?php echo $user->lama_training_bulan?> Bulan" readonly>
                    </div>
                    <div class="col-md-2">
                      <input name="lama_training_hari" id="lama_training_hari" type="text"  class="form-control text-center" value="<?php echo $user->lama_training_hari?> Hari" readonly>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Jam</label>
                    </div>
                    
                    <div class="col-md-3">
                      <div class="input-append bootstrap-timepicker">
                        <input name="jam_mulai" id="timepicker2" type="text" class="timepicker-24" value="<?php echo $user->jam_mulai?>" required>
                        <span class="add-on">
                            <i class="icon-time"></i>
                        </span>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <label class="form-label text-center">s/d</label>
                    </div>

                    <div class="col-md-3">
                      <div class="input-append bootstrap-timepicker">
                        <input name="jam_akhir" id="timepicker2" type="text" class="timepicker-24" value="<?php echo $user->jam_akhir?>" required>
                        <span class="add-on">
                            <i class="icon-time"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-left">Status Approval </label>
                    </div>
                    <div class="col-md-9">
                      <div class="radio">
                        <?php 
                        if($approval_status->num_rows() > 0){
                          foreach($approval_status->result() as $app){
                            $checked = ($app->id <> 0 && $app->id == $user->approval_status_id_hrd) ? 'checked = "checked"' : '';
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
                      <label class="form-label text-left">Note (HRD) : </label>
                    </div>
                    <div class="col-md-12">
                      <textarea name="note_hrd" class="custom-txtarea-form" placeholder="Note HRD isi disini"><?php echo $user->note_app_hrd?></textarea>
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
<!--end edit modal-->   


<!--approval training Modal Lv1 -->
<div class="modal fade" id="submittrainingModalLv1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form training - Supervisor</h4>
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
                      $checked = ($app->id <> 0 && $app->id == $user->approval_status_id_lv1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv1<?php echo $app->id?>" type="radio" name="app_status_lv1" value="<?php echo $app->id?>" <?php echo $checked?>>
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
                <label class="form-label text-left">Note (Supervisor) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_lv1" class="custom-txtarea-form" placeholder="Note Ka. Bagian isi disini"><?php echo $user->note_app_lv1?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="btn_app_lv1"  class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal lv1--> 

<!--approval training Modal Lv2 -->
<div class="modal fade" id="submittrainingModalLv2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form training - Ka. Bagian</h4>
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
                      $checked = ($app->id <> 0 && $app->id == $user->approval_status_id_lv2) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv2<?php echo $app->id?>" type="radio" name="app_status_lv2" value="<?php echo $app->id?>" <?php echo $checked?>>
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
                <label class="form-label text-left">Note (Ka. Bagian) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_lv2" class="custom-txtarea-form" placeholder="Note Ka. Bagian isi disini"><?php echo $user->note_app_lv2?></textarea>
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

<!--approval training Modal Lv2 -->
<div class="modal fade" id="submittrainingModalLv3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form training - Atasan Lainnya</h4>
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
                      $checked = ($app->id <> 0 && $app->id == $user->approval_status_id_lv3) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv3<?php echo $app->id?>" type="radio" name="app_status_lv3" value="<?php echo $app->id?>" <?php echo $checked?>>
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
                <label class="form-label text-left">Note (Ka. Bagian) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_lv3" class="custom-txtarea-form" placeholder="Note atasan isi disini"><?php echo $user->note_app_lv3?></textarea>
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
<!--end approve modal Lv2--> 
<?php endforeach; ?>
<?php } ?>
