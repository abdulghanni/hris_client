BEGIN PAGE CONTAINER-->
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
              <h4>Form <a href="<?php echo site_url('form_pjd_training')?>">Perjalanan Dinas Training/Meeting <span class="semi-bold"></span></a></h4><br/>
              <?php if ($td_num_rows > 0) {?>
              <a href="<?php echo site_url('form_pjd_training/pdf/'.$id)?>" target="_blank"><button class="btn btn-primary pull-right"><i class="icon-print"> Cetak</i></button></a><br/>
              No : <?= get_form_no($id) ?>
            </div>
            <div class="grid-body no-border">
              <!--<form class="form-no-horizontal-spacing" id="form_spd_dalam" action="<?php echo site_url().'form_pjd_training/do_submit/'.$id = $this->uri->segment(3, 0);?>" method="post">-->
              <form class="form-no-horizontal-spacing" id="formSpdLuar"> <div class="row column-seperation">
                  <div class="col-md-12">
                    <h4>Admin Pembuat Tugas</h4>
                    <?php
                      foreach ($task_detail as $td) :
                        $a = strtotime($td->date_spd_end);
                        $b = strtotime($td->date_spd_start);

                        $j = $a - $b;
                        $jml_pjd = floor($j/(60*60*24)+1);
                        /*if($jml_pjd != 1){
                          $jml_pjd = $jml_pjd-1;
                        }else{
                          $jml_pjd = 1;
                        }*/
                        ?>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Nama</label>
                      </div>
                      <div class="col-md-5">
                        <input name="name" id="name" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($td->task_creator) ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Dept/Bagian</label>
                      </div>
                      <div class="col-md-5">
                        <input name="org" id="org" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_organization($td->task_creator)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Jabatan</label>
                      </div>
                      <div class="col-md-5">
                        <input name="position" id="position" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_position($td->task_creator)?>" disabled="disabled">
                      </div>
                    </div>
                  </div>
                  <p>&nbsp;</p>
                  <hr/>
                  <div class="col-md-12">
                    <h4>Memberi Tugas Kepada</h4>
                    <p></p>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <table id="dataTable" class="table table-bordered">
                          <thead>
                              <tr>
                                <th width="2%">No</th>
                                <th width="5%">NIK</th>
                                <th width="20%">Nama</th>
                                <th width="5%">Golongan</th>
                                <th width="20%">Dept/Bagian</th>
                                <th width="20%">Jabatan</th>
                                <th width="8%">Submit</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php for($i=0;$i<sizeof($receiver);$i++):
                              ?>
                              <tr>
                              <td height="50" align="center"><?php echo $i+1?></td>
                              <td  align="center"><?php echo $receiver[$i]?></td>
                              <td>&nbsp;<?php echo get_name($receiver[$i])?></td>
                                <td  align="center"><?php echo get_grade($receiver[$i])?></td>
                                <td>&nbsp;<?php echo get_user_organization($receiver[$i])?></td>
                                <td>&nbsp;<?php echo get_user_position($receiver[$i])?></td>
                                <td align="center"><?php echo in_array($receiver[$i], $receiver_submit)?"Ya":"-"?></td>
                              </tr>
                              <?php endfor?>
                            </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Tujuan PJD</label>
                      </div>
                      <div class="col-md-5">
                        <input name="destination" id="destination" type="text"  class="form-control" placeholder="Tujuan" value="<?php echo $td->destination ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Deskripsi</label>
                      </div>
                      <div class="col-md-5">
                        <textarea class="form-control" readonly="readonly"><?php echo $td->title; ?></textarea>
                      </div>
                    </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Dari Cabang</label>
                        </div>
                        <div class="col-md-5">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kota Asal" value="<?php echo get_bu_name($td->from_city_id); ?>" disabled>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Ke Cabang</label>
                        </div>
                        <div class="col-md-5">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kota Tujuan" value="<?php echo get_bu_name($td->to_city_id); ?>" disabled>
                        </div>
                      </div>

                      <?php for($i=0;$i<sizeof($kota);$i++):
                              ?>
                        <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Kota Tujuan</label>
                        </div>
                        <div class="col-md-5">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kota Tujuan" value="<?php echo 1+$i.'. '.get_user_location($kota[$i]) ?>" disabled>
                        </div>
                      </div>
                    <?php endfor; ?>
                      <?php for($i=0;$i<sizeof($kendaraan);$i++):
                              ?>
                        <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Kendaraan</label>
                        </div>
                        <div class="col-md-5">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kota Tujuan" value="<?php echo 1+$i.'. '.getValue('title','transportation', array('id'=>'where/'.$kendaraan[$i])) ?>" disabled>
                        </div>
                      </div>
                    <?php endfor; ?>
                    <?php if(!empty($td->nama_kantor_cabang)):?>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Nama Kantor Cabang</label>
                        </div>
                        <div class="col-md-5">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="" value="<?php echo $td->nama_kantor_cabang; ?>" disabled>
                        </div>
                      </div>
                    <?php endif;?>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Tgl. Berangkat</label>
                        </div>
                        <div class="col-md-5">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Tanggal Berangkat" value="<?php echo dateIndo($td->date_spd_start); ?>" disabled>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Tgl. Pulang</label>
                        </div>
                        <div class="col-md-5">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Tanggal Pulang" value="<?php echo dateIndo($td->date_spd_end); ?>" disabled>
                        </div>
                      </div>
                  </div>

                  &nbsp;<hr/>
                  <?php if($td->is_deleted == 0 && ($sess_id == $created_by || $sess_nik == $task_creator)):?>
                  <a href="<?php echo site_url('form_pjd_training/edit_biaya/'.$id)?>"><div class='btn btn-primary text-center' title='Edit PJD'><i class='icon-edit'> Ubah PJD</i></div></a>
                  <?php endif; ?>
                  <h5 class="text-center"><span class="semi-bold">Ketentuan Biaya Perjalan Dinas </span></h5>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th width="15%">Nama</th>
                          <th width="1%">Gol</th>
                          <th width="10%" class="text-center">Uang Makan/<?php echo $jml_pjd.' Hari'?></th>
                          <!-- <th width="10%" class="text-center">Uang Saku/<?php echo $jml_pjd.' Hari'?></th>
                          <th width="10%" class="text-center">Hotel/<?php $j = $jml_pjd-1; echo ($jml_pjd>1) ? "$j malam" : '';?></th> -->
                          <?php 
                            $total_fix = 0;
                            $total_lain = 0;
                            foreach($biaya_pjd->result() as $b):
                          ?>
                          <th width="10%" class="text-center"><?php echo $b->jenis_biaya?></th>
                        <?php endforeach; ?> 
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($detail->result() as $key):?>
                        <tr>
                          <td>
                            
                            <?php echo get_name($key->user_id)?>
                          </td>
                          <td class="text-center">
                            <?php echo get_grade($key->user_id)?>
                          </td>
                          <?php $i = 0;
                              $c = $ci->db->select('users_spd_training_biaya.jumlah_biaya,users_spd_training_biaya.pjd_biaya_id')->from('users_spd_training_biaya')->join('pjd_biaya','pjd_biaya.id = users_spd_training_biaya.pjd_biaya_id', 'left')->where('user_spd_luar_group_id', $id)->where('user_id', $key->user_id)->where('pjd_biaya.type_grade != ', 0)->get();
                              foreach ($c->result() as $c) {
                                if($c->pjd_biaya_id%3 == 0){
                                  //$total_fix += $c->jumlah_biaya*($jml_pjd-1);
                                  $total_fix += $c->jumlah_biaya;
                                }else{
                                 //$total_fix += $c->jumlah_biaya*$jml_pjd;
                                 $total_fix += $c->jumlah_biaya;
                                }
                          ?>
                          <td align="right">

                          <?php $i++ ;
                            if($c->pjd_biaya_id%3 == 0){
                                  //$b_fix = $c->jumlah_biaya*($jml_pjd-1);
                                  $b_fix = $c->jumlah_biaya;
                                }else{
                                 //$b_fix = $c->jumlah_biaya*$jml_pjd;
                                 $b_fix = $c->jumlah_biaya;
                                }
                          ?>
                            <span class="fix<?php echo $i ?>"><?php echo number_format($b_fix, 0)?></span>
                          </td>
                          <?php }
                            $j = 0;
                            $b = $ci->db->select('users_spd_training_biaya.jumlah_biaya')->from('users_spd_training_biaya')->join('pjd_biaya','pjd_biaya.id = users_spd_training_biaya.pjd_biaya_id', 'left')->where('user_spd_luar_group_id', $id)->where('user_id', $key->user_id)->where('pjd_biaya.type_grade', 0)->get();
                              foreach ($b->result() as $b) {
                                $total_lain += $b->jumlah_biaya;
                          ?>
                          <?php $j++ ?>
                          <td align="right"><span class="tambahan<?php echo $j ?>"><?php echo number_format($b->jumlah_biaya, 0)?></span></td>
                            <?php } ?>
                        </tr>
                      <?php 
                      endforeach ?>
                      <tr>
                         <td colspan="2"><b>Sub Total(Rp)</b></td>
                          <td id="totalfix1" class="total_fix" align="right"><?= $uang_makan ?></td>
                          <!-- <td id="totalfix2" class="total_fix" align="right"><?= $uang_saku?></td>
                          <td id="totalfix3" class="total_fix" align="right"><?= $hotel?></td> -->
                          <?php foreach($biaya_pjd->result() as $b):;
                            $biaya_tambahan = $this->db->select("(SELECT SUM(jumlah_biaya) FROM users_spd_training_biaya WHERE user_spd_luar_group_id=$id and pjd_biaya_id = $b->biaya_id) AS uang_makan", FALSE)->get()->row_array();
                            $tambahan = $biaya_tambahan['uang_makan'];?>
                            <td  class="total_tambahan" align="right"><?= number_format($tambahan, 0) ?></td>
                          <?php endforeach ?>
                        </tr>
                      <tr>
                        <td align="right" colspan="<?php $cs=3+sizeof($biaya_pjd->result());echo $cs;?>"><b>Total : Rp. <?php echo number_format($total_fix+$total_lain,0)?></b></td>
                      </tr>
                      </tbody>
                    </table>
                    <div id="note">
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
                            <textarea name="notes_spv" class="form-control" readonly="readonly"><?php echo $td->$note_lv ?></textarea>
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
                          <textarea name="notes_spv" class="form-control" readonly="readonly"><?php echo $td->note_hrd ?></textarea>
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($td->cancel_note)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Alasan Cancel: </label>
                        </div>
                        <div class="col-md-5">
                          <textarea name="notes_spv" class="form-control" readonly="readonly"><?php echo $td->cancel_note ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                <div class="form-actions text-center">
                    <!-- <div class="col-md-12 text-center"> -->
                      <div class="row wf-spd">
                        <div class="col-md-6">
                          <p>Yang Diberi Tugas</p>
                          <?php if (in_array($this->session->userdata('user_id'), $receiver) && !in_array($this->session->userdata('user_id'), $receiver_submit)|| in_array(get_nik($this->session->userdata('user_id')),$receiver) && !in_array(get_nik($this->session->userdata('user_id')), $receiver_submit)) { ?>
                            <button id="btn_submit" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Submit</button>
                            <p class="">...............................</p>
                          <?php }elseif(in_array($this->session->userdata('user_id'), $receiver) && in_array($this->session->userdata('user_id'), $receiver_submit)|| in_array(get_nik($this->session->userdata('user_id')),$receiver) && in_array(get_nik($this->session->userdata('user_id')), $receiver_submit)) { ?>
                            <span class="semi-bold"><?php echo get_name($this->session->userdata('user_id')) ?></span><br/>
                            <span class="small"><?php echo dateIndo($td->date_submit) ?></span><br/>
                          <?php }else{ ?>
                          <p class="wf-submit">
                            <p class="">...............................</p>
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
                        <?php }else{
                            echo '<img class=approval-img src='.assets_url("img/signed.png").'>';?><br/>
                            <span class="semi-bold"><?php echo get_name($td->task_creator) ?></span><br/>
                            <span class="small"><?php echo dateIndo($td->created_on) ?></span><br/>
                        <?php } ?>
                          </p>
                        </div>
                      </div>
                    <!-- /div> -->
                  </div>
                  <div class="form-actions">
                      <div class="col-md-12 text-center"><div class="col-md-12 text-center"><span class="semi-bold">Mengetahui,</span><br/><br/><br/></div>
                      
                      <div class="row form-row">
                        <div class="col-md-12 text-center">
                        <?php  
                        for($i=1;$i<4;$i++):
                          $is_app = 'is_app_lv'.$i;
                          $user_app = 'user_app_lv'.$i;
                          if($td->$is_app == 1 && get_nik($sess_id) == $td->$user_app){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalLv<?php echo $i ?>"><i class='icon-edit'> Edit Approval</i></div>
                            <div class='btn btn-warning btn-small text-center' title='Kirim Notifikasi' onClick="send_notif_('lv<?php echo $i?>')"><i class='icon-mail-forward'> Kirim Notifikasi</i></div>
                        <?php }endfor;
                          if($td->is_app_hrd == 1 && get_nik($sess_id) == $this->approval->approver('dinas', $td->task_creator)){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalHrd"><i class='icon-edit'> Edit Approval</i></div>
                        <?php } ?>
                        </div>
                      </div>

                      <div class="row wf-cuti">
                        <div class="col-md-3" id="lv1">
                          <p class="wf-approve-sp">
                            <?php
                            $hide = (sizeof($receiver_submit)<sizeof($receiver)) ? 'style="display:none"' : '';
                            $approved = assets_url('img/approved_stamp.png');
                            $rejected = assets_url('img/rejected_stamp.png');
                             $pending = assets_url('img/pending_stamp.png');
                            if(!empty($td->user_app_lv1) && $td->is_app_lv1 == 0 && get_nik($sess_id) == $td->user_app_lv1){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv1" ><i class="icon-ok"></i>Submit</div>
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

                        <div class="col-md-3" id="lv2">
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($td->user_app_lv2) && $td->is_app_lv2 == 0 && get_nik($sess_id) == $td->user_app_lv2){?>
                             <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv2"><i class="icon-ok" <?= $hide ?>></i>Submit</div>
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
                          
                        <div class="col-md-3" id="lv3">
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($td->user_app_lv3) && $td->is_app_lv3 == 0 && get_nik($sess_id) == $td->user_app_lv3){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv3"><i class="icon-ok" <?= $hide ?>></i>Submit</div>
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
                          
                        <div class="col-md-3" id="hrd">
                          <p class="wf-approve-sp">
                            <?php 
                            if($td->is_app_hrd == 0 && $this->approval->approver('dinas', $creator_nik) == $sess_nik){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalHrd" <?= $hide ?>><i class="icon-ok"></i>Submit</div>
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
        <p>Apakah anda yakin ingin membatalkan Perjalan Dinas Ini?</p>
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
                      $checked = ($app->id <> 0 && $app->id == $td->$x) ? 'checked = "checked"' : '';
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
                <textarea name="<?php echo 'note_lv'.$i?>" class="form-control" placeholder="Isi note disini...."><?php echo $td->$y?></textarea>
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

<!--approval  Modal HRD -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="submitModalHrd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form</h4>
      </div>
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
                      $checked = ($app->id <> 0 && $app->id == $td->app_status_id_hrd) ? 'checked = "checked"' : '';
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
                <label class="form-label text-left">Note : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_hrd" class="form-control" placeholder="Isi note disini...."><?php echo $td->note_hrd?></textarea>
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
<!--end approve modal--> 

<!--edit  Modal-->
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
                              <input type="text" id="from_date" class="form-control from_date" name="date_spd_start" value="" required>
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
                              <input type="text" id="to_date" class="form-control to_date" name="date_spd_end" value="" required>
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




<?php endforeach;}else{
  echo "Pengajuan dibatalkan";
  } ?>

<!--
<script type="text/javascript">
window.onload = function(){fix();};  
  function fix(){
      for (var i = 1; i < 4; i++) {
        total = 0;
        $('.fix'+i).each(function (index, element) {
            var num = parseInt($(element).text().replace(/,/g,""));
            total = total + num;
        });
        $('#totalfix'+i).html('<b>'+total+'</b>');
     }
     tambahan();
  }

  function tambahan(){
      <?php $t = sizeof($biaya_pjd->result());?>
       for (var i = 1; i <= <?=$t?>; i++) {
        total = 0;
        $('.tambahan'+i).each(function (index, element) {
            var num = parseInt($(element).text().replace(/,/g,""));
            total = total + num;
        });
        $('#totaltambahan'+i).html('<b>'+total+'</b>');
      }
  }
  </script>
 