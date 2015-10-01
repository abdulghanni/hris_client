<div id="container">
        <div class="row">
          <div class="col-md-12">
            <div class="grid simple">
              <div class="grid-title no-border">
                <h4>Form <span class="semi-bold"><a href="<?php echo site_url('form_demotion')?>">Demotion</a></span></h4><br/>
              No : <?= get_form_no($id) ?>
              </div>
              <div class="grid-body no-border">
                <form class="form-no-horizontal-spacing" id=""> 
                  <div class="row column-seperation">
                    <div class="col-md-5">
                      <h4>Informasi karyawan</h4>
                      <?php if($_num_rows>0){
                        foreach($form_demotion as $row):?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">NIK</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_nik($row->user_id)?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Nama</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($row->user_id)?>" disabled="disabled">
                        </div>
                      </div>          
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Unit Bisnis</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_bu($user_nik)?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Dept/Bagian</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_organization($user_nik)?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Jabatan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_position($user_nik)?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Tanggal Mulai Kerja</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo dateIndo(get_user_sen_date($user_nik))?>" disabled="disabled">
                        </div>
                      </div>
                      
                      
                    </div>
                    <div class="col-md-7">
                      <h4>Demotion Yang Diajukan</h4>
                     <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Unit Bisnis Baru</label>
                        </div>
                        <div class="col-md-8">
                          <input name="nik" id="form3LastName" type="text"  class="form-control " placeholder="Nama" value="<?php echo get_bu_name(substr($row->new_bu,0,2))?>" disabled="disabled">
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Dept/Bagian Baru</label>
                        </div>
                        <div class="col-md-8">
                          <input name="nik" id="form3LastName" type="text"  class="form-control " placeholder="Nama" value="<?php echo get_organization_name($row->new_org)?>" disabled="disabled">
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Jabatan Baru</label>
                        </div>
                       <div class="col-md-8">
                          <input name="nik" id="form3LastName" type="text"  class="form-control " placeholder="Nama" value="<?php echo get_position_name($row->new_pos)?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Tgl. demotion</label>
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="date_demotion" value="<?php echo dateIndo($row->date_demotion)?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Alasan demotion</label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="alasan" id="alasan" type="text"  class="form-control" placeholder="Alasan demotion" disabled="disabled"><?php echo $row->alasan?></textarea>
                        </div>
                      </div>
                      <?php 
                      for($i=1;$i<6;$i++):
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
                          <label class="form-label text-left">Note (HRD): </label>
                        </div>
                        <div class="col-md-8">
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
                      <span class="semi-bold"><?php echo get_name($row->created_by)?></span><br/>
                      <span class="small"><?php echo dateIndo($row->created_on)?></span><br/>
                      <span class="semi-bold"><?php echo get_user_position(get_nik($row->created_by))?></span>
                    </p>
                  </div>

                  <div class="col-md-3">
                    <p class="wf-approve-sp">
                    <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                      <?php 
                      $approved = assets_url('img/approved_stamp.png');
                      $rejected = assets_url('img/rejected_stamp.png');
                      if(!empty($row->user_app_lv1) && $row->is_app_lv1 == 0 && get_nik($sess_id) == $row->user_app_lv1){?>
                      <span class="small"></span><br/>
                      <span class="small"></span>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span>
                        <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv1)?>)</span>
                      <?php }elseif(!empty($row->user_app_lv1) && $row->is_app_lv1 == 1){
                        echo ($row->app_status_id_lv1 == 1)?"<img class=approval-img src=$approved>":(($row->app_status_id_lv1 == 2) ? "<img class=approval-img src=$rejected>":'<span class="small"></span><br/>');?>
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
                        <span class="semi-bold"></span><br/>
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
                        <span class="small"></span><br/>
                        <span class="small"></span>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold">(Atasan Tidak Langsung)</span>
                      <?php }elseif(!empty($row->user_app_lv2) && $row->is_app_lv2 == 1){
                        echo ($row->app_status_id_lv2 == 1)?"<img class=approval-img src=$approved>":(($row->app_status_id_lv2 == 2) ? "<img class=approval-img src=$rejected>":'<span class="small"></span><br/>');?>
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
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_lv2)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_lv2)?></span><br/>
                        <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv2)?>)</span>
                      <?php } ?>
                    </p>
                  </div>
                    
                  <div class="col-md-3">
                    <p class="wf-approve-sp">
                    <div class="col-md-12"><span class="semi-bold">Diterima HRD</span><br/><br/></div>
                      <?php if($row->is_app_hrd == 0 && $this->approval->approver('demosi') == $sess_nik){?>
                        <span class="small"></span><br/>
                        <span class="small"></span>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold">(HRD)</span>
                      <?php }elseif($row->is_app_hrd == 1){
                        echo ($row->app_status_id_hrd == 1)?"<img class=approval-img src=$approved>":(($row->app_status_id_hrd == 2) ? "<img class=approval-img src=$rejected>":'<span class="small"></span><br/>');?>
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
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold"><?php echo get_name($this->approval->approver('demosi'))?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_hrd)?></span><br/>
                        <span class="semi-bold">(HRD)</span>
                      <?php } ?>
                    </p>
                  </div>
                  <!--PST242, PST263, PST2, PST129-->
                </div>
              </div> 

              <br/>
              <div class="col-md-4 text-xenter">
              <?php if(!empty($row->user_app_lv4)){?>
                <div class="col-md-12 text-center">
                  <p class="wf-approve-sp">
                  <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                    <?php 
                    $approved = assets_url('img/approved_stamp.png');
                    $rejected = assets_url('img/rejected_stamp.png');
                    if(!empty($row->user_app_lv4) && $row->is_app_lv4 == 0 && get_nik($sess_id) == $row->user_app_lv4){?>
                      <span class="small"></span><br/>
                      <span class="small"></span>
                      <span class="semi-bold"></span><br/>
                      <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv4)?>)</span>
                    <?php }elseif(!empty($row->user_app_lv4) && $row->is_app_lv4 == 1){
                      echo ($row->app_status_id_lv4 == 1)?"<img class=approval-img src=$approved>":(($row->app_status_id_lv4 == 2) ? "<img class=approval-img src=$rejected>":'<span class="small"></span><br/>');?>
                      <span class="small"></span><br/>
                      <span class="semi-bold"><?php echo get_name($row->user_app_lv4)?></span><br/>
                      <span class="small"><?php echo dateIndo($row->date_app_lv4)?></span><br/>
                      <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv4)?>)</span>
                    <?php }else{?>
                        <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_lv4)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_lv4)?></span><br/>
                        <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv4)?>)</span>
                    <?php } ?>
                  </p>
                </div>
              <?php } ?>
              </div>

              <?php if(!empty($row->user_app_lv3)){?>
              <div class="col-md-4 text-xenter">
                <div class="col-md-12 text-center">
                  <p class="wf-approve-sp">
                  <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                    <?php 
                    $approved = assets_url('img/approved_stamp.png');
                    $rejected = assets_url('img/rejected_stamp.png');
                    if(!empty($row->user_app_lv3) && $row->is_app_lv3 == 0 && get_nik($sess_id) == $row->user_app_lv3){?>
                      <span class="small"></span><br/>
                      <span class="small"></span>
                      <span class="semi-bold"></span><br/>
                      <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv3)?>)</span>
                    <?php }elseif(!empty($row->user_app_lv3) && $row->is_app_lv3 == 1){
                      echo ($row->app_status_id_lv3 == 1)?"<img class=approval-img src=$approved>":(($row->app_status_id_lv3 == 2) ? "<img class=approval-img src=$rejected>":'<span class="small"></span><br/>');?>
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

              <div class="col-md-4 text-xenter">
              <?php if(!empty($row->user_app_lv5)){?>
                <div class="col-md-12 text-center">
                  <p class="wf-approve-sp">
                  <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                    <?php 
                    $approved = assets_url('img/approved_stamp.png');
                    $rejected = assets_url('img/rejected_stamp.png');
                    if(!empty($row->user_app_lv5) && $row->is_app_lv5 == 0 && get_nik($sess_id) == $row->user_app_lv5){?>
                      <span class="small"></span><br/>
                      <span class="small"></span>
                      <span class="semi-bold"></span><br/>
                      <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv5)?>)</span>
                    <?php }elseif(!empty($row->user_app_lv5) && $row->is_app_lv5 == 1){
                      echo ($row->app_status_id_lv5 == 1)?"<img class=approval-img src=$approved>":(($row->app_status_id_lv5 == 2) ? "<img class=approval-img src=$rejected>":'<span class="small"></span><br/>');?>
                      <span class="small"></span><br/>
                      <span class="semi-bold"><?php echo get_name($row->user_app_lv5)?></span><br/>
                      <span class="small"><?php echo dateIndo($row->date_app_lv5)?></span><br/>
                      <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv5)?>)</span>
                    <?php }else{?>
                      <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_lv5)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_lv5)?></span><br/>
                        <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv5)?>)</span>
                    <?php } ?>
                  </p>
                </div>
              <?php } ?>

              </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php endforeach;} ?>