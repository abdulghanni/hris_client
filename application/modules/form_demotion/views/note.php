<?php 
                        for($i=1;$i<6;$i++):
                        $note_lv = 'note_lv'.$i;
                        $user_lv = 'user_app_lv'.$i;
                        if(!empty($row->$note_lv)){?>
                        <div class="row form-row">
                          <div class="col-md-4">
                            <label class="form-label text-right">Note (<?php echo strtok(get_name($row->$user_lv), " ")?>):</label>
                          </div>
                          <div class="col-md-8">
                            <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $row->$note_lv ?></textarea>
                          </div>
                        </div>
                        <?php } ?>
                      <?php endfor;?>
                    <?php if(!empty($row->note_hrd)):?>
                      <div class="row form-row">
                          <div class="col-md-4">
                            <label class="form-label text-right">Note (HRD): </label>
                          </div>
                          <div class="col-md-8">
                            <textarea name="notes_hrd" placeholder="Note hrd isi disini" class="form-control" disabled="disabled"><?php echo $row->note_hrd ?></textarea>
                          </div>
                        </div>
                    <?php endif; ?>