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
                <h4>Form Pengajuan <span class="semi-bold"><a href="<?php echo site_url('form_promosi')?>">Promosi</a></span></h4>
              </div>
              <div class="grid-body no-border">
                <?php
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formaddpromosi');
                echo form_open('form_promosi/add', $att);
                ?>
                  <div class="row column-seperation">
                    <div class="col-md-5">
                      <h4>Informasi karyawan</h4>
                      
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Nama</label>
                        </div>
                        <div class="col-md-9">
                          <?php if(is_admin()){?>
                            <select id="emp" class="select2" style="width:100%" name="emp">
                              <?php
                              foreach ($all_users->result() as $u) :
                                $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                                <option value="<?php echo $u->id?>" <?php echo $selected?>><?php echo $u->username; ?></option>
                              <?php endforeach; ?>
                            </select>
                          <?php }else{?>
                            <?php if($subordinate->num_rows() > 0){?>
                            <select id="emp" class="select2" style="width:100%" name="emp">
                                <?php foreach($subordinate->result() as $row):?>
                            <option value="<?php echo $row->id?>"><?php echo get_name($row->id) ?></option>
                          <?php endforeach;?>
                        </select>
                            <?php }else{ ?>
                            <select>
                            <option value="0">-- Anda tidak mempunyai bawahan --</option>
                            </select>
                        <?php }}?>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">NIK</label>
                        </div>
                        <div class="col-md-9">
                          <input name="nik" id="nik" type="text"  class="form-control " placeholder="NIK" value=""  disabled="disabled">
                        </div>
                      </div>          
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Unit Bisnis</label>
                        </div>
                        <div class="col-md-9">
                          <input name="old_bu2" id="old_bu2" class="form-control " placeholder="Unit Bisnis" value=""  disabled="disabled">
                          <input name="old_bu" id="old_bu" type="hidden"  class="form-control " placeholder="Unit Bisnis" value="">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Dept/Bagian</label>
                        </div>
                        <div class="col-md-9">
                          <input name="old_org2" id="old_org2" class="form-control " placeholder="Dept/Bagian" value=""  disabled="disabled">
                          <input name="old_org" id="old_org" type="hidden"  class="form-control " placeholder="Unit Bisnis" value="">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Jabatan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="old_pos2" id="old_pos2" class="form-control " placeholder="Jabatan" value=""  disabled="disabled">
                          <input name="old_pos" id="old_pos" type="hidden"  class="form-control " placeholder="Unit Bisnis" value="">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Tanggal Pengangkatan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="sen_date" type="text"  class="form-control " placeholder="Nama" value=""  disabled="disabled" >
                        </div>
                      </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="bold form-label text-left"><?php echo 'Approval' ?></label>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left"><?php echo 'Supervisor' ?></label>
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
                        <label class="form-label text-left"><?php echo 'Ka. Bagian' ?></label>
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
                        <label class="form-label text-left"><?php echo 'Atasan Lainnya' ?></label>
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
                    <div class="col-md-7">
                      <h4>Promosi Yang Diajukan</h4>
                      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Unit Bisnis Baru</label>
                        </div>
                        <div class="col-md-8">
                          <?php
                            $style_bu='class="select2" style="width:100%" id="bu"  onChange="tampilOrg()"';
                            echo form_dropdown('bu',$bu,'',$style_bu);
                          ?>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Dept/Bagian Baru</label>
                        </div>
                        <div class="col-md-8">
                          <?php
                            $style_org='class="select2" id="org" onChange="tampilPos()" style="width:100%"';
                            echo form_dropdown("org",array('Pilih Organization'=>'- Pilih Organization -'),'',$style_org);
                          ?>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Jabatan Baru</label>
                        </div>
                       <div class="col-md-8">
                          <?php
                            $style_pos='class="select2" id="pos" style="width:100%"';
                            echo form_dropdown("pos",array('Pilih Position'=>'- Pilih Position -'),'',$style_pos);
                          ?>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Tgl. Pengangkatan</label>
                        </div>
                        <div class="col-md-8">
                          <div class="input-append date success no-padding">
                          <input type="text" class="form-control" name="date_promosi" required>
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                        </div>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Alasan Pengangkatan</label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="alasan" id="alasan" type="text"  class="form-control" placeholder="Alasan Pengangkatan" required></textarea>
                        </div>
                      </div>
                      
                    </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_promosi')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
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
  function tampilOrg()
 {
     buid = document.getElementById("bu").value;
     $.ajax({
         url:"<?php echo base_url();?>form_promosi/get_org/"+buid+"",
         success: function(response){
         $("#org").html(response);
         },
         dataType:"html"
     });
     return false;
 }
 
 function tampilPos()
 {
     orgid = document.getElementById("org").value;
     $.ajax({
         url:"<?php echo base_url();?>form_promosi/get_pos/"+orgid+"",
         success: function(response){
         $("#pos").html(response);
         },
         dataType:"html"
     });
     return false;
 }
</script>