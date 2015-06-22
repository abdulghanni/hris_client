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
              <h4>Form Karyawan <span class="semi-bold"><a href="<?php echo site_url('form_resignment')?>">Keluar</a></span></h4>
            </div>
            <div class="grid-body no-border">
              <?php echo form_open("form_resignment/add",array("id"=>"formaddresign"));?>
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-3">
                      <?php 
                      if(is_admin()){?>
                        <select id="emp" class="select2" style="width:100%" name="emp" onchange="getDropDown()">
                          <?php
                          foreach ($all_users->result() as $u) :
                            $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                            <option value="<?php echo $u->id?>" <?php echo $selected?>><?php echo $u->username?></option>
                          <?php endforeach; ?>
                        </select>
                      <?php }else{?>
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama Karyawan" value="<?php echo get_name($sess_id)?>" disabled="disabled">
                        <input name="emp" type="hidden" value="<?php echo $sess_id?>">
                      <?php } ?>
                      </div>

                      <div class="col-md-2">
                        <label class="form-label text-right">Wilayah</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="<?php echo get_user_bu($sess_nik)?>" disabled="disabled">
                      </div>

                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">NIK</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="nik" type="text"  class="form-control" placeholder="NIK" value="<?php echo $sess_nik?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="Dept/Bagian" value="<?php echo get_user_organization($sess_nik)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="position" type="text"  class="form-control" placeholder="Jabatan" value="<?php echo get_user_position($sess_nik)?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Tanggal Akhir Kerja</label>
                      </div>
                      <div class="col-md-3">
                        <div class="input-append success date">
                          <input type="text" class="form-control" id="sandbox-advance" name="date_resign" required>
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span>
                        </div>    
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Alasan Berhenti Bekerja</label>
                      </div>
                    </div>
                    
                    <div class="row form-row">
                      <div class="col-md-12">
                        <div class="checkbox check-primary checkbox-circle" >
                            <?php
                              if($alasan_resign->num_rows()>0){
                                  foreach($alasan_resign->result() as $row):?>

                            <input id="alasan-<?php echo $row->id?>" class="checkbox1" type="checkbox" name="alasan_resign_id[]" value="<?php echo $row->id?>">
                            <label for="alasan-<?php echo $row->id?>"><?php echo $row->title?></label>
                            <?php endforeach;}?>
                          </div>
                        </div>
                      </div>
                    </div>

                    

                      
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Apa alasan utama berhenti bekerja dari perusahaan ini? Jelaskan</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="desc_resign" required></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Adakah prosedur perusahaan yang membuat anda tidak nyaman atau tidak bisa maksimum menjalankan tugasnya?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="procedure_resign" required></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Adakah hal yang memuaskan dari pekerjaan anda sekarang?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="kepuasan_resign" required></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Adakah saran untuk kami?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="saran_resign" required></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Apakah anda mempertimbangkan di masa datang untuk kembali bekerja di perusahaan ini? ?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="rework_resign" required></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="bold form-label text-left"><?php echo 'Approval' ?></label>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left"><?php echo 'Supervisor' ?></label>
                      </div>
                      <div class="col-md-5">
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
                      <div class="col-md-2">
                        <label class="form-label text-left"><?php echo 'Ka. Bagian' ?></label>
                      </div>
                      <div class="col-md-5">
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
                      <div class="col-md-2">
                        <label class="form-label text-left"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-5">
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
                <div class="form-actions">
                  <div class="pull-right">
                    <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_resignment')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
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
             url:"<?php echo base_url();?>form_resignment/get_atasan/"+emp+"",
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
             url:"<?php echo base_url();?>form_resignment/get_atasan/"+emp+"",
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
             url:"<?php echo base_url();?>form_resignment/get_atasan/"+emp+"",
             success: function(response){
             $("#atasan3").html(response);
             },
             dataType:"html"
         });
         return false;
     }
  </script> 