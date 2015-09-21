<div class="grid-body no-border">
              <?php
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formaddrecruitment');
                echo form_open('form_recruitment/add', $att);
                foreach($recruitment as $row):
                ?>
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Unit Bisnis</label>
                      </div>
                      <div class="col-md-4">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo get_bu_name(substr($row->bu_id,0,2))?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Departement</label>
                      </div>
                      <div class="col-md-4">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo get_organization_name($row->parent_organization_id)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Bagian</label>
                      </div>
                      <div class="col-md-4">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo get_organization_name($row->organization_id)?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-4">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo get_position_name($row->position_id)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jumlah yang dibutuhkan</label>
                      </div>
                      <div class="col-md-4">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo $row->jumlah?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Status</label>
                      </div>
                      <div class="col-md-4">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo $row->status?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Urgensi (Kebutuhan)</label>
                      </div>
                      <div class="col-md-10">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo $row->urgensi?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <h4><strong>Kualifikasi :</strong></h4>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jenis Kelamin</label>
                      </div>
                      <?php 
                        if($jenis_kelamin->num_rows()>0){
                          foreach($jenis_kelamin->result() as $jk):?>
                      <div class="col-md-1">
                        <div class="checkbox check-primary checkbox-circle" >
                          <input name="jenis_kelamin[]" class="checkbox1" type="checkbox" id="jenis_kelamin<?php echo $jk->id ?>" value="<?php echo $jk->id ?>" checked="checked" disabled="disabled">
                            <label for="jenis_kelamin<?php echo $jk->id ?>"><?php echo $jk->title?></label>
                          </div>
                      </div>
                    <?php endforeach;} ?>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Pendidikan</label>
                      </div>
                      <?php 
                          if($pendidikan->num_rows()>0){
                            foreach($pendidikan->result() as $p):?>
                        <div class="col-md-1">
                          <div class="checkbox check-primary checkbox-circle" >
                            <input name="pendidikan[]" class="checkbox1" type="checkbox" id="pendidikan<?php echo $p->id ?>" value="<?php echo $p->id ?>" checked="checked" disabled="disabled">
                              <label for="pendidikan<?php echo $p->id ?>"><?php echo $p->title?></label>
                            </div>
                        </div>
                      <?php endforeach;} ?>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jurusan</label>
                      </div>
                      <div class="col-md-2">
                        <input name="jurusan" id="form3LastName" type="text"  class="form-control" placeholder="Jurusan" value="<?php echo $row->jurusan?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">IPK(Min)</label>
                      </div>
                      <div class="col-md-2">
                        <input name="ipk" id="form3LastName" type="text"  class="form-control" placeholder="IPK" value="<?php echo $row->ipk?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Toefl(Min)</label>
                      </div>
                      <div class="col-md-2">
                        <input name="toefl" id="form3LastName" type="text"  class="form-control" placeholder="Toefl" value="<?php echo $row->toefl?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <h4><strong>Kemampuan Teknis :</strong></h4>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Komputer</label>
                      </div>
                      <div class="col-md-10">
                        <?php 
                          if($komputer->num_rows()>0){
                            foreach($komputer->result() as $p):?>
                        <div class="col-md-1">
                          <div class="checkbox check-primary checkbox-circle" >
                            <input name="komputer[]" class="checkbox1" type="checkbox" id="komputer<?php echo $p->id ?>" value="<?php echo $p->id ?>" checked="checked" disabled="disabled">
                              <label for="komputer<?php echo $p->id ?>"><?php echo $p->title?></label>
                            </div>
                        </div>
                      <?php endforeach;} ?>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Bahasa Pemrograman</label>
                      </div>
                      <div class="col-md-10">
                        <input name="pemrograman" id="form3LastName" type="text"  class="form-control" placeholder="pemrograman" value="<?php echo $row->bahasa_pemrograman?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Komunikasi</label>
                      </div>
                      <div class="col-md-10">
                        <input name="komunikasi" id="form3LastName" type="text"  class="form-control" placeholder="Komunikasi" value="<?php echo $row->komunikasi?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Grafika</label>
                      </div>
                      <div class="col-md-10">
                        <input name="grafika" id="form3LastName" type="text"  class="form-control" placeholder="Grafika" value="<?php echo $row->grafika?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Desain/Setting</label>
                      </div>
                      <div class="col-md-10">
                        <input name="desain" id="form3LastName" type="text"  class="form-control" placeholder="Desain/Setting" value="<?php echo $row->desain?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Brevet</label>
                      </div>
                      <div class="col-md-10">
                        <input name="brevet" id="form3LastName" type="text"  class="form-control" placeholder="brevet" value="<?php echo $row->brevet?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Lain-lain</label>
                      </div>
                      <div class="col-md-10">
                        <input name="lain-lain" id="form3LastName" type="text"  class="form-control" placeholder="Lain-lain" value="<?php echo $row->lain_lain?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Portfolio</label>
                      </div>
                      <div class="col-md-10">
                        <input name="portofolio" id="form3LastName" type="text"  class="form-control" placeholder="Portfolio" value="<?php echo $row->portofolio?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Pengalaman</label>
                      </div>
                      <div class="col-md-2">
                        <input name="pengalaman" id="form3LastName" type="text"  class="form-control" placeholder="Bidang" value="<?php echo $row->pengalaman?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">selama</label>
                      </div>
                      <div class="col-md-1">
                        <input name="lama_pengalaman" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $row->lama_pengalaman?>" disabled="disabled"> 
                      </div>
                      <div class="col-md-1">
                        <label class="form-label text-right">Tahun</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Job Desc</label>
                      </div>
                      <div class="col-md-10">
                        <textarea name="job_desc" id="text-editor" placeholder="Enter text ..." class="form-control" rows="10" disabled="disabled"><?php echo $row->job_desc?></textarea>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Catatan Pengaju</label>
                      </div>
                      <div class="col-md-10">
                        <textarea name="note_hrd" id="text-editor" placeholder="Enter text ..." class="form-control" rows="10" disabled="disabled"><?php echo $row->note_pengaju?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
            <?php endforeach;?>
              </form>
            </div>