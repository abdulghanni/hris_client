
                  <?php if(!empty($row->note_mgr)){?>
                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label text-left">Catatan Manager Ga Nasional</label>
                    </div>
                    <div class="col-md-12">
                      <textarea  id="text-editor" placeholder="Enter text ..." class="form-control" rows="2" disabled><?php echo $row->note_mgr?></textarea>
                    </div>
                  </div>
                  <?php }?>


                  <?php if(!empty($row->note_koperasi)){?>
                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label text-left">Catatan Sie Koperasi</label>
                    </div>
                    <div class="col-md-12">
                      <textarea  id="text-editor" placeholder="Enter text ..." class="form-control" rows="2" disabled><?php echo $row->note_koperasi?></textarea>
                    </div>
                  </div>
                  <?php }?>

                  <?php if(!empty($row->note_perpus)){?>
                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label text-left">Catatan Perpustakaan</label>
                    </div>
                    <div class="col-md-12">
                      <textarea  id="text-editor" placeholder="Enter text ..." class="form-control" rows="2" disabled><?php echo $row->note_perpus?></textarea>
                    </div>
                  </div>
                  <?php }?>

                  <?php if(!empty($row->note_hrd)){?>
                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label text-left">Catatan HRD</label>
                    </div>
                    <div class="col-md-12">
                      <textarea  id="text-editor" placeholder="Enter text ..." class="form-control" rows="2" disabled><?php echo $row->note_hrd?></textarea>
                    </div>
                  </div>
                  <?php }?>

                  <?php if(!empty($row->note_it)){?>
                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label text-left">Catatan IT</label>
                    </div>
                    <div class="col-md-12">
                      <textarea  id="text-editor" placeholder="Enter text ..." class="form-control" rows="2" disabled><?php echo $row->note_it?></textarea>
                    </div>
                  </div>
                  <?php }?>

                  <?php 
                      for($i=1;$i<6;$i++):
                      $note_lv = 'note_lv'.$i;
                      $user_lv = 'user_app_lv'.$i;
                      if(!empty($row->$note_lv)){?>
                      <div class="row form-row">
                        <div class="col-md-12">
                          <label class="form-label text-left">Note (<?php echo strtok(get_name($row->$user_lv), " ")?>):</label>
                        </div>
                        <div class="col-md-12">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $row->$note_lv ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                    <?php endfor;?>