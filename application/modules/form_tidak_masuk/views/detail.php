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
              foreach($form_tidak_masuk as $tidak_masuk){
                $user_nik = get_nik($tidak_masuk->user_id);
                ?>
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
                            <label class="form-label text-right">Tanggal Tidak Masuk</label>
                          </div>
                          <div class="col-md-3">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo dateIndo($tidak_masuk->dari_tanggal)?>" disabled="disabled">
                          </div>
                          <div class="col-md-1 form-label">s/d</div>  
                          <div class="col-md-3">
                            <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo dateIndo($tidak_masuk->sampai_tanggal)?>" disabled="disabled">
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
                        <label class="form-label text-right">Sisa Cuti</label>
                      </div>
                      <div class="col-md-1">
                        <input name="alasan" id="alasan" type="text"  class="form-control"  value="<?= $tidak_masuk->sisa_cuti?>" readonly="readonly">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Alasan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo $alasan?>" disabled="disabled">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Keterangan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo $tidak_masuk->keterangan?>" disabled="disabled">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Attachment</label>
                      </div>
                      <div class="col-md-9">
                        <a href="<?php echo base_url("uploads/izin/".$user_nik."/".$tidak_masuk->attachment)?>"><?php echo $tidak_masuk->attachment?></a>
                      </div>
                    </div>
                    
                  <?php if($tidak_masuk->potong_cuti == 1) :
                    $potong = ($tidak_masuk->potong_cuti == 1) ? 'Ya' : 'Tidak';
                  ?>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Izin Potong Cuti</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo $potong?>" disabled="disabled">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Tipe Cuti</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo $tipe_cuti?>" disabled="disabled">
                      </div>
                    </div>

                  <?php endif; ?>

                  <?php if(!empty($tidak_masuk->note_hrd)):?>
                    <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Note (HRD): </label>
                        </div>
                        <div class="col-md-9">
                          <textarea name="notes_hrd" placeholder="Note hrd isi disini" class="form-control" disabled="disabled"><?php echo $tidak_masuk->note_hrd ?></textarea>
                        </div>
                      </div>
                  <?php endif; ?>
                  </div>
                </div>
                <div class="form-actions">
                    <div class="row form-row">
                        <div class="col-md-12 text-center">
                        <?php if($tidak_masuk->is_app_hrd == 1 && $sess_nik == $this->approval->approver('tidak', $user_nik)){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalHrd"><i class='icon-edit'> Edit Approval</i></div>
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
                            $pending = assets_url('img/pending_stamp.png');
                        if(!empty($tidak_masuk->user_app_lv1)) :
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
                            <?php } endif; ?>
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
                            if($tidak_masuk->is_app_hrd == 0 && $this->approval->approver('tidak', $user_nik) == $sess_nik){
                              if(cek_approval_atasan($id)):
                              ?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalHrd"><i class="icon-ok"></i>Submit</div>
                              <?php else: ?>
                                <label>Menunggu approval dari atasan</label>
                              <?php endif; ?>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }elseif($tidak_masuk->is_app_hrd == 1){
                              echo ($tidak_masuk->app_status_id_hrd == 1)?"<img class=approval-img src=$approved>": (($tidak_masuk->app_status_id_hrd == 2) ? "<img class=approval-img src=$rejected>"  : (($tidak_masuk->app_status_id_hrd == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_hrd)?></span><br/>
                              <span class="small"><?php echo dateIndo($tidak_masuk->date_app_hrd)?></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo get_name($this->approval->approver('tidak', $user_nik))?></span><br/>
                              <span class="small"><?php echo dateIndo($tidak_masuk->date_app_hrd)?></span><br/>
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
              
    
      </div>
    
  </div>  
  <!-- END PAGE --> 

  <!--approval cuti Modal HRD -->
<div class="modal fade" id="submitModalHrd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Cuti - HRD</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" id="formAppHrd">
            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label text-left">Izin Potong Cuti </label>
              </div>
              <input type="hidden" name="insert" value="<?php echo $sisa_cuti['insert']?>">
              <div class="col-md-9">
                <div class="radio">
                  <input id="potong_cuti_1" type="radio" name="potong_cuti" value="1">
                  <label for="potong_cuti_1">Ya</label>
                  <input id="potong_cuti_0" type="radio" name="potong_cuti" value="0" checked>
                  <label for="potong_cuti_0">Tidak</label>
                </div>
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label text-left">Tipe Cuti</label>
              </div>
              <div class="col-md-9">
                <select name="type_cuti_id" id="alasan_cuti" class="select2" style="width:100%">
                        <option value="0">- Pilih Alasan Cuti -</option>
                  <?php if (!empty($alasan_cuti)) { ?>
                      <?php for ($i=0;$i<sizeof($alasan_cuti);$i++) : ?>
                        <option value="<?php echo $alasan_cuti[$i]['HRSLEAVETYPEID']; ?>"><?php echo $alasan_cuti[$i]['DESCRIPTION']; ?></option>
                      <?php endfor; ?>                      
                  <?php } else {?>
                        <option value="0">No Data</option>
                    <?php } ?>
                </select> 
              </div>
            </div>
            
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $tidak_masuk->app_status_id_hrd) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_hrd<?php echo $app->id?>" type="radio" name="app_status_hrd" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_hrd<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="app_status_hrd" value="0">
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
                <textarea name="note_hrd" class="custom-txtarea-form" placeholder="Note hrd isi disini"><?php echo $tidak_masuk->note_hrd?></textarea>
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
<!--end approve modal HRD--> 


              <?php }}?>