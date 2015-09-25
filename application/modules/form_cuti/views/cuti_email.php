<div id="container">
        <div class="row">
          <div class="col-md-12">
            <div class="grid simple">
              <div class="grid-title no-border">
                <h4>Form <a href="<?php echo site_url('form_cuti')?>"><span class="semi-bold">Pengajuan Cuti</span></a></h4>
              </div>
              <div class="grid-body no-border">
                <form class="form-no-horizontal-spacing" id=""> 
                  <div class="row column-seperation">
                    <div class="col-md-5">
                      <h4>Informasi karyawan</h4>
                      <?php if ($_num_rows > 0) {
                      foreach ($form_cuti as $user) :
                      $cur_sess = date('Y');
                      // convert date time
                      $user_nik = get_nik($user->user_id);
                      $submission_date = dateIndo($user->created_on);
                      $date_start_cuti = dateIndo($user->date_mulai_cuti);
                      $date_end_cuti = dateIndo($user->date_selesai_cuti);

                     ?>
                       <div class="row form-row">
                      <div class="col-md-4">
                        <label class="form-label text-right">No</label>
                        
                      </div>
                      <div class="col-md-8">
                        <input name="no" id="no" type="text"  class="form-control" placeholder="No" value="<?php echo $user->id; ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <label class="form-label text-right"><?php echo lang('start_working') ?></label>
                      </div>
                      <div class="col-md-8">
                        <input name="seniority_date" id="seniority_date" type="text"  class="form-control" placeholder="Lama Bekerja" value="<?php echo dateIndo(get_user_sen_date($user_nik)); ?>" disabled="disabled">
                      </div>
                    </div>          
                    <div class="row form-row">
                      <div class="col-md-4">
                        <label class="form-label text-right"><?php echo lang('name') ?></label>
                      </div>
                      <div class="col-md-8">
                        <input name="name" id="name" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($user_nik); ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <label class="form-label text-right"><?php echo lang('dept_div') ?></label>
                      </div>
                      <div class="col-md-8">
                        <input name="organization" id="organization" type="text"  class="form-control" placeholder="Organization" value="<?php echo get_user_organization($user_nik); ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <label class="form-label text-right"><?php echo lang('position') ?></label>
                      </div>
                      <div class="col-md-8">
                        <input name="position" id="position" type="text"  class="form-control" placeholder="Jabatan" value="<?php echo get_user_position($user_nik); ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <label class="form-label text-right"><?php echo lang('cuti_remain') ?></label>
                      </div>
                      <div class="col-md-8">
                        <input name="sisa_cuti" id="sisa_cuti" type="text"  class="form-control" placeholder="Sisa Cuti" value="<?php echo $user->sisa_cuti; ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <label class="form-label text-right">Tanggal pengajuan</label>
                      </div>
                      <div class="col-md-8">
                        <input name="tgl_pengajuan" id="tgl_pengajuan" type="text"  class="form-control" placeholder="Tanggal Pengajuan" value="<?php echo $submission_date; ?>" disabled="disabled">
                      </div>
                    </div>  
                    </div>

                    <div class="col-md-7">
                      <h4>Cuti yang akan diambil</h4>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-right">Tahun</label>
                        </div>
                        <div class="col-md-8">
                          <input name="tahuncuti" id="tahuncuti" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->session_year; ?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-right">Tgl. mulai cuti</label>
                        </div>
                        <div class="col-md-3">
                          <input name="start_cuti" id="start_cuti" type="text"  class="form-control" placeholder="Nama" value="<?php echo $date_start_cuti; ?>" disabled="disabled">
                        </div>
                        <div class="col-md-1">
                          <label class="form-label text-center">s/d</label>
                        </div>
                        <div class="col-md-3">
                          <input name="end_cuti" id="end_cuti" type="text"  class="form-control" placeholder="Nama" value="<?php echo $date_end_cuti; ?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-right">Jml. Hari</label>
                        </div>
                        <div class="col-md-2">
                          <input name="form3PostalCode" id="form3PostalCode" type="text"  class="form-control" placeholder="Jml. Hari" name="jml_hari" value="<?php echo $user->jumlah_hari; ?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-right">Alasan</label>
                        </div>
                        <div class="col-md-8">
                          <input name="alasan" id="alasan" type="text"  class="form-control" placeholder="alasan" value="<?php echo $user->alasan_cuti?>" disabled>
                        </div>
                      </div>
                     <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-right"><?php echo 'Remarks' ?></label>
                        </div>
                        <div class="col-md-8">
                          <input name="remarks" id="remarks" type="text"  class="form-control" placeholder="remarks" value="<?php echo $user->remarks?>" disabled>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-right">Pengganti</label>
                        </div>
                        <div class="col-md-8">
                          <input name="pengganti_cuti" id="pengganti_cuti" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($user->user_pengganti) ?>" disabled="disabled">
                        </div>
                      </div>
                      
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-right"><?php echo 'No. HP' ?></label>
                        </div>
                        <div class="col-md-8">
                          <input name="contact" id="contact" type="text"  class="form-control" placeholder="contact" value="<?php echo $user->contact?>" disabled>
                        </div>
                      </div>
                    
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-right">Alamat selama cuti</label>
                        </div>
                        <div class="col-md-8">
                          <input name="alamat_cuti" id="alamat_cuti" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->alamat_cuti; ?>" disabled="disabled">
                        </div>
                      </div>
                      <?php if(!empty($user->note_app_lv1)){?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-right">Note (Atasan Langsung): </label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="note_lv1" class="form-control" placeholder="Note Atasan Langsung isi disini" disabled="disabled"><?php echo $user->note_app_lv1 ?></textarea>
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($user->note_app_lv2)){?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-right">Note (Atasan Tidak Langsung): </label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="notes_kbg" class="form-control" placeholder="Note Atasan Tidak Langsung isi disini" disabled="disabled"><?php echo $user->note_app_lv2 ?></textarea>
                        </div>
                      </div>
                      <?php } ?>

                      <input type="text" name="app_status" value="1" style="display:none" />

                      <?php if(!empty($user->note_app_lv3)){?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-right">Note (Atasan Lainnya): </label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="notes_hrd" placeholder="Note hrd isi disini" class="form-control" disabled="disabled"><?php echo $user->note_app_lv3 ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                      
                      <?php if(!empty($user->note_app_hrd)){?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-right">Note (HRD): </label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="notes_hrd" placeholder="Note hrd isi disini" class="form-control" disabled="disabled"><?php echo $user->note_app_hrd ?></textarea>
                        </div>
                      </div>
                      <?php } ?>


                    </div>
                  </div>
                  
                  

                      <div class="col-md-12 text-center"><div class="col-md-12 text-center"><span class="semi-bold">Mengetahui,</span><br/><br/><br/></div>
                      <div class="row wf-cuti">
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            $approved = assets_url('img/approved_stamp.png');
                            $rejected = assets_url('img/rejected_stamp.png');
                            if(!empty($user->user_app_lv1) && $user->is_app_lv1 == 0 && get_nik($sess_id) == $user->user_app_lv1){?>
                              
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Atasan Langsung)</span>
                            <?php }elseif(!empty($user->user_app_lv1) && $user->is_app_lv1 == 1){
                              echo ($user->approval_status_id_lv1 == 1)?"<img class=approval_img_md src=$approved>":(($user->approval_status_id_lv1 == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv1)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_lv1)?></span><br/>
                              <span class="semi-bold">(Atasan Langsung)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv1)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_lv1)?></span><br/>
                              <span class="semi-bold">(Atasan Langsung)</span>
                            <?php } ?>
                          </p>
                        </div>

                        <div class="col-md-3">
                        <?php if(!empty($user->user_app_lv2)): ?>
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($user->user_app_lv2) && $user->is_app_lv2 == 0 && get_nik($sess_id) == $user->user_app_lv2){?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Atasan Tidak Langsung)</span>
                            <?php }elseif(!empty($user->user_app_lv2) && $user->is_app_lv2 == 1){
                              echo ($user->approval_status_id_lv2 == 1)?"<img class=approval_img_md src=$approved>":(($user->approval_status_id_lv2 == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv2)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_lv2)?></span><br/>
                              <span class="semi-bold">(Atasan Tidak Langsung)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv2)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_lv2)?></span><br/>
                              <span class="semi-bold">(Atasan Tidak Langsung)</span>
                            <?php } ?>
                          </p>
                        <?php endif;?>
                        </div>
                          
                        <div class="col-md-3">
                        <?php if(!empty($user->user_app_lv2)): ?>
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($user->user_app_lv3) && $user->is_app_lv3 == 0 && get_nik($sess_id) == $user->user_app_lv3){?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($user->user_app_lv3)?>)</span>
                            <?php }elseif(!empty($user->user_app_lv3) && $user->is_app_lv3 == 1){
                              echo ($user->approval_status_id_lv3 == 1)?"<img class=approval_img_md src=$approved>":(($user->approval_status_id_lv3 == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv3)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_lv3)?></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($user->user_app_lv3)?>)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv3)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_lv3)?></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($user->user_app_lv3)?>)</span>
                            <?php } ?>
                          </p>
                        <?php endif; ?>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if($user->is_app_hrd == 0 && $this->approval->approver('cuti') == $sess_nik){?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }elseif($user->is_app_hrd == 1){
                              echo ($user->approval_status_id_hrd == 1)?"<img class=approval_img_md src=$approved>":(($user->approval_status_id_hrd == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_hrd)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_hrd)?></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo get_name($this->approval->approver('cuti'))?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_hrd)?></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php } ?>
                          </p>
                        </div>
                      </div>
                    </div> 
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach;}?>