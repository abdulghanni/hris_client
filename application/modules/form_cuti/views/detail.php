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
                <h4>Form <a href="<?php echo site_url('form_cuti')?>"><span class="semi-bold">Permohonan Cuti</span></a></h4>
              <a href="<?php echo site_url('form_cuti/form_cuti_pdf/'.$id)?>" target="_blank"><button class="btn btn-primary pull-right"><i class="icon-print"> Cetak</i></button></a><br/>
              No : <?= get_form_no($id) ?>
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
                      <?php 
                      for($i=1;$i<4;$i++):
                      $note_lv = 'note_app_lv'.$i;
                      $user_lv = 'user_app_lv'.$i;
                      if(!empty($user->$note_lv)){?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-right">Note (<?php echo strtok(get_name($user->$user_lv), " ")?>):</label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $user->$note_lv ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                    <?php endfor;?>
                      
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
                  
                  <div class="form-actions">
                    <div class="row form-row">
                        <div class="col-md-12 text-center">
                        <?php  if($user->is_app_lv1 == 1 && get_nik($sess_id) == $user->user_app_lv1){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitcutiModalLv1"><i class='icon-edit'> Edit Approval</i></div>
                          <?php }elseif($user->is_app_lv2 == 1 && get_nik($sess_id) == $user->user_app_lv2){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitcutiModalLv2"><i class='icon-edit'> Edit Approval</i></div>
                          <?php }elseif($user->is_app_lv3 == 1 && get_nik($sess_id) == $user->user_app_lv3){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitcutiModalLv3"><i class='icon-edit'> Edit Approval</i></div>
                          <?php }elseif($user->is_app_hrd == 1 && get_nik($sess_id) == $user->user_app_hrd){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitcutiModalHrd"><i class='icon-edit'> Edit Approval</i></div>
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
                            if(!empty($user->user_app_lv1) && $user->is_app_lv1 == 0 && get_nik($sess_id) == $user->user_app_lv1){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitcutiModalLv1"><i class="icon-ok"></i>Submit</div>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Atasan Langsung)</span>
                            <?php }elseif(!empty($user->user_app_lv1) && $user->is_app_lv1 == 1){
                              echo ($user->approval_status_id_lv1 == 1)?"<img class=approval-img src=$approved>": (($user->approval_status_id_lv1 == 2) ? "<img class=approval-img src=$rejected>"  : (($user->approval_status_id_lv1 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
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
                          <?php if(!empty($user->user_app_lv2)) : ?>
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($user->user_app_lv2) && $user->is_app_lv2 == 0 && get_nik($sess_id) == $user->user_app_lv2){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitcutiModalLv2"><i class="icon-ok"></i>Submit</div>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Atasan Tidak Langsung)</span>
                            <?php }elseif(!empty($user->user_app_lv2) && $user->is_app_lv2 == 1){
                              echo ($user->approval_status_id_lv2 == 1)?"<img class=approval-img src=$approved>": (($user->approval_status_id_lv2 == 2) ? "<img class=approval-img src=$rejected>"  : (($user->approval_status_id_lv2 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
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
                        <?php endif; ?>
                        </div>
                          
                        <div class="col-md-3">
                        <?php if(!empty($user->user_app_lv3)) : ?>
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($user->user_app_lv3) && $user->is_app_lv3 == 0 && get_nik($sess_id) == $user->user_app_lv3){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitcutiModalLv3"><i class="icon-ok"></i>Submit</div>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($user->user_app_lv3)?>)</span>
                            <?php }elseif(!empty($user->user_app_lv3) && $user->is_app_lv3 == 1){
                              echo ($user->approval_status_id_lv3 == 1)?"<img class=approval-img src=$approved>": (($user->approval_status_id_lv3 == 2) ? "<img class=approval-img src=$rejected>"  : (($user->approval_status_id_lv3 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
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
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitcutiModalHrd"><i class="icon-ok"></i>Submit</div>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }elseif($user->is_app_hrd == 1){
                              echo ($user->approval_status_id_hrd == 1)?"<img class=approval-img src=$approved>": (($user->approval_status_id_hrd == 2) ? "<img class=approval-img src=$rejected>"  : (($user->approval_status_id_hrd == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
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
	          	
		
      </div>
		
	</div>  
	<!-- END PAGE -->

<!--approval cuti Modal Lv1 -->
<div class="modal fade" id="submitcutiModalLv1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Cuti - Atasan Langsung</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" id="formAppLv1">
            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label text-left"><?php echo lang('start_cuti_date') ?></label>
              </div>
              <div class="col-md-3">
                <div id="datepicker_start1" class="input-append date success no-padding">
                  <input type="text" class="form-control" name="start_cuti" value="<?php echo $user->date_mulai_cuti?>">
                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                </div>
              </div>
              <div class="col-md-2">
                <label class="form-label text-center">s/d</label>
              </div>
              <div class="col-md-3">
                <div id="datepicker_end1" class="input-append date success no-padding">
                  <input type="text" class="form-control" name="end_cuti" value="<?php echo $user->date_selesai_cuti?>">
                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label text-left"><?php echo lang('count_day') ?></label>
              </div>
              <div class="col-md-2">
                <input id="jml_hari1" type="text"  class="form-control" placeholder="Jml. Hari" name="jml_hari" value="<?php echo $user->jumlah_hari?>" readonly>
                <input type="hidden" name="jml_cuti" id="jml_cuti1" value="<?php echo $user->jumlah_hari?>">
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
                      $checked = ($app->id <> 0 && $app->id == $user->approval_status_id_lv1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv1<?php echo $app->id?>" type="radio" name="app_status_lv1" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_lv1<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="app_status_lv1" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Atasan Langsung) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_lv1" class="custom-txtarea-form" placeholder="Note Atasan Langsung isi disini"><?php echo $user->note_app_lv1?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="btn_app_lv1"  class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal Lv1--> 

<!--approval cuti Modal Lv2 -->
<div class="modal fade" id="submitcutiModalLv2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Cuti - Atasan Tidak Langsung</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formAppLv2">
            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label text-left"><?php echo lang('start_cuti_date') ?></label>
              </div>
              <div class="col-md-3">
                <div id="datepicker_start2" class="input-append date success no-padding">
                  <input type="text" class="form-control" name="start_cuti" value="<?php echo $user->date_mulai_cuti?>">
                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                </div>
              </div>
              <div class="col-md-2">
                <label class="form-label text-center">s/d</label>
              </div>
              <div class="col-md-3">
                <div id="datepicker_end2" class="input-append date success no-padding">
                  <input type="text" class="form-control" name="end_cuti" value="<?php echo $user->date_selesai_cuti?>">
                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label text-left"><?php echo lang('count_day') ?></label>
              </div>
              <div class="col-md-2">
                <input id="jml_hari2" type="text"  class="form-control" placeholder="Jml. Hari" name="jml_hari" value="<?php echo $user->jumlah_hari?>" readonly>
                <input type="hidden" name="jml_cuti" id="jml_cuti2" value="<?php echo $user->jumlah_hari?>">
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
                      $checked = ($app->id <> 0 && $app->id == $user->approval_status_id_lv2) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv2<?php echo $app->id?>" type="radio" name="app_status_lv2" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_lv2<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="app_status_lv2" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Atasan Tidak Langsung) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_lv2" class="custom-txtarea-form" placeholder="Note Atasan Tidak Langsung isi disini"><?php echo $user->note_app_lv2?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="btn_app_lv2"  class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal Lv2--> 

<!--approval cuti Modal Lv3 -->
<div class="modal fade" id="submitcutiModalLv3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Cuti - Atasan Lainnya</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" id="formAppLv3">
            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label text-left"><?php echo lang('start_cuti_date') ?></label>
              </div>
              <div class="col-md-3">
                <div id="datepicker_start3" class="input-append date success no-padding">
                  <input type="text" class="form-control" name="start_cuti" value="<?php echo $user->date_mulai_cuti?>">
                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                </div>
              </div>
              <div class="col-md-2">
                <label class="form-label text-center">s/d</label>
              </div>
              <div class="col-md-3">
                <div id="datepicker_end3" class="input-append date success no-padding">
                  <input type="text" class="form-control" name="end_cuti" value="<?php echo $user->date_selesai_cuti?>">
                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label text-left"><?php echo lang('count_day') ?></label>
              </div>
              <div class="col-md-2">
                <input id="jml_hari3" type="text"  class="form-control" placeholder="Jml. Hari" name="jml_hari" value="<?php echo $user->jumlah_hari?>" readonly>
                <input type="hidden" name="jml_cuti" id="jml_cuti3" <?php echo $user->jumlah_hari?>>
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
                      $checked = ($app->id <> 0 && $app->id == $user->approval_status_id_lv3) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv3<?php echo $app->id?>" type="radio" name="app_status_lv3" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_lv3<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="app_status_lv3" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Atasan) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_lv3" class="custom-txtarea-form" placeholder="Note Atasan isi disini"><?php echo $user->note_app_lv3?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="btn_app_lv3"  class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal Lv3--> 

<!--approval cuti Modal HRD -->
<div class="modal fade" id="submitcutiModalHrd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <label class="form-label text-left"><?php echo lang('start_cuti_date') ?></label>
              </div>
              <div class="col-md-3">
                <div id="datepicker_start4" class="input-append date success no-padding">
                  <input type="text" class="form-control" name="start_cuti" value="<?php echo $user->date_mulai_cuti?>">
                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                </div>
              </div>
              <div class="col-md-2">
                <label class="form-label text-center">s/d</label>
              </div>
              <div class="col-md-3">
                <div id="datepicker_end4" class="input-append date success no-padding">
                  <input type="text" class="form-control" name="end_cuti" value="<?php echo $user->date_selesai_cuti?>">
                  <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label text-left"><?php echo lang('count_day') ?></label>
              </div>
              <div class="col-md-2">
                <input id="jml_hari4" type="text"  class="form-control" placeholder="Jml. Hari" name="jml_hari" value="<?php echo $user->jumlah_hari?>" readonly>
                <input type="hidden" name="jml_cuti" id="jml_cuti4" value="<?php echo $user->jumlah_hari?>">
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
                      $checked = ($app->id <> 0 && $app->id == $user->approval_status_id_hrd) ? 'checked = "checked"' : '';
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
                <textarea name="note_hrd" class="custom-txtarea-form" placeholder="Note hrd isi disini"><?php echo $user->note_app_hrd?></textarea>
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



<?php endforeach; ?>
<?php } ?>