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
              <form class="form-no-horizontal-spacing" id="" action="<?php echo site_url() ?>form_spd_luar_group/add" method="post"> 
                <div class="row column-seperation">
                  <div class="col-md-4">
                    <h4>Yang Memberi Tugas</h4> 
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Nama</label>
                      </div>
                      <div class="col-md-9">
                      <?php if(is_admin()){?>
                      <select id="emp" class="select2" style="width:100%" name="emp_tc" onChange="getTr()">
                        <?php
                        foreach ($all_users as $up) { ?>
                          <option value="<?php echo (!empty(get_nik($up->id))) ? get_nik($up->id) : $up->id ?>"><?php echo $up->username; ?></option>
                        <?php } ?>
                      </select>
                      <?php }else{ ?>
                        <input type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($sess_id)?>" readonly>
                        <input id="emp" onload="getTr()" name="emp_tc" type="hidden"  class="form-control" placeholder="Nama" value="<?php echo get_nik($sess_id)?>">
                      <?php } ?>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="org_tc" id="organization" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_organization($sess_nik);?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="pos_tc" id="position" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_position($sess_nik);?>" disabled="disabled">
                      </div>
                    </div> 

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="bold form-label text-right"><?php echo 'Approval' ?></label>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Supervisor' ?></label>
                      </div>
                      <div class="col-md-9">
                      <?php if(is_admin()){
                        $style_up='class="select2" style="width:100%" id="atasan1"';
                            echo form_dropdown('atasan1',array('0'=>'- Pilih Supervisor -'),'',$style_up);
                        }else{?>
                        <select name="atasan1" id="atasan1" class="select2" style="width:100%">
                            <option value="0">- Pilih Supervisor -</option>
                            <?php foreach ($user_atasan as $key => $up) : ?>
                              <option value="<?php echo $up['ID'] ?>"><?php echo $up['NAME']; ?></option>
                            <?php endforeach;?>
                        </select>
                        <?php }?>
                      </div>
                    </div>

                   <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Ka. Bagian' ?></label>
                      </div>
                      <div class="col-md-9">
                        <select name="atasan2" id="atasan2" class="select2" style="width:100%">
                            <option value="0">- Pilih Ka. Bagian -</option>
                        </select>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-9">
                        <select name="atasan3" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan Lainnya -</option>
                        </select>
                      </div>
                    </div> 
                    
                  </div>
                  <div class="col-md-8">
                    <h4>Memberi tugas / Ijin Kepada</h4>
                    <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Nama</label>
                      </div>
                      <?php 
                      if(is_admin() || !is_admin()){?>
                      <div class="col-md-9">
                        <div id="peserta_spd" >
                        </div>
                      </div>
                    <?php}else{?>
                      <div class="col-md-9">
                        <?php if(!empty($subordinate)){
                        for($i=0;$i<sizeof($subordinate);$i++):?>
                          <div class="col-md-5">
                            <div class="checkbox check-primary checkbox-circle" >
                              <input name="peserta[]" class="checkbox1" type="checkbox" id="peserta<?php echo $subordinate[$i]['ID'] ?>" value="<?php echo $subordinate[$i]['ID']?>">
                                <label for="peserta<?php echo $subordinate[$i]['ID'] ?>"><?php echo get_name($subordinate[$i]['ID'])?></label>
                             </div>
                          </div>
                        <?php endfor;} ?>
                      <?php } ?>
                      </div>
                    </div>
                    
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Tujuan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="destination" id="destination" type="text"  class="form-control" placeholder="Tujuan" value="" required>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Dalam Rangka</label>
                      </div>
                      <div class="col-md-9">
                        <input name="title" id="title" type="text"  class="form-control" placeholder="Dalam Rangka" value="" required>
                      </div>
                    </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-left">Kota Tujuan</label>
                          </div>
                          <div class="col-md-9">
                            <select id="city_to" name="city_to" class="select2" style="width:100%">
                              <?php if ($cl_num_rows > 0) {
                              foreach ($city_list as $cl) :
                              ?>    
                              <option value="<?php echo $cl->id ?>" ><?php echo $cl->title ?></option>
                            <?php endforeach;
                            } ?>
                            </select>
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-left">Dari</label>
                          </div>
                          <div class="col-md-9">
                            <select id="city_from" name="city_from" class="select2" style="width:100%">
                              <?php if ($cl_num_rows > 0) {
                              foreach ($city_list as $cl) :
                              ?>    
                              <option value="<?php echo $cl->id ?>" ><?php echo $cl->title ?></option>
                            <?php endforeach;
                            } ?>
                            </select>
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-left">Kendaraan</label>
                          </div>
                          <div class="col-md-9">
                            <select id="vehicle" name="vehicle" class="select2" style="width:100%">
                              <?php if ($tl_num_rows > 0) {
                              foreach ($transportation_list as $tl) :
                              ?>    
                              <option value="<?php echo $tl->id ?>" ><?php echo $tl->title ?></option>
                            <?php endforeach;
                            } ?>
                            </select>
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-left">Tgl. Berangkat</label>
                          </div>
                          <div class="col-md-8">
                            <div class="input-append date success no-padding">
                              <input type="text" class="form-control" name="date_spd_start" value="" required>
                              <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                            </div>
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-left">Tgl. Pulang</label>
                          </div>
                          <div class="col-md-8">
                            <div class="input-append date success no-padding">
                              <input type="text" class="form-control" name="date_spd_end" value="" required>
                              <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_spd_luar_group')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
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

  <script type="text/javascript">
    function getTr()
     {
         tcid = document.getElementById("emp").value;
         $.ajax({
             url:"<?php echo base_url();?>form_spd_luar_group/get_tr/"+tcid+"",
             success: function(response){
             $("#peserta_spd").html(response);
             },
             dataType:"html"
         });
         return false;
     }
  </script>