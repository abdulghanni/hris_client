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
                <h4>Form <span class="semi-bold">Promosi</span></h4>
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
                          <label class="form-label text-right">NIK</label>
                          
                        </div>
                        <div class="col-md-9">
                          <input name="nik" id="form3LastName" type="text"  class="form-control " placeholder="Nama" value="<?php echo get_nik($sess_id)?>"  disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Nama</label>
                        </div>
                        <div class="col-md-9">
                          <input name="name" id="form3LastName" type="text"  class="form-control " placeholder="Nama" value="<?php echo get_name($sess_id)?>"  disabled="disabled">
                        </div>
                      </div>          
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Unit Bisnis</label>
                        </div>
                        <div class="col-md-9">
                          <select name="old_bu" id="old_bu" class="select2" style="width:100%">
                            <option value="<?php echo (!empty($user_info['BUID']))?$user_info['BUID']:'-'?>"><?php echo $user_info['BU']?></option>
                          </select>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Dept/Bagian</label>
                        </div>
                        <div class="col-md-9">
                          <select name="old_org" id="old_org" class="select2" style="width:100%">
                            <option value="<?php echo (!empty($user_info['ORGID']))?$user_info['ORGID']:'-'?>"><?php echo $user_info['ORGANIZATION']?></option>
                          </select>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Jabatan</label>
                        </div>
                        <div class="col-md-9">
                          <select name="old_pos" id="old_pos" class="select2" style="width:100%">
                            <option value="<?php echo (!empty($user_info['POSID']))?$user_info['POSID']:'-'?>"><?php echo $user_info['POSITION']?></option>
                          </select>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Tanggal Pengangkatan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control " placeholder="Nama" value="<?php echo (!empty($user_info['SENIORITYDATE']))?dateIndo($user_info['SENIORITYDATE']):'-'?>"  disabled="disabled" >
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
                            $style_bu='class="form-control input-sm" id="bu"  onChange="tampilOrg()"';
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