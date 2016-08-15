<?php 
                      for($i=1;$i<4;$i++):
                      $note_lv = 'note_lv'.$i;
                      $user_lv = 'user_app_lv'.$i;
                      if(!empty($td->$note_lv)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Note (<?php echo strtok(get_name($td->$user_lv), " ")?>):</label>
                        </div>
                        <div class="col-md-5">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $td->$note_lv ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                    <?php endfor;?>
                      <?php if(!empty($td->note_hrd)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Note (hrd): </label>
                        </div>
                        <div class="col-md-5">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $td->note_hrd ?></textarea>
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($td->cancel_note)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left">Alasan Cancel: </label>
                        </div>
                        <div class="col-md-5">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $td->cancel_note ?></textarea>
                        </div>
                      </div>
                      <?php } ?>