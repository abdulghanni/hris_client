<div id="container">
        <div class="row">
        <div class="col-md-12">
          <div class="grid simple">
            <div class="grid-title no-border">
              <h4>Detail Rekapitulasi <span class="semi-bold"><a href="<?php echo site_url('form_medical')?>">Rawat Jalan & Inap</a></span></h4>
            </div>
            <div class="grid-body no-border">
            <h6 class="bold">BAGIAN : <?php echo $bagian?></h6>
              <form class="form-no-horizontal-spacing" id="formMedical"> 
                <div class="row column-seperation">

                  <hr/>
                  <h5 class="text-center"><span class="semi-bold">Rekapitulasi Rawat Jalan & Inap Yang Diajukan</span></h5>
                    <table id="dataTable" class="table table-bordered">
                      <thead>
                        <tr>
                          <th width="5%">NIK</th>
                          <th width="25%">Nama</th>
                          <th width="25%">Nama Pasien</th>
                          <th width="15%">Hubungan</th>
                          <th width="13%">Jenis Pemeriksaan</th>
                          <th width="12%">Rupiah</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          if(!empty($detail)){
                             $total = $detail[0]['rupiah'];
                             $approved = assets_url('img/approved_stamp.png');
                             $rejected = assets_url('img/rejected_stamp.png');
                              for($i=0;$i<sizeof($detail);$i++):
                              ?>
                          <tr>
                            <td><?php echo get_nik($detail[$i]['karyawan_id'])?></td>
                            <td><?php echo get_name($detail[$i]['karyawan_id'])?></td>
                            <td><?php echo $detail[$i]['pasien']?></td>
                            <td><?php echo $detail[$i]['hubungan']?></td>
                            <td><?php echo $detail[$i]['jenis']?></td>
                            <td align="right"><?php echo  'Rp. '.number_format($detail[$i]['rupiah'], 0)?></td>
                          </tr>
                            <?php
                            if(sizeof($detail)>1 && isset($detail[$i+1])){
                            $total = $total + $detail[$i+1]['rupiah'];
                            }
                            endfor;}
                            ?>
                            <tr>
                            <td align="right" colspan="5">Total : </td><td align="right"><?php echo 'Rp. '.number_format($total, 0)?></td>
                            </tr>
                        </tbody>
                      </table>

                      <div class="col-md-12">
                        <label class="form-label text-left">Attachment : </label>
                      </div>
                      <?php for($i=0;$i<sizeof($attachment);$i++):
                            if(file_exists('./uploads/'.$user_folder.$attachment[$i])){
                      ?>
                      <div class="col-md-12">
                        <label class="form-label text-left"><a href="<?php echo site_url('uploads/'.$user_folder.$attachment[$i])?>" target="_blank"><?php echo '* '.$attachment[$i]?></a></label>
                      </div>
                    <?php }endfor; ?>

                      <?php if(!empty($note_lv1)):?>
                      <div class="row form-row">
                        <div class="col-md-12">
                          <label class="form-label text-left">Note (<?php echo strtok(get_name($user_lv1), " ")?>) : </label>
                        </div>
                        <div class="col-md-12">
                          <textarea name="note_lv1" class="form-control" placeholder="" disabled="disabled"><?php echo $note_lv1?></textarea>
                        </div>
                      </div>
                    <?php endif; ?>

                  <?php if($is_app_hrd!=0){?>
                  <hr/>
                    
                  <h5 class="text-center"><span class="semi-bold">Rekapitulasi Rawat Jalan & Inap Yang Disetujui HRD</span></h5>
                    <table id="dataTable" class="table table-bordered">
                      <thead>
                        <tr>
                          <th width="5%">NIK</th>
                          <th width="25%">Nama</th>
                          <th width="25%">Nama Pasien</th>
                          <th width="15%">Hubungan</th>
                          <th width="13%">Jenis Pemeriksaan</th>
                          <th width="12%">Rupiah</th>
                          <th width="12%">Disetujui</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          if(!empty($detail_hrd)){
                             $total = $detail_hrd[0]['rupiah'];
                              for($i=0;$i<sizeof($detail_hrd);$i++):
                              $is_approve = ($detail_hrd[$i]['is_approve'] == 1) ? "<i class='icon-ok-sign' title = 'Ya'></i>":"<i class='icon-remove-sign' title = 'Tidak'></i>";
                              ?>
                          <tr>
                            <td><?php echo get_nik($detail_hrd[$i]['karyawan_id'])?></td>
                            <td><?php echo get_name($detail_hrd[$i]['karyawan_id'])?></td>
                            <td><?php echo $detail_hrd[$i]['pasien']?></td>
                            <td><?php echo $detail_hrd[$i]['hubungan']?></td>
                            <td><?php echo $detail_hrd[$i]['jenis']?></td>
                            <td><?php echo  'Rp. '.number_format($detail_hrd[$i]['rupiah'], 0)?></td>
                            <td align="center"><?php echo $is_approve?></td>
                          </tr>
                            <?php
                            endfor;}
                            ?>
                            <tr>
                            <td align="right" colspan="5">Total yang disetujui HRD: </td><td><?php echo 'Rp. '.number_format($total_medical_hrd, 0)?></td>
                            </tr>
                        </tbody>
                      </table>
                      <?php } ?>
                      <?php if(!empty($note_hrd)):?>
                      <div class="row form-row">
                        <div class="col-md-12">
                          <label class="form-label text-left">Note (HRD) : </label>
                        </div>
                        <div class="col-md-12">
                          <textarea name="note_hrd" class="form-control" placeholder="" disabled="disabled"><?php echo $note_hrd?></textarea>
                        </div>
                      </div>
                    <?php endif; ?>
                    </div>
                  </div>
                </div>
                <?php if($_num_rows>0){
                  foreach($form_medical as $row):?>
                <div class="form-actions text-center">


                    <!-- <div class="col-md-12 text-center"> -->
                      <div class="row wf-cuti">
                        <div class="col-md-4">
                          <p>Hormat Kami,</p>
                          <p class="wf-submit">
                          <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_id) ?></span><br/>
                            <span class="small"><?php echo dateIndo($row->created_on) ?></span><br/>
                            <span class="semi-bold"><?php echo (!empty(get_user_position(get_nik($row->user_id)))) ? get_user_position(get_nik($row->user_id)) : ''?></span><br/>   
                          </p>
                        </div>

                        <div class="col-md-4">
                          <p>Disetujui,</p>
                          <p class="wf-approve-sp">
                          <?php if($row->is_app_hrd==1) {
                            echo "<img class=approval-img src=$approved>"?>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_hrd)?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_hrd)?></span><br/>
                            <span class="semi-bold">(HRD)</span>
                            <?php }elseif($this->approval->approver('medical') == $sess_nik && $row->is_app_hrd==0){?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <p class="">(HRD)</p>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <p class="">(HRD)</p>
                            <?php } ?>
                          </p>
                        </div>

                        <?php if(!empty($row->user_app_lv1)){?>
                        <div class="col-md-4">
                          <p>Mengetahui,</p>
                          <p class="wf-approve-sp">
                          <?php if($row->is_app_lv1==1) {
                            echo ($row->app_status_id_lv1 == 1)?"<img class=approval-img src=$approved>":(($row->app_status_id_lv1 == 2) ? "<img class=approval-img src=$rejected>":'<span class="small"></span><br/>');?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv1) ?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv1) ?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv1)?>)</span><br/>
                            <?php }elseif($row->is_app_lv1==0 && $sess_nik == $row->user_app_lv1){?>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv1) ?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv1) ?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv1)?>)</span><br/>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv1) ?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv1) ?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv1)?>)</span><br/>
                            <?php } ?>
                          </p>
                        </div>
                        <?php } ?>
                      </div>
                    <!-- /div> -->
                    <?php if(!empty($row->user_app_lv2)){?>
                        <div class="col-md-7">
                          <p>Mengetahui,</p>
                          <p class="wf-approve-sp">
                          <?php if($row->is_app_lv2==1) {
                            echo "<img class=approval-img src=$approved>"?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv2) ?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv2) ?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv2)?>)</span><br/>
                            <?php }elseif($row->is_app_lv2==0 && $sess_nik == $row->user_app_lv2){?>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv2) ?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv2) ?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv2)?>)</span><br/>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv2) ?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv2) ?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv2)?>)</span><br/>
                            <?php } ?>
                          </p>
                        </div>
                        <?php } ?>

                        <?php if(!empty($row->user_app_lv3)){?>
                        <div class="col-md-2">
                          <p>Mengetahui,</p>
                          <p class="wf-approve-sp">
                          <?php if($row->is_app_lv3==1) {
                            echo "<img class=approval-img src=$approved>"?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv3) ?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv3) ?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv3)?>)</span><br/>
                            <?php }elseif($row->is_app_lv3==0 && $sess_nik == $row->user_app_lv3){?>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv3) ?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv3) ?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv3)?>)</span><br/>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv3) ?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv3) ?></span><br/>
                            <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv3)?>)</span><br/>
                            <?php } ?>
                          </p>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach;}?>
              </form>
             </div>  
            </div>
          </div>
        </div>
      </div>