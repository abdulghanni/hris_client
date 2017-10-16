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
              <h4>View Permintaan <span class="semi-bold"><a href="<?php echo site_url('form_training_group')?>">Pelatihan</a></span></h4>
              <a href="<?php echo site_url('form_training_group/form_training_group_pdf/'.$id)?>" target="_blank"><button class="btn btn-primary pull-right"><i class="icon-print"> Cetak</i></button></a><br/>
              No : <?= get_form_no($id) ?>
            </div>
            <div class="grid-body no-border">
            <?php
              if($_num_rows>0){
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
                        <input type="hidden" id="emp" value="<?=$user->user_pengaju_id?>">      
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
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Waktu</label>
                          </div>
                          <div class="col-md-4">
                            <input name="" id="" type="text"  class="form-control" value="<?php echo dateIndo($user->tanggal_mulai)?>" disabled="disabled">
                          </div>
                          <div class="col-md-1">
                            S/D
                          </div>
                          <div class="col-md-4">
                            <input name="" id="" type="text"  class="form-control" value="<?php echo dateIndo($user->tanggal_akhir)?>" disabled="disabled">
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Narasumber</label>
                          </div>
                          <div class="col-md-9">
                            <input name="" id="tempat" type="text"  class="form-control" placeholder="Nama Narasumber" value="<?php echo $user->narasumber?>" disabled="disabled">
                          </div>
                        </div>
                    <?php 
                        for($i=1;$i<4;$i++):
                      $note_lv = 'note_app_lv'.$i;
                      $user_lv = 'user_app_lv'.$i;
                      if(!empty($user->$note_lv)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Note (<?php echo strtok(get_name($user->$user_lv), " ")?>):</label>
                        </div>
                        <div class="col-md-9">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $user->$note_lv ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                    <?php endfor;?>
                        
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
                          <label class="form-label text-right">Tipe Ikatan Dinas</label>
                        </div>
                        <div class="col-md-7">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Tujuan pelatihan" value="<?php echo $user->ikatan_dinas_id?>" disabled="disabled">
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-right">Periode Ikatan Dinas</label>
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
                          <textarea name="" class="form-control" class="custom-txtarea-form" placeholder="Note HRD isi disini" disabled="disabled"><?php echo $user->note_app_hrd?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                    <?php } ?>
                  </div>

                     <div class="form-actions">
                      <div class="row form-row">
                        <div class="col-md-12 text-center">
                          <?php  
                          for($i=1;$i<4;$i++):
                            $is_app = 'is_app_lv'.$i;
                            $user_app = 'user_app_lv'.$i;
                            if($user->$is_app == 1 && get_nik($sess_id) == $user->$user_app){?>
                              <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalLv<?php echo $i ?>"><i class='icon-edit'> Edit Approval</i></div>
                              <div class='btn btn-warning btn-small text-center' title='Kirim Notifikasi' onClick="send_notif_('lv<?php echo $i?>')"><i class='icon-mail-forward'> Kirim Notifikasi</i></div>
                          <?php }endfor;
                          if($user->is_app_hrd == 1 && get_nik($sess_id) == $this->approval->approver('training', $user_nik)){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalHrd"><i class='icon-edit'> Edit Approval</i></div>
                          <?php } ?>
                        </div>
                      </div>

                      <div class="col-md-12 text-center"><div class="col-md-12 text-center"><span class="semi-bold">Mengetahui,</span><br/><br/><br/></div>
                      <div class="row wf-training">
                        <div class="col-md-3" id="lv1">
                          <p class="wf-approve-sp">
                            <?php
                            $approved = assets_url('img/approved_stamp.png');
                            $rejected = assets_url('img/rejected_stamp.png');
                            $pending = assets_url('img/pending_stamp.png');

                            if(!empty($user->user_app_lv1) && $user->is_app_lv1 == 0 && get_nik($sess_id) == $user->user_app_lv1){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv1"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv1)?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo '('.get_user_position($user->user_app_lv1).')'?></span>
                            <?php }elseif(!empty($user->user_app_lv1) && $user->is_app_lv1 == 1){
                            echo ($user->approval_status_id_lv1 == 1)?"<img class=approval-img src=$approved>": (($user->approval_status_id_lv1 == 2) ? "<img class=approval-img src=$rejected>"  : (($user->approval_status_id_lv1 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv1)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_lv1)?></span><br/>
                              <span class="semi-bold"><?php echo '('.get_user_position($user->user_app_lv1).')'?></span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv1))?get_name($user->user_app_lv1):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv1))?'('.get_user_position($user->user_app_lv1).')':'';?></span>
                            <?php } ?>
                          </p>
                        </div>

                        <div class="col-md-3" id="lv2">
                        <?php if(!empty($user->user_app_lv2)): ?>
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($user->user_app_lv2) && $user->is_app_lv2 == 0 && get_nik($sess_id) == $user->user_app_lv2){?>
                             <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv2"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv2))?get_name($user->user_app_lv2):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo'('.get_user_position($user->user_app_lv2).')'?></span>
                            <?php }elseif(!empty($user->user_app_lv2) && $user->is_app_lv2 == 1){
                             echo ($user->approval_status_id_lv2 == 1)?"<img class=approval-img src=$approved>": (($user->approval_status_id_lv2 == 2) ? "<img class=approval-img src=$rejected>"  : (($user->approval_status_id_lv2 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv2)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_lv2)?></span><br/>
                              <span class="semi-bold"><?php echo '('.get_user_position($user->user_app_lv2).')'?></span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv2))?get_name($user->user_app_lv2):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv2))?'('.get_user_position($user->user_app_lv2).')':'';?></span>
                            <?php } ?>
                          </p>
                        <?php endif; ?>
                        </div>
                          
                        <div class="col-md-3" id="lv1">
                          <?php if(!empty($user->user_app_lv3)): ?>
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($user->user_app_lv3) && $user->is_app_lv3 == 0 && get_nik($sess_id) == $user->user_app_lv3){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv3"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo  get_name($user->user_app_lv3)?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($user->user_app_lv3)?>)</span>
                            <?php }elseif(!empty($user->user_app_lv3) && $user->is_app_lv3 == 1){
                            echo ($user->approval_status_id_lv3 == 1)?"<img class=approval-img src=$approved>": (($user->approval_status_id_lv3 == 2) ? "<img class=approval-img src=$rejected>"  : (($user->approval_status_id_lv3 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_lv3)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_lv3)?></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($user->user_app_lv3)?>)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv3))?get_name($user->user_app_lv3):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($user->user_app_lv3))?'('.get_user_position($user->user_app_lv3).')':'';?></span>
                            <?php } ?>
                          </p>
                        <?php endif; ?>
                        </div>
                          
                        <div class="col-md-3" id="hrd">
                          <p class="wf-approve-sp">
                            <?php 
                            if($user->is_app_hrd == 0 && $this->approval->approver('Training',get_nik($user->user_pengaju_id)) == $sess_nik){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalHrd"><i class="icon-ok"></i>Submit</div>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }elseif($user->is_app_hrd == 1){
                             echo ($user->approval_status_id_hrd == 1)?"<img class=approval-img src=$approved>": (($user->approval_status_id_hrd == 2) ? "<img class=approval-img src=$rejected>"  : (($user->approval_status_id_hrd == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user->user_app_hrd)?></span><br/>
                              <span class="small"><?php echo dateIndo($user->date_app_hrd)?></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              
                              <span class="semi-bold">(HRD)</span>
                            <?php } ?>
                          </p>
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


<!-- Edit approval training Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="submitModalHrd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Approval HRD - Form Training</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <?php $att = array('class'=>'', 'id'=>'formApphrd');
        echo form_open('', $att);?>
          <div class="row form-row">
            <div class="col-md-3">
              <label class="form-label text-right">Tipe Pelatihan</label>
            </div>
            <div class="col-md-9">
              <select name="training_type" class="select2" id="training_type" style="width:100%">
                  <?php 
                  $tanggal_mulai = ($user->tanggal_mulai == '0000-00-00')?date('Y-m-d'):$user->tanggal_mulai;
                  $tanggal_akhir = ($user->tanggal_akhir == '0000-00-00')?date('Y-m-d'):$user->tanggal_akhir;
                  if($training_type->num_rows()>0){
                      foreach ($training_type->result_array() as $key => $value) {
                      $selected = ($user->training_type_id <> 0 && $user->training_type_id == $value['id']) ? 'selected = selected' : '';
                      echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                      }}else{
                      echo '<option value="0">'.'No Data'.'</option>';
                      }
                      ?>

              </select>
            </div>
          </div>
          <div class="row form-row">
            <div class="col-md-3">
                <label class="form-label text-right">Penyelenggara</label>
            </div>
            <div class="col-md-9">
              <div class="radio">
                  <?php if($penyelenggara->num_rows()>0){
                  foreach($penyelenggara->result() as $row){
                   $checked = ($user->penyelenggara_id<>0 && $user->penyelenggara_id == $row->id) ? 'checked = checked' : '';
                ?>
                <input id="penyelenggara-<?php echo $row->id?>" type="radio" name="penyelenggara" value="<?php echo $row->id?>"  <?php echo $checked?>>
                <label for="penyelenggara-<?php echo $row->id?>"><?php echo $row->title?></label>
                <?php }}else{?>
                <input id="penyelenggara" type="radio" name="penyelenggara" value="0" checked="checked"  required>
                <label for="penyelenggara">No Data</label>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="row form-row">
            <div class="col-md-3">
              <label class="form-label text-right">Pembiayaan</label>
            </div>
            <div class="col-md-9">
              <select name="pembiayaan" class="select2" id="pembiayaan" style="width:100%" >
                  <?php if($pembiayaan->num_rows()>0){
                      foreach ($pembiayaan->result_array() as $key => $value) {
                      $selected = ($user->pembiayaan_id <> 0 && $user->pembiayaan_id == $value['id']) ? 'selected = selected' : '';
                      echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                      }}else{
                      echo '<option value="0">'.'No Data'.'</option>';
                      }
                      ?>

              </select>
            </div>
          </div>
          <div class="row form-row">
            <div class="col-md-3">
              <label class="form-label text-right">Tipe Ikatan Dinas</label>
            </div>
            <div class="col-md-9">
              <select name="ikatan" class="select2" id="ikatan" style="width:100%" >
                  <option value="0">-- Pilih Tipe Ikatan Dinas --</option>
                  <?php if(!empty($ikatan)){
                    for($i=0;$i<sizeof($ikatan);$i++):
                    $selected = ($user->ikatan_dinas_id == $ikatan[$i]['DESCRIPTION']) ? 'selected = selected' : '';
                    echo '<option value="'.$ikatan[$i]['DESCRIPTION'].'" '.$selected.'>'.$ikatan[$i]['DESCRIPTION'].'</option>';
                    endfor;}
                  ?>
              </select>
            </div>
          </div>
          <div class="row form-row">
            <div class="col-md-3">
              <label class="form-label text-right">Periode Ikatan Dinas</label>
            </div>
            <div class="col-md-9">
              <select name="waktu" class="select2" id="waktu" style="width:100%" >
                  <?php if($waktu->num_rows()>0){
                    foreach ($waktu->result_array() as $key => $value) {
                    $selected = ($user->waktu_id <> 0 && $user->waktu_id == $value['id']) ? 'selected = selected' : '';
                    echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                    }}else{
                    echo '<option value="0">'.'No Data'.'</option>';
                    }
                  ?>
              </select>
            </div>
          </div>
          <div class="row form-row">
            <div class="col-md-3">
              <label for="besar_biaya" class="form-label text-right">Besar Biaya (Rp.)</label>
            </div>
            <div class="col-md-9">
              <input name="besar_biaya" id="besar_biaya" type="text"  class="form-control" placeholder="Besar biaya (Rp.)" value="<?php echo number_format($user->besar_biaya,0,',','.')?>"  required>
            </div>
          </div>
          <div class="row form-row">
            <div class="col-md-3">
              <label class="form-label text-right">Tempat Pelaksanaan</label>
            </div>
            <div class="col-md-9">
              <input name="tempat" id="tempat" type="text"  class="form-control" placeholder="Tempat Pelaksanaan" value="<?php echo $user->tempat?>"  required>
            </div>
          </div>
          <div class="row form-row">
            <div class="col-md-3">
              <label class="form-label text-right">Nama Narasumber</label>
            </div>
            <div class="col-md-9">
              <input name="narasumber" id="tempat" type="text"  class="form-control" placeholder="Nama Narasumber" value="<?php echo $user->narasumber?>" required>
            </div>
          </div>
          <div class="row form-row">
            <div class="col-md-3">
              <label class="form-label text-right">Nama Vendor</label>
            </div>
            <div class="col-md-9">
              <select name="vendor_id" class="select2" id="vendor_id" style="width:100%" >
                  <option value="0">-- Pilih Nama Vendor --</option>
                  <?php if($vendor->num_rows()>0){
                    foreach ($vendor->result_array() as $key => $value) {
                      $selected = ($user->vendor_id <> 0 && $user->vendor_id == $value['id']) ? 'selected = selected' : '';
                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['vendor_title'].'</option>';
                      }
                    }else{
                      echo '<option value="0">'.'No Data'.'</option>';
                    }
                      ?>
              </select>
            </div>
          </div>
          <div class="row form-row">
            <div class="col-md-3">
              <label class="form-label text-right">Waktu Pelaksanaan</label>
            </div>
            <div class="col-md-3">
              <div class="input-with-icon right">
                  <div class="input-append success date no-padding">
                      <input type="text" class="datepicker" id="tanggal_mulai" name="tanggal_mulai" value="<?php echo $tanggal_mulai?>" required>
                      <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                  </div>
              </div>
            </div>
            <div class="col-md-2">
              <label class="form-label text-center">s/d</label>
            </div>
            <div class="col-md-3">
              <div class="input-with-icon right">
                  <div class="input-append success date no-padding">
                      <input type="text" class="datepicker" id="tanggal_akhir" name="tanggal_akhir" value="<?php echo $tanggal_akhir?>" required>
                      <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                  </div>
              </div>
            </div>
          </div>
          <div class="row form-row" style="display: none">
            <div class="col-md-3">
              <label class="form-label text-right">Lama Pelaksanaan</label>
            </div>
            <div class="col-md-2">
              <input name="lama_training_bulan" id="lama_training_bulan" type="text"  class="form-control text-center" value="<?php echo $user->lama_training_bulan?> Bulan" readonly>
            </div>
            <div class="col-md-2">
              <input name="lama_training_hari" id="lama_training_hari" type="text"  class="form-control text-center" value="<?php echo $user->lama_training_hari?> Hari" readonly>
            </div>
          </div>
          <div class="row form-row">
            <div class="col-md-3">
              <label class="form-label text-right">Jam</label>
            </div>
            
            <div class="col-md-3">
              <div class="input-append bootstrap-timepicker">
                <input name="jam_mulai" id="timepicker2" type="text" class="timepicker-241" value="<?php echo $user->jam_mulai?>" required>
                <span class="add-on">
                    <i class="icon-time"></i>
                </span>
              </div>
            </div>

            <div class="col-md-2">
              <label class="form-label text-center">s/d</label>
            </div>

            <div class="col-md-3">
              <div class="input-append bootstrap-timepicker">
                <input name="jam_akhir" id="timepicker2" type="text" class="timepicker-241" value="<?php echo $user->jam_akhir?>" required>
                <span class="add-on">
                    <i class="icon-time"></i>
                </span>
              </div>
            </div>
          </div>

          <div class="row form-row">
            <div class="col-md-3">
              <label class="form-label text-right">Status Approval </label>
            </div>
            <div class="col-md-9">
              <div class="radio">
                <?php 
                if($approval_status->num_rows() > 0){
                  foreach($approval_status->result() as $app){
                    $checked = ($app->id <> 0 && $app->id == $user->approval_status_id_hrd) ? 'checked = "checked"' : '';
                      $checked2 = ($app->id == 1) ? 'checked = "checked"' : '';
                    ?>
                <input id="app_status<?php echo $app->id?>" type="radio" name="app_status" value="<?php echo $app->id?>" <?php echo (!empty($checked))?$checked:$checked2;?>>
                <label for="app_status<?php echo $app->id?>"><?php echo $app->title?></label>
                <?php }}else{?>
                <input id="app_status" type="radio" name="app_status" value="0">
                <label for="app_status">No Data</label>
                  <?php } ?>
              </div>
            </div>
          </div>

          <div class="row form-row">
            <div class="col-md-12">
              <label class="form-label text-right">Note (HRD) : </label>
            </div>
            <div class="col-md-12">
              <textarea name="note_hrd" class="custom-txtarea-form" placeholder="Note HRD isi disini"><?php echo $user->note_app_hrd?></textarea>
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
<!--end edit modal-->   


<?php for($i=1;$i<4;$i++):?>
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
                      $x = 'approval_status_id_lv'.$i;
                      $y = 'note_app_lv'.$i;
                      $checked = ($app->id <> 0 && $app->id == $user->$x) ? 'checked = "checked"' : '';
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
                <textarea name="<?php echo 'note_lv'.$i?>" class="form-control" placeholder="Isi note disini...."><?php echo $user->$y?></textarea>
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

<?php }else{
  echo '<div class="col-md-12 text-center">Pengajuan Ini Telah Di Batalkan Oleh Pengaju</div>';
  } ?>
