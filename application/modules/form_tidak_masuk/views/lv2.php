<?php if(!empty($tidak_masuk->user_app_lv2)):
?>
                        <p class="wf-approve-sp">
                        <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                        <?php
                         if(!empty($tidak_masuk->user_app_lv2) && $tidak_masuk->is_app_lv2 == 0 && get_nik($sess_id) == $tidak_masuk->user_app_lv2){?>
                            <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv2"><i class="icon-ok"></i>Submit</div>
                            <span class="small"></span>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold">(Atasan Tidak Langsung)</span>
                          <?php }elseif(!empty($tidak_masuk->user_app_lv2) && $tidak_masuk->is_app_lv2 == 1){
                            echo ($tidak_masuk->app_status_id_lv2 == 1)?"<img class=approval-img src=$approved>": (($tidak_masuk->app_status_id_lv2 == 2) ? "<img class=approval-img src=$rejected>"  : (($tidak_masuk->app_status_id_lv2 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                          <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_lv2)?></span><br/>
                            <span class="small"><?php echo dateIndo($tidak_masuk->date_app_lv2)?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($tidak_masuk->user_app_lv2)?>)</span>
                          <?php }else{?>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($tidak_masuk->user_app_lv2)?></span><br/>
                            <span class="small"><?php echo dateIndo($tidak_masuk->date_app_lv2)?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($tidak_masuk->user_app_lv2)?>)</span>
                          <?php } ?>
                        </p>
                      <?php endif;?>