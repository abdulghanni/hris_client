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
              <h4>Form Keterangan Tidak <a href="<?php echo site_url('form_tidak_masuk')?>"><span class="semi-bold">Masuk</span></a></h4>
            </div>
            <div class="grid-body no-border">
              <!--<form class="form-no-horizontal-spacing" id="formaddtidak_masuk" action="<?php echo site_url('form_tidak_masuk/add')?>">--> 
              <?php 
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
                echo form_open('form_tidak_masuk/add', $att)?>;
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
                        <select id="emp" class="select2" style="width:100%" name="emp">
                          <?php
                          foreach ($all_users->result() as $u) :
                            $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                            <option value="<?php echo $u->id?>" <?php echo $selected?>><?php echo $u->username.' - '.get_nik($u->id); ?></option>
                          <?php endforeach; ?>
                        </select>
                      <?php }else{?>
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama Karyawan" value="<?php echo get_name($sess_id)?>" disabled="disabled">
                        <input name="emp" id="emp" type="hidden" value="<?php echo $sess_id?>">
                      <?php } ?>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="organization" id="organization" type="text"  class="form-control" placeholder="" value="" disabled="disabled">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="position" id="position" type="text"  class="form-control" placeholder="" value="" disabled="disabled">
                      </div>
                    </div>


                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Tanggal Tidak Masuk</label>
                      </div>
                      <div class="col-md-3">
                        <div id="datepicker_start" class="input-append date success no-padding">
                          <input type="text" class="form-control" name="dari_tanggal" required>
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                        </div>
                      </div>
                      <div class="col-md-1">
                        <label class="form-label text-center">s/d</label>
                      </div>
                      <div class="col-md-3">
                        <div id="datepicker_end" class="input-append date success no-padding">
                          <input type="text" class="form-control" name="sampai_tanggal" required>
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                        </div>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jumlah Hari</label>
                      </div>
                      <div class="col-md-1">
                        <input id="jml_hari" name="jml_hari" type="text"  class="form-control"  value="" readonly="readonly">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('cuti_remain') ?></label>
                      </div>
                      <div class="col-md-1">
                        <input name="sisa_cuti" id="sisa_cuti" type="text"  class="form-control" placeholder="-" value="<?php echo $sisa_cuti ['sisa_cuti']?>" readonly required>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Alasan</label>
                      </div>
                      <div class="col-md-9">
                        <div class="radio">
                        <?php foreach($alasan->result() as $al):?>
                          <input id="alasan<?= $al->id ?>" type="radio" name="alasan" value="<?= $al->id ?>">
                          <label for="alasan<?= $al->id ?>"><?= $al->title ?></label>
                        <?php endforeach;?>
                        </div>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Keterangan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="keterangan" id="keterangan" type="text"  class="form-control" placeholder="Isi Keterangan Disini...." value="" required>
                      </div>
                    </div>
                    <!--
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
                    -->

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="bold form-label text-right"><?php echo 'Approval' ?></label>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Langsung' ?></label>
                      </div>
                      <div class="col-md-9">
                        <?php
                          $style_up='class="select2" style="width:100%" id="atasan1"';
                              echo form_dropdown('atasan1',array('0'=>'- Pilih Atasan Langsung -'),'',$style_up);
                        ?>
                      </div>
                    </div>

                   <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Tidak Langsung' ?></label>
                      </div>
                      <div class="col-md-9">
                        <select name="atasan2" id="atasan2" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan Tidak Langsung -</option>
                        </select>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-9">
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
                    <a href="<?php echo site_url('form_tidak_masuk')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
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