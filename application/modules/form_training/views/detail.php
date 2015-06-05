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
            <?php
              $disabled = 'disabled="disabled"';
              if($form_training->num_rows()>0){
                foreach($form_training->result() as $user){
                ?>
              <form class="form-no-horizontal-spacing" id=""> 
                <div class="row column-seperation">
                  <div class="col-md-12">
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">NIK</label>
                      </div>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="start_cuti" value="<?php echo (!empty($user_info))?$user_info['EMPLID']:'-';?>" disabled="disabled">
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
                  </div>
                </div>
                <div clas="row column-seperation">
                  <div class="grid-title no-border">
                    <h4>Diisi oleh HRD</h4>
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
                      <input name="narasumber_update" id="tempat" type="text"  class="form-control" placeholder="Nama Narasumber" value="<?php echo $user->narasumber?>" disabled="disabled">
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Nama Vendor</label>
                    </div>
                    <div class="col-md-9">
                      <input name="vendor_update" id="vendor_update" type="text"  class="form-control" placeholder="Nama Vendor" value="<?php echo $user->vendor?>" disabled="disabled">
                    </div>
                  </div>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Waktu Pelaksanaan</label>
                    </div>
                    <div class="col-md-3">
                      <input type="text" id="tanggal_mulai_update" name="tanggal_mulai_update" value="<?php echo dateIndo($user->tanggal_mulai)?>" disabled="disabled">
                    </div>
                    <div class="col-md-2">
                      <label class="form-label text-center">s/d</label>
                    </div>
                    <div class="col-md-3">
                       <input type="text" id="tanggal_akhir_update" name="tanggal_akhir_update" value="<?php echo dateIndo($user->tanggal_akhir)?>" disabled="disabled">
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
                        <input name="jam_mulai_update" id="timepicker2" type="text" class="timepicker-24" value="<?php echo $user->jam_mulai?>" disabled="disabled">
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
                        <input name="jam_akhir_update" id="timepicker2" type="text" class="timepicker-24" value="<?php echo $user->jam_akhir?>" disabled="disabled">
                        <span class="add-on">
                            <i class="icon-time"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <?php if(!empty($user->approval_status_id_lv2)){?>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Approval Status</label>
                    </div>
                    <div class="col-md-9">
                      <input name="approval_status" id="alamat_cuti" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->approval_status_lv2; ?>" disabled="disabled">
                    </div>
                  </div>
                  <?php } ?>

                  <?php if(!empty($user->note_app_lv2)){?>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <label class="form-label text-right">Note (HRD) : </label>
                    </div>
                    <div class="col-md-9">
                      <textarea name="notes_hrd_update" class="custom-txtarea-form" placeholder="Note HRD isi disini" disabled="disabled"><?php echo $user->note_app_lv2?></textarea>
                    </div>
                  </div>
                  <?php } ?>
              </div>
              <!-- end separation -->
                
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
                          <p class="wf-approve-sp">
                            <?php if($user->is_app_lv1==1){?>
                            <span class="semi-bold"><?php echo $name_app_lv1?></span><br/>
                            <span class="small"><?php echo dateIndo($user->date_app_lv1)?></span>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold">(Supervisor)</span>
                            <?php } ?>
                          </p>
                        </div>
                        <div class="col-md-4">
                          Mengetahui HRD,<br/><br/>
                          <p class="wf-approve-sp">
                            <?php if($user->is_app_lv2==1){?>
                            <span class="semi-bold"><?php echo $name_app_lv2?></span><br/>
                            <span class="small"><?php echo dateIndo($user->date_app_lv2)?></span>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold">(HRD)</span>
                            <?php } ?>
                          </p>
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