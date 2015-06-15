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
              <h4>Form <a href="<?php echo site_url('form_spd_dalam_group')?>">Perjalanan Dinas <span class="semi-bold">Dalam Kota (Group)</span></a></h4>
            </div>
            <div class="grid-body no-border">
              <form class="form-no-horizontal-spacing" id="add_spd_dalam_group" action="<?php echo site_url() ?>form_spd_dalam_group/add" method="post"> 
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
                        <?php
                        foreach ($all_users as $up) { ?>
                          <option value="<?php echo (!empty(get_nik($up->id))) ? get_nik($up->id) : $up->id ?>"><?php echo $up->user_name; ?></option>
                        <?php } ?>
                      </select>
                      <?php }else{ ?>
                        <input type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($sess_id)?>" readonly>
                        <input id="emp_tc" onload="getTr()" name="emp_tc" type="hidden"  class="form-control" placeholder="Nama" value="<?php echo get_nik($sess_id)?>">
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
                      <div class="col-md-2">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <?php 
                      if(is_admin() || !is_admin()){?>
                      <div class="col-md-10">
                        <div id="peserta" >
                        </div>
                      </div>
                    <?php}else{?>
                      <div class="col-md-10">
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
                      <div class="col-md-2">
                        <label class="form-label text-right">Tujuan</label>
                      </div>
                      <div class="col-md-10">
                        <input name="destination" id="destination" type="text"  class="form-control" placeholder="Tujuan" value="" required>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Dalam Rangka</label>
                      </div>
                      <div class="col-md-10">
                        <input name="title" id="title" type="text"  class="form-control" placeholder="Dalam Rangka" value="" required>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Tgl. Berangkat</label>
                      </div>
                      <div class="col-md-8">
                        <div class="input-append date success no-padding">
                          <input type="text" class="form-control" name="date_spd" required>
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                        </div>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Waktu</label>
                      </div>
                      <div class="col-md-3">
                        <div class="input-append bootstrap-timepicker">
                          <input name="spd_start_time" id="timepicker2" type="text" class="timepicker-24" value="" required>
                          <span class="add-on">
                              <i class="icon-time"></i>
                          </span>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">s/d</label>
                      </div>
                      <div class="col-md-3">
                        <div class="input-append bootstrap-timepicker">
                          <input name="spd_end_time" id="timepicker2" type="text" class="timepicker-24" value="" required>
                          <span class="add-on">
                              <i class="icon-time"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_spd_dalam_group')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
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
             url:"<?php echo base_url();?>form_spd_dalam_group/get_tr/"+tcid+"",
             success: function(response){
             $("#peserta").html(response);
             },
             dataType:"html"
         });
         return false;
     }
  </script>