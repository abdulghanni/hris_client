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
              <h4>View Permintaan <a href="<?php echo site_url('form_training_group')?>"><span class="semi-bold">Pelatihan</span></a></h4>
            </div>
            
            <div class="grid-body no-border">
            <form class="form-no-horizontal-spacing" id="formAppLv2"> 
              <?php
              if($form_training_group->num_rows()>0){
                foreach($form_training_group->result() as $user){
                  if($user->is_app_lv2 != 0){
                    $disabled = 'disabled="disabled"';
                  }else{
                    $disabled = '';
                  }

                  $approval_id = $user->approval_status_id_lv2;
                  $notes_hrd = $user->note_app_lv2;
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
                      <label class="form-label text-right">Nama Peserta Training</label>
                    </div>
                    <div class="col-md-9">
                    <?php 
                    $peserta = getAll('users_training_group', array('id'=>'where/'.$user->id))->row('user_peserta_id');
                    $p = explode(",", $peserta);
                    for($i=0;$i<sizeof($p);$i++):?>
                    <div class="col-md-3">
                      <div class="checkbox check-primary checkbox-circle" >
                        <input name="peserta[]" class="checkbox1" type="checkbox" id="peserta<?php echo $p[$i] ?>" checked disabled>
                          <label for="peserta<?php echo $p[$i] ?>"><?php echo get_name($p[$i])?></label>
                        </div>
                    </div>
                    <?php endfor; ?>
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
                      <label class="form-label text-right">Approval Status(SPV)</label>
                    </div>
                    <div class="col-md-9">
                      <input name="approval_status" id="alamat_cuti" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->approval_status_lv1; ?>" disabled="disabled">
                    </div>
                  </div>
                  <?php } ?>

                  <?php if(!empty($user->note_app_lv1)){?>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Note (SPV) : </label>
                    </div>
                    <div class="col-md-9">
                      <textarea name="notes_hrd_update" class="custom-txtarea-form" placeholder="Note HRD isi disini" disabled="disabled"><?php echo $user->note_app_lv1?></textarea>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>

              <div clas="row column-seperation">
                  <div class="grid-title no-border">
                    <h4>Diisi oleh HRD</h4>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Tipe Pelatihan</label>
                    </div>
                    <div class="col-md-9">
                      <select name="training_type" class="select2" id="training_type" style="width:100%" <?php echo $disabled?>>
                          <?php if($training_type->num_rows()>0){
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
                        <input id="penyelenggara<?php echo $row->id?>" type="radio" name="penyelenggara" value="<?php echo $row->id?>" <?php echo $disabled?> <?php echo $checked?>>
                        <label for="penyelenggara<?php echo $row->id?>"><?php echo $row->title?></label>
                        <?php }}else{?>
                        <input id="penyelenggara" type="radio" name="penyelenggara" value="0" checked="checked" <?php echo $disabled?> required>
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
                      <select name="pembiayaan" class="select2" id="pembiayaan" style="width:100%" <?php echo $disabled?>>
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
                      <label for="besar_biaya" class="form-label text-right">Besar Biaya (Rp.)</label>
                    </div>
                    <div class="col-md-9">
                      <input name="besar_biaya" id="besar_biaya" type="text"  class="form-control" placeholder="Besar biaya (Rp.)" value="<?php echo $user->besar_biaya?>" <?php echo $disabled?> required>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Tempat Pelaksanaan</label>
                    </div>
                    <div class="col-md-9">
                      <input name="tempat" id="tempat" type="text"  class="form-control" placeholder="Tempat Pelaksanaan" value="<?php echo $user->tempat?>" <?php echo $disabled?> required>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Nama Narasumber</label>
                    </div>
                    <div class="col-md-9">
                      <input name="narasumber" id="tempat" type="text"  class="form-control" placeholder="Nama Narasumber" value="<?php echo $user->narasumber?>" <?php echo $disabled?> required>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Nama Vendor</label>
                    </div>
                    <div class="col-md-9">
                      <input name="vendor" id="tempat" type="text"  class="form-control" placeholder="Nama Vendor" value="<?php echo $user->vendor?>" <?php echo $disabled?> required>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Waktu Pelaksanaan</label>
                    </div>
                    <div class="col-md-4">
                      <div class="input-with-icon right">
                          <div class="input-append success date no-padding">
                              <input type="text" class="datepicker" id="tanggal_mulai" name="tanggal_mulai" value="<?php echo ($user->tanggal_mulai == '0000-00-00')?'':$user->tanggal_mulai?>" <?php echo $disabled?> required>
                              <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                          </div>
                      </div>
                    </div>
                    <div class="col-md-1">
                      <label class="form-label">s/d</label>
                    </div>
                    <div class="col-md-4">
                      <div class="input-with-icon right">
                          <div class="input-append success date no-padding">
                              <input type="text" class="datepicker" id="tanggal_akhir" name="tanggal_akhir" value="<?php echo $user->tanggal_akhir?>" <?php echo $disabled?> required>
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
                    
                    <div class="col-md-4">
                      <div class="input-append bootstrap-timepicker">
                        <input name="jam_mulai" id="timepicker2" type="text" class="timepicker-24" value="<?php echo $user->jam_mulai?>" <?php echo $disabled?> required>
                        <span class="add-on">
                            <i class="icon-time"></i>
                        </span>
                      </div>
                    </div>

                    <div class="col-md-1">
                      <label class="form-label">s/d</label>
                    </div>

                    <div class="col-md-4">
                      <div class="input-append bootstrap-timepicker">
                        <input name="jam_akhir" id="timepicker2" type="text" class="timepicker-24" value="<?php echo $user->jam_akhir?>" <?php echo $disabled?> required>
                        <span class="add-on">
                            <i class="icon-time"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <?php if(!empty($user->approval_status_id_lv2)){?>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Status Approval</label>
                    </div>
                    <div class="col-md-9">
                      <input name="approval_status" id="alamat_training" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->approval_status_lv2; ?>" disabled="disabled">
                    </div>
                  </div>
                  <?php }else{?>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Status Approval </label>
                    </div>
                    <div class="col-md-9">
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
                  <?php } ?>


                  <?php if(!empty($user->note_app_lv2)){?>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Note (HRD) : </label>
                    </div>
                    <div class="col-md-9">
                      <textarea name="notes_hrd" class="custom-txtarea-form" placeholder="Note HRD isi disini" disabled="disabled"><?=$notes_hrd?></textarea>
                    </div>
                  </div>
                  <?php }else{ ?>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Note (HRD) : </label>
                    </div>
                    <div class="col-md-9">
                      <textarea name="note_hrd" class="custom-txtarea-form" placeholder="Note HRD isi disini"></textarea>
                    </div>
                  </div>
                  <?php } ?>
                  <?php if($user->is_app_lv2 == 1 && is_admin() == true){?>
                  <div class="row form-row">
                    <div class="col-md-6">
                      &nbsp;
                    </div>
                    <div class="col-md-6">
                      <div class='btn btn-info btn-small' class="text-center" title='Edit Approval' data-toggle="modal" data-target="#edittrainingModal"><i class='icon-edit'> Edit Approval</i></div>
                    </div>
                  </div>
                  <?php } ?>
              </div>

              <!-- end separation -->

              <div class="form-actions">
                <div class="col-md-12 text-center">
                  <div class="row wf-training">
                    <div class="col-md-4">
                      Diusulkan oleh,<br/><br/>
                       <p class="wf-approve-sp">
                          <span class="semi-bold"><?php echo $user->name?></span><br/>
                          <span class="small"><?php echo dateIndo($user->created_on)?></span><br/>
                        </p>
                    </div>
                    <div class="col-md-4">
                      Persetujuan atasan,<br/><br/>
                      <p class="wf-approve-sp">
                        <?php 
                            $approved = assets_url('img/approved_stamp.png');
                            $rejected = assets_url('img/rejected_stamp.png');
                            if($user->is_app_lv1==1){
                              echo ($user->approval_status_id_lv1 == 1)? "<img class=approval_img src=$approved>":(($user->approval_status_id_lv1 == 2) ? "<img class=approval_img src=$rejected>":'');?><br/>
                            <span class="semi-bold"><?php echo get_name($user->user_app_lv1)?></span><br/>
                        <span class="small"><?php echo dateIndo($user->date_app_lv1)?></span>
                        <?php }else{?>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span>
                        <?php } ?>
                      </p>
                    </div>
                    <div class="col-md-4">
                          Mengetahui HRD,<br/><br/>
                          <?php if($user->is_app_lv2==1){
                            echo ($user->approval_status_id_lv2 == 1)? "<img class=approval_img src=$approved>":(($user->approval_status_id_lv2 == 2) ? "<img class=approval_img src=$rejected>":'');?><br/>
                            <span class="semi-bold"><?php echo get_name($user->user_app_lv2)?></span><br/>
                          <span class="small"><?php echo dateIndo($user->date_app_lv2)?></span>
                          <?php }elseif($user->is_app_lv2 == 1 && is_admin() == false){?>
                          <span class="semi-bold"><?php echo get_name($user->user_app_lv2)?></span><br/>
                          <span class="small"><?php echo dateIndo($user->date_app_lv2)?></span>
                          <?php }else{
                            if(is_admin()){?>
                          <button id="btn_app_lv2" class="btn btn-success btn-cons"><i class="icon-ok"></i>Submit</button>
                          <?php }}?>
                    </div>
                  </div>
                </div>
                </div>
                <?php }}?>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- END PAGE --> 
  </div>
