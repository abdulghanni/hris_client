<div class="grid simple">
            <div class="grid-title no-border">
              <h4>Form Karyawan <span class="semi-bold"><a href="<?php echo site_url('form_resignment')?>">Keluar</a></span></h4>
            </div>
            <div class="grid-body no-border">
              <?php echo form_open("form_resignment/input",array("id"=>"form_resignment_add"));?>
              <?php 
                  if($_num_rows>0){
                    foreach ($form_resignment as $row):
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
                        <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="<?php echo get_user_bu($user_nik)?>" disabled="disabled">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">NIK</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="nik" type="text"  class="form-control" placeholder="NIK" value="<?php echo $user_nik?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="Dept/Bagian" value="<?php echo get_user_organization($user_nik)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="position" type="text"  class="form-control" placeholder="Jabatan" value="<?php echo get_user_position($user_nik)?>" disabled="disabled">
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

                    <?php if(!empty($row->note_lv1)){?>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Catatan Supervisor</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="note_hrd" <?php echo ($row->is_app_lv1==1)? 'disabled="disabled"' : ''?>><?php echo $row->note_lv1?></textarea>
                      </div>
                    </div>
                    <?php };
                      if(!empty($row->note_lv2)){?>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Catatan Ka. Bagian</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="note_hrd" <?php echo ($row->is_app_lv2==1)? 'disabled="disabled"' : ''?>><?php echo $row->note_lv2?></textarea>
                      </div>
                    </div>
                    <?php };
                    if(!empty($row->note_hrd)){
                    ?>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Catatan Pewawancara</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="note_hrd" <?php echo ($row->is_app_hrd==1)? 'disabled="disabled"' : ''?>><?php echo $row->note_hrd?></textarea>
                      </div>
                    </div><?php } ?>
                </div>
                <?php 
                  $approved = assets_url('img/approved_stamp.png');
                  $rejected = assets_url('img/rejected_stamp.png');
                ?>
                 <div class="form-actions">

                      <div class="col-md-12 text-center"><div class="col-md-12 text-center"><span class="semi-bold">Mengetahui,</span><br/><br/><br/></div>
                      <div class="row wf-resignment">
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            $approved = assets_url('img/approved_stamp.png');
                            $rejected = assets_url('img/rejected_stamp.png');
                            if(!empty($row->user_app_lv1) && $row->is_app_lv1 == 0 && get_nik($sess_id) == $row->user_app_lv1){?>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Supervisor)</span>
                            <?php }elseif(!empty($row->user_app_lv1) && $row->is_app_lv1 == 1){
                              echo ($row->app_status_id_lv1 == 1)?"<img class=approval_img_md src=$approved>":(($row->app_status_id_lv1 == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($row->user_app_lv1)?></span><br/>
                              <span class="small"><?php echo dateIndo($row->date_app_lv1)?></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Supervisor)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($row->user_app_lv1))?'(Supervisor)':'';?></span>
                            <?php } ?>
                          </p>
                        </div>

                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($row->user_app_lv2) && $row->is_app_lv2 == 0 && get_nik($sess_id) == $row->user_app_lv2){?>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Ka. Bagian)</span>
                            <?php }elseif(!empty($row->user_app_lv2) && $row->is_app_lv2 == 1){
                              echo ($row->app_status_id_lv2 == 1)?"<img class=approval_img_md src=$approved>":(($row->app_status_id_lv2 == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($row->user_app_lv2)?></span><br/>
                              <span class="small"><?php echo dateIndo($row->date_app_lv2)?></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Ka. Bagian)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($row->user_app_lv2))?'(Ka. Bagian)':'';?></span>
                            <?php } ?>
                          </p>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($row->user_app_lv3) && $row->is_app_lv3 == 0 && get_nik($sess_id) == $row->user_app_lv3){?>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv3)?>)</span>
                            <?php }elseif(!empty($row->user_app_lv3) && $row->is_app_lv3 == 1){
                              echo ($row->app_status_id_lv3 == 1)?"<img class=approval_img_md src=$approved>":(($row->app_status_id_lv3 == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($row->user_app_lv3)?></span><br/>
                              <span class="small"><?php echo dateIndo($row->date_app_lv3)?></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv3)?>)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($row->user_app_lv3))?get_user_position($row->user_app_lv3):'';?></span>
                            <?php } ?>
                          </p>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if($row->is_app_hrd == 0 && is_admin()){?><span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }elseif($row->is_app_hrd == 1){
                              echo ($row->app_status_id_hrd == 1)?"<img class=approval_img_md src=$approved>":(($row->app_status_id_hrd == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($row->user_app_hrd)?></span><br/>
                              <span class="small"><?php echo dateIndo($row->date_app_hrd)?></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php } ?>
                          </p>
                        </div>
                      </div>
                    </div> 
                  </div>
                </form>
            </div>
          </div>

          <?php endforeach; ?>
<?php } ?>