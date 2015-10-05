<div id="container">
        <div class="row">
          <div class="col-md-12">
            <div class="grid simple">
              <div class="grid-title no-border">
                <h4>Form Pengajuan <span class="semi-bold"><a href="<?php echo site_url('form_resignment')?>">Pengunduran Diri</a></span></h4><br/>
              No : <?= get_form_no($id) ?>
              </div>
              <div class="grid-body no-border">
                <?php
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => '');
                echo form_open('form_resignment/add', $att);
                if($_num_rows>0){
                  foreach($form_resignment as $row):
                ?>
                  <div class="row column-seperation">
                    <div class="col-md-6">
                      <h4>Informasi karyawan</h4>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">NIK</label>
                          
                        </div>
                        <div class="col-md-9">
                          <input name="nik" id="form3LastName" type="text"  class="form-control " placeholder="Nama" value="<?php echo get_nik($row->user_id)?>"  disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Nama</label>
                        </div>
                        <div class="col-md-9">
                          <input name="name" id="form3LastName" type="text"  class="form-control " placeholder="Nama" value="<?php echo get_name($row->user_id)?>"  disabled="disabled">
                        </div>
                      </div>          
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Unit Bisnis</label>
                        </div>
                        <div class="col-md-9">
                          <input name="nik" id="form3LastName" type="text"  class="form-control " placeholder="Bussiness Unit Lama" value="<?php echo get_user_bu($user_nik)?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Dept/Bagian</label>
                        </div>
                        <div class="col-md-9">
                            <input name="nik" id="form3LastName" type="text"  class="form-control " placeholder="Bussiness Unit Lama" value="<?php echo get_user_organization($user_nik)?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Jabatan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="nik" id="form3LastName" type="text"  class="form-control " placeholder="Bussiness Unit Lama" value="<?php echo get_user_position($user_nik)?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Tanggal Mulai Kerja</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control " placeholder="Nama" value="<?php echo dateIndo(get_seniority_date($user_nik))?>"  disabled="disabled" >
                        </div>
                      </div>
                      
                      
                    </div>
                    <div class="col-md-6">
                      <h4>Pengunduran Diri Yang Diajukan</h4>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Tanggal Pengajuan</label>
                        </div>
                        <div class="col-md-4">
                          <input name="old_org2" id="old_org2" class="form-control " placeholder="" value="<?php echo dateIndo($row->created_on)?>"  disabled="disabled">
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Tanggal Terakhir Bekerja</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="sandbox-advance" name="date_resign" value="<?php echo dateIndo($row->date_resign)?>" disabled>
                        </div>
                      </div>

                      <div class="row form-row">
                      <div class="col-md-4">
                        <label class="form-label text-left">Alasan Pengunduran Diri</label>
                      </div>
                      <div class="col-md-8">
                         <textarea name="alasan" class="form-control" disabled><?php echo $row->alasan?></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">No. Telp Pengaju</label>
                        </div>
                        <div class="col-md-4">
                          <input name="phone" id="phone" class="form-control " placeholder="" value="<?php echo $row->phone ?>">
                        </div>
                      </div>

                    <?php if($row->is_invited == 1):?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Tanggal Wawancara</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="sandbox-advance" name="date_resign" value="<?php echo dateIndo($row->date_invitation)?>" disabled>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Waktu Wawancara</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="sandbox-advance" name="date_resign" value="<?php echo $row->time_invitation?>" disabled>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Nama Pewawancara</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="sandbox-advance" name="date_resign" value="<?php echo $row->nama_pewawancara?>" disabled>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">No. Telp Pewawancara</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="sandbox-advance" name="date_resign" value="<?php echo $row->telp_pewawancara?>" disabled>
                        </div>
                      </div>
                      <?php if(!empty($row->note_invitation)){?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Catatan undangan wawancara: </label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $row->note_invitation ?></textarea>
                        </div>
                      </div>

                    <?php }endif; ?>

                      <?php 
                      for($i=1;$i<4;$i++):
                      $note_lv = 'note_lv'.$i;
                      $user_lv = 'user_app_lv'.$i;
                      if(!empty($row->$note_lv)){?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Note (<?php echo strtok(get_name($row->$user_lv), " ")?>):</label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $row->$note_lv ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                    <?php endfor;?>
                      <?php if(!empty($row->note_hrd)){?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Note (hrd): </label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $row->note_hrd ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                      
                    </div>
                  </div>

                  <?php if($row->is_app_hrd>0):?>
                  <br/><hr/>
                  <h4>Detail Wawancara Pengajuan Pengunduran Diri</h4>
                  <div class="row column-seperation">
                    <div class="col-md-12">
                        <div class="col-md-12">
                          <label class="form-label text-left">Alasan Berhenti Bekerja</label>
                        </div>
                      
                      <div class="col-md-12">
                        <div class="checkbox check-primary checkbox-circle" >
                          <?php 
                          if($alasan->num_rows()>0){
                            foreach($alasan->result() as $alasan):?>
                            <input name="alasan[]" class="checkbox1" type="checkbox" id="alasan<?php echo $alasan->id ?>" value="<?php echo $alasan->id ?>" checked="checked" disabled="disabled">
                              <label for="alasan<?php echo $alasan->id ?>"><?php echo $alasan->title?></label>
                          <?php endforeach;} ?>
                        </div>
                      </div>

                      
                        <div class="col-md-12">
                          <label class="form-label text-left">Apa alasan utama berhenti bekerja dari perusahaan ini? Jelaskan</label>
                        </div>
                      
                        <div class="col-md-12">
                          <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="desc_resign" disabled="disabled"><?php echo $row->desc_resign?></textarea>
                        </div>

                      
                        <div class="col-md-12">
                          <label class="form-label text-left">Adakah prosedur perusahaan yang membuat anda tidak nyaman atau tidak bisa maksimum menjalankan tugasnya?</label>
                        </div>
                      
                        <div class="col-md-12">
                          <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="procedure_resign" disabled="disabled"><?php echo $row->procedure_resign?></textarea>
                        </div>

                      
                        <div class="col-md-12">
                          <label class="form-label text-left">Adakah hal yang memuaskan dari pekerjaan anda sekarang?</label>
                        </div>
                      
                        <div class="col-md-12">
                          <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="kepuasan_resign" disabled="disabled"><?php echo $row->kepuasan_resign?></textarea>
                        </div>

                      
                        <div class="col-md-12">
                          <label class="form-label text-left">Adakah saran untuk kami?</label>
                        </div>
                      
                        <div class="col-md-12">
                          <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="saran_resign" disabled="disabled"><?php echo $row->saran_resign?></textarea>
                        </div>

                      
                        <div class="col-md-12">
                          <label class="form-label text-left">Apakah anda mempertimbangkan di masa datang untuk kembali bekerja di perusahaan ini? ?</label>
                        </div>
                      
                        <div class="col-md-12">
                          <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="rework_resign" disabled="disabled"><?php echo $row->rework_resign?></textarea>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
                </div>

                <div class="form-actions">
                <div class="row wf-cuti">

                  <div class="col-md-12 text-center">
                  <div class="col-md-3">
                    <p class="wf-approve-sp">
                    <div class="col-md-12"><span class="semi-bold">Pemohon,</span><br/><br/></div>
                      <span class="small"></span><br/>
                      <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="semi-bold"><?php echo get_name($row->user_id)?></span><br/>
                      <span class="small"><?php echo dateIndo($row->created_on)?></span><br/>
                      <span class="semi-bold"><?php echo get_user_position(get_nik($row->user_id))?></span>
                    </p>
                  </div>

                  <div class="col-md-3">
                    <p class="wf-approve-sp">
                    <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                      <?php 
                      $approved = assets_url('img/approved_stamp.png');
                      $rejected = assets_url('img/rejected_stamp.png');
                             $pending = assets_url('img/pending_stamp.png');
                      
                      if(!empty($row->user_app_lv1) && $row->is_app_lv1 == 0 && get_nik($sess_id) == $row->user_app_lv1){?>
                      <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span>
                        <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv1)?>)</span>
                      <?php }elseif(!empty($row->user_app_lv1) && $row->is_app_lv1 == 1){
                        echo ($row->app_status_id_lv1 == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_lv1 == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_lv1 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                      <span class="small"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_lv1)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_lv1)?></span><br/>
                        <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv1)?>)</span>
                      <?php }else{?>
                        <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_lv1)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_lv1)?></span><br/>
                        <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv1)?>)</span>
                      <?php } ?>
                    </p>
                  </div>
                    
                  <div class="col-md-3">
                    <p class="wf-approve-sp">
                    <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                    <?php
                     if(!empty($row->user_app_lv2) && $row->is_app_lv2 == 0 && get_nik($sess_id) == $row->user_app_lv2){?>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold">(Atasan Tidak Langsung)</span>
                      <?php }elseif(!empty($row->user_app_lv2) && $row->is_app_lv2 == 1){
                       echo ($row->app_status_id_lv2 == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_lv2 == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_lv2 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                      <span class="small"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_lv2)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_lv2)?></span><br/>
                        <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv2)?>)</span>
                      <?php }else{?>
                        <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_lv2)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_lv2)?></span><br/>
                        <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv2)?>)</span>
                      <?php } ?>
                    </p>
                  </div>
                    
                  <div class="col-md-3">
                    <p class="wf-approve-sp">
                    <div class="col-md-12"><span class="semi-bold">Diterima HRD</span><br/><br/></div>
                      <?php if($row->is_app_hrd == 0 && $this->approval->approver('recruitment') == $sess_nik){?>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold">(HRD)</span>
                      <?php }elseif($row->is_app_hrd == 1){
                        echo ($row->app_status_id_hrd == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_hrd == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_hrd == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                      <span class="small"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_hrd)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_hrd)?></span><br/>
                        <span class="semi-bold">(HRD)</span>
                      <?php }else{?>
                        <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"><?php echo get_name($this->approval->approver('recruitment'))?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_hrd)?></span><br/>
                        <span class="semi-bold">(HRD)</span>
                      <?php } ?>
                    </p>
                  </div>
                  <!--PST242, PST263, PST2, PST129-->
                </div>
              </div> 

              <br/>
              <?php if(!empty($row->user_app_lv3)){?>
              <div class="col-md-12 text-xenter">
                <div class="col-md-12 text-center">
                  <p class="wf-approve-sp">
                  <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                    <?php 
                    if(!empty($row->user_app_lv3) && $row->is_app_lv3 == 0 && get_nik($sess_id) == $row->user_app_lv3){?>
                      <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv3)?>)</span>
                    <?php }elseif(!empty($row->user_app_lv3) && $row->is_app_lv3 == 1){
                      echo ($row->app_status_id_lv3 == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_lv3 == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_lv3 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                      <span class="small"></span><br/>
                      <span class="semi-bold"><?php echo get_name($row->user_app_lv3)?></span><br/>
                      <span class="small"><?php echo dateIndo($row->date_app_lv3)?></span><br/>
                      <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv3)?>)</span>
                    <?php }else{?>
                        <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_lv3)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_lv3)?></span><br/>
                        <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv3)?>)</span>
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

    <?php endforeach;}?>