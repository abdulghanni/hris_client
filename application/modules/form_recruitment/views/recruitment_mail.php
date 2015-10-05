<div id="container">
        <div class="row">
        <div class="col-md-12">
          <div class="grid simple">
            <div class="grid-title no-border">
              <h4>Form Permintaan <span class="semi-bold"><a href="<?php echo site_url('form_recruitment')?>">SDM Baru</a></span></h4><br/>
              No : <?= get_form_no($id) ?>
            </div>
            <div class="grid-body no-border">
              <?php
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formaddrecruitment');
                echo form_open('form_recruitment/add', $att);
                if($_num_rows>0){
                foreach($recruitment as $row):
                ?>
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Unit Bisnis</label>
                      </div>
                      <div class="col-md-6">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo get_bu_name(substr($row->bu_id,0,2))?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Dept / Bagian</label>
                      </div>
                      <div class="col-md-6">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo get_organization_name($row->organization_id)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-6">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo get_position_name($row->position_id)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jumlah yang dibutuhkan</label>
                      </div>
                      <div class="col-md-4">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo $row->jumlah?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Status</label>
                      </div>
                      <div class="col-md-4">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo $row->status?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Urgensi (Kebutuhan)</label>
                      </div>
                      <div class="col-md-10">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo $row->urgensi?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <h4><strong>Kualifikasi :</strong></h4>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jenis Kelamin</label>
                      </div>
                      <?php 
                        if($jenis_kelamin->num_rows()>0){
                          foreach($jenis_kelamin->result() as $jk):?>
                      <div class="col-md-1">
                        <div class="checkbox check-primary checkbox-circle" >
                          <input name="jenis_kelamin[]" class="checkbox1" type="checkbox" id="jenis_kelamin<?php echo $jk->id ?>" value="<?php echo $jk->id ?>" checked="checked" disabled="disabled">
                            <label for="jenis_kelamin<?php echo $jk->id ?>"><?php echo $jk->title?></label>
                          </div>
                      </div>
                    <?php endforeach;} ?>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Pendidikan</label>
                      </div>
                      <?php 
                          if($pendidikan->num_rows()>0){
                            foreach($pendidikan->result() as $p):?>
                        <div class="col-md-1">
                          <div class="checkbox check-primary checkbox-circle" >
                            <input name="pendidikan[]" class="checkbox1" type="checkbox" id="pendidikan<?php echo $p->id ?>" value="<?php echo $p->id ?>" checked="checked" disabled="disabled">
                              <label for="pendidikan<?php echo $p->id ?>"><?php echo $p->title?></label>
                            </div>
                        </div>
                      <?php endforeach;} ?>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jurusan</label>
                      </div>
                      <div class="col-md-2">
                        <input name="jurusan" id="form3LastName" type="text"  class="form-control" placeholder="Jurusan" value="<?php echo $row->jurusan?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">IPK(Min)</label>
                      </div>
                      <div class="col-md-2">
                        <input name="ipk" id="form3LastName" type="text"  class="form-control" placeholder="IPK" value="<?php echo $row->ipk?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Toefl(Min)</label>
                      </div>
                      <div class="col-md-2">
                        <input name="toefl" id="form3LastName" type="text"  class="form-control" placeholder="Toefl" value="<?php echo $row->toefl?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <h4><strong>Kemampuan Teknis :</strong></h4>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Komputer</label>
                      </div>
                      <div class="col-md-10">
                        <?php 
                          if($komputer->num_rows()>0){
                            foreach($komputer->result() as $p):?>
                        <div class="col-md-2">
                          <div class="checkbox check-primary checkbox-circle" >
                            <input name="komputer[]" class="checkbox1" type="checkbox" id="komputer<?php echo $p->id ?>" value="<?php echo $p->id ?>" checked="checked" disabled="disabled">
                              <label for="komputer<?php echo $p->id ?>"><?php echo $p->title?></label>
                            </div>
                        </div>
                      <?php endforeach;} ?>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Bahasa Pemrograman</label>
                      </div>
                      <div class="col-md-10">
                        <input name="pemrograman" id="form3LastName" type="text"  class="form-control" placeholder="pemrograman" value="<?php echo $row->bahasa_pemrograman?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Komunikasi</label>
                      </div>
                      <div class="col-md-10">
                        <input name="komunikasi" id="form3LastName" type="text"  class="form-control" placeholder="Komunikasi" value="<?php echo $row->komunikasi?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Grafika</label>
                      </div>
                      <div class="col-md-10">
                        <input name="grafika" id="form3LastName" type="text"  class="form-control" placeholder="Grafika" value="<?php echo $row->grafika?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Desain/Setting</label>
                      </div>
                      <div class="col-md-10">
                        <input name="desain" id="form3LastName" type="text"  class="form-control" placeholder="Desain/Setting" value="<?php echo $row->desain?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Brevet</label>
                      </div>
                      <div class="col-md-10">
                        <input name="brevet" id="form3LastName" type="text"  class="form-control" placeholder="brevet" value="<?php echo $row->brevet?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Lain-lain</label>
                      </div>
                      <div class="col-md-10">
                        <input name="lain-lain" id="form3LastName" type="text"  class="form-control" placeholder="Lain-lain" value="<?php echo $row->lain_lain?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Portfolio</label>
                      </div>
                      <div class="col-md-10">
                        <input name="portofolio" id="form3LastName" type="text"  class="form-control" placeholder="Portfolio" value="<?php echo $row->portofolio?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Pengalaman</label>
                      </div>
                      <div class="col-md-2">
                        <input name="pengalaman" id="form3LastName" type="text"  class="form-control" placeholder="Bidang" value="<?php echo $row->pengalaman?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">selama</label>
                      </div>
                      <div class="col-md-1">
                        <input name="lama_pengalaman" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $row->lama_pengalaman?>" disabled="disabled"> 
                      </div>
                      <div class="col-md-1">
                        <label class="form-label text-right">Tahun</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Job Desc</label>
                      </div>
                      <div class="col-md-10">
                        <textarea name="job_desc" id="text-editor" placeholder="Enter text ..." class="form-control" rows="10" disabled="disabled"><?php echo $row->job_desc?></textarea>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Catatan Pengaju</label>
                      </div>
                      <div class="col-md-10">
                        <textarea name="note_pengaju" id="text-editor" placeholder="Enter text ..." class="form-control" rows="10" disabled="disabled"><?php echo $row->note_pengaju?></textarea>
                      </div>
                    </div>

                    <?php 
                      for($i=1;$i<6;$i++):
                      $note_lv = 'note_lv'.$i;
                      $user_lv = 'user_app_lv'.$i;
                      if(!empty($row->$note_lv)){?>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Note (<?php echo strtok(get_name($row->$user_lv), " ")?>):</label>
                        </div>
                        <div class="col-md-10">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $row->$note_lv ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                    <?php endfor;?>
                      <?php if(!empty($row->note_hrd)){?>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Note (hrd): </label>
                        </div>
                        <div class="col-md-10">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $row->note_hrd ?></textarea>
                        </div>
                      </div>
                      <?php } ?>

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
                      <span class="semi-bold">(<?php echo get_user_position(get_nik($row->user_id))?>)</span>
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
                        echo ($row->approval_status_id_lv1 == 1)?"<img class=approval-img src=$approved>": (($row->approval_status_id_lv1 == 2) ? "<img class=approval-img src=$rejected>"  : (($row->approval_status_id_lv1 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
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
                  <?php if(!empty($row->user_app_lv2)):?>
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
                        echo ($row->approval_status_id_lv2 == 1)?"<img class=approval-img src=$approved>": (($row->approval_status_id_lv2 == 2) ? "<img class=approval-img src=$rejected>"  : (($row->approval_status_id_lv2 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
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
                  <?php endif; ?>
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
                       echo ($row->approval_status_id_hrd == 1)?"<img class=approval-img src=$approved>": (($row->approval_status_id_hrd == 2) ? "<img class=approval-img src=$rejected>"  : (($row->approval_status_id_hrd == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
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
                    $approved = assets_url('img/approved_stamp.png');
                    $rejected = assets_url('img/rejected_stamp.png');
                    if(!empty($row->user_app_lv3) && $row->is_app_lv3 == 0 && get_nik($sess_id) == $row->user_app_lv3){?>
                     <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv3)?>)</span>
                    <?php }elseif(!empty($row->user_app_lv3) && $row->is_app_lv3 == 1){
                      echo ($row->approval_status_id_lv3 == 1)?"<img class=approval-img src=$approved>": (($row->approval_status_id_lv3 == 2) ? "<img class=approval-img src=$rejected>"  : (($row->approval_status_id_lv3 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
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

      <?php endforeach; } ?>