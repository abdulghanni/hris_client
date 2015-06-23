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
                          <label for="besar_biaya" class="form-label text-right">Besar Biaya (Rp.)</label>
                        </div>
                        <div class="col-md-7">
                          <input name="besar_biaya" id="besar_biaya" type="text"  class="form-control" placeholder="Besar biaya (Rp.)" value="<?php echo $user->besar_biaya?>" <?php echo $disabled?> required>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Tempat Pelaksanaan</label>
                        </div>
                        <div class="col-md-7">
                          <input name="tempat" id="tempat" type="text"  class="form-control" placeholder="Tempat Pelaksanaan" value="<?php echo $user->tempat?>" <?php echo $disabled?> required>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Nama Narasumber</label>
                        </div>
                        <div class="col-md-7">
                          <input name="narasumber_update" id="tempat" type="text"  class="form-control" placeholder="Nama Narasumber" value="<?php echo $user->narasumber?>" disabled="disabled">
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Nama Vendor</label>
                        </div>
                        <div class="col-md-7">
                          <input name="vendor_update" id="vendor_update" type="text"  class="form-control" placeholder="Nama Vendor" value="<?php echo $user->vendor?>" disabled="disabled">
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Waktu Pelaksanaan</label>
                        </div>
                        <div class="col-md-2">
                          <input name="lama_training_bulan_update" id="" type="text"  class="form-control" value="<?php echo dateIndo($user->tanggal_mulai)?>" readonly>
                        </div>
                        <div class="col-md-1">
                          <label class="form-label text-center">s/d</label>
                        </div>
                        <div class="col-md-2">
                           <input name="lama_training_bulan_update" id="" type="text"  class="form-control" value="<?php echo dateIndo($user->tanggal_akhir)?>" readonly>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Lama Pelaksanaan</label>
                        </div>
                        <div class="col-md-2">
                          <input name="lama_training_bulan_update" id="" type="text"  class="form-control text-center" value="<?php echo $user->lama_training_bulan?> Bulan" readonly>
                        </div>
                        <div class="col-md-2">
                          <input name="lama_training_hari_update" id="" type="text"  class="form-control text-center" value="<?php echo $user->lama_training_hari?> Hari" readonly>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Jam</label>
                        </div>
                        
                        <div class="col-md-2">
                          <div class="input-append bootstrap-timepicker">
                            <input name="jam_mulai_update" id="timepicker2" type="text" class="timepicker-24" value="<?php echo $user->jam_mulai?>" disabled="disabled">
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
                            <input name="jam_akhir_update" id="timepicker2" type="text" class="timepicker-24" value="<?php echo $user->jam_akhir?>" disabled="disabled">
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
                          <input name="approval_status" id="alamat_training" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->approval_status_hrd; ?>" disabled="disabled">
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($user->note_app_hrd)){?>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Note (HRD) : </label>
                        </div>
                        <div class="col-md-7">
                          <textarea name="notes_hrd_update" class="custom-txtarea-form" placeholder="Note HRD isi disini" disabled="disabled"><?php echo $user->note_app_hrd?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                    </div>
                    <?php } ?>
                    </div>
                  </form>
                </div>
               </div>
            </div>
        <?php endforeach;}?>