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
                <h4>Form <span class="semi-bold"><a href="<?php echo site_url('form_phk')?>">PHK</a></span></h4>
              <a href="<?php echo site_url('form_phk/form_phk_pdf/'.$id)?>" target="_blank"><button class="btn btn-primary pull-right"><i class="icon-print"> Cetak</i></button></a><br/>
              No : <?= get_form_no($id) ?>
              </div>
              <div class="grid-body no-border">
                <form class="form-no-horizontal-spacing" id=""> 
                  <div class="row column-seperation">
                    <div class="col-md-5">
                      <h4>Informasi karyawan</h4>
                      <?php if($_num_rows>0){
                        $user_nik = get_nik($row->user_id);
                        ?>
                        <input type="hidden" id="emp" value="<?=$row->user_id?>">
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">NIK</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo get_nik($row->user_id)?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Nama</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo get_name($row->user_id)?>" disabled="disabled">
                        </div>
                      </div> 
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Status Employee</label>
                        </div>
                        <div class="col-md-9">
                          <input name="stat-emp" type="text"  class="form-control" placeholder="-" value="<?php echo $status_karyawan?>" disabled="disabled">
                        </div>
                      </div>          
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Unit Bisnis</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Dept/Bagian</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Jabatan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="position" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Tanggal Mulai Kerja</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="seniority_date" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
                        </div>
                      </div>
                      
                      
                    </div>
                    <div class="col-md-7">
                      <h4>PHK Yang Diajukan</h4>
                     
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Tgl. phk</label>
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="date_phk" value="<?php echo dateIndo($row->date_phk)?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Alasan phk</label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="alasan" id="alasan" type="text"  class="form-control" placeholder="Alasan phk" readonly="readonly"><?php echo $row->alasan?></textarea>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-12">
                          <label class="form-label text-left">Attachment : </label>
                        </div>
                          <?php 
                            for($i=0;$i<sizeof($attachment);$i++):
                              if(file_exists('./uploads/'.$user_folder.$attachment[$i])){
                          ?>
                          <div class="col-md-12">
                            <label class="form-label text-left"><a href="<?php echo site_url('uploads/'.$user_folder.$attachment[$i])?>" target="_blank"><?php echo '* '.$attachment[$i]?></a></label>
                          </div>
                        <?php }endfor; ?>
                      </div>

                      <div id="note">
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
                            <textarea name="notes_spv" class="form-control" readonly="readonly"><?php echo $row->$note_lv ?></textarea>
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
                            <textarea name="notes_spv" class="form-control" readonly="readonly"><?php echo $row->note_hrd ?></textarea>
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="row form-row">
                    <div class="col-md-12 text-center">
                    <?php  
                    for($i=1;$i<6;$i++):
                      $is_app = 'is_app_lv'.$i;
                      $user_app = 'user_app_lv'.$i;
                      if($row->$is_app == 1 && get_nik($sess_id) == $row->$user_app){?>
                        <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalLv<?php echo $i ?>"><i class='icon-edit'> Edit Approval</i></div>
                        <div class='btn btn-warning btn-small text-center' title='Kirim Notifikasi' onClick="send_notif_('lv<?php echo $i?>')"><i class='icon-mail-forward'> Kirim Notifikasi</i></div>
                    <?php }endfor;
                      if($row->is_app_hrd == 1 && get_nik($sess_id) == $this->approval->approver('phk', $user_nik)){?>
                        <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalHrd"><i class='icon-edit'> Edit Approval</i></div>
                    <?php } ?>
                    </div>
                  </div>

                <div class="row wf-cuti">

                  <div class="col-md-12 text-center">
                  <div class="col-md-3">
                    <p class="wf-approve-sp">
                    <div class="col-md-12"><span class="semi-bold">Pemohon,</span><br/><br/></div>
                      <img class="approval-img" src="<?=assets_url('img/signed.png');?>">
                      <span class="small"></span><br/>
                      <span class="semi-bold"><?php echo get_name($row->created_by)?></span><br/>
                      <span class="small"><?php echo dateIndo($row->created_on)?></span><br/>
                      <span class="semi-bold">(<?php echo get_user_position(get_nik($row->created_by))?>)</span>
                    </p>
                  </div>

                  <div class="col-md-3" id="lv1">
                    <p class="wf-approve-sp">
                    <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                      <?php 
                      $approved = assets_url('img/approved_stamp.png');
                      $rejected = assets_url('img/rejected_stamp.png');
                       $pending = assets_url('img/pending_stamp.png');
                      if(!empty($row->user_app_lv1) && $row->is_app_lv1 == 0 && get_nik($sess_id) == $row->user_app_lv1){?>
                      <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv1"><i class="icon-ok"></i>Submit</div>
                      <span class="small"></span>
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
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_lv1)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_lv1)?></span><br/>
                        <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv1)?>)</span>
                      <?php } ?>
                    </p>
                  </div>
                    
                  <div class="col-md-3" id="lv2">
                  <?php if(!empty($row->user_app_lv2)):?>
                    <p class="wf-approve-sp">
                    <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                    <?php
                     if(!empty($row->user_app_lv2) && $row->is_app_lv2 == 0 && get_nik($sess_id) == $row->user_app_lv2){?>
                        <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv2"><i class="icon-ok"></i>Submit</div>
                        <span class="small"></span>
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
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_lv2)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_lv2)?></span><br/>
                        <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv2)?>)</span>
                      <?php } ?>
                    </p>
                  <?php endif; ?>
                  </div>
                    
                  <div class="col-md-3" id="hrd">
                    <p class="wf-approve-sp">
                    <div class="col-md-12"><span class="semi-bold">Diterima HRD</span><br/><br/></div>
                      <?php if($row->is_app_hrd == 0 && $this->approval->approver('phk', $user_nik) == $sess_nik){?>
                        <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalHrd"><i class="icon-ok"></i>Submit</div>
                        <span class="small"></span>
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
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold"><?php echo get_name($this->approval->approver('phk', $user_nik))?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_hrd)?></span><br/>
                        <span class="semi-bold">(HRD)</span>
                      <?php } ?>
                    </p>
                  </div>
                  <!--PST242, PST263, PST2, PST129-->
                </div>
              </div> 

              <br/>
              <div class="col-md-4 text-xenter" id="lv4">
              <?php if(!empty($row->user_app_lv4)){?>
                <div class="col-md-12 text-center">
                  <p class="wf-approve-sp">
                  <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                    <?php 
                    $approved = assets_url('img/approved_stamp.png');
                    $rejected = assets_url('img/rejected_stamp.png');
                    if(!empty($row->user_app_lv4) && $row->is_app_lv4 == 0 && get_nik($sess_id) == $row->user_app_lv4){?>
                      <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv4"><i class="icon-ok"></i>Submit</div>
                      <span class="small"></span>
                      <span class="semi-bold"></span><br/>
                      <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv4)?>)</span>
                    <?php }elseif(!empty($row->user_app_lv4) && $row->is_app_lv4 == 1){
                     echo ($row->app_status_id_lv4 == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_lv4 == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_lv4 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
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
              <div class="col-md-4 text-xenter" id="lv3">
                <div class="col-md-12 text-center">
                  <p class="wf-approve-sp">
                  <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                    <?php 
                    $approved = assets_url('img/approved_stamp.png');
                    $rejected = assets_url('img/rejected_stamp.png');
                    if(!empty($row->user_app_lv3) && $row->is_app_lv3 == 0 && get_nik($sess_id) == $row->user_app_lv3){?>
                      <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv3"><i class="icon-ok"></i>Submit</div>
                      <span class="small"></span>
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

              <div class="col-md-4 text-xenter" id="lv5">
              <?php if(!empty($row->user_app_lv5)){?>
                <div class="col-md-12 text-center">
                  <p class="wf-approve-sp">
                  <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                    <?php 
                    $approved = assets_url('img/approved_stamp.png');
                    $rejected = assets_url('img/rejected_stamp.png');
                    if(!empty($row->user_app_lv5) && $row->is_app_lv5 == 0 && get_nik($sess_id) == $row->user_app_lv5){?>
                      <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv5"><i class="icon-ok"></i>Submit</div>
                      <span class="small"></span>
                      <span class="semi-bold"></span><br/>
                      <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv5)?>)</span>
                    <?php }elseif(!empty($row->user_app_lv5) && $row->is_app_lv5 == 1){
                      echo ($row->app_status_id_lv5 == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_lv5 == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_lv5 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
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
              
    
  </div>
    
</div>  
<!-- END PAGE --> 

<?php for($i=1;$i<6;$i++):?>
  <!--approval  Modal atasan -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="<?php echo 'submitModalLv'.$i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Atasan</h4>
      </div>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="<?php echo 'formApplv'.$i?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $x = 'app_status_id_lv'.$i;
                      $y = 'note_lv'.$i;
                      $checked = ($app->id <> 0 && $app->id == $row->$x) ? 'checked = "checked"' : '';
                      $checked2 = ($app->id == 1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv<?php echo $i.'-'.$app->id?>" type="radio" name="<?php echo 'app_status_lv'.$i?>" value="<?php echo $app->id?>" <?php echo (!empty($checked))?$checked:$checked2;?>>
                  <label for="app_status_lv<?php echo $i.'-'.$app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="<?php echo 'app_status_lv'.$i?>" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note : </label>
              </div>
              <div class="col-md-12">
                <textarea name="<?php echo 'note_lv'.$i?>" class="form-control" placeholder="Isi note disini...."><?php echo $row->$y?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
         <button id="btnApplv<?=$i?>" onclick="approve('lv<?=$i?>')" type="button" class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal-->
<?php endfor;?>


<!--approval phk Modal HRD -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="submitModalHrd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form HRD</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formApphrd">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->app_status_id_hrd) ? 'checked = "checked"' : '';
                      $checked2 = ($app->id == 1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_hrd<?php echo $app->id?>" type="radio" name="app_status_hrd" value="<?php echo $app->id?>" <?php echo (!empty($checked))?$checked:$checked2;?>>
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
                <textarea name="note_hrd" class="custom-txtarea-form" placeholder="Note HRD isi disini"><?php echo $row->note_hrd?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
         <button id="btnApphrd" onclick="approve('hrd')" type="button" class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal Hrd--> 
<?php }else{
  echo '<div class="col-md-12 text-center">Pengajuan Ini Telah Di Batalkan Oleh Pengaju</div>';
  } ?>