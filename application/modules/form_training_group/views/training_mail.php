      <div id="container">
        <div class="row">
        <div class="col-md-12">
          <div class="grid simple">
            <div class="grid-title no-border">
              <h4>View Permintaan <span class="semi-bold"><a href="<?php echo site_url('form_training_group')?>">Pelatihan (Group)</a></span></h4>
            </div>
            <div class="grid-body no-border">
            <?php
              if($_num_rows>0){
                foreach($form_training_group as $user):
                $peserta = getAll('users_training_group', array('id'=>'where/'.$user->id))->row('user_peserta_id');
                $p = explode(",", $peserta);
                $disabled = 'disabled="disabled"';
                ?>
              <form class="form-no-horizontal-spacing" id=""> 
                <div class="row column-seperation">
                  <div class="col-md-12">
                    <form class="form-no-horizontal-spacing" id=""> 
                    <div class="row column-seperation">
                      <div class="col-md-4">
                        <h4>Yang Mengajukan Pelatihan</h4>      
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Nama</label>
                          </div>
                          <div class="col-md-9">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($user->user_pengaju_id)?>" disabled="disabled">
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Dept/Bagian</label>
                          </div>
                          <div class="col-md-9">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_organization(get_nik($user->user_pengaju_id))?>" disabled="disabled">
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Jabatan</label>
                          </div>
                          <div class="col-md-9">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_position(get_nik($user->user_pengaju_id))?>" disabled="disabled">
                          </div>
                        </div>
                      </div>

                    <div class="col-md-8">
                        <h4>Peserta Pelatihan</h4>
                        <div class="row form-row">
                          <div class="col-md-12" >
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th width="10%">NIK</th>
                                  <th width="30%">Nama</th>
                                  <th width="30%">Dept/Bagian</th>
                                  <th width="30%">Jabatan</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php for($i=0;$i<sizeof($p);$i++):?>
                                <tr>
                                  <td><?php echo $p[$i]?></td>
                                  <td><?php echo get_name($p[$i])?></td>
                                  <td><?php echo get_user_organization($p[$i])?></td>
                                  <td><?php echo get_user_position($p[$i])?></td> 
                                </tr>
                              <?php endfor?>
                              </tbody>
                            </table>
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

                        <?php if(!empty($user->note_app_lv1)){?>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Note Atasan Langsung : </label>
                          </div>
                          <div class="col-md-9">
                            <textarea name="" class="form-control" disabled="disabled"><?php echo $user->note_app_lv1?></textarea>
                          </div>
                        </div>
                        <?php } ?>

                        <?php if(!empty($user->note_app_lv2)){?>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Note Atasan Tidak Langsung : </label>
                          </div>
                          <div class="col-md-9">
                            <textarea name="" class="form-control" disabled="disabled"><?php echo $user->note_app_lv2?></textarea>
                          </div>
                        </div>
                        <?php } ?>

                        <?php if(!empty($user->note_app_lv3)){?>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Note Atasan Lainnya : </label>
                          </div>
                          <div class="col-md-9">
                            <textarea name="" class="form-control" disabled="disabled"><?php echo $user->note_app_lv3?></textarea>
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
                  </form>
                </div>
               </div>
            </div>
          </div>

          <?php endforeach; } ?>