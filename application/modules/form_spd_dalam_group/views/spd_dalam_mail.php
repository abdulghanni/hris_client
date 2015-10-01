<div id="container">
        <div class="row">
        <div class="col-md-12">
          <div class="grid simple">
            <div class="grid-title no-border">
              <h4>Form <a href="<?php echo site_url('form_spd_dalam_group')?>">Perjalanan Dinas <span class="semi-bold">Dalam Kota (Group)</span></a></h4><br/>
              No : <?= get_form_no($id) ?>
             </div>
            <div class="grid-body no-border">
             <!-- <form class="form-no-horizontal-spacing" id="form_spd_dalam_group" action="<?php echo site_url().'form_spd_dalam_group/do_submit/'.$id = $this->uri->segment(3, 0);?>" method="post"> -->
              <form class="form-no-horizontal-spacing" id="formSpdDalam"> 
                <div class="row column-seperation">
                  <div class="col-md-5">
                    <h4>Admin Pembuat Tugas</h4>
                    <?php if ($td_num_rows > 0) {
                      foreach ($task_detail as $td) : ?>
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
                      <div class="col-md-12">
                        <!--<textarea id="text-editor" placeholder="" class="form-control" rows="3"  disabled="disabled"><?php echo $task_receiver_nm?></textarea>-->
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>Nama</th>
                                <th>Dept/Bagian</th>
                                <th>Jabatan</th>
                                <th>Submit</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php for($i=0;$i<sizeof($receiver);$i++):?>
                              <tr>
                                <td><?php echo get_name($receiver[$i])?></td>
                                <td><?php echo get_user_organization($receiver[$i])?></td>
                                <td><?php echo get_user_position($receiver[$i])?></td>
                                <td class="text-center"><?php echo in_array($receiver[$i], $receiver_submit)?"<i class='icon-ok-sign' title = 'Submitted'></i>":"<i class='icon-minus' title = 'Pending'></i>"?></td>
                              </tr>
                            <?php endfor?>
                            </tbody>
                          </table>
                      </div>
                    </div>
                    <br/>
                    
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Tujuan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="destination" id="destination" type="text"  class="form-control" placeholder="Tujuan" value="<?php echo $td->destination ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Dalam Rangka</label>
                      </div>
                      <div class="col-md-9">
                        <input name="title" id="title" type="text"  class="form-control" placeholder="Dalam Rangka" value="<?php echo $td->title; ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Tgl. Berangkat</label>
                      </div>
                      <?php $task_date = dateIndo($td->date_spd) ?>
                      <div class="col-md-8">
                        <!-- <div class="input-append date success no-padding"> -->
                          <input type="text" class="form-control" name="start_cuti" value="<?php echo $task_date; ?>" disabled="disabled">
                          <!-- <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> --> 
                        <!-- </div> -->
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Waktu</label>
                      </div>
                      <div class="col-md-3">
                            <input type="text" class="form-control" name="spd_start_time" value="<?php echo date('H:i:s',strtotime($td->start_time)) ?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-left">s/d</label>
                      </div>
                      <div class="col-md-3">
                            <input type="text" class="form-control" name="spd_start_time" value="<?php echo date('H:i:s',strtotime($td->end_time)) ?>" disabled="disabled">
                      </div>
                    </div>

                    <?php 
                      for($i=1;$i<4;$i++):
                      $note_lv = 'note_lv'.$i;
                      $user_lv = 'user_app_lv'.$i;
                      if(!empty($td->$note_lv)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Note (<?php echo strtok(get_name($td->$user_lv), " ")?>):</label>
                        </div>
                        <div class="col-md-9">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $td->$note_lv ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                    <?php endfor;?>
                      <?php if(!empty($td->note_hrd)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Note (hrd): </label>
                        </div>
                        <div class="col-md-9">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $td->note_hrd ?></textarea>
                        </div>
                      </div>
                      <?php } ?>

                      
                  </div>
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
                              <span class="small"></span><br/> <span class="semi-bold"></span><br/>
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

          <?php endforeach;} ?>