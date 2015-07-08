<!-- BEGIN PAGE CONTAINER-->
<style>
th{border:2;}
</style>
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
              <h4>Form <a href="<?php echo site_url('form_spd_luar_group')?>">Perjalanan Dinas <span class="semi-bold">Luar Kota (Group)</span></a></h4>
            </div>
            <div class="grid-body no-border">
              <!--<form class="form-no-horizontal-spacing" id="form_spd_dalam" action="<?php echo site_url().'form_spd_luar_group/do_submit/'.$id = $this->uri->segment(3, 0);?>" method="post">-->
              <form class="form-no-horizontal-spacing" id="formSpdLuar"> <div class="row column-seperation">
                  <div class="col-md-12">
                    <h4>Yang Memberi Tugas</h4>
                    <?php if ($td_num_rows > 0) {
                      foreach ($task_detail as $td) { 
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
                        <input name="org" id="org" type="text"  class="form-control" placeholder="Nama" value="<?php echo (!empty($user_info))?$user_info['ORGANIZATION']:'-';?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Jabatan</label>
                      </div>
                      <div class="col-md-5">
                        <input name="position" id="position" type="text"  class="form-control" placeholder="Nama" value="<?php echo (!empty($user_info))?$user_info['POSITION']:'-';?>" disabled="disabled">
                      </div>
                    </div>
                  </div>
                  <p>&nbsp;</p>
                  <hr/>
                  <div class="col-md-12">
                    <h4>Memberi tugas / Ijin Kepada</h4>
                    <p></p>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <table id="dataTable" class="table table-bordered">
                          <thead>
                            <tr>
                                <th rowspan="2" class="text-center" width="2%">NIK</th>
                                <th rowspan="2" align="center" class="text-center" valign="middle" width="10%">Nama</th>
                                <th rowspan="2" class="text-center" width="2%">Grade</th>
                                <th colspan="<?php echo $biaya_tambahan->num_rows()+3?>" class="text-center">Biaya Perjalanan Dinas</th>
                            </tr>
                            <tr>
                              <th width="5%">Hotel</th>
                              <th width="5%">Uang Makan</th>
                              <th width="5%">Uang Saku</th>
                            <?php foreach($biaya_tambahan->result() as $row):?>
                              <th width="5%"><?php echo $row->title?></th>
                            <?php endforeach;?>
                            </tr>
                          </thead>
                            <tbody>
                            <?php foreach ($biaya_pjd_group->result() as $pjd):?>
                              <tr>
                                <td><?php echo $pjd->user_id?></td>
                                <td><?php echo get_name($pjd->user_id)?></td>
                                <td><?php echo get_grade($pjd->user_id)?></td>
                                <td><?php echo $pjd->hotel?></td>
                                <td><?php echo $pjd->uang_makan?></td>
                                <td><?php echo $pjd->uang_saku?></td>
                                <td><?php echo $pjd->biaya_entertain?></td>
                                <td><?php echo $pjd->biaya_taxi?></td>
                                <td><?php echo $pjd->biaya_toll?></td>
                                <td><?php echo $pjd->biaya_bbm?></td>
                                <td><?php echo $pjd->biaya_tiket_pesawat?></td>
                                <td><?php echo $pjd->biaya_lain?></td>
                              </tr>
                            <?php endforeach;?>
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
                        <div class="col-md-8">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Tanggal Berangkat" value="<?php echo dateIndo($td->date_spd_start); ?>" disabled>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Tgl. Pulang</label>
                        </div>
                        <div class="col-md-8">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Tanggal Pulang" value="<?php echo dateIndo($td->date_spd_end); ?>" disabled>
                        </div>
                      </div>
                  </div>

                  &nbsp;<hr/>
              
                </div>
              </div>
                <div class="form-actions text-center">
                    <!-- <div class="col-md-12 text-center"> -->
                      <div class="row wf-spd">
                        <div class="col-md-6">
                          <p>Yang bersangkutan</p>
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
                          <p>Yang memberi tugas / ijin</p>
                          <p class="wf-approve-sp">
                            <span class="semi-bold"><?php echo get_name($td->task_creator) ?></span><br/>
                            <span class="small"><?php echo dateIndo($td->created_on) ?></span><br/>
                          </p>
                          <?php  }
                    } ?>
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
                            if(!empty($td->user_app_lv1) && $td->is_app_lv1 == 0 && get_nik($sess_id) == $td->user_app_lv1){?>
                              <button id="btn_app_lv1" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Submit</button>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Supervisor)</span>
                            <?php }elseif(!empty($td->user_app_lv1) && $td->is_app_lv1 == 1){
                              echo "<img class=approval_img_md src=$approved>"?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($td->user_app_lv1)?></span><br/>
                              <span class="small"><?php echo dateIndo($td->date_app_lv1)?></span><br/>
                              <span class="semi-bold"></span>
                              <span class="semi-bold">(Supervisor)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv1))?'(Supervisor)':'';?></span>
                            <?php } ?>
                          </p>
                        </div>

                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($td->user_app_lv2) && $td->is_app_lv2 == 0 && get_nik($sess_id) == $td->user_app_lv2){?>
                              <button id="btn_app_lv2" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Submit</button>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Ka. Bagian)</span>
                            <?php }elseif(!empty($td->user_app_lv2) && $td->is_app_lv2 == 1){
                              echo "<img class=approval_img_md src=$approved>"?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($td->user_app_lv2)?></span><br/>
                              <span class="small"><?php echo dateIndo($td->date_app_lv2)?></span><br/>
                              <span class="semi-bold"></span>
                              <span class="semi-bold">(Ka. Bagian)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv2))?'(Ka. Bagian)':'';?></span>
                            <?php } ?>
                          </p>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($td->user_app_lv3) && $td->is_app_lv3 == 0 && get_nik($sess_id) == $td->user_app_lv3){?>
                              <button id="btn_app_lv3" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Submit</button>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($td->user_app_lv3)?>)</span>
                            <?php }elseif(!empty($td->user_app_lv3) && $td->is_app_lv3 == 1){
                              echo "<img class=approval_img_md src=$approved>"?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($td->user_app_lv3)?></span><br/>
                              <span class="small"><?php echo dateIndo($td->date_app_lv3)?></span><br/>
                              <span class="semi-bold"></span>
                              <span class="semi-bold">(<?php echo get_user_position($td->user_app_lv3)?>)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv3))?get_user_position($td->user_app_lv3):'';?></span>
                            <?php } ?>
                          </p>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if($td->is_app_hrd == 0 && is_admin()){?>
                              <button id="btn_app_hrd" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Submit</button>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }elseif($td->is_app_hrd == 1){
                              echo "<img class=approval_img_md src=$approved>"?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($td->user_app_hrd)?></span><br/>
                              <span class="small"><?php echo dateIndo($td->date_app_hrd)?></span><br/>
                              <span class="semi-bold"></span>
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