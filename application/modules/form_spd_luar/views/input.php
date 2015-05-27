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
              <h4>Form Perjalanan Dinas <span class="semi-bold">Luar Kota</span></h4>
            </div>
            <div class="grid-body no-border">
              <form class="form-no-horizontal-spacing" id="add_spd_luar" action="<?php echo site_url() ?>form_spd_luar/add" method="post"> 
                <div class="row column-seperation">
                  <div class="col-md-5">
                    <h4>Yang Memberi Tugas</h4>
                    <?php if ($tc_num_rows > 0) {
                      foreach ($task_creator as $tc) : ?>  
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                        <?php if(is_admin()){?>
                      <select id="emp_tc" class="select2" style="width:100%" name="emp_tc" onChange="getTr()">
					  <option value="0">- Pilih User -</option>
                        <?php
                        foreach ($all_users as $up) {?>
                          <option value="<?php echo (!empty(get_nik($up->id))) ? get_nik($up->id) : $up->id ?>"><?php echo $up->user_name; ?></option>
                        <?php } ?>
                      </select>
                      <?php }else{ ?>
                        <select id="emp_tc" style="width:100%" name="emp_tc">
                          <option value="<?php echo (!empty(get_nik($tc->user_id))) ? get_nik($tc->user_id) : $tc->user_id ?>"><?php echo $tc->user_name; ?></option>
                      </select>
                      <?php } ?>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="org_tc" id="org_tc" type="text"  class="form-control" placeholder="Dept/Bagian" value="<?php echo (!empty($user_info))?$user_info['ORGANIZATION']:'-';?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="pos_tc" id="pos_tc" type="text"  class="form-control" placeholder="Jabatan" value="<?php echo (!empty($user_info))?$user_info['POSITION']:'-';?>" disabled="disabled">
                      </div>
                    </div>
                    <?php  endforeach;
                    } ?>   
                    
                  </div>
                  <div class="col-md-7">
                    <h4>Memberi tugas / Ijin Kepada</h4>
                    <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                        <?php if(is_admin()){
                        $style_tr='class="form-control input-sm" id="employee_sel"';
                            echo form_dropdown('employee',array('Pilih User'=>'- Pilih User -'),'',$style_tr);
                        }else{?>
                        <select id="employee_sel" class="select2" style="width:100%" name="employee" >
                          <?php if (!empty($task_receiver))  {
                            foreach ($task_receiver as $key => $up) { ?>
                              <option value="<?php echo $up['ID'] ?>"><?php echo $up['NAME']; ?></option>
                            <?php }
                          }else{
                            foreach ($task_receiver_2 as $up) { ?>
                              <option value="<?php echo (!empty(get_nik($up->id))) ? get_nik($up->id) : $up->id ?>"><?php echo $up->first_name.' '.$up->last_name; ?></option>
                            <?php }
                            }} ?>
                        </select>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="org_tr" id="org_tr" type="text"  class="form-control" placeholder="Dept/Bagian" value="" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="pos_tr" id="pos_tr" type="text"  class="form-control" placeholder="Jabatan" value="" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Tujuan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="destination" id="destination" type="text"  class="form-control" placeholder="Tujuan" value="" required>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dalam Rangka</label>
                      </div>
                      <div class="col-md-9">
                        <input name="title" id="title" type="text"  class="form-control" placeholder="Dalam Rangka" value="" required>
                      </div>
                    </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Kota Tujuan</label>
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
                            <label class="form-label text-right">Dari</label>
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
                            <label class="form-label text-right">Kendaraan</label>
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
                            <label class="form-label text-right">Tgl. Berangkat</label>
                          </div>
                          <div class="col-md-8">
                            <div class="input-append date success no-padding">
                              <input type="text" class="form-control" name="date_spd_start" value="">
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
                              <input type="text" class="form-control" name="date_spd_end" value="">
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
                    <a href="<?php echo site_url() ?>form_spd_luar"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
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
         tcid = document.getElementById("emp_tc").value;
         $.ajax({
             url:"<?php echo base_url();?>form_spd_luar/get_tr/"+tcid+"",
             success: function(response){
             $("#employee_sel").html(response);
             },
             dataType:"html"
         });
         return false;
     }
  </script>