<!-- BEGIN PAGE CONTAINER-->
  <div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content">

      <div id="container">
        <div class="row">
          <div class="col-md-12">
            <div class="grid simple">
              <div class="grid-title no-border">
                  <h4>Form Rekomendasi <span class="semi-bold"><a href="<?php echo site_url('form_exit')?>">Karyawan Keluar</a></span></h4>
              <a href="<?php echo site_url('form_exit/form_exit_pdf/'.$id)?>" target="_blank"><button class="btn btn-primary pull-right"><i class="icon-print"> Cetak</i></button></a><br/>
              No : <?= get_form_no($id) ?>
              </div>
              <div class="grid-body no-border">
                 <?php echo form_open("form_exit/add",array("id"=>"formaddexit"));
                    foreach($form_exit->result() as $row):
                 ?>
               <input type="hidden" id="emp" value="<?=$row->user_id?>">
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-3">
                          <input name="" id="" type="text"  class="form-control" placeholder="" value="<?php echo get_name($row->user_id)?>" disabled="disabled">
                      </div>

                      <div class="col-md-2">
                        <label class="form-label text-right">Wilayah</label>
                      </div>
                      <div class="col-md-3">
                        <input name="" id="bu" type="text"  class="form-control" placeholder="" value="" disabled="disabled">
                      </div>

                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">NIK</label>
                      </div>
                      <div class="col-md-3">
                        <input name="" id="" type="text"  class="form-control" placeholder="" value="<?php echo $user_nik?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-3">
                        <input name="" id="organization" type="text"  class="form-control" placeholder="" value="" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-3">
                        <input name="" id="position" type="text"  class="form-control" placeholder="" value="" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Tanggal Keluar</label>
                      </div>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="sandbox-advance" name="date_exit" value="<?php echo dateIndo($row->date_exit)?>" disabled="disabled">    
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Tipe Rekomendasi</label>
                      </div>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="sandbox-advance" name="tipe" value="<?php echo $row->exit_type?>" disabled="disabled">    
                      </div>
                    </div>
                    
                    <div class="row form-row">
                      <div class="col-md-12">
                        <h4>Inventaris yang harus diserahkan</h4>
                      </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-12">
                          <table class="table no-more-tables">
                            <tr>
                              <th>No</th>
                              <th>Item</th>
                              <th>Ketersediaan</th>
                              <th>Keterangan</th>
                            </tr>
                            <?php 
                              $i=0;
                              if($users_inventory->num_rows()>0){
                                foreach ($users_inventory->result() as $inv) :
                                  $radio_label = ($inv->is_available==1)?'Ada':'Tidak';
                                  ?>
                            <tr>
                              <td><?php echo 1+$i++?></td>
                              <td><?php echo $inv->title?></td>
                              <td>
                                <input type="hidden" name="inventory_id[]" value="<?php echo $inv->id?>">
                                <label class="radio-inline">
                                  <input type="radio" name="is_available_<?php echo $i?>" id="is_available<?php echo $inv->id?>-1?>" value="1" checked><?php echo $radio_label?>
                                </label>
                              </td>
                              <td><input name="note_<?php echo $i?>" id="note<?php echo $inv->id?>" type="text"  class="form-control" placeholder="" value="<?php echo $inv->note?>" disabled></td>
                            </tr>
                                <?php endforeach;}?>
                          </table>
                        </div>
                      </div>
                      
                      <div class="form-actions">
                        <div class="row form-row">
                            <div class="col-md-12 text-center">
                            <?php if($row->is_app_mgr == 1 && $is_admin_logistik == 1){?>
                                <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalmgr"><i class='icon-edit'> Edit Approval</i></div>
                              <?php }elseif($row->is_app_koperasi == 1 && $is_admin_koperasi ==1){?>
                                <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalkoperasi"><i class='icon-edit'> Edit Approval</i></div>
                              <?php }elseif($row->is_app_perpus == 1 && $is_admin_perpus==1){?>
                                <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalperpus"><i class='icon-edit'> Edit Approval</i></div>
                              <?php }elseif($row->is_app_hrd == 1 && $is_admin_hrd==1){?>
                                <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalhrd"><i class='icon-edit'> Edit Approval</i></div>
                              <?php }elseif($row->is_app_it == 1 && $is_admin_it == 1){?>
                                <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalit"><i class='icon-edit'> Edit Approval</i></div>
                              <?php }elseif($row->is_app_keuangan == 1 && $is_admin_keuangan == 1){?>
                                <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalkeuangan"><i class='icon-edit'> Edit Approval</i></div>
                              <?php } ?>
                            </div>
                        </div>

                        <div class="row text-center">
                          <div class="row text-center"><span class="semi-bold">Mengetahui,</span></div>
                          <div class="row wf-cuti">
                            <div class="col-md-3" id="mgr">
                              <p class="wf-approve-sp">
                                <?php 
                                $approved = assets_url('img/approved_stamp.png');
                                $rejected = assets_url('img/rejected_stamp.png');
                                 $pending = assets_url('img/pending_stamp.png');
                                if($row->is_app_mgr == 1){
                                echo ($row->app_status_id_mgr == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_mgr == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_mgr == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?><br/>
                                <!-- <span class="semi-bold"><?php echo get_name($row->user_app_mgr)?></span><br/> -->
                                <span class="small"><?php echo dateIndo($row->date_app_mgr)?></span><br/>
                                <?php }elseif($row->is_app_mgr == 0 && $is_admin_logistik == 1){?>
                                <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalmgr"><i class="icon-ok"></i>Submit</div>
                                <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/>
                                <span class="small"></span>
                                <?php }else{?>
                                <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/>
                                <span class="small"></span><br/>
                                <?php } ?>
                                <span class="semi-bold"><?php echo get_name_admin_logistik(get_user_buid($user_nik))?></span><br/>
                                <span class="semi-bold">GA</span>
                              </p>
                            </div>

                          <div class="col-md-3" id="koperasi">
                            <p class="wf-approve-sp">
                              <?php if($row->is_app_koperasi == 1){
                              echo ($row->app_status_id_koperasi == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_koperasi == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_koperasi == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?><br/>
                              <!-- <span class="semi-bold"><?php echo get_name($row->user_app_koperasi)?></span><br/> -->
                              <span class="small"><?php echo dateIndo($row->date_app_koperasi)?></span><br/>
                              <?php }elseif($row->is_app_koperasi == 0 && $is_admin_koperasi == 1){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalkoperasi"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span>
                              <?php }else{?>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <?php } ?>
                              <span class="semi-bold"><?php echo get_name_admin_koperasi(get_user_buid($user_nik))?></span><br/>
                              <span class="semi-bold">Sie Koperasi</span>
                            </p>
                          </div>
                          
                          <div class="col-md-3" id="perpus">
                            <p class="wf-approve-sp">
                              <?php if($row->is_app_perpus == 1){
                             echo ($row->app_status_id_perpus == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_perpus == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_perpus == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?><br/>
                              <!-- <span class="semi-bold"><?php echo get_name($row->user_app_perpus)?></span><br/> -->
                              <span class="small"><?php echo dateIndo($row->date_app_perpus)?></span><br/>
                              <?php }elseif($row->is_app_perpus == 0 && $is_admin_perpus == 1){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalperpus"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span>
                              <?php }else{?>
                              <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <?php } ?>
                              <span class="semi-bold"><?php echo get_name_admin_perpus(get_user_buid($user_nik))?></span><br/>
                              <span class="semi-bold">Perpustakaan</span>
                            </p>
                          </div>
                          
                          <div class="col-md-3" id="hrd">
                            <p class="wf-approve-sp">
                              <?php if($row->is_app_hrd == 1){
                              echo ($row->app_status_id_hrd == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_hrd == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_hrd == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?><br />
                              <!-- <span class="semi-bold"><?php echo get_name($row->user_app_hrd)?></span><br/> -->
                              <span class="small"><?php echo dateIndo($row->date_app_hrd)?></span><br/>
                              <?php }elseif($row->is_app_hrd == 0 && $is_admin_hrd == 1){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalhrd"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span>
                              <?php }else{?>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <?php } ?>
                              <span class="semi-bold"><?php echo get_name_admin_hrd(get_user_buid($user_nik))?></span><br/>
                              <span class="semi-bold">HRD</span>
                            </p>
                          </div>
                        </div>

                        <div class="row text-center">
                          <div class="row text-center"><span class="semi-bold">Mengetahui,</span></div>
                          <div class="row wf-cuti">
                            <div class="col-md-3" id="akunting">
                              <p class="wf-approve-sp" id="akunting_box">
                                <?php 
                                $approved = assets_url('img/approved_stamp.png');
                                $rejected = assets_url('img/rejected_stamp.png');
                                 $pending = assets_url('img/pending_stamp.png');
                                if($row->is_app_akunting == 1){
                                echo ($row->app_status_id_akunting == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_akunting == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_akunting == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?><br/>
                                <!-- <span class="semi-bold"><?php echo get_name($row->user_app_akunting)?></span><br/> -->
                                <span class="small"><?php echo dateIndo($row->date_app_akunting)?></span><br/>
                                <?php }elseif($row->is_app_akunting == 0 && $is_admin_akunting == 1){?>
                                <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalakunting"><i class="icon-ok"></i>Submit</div>
                                <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/>
                                <span class="small"></span>
                                <?php }else{?>
                                <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/>
                                <span class="small"></span><br/>
                                <?php } ?>
                                <span class="semi-bold"><?php echo get_name_admin_akunting(get_user_buid($user_nik))?></span><br/>
                                <span class="semi-bold">Akunting</span>
                              </p>
                            </div>

                          <div class="col-md-3" id="audit">
                            <p class="wf-approve-sp" id="audit_box">
                              <?php if($row->is_app_audit == 1){
                              echo ($row->app_status_id_audit == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_audit == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_audit == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?><br/>
                              <!-- <span class="semi-bold"><?php echo get_name($row->user_app_audit)?></span><br/> -->
                              <span class="small"><?php echo dateIndo($row->date_app_audit)?></span><br/>
                              <?php }elseif($row->is_app_audit == 0 && $is_admin_audit == 1){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalaudit"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span>
                              <?php }else{?>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <?php } ?>
                              <span class="semi-bold"><?php echo get_name_admin_audit(get_user_buid($user_nik))?></span><br/>
                              <span class="semi-bold">Audit</span>
                            </p>
                          </div>

                          <div class="col-md-3" id="it">
                            <p class="wf-approve-sp">
                              <?php if($row->is_app_it == 1){
                              echo ($row->app_status_id_it == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_it == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_it == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?><br />
                              <!-- <span class="semi-bold"><?php echo get_name($row->user_app_it)?></span><br/> -->
                              <span class="small"><?php echo dateIndo($row->date_app_it)?></span><br/>
                              <?php }elseif($row->is_app_it == 0 && $is_admin_it == 1){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalit"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span>
                              <?php }else{?>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <?php } ?>
                              <span class="semi-bold"><?php echo get_name_admin_it(get_user_buid($user_nik))?></span><br/>
                              <span class="semi-bold">IT</span>
                            </p>
                          </div>
                          <div class="col-md-3" id="keuangan">
                            <p class="wf-approve-sp">
                              <?php if($row->is_app_keuangan == 1){
                              echo ($row->app_status_id_keuangan == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_keuangan == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_keuangan == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?><br/>
                              <!-- <span class="semi-bold"><?php echo get_name($row->user_app_keuangan)?></span><br/> -->
                              <span class="small"><?php echo dateIndo($row->date_app_keuangan)?></span><br/>
                              <?php }elseif($row->is_app_keuangan == 0 && $is_admin_keuangan == 1){?><br/>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalkeuangan"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span>
                              <?php }else{?>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <?php } ?>
                              <span class="semi-bold"><?php echo get_name_admin_keuangan(get_user_buid($user_nik))?></span><br/>
                              <span class="semi-bold">Keuangan</span>
                            </p>
                          </div>
                        </div>

                        <?php if(!empty($row->user_app_asset)){?>
                        <div class="row text-center">
                            <p class="wf-approve-sp">
                              <?php if($row->is_app_asset == 1){
                              echo ($row->app_status_id_asset == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_asset == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_asset == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                      <span class="semi-bold"><?php echo get_name($row->user_app_asset)?></span><br/>
                              <span class="small"><?php echo dateIndo($row->date_app_asset)?></span><br/>
                              <?php }elseif($row->is_app_asset == 0 && $sess_nik === $row->user_app_asset){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalasset"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span>
                              <?php }else{?>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <?php } ?>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">Asset Management</span>
                            </p>
                        </div>
                        <?php } ?>
                      </div> 
                    </div>
                      
                  <?php if($row->user_exit_rekomendasi_id != 0){?>
                    <div class="row form-row">
                      <div class="col-md-12">
                          <h4><br />Kami rekomendasikan kepada karyawan tersebut</h4>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <table class="table no-more-tables">
                          <tr>
                            <td>1</td>
                            <td>Diberikan Uang Pesangon</td>
                            <td>
                              <?php $pesangon = ($rekomendasi->is_pesangon == 1) ? 'Ya' : 'Tidak';?>
                                <div class="radio">
                                    <input id="pesangon" type="radio" name="pesangon" value="<?php echo $rekomendasi->is_pesangon?>" checked="checked">
                                  <label for="pesangon"><?php echo $pesangon?></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Diberikan uang pengganti hak</td>
                            <td>
                              <?php $uang_ganti = ($rekomendasi->is_uang_ganti == 1) ? 'Ya' : 'Tidak';?>
                                <div class="radio">
                                    <input id="uang_ganti" type="radio" name="uang_ganti" value="<?php echo $rekomendasi->is_uang_ganti?>" checked="checked">
                                  <label for="uang_ganti"><?php echo $uang_ganti?></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Diberikan uang jasa</td>
                            <td>
                              <?php $uang_jasa = ($rekomendasi->is_uang_jasa == 1) ? 'Ya' : 'Tidak';?>
                                <div class="radio">
                                    <input id="uang_jasa" type="radio" name="uang_jasa" value="<?php echo $rekomendasi->is_uang_jasa?>" checked="checked">
                                  <label for="uang_jasa"><?php echo $uang_jasa?></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Diberikan surat keterangan kerja</td>
                            <td>
                              <?php $sk_kerja = ($rekomendasi->is_sk_kerja == 1) ? 'Ya' : 'Tidak';?>
                                <div class="radio">
                                    <input id="sk_kerja" type="radio" name="sk_kerja" value="<?php echo $rekomendasi->is_sk_kerja?>" checked="checked">
                                  <label for="sk_kerja"><?php echo $sk_kerja?></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>Diberikan ijazah asli ybs</td>
                            <td>
                              <?php $ijazah = ($rekomendasi->is_ijazah == 1) ? 'Ya' : 'Tidak';?>
                                <div class="radio">
                                    <input id="ijazah" type="radio" name="ijazah" value="<?php echo $rekomendasi->is_ijazah?>" checked="checked">
                                  <label for="ijazah"><?php echo $ijazah?></label>
                                </div>
                            </td>
                          </tr>

                          <tr>
                            <td>6</td>
                            <td>Diberikan uang pisah (untuk resign/pengunduran diri)</td>
                            <td>
                              <?php $uang_pisah = ($rekomendasi->is_uang_pisah == 1) ? 'Ya' : 'Tidak';?>
                                <div class="radio">
                                    <input id="uang_pisah" type="radio" name="uang_pisah" value="<?php echo $rekomendasi->is_uang_pisah?>" checked="checked">
                                  <label for="uang_pisah"><?php echo $uang_pisah?></label>
                                </div>
                            </td>
                          </tr>
                          
                        </table>
                       </div>
                    </div>
                    <?php } ?>

                  <div id="note">
                  <?php if(!empty($row->note_mgr)){?>
                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label text-left">Catatan Manager Ga Nasional</label>
                    </div>
                    <div class="col-md-12">
                      <textarea  id="text-editor" placeholder="" class="form-control" rows="2" disabled><?php echo $row->note_mgr?></textarea>
                    </div>
                  </div>
                  <?php }?>


                  <?php if(!empty($row->note_koperasi)){?>
                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label text-left">Catatan Sie Koperasi</label>
                    </div>
                    <div class="col-md-12">
                      <textarea  id="text-editor" placeholder="" class="form-control" rows="2" disabled><?php echo $row->note_koperasi?></textarea>
                    </div>
                  </div>
                  <?php }?>

                  <?php if(!empty($row->note_perpus)){?>
                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label text-left">Catatan Perpustakaan</label>
                    </div>
                    <div class="col-md-12">
                      <textarea  id="text-editor" placeholder="" class="form-control" rows="2" disabled><?php echo $row->note_perpus?></textarea>
                    </div>
                  </div>
                  <?php }?>

                  <?php if(!empty($row->note_hrd)){?>
                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label text-left">Catatan HRD</label>
                    </div>
                    <div class="col-md-12">
                      <textarea  id="text-editor" placeholder="" class="form-control" rows="2" disabled><?php echo $row->note_hrd?></textarea>
                    </div>
                  </div>
                  <?php }?>

                  <?php if(!empty($row->note_it)){?>
                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label text-left">Catatan IT</label>
                    </div>
                    <div class="col-md-12">
                      <textarea  id="text-editor" placeholder="" class="form-control" rows="2" disabled><?php echo $row->note_it?></textarea>
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
                    </div>

                  <h4>Hubungi sekretariat HRD (021-xxxxxx)</h4>

                 <div class="form-actions">

                  <div class="row form-row">
                    <div class="col-md-12 text-center">
                    <?php  
                    for($i=1;$i<4;$i++):
                      $is_app = 'is_app_lv'.$i;
                      $user_app = 'user_app_lv'.$i;
                      if($row->$is_app == 1 && get_nik($sess_id) == $row->$user_app){?>
                        <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalLv<?php echo $i ?>"><i class='icon-edit'> Edit Approval</i></div>
                        <div class='btn btn-warning btn-small text-center' title='Kirim Notifikasi' onClick="send_notif_('lv<?php echo $i?>')"><i class='icon-mail-forward'> Kirim Notifikasi</i></div>
                    <?php }endfor;?>
                    </div>
                  </div>

                <div class="row wf-cuti">

                  <div class="col-md-12 text-center">
                  <div class="col-md-4">
                    <p class="wf-approve-sp">
                    <div class="col-md-12"><span class="semi-bold">Hormat Kami,</span><br/><br/></div>
                      <span class="small"></span><br/>
                      <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="semi-bold"><?php echo get_name($row->created_by)?></span><br/>
                      <span class="small"><?php echo dateIndo($row->created_on)?></span><br/>
                      <span class="semi-bold">Atasan Langsung</span>
                    </p>
                  </div>

                  <div class="col-md-4" id="lv1">
                    <p class="wf-approve-sp">
                    <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/></div>
                      <?php 
                      $approved = assets_url('img/approved_stamp.png');
                      $rejected = assets_url('img/rejected_stamp.png');
                      if(!empty($row->user_app_lv1) && $row->is_app_lv1 == 0 && get_nik($sess_id) == $row->user_app_lv1){?>
                      <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv1"><i class="icon-ok"></i>Submit</div>
                      <span class="small"></span>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span>
                        <span class="semi-bold">(Atasan Langsung)</span>
                      <?php }elseif(!empty($row->user_app_lv1) && $row->is_app_lv1 == 1){
                        echo ($row->app_status_id_lv1 == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_lv1 == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_lv1 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                      <span class="small"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_lv1)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_lv1)?></span><br/>
                        <span class="semi-bold"><?php echo get_user_position($row->user_app_lv1);?></span>
                      <?php }else{?>
                        <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_lv1)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_lv1)?></span><br/>
                        <span class="semi-bold"><?php echo get_user_position($row->user_app_lv1);?></span>
                      <?php } ?>
                    </p>
                  </div>
                    
                  <div class="col-md-4" id="lv2">
                  <?php if(!empty($row->user_app_lv2)) : ?>
                    <p class="wf-approve-sp">
                    <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/></div>
                    <?php
                     if(!empty($row->user_app_lv2) && $row->is_app_lv2 == 0 && get_nik($sess_id) == $row->user_app_lv2){?>
                        <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv2"><i class="icon-ok"></i>Submit</div>
                        <span class="small"></span>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold">(Atasan Tidak Langsung)</span>
                      <?php }elseif(!empty($row->user_app_lv2) && $row->is_app_lv2 == 1){
                        echo ($row->app_status_id_lv2 == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_lv2 == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_lv2 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                      <span class="small"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_lv2)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_lv2)?></span><br/>
                        <span class="semi-bold"><?php echo get_user_position($row->user_app_lv2);?></span>
                      <?php }else{?>
                        <span class="small"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold"><?php echo get_name($row->user_app_lv2)?></span><br/>
                        <span class="small"><?php echo dateIndo($row->date_app_lv2)?></span><br/>
                        <span class="semi-bold"><?php echo get_user_position($row->user_app_lv2);?></span>
                      <?php } ?>
                    </p>
                  <?php endif; ?>
                  </div>
                </div>
              </div> 

              <?php if(!empty($row->user_app_lv3)){?>
              <div class="col-md-12 text-xenter" id="lv3">
                <div class="col-md-12 text-center">
                  <p class="wf-approve-sp">
                  <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/></div>
                    <?php 
                    $approved = assets_url('img/approved_stamp.png');
                    $rejected = assets_url('img/rejected_stamp.png');
                    if(!empty($row->user_app_lv3) && $row->is_app_lv3 == 0 && get_nik($sess_id) == $row->user_app_lv3){?>
                      <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv3"><i class="icon-ok"></i>Submit</div>
                      <span class="small"></span>
                      <span class="semi-bold"></span><br/>
                      <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv3)?>)</span>
                    <?php }elseif(!empty($row->user_app_lv3) && $row->is_app_lv3 == 1){
                      echo ($row->app_status_id_lv3 == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_lv3 == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_lv3 == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?>
                      <span class="small"></span><br/>
                      <span class="semi-bold"><?php echo get_name($row->user_app_lv3)?></span><br/>
                      <span class="small"><?php echo dateIndo($row->date_app_lv3)?></span><br/>
                      <span class="semi-bold"></span>
                      <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv3)?>)</span>
                    <?php }else{?>
                      <span class="small"></span><br/>
                      <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="semi-bold"><?php echo (!empty($row->user_app_lv3))?get_user_position($row->user_app_lv3):'';?></span>
                    <?php } ?>
                  </p>
                </div>
              </div>
              <?php } ?>

              </div>
            </form>
              </div>
          </div>
        </div>
      </div>
              
    
      </div>
    
  </div>  
  <!-- END PAGE -->

<?php for($i=1;$i<4;$i++):?>
  <!--approval  Modal atasan -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="<?php echo 'submitModalLv'.$i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Atasan</h4>
      </div>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="<?php echo 'formApplv'.$i?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $x = 'app_status_id_lv'.$i;
                      $y = 'note_lv'.$i;
                      $checked = ($app->id <> 0 && $app->id == $row->$x) ? 'checked = "checked"' : '';
                      $checked2 = ($app->id == 1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv<?php echo $i.'-'.$app->id?>" type="radio" name="<?php echo 'app_status_lv'.$i?>" value="<?php echo $app->id?>" <?php echo (!empty($checked))?$checked:$checked2;?>>
                  <label for="app_status_lv<?php echo $i.'-'.$app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="<?php echo 'app_status_lv'.$i?>" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note : </label>
              </div>
              <div class="col-md-12">
                <textarea name="<?php echo 'note_lv'.$i?>" class="form-control" placeholder="Isi note disini...."><?php echo $row->$y?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
         <button id="btnApplv<?=$i?>" onclick="approve('lv<?=$i?>')" type="button" class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal-->
<?php endfor;?>

<?php 
$admin_inv = array('mgr', 'koperasi', 'keuangan', 'perpus', 'hrd', 'it');
foreach($admin_inv as $k=>$v):?>
  <!--approval  Modal atasan -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="<?php echo 'submitModal'.$v?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Atasan</h4>
      </div>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="<?php echo 'formApp'.$v?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $x = 'app_status_id_'.$v;
                      $y = 'note_'.$v;
                      $checked = ($app->id <> 0 && $app->id == $row->$x) ? 'checked = "checked"' : '';
                      $checked2 = ($app->id == 1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_<?php echo $v.'-'.$app->id?>" type="radio" name="<?php echo 'app_status_'.$v?>" value="<?php echo $app->id?>" <?php echo (!empty($checked))?$checked:$checked2;?>>
                  <label for="app_status_<?php echo $v.'-'.$app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="<?php echo 'app_status_'.$v?>" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note : </label>
              </div>
              <div class="col-md-12">
                <textarea name="<?php echo 'note_'.$v?>" class="form-control" placeholder="Isi note disini...."><?php echo $row->$y?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
         <button id="btnApp<?=$v?>" onclick="approve('<?=$v?>')" type="button" class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal-->
<?php endforeach;?>

<!--approval exit Modal asset -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="submitModalasset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form exit - Atasan Lainnya</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formAppAsset">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->app_status_id_asset) ? 'checked = "checked"' : '';
                      $checked2 = ($app->id == 1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_asset<?php echo $app->id?>" type="radio" name="app_status_asset" value="<?php echo $app->id?>" <?php echo (!empty($checked))?$checked:$checked2;?>>
                  <label for="app_status_asset<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="app_status_asset" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Atasan) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_asset" class="custom-txtarea-form" placeholder="Note atasan isi disini"><?php echo $row->note_asset?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="btnAppAsset"  class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal asset--> 


<?php endforeach;
// }else{
  // echo '<div class="col-md-12 text-center">Pengajuan Ini Telah Di Batalkan Oleh Pengaju</div>';
  // } ?>

