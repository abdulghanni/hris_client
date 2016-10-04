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
              <h4>Form Perjalanan Dinas <a href="<?php echo site_url('form_spd_luar')?>"><span class="semi-bold">Luar Kota</span></a></h4>
              <a href="<?php echo site_url('form_spd_luar/pdf/'.$id)?>" target="_blank"><button class="btn btn-primary pull-right"><i class="icon-print"> Cetak</i></button></a><br/>
              No : <?= get_form_no($id) ?>
            </div>
            <div class="grid-body no-border">
              <!--<form class="form-no-horizontal-spacing" id="form_spd_dalam" action="<?php echo site_url().'form_spd_luar/do_submit/'.$id = $this->uri->segment(3, 0);?>" method="post">-->
              <form class="form-no-horizontal-spacing" id="formSpdLuar"> 
                <div class="row column-seperation">
                  <div class="col-md-5">
                    <h4>Admin Pembuat Tugas</h4>   
                    <?php if ($td_num_rows > 0) {
                      foreach ($task_detail as $td) :
                        $a = strtotime($td->date_spd_end);
                        $b = strtotime($td->date_spd_start);

                        $j = $a - $b;
                        $jml_pjd = floor($j/(60*60*24)+1);
                        ?> 
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                        <input name="name" id="name" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($td->task_creator) ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="org" id="org" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_organization($td->task_creator)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="position" id="position" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_position($td->task_creator)?>" disabled="disabled">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <h4>Memberi Tugas Kepada</h4>
                    
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                        <input name="name" id="name" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($td->task_receiver)?>" disabled="disabled">  
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="dept" id="dept" type="text"  class="form-control" placeholder="Dept/Bagian" value="<?php echo get_user_organization($td->task_receiver)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="dept" id="dept" type="text"  class="form-control" placeholder="Jabatan" value="<?php echo get_user_position($td->task_receiver)?>" disabled="disabled">
                      </div>
                    </div>
                        
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Tujuan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="destination" id="destination" type="text"  class="form-control" placeholder="Tujuan" value="<?php echo $td->destination ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dalam Rangka</label>
                      </div>
                      <div class="col-md-9">
                        <input name="title" id="title" type="text"  class="form-control" placeholder="Dalam Rangka" value="<?php echo $td->title; ?>" disabled="disabled">
                      </div>
                    </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Kota Tujuan</label>
                          </div>
                          <div class="col-md-9">
                            <input name="title" id="title" type="text"  class="form-control" placeholder="Dalam Rangka" value="<?php echo $td->city_to; ?>" disabled="disabled">
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Dari</label>
                          </div>
                          <div class="col-md-9">
                            <input name="title" id="title" type="text"  class="form-control" placeholder="Dalam Rangka" value="<?php echo $td->city_from; ?>" disabled="disabled">
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Kendaraan</label>
                          </div>
                          <div class="col-md-9">
                            <input name="title" id="title" type="text"  class="form-control" placeholder="Dalam Rangka" value="<?php echo $td->transportation_nm; ?>" disabled="disabled">
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Tgl. Berangkat</label>
                          </div>
                          <div class="col-md-8">
                            <input name="title" id="title" type="text"  class="form-control" placeholder="Dalam Rangka" value="<?php echo dateIndo($td->date_spd_start); ?>" disabled="disabled">
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Tgl. Pulang</label>
                          </div>
                          <div class="col-md-8">
                            <input name="title" id="title" type="text"  class="form-control" placeholder="Dalam Rangka" value="<?php echo dateIndo($td->date_spd_end); ?>" disabled="disabled">
                          </div>
                        </div>
                      </div>
                    </div>

                  <hr/>
                  <div class="row">
                    <div class="col-md-7 col-md-offset-2">
                    <?php if($td->is_deleted == 0 && ($sess_id == $created_by || $sess_nik == $task_creator)):?>
                    <div class='btn btn-primary text-center' title='Edit Approval' data-toggle="modal" data-target="#editModal"><i class='icon-edit'> Ubah PJD</i></div>
                      <?php endif ?>
                      <h5 class="text-center"><span class="semi-bold">Ketentuan Biaya Perjalanan Dinas</span></h5>
                      <p>&nbsp;</p>
                          <p class="bold">Grade Penerima Tugas : <span id="grade" class="semi-bold"><?php echo get_grade($tc_id)?></span></p>
                            <div class="row form-row">
                              <div class="col-md-12">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th width="2%">No</th>
                                    <th width="40%">Jenis Biaya</th>
                                    <th width="40%">Jumlah Biaya(Rp)</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php $total = 0;
                                  $i=1;foreach($biaya_pjd->result() as $row):
                                  $jumlah_biaya = (!empty($row->type)) ? $row->jumlah_biaya*$jml_pjd : $row->jumlah_biaya;
                                  $jumlah_hari = (!empty($row->type)) ? '/'.$jml_pjd.' hari' : '';
                                  $total += $jumlah_biaya;
                                ?>
                                  <tr>
                                    <td><?php echo $i++?></td>
                                    <td><?php echo $row->jenis_biaya.$jumlah_hari?></td>
                                    <td align="right"><?php echo number_format($jumlah_biaya, 0)?></td>
                                  </tr>
                                <?php endforeach; ?>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td align="right">Total :</td>
                                    <td align="right"><?php echo number_format($total, 0) ?></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

                      </div>
                      <hr/>
                      <?php 
                      for($i=1;$i<4;$i++):
                      $note_lv = 'note_lv'.$i;
                      $user_lv = 'user_app_lv'.$i;
                      if(!empty($td->$note_lv)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Note (<?php echo strtok(get_name($td->$user_lv), " ")?>):</label>
                        </div>
                        <div class="col-md-5">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $td->$note_lv ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                    <?php endfor;?>
                      <?php if(!empty($td->note_hrd)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Note (hrd): </label>
                        </div>
                        <div class="col-md-5">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $td->note_hrd ?></textarea>
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($td->cancel_note)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Alasan Cancel: </label>
                        </div>
                        <div class="col-md-5">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $td->cancel_note ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                    </div>

                <div class="form-actions text-center">
                    <!-- <div class="col-md-12 text-center"> -->
                      <div class="row wf-spd">
                        <div class="col-md-6">
                          <p>Yang Diberi Tugas</p>
                          <?php if ($this->session->userdata('user_id') == $td->task_receiver && $td->is_submit == 0|| get_nik($this->session->userdata('user_id')) == $td->task_receiver && $td->is_submit == 0) { ?>
                            <button id="btn_submit" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Submit</button>
                            <p class="">...............................</p>
                          <?php }elseif ($this->session->userdata('user_id') != $td->task_receiver && $td->is_submit == 0) { ?>
                            <p class="">...............................</p>
                          <?php }else{ ?>
                          <p class="wf-submit">
                            <span class="semi-bold"><?php echo get_name($td->task_receiver) ?></span><br/>
                            <span class="small"><?php echo dateIndo($td->date_submit) ?></span><br/>
                          </p>
                          <?php } ?>
                        </div>
                        <div class="col-md-6">
                          <p>Admin Pembuat Tugas</p>
                          <p class="wf-approve-sp">
                            <?php if($td->is_deleted == 0 && ($td->created_by == $sess_id || $td->task_creator == $sess_nik)){?>
                            <div class='btn btn-danger text-center' title='Batalkan PJD' data-toggle="modal" data-target="#cancelModal"><i class='icon-remove'> Batalkan PJD</i></div><br/>
                          <?php }elseif($td->is_deleted == 1){ 
                          echo '<img class=approval-img src='.assets_url("img/cancelled.png").'>';?><br/>
                          <span class="semi-bold"><?php echo get_name($td->task_creator) ?></span><br/>
                          <span class="small"><?php echo dateIndo($td->deleted_on) ?></span><br/>
                        <?php }else{ ?>
                            <span class="semi-bold"><?php echo get_name($td->task_creator) ?></span><br/>
                            <span class="small"><?php echo dateIndo($td->created_on) ?></span><br/>
                        <?php } ?>
                          </p>
                        </div>
                      </div>
                    <!-- /div> -->
                      <div class="form-actions">
                      <div class="col-md-12 text-center"><div class="col-md-12 text-center"><span class="semi-bold">Mengetahui,</span><br/><br/><br/></div>
                      
                      <div class="row form-row">
                        <div class="col-md-12 text-center">
                          <?php  if($td->is_app_lv1 == 1 && get_nik($sess_id) == $td->user_app_lv1){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalLv1"><i class='icon-edit'> Edit Approval</i></div>
                          <?php }elseif($td->is_app_lv2 == 1 && get_nik($sess_id) == $td->user_app_lv2){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalLv2"><i class='icon-edit'> Edit Approval</i></div>
                          <?php }elseif($td->is_app_lv3 == 1 && get_nik($sess_id) == $td->user_app_lv3){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalLv3"><i class='icon-edit'> Edit Approval</i></div>
                          <?php }elseif($td->is_app_hrd == 1 && get_nik($sess_id) == $td->user_app_hrd){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalHrd"><i class='icon-edit'> Edit Approval</i></div>
                          <?php } ?>
                        </div>
                      </div>

                      <div class="row wf-cuti">
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            $approved = assets_url('img/approved_stamp.png');
                            $rejected = assets_url('img/rejected_stamp.png');
                             $pending = assets_url('img/pending_stamp.png');
                            if(!empty($td->user_app_lv1) && $td->is_app_lv1 == 0 && get_nik($sess_id) == $td->user_app_lv1){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv1"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($td->user_app_lv1)?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo '('.get_user_position($td->user_app_lv1).')'?></span>
                            <?php }elseif(!empty($td->user_app_lv1) && $td->is_app_lv1 == 1){
                            echo ($td->app_status_id_lv1 == 1)?"<img class=approval-img src=$approved>": (($td->app_status_id_lv1 == 2) ? "<img class=approval-img src=$rejected>"  : (($td->app_status_id_lv1 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($td->user_app_lv1)?></span><br/>
                              <span class="small"><?php echo dateIndo($td->date_app_lv1)?></span><br/>
                              <span class="semi-bold"><?php echo '('.get_user_position($td->user_app_lv1).')'?></span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv1))?get_name($td->user_app_lv1):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv1))?'('.get_user_position($td->user_app_lv1).')':'';?></span>
                            <?php } ?>
                          </p>
                        </div>

                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($td->user_app_lv2) && $td->is_app_lv2 == 0 && get_nik($sess_id) == $td->user_app_lv2){?>
                             <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv2"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv2))?get_name($td->user_app_lv2):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo'('.get_user_position($td->user_app_lv2).')'?></span>
                            <?php }elseif(!empty($td->user_app_lv2) && $td->is_app_lv2 == 1){
                             echo ($td->app_status_id_lv2 == 1)?"<img class=approval-img src=$approved>": (($td->app_status_id_lv2 == 2) ? "<img class=approval-img src=$rejected>"  : (($td->app_status_id_lv2 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($td->user_app_lv2)?></span><br/>
                              <span class="small"><?php echo dateIndo($td->date_app_lv2)?></span><br/>
                              <span class="semi-bold"><?php echo '('.get_user_position($td->user_app_lv2).')'?></span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv2))?get_name($td->user_app_lv2):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv2))?'('.get_user_position($td->user_app_lv2).')':'';?></span>
                            <?php } ?>
                          </p>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($td->user_app_lv3) && $td->is_app_lv3 == 0 && get_nik($sess_id) == $td->user_app_lv3){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv3"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo  get_name($td->user_app_lv3)?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($td->user_app_lv3)?>)</span>
                            <?php }elseif(!empty($td->user_app_lv3) && $td->is_app_lv3 == 1){
                             echo ($td->app_status_id_lv3 == 1)?"<img class=approval-img src=$approved>": (($td->app_status_id_lv3 == 2) ? "<img class=approval-img src=$rejected>"  : (($td->app_status_id_lv3 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($td->user_app_lv3)?></span><br/>
                              <span class="small"><?php echo dateIndo($td->date_app_lv3)?></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($td->user_app_lv3)?>)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv3))?get_name($td->user_app_lv3):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv3))?'('.get_user_position($td->user_app_lv3).')':'';?></span>
                            <?php } ?>
                          </p>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if($td->is_app_hrd == 0 && $this->approval->approver('dinas') == $sess_nik){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalHrd"><i class="icon-ok"></i>Submit</div>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }elseif($td->is_app_hrd == 1){
                             echo ($td->app_status_id_hrd == 1)?"<img class=approval-img src=$approved>": (($td->app_status_id_hrd == 2) ? "<img class=approval-img src=$rejected>"  : (($td->app_status_id_hrd == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($td->user_app_hrd)?></span><br/>
                              <span class="small"><?php echo dateIndo($td->date_app_hrd)?></span><br/>
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
                  </div>
              </form>
                  </div>  
            </div>
          </div>
        </div>
      </div>
              
    
      </div>
    
  </div>  
  <!-- END PAGE -->

<!--Cancel Modal-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Konfirmasi Pembatalan Perjalan Dinas Luar Kota</h4>
        </div>
      <form class="form-no-horizontal-spacing" id="formcancel">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">
        <p>Apakah anda yakin ingin membatalkan Perjalan Dinas Ini ?</p>
      <div class="row form-row">
        <div class="col-md-12">
          <label class="form-label text-left">Alasan : </label>
        </div>
        <div class="col-md-12">
          <textarea name="cancel_note" class="form-control" placeholder="Isi alasan disini...."></textarea>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="icon-ban-circle"></i>&nbsp;Tidak</button> 
        <button type="submit" class="btn btn-danger" style="margin-top: 3px;" id="btn_cancel"><i class="icon-ok-sign"></i>&nbsp;Ya</button> 
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
  
<?php for($i=1;$i<4;$i++):?>
  <!--approval  Modal atasan -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="<?php echo 'submitModalLv'.$i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form</h4>
      </div>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="<?php echo 'formAppLv'.$i?>">
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
                      $checked = ($app->id <> 0 && $app->id == $td->$x) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv<?php echo $i.'-'.$app->id?>" type="radio" name="<?php echo 'app_status_lv'.$i?>" value="<?php echo $app->id?>" <?php echo $checked?>>
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
                <textarea name="<?php echo 'note_lv'.$i?>" class="form-control" placeholder="Isi note disini...."><?php echo $td->$y?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="<?php echo 'btn_app_lv'.$i?>"  class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal-->
<?php endfor;?>

<!--approval  Modal HRD -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="submitModalHrd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form</h4>
      </div>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formAppHrd">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $td->app_status_id_hrd) ? 'checked = "checked"' : '';
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
                <label class="form-label text-left">Note : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_hrd" class="form-control" placeholder="Isi note disini...."><?php echo $td->note_hrd?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="btn_app_hrd"  class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal--> 


<!--edit Modal HRD -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ubah Data PJD Luar Kota</h4>
      </div>
      <div class="modal-body">
        <!--<form class="form-no-horizontal-spacing"  id="formAppHrd">-->
        <?php echo form_open(site_url('form_spd_luar/edit/'.$id)) ?>
            <div class="row">
            <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Tgl. Berangkat</label>
                          </div>
                          <div class="col-md-8">
                            <div class="input-append date success no-padding">
                              <input type="text" id="from_date" class="form-control from_date" name="date_spd_start" value="<?php echo $spd_start ?>" required>
                              <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                            </div>
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Tgl. Pulang</label>
                          </div>
                          <div class="col-md-8">
                            <div class="input-append date success no-padding">
                              <input type="text" id="to_date" class="form-control to_date" name="date_spd_end" value="<?php echo $spd_end ?>" required>
                              <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                            </div>
                          </div>
                        </div>
                    <div class="col-md-7 col-md-offset-2">

                      <h5 class="text-center"><span class="semi-bold">Ketentuan Biaya Perjalanan Dinas</span></h5>
                      <div class="col-md-6 text-left">
                        <button type="button" id="btnAddBiaya" class="btn btn-primary btn-xs" onclick="addRow('dataTable')"><i class="icon-plus"></i>&nbsp;<?php echo 'Tambah Biaya';?></button>
                        <button type="button" id="btnRemove" class="btn btn-danger btn-xs" onclick="deleteRow('dataTable')" style="display: none;"><i class="icon-remove"></i>&nbsp;<?php echo 'Remove'?></button>
                      </div> 
                      <p>&nbsp;</p>
                          <p class="bold">Grade Penerima Tugas : <span id="grade" class="semi-bold"><?php echo get_grade($tc_id)?></span></p>
                            <div class="row form-row">
                              <div class="col-md-12">
                              <table id="dataTable" class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th width="2%"></th>
                                    <th width="2%">No</th>
                                    <th width="40%">Jenis Biaya</th>
                                    <th width="40%">Jumlah Biaya(Rp)</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php $total = 0;
                                  $i=1;foreach($biaya_pjd->result() as $row):
                                  //$jumlah_biaya = (!empty($row->type)) ? $row->jumlah_biaya*$jml_pjd : $row->jumlah_biaya;
                                  $jumlah_biaya = $row->jumlah_biaya;
                                  //$jumlah_hari = (!empty($row->type)) ? '/'.$jml_pjd.' hari' : '';
                                  $jumlah_hari = (!empty($row->type)) ? '/'.' hari' : '';
                                  $total += $jumlah_biaya;
                                ?>
                                  <tr>
                                    <td></td>
                                    <td><?php echo $i++?></td>
                                    <input type="hidden" name="biaya_id[]" value="<?php echo $row->id?>">
                                    <input type="hidden" name="biaya_tambahan_id[]" value="">
                                    <td><?php echo $row->jenis_biaya.$jumlah_hari?></td>
                                    <td align="right"><input type="text" name="jumlah_biaya[]" class="form-control" value="<?php echo number_format($jumlah_biaya, 0)?>"></td>
                                  </tr>
                                <?php endforeach; ?>
                                  <!--<tr>
                                    <td>&nbsp;</td>
                                    <td align="right">Total :</td>
                                    <td align="right"><?php echo number_format($total, 0) ?></td>
                                  </tr>-->
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="" type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal--> 



<?php endforeach;} ?>

<script type="text/javascript">
  function addRow(tableID){
  var table=document.getElementById(tableID);
  var rowCount=table.rows.length;
  var row=table.insertRow(rowCount);

  var cell1=row.insertCell(0);
  var element1=document.createElement("input");
  element1.type="checkbox";
  element1.name="chkbox[]";
  element1.className="checkbox1";
  cell1.appendChild(element1);

  var cell2=row.insertCell(1);
  cell2.innerHTML=rowCount+1-1;
  var cell3=row.insertCell(2);
  cell3.innerHTML = "<select name='biaya_tambahan_id[]' class='select2' style='width:100%'><?php foreach($biaya_tambahan->result() as $row):?><option value='<?php echo $row->id?>'><?php echo $row->title?></option><?php endforeach;?></select>";  
  var cell4=row.insertCell(3);
  cell4.innerHTML = "<input type='hidden' name='biaya_id[]' value=''><input type='text' name='jumlah_biaya[]' class='form-control text-right biaya-tambahan angka' value='0'>";
}
  function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}
</script>