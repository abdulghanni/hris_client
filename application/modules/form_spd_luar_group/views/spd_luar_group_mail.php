<div id="container">
        <div class="row">
        <div class="col-md-12">
          <div class="grid simple">
            <div class="grid-title no-border">
              <h4>Form <a href="<?php echo site_url('form_spd_luar_group')?>">Perjalanan Dinas <span class="semi-bold">Luar Kota (Group)</span></a></h4>
            </div>
            <div class="grid-body no-border">
              <!--<form class="form-no-horizontal-spacing" id="form_spd_dalam" action="<?php echo site_url().'form_spd_luar_group/do_submit/'.$id = $this->uri->segment(3, 0);?>" method="post">-->
              <form class="form-no-horizontal-spacing" id="formSpdLuar"> <div class="row column-seperation">
                  <div class="col-md-12">
                    <h4>Admin Pembuat Tugas</h4>
                    <?php if ($td_num_rows > 0) {
                      foreach ($task_detail as $td) :
                        $a = strtotime($td->date_spd_end);
                        $b = strtotime($td->date_spd_start);

                        $j = $a - $b;
                        $jml_pjd = floor($j/(60*60*24)+1);
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
                        <label class="form-label text-left">Tujuan</label>
                      </div>
                      <div class="col-md-5">
                        <input name="destination" id="destination" type="text"  class="form-control" placeholder="Tujuan" value="<?php echo $td->destination ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Dalam Rangka</label>
                      </div>
                      <div class="col-md-5">
                        <input name="title" id="title" type="text"  class="form-control" placeholder="Dalam Rangka" value="<?php echo $td->title; ?>" disabled="disabled">
                      </div>
                    </div>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Kota Tujuan</label>
                        </div>
                        <div class="col-md-5">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kota Tujuan" value="<?php echo $td->city_to; ?>" disabled>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Dari</label>
                        </div>
                        <div class="col-md-5">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kota Asal" value="<?php echo $td->city_from; ?>" disabled>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Kendaraan</label>
                        </div>
                        <div class="col-md-5">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kendaraan" value="<?php echo $td->transportation_nm; ?>" disabled>
                        </div>
                      </div>
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

                  <h5 class="text-center"><span class="semi-bold">Ketentuan Biaya Perjalan Dinas Luar Kota (Group)</span></h5>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th width="15%">Nama</th>
                          <th width="1%">Gol</th>
                          <th width="10%" class="text-center">Uang Makan/<?php echo $jml_pjd.' Hari'?></th>
                          <th width="10%" class="text-center">Uang Saku/<?php echo $jml_pjd.' Hari'?></th>
                          <th width="10%" class="text-center">Hotel/<?php echo $jml_pjd.' Hari'?></th>
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
                              $c = $ci->db->select('users_spd_luar_group_biaya.jumlah_biaya')->from('users_spd_luar_group_biaya')->join('pjd_biaya','pjd_biaya.id = users_spd_luar_group_biaya.pjd_biaya_id', 'left')->where('user_spd_luar_group_id', $id)->where('user_id', $key->user_id)->where('pjd_biaya.type_grade != ', 0)->get();
                              foreach ($c->result() as $c) {
                              $total_fix += $c->jumlah_biaya*$jml_pjd;
                          ?>
                          <td align="right">

                          <?php $i++ ?>
                            <span class="fix<?php echo $i ?>"><?php echo number_format($c->jumlah_biaya*$jml_pjd, 0)?></span>
                          </td>
                          <?php }
                            $j = 0;
                            $b = $ci->db->select('users_spd_luar_group_biaya.jumlah_biaya')->from('users_spd_luar_group_biaya')->join('pjd_biaya','pjd_biaya.id = users_spd_luar_group_biaya.pjd_biaya_id', 'left')->where('user_spd_luar_group_id', $id)->where('user_id', $key->user_id)->where('pjd_biaya.type_grade', 0)->get();
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
                         <td colspan="2"><b>Sub Total</b></td>
                          <td id="totalfix1" class="total_fix" align="right"></td>
                          <td id="totalfix2" class="total_fix" align="right"></td>
                          <td id="totalfix3" class="total_fix" align="right"></td>
                          <?php $o = 0;foreach($biaya_pjd->result() as $b):$o++;?>
                            <td id="totaltambahan<?=$o?>" class="total_tambahan" align="right"></td>
                          <?php endforeach ?>
                        </tr>
                      <tr>
                        <td align="right" colspan="<?php $cs=4+sizeof($biaya_pjd->result());echo $cs;?>"><b>Total : Rp. <?php echo number_format($total_fix+$total_lain,0)?></b></td>
                      </tr>
                      </tbody>
                    </table>

                    <?php if(!empty($td->note_lv1)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Note (Atasan Langsung): </label>
                        </div>
                        <div class="col-md-5">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $td->note_lv1 ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if(!empty($td->note_lv2)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Note (Atasan Tidak Langsung): </label>
                        </div>
                        <div class="col-md-5">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $td->note_lv2 ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if(!empty($td->note_lv3)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Note (Atasan Lainnya): </label>
                        </div>
                        <div class="col-md-5">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $td->note_lv3 ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
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
                      
                </div>
                <div class="form-actions text-center">
                    <!-- <div class="col-md-12 text-center"> -->
                      <div class="row wf-spd">
                        <div class="col-md-6">
                          <p>Yang bersangkutan</p>
                          <?php if (in_array($this->session->userdata('user_id'), $receiver) && !in_array($this->session->userdata('user_id'), $receiver_submit)|| in_array(get_nik($this->session->userdata('user_id')),$receiver) && !in_array(get_nik($this->session->userdata('user_id')), $receiver_submit)) { ?>
                            <br/><p class="">...............................</p>
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
                            <span class="semi-bold"><?php echo get_name($td->task_creator) ?></span><br/>
                            <span class="small"><?php echo dateIndo($td->created_on) ?></span><br/>
                          </p>
                        </div>
                      </div>
                    <!-- /div> -->
                  </div>
                  <div class="form-actions">
                      <div class="col-md-12 text-center"><div class="col-md-12 text-center"><span class="semi-bold">Mengetahui,</span><br/><br/><br/></div>
                      

                      <div class="row wf-cuti">
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            $approved = assets_url('img/approved_stamp.png');
                            $rejected = assets_url('img/rejected_stamp.png');
                            if(!empty($td->user_app_lv1) && $td->is_app_lv1 == 0 && get_nik($sess_id) == $td->user_app_lv1){?>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/><span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($td->user_app_lv1)?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo '('.get_user_position($td->user_app_lv1).')'?></span>
                            <?php }elseif(!empty($td->user_app_lv1) && $td->is_app_lv1 == 1){
                             echo ($td->app_status_id_lv1 == 1)?"<img class=approval_img_md src=$approved>":(($td->app_status_id_lv1 == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
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
                            <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/> <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv2))?get_name($td->user_app_lv2):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo'('.get_user_position($td->user_app_lv2).')'?></span>
                            <?php }elseif(!empty($td->user_app_lv2) && $td->is_app_lv2 == 1){
                             echo ($td->app_status_id_lv2 == 1)?"<img class=approval_img_md src=$approved>":(($td->app_status_id_lv2 == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
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
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/><span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo  get_name($td->user_app_lv3)?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($td->user_app_lv3)?>)</span>
                            <?php }elseif(!empty($td->user_app_lv3) && $td->is_app_lv3 == 1){
                             echo ($td->app_status_id_lv3 == 1)?"<img class=approval_img_md src=$approved>":(($td->app_status_id_lv3 == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
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
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/><span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }elseif($td->is_app_hrd == 1){
                             echo ($td->app_status_id_hrd == 1)?"<img class=approval_img_md src=$approved>":(($td->app_status_id_hrd == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
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

      <?php endforeach;} ?>