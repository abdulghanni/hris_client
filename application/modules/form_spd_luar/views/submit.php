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
            </div>
            <div class="grid-body no-border">
              <form class="form-no-horizontal-spacing" id="form_spd_dalam" action="<?php echo site_url().'form_spd_luar/do_submit/'.$id = $this->uri->segment(3, 0);?>" method="post"> 
                <div class="row column-seperation">
                  <div class="col-md-5">
                    <h4>Yang Memberi Tugas</h4>   
                    <?php
                    if ($tc_num_rows > 0) {
                    foreach ($task_creator as $tc) :?>  
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                        <input name="name" id="name" type="text"  class="form-control" placeholder="Nama" value="<?php echo $tc->user_name?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="org" id="org" type="text"  class="form-control" placeholder="Nama" value="<?php echo (!empty($user_info))?$user_info['ORGANIZATION']:'-';?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="position" id="position" type="text"  class="form-control" placeholder="Nama" value="<?php echo (!empty($user_info))?$user_info['POSITION']:'-';?>" disabled="disabled">
                      </div>
                    </div>
                    <?php endforeach; 
                    }
                    ?> 
                  </div>
                  <div class="col-md-7">
                    <h4>Memberi tugas / Ijin Kepada</h4>
                        <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                        <input name="name" id="name" type="text"  class="form-control" placeholder="Nama" value="<?php echo $task_receiver_nm ?>" disabled="disabled">  
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="dept" id="dept" type="text"  class="form-control" placeholder="Dept/Bagian" value="<?php echo $task_receiver_org ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="dept" id="dept" type="text"  class="form-control" placeholder="Jabatan" value="<?php echo $task_receiver_pos ?>" disabled="disabled">
                      </div>
                    </div>
                        <?php if ($td_num_rows > 0) {
                      foreach ($task_detail as $td) { 
                        $a = strtotime($td->date_spd_end);
                        $b = strtotime($td->date_spd_start);

                        $j = $a - $b;
                        $jml_pjd = floor($j/(60*60*24)+1);
                        ?>
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
                  <h5 class="text-center"><span class="semi-bold">Ketentuan Biaya Perjalanan Dinas</span></h5>
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>Golongan</th>
                                <th>Hotel</th>
                                <th>Uang Makan</th>
                                <th>Uang Saku</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><?php echo $biaya_pjd['grade']?></td>
                                <td>Rp. <?php echo $biaya_pjd['hotel']*$jml_pjd?></td>
                                <td>Rp. <?php echo $biaya_pjd['uang_makan']*$jml_pjd?></td>
                                <td>Rp. <?php echo $biaya_pjd['uang_saku']*$jml_pjd?></td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                  </div>
                </div>
                <div class="form-actions text-center">
                    <!-- <div class="col-md-12 text-center"> -->
                      <div class="row wf-spd">
                        <div class="col-md-6">
                          <p>Yang bersangkutan</p>
                          <?php if ($this->session->userdata('user_id') == $td->task_receiver && $td->is_submit == 0|| get_nik($this->session->userdata('user_id')) == $td->task_receiver && $td->is_submit == 0) { ?>
                            <button id="btn_submit" class="btn btn-success btn-cons" type="submit"><i class="icon-ok"></i>Submit</button>
                            <p class="">...............................</p>
                          <?php }elseif ($this->session->userdata('user_id') != $td->task_receiver && $td->is_submit == 0) { ?>
                            <p class="">...............................</p>
                          <?php }else{ ?>
                          <p class="wf-submit">
                            <span class="semi-bold"><?php echo $task_receiver_nm ?></span><br/>
                            <span class="small"><?php echo dateIndo($td->date_submit) ?></span><br/>
                          </p>
                          <?php } ?>
                        </div>
                        <div class="col-md-6">
                          <p>Yang memberi tugas / ijin</p>
                          <p class="wf-approve-sp">
                            <span class="semi-bold"><?php echo $task_creator_nm ?></span><br/>
                            <span class="small"><?php echo dateIndo($td->created_on) ?></span><br/>
                          </p>
                          <?php  }
                    } ?>
                        </div>
                      </div>
                    <!-- /div> -->
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