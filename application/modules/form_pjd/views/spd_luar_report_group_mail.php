<div class="grid-title no-border">
              <h4>Form <a href="<?php echo site_url('form_pjd')?>">Perjalanan Dinas <span class="semi-bold"></span></a></h4>
            </div>
            <div class="grid-body no-border">
             <?php echo form_open_multipart('form_pjd/add_report/'.$this->uri->segment(3));?>
                <div class="row column-seperation">
                  <div class="col-md-5">
                    <h4>Pelaksanaan Perjalanan Dinas</h4>
                    <?php 
                    $report_creator = get_nik($report_creator);
                    if ($td_num_rows > 0) {
                      foreach ($task_detail as $td) : ?>      
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Nama</label>
                      </div>
                      <div class="col-md-9">
                        <input name="name" id="name" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($created_by) ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="org" id="org" type="text"  class="form-control" placeholder="Nama" value="<?php echo (!empty(get_user_organization($created_by)))?get_user_organization($created_by):'-';?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="position" id="position" type="text"  class="form-control" placeholder="Nama" value="<?php echo (!empty(get_user_position($created_by)))?get_user_position($created_by):'-';?>" disabled="disabled">
                      </div>
                    </div>
                     <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Tujuan PJD</label>
                      </div>
                      <div class="col-md-9">
                        <input name="destination" id="destination" type="text"  class="form-control" placeholder="Tujuan" value="<?php echo $td->destination ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Deskripsi</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" disabled="disabled"><?php echo $td->title; ?></textarea>
                      </div>
                    </div>

                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Dari Cabang</label>
                        </div>
                        <div class="col-md-9">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kota Asal" value="<?php echo get_bu_name($td->from_city_id); ?>" disabled>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Ke Cabang</label>
                        </div>
                        <div class="col-md-9">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kota Tujuan" value="<?php echo get_bu_name($td->to_city_id); ?>" disabled>
                        </div>
                      </div>

                      <?php for($i=0;$i<sizeof($kota);$i++):
                              ?>
                        <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Kota Tujuan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kota Tujuan" value="<?php echo 1+$i.'. '.get_user_location($kota[$i]) ?>" disabled>
                        </div>
                      </div>
                    <?php endfor; ?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Kendaraan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kendaraan" value="<?php echo $td->transportation_nm; ?>" disabled>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Tgl. Berangkat</label>
                        </div>
                        <div class="col-md-8">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Tanggal Berangkat" value="<?php echo $td->date_spd_start; ?>" disabled>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Tgl. Pulang</label>
                        </div>
                        <div class="col-md-8">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Tanggal Pulang" value="<?php echo $td->date_spd_end; ?>" disabled>
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
                      <div class="col-md-2">
                        <label class="form-label text-left">What</label>
                      </div>
                      <div class="col-md-10">
                        <input name="what" type="text"  class="form-control" placeholder="Isi Disini..." value="<?php echo $what?>" required>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Why</label>
                      </div>
                      <div class="col-md-10">
                        <input name="why" type="text"  class="form-control" placeholder="Isi Disini..." value="<?php echo $why?>" required>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Where</label>
                      </div>
                      <div class="col-md-10">
                        <input name="where" type="text"  class="form-control" placeholder="Isi Disini..." value="<?php echo $where?>" required>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">When</label>
                      </div>
                      <div class="col-md-10">
                        <input name="when" type="text"  class="form-control" placeholder="Isi Disini..." value="<?php echo $when?>" required>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Who</label>
                      </div>
                      <div class="col-md-10">
                        <input name="who" type="text"  class="form-control" placeholder="Isi Disini..." value="<?php echo $who?>" required>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">How : </label>
                      </div>
                      <div class="col-md-12">
                        <textarea name="how" id="text-editor" placeholder="Hasil Kegiatan ..." class="form-control" rows="3" required><?php echo $how?></textarea>
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
                    <?php if ($this->session->userdata('user_id') != $td->task_receiver && $n_report== 0) { ?>
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