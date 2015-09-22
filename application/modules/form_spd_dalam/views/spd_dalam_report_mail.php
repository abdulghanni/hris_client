<div id="container">
        <div class="row">
        <div class="col-md-12">
          <div class="grid simple">
            <div class="grid-title no-border">
              <h4>Form <a href="<?php echo site_url('form_spd_dalam')?>">Perjalanan Dinas <span class="semi-bold">Dalam Kota</span></a></h4>
            </div>
            <div class="grid-body no-border">
             <?php echo form_open_multipart('form_spd_dalam/add_report/'.$this->uri->segment(3));?>
                <div class="row column-seperation">
                  <div class="col-md-5">
                    <h4>Pelaksanaan Perjalanan Dinas</h4>
                    <?php if ($td_num_rows > 0) {
                      foreach ($task_detail as $td) : ?>      
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($td->task_receiver)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_organization($td->task_receiver)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_position($td->task_receiver)?>" disabled="disabled">
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
                    <div <?php ( ! empty($message)) && print('class="alert alert-info"'); ?> id="infoMessage"><?php echo $message;?></div>
                   
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
                      <div class="col-md-2">
                        <label class="form-label text-left">What</label>
                      </div>
                      <div class="col-md-10">
                        <input name="what" type="text"  class="form-control" placeholder="Isi Disini..." value="<?php echo $what?>" required <?php echo $disabled?>>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Why</label>
                      </div>
                      <div class="col-md-10">
                        <input name="why" type="text"  class="form-control" placeholder="Isi Disini..." value="<?php echo $why?>" required <?php echo $disabled?>>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Where</label>
                      </div>
                      <div class="col-md-10">
                        <input name="where" type="text"  class="form-control" placeholder="Isi Disini..." value="<?php echo $where?>" required <?php echo $disabled?>>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">When</label>
                      </div>
                      <div class="col-md-10">
                        <input name="when" type="text"  class="form-control" placeholder="Isi Disini..." value="<?php echo $when?>" required <?php echo $disabled?>>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Who</label>
                      </div>
                      <div class="col-md-10">
                        <input name="who" type="text"  class="form-control" placeholder="Isi Disini..." value="<?php echo $who?>" required <?php echo $disabled?>>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">How : </label>
                      </div>
                      <div class="col-md-12">
                        <textarea name="how" id="text-editor" placeholder="Hasil Kegiatan ..." class="form-control" rows="3" required <?php echo $disabled?>><?php echo $how?></textarea>
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
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php endforeach; } ?>