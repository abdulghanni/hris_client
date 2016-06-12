<?php 
                      for($i=1;$i<4;$i++):
                      $note_lv = 'note_lv'.$i;
                      $user_lv = 'user_app_lv'.$i;
                      if(!empty($tidak_masuk->$note_lv)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Note (<?php echo strtok(get_name($tidak_masuk->$user_lv), " ")?>):</label>
                        </div>
                        <div class="col-md-9">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $tidak_masuk->$note_lv ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                    <?php endfor;?>
                  <?php if(!empty($tidak_masuk->note_hrd)):?>
                    <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Note (HRD): </label>
                        </div>
                        <div class="col-md-9">
                          <textarea name="notes_hrd" placeholder="Note hrd isi disini" class="form-control" disabled="disabled"><?php echo $tidak_masuk->note_hrd ?></textarea>
                        </div>
                      </div>
                  <?php endif; ?>