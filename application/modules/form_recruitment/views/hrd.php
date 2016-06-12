<p class="wf-approve-sp">
                        <div class="col-md-12"><span class="semi-bold">Diterima HRD</span><br/><br/></div>
                          <?php if($row->is_app_hrd == 0 && $this->approval->approver('absen', $user_nik) == $sess_nik){
                              if(cek_approval_atasan($id)):
                                  ?>
                                  <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalHrd"><i class="icon-ok"></i>Submit</div>
                                  <?php else: ?>
                                    <label>Menunggu approval dari atasan</label>
                                  <?php endif; ?>
                            <span class="small"></span>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold">(HRD)</span>
                          <?php }elseif($row->is_app_hrd == 1){
                            echo ($row->approval_status_id_hrd == 1)?"<img class=approval-img src=$approved>": (($row->approval_status_id_hrd == 2) ? "<img class=approval-img src=$rejected>"  : (($row->approval_status_id_hrd == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                          <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_hrd)?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_hrd)?></span><br/>
                            <span class="semi-bold">(HRD)</span>
                          <?php }else{?>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($this->approval->approver('absen', $user_nik))?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_hrd)?></span><br/>
                            <span class="semi-bold">(HRD)</span>
                          <?php } ?>
                        </p>