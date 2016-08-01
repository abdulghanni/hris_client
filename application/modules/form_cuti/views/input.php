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
              <h4><?php echo lang('form'); ?> <span class="semi-bold"><a href="<?php echo site_url('form_cuti')?>"> Input <?php echo lang('form_cuti_subheading'); ?></a></span></h4>
            </div>
            <div class="grid-body no-border">
              <?php
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
                echo form_open_multipart('form_cuti/add', $att);
               ?>
                <div class="row column-seperation">
                  <div class="col-md-5">
                    <h4><?php echo lang('emp_info') ?></h4>
                    <?php 
                      $sess_id = $this->session->userdata('user_id');
                      $sess_nik = get_nik($sess_id);
                      //$cur_sess = date('Y');

                      //$sisa_cuti = $user->hak_cuti;
                     ?>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('name') ?></label>
                      </div>
                      <div class="col-md-9">
                        <?php if(is_admin()){
                        $style_up='class="select2" style="width:100%" id="emp"';
                            echo form_dropdown('emp',$users,'',$style_up);
                        }else{?>
                        <input type="text" class="form-control" value="<?php echo get_name($sess_id)?>" readonly>
                        <input type="hidden" name="emp" id="emp" value="<?php echo $sess_id?>">
                        <?php } ?>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">NIK</label>
                      </div>
                      <div class="col-md-9">
                        <input name="no" id="nik" type="text"  class="form-control" placeholder="-" value="<?php echo $sess_nik ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('start_working') ?></label>
                      </div>
                      <div class="col-md-9">
                        <input name="seniority_date" id="seniority_date" type="text"  class="form-control" placeholder="-" value="<?php echo dateIndo(get_user_sen_date($sess_nik)) ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('dept_div') ?></label>
                      </div>
                      <div class="col-md-9">
                        <input name="organization" id="organization" type="text"  class="form-control" placeholder="-" value="<?php echo get_user_organization($sess_nik) ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('position') ?></label>
                      </div>
                      <div class="col-md-9">
                        <input name="position" id="position" type="text"  class="form-control" placeholder="-" value="<?php echo get_user_position($sess_nik) ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('cuti_remain') ?></label>
                      </div>
                      <div class="col-md-9">
                        <input name="sisa_cuti" id="sisa_cuti" type="text"  class="form-control" placeholder="-" value="<?php echo $sisa_cuti ['sisa_cuti']?>" readonly required>
                      </div>
                    </div>
                    <input type="hidden" name="insert" value="<?php echo $sisa_cuti['insert']?>">
                    <p>&nbsp;</p>
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
                          $style_up='class="select2 atasan" style="width:100%" id="atasan1"';
                              echo form_dropdown('atasan1',array('0'=>'- Pilih Atasan Langsung -'),'0',$style_up);
                        ?>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Tidak Langsung' ?></label>
                      </div>
                      <div class="col-md-9">
                      <?php if(is_admin()){
                        $style_up='class="select2 atasan" style="width:100%" id="atasan2"';
                            echo form_dropdown('atasan2',array('0'=>'- Pilih Atasan Tidak Langsung -'),'',$style_up);
                        }else{?>
                        <select name="atasan2" id="atasan2" class="select2" style="width:100%">
                              <option value="0" selected="selected">- Pilih Atasan Tidak Langsung -</option> 
                        </select>
                        <?php }?>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Lainnya (Optional)' ?></label>
                      </div>
                      <div class="col-md-9">
                      <?php if(is_admin()){
                        $style_up='class="select2 atasan" style="width:100%" id="atasan3"';
                            echo form_dropdown('atasan3',array('0'=>'- Pilih Atasan Lainnya -'),'',$style_up);
                        }else{?>
                        <select name="atasan3" id="atasan3" class="select2 atasan" style="width:100%">
                            <option value="0">- Pilih Atasan Lainnya -</option>
                        </select>
                      <?php }?>
                      </div>
                    </div>
                    
                  </div>
                  <div class="col-md-7">
                    <h4><?php echo lang('cuti_input_subheading') ?></h4>
                    <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
                    <div class="row form-row"><div class="col-md-9 pull-right" style="margin: 10px 0px 20px 0px;" ><i class="icon-warning-sign" style="color:red ;text-shadow: 1px 1px 1px #ccc;font-size: 1em;"> Pengajuan permohonan cuti dilakukan 2(dua) minggu sebelumnya</i>
                        
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('start_cuti_date') ?></label>
                      </div>
                      <div class="col-md-3">
                        <div id="datepicker_start" class="input-append date success no-padding">
                          <input type="text" class="form-control" name="start_cuti" required>
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                        </div>
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-center">s/d</label>
                      </div>
                      <div class="col-md-3">
                        <div id="datepicker_end" class="input-append date success no-padding">
                          <input type="text" class="form-control" name="end_cuti" required>
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                        </div>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('count_day') ?></label>
                      </div>
                      <div class="col-md-2">
                        <input id="jml_hari" type="text"  class="form-control" placeholder="-"disabled="disabled">
                        <input type="hidden" name="jml_cuti" id="jml_cuti" value="">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Tipe Cuti</label>
                      </div>
                      <div class="col-md-9">
                        <select name="alasan_cuti" id="alasan_cuti" class="select2" style="width:100%">
                                <option value="0">- Pilih Alasan Cuti -</option>
                          <?php if (!empty($alasan_cuti)) { ?>
                              <?php for ($i=0;$i<sizeof($alasan_cuti);$i++) : ?>
                                <option value="<?php echo $alasan_cuti[$i]['HRSLEAVETYPEID']; ?>"><?php echo $alasan_cuti[$i]['DESCRIPTION']; ?></option>
                              <?php endfor; ?>                      
                          <?php } else {?>
                                <option value="0">No Data</option>
                            <?php } ?>
                        </select> 
                      </div>
                    </div>
                    <div class="row form-row" id="num_leave" style="display:none">
                      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
                    <div class="row form-row"><div class="col-md-9 pull-right" style="margin: 10px 0px 20px 0px;" ><i class="icon-warning-sign" style="color:red ;text-shadow: 1px 1px 1px #ccc;font-size: 1em;"> Jika jumlah hari melebihi jumlah cuti yang diberikan, maka akan memotong sisa cuti tahunan</i>
                        
                      </div>
                    </div>
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Jumlah cuti yang diberikan' ?></label>
                      </div>
                      <div class="col-md-2">
                        <input name="num_leave" id="num_leave_text" type="text"  class="form-control" placeholder="-" readonly="readonly">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('reason')?></label>
                      </div>
                      <div class="col-md-9">
                        <input name="remarks" id="remarks" type="text"  class="form-control" placeholder="-" required>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'No. HP' ?></label>
                      </div>
                      <div class="col-md-9">
                        <input name="contact" id="contact" type="text"  class="form-control" placeholder="-" required>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('addr_cuti') ?></label>
                      </div>
                      <div class="col-md-9">
                        <input name="alamat" id="alamat" type="text"  class="form-control" placeholder="-" required>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('replacement') ?></label>
                      </div>
                      <div class="col-md-9">
                        <?php
                          $style_up='class="select2" style="width:100%" id="user_pengganti"';
                              echo form_dropdown('user_pengganti',array('0'=>'- Pilih User -'),'',$style_up);
                        ?>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Attachment</label>
                      </div>
                      <div class="col-md-9">
                        <input name="attachment" id="attachment" type="file"  value="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                     <input name='user_id' id='user_id' value='<?php echo $this->session->userdata('user_id'); ?>' type='hidden'>
                    <button class="btn btn-success btn-cons" type="submit"><i class="icon-ok"></i> <?php echo lang('save_button') ?></button>
                    <a href="<?php echo site_url('form_cuti') ?>"><button class="btn btn-white btn-cons" type="button"><?php echo lang('cancel_button') ?></button></a>
                  </div>
                </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
              
    
      </div>
    
  </div>  
  <!-- END PAGE -->

