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
              <h4>Form <a href="<?php echo site_url('form_spd_luar_group')?>">Perjalanan Dinas <span class="semi-bold">Luar Kota (Group)</span></a></h4>
            </div>
            <div class="grid-body no-border">
              <form class="form-no-horizontal-spacing" id="form_spd_luar_group" action="<?php echo site_url().'form_spd_luar_group/do_submit/'.$id = $this->uri->segment(3, 0);?>" method="post"> 
                <div class="row column-seperation">
                  <div class="col-md-5">
                    <h4>Yang Memberi Tugas</h4>
                    <?php if ($td_num_rows > 0) {
                      foreach ($task_detail as $td) { 
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
                  </div>
                  <div class="col-md-7">
                    <h4>Memberi tugas / Ijin Kepada</h4>
                    
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
                          <label class="form-label text-left">Kota Tujuan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kota Tujuan" value="<?php echo $td->city_to; ?>" disabled>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Dari</label>
                        </div>
                        <div class="col-md-9">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kota Asal" value="<?php echo $td->city_from; ?>" disabled>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Kendaraan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kendaraan" value="<?php echo $td->transportation_nm; ?>" disabled>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Tgl. Berangkat</label>
                        </div>
                        <div class="col-md-8">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Tanggal Berangkat" value="<?php echo $td->date_spd_start; ?>" disabled>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Tgl. Pulang</label>
                        </div>
                        <div class="col-md-8">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Tanggal Pulang" value="<?php echo $td->date_spd_end; ?>" disabled>
                        </div>
                      </div>
                  </div>

                  &nbsp;<hr/>
                  <h5 class="text-center"><span class="semi-bold">Ketentuan Biaya Perjalanan Dinas</span></h5>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Dept/Bagian</th>
                        <th>Jabatan</th>
                        <th>Golongan</th>
                        <th>Hotel</th>
                        <th>Uang Makan</th>
                        <th>Uang Saku</th>
                        <th>Submit</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php for($i=0;$i<sizeof($receiver);$i++):?>
                      <tr>
                      <td><?php echo get_name($receiver[$i])?></td>
                        <td><?php echo get_user_organization($receiver[$i])?></td>
                        <td><?php echo get_user_position($receiver[$i])?></td>
                        <td><?php echo $ci->get_biaya_pjd($td->id, $receiver[$i])['grade']?></td>
                        <td>Rp. <?php echo number_format($ci->get_biaya_pjd($td->id, $receiver[$i])['hotel']*$jml_pjd,2)?></td>
                        <td>Rp. <?php echo number_format($ci->get_biaya_pjd($td->id, $receiver[$i])['uang_makan']*$jml_pjd,2)?></td>
                        <td>Rp. <?php echo number_format($ci->get_biaya_pjd($td->id, $receiver[$i])['uang_saku']*$jml_pjd,2)?></td>
                        <td class="text-center"><?php echo in_array($receiver[$i], $receiver_submit)?"<i class='icon-ok-sign' title = 'Submitted'></i>":"<i class='icon-minus' title = 'Pending'></i>"?></td>
                      </tr>
                      <?php endfor?>
                    </tbody>
                  </table>
                </div>
              </div>
                <div class="form-actions text-center">
                    <!-- <div class="col-md-12 text-center"> -->
                      <div class="row wf-spd">
                        <div class="col-md-6">
                          <p>Yang bersangkutan</p>
                          <?php if (in_array($this->session->userdata('user_id'), $receiver) && !in_array($this->session->userdata('user_id'), $receiver_submit)|| in_array(get_nik($this->session->userdata('user_id')),$receiver) && !in_array(get_nik($this->session->userdata('user_id')), $receiver_submit)) { ?>
                            <button id="btn_submit" class="btn btn-success btn-cons" type="submit"><i class="icon-ok"></i>Submit</button>
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
              </form>
            </div>
          </div>
        </div>
      </div>
	          	
		
      </div>
		
	</div>  
	<!-- END PAGE --> 