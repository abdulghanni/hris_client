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
              <h4>Form Keterangan Tidak <a href="<?php echo site_url('form_absen')?>"><span class="semi-bold">Absen</span></a></h4>
            </div>
            <div class="grid-body no-border">
              <form class="form-no-horizontal-spacing" id="formaddabsen" action="<?php echo site_url('form_absen/add')?>"> 
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
                    
                     <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama Karyawan</label>
                      </div>
                      <div class="col-md-9">
                      <?php 
                      if(is_admin()){?>
                        <select id="emp" class="select2" style="width:100%" name="emp" onchange="getDropDown()">
                          <?php
                          foreach ($all_users->result() as $u) :
                            $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                            <option value="<?php echo $u->id?>" <?php echo $selected?>><?php echo $u->username.' - '.get_nik($u->id); ?></option>
                          <?php endforeach; ?>
                        </select>
                      <?php }else{?>
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama Karyawan" value="<?php echo get_name($sess_id)?>" disabled="disabled">
                        <input name="emp" type="hidden" value="<?php echo $sess_id?>">
                      <?php } ?>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">No</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo $absen_id?>" disabled="disabled">
                      </div>
                    </div>
                    
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Tanggal</label>
                      </div>
                      <div class="col-md-8">
                        <div class="input-append date success no-padding">
                          <input type="text" class="form-control" name="date_tidak_hadir" required>
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                        </div>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="organization" id="organization" type="text"  class="form-control" placeholder="Organization" value="<?php echo (!empty(get_user_organization($sess_nik)))?get_user_organization($sess_nik):'-';?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Keterangan</label>
                      </div>
                      <div class="col-md-9">
                        <div class="radio">
                          <?php 
                          if($keterangan_absen->num_rows()>0){
                            foreach($keterangan_absen->result() as $row):?>
                            <input id="tidak_absen_in_<?php echo $row->id?>" type="radio" name="keterangan" value="<?php echo $row->id?>">
                            <label for="tidak_absen_in_<?php echo $row->id?>"><?php echo $row->title?></label>
                          <?php endforeach;}else{?>
                            <input id="tidak_absen_in" type="radio" name="keterangan" value="0">
                            <label for="tidak_absen_in">No Data</label>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Alasan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="alasan" id="alasan" type="text"  class="form-control" placeholder="Alasan" value="" required>
                      </div>
                    </div>
                    <?php if(is_admin()){?>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Izin Potong Cuti</label>
                      </div>
                      <div class="col-md-9">
                        <div class="radio">
                          <input id="potong_cuti_1" type="radio" name="potong_cuti" value="1">
                          <label for="potong_cuti_1">Ya</label>
                          <input id="potong_cuti_0" type="radio" name="potong_cuti" value="0" checked>
                          <label for="potong_cuti_0">Tidak</label>
                        </div>
                      </div>
                    </div>
                    <?php } ?>

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
                      <?php if(is_admin()){
                        $style_up='class="select2" style="width:100%" id="atasan2"';
                            echo form_dropdown('atasan2',array('0'=>'- Pilih Ka. Bagian -'),'',$style_up);
                        }else{?>
                        <select name="atasan2" id="atasan2" class="select2" style="width:100%">
                            <option value="0">- Pilih Ka. Bagian -</option>
                            <?php foreach ($user_atasan as $key => $up) : ?>
                            <option value="<?php echo $up['ID'] ?>"><?php echo $up['NAME']; ?></option>
                            <?php endforeach;?>
                        </select>
                      <?php }?>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-9">
                      <?php if(is_admin()){
                        $style_up='class="select2" style="width:100%" id="atasan3"';
                            echo form_dropdown('atasan3',array('0'=>'- Pilih Atasan Lainnya -'),'',$style_up);
                        }else{?>
                        <select name="atasan3" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan Lainnya -</option>
                            <?php foreach ($user_atasan as $key => $up) : ?>
                            <option value="<?php echo $up['ID'] ?>"><?php echo $up['NAME']; ?></option>
                            <?php endforeach;?>
                        </select>
                            <?php }?>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_absen')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
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

    function getDropDown()
    {
      getAtasan1();
      getAtasan2();
      getAtasan3();
    }

    function getAtasan1()
     {
         emp = document.getElementById("emp").value;
         $.ajax({
             url:"<?php echo base_url();?>form_absen/get_atasan/"+emp+"",
             success: function(response){
             $("#atasan1").html(response);
             },
             dataType:"html"
         });
         return false;
     }

     function getAtasan2()
     {
         emp = document.getElementById("emp").value;
         $.ajax({
             url:"<?php echo base_url();?>form_absen/get_atasan/"+emp+"",
             success: function(response){
             $("#atasan2").html(response);
             },
             dataType:"html"
         });
         return false;
     }

     function getAtasan3()
     {
         emp = document.getElementById("emp").value;
         $.ajax({
             url:"<?php echo base_url();?>form_absen/get_atasan/"+emp+"",
             success: function(response){
             $("#atasan3").html(response);
             },
             dataType:"html"
         });
         return false;
     }
  </script>
