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
                <h4>Form Pengajuan <span class="semi-bold"><a href="<?php echo site_url('form_demolition')?>">Demolition</a></span></h4>
              </div>
              <div class="grid-body no-border">
                <?php
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadddemolition');
                echo form_open('form_demolition/add', $att);
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
                            <select id="emp" class="" style="width:100%" name="emp">
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
                          <label class="form-label text-right">Tanggal Mulai Kerja</label>
                        </div>
                        <div class="col-md-9">
                          <input name="seniority_date" id="seniority_date" type="text"  class="form-control " placeholder="Tanggal Mulai Kerja" value=""  disabled="disabled" >
                        </div>
                      </div>
                    </div>

                    <div class="col-md-7">
                      <h4>Demolition Yang Diajukan</h4>
                      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Alasan Demolition</label>
                        </div>
                        <div class="col-md-8">
                          <input name="alasan" id="alasan" type="text"  class="form-control " placeholder="Alasan" value="" >
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Memenuhi Syarat</label>
                        </div>
                        <div class="col-md-8">
                          <label class="radio-inline">
                            <input type="radio" name="syarat" id="syarat1" required value="1">Ya
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="syarat" id="syarat2" value="0">Tidak
                          </label>
                        </div>
                      </div>

                      
                    </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_demolition')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
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
         url:"<?php echo base_url();?>form_demolition/get_org/"+buid+"",
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
         url:"<?php echo base_url();?>form_demolition/get_pos/"+orgid+"",
         success: function(response){
         $("#pos").html(response);
         },
         dataType:"html"
     });
     return false;
 }
</script>