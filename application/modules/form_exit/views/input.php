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
                <h4>Form Rekomendasi <span class="semi-bold"><a href="<?php echo site_url('form_exit')?>">Karyawan Keluar</a></span></h4>
              </div>
              <div class="grid-body no-border">
                 <?php //echo form_open("form_exit/add",array("id"=>"formaddexit"));?>
                 <?php echo form_open("form_exit/add",array("id"=>"formadd"));?>
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <?php if(!empty($user_id) && $sess_nik == $superior):?>
                      <div class="col-md-3">
                        <input type="text"  class="form-control" value="<?php echo get_name($user_id)?>" disabled="disabled">
                        <input name="emp" id="emp"  type="hidden" value="<?php echo $user_id?>">
                      </div>
                    <?php else: ?>
                      <div class="col-md-3">
                        <?php if(is_admin()){?>
                          <select id="empExit" class="select2" style="width:100%" name="emp">
                          <?php
                          foreach ($all_users->result() as $u) :
                            $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                            <option value="<?php echo $u->id?>" <?php echo $selected?>><?php echo $u->username; ?></option>
                          <?php endforeach; ?>
                        </select>
                        <?php }else{?>
                            <input type="hidden" name="empatasan" id="empSess" value="<?php echo $sess_id ?>">
                            <?php if($subordinate->num_rows() > 0){?>
                            <select id="emp" class="select2" style="width:100%" name="emp">
                            <option value="0">-- Pilih Karyawan --</option>
                                <?php foreach($subordinate->result() as $row):?>
                            <option value="<?php echo $row->id?>"><?php echo get_name($row->id) ?></option>
                            <?php endforeach;?>
                        </select>
                            <?php }else{ ?>
                            <select style="width:100%" name="emp" required>
                            <option value="">-- Anda tidak mempunyai bawahan --</option>
                            </select>
                        <?php }}?>
                      </div>
                    <?php endif; ?>

                      <div class="col-md-2">
                        <label class="form-label text-right">Wilayah</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="" disabled="disabled">
                      </div>

                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">NIK</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="nik" type="text"  class="form-control" placeholder="NIK" value="" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="Dept/Bagian" value="" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="position" type="text"  class="form-control" placeholder="Jabatan" value="" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Tanggal Keluar</label>
                      </div>
                    <?php if(!empty($user_id) && $sess_nik == $superior):?>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="sandbox-advance" value="<?php echo dateIndo($date_exit)?>" readonly>
                        <input type="hidden" name="date_exit" value="<?php echo $date_exit ?>">
                      </div>
                    <?php else: ?>
                      <div class="col-md-3">
                        <div class="input-append success date">
                          <input type="text" class="form-control" id="sandbox-advance" name="date_exit" required>
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span>
                        </div>    
                      </div>
                    <?php endif; ?>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Tipe Rekomendasi</label>
                      </div>

                    <?php if(!empty($user_id) && $sess_nik == $superior):?>
                    <div class="col-md-3">
                      <input type="text" class="form-control" value="Resign" readonly>
                      <input type="hidden" name="exit_type_id" value="3">
                    </div>
                    <?php else: ?>
                      <div class="col-md-3">
                        <select class="select2" style="width:100%" name="exit_type_id">
                        <?php
                          if($exit_type->num_rows>0){
                            foreach($exit_type->result() as $row):?>
                          <option value="<?php echo $row->id?>"><?php echo $row->title?></option>
                        <?php endforeach;}?>
                        </select>
                      </div>
                    <?php endif; ?>
                    </div>
                      
                    <div id="inventory">
                    </div>
                    
                    <div class="row form-row">
                      <div class="col-md-12">
                        <h4>Kami rekomendasikan kepada karyawan tersebut</h4>
                      </div>
                    </div>
                    <div class="row form-row">
                    <div class="col-md-12">
                      <table class="table no-more-tables">
                        <tr>
                          <td>1</td>
                          <td>Diberikan Uang Pesangon</td>
                          <td>
                            <label class="radio-inline">
                              <input type="radio" name="pesangon" id="pesangon1" required value="1">Ya
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="pesangon" id="pesangon2" value="0">Tidak
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Diberikan uang pengganti hak</td>
                          <td>
                            <label class="radio-inline">
                              <input type="radio" name="uang_ganti" id="uang_ganti1" required value="1">Ya
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="uang_ganti" id="uang_ganti2" value="0">Tidak
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Diberikan uang jasa</td>
                          <td>
                            <label class="radio-inline">
                              <input type="radio" name="uang_jasa" id="uang_jasa1" required value="1">Ya
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="uang_jasa" id="uang_jasa2" value="0">Tidak
                            </label>
                          </td>
                        </tr>
                        <!--
                        <tr>
                          <td>4</td>
                          <td>Diberikan uang Pisah</td>
                          <td>
                            <label class="radio-inline">
                              <input type="radio" name="uang_pisah" id="uang_pisah1" required value="1">Ya
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="uang_pisah" id="uang_pisah2" value="0">Tidak
                            </label>
                          </td>
                        </tr>
                        -->
                        <tr>
                          <td>4</td>
                          <td>Diberikan surat keterangan kerja</td>
                          <td>
                            <label class="radio-inline">
                              <input type="radio" name="skkerja" id="skkerja1" required value="1">Ya
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="skkerja" id="skkerja2" value="0">Tidak
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Diberikan ijazah asli ybs</td>
                          <td>
                            <label class="radio-inline">
                              <input type="radio" name="ijazah" id="ijazah1" required value="1">Ya
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="ijazah" id="ijazah2" value="0">Tidak
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>Diberikan uang Pisah (untuk resign/pengunduran diri)</td>
                          <td>
                            <label class="radio-inline">
                              <input type="radio" name="uang_pisah" id="uang_pisah1" required value="1">Ya
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="uang_pisah" id="uang_pisah2" value="0">Tidak
                            </label>
                          </td>
                        </tr>
                      </table>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="bold form-label text-left"><?php echo 'Approval' ?></label>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left"><?php echo 'Atasan Langsung' ?></label>
                      </div>
                      <div class="col-md-4">
                      <?php 
                        $style_up='class="select2" style="width:100%" id="atasan1"';
                            echo form_dropdown('atasan1',array('0'=>'- Pilih Atasan Langsung -'),'',$style_up);
                      ?>
                      </div>
                    </div>

                   <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left"><?php echo 'Atasan Tidak Langsung' ?></label>
                      </div>
                      <div class="col-md-4">
                        <select name="atasan2" id="atasan2" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan Tidak Langsung -</option>
                        </select>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-4">
                        <select name="atasan3" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan Lainnya -</option>
                        </select>
                      </div>
                    </div>


                    <div id="asmen"></div>

                    </div>

                        
                      
                  </div>
                  <?php if($subordinate->num_rows() > 0 || is_admin()){?>
                  <div class="form-actions">
                    <div class="pull-right">
                      <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                      <a href="<?php echo site_url('form_exit')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
                    </div>
                  </div>
                  <?php }?>
                </form>
              </div>
          </div>
        </div>
      </div>
              
    
      </div>
    
  </div>  
  <!-- END PAGE --> 
