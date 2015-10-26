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
              foreach($form_tidak_masuk as $tidak_masuk){?>
              <form class="form-no-horizontal-spacing" id="form"> 
                <div class="row column-seperation">
                  <div class="col-md-12">
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
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_organization($user_nik)?>" disabled="disabled">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="position" id="position" type="text"  class="form-control" placeholder="position" value="<?php echo get_user_position($user_nik)?>" disabled="disabled">
                      </div>
                    </div>
                    
                    <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Tgl. Berangkat</label>
                          </div>
                          <div class="col-md-3">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo $tidak_masuk->dari_tanggal?>" disabled="disabled">
                          </div>
                          <div class="col-md-1 form-label">s/d</div>  
                          <div class="col-md-3">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo $tidak_masuk->sampai_tanggal?>" disabled="disabled">
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
                        <label class="form-label text-right">Alasan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo $tidak_masuk->alasan?>" disabled="disabled">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                      <div class="col-md-12 text-center"><div class="col-md-12 text-center"><span class="semi-bold">Mengetahui,</span><br/><br/><br/></div>
                      <div class="row wf-cuti">
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            $approved = assets_url('img/approved_stamp.png');
                            if(!empty($tidak_masuk->user_app_lv1) && $tidak_masuk->is_app_lv1 == 0 && get_nik($sess_id) == $tidak_masuk->user_app_lv1){?>
                              <button id="btn_app_lv1" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Submit</button>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Atasan Langsung)</span>
                            <?php }elseif(!empty($tidak_masuk->user_app_lv1) && $tidak_masuk->is_app_lv1 == 1){
                              echo "<img class=approval_img_md src=$approved>"?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_lv1)?></span><br/>
                              <span class="small"><?php echo dateIndo($tidak_masuk->date_app_lv1)?></span><br/>
                              <span class="semi-bold">(Atasan Langsung)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_lv1)?></span><br/>
                              <span class="small"><?php echo dateIndo($tidak_masuk->date_app_lv1)?></span><br/>
                              <span class="semi-bold">(Atasan Langsung)</span>
                            <?php } ?>
                          </p>
                        </div>

                        <div class="col-md-3">
                        <?php if(!empty($tidak_masuk->user_app_lv2)) : ?>
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($tidak_masuk->user_app_lv2) && $tidak_masuk->is_app_lv2 == 0 && get_nik($sess_id) == $tidak_masuk->user_app_lv2){?>
                              <button id="btn_app_lv2" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Submit</button>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Atasan Tidak Langsung)</span>
                            <?php }elseif(!empty($tidak_masuk->user_app_lv2) && $tidak_masuk->is_app_lv2 == 1){
                              echo "<img class=approval_img_md src=$approved>"?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_lv2)?></span><br/>
                              <span class="small"><?php echo dateIndo($tidak_masuk->date_app_lv2)?></span><br/>
                              <span class="semi-bold">(Atasan Tidak Langsung)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_lv2)?></span><br/>
                              <span class="small"><?php echo dateIndo($tidak_masuk->date_app_lv2)?></span><br/>
                              <span class="semi-bold">(Atasan Tidak Langsung)</span>
                            <?php } ?>
                          </p>
                        <?php endif; ?>
                        </div>
                          
                        <div class="col-md-3">
                        <?php if(!empty($tidak_masuk->user_app_lv3)) : ?>
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($tidak_masuk->user_app_lv3) && $tidak_masuk->is_app_lv3 == 0 && get_nik($sess_id) == $tidak_masuk->user_app_lv3){?>
                              <button id="btn_app_lv3" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Submit</button>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($tidak_masuk->user_app_lv3)?>)</span>
                            <?php }elseif(!empty($tidak_masuk->user_app_lv3) && $tidak_masuk->is_app_lv3 == 1){
                              echo "<img class=approval_img_md src=$approved>"?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_lv3)?></span><br/>
                              <span class="small"><?php echo dateIndo($tidak_masuk->date_app_lv3)?></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($tidak_masuk->user_app_lv3)?>)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_lv3)?></span><br/>
                              <span class="small"><?php echo dateIndo($tidak_masuk->date_app_lv3)?></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($tidak_masuk->user_app_lv3)?>)</span>
                            <?php } ?>
                          </p>
                        <?php endif; ?>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if($tidak_masuk->is_app_hrd == 0 && $this->approval->approver('tidak') == $sess_nik){?>
                              <button id="btn_app_hrd" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Submit</button>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }elseif($tidak_masuk->is_app_hrd == 1){
                              echo "<img class=approval_img_md src=$approved>"?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_hrd)?></span><br/>
                              <span class="small"><?php echo dateIndo($tidak_masuk->date_app_hrd)?></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo get_name($this->approval->approver('tidak'))?></span><br/>
                              <span class="small"><?php echo dateIndo($tidak_masuk->date_app_hrd)?></span><br/>
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