<div class="col-md-12 text-center">
                  <p class="wf-approve-sp">
                  <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                    <?php 
                    $approved = assets_url('img/approved_stamp.png');
                    $rejected = assets_url('img/rejected_stamp.png');
                    if(!empty($row->user_app_lv4) && $row->is_app_lv4 == 0 && get_nik($sess_id) == $row->user_app_lv4){?>
                      <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv4"><i class="icon-ok"></i>Submit</div>
                      <span class="small"></span>
                      <span class="semi-bold"></span><br/>
                      <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv4)?>)</span>
                    <?php }elseif(!empty($row->user_app_lv4) && $row->is_app_lv4 == 1){
                     echo ($row->app_status_id_lv4 == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_lv4 == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_lv4 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                              <span class="small"></span><br/>
                      <span class="semi-bold"><?php echo get_name($row->user_app_lv4)?></span><br/>
                      <span class="small"><?php echo dateIndo($row->date_app_lv4)?></span><br/>
                      <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv4)?>)</span>
                    <?php }else{?>
                        <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_lv4)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_lv4)?></span><br/>
                        <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv4)?>)</span>
                    <?php } ?>
                  </p>
                </div>