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
                <h4>Form Pengajuan <span class="semi-bold"><a href="<?php echo site_url('form_resignment')?>">Resignment</a></span></h4>
              </div>
              <div class="grid-body no-border">
                <?php
                $att = array('class' => 'form-no-horizontal-spacing');
                echo form_open('form_resignment/add', $att);
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
                            <input type="text" class="form-control" value="<?php echo get_name($sess_id)?>" readonly>
                            <input type="hidden" value="<?php echo $sess_id?>" name="emp">
                        <?php }?>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">NIK</label>
                        </div>
                        <div class="col-md-9">
                          <input name="nik" id="nik" type="text"  class="form-control " placeholder="NIK" value="<?php echo $sess_nik?>"  disabled="disabled">
                        </div>
                      </div>          
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Unit Bisnis</label>
                        </div>
                        <div class="col-md-9">
                          <input name="bu" id="bu" class="form-control " placeholder="Unit Bisnis" value="<?php echo get_user_bu($sess_nik)?>"  disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Dept/Bagian</label>
                        </div>
                        <div class="col-md-9">
                          <input name="org2" id="organization" class="form-control " placeholder="Dept/Bagian" value="<?php echo get_user_organization($sess_nik)?>"  disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Jabatan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="pos2" id="position" class="form-control " placeholder="Jabatan" value="<?php echo get_user_position($sess_nik)?>"  disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Tanggal Mulai Kerja</label>
                        </div>
                        <div class="col-md-9">
                          <input name="seniority_date" id="seniority_date" type="text"  class="form-control " placeholder="Tanggal Mulai Kerja" value="<?php echo dateIndo(get_user_sen_date($sess_nik))?>"  disabled="disabled" >
                        </div>
                      </div>
                    </div>

                    <div class="col-md-7">
                      <h4>Resignment Yang Diajukan</h4>
                      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
                      <div class="col-md-4">
                        <label class="form-label text-left">Tanggal Akhir Kerja</label>
                      </div>
                      <div class="col-md-8">
                        <div class="input-append success date">
                          <input type="text" class="form-control" id="sandbox-advance" name="date_resign" required>
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span>
                        </div>    
                      </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="bold form-label text-left"><?php echo 'Approval' ?></label>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-4">
                        <label class="form-label text-left"><?php echo 'Supervisor' ?></label>
                      </div>
                      <div class="col-md-8">
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
                      <div class="col-md-4">
                        <label class="form-label text-left"><?php echo 'Ka. Bagian' ?></label>
                      </div>
                      <div class="col-md-8">
                        <select name="atasan2" id="atasan2" class="select2" style="width:100%">
                            <option value="0">- Pilih Ka. Bagian -</option>
                        </select>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-4">
                        <label class="form-label text-left"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-8">
                        <select name="atasan3" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan Lainnya -</option>
                        </select>
                      </div>
                    </div>

                      
                    </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_resignment')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
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