</div>

<!-- Edit approval training Modal -->
<div class="modal fade" id="edittrainingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Approval HRD - Form training</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" method="POST" action="<?php echo site_url('form_training_group/update_approve_hrd/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label text-right">Tipe Pelatihan</label>
              </div>
              <div class="col-md-9">
                <select name="training_type_update" class="select2" id="training_type" style="width:100%">
                    <?php if($training_type->num_rows()>0){
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
                        <input id="penyelenggara-<?php echo $row->id?>" type="radio" name="penyelenggara_update" value="<?php echo $row->id?>"  <?php echo $checked?>>
                        <label for="penyelenggara-<?php echo $row->id?>"><?php echo $row->title?></label>
                        <?php }}else{?>
                        <input id="penyelenggara" type="radio" name="penyelenggara_update" value="0" checked="checked"  required>
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
                      <select name="pembiayaan_update" class="select2" id="pembiayaan" style="width:100%" >
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
                      <label for="besar_biaya" class="form-label text-right">Besar Biaya (Rp.)</label>
                    </div>
                    <div class="col-md-9">
                      <input name="besar_biaya_update" id="besar_biaya_update" type="text"  class="form-control" placeholder="Besar biaya (Rp.)" value="<?php echo $user->besar_biaya?>"  required>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Tempat Pelaksanaan</label>
                    </div>
                    <div class="col-md-9">
                      <input name="tempat_update" id="tempat" type="text"  class="form-control" placeholder="Tempat Pelaksanaan" value="<?php echo $user->tempat?>"  required>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Nama Narasumber</label>
                    </div>
                    <div class="col-md-9">
                      <input name="narasumber_update" id="tempat" type="text"  class="form-control" placeholder="Nama Narasumber" value="<?php echo $user->narasumber?>" required>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Nama Vendor</label>
                    </div>
                    <div class="col-md-9">
                      <input name="vendor_update" id="vendor_update" type="text"  class="form-control" placeholder="Nama Vendor" value="<?php echo $user->vendor?>" required>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Waktu Pelaksanaan</label>
                    </div>
                    <div class="col-md-3">
                      <div class="input-with-icon right">
                          <div class="input-append success date no-padding">
                              <input type="text" class="datepicker" id="tanggal_mulai_update" name="tanggal_mulai_update" value="<?php echo $user->tanggal_mulai?>" required>
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
                              <input type="text" class="datepicker" id="tanggal_akhir_update" name="tanggal_akhir_update" value="<?php echo $user->tanggal_akhir?>" required>
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
                      <input name="lama_training_bulan_update" id="lama_training_bulan_update" type="text"  class="form-control text-center" value="<?php echo $user->lama_training_bulan?> Bulan" readonly>
                    </div>
                    <div class="col-md-2">
                      <input name="lama_training_hari_update" id="lama_training_hari_update" type="text"  class="form-control text-center" value="<?php echo $user->lama_training_hari?> Hari" readonly>
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Jam</label>
                    </div>
                    
                    <div class="col-md-3">
                      <div class="input-append bootstrap-timepicker">
                        <input name="jam_mulai_update" id="timepicker2" type="text" class="timepicker-24" value="<?php echo $user->jam_mulai?>" required>
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
                        <input name="jam_akhir_update" id="timepicker2" type="text" class="timepicker-24" value="<?php echo $user->jam_akhir?>" required>
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
                            $checked = ($app->id <> 0 && $app->id == $approval_id) ? 'checked = "checked"' : '';
                            ?>
                        <input id="app_status_update<?php echo $app->id?>" type="radio" name="app_status_update" value="<?php echo $app->id?>" <?php echo $checked?>>
                        <label for="app_status_update<?php echo $app->id?>"><?php echo $app->title?></label>
                        <?php }}else{?>
                        <input id="app_status_update" type="radio" name="app_status_update" value="0">
                        <label for="app_status_update">No Data</label>
                          <?php } ?>
                      </div>
                    </div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label text-left">Note (HRD) : </label>
                    </div>
                    <div class="col-md-12">
                      <textarea name="note_hrd_update" class="custom-txtarea-form" placeholder="Note HRD isi disini"><?php echo $user->note_app_lv2?></textarea>
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


