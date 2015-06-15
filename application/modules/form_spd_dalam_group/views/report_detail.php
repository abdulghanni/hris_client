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
              <h4>Form <a href="<?php echo site_url('form_spd_dalam_group')?>">Perjalanan Dinas <span class="semi-bold">Dalam Kota (Group)</span></a></h4>
            </div>
            <div class="grid-body no-border">
             <?php echo form_open_multipart('form_spd_dalam_group/add_report/'.$this->uri->segment(3));?>
                <div class="row column-seperation">
                  <div class="col-md-5">
                    <h4>Pelaksanaan Perjalanan Dinas</h4>
                    <?php 
                    $report_creator = get_nik($report_creator);
                    if ($td_num_rows > 0) {
                      foreach ($task_detail as $td) : ?>      
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($report_creator)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_organization($report_creator)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_position($report_creator)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Tanggal Berangkat</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo dateIndo($td->date_spd) ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Tujuan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo $td->destination?>" disabled="disabled">
                      </div>
                    </div>
                    
                    
                  </div>
                  <div class="col-md-7">
                    <h4>Laporan Kegiatan PJD</h4>
                    <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
                   
                   <div class="row form-row">
                      <div class="col-md-4">
                        <label class="form-label text-left">Sudah Terlaksana : </label>
                      </div>
                        <div class="col-md-8">
                          <label class="radio-inline">
                            <input type="radio" name="is_done" id="is_done1" required value="1" <?php echo ($is_done==1)?'checked="checked"':''?>>Ya
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="is_done" id="is_done2" value="0" <?php echo ($is_done==0)?'checked="checked"':''?>>Tidak
                          </label>
                        </div>
                    </div>
                   <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Maksud dan Tujuan : </label>
                      </div>
                      <div class="col-md-12">
                        <textarea name="maksud" id="text-editor" placeholder="maksud dan tujuan ..." class="form-control" rows="5" required <?php echo $disabled?>><?php echo $tujuan?></textarea>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Hasil Kegiatan : </label>
                      </div>
                      <div class="col-md-12">
                        <textarea name="hasil" id="text-editor" placeholder="Hasil Kegiatan ..." class="form-control" rows="5" required <?php echo $disabled?>><?php echo $hasil?></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Attachment : </label>
                      </div>
                      <div class="col-md-12">
                      <?php if(file_exists('./uploads/pdf/'.$user_folder.'/'.$attachment)) {?>
                                                <a href="<?php echo base_url().'uploads/pdf/'.$user_folder.'/'.$attachment?>"><?php echo $attachment.' - Open File'?></a>
                                                <?php }elseif($attachment==2){
                                                echo 'No Attachment';}else{ ?>
                                                <input type='file' name='userfile' id="file" size='20' id='file'/>
                                                <?php } ?>
                      </div>
                    </div>
                    <?php if(get_nik($sess_id) == $report_creator){ ?>
                    <br/>
                    <div class="row form-row">
                      <div class="col-md-12" align="center">
                        <div class='btn btn-info btn-small' title='Edit Report' data-toggle="modal" data-target="#editspddalamModal"><i class='icon-edit'> Edit Report</i></div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                  </div>


                <div class="form-actions text-center">
                    <!-- <div class="col-md-12 text-center"> -->
                      <div class="row wf-spd">
                        <div class="col-md-6 pull-right">
                  <p>Yang bersangkutan</p>
                  <?php if ($this->session->userdata('user_id') == $td->task_receiver && $n_report== 0|| get_nik($this->session->userdata('user_id')) == $td->task_receiver && $n_report== 0) { ?>
                    <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_spd_dalam_group')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
                    <?php }elseif ($this->session->userdata('user_id') != $td->task_receiver && $n_report== 0) { ?>
                            <p class="">...............................</p>
                          <?php }elseif($this->session->userdata('user_id') == $td->task_receiver && $n_report== 1|| get_nik($this->session->userdata('user_id')) == $td->task_receiver && $n_report== 1){ ?>
                          <p class="wf-submit">
                            <span class="semi-bold"><?php echo get_name($report_creator) ?></span><br/>
                            <span class="small"><?php echo dateIndo($created_on) ?></span><br/>
                          </p>
                           <?php }else{?>
                          <p class="wf-submit">
                            <span class="semi-bold"><?php echo get_name($report_creator) ?></span><br/>
                            <span class="small"><?php echo dateIndo($created_on) ?></span><br/>
                          </p>
                          <?php } ?>
                  </div>
                </div>

                <?php endforeach; } ?>
              </form>
            </div>
          </div>
        </div>
      </div>
	          	
		
      </div>
		
	</div>  
	<!-- END PAGE --> 


<!-- Edit spd dalam Modal -->
<div class="modal fade" id="editspddalamModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo 'Laporan PJD'?></h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <?php echo form_open_multipart('form_spd_dalam_group/update_report/'.$id_report.'/'.get_id($report_creator))?>
            <h4>Laporan Kegiatan PJD</h4>
            <div class="row form-row">
              <div class="col-md-4">
                <label class="form-label text-left">Sudah Terlaksana : </label>
              </div>
                <div class="col-md-8">
                  <label class="radio-inline">
                    <input type="radio" name="is_done" id="is_done1" required value="1" <?php echo ($is_done==1)?'checked="checked"':''?>>Ya
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="is_done" id="is_done2" value="0" <?php echo ($is_done==0)?'checked="checked"':''?>>Tidak
                  </label>
                </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Maksud dan Tujuan : </label>
              </div>
              <div class="col-md-12">
                <textarea name="maksud" id="text-editor" placeholder="maksud dan tujuan ..." class="form-control" rows="5" required><?php echo $tujuan?></textarea>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Hasil Kegiatan : </label>
              </div>
              <div class="col-md-12">
                <textarea name="hasil" id="text-editor" placeholder="Hasil Kegiatan ..." class="form-control" rows="5" required><?php echo $hasil?></textarea>
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Attachment : </label>
              </div>
              <div class="col-md-12">
                <?php if(file_exists('./uploads/pdf/'.$user_folder.'/'.$attachment)) {?>
                                        <div id="file_old"><?php echo $attachment.' - '?><button onclick="removeFile()" type='button' class='btn btn-danger btn-small' title='Remove File'><i class='icon-remove'></i></button></div>
                                        <input type='file' name='userfile' id="file" style="display:none;" />
                                        <?php }elseif($attachment==2){?>
                                        <input type='file' name='userfile' id="file"/>
                                        <?php } ?>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit" class="btn btn-primary lnkBlkWhtArw" name="btn_add" id="btnRetPass" style="margin-top: 3px;"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button> 
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end add modal-->

<script type="text/javascript">
  function removeFile(){
    $('#file_old').hide();
    $('#file').show();
  }
</script>