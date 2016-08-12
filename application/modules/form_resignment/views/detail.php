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
                <h4>Form Pengajuan <span class="semi-bold"><a href="<?php echo site_url('form_resignment')?>">Pengunduran Diri</a></span></h4>
              <a href="<?php echo site_url('form_resignment/form_resignment_pdf/'.$id)?>" target="_blank"><button class="btn btn-primary pull-right"><i class="icon-print"> Cetak</i></button></a><br/>
              No : <?= get_form_no($id) ?>
              </div>
              <div class="grid-body no-border">
                <?php
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => '');
                echo form_open('form_resignment/add', $att);
                if($_num_rows>0){
                    $user_nik = get_nik($row->user_id);
                ?>
                  <input type="hidden" id="emp" value="<?=$row->user_id?>">
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
                          <input name="nik" id="bu" type="text"  class="form-control " placeholder="-" value="" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Dept/Bagian</label>
                        </div>
                        <div class="col-md-9">
                            <input name="nik" id="organization" type="text"  class="form-control " placeholder="-" value="" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Jabatan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="nik" id="position" type="text"  class="form-control " placeholder="-" value="" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Tanggal Mulai Kerja</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="seniority_date" type="text"  class="form-control " placeholder="Nama" value=""  disabled="disabled" >
                        </div>
                      </div>
                      
                      
                    </div>
                    <div class="col-md-6">
                      <h4>Pengunduran Diri Yang Diajukan</h4>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Tanggal Pengajuan</label>
                        </div>
                        <div class="col-md-5">
                          <input name="old_org2" id="old_org2" class="form-control " placeholder="" value="<?php echo dateIndo($row->created_on)?>"  disabled="disabled">
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Tanggal Terakhir Bekerja</label>
                        </div>
                        <div class="col-md-5">
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
                          <input name="phone" id="phone" class="form-control " placeholder="" value="<?php echo $row->phone ?>" disabled>
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
                            <input type="text" class="form-control" id="sandbox-advance" name="date_resign" value="<?php $nama_pewawancara = (strlen($row->nama_pewawancara)!=5) ? $row->nama_pewawancara : get_name($row->nama_pewawancara);echo $nama_pewawancara?>" disabled>
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
                    <div id="note">
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

                  <div class="row form-row">
                    <div class="col-md-12 text-center">
                    <?php  
                    for($i=1;$i<4;$i++):
                      $is_app = 'is_app_lv'.$i;
                      $user_app = 'user_app_lv'.$i;
                      if($row->$is_app == 1 && get_nik($sess_id) == $row->$user_app){?>
                        <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalLv<?php echo $i ?>"><i class='icon-edit'> Edit Approval</i></div>
                    <?php }endfor;
                      if($row->is_app_hrd == 1 && get_nik($sess_id) == $this->approval->approver('resignment', $user_nik)){
                      $submitbutton = ($row->is_invited == 0) ? '#undanganModal' : '#submitModalHrd';
                      $submitlabel =  ($row->is_invited == 0) ? 'Ubah Undangan' : 'Ubah Wawancara';
                      ?>
                        <div class='btn btn-info btn-small text-center' title="<?php echo $submitlabel ?>" data-toggle="modal" data-target="<?php echo $submitbutton ?>"><i class='icon-edit'> <?php echo $submitlabel ?></i></div>
                      <?php } ?>
                    </div>
                  </div>

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
                      <?php 
                      $submitbutton = ($row->is_invited == 0) ? '#undanganModal' : '#submitModalHrd';
                      $submitlabel =  ($row->is_invited == 0) ? 'Undang Wawancara' : 'Wawancara';
                      if($row->is_app_hrd == 0 && $this->approval->approver('resignment', $user_nik) == $sess_nik){?>
                        <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="<?php echo $submitbutton ?>"><i class="icon-ok"></i><?php echo $submitlabel?></div>
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
                        <span class="semi-bold"><?php echo get_name($this->approval->approver('resignment', $user_nik))?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_hrd)?></span><br/>
                        <span class="semi-bold">(HRD)</span>
                      <?php } ?>
                    </p>
                  </div>
                </div>
              </div> 

              <br/>
              <?php if(!empty($row->user_app_lv3)){?>
              <div class="col-md-12 text-xenter" id="lv3">
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



                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>
              
    
  </div>
    
</div>  
<!-- END PAGE --> 

<?php for($i=1;$i<4;$i++):?>
  <!--approval  Modal atasan -->
<div class="modal fade" id="<?php echo 'submitModalLv'.$i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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


<!--Undangan wawancara modal -->
<div class="modal fade" id="undanganModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form  Pengunduran Diri - Undangan Wawancara</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formUndangan">
            <div class="row form-row">
              <div class="col-md-4">
                <label class="form-label text-left">Tanggal Wawancara </label>
              </div>
              <div class="col-md-6">
                  <div class="input-append success date">
                    <input type="text" class="form-control" id="sandbox-advance" name="date_invited" required>
                    <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span>
                  </div>
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-4">
                <label class="form-label text-left">Waktu Wawancara</label>
              </div>
              <div class="col-md-6">
                <div class="input-append bootstrap-timepicker">
                  <input name="time_invited" id="timepicker2" type="text" class="timepicker-24" value="" required>
                  <span class="add-on">
                      <i class="icon-time"></i>
                  </span>
                </div>
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-4">
                <label class="form-label text-left">Nama Pewawancara</label>
              </div>
              <div class="col-md-8">
                <?php if(!empty($hrd_list)){ ?>
                  <select id="hrd_list" name="nama_pewawancara" class="form-control select2">
                <?php
                  foreach ($hrd_list as $key => $value):
                    echo '<option value='.$value["EMPLID"].'>'.$value["NAME"].'</option>';
                  endforeach;
                    echo '</select>';
                  } else { ?>
                  <input type="text" class="form-control" id="sandbox-advance" name="nama_pewawancara" value="<?php echo $row->nama_pewawancara?>">
                <?php } ?>
              </div>
            </div>
            <br/>
            <div class="row form-row">
              <div class="col-md-4">
                <label class="form-label text-left">No. Telp Pewawancara</label>
              </div>
              <div class="col-md-8">
                <input type="text" class="form-control" id="hrd_phone" name="telp_pewawancara" value="<?php echo $row->telp_pewawancara?>">
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Catatan : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_invited" class="custom-txtarea-form" placeholder="Note atasan isi disini"><?php echo $row->note_lv3?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit" id="btn_undangan"  class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal Lv3--> 


<!--approval resignment Modal HRD -->
<div class="modal fade" id="submitModalHrd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Pengunduran Diri - Wawancara HRD</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formApphrd">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Alasan Berhenti Bekerja</label>
              </div>
            
              <div class="col-md-12">
                <div class="checkbox check-primary checkbox-circle" >
                    <?php
                      if($alasan_resign->num_rows()>0){
                          foreach($alasan_resign->result() as $alasan):
                          $checked = ($alasan->id <> 0 && $alasan->id == $row->alasan_resign_id) ? 'checked = "checked"' : '';
                      $checked2 = ($app->id == 1) ? 'checked = "checked"' : '';?>

                    <input name="alasan_resign_id[]" id="alasan-<?php echo $alasan->id?>" class="checkbox1" type="checkbox" value="<?php echo $alasan->id?>" <?php echo (!empty($checked))?$checked:$checked2;?>>
                    <label for="alasan-<?php echo $alasan->id?>"><?php echo $alasan->title?></label>
                    <?php endforeach;}?>
                  </div>
                </div>

            
              <div class="col-md-12">
                <label class="form-label text-left">Apa alasan utama berhenti bekerja dari perusahaan ini? Jelaskan</label>
              </div>
            
              <div class="col-md-12">
                <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="desc_resign" required><?= $row->desc_resign ?></textarea>
              </div>

            
              <div class="col-md-12">
                <label class="form-label text-left">Adakah prosedur perusahaan yang membuat anda tidak nyaman atau tidak bisa maksimum menjalankan tugasnya?</label>
              </div>
            
              <div class="col-md-12">
                <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="procedure_resign" required><?= $row->procedure_resign ?></textarea>
              </div>

            
              <div class="col-md-12">
                <label class="form-label text-left">Adakah hal yang memuaskan dari pekerjaan anda sekarang?</label>
              </div>
            
              <div class="col-md-12">
                <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="kepuasan_resign" required><?= $row->kepuasan_resign ?></textarea>
              </div>

            
              <div class="col-md-12">
                <label class="form-label text-left">Adakah saran untuk kami?</label>
              </div>
            
              <div class="col-md-12">
                <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="saran_resign" required><?= $row->saran_resign ?></textarea>
              </div>

            
              <div class="col-md-12">
                <label class="form-label text-left">Apakah anda mempertimbangkan di masa datang untuk kembali bekerja di perusahaan ini?</label>
              </div>
            
              <div class="col-md-12">
                <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="rework_resign" required><?= $row->rework_resign ?></textarea>
              </div>
            
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
            
              <div class="col-md-12">
                <label class="form-label text-left">Note (HRD) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_hrd" class="custom-txtarea-form" placeholder="Note HRD isi disini"><?php echo $row->note_hrd?></textarea>
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
<!--end approve modal Lv2--> 



<?php }else{
  echo '<div class="col-md-12 text-center">Pengajuan Ini Telah Di Batalkan Oleh Pengaju</div>';
  } ?>