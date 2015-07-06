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
              <h4>Form Pengajuan <a href="<?php echo site_url('form_training')?>"><span class="semi-bold">Pelatihan</span></a></h4>
            </div>
            <div class="grid-body no-border">
              <!--<form class="form-no-horizontal-spacing" id="formaddtraining" action="<?php echo site_url('form_training/add')?>"> -->
              <?php echo form_open('form_training/add');?>
                <div class="row column-seperation">
                  <div class="col-md-12">
                  <?php if(is_admin()){?>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Nama Pengaju</label>
                      </div>
                      <div class="col-md-10">
                        <select id="emp" class="select2" style="width:100%" name="emp">
                          <?php
                          foreach ($all_users->result() as $u) :
                            $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                            <option value="<?php echo $u->id?>" <?php echo $selected?>><?php echo $u->username?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  <?php }else{ ?>
                    <input type="hidden" name="emp" value="<?php echo $sess_id?>">
                  <?php } ?>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-10">
                          <?php 
                          if(is_admin()){?>
                            <select id="peserta" class="select2" style="width:100%" name="peserta">
                                <option value="0">- Pilih Peserta Training - </option>
                            </select>
                          <?php }else{?>
                            <?php if($subordinate->num_rows() > 0){?>
                            <select id="peserta" class="select2" style="width:100%" name="peserta">
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
                      <div class="col-md-2">
                        <label class="form-label text-right">NIK</label>
                      </div>
                      <div class="col-md-10">
                        <input type="text" class="form-control" id="nik" name="nik" value="" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-10">
                        <input name="position" id="position" type="text"  class="form-control" placeholder="Jabatan" value="" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-10">
                        <input name="organization" id="organization" type="text"  class="form-control" placeholder="Dept/Bagian" value="" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Nama Program Pelatihan</label>
                      </div>
                      <div class="col-md-10">
                        <input name="training_name" id="form3LastName" type="text"  class="form-control" placeholder="Nama program pelatihan" value="" required>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Tujuan Pelatihan</label>
                      </div>
                      <div class="col-md-10">
                        <input name="tujuan_training" id="form3LastName" type="text"  class="form-control" placeholder="Tujuan pelatihan" value="" required>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="bold form-label text-right"><?php echo 'Approval' ?></label>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right"><?php echo 'Supervisor' ?></label>
                      </div>
                      <div class="col-md-10">
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
                        <label class="form-label text-right"><?php echo 'Ka. Bagian' ?></label>
                      </div>
                      <div class="col-md-10">
                        <select name="atasan2" id="atasan2" class="select2" style="width:100%">
                            <option value="0">- Pilih Ka. Bagian -</option>
                        </select>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-10">
                        <select name="atasan3" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan Lainnya -</option>
                        </select>
                      </div>
                    </div>


                  </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button class="btn btn-danger btn-cons" id="btnAdd" type="submit"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_training')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
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