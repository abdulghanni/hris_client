
      <div id="container">
        <div class="row">
          <div class="col-md-12">
            <div class="grid simple">
              <div class="grid-title no-border">
                <h4>Form Pengajuan <span class="semi-bold"><a href="<?php echo site_url('form_resignment')?>">resignment</a></span></h4>
              </div>
              <div class="grid-body no-border">
                <?php
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => '');
                echo form_open('form_resignment/add', $att);
                if($_num_rows>0){
                  foreach($form_resignment as $row):
                ?>
                  <div class="row column-seperation">
                    <div class="col-md-6">
                      <h4>Informasi karyawan</h4>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">NIK</label>
                          
                        </div>
                        <div class="col-md-9">
                          <input name="nik" id="form3LastName" type="text"  class="form-control " placeholder="Nama" value="<?php echo get_nik($row->user_id)?>"  disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Nama</label>
                        </div>
                        <div class="col-md-9">
                          <input name="name" id="form3LastName" type="text"  class="form-control " placeholder="Nama" value="<?php echo get_name($row->user_id)?>"  disabled="disabled">
                        </div>
                      </div>          
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Unit Bisnis</label>
                        </div>
                        <div class="col-md-9">
                          <input name="nik" id="form3LastName" type="text"  class="form-control " placeholder="Bussiness Unit Lama" value="<?php echo get_user_bu($user_nik)?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Dept/Bagian</label>
                        </div>
                        <div class="col-md-9">
                            <input name="nik" id="form3LastName" type="text"  class="form-control " placeholder="Bussiness Unit Lama" value="<?php echo get_user_organization($user_nik)?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Jabatan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="nik" id="form3LastName" type="text"  class="form-control " placeholder="Bussiness Unit Lama" value="<?php echo get_user_position($user_nik)?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Tanggal Mulai Kerja</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control " placeholder="Nama" value="<?php echo dateIndo(get_seniority_date($user_nik))?>"  disabled="disabled" >
                        </div>
                      </div>
                      
                      
                    </div>
                    <div class="col-md-6">
                      <h4>Resignment Yang Diajukan</h4>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Tanggal Pengajuan</label>
                        </div>
                        <div class="col-md-4">
                          <input name="old_org2" id="old_org2" class="form-control " placeholder="" value="<?php echo dateIndo(date('Y-m-d',strtotime('now')))?>"  disabled="disabled">
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Tanggal Terakhir Bekerja</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="sandbox-advance" name="date_resign" value="<?php echo dateIndo($row->date_resign)?>" disabled>
                        </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-4">
                        <label class="form-label text-left">Alasan Resign</label>
                      </div>
                      <div class="col-md-8">
                         <textarea name="alasan" class="form-control" disabled><?php echo $row->alasan?></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">No. Telp Pengaju</label>
                        </div>
                        <div class="col-md-4">
                          <input name="phone" id="phone" class="form-control " placeholder="" value="<?php echo $row->phone ?>">
                        </div>
                      </div>

                    <?php if($row->is_invited == 1):?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Tanggal Wawancara</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="sandbox-advance" name="date_resign" value="<?php echo dateIndo($row->date_invitation)?>" disabled>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Waktu Wawancara</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="sandbox-advance" name="date_resign" value="<?php echo $row->time_invitation?>" disabled>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Nama Pewawancara</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="sandbox-advance" name="date_resign" value="<?php echo $row->nama_pewawancara?>" disabled>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">No. Telp Pewawancara</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="sandbox-advance" name="date_resign" value="<?php echo $row->telp_pewawancara?>" disabled>
                        </div>
                      </div>
            
                      <?php if(!empty($row->note_invitation)){?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Catatan undangan wawancara: </label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $row->note_invitation ?></textarea>
                        </div>
                      </div>

                    <?php }endif; ?>

                      <?php if(!empty($row->note_lv1)){?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Note (Atasan Langsung): </label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="notes_spv" class="custom-txtarea-form" disabled="disabled"><?php echo $row->note_lv1 ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if(!empty($row->note_lv2)){?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Note (Atasan Tidak Langsung): </label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="notes_spv" class="custom-txtarea-form" disabled="disabled"><?php echo $row->note_lv2 ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if(!empty($row->note_lv3)){?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Note (Atasan Lainnya): </label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="notes_spv" class="custom-txtarea-form" disabled="disabled"><?php echo $row->note_lv3 ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if(!empty($row->note_hrd)){?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Note (hrd): </label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="notes_spv" class="custom-txtarea-form" disabled="disabled"><?php echo $row->note_hrd ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                      
                    </div>
                </div>
<?php endforeach;} ?>