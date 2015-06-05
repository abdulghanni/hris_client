<div class="grid-body no-border">
              <?php echo form_open("form_resignment/input",array("id"=>"form_resignment_add"));?>
              <?php 
                  if($form_resignment->num_rows()>0){
                    foreach ($form_resignment->result() as $row):
              ?>
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($row->user_id)?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Wilayah</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="<?php echo (!empty($user_info))?$user_info['BU']:'-';?>" disabled="disabled">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">NIK</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="nik" type="text"  class="form-control" placeholder="NIK" value="<?php echo (!empty($user_info))?$user_info['EMPLID']:'-';?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="Dept/Bagian" value="<?php echo (!empty($user_info))?$user_info['ORGANIZATION']:'-';?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="position" type="text"  class="form-control" placeholder="Jabatan" value="<?php echo (!empty($user_info))?$user_info['POSITION']:'-';?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Tanggal Akhir Kerja</label>
                      </div>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="sandbox-advance" name="date_resign" value="<?php echo dateIndo($row->date_resign)?>" required disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Alasan Berhenti Bekerja</label>
                      </div>
                    </div>
                    
                    <div class="row form-row">
                      <div class="col-md-12">
                      <div class="checkbox check-primary checkbox-circle" >
                        <?php 
                        if($alasan->num_rows()>0){
                          foreach($alasan->result() as $alasan):?>
                          <input name="alasan[]" class="checkbox1" type="checkbox" id="alasan<?php echo $alasan->id ?>" value="<?php echo $alasan->id ?>" checked="checked" disabled="disabled">
                            <label for="alasan<?php echo $alasan->id ?>"><?php echo $alasan->title?></label>
                        <?php endforeach;} ?>

                      </div>
                      </div>
                      </div>
                    </div>

                      
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Apa alasan utama berhenti bekerja dari perusahaan ini? Jelaskan</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="" class="form-control" rows="3" name="desc_resign" disabled="disabled"><?php echo $row->desc_resign?></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Adakah prosedur perusahaan yang membuat anda tidak nyaman atau tidak bisa maksimum menjalankan tugasnya?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="procedure_resign" disabled="disabled"><?php echo $row->procedure_resign?></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Adakah hal yang memuaskan dari pekerjaan anda sekarang?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="kepuasan_resign" disabled="disabled"><?php echo $row->kepuasan_resign?></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Adakah saran untuk kami?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="saran_resign" disabled="disabled"><?php echo $row->saran_resign?></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Apakah anda mempertimbangkan di masa datang untuk kembali bekerja di perusahaan ini?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="rework_resign" disabled="disabled"><?php echo $row->rework_resign?></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Catatan Pewawancara</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="note_hrd" <?php echo ($row->is_app==1)? 'disabled="disabled"' : ''?>><?php echo $row->note_hrd?></textarea>
                      </div>
                    </div>

                </div>
                 <div class="form-actions">
                  <div class="col-md-12 text-center">
                      <div class="row wf-cuti">
                        <div class="col-md-4">
                          Karyawan Ybs,<br/><br/>
                          <p class="wf-approve-sp">
                            <span class="semi-bold"><?php echo get_name($row->user_id)?></span><br/>
                            <span class="small"><?php echo dateIndo($row->created_on)?></span><br/>
                          </p>
                        </div>

                        <div class="col-md-4"></div>
                        
                        <div class="col-md-4">
                          Pewawancara,<br/><br/>
                          <p class="wf-approve-sp">
                            <?php if($row->is_app==1){?>
                            <span class="semi-bold"><?php echo get_name($row->user_app)?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app)?></span>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold">(HRD)</span>
                            <?php } ?>
                          </p>
                        </div>
                      </div>
                    </div>
                    
                </div>
                </div>
              <?php endforeach;}?>
              </form>
            </div>