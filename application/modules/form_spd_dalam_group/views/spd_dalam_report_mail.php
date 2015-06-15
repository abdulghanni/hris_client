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