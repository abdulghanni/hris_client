<div id="container">
        <div class="row">
          <div class="col-md-12">
            <div class="grid simple">
              <div class="grid-title no-border">
                  <h4>Form Rekomendasi <span class="semi-bold"><a href="<?php echo site_url('form_exit')?>">Karyawan Keluar</a></span></h4>
              </div>
              <div class="grid-body no-border">
                 <?php echo form_open("form_exit/add",array("id"=>"formaddexit"));
                    foreach($form_exit->result() as $row):
                 ?>
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-3">
                          <input name="emp" id="emp" type="text"  class="form-control" placeholder="Nama Karyawan" value="<?php echo get_name($row->user_id)?>" disabled="disabled">
                      </div>

                      <div class="col-md-2">
                        <label class="form-label text-right">Wilayah</label>
                      </div>
                      <div class="col-md-3">
                        <input name="emp" id="emp" type="text"  class="form-control" placeholder="Nama Karyawan" value="<?php echo get_user_bu($user_nik)?>" disabled="disabled">
                      </div>

                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">NIK</label>
                      </div>
                      <div class="col-md-3">
                        <input name="emp" id="emp" type="text"  class="form-control" placeholder="Nama Karyawan" value="<?php echo$user_nik?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-3">
                        <input name="emp" id="emp" type="text"  class="form-control" placeholder="Nama Karyawan" value="<?php echo get_user_organization($user_nik)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-3">
                        <input name="emp" id="emp" type="text"  class="form-control" placeholder="Nama Karyawan" value="<?php echo get_user_position($user_nik)?>" disabled="disabled">
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
                      
                      

                        <div class="row text-center">
                          <div class="row text-center"><span class="semi-bold">Mengetahui,</span></div>
                          <div class="row wf-cuti">
                            <div class="col-md-2">
                              <p class="wf-approve-sp">
                                <?php 
                                $approved = assets_url('img/approved_stamp.png');
                                $rejected = assets_url('img/rejected_stamp.png');
                                if($row->is_app_mgr == 1){
                                echo ($row->app_status_id_mgr == 1)? "<img class=approval_img_md src=$approved>":(($row->app_status_id_mgr == 2) ? "<img class=approval_img_md src=$rejected>":'');?><br/>
                                <span class="semi-bold"><?php echo get_name($row->user_app_mgr)?></span><br/>
                                <span class="small"><?php echo dateIndo($row->date_app_mgr)?></span><br/>
                                <?php }elseif($row->is_app_mgr == 0 && $is_admin_logistik == 1){?>
                                <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/><span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/>
                                <span class="small"></span>
                                <?php }else{?>
                                <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/>
                                <span class="small"></span><br/>
                                <?php } ?>
                                <span class="semi-bold"></span><br/>
                                <span class="semi-bold">Mgr GA Nasional</span>
                              </p>
                            </div>

                          <div class="col-md-2">
                            <p class="wf-approve-sp">
                              <?php if($row->is_app_koperasi == 1){
                              echo ($row->app_status_id_koperasi == 1)? "<img class=approval_img_md src=$approved>":(($row->app_status_id_koperasi == 2) ? "<img class=approval_img_md src=$rejected>":'');?><br/>
                              <span class="semi-bold"><?php echo get_name($row->user_app_koperasi)?></span><br/>
                              <span class="small"><?php echo dateIndo($row->date_app_koperasi)?></span><br/>
                              <?php }elseif($row->is_app_koperasi == 0 && $is_admin_koperasi == 1){?>
                             <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/><span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span>
                              <?php }else{?>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <?php } ?>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">Sie Koperasi</span>
                            </p>
                          </div>
                          
                          <div class="col-md-2">
                            <p class="wf-approve-sp">
                              <?php if($row->is_app_perpus == 1){
                                echo ($row->app_status_id_perpus == 1)? "<img class=approval_img_md src=$approved>":(($row->app_status_id_perpus == 2) ? "<img class=approval_img_md src=$rejected>":'');?><br/>
                              <span class="semi-bold"><?php echo get_name($row->user_app_perpus)?></span><br/>
                              <span class="small"><?php echo dateIndo($row->date_app_perpus)?></span><br/>
                              <?php }elseif($row->is_app_perpus == 0 && $is_admin_perpus == 1){?>
                              <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/><span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span>
                              <?php }else{?>
                              <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <?php } ?>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">Perpustakaan</span>
                            </p>
                          </div>
                          
                          <div class="col-md-2">
                            <p class="wf-approve-sp">
                              <?php if($row->is_app_hrd == 1){
                              echo ($row->app_status_id_hrd == 1)? "<img class=approval_img_md src=$approved>":(($row->app_status_id_hrd == 2) ? "<img class=approval_img_md src=$rejected>":'');?><br/>
                              <span class="semi-bold"><?php echo get_name($row->user_app_hrd)?></span><br/>
                              <span class="small"><?php echo dateIndo($row->date_app_hrd)?></span><br/>
                              <?php }elseif($row->is_app_hrd == 0 && $is_admin_hrd == 1){?>
                              <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/><span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span>
                              <?php }else{?>
                              <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <?php } ?>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">HRD Database</span>
                            </p>
                          </div>

                          <div class="col-md-2">
                            <p class="wf-approve-sp">
                              <?php if($row->is_app_it == 1){
                              echo ($row->app_status_id_it == 1)? "<img class=approval_img_md src=$approved>":(($row->app_status_id_it == 2) ? "<img class=approval_img_md src=$rejected>":'');?><br/>
                              <span class="semi-bold"><?php echo get_name($row->user_app_it)?></span><br/>
                              <span class="small"><?php echo dateIndo($row->date_app_it)?></span><br/>
                              <?php }elseif($row->is_app_it == 0 && $is_admin_it == 1){?>
                              <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/><span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span>
                              <?php }else{?>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <?php } ?>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">IT</span>
                            </p>
                          </div>
                          <div class="col-md-2">
                            <p class="wf-approve-sp">
                              <?php if($row->is_app_keuangan == 1){
                              echo ($row->app_status_id_keuangan == 1)? "<img class=approval_img_md src=$approved>":(($row->app_status_id_keuangan == 2) ? "<img class=approval_img_md src=$rejected>":'');?><br/>
                              <span class="semi-bold"><?php echo get_name($row->user_app_keuangan)?></span><br/>
                              <span class="small"><?php echo dateIndo($row->date_app_keuangan)?></span><br/>
                              <?php }elseif($row->is_app_keuangan == 0 && $is_admin_keuangan == 1){?>
                              <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/><span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span>
                              <?php }else{?>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <?php } ?>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">Keuangan</span>
                            </p>
                          </div>
                        </div>
                        <?php if(!empty($row->user_app_asset)){?>
                        <div class="row text-center">
                            <p class="wf-approve-sp">
                              <?php if($row->is_app_asset == 1){
                              echo ($row->app_status_id_asset == 1)? "<img class=approval-img-sm src=$approved>":(($row->app_status_id_asset == 2) ? "<img class=approval_img_md src=$rejected>":'');?><br/>
                              <span class="semi-bold"><?php echo get_name($row->user_app_asset)?></span><br/>
                              <span class="small"><?php echo dateIndo($row->date_app_asset)?></span><br/>
                              <?php }elseif($row->is_app_asset == 0 && $sess_nik === $row->user_app_asset){?>
                              <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/><span class="semi-bold"></span><br/>
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
                            <td>3</td>
                            <td>Diberikan uang pisah</td>
                            <td>
                              <?php $uang_pisah = ($rekomendasi->is_uang_pisah == 1) ? 'Ya' : 'Tidak';?>
                                <div class="radio">
                                    <input id="uang_pisah" type="radio" name="uang_pisah" value="<?php echo $rekomendasi->is_uang_pisah?>" checked="checked">
                                  <label for="uang_pisah"><?php echo $uang_pisah?></label>
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
                        </table>
                       </div>
                    </div>
                    <?php } ?>
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


                  <?php if(!empty($row->note_lv1)){?>
                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label text-left">Catatan Atasan Langsung</label>
                    </div>
                    <div class="col-md-12">
                      <textarea  id="text-editor" placeholder="Enter text ..." class="form-control" rows="2" disabled><?php echo $row->note_lv1?></textarea>
                    </div>
                  </div>
                  <?php }?>

                  <?php if(!empty($row->note_lv2)){?>
                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label text-left">Catatan Atasan Tidak Langsung</label>
                    </div>
                    <div class="col-md-12">
                      <textarea  id="text-editor" placeholder="Enter text ..." class="form-control" rows="2" disabled><?php echo $row->note_lv2?></textarea>
                    </div>
                  </div>
                  <?php }?>

                  <?php if(!empty($row->note_lv3)){?>
                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label text-left">Catatan Atasan Lainnya</label>
                    </div>
                    <div class="col-md-12">
                      <textarea  id="text-editor" placeholder="Enter text ..." class="form-control" rows="2" disabled><?php echo $row->note_lv3?></textarea>
                    </div>
                  </div>
                  <?php }?>

                  <h4>Hubungi sekretariat HRD (021-xxxxxx)</h4>

                 <div class="form-actions">


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

                  <div class="col-md-4">
                    <p class="wf-approve-sp">
                    <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/></div>
                      <?php 
                      $approved = assets_url('img/approved_stamp.png');
                      $rejected = assets_url('img/rejected_stamp.png');
                      if(!empty($row->user_app_lv1) && $row->is_app_lv1 == 0 && get_nik($sess_id) == $row->user_app_lv1){?>
                      <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span>
                        <span class="semi-bold">(Atasan Langsung)</span>
                      <?php }elseif(!empty($row->user_app_lv1) && $row->is_app_lv1 == 1){
                        echo ($row->app_status_id_lv1 == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_lv1 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?>
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
                    
                  <div class="col-md-4">
                  <?php if(!empty($row->user_app_lv2)) : ?>
                    <p class="wf-approve-sp">
                    <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/></div>
                    <?php
                     if(!empty($row->user_app_lv2) && $row->is_app_lv2 == 0 && get_nik($sess_id) == $row->user_app_lv2){?>
                        <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="small"></span><br/>
                        <span class="semi-bold"></span><br/>
                        <span class="semi-bold">(Atasan Tidak Langsung)</span>
                      <?php }elseif(!empty($row->user_app_lv2) && $row->is_app_lv2 == 1){
                        echo ($row->app_status_id_lv2 == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_lv2 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?>
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
              <div class="col-md-12 text-xenter">
                <div class="col-md-12 text-center">
                  <p class="wf-approve-sp">
                  <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/></div>
                    <?php 
                    $approved = assets_url('img/approved_stamp.png');
                    $rejected = assets_url('img/rejected_stamp.png');
                    if(!empty($row->user_app_lv3) && $row->is_app_lv3 == 0 && get_nik($sess_id) == $row->user_app_lv3){?>
                      <span class="semi-bold"></span><br/>
                                <span class="semi-bold"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="small"></span><br/>
                      <span class="semi-bold"></span><br/>
                      <span class="semi-bold">(<?php echo get_user_position($row->user_app_lv3)?>)</span>
                    <?php }elseif(!empty($row->user_app_lv3) && $row->is_app_lv3 == 1){
                      echo ($row->app_status_id_lv3 == 1)?"<img class='approval-img-al' src=$approved>":(($row->app_status_id_lv3 == 2) ? "<img class='approval-img-al' src=$rejected>":'<span class="small"></span><br/>');?>
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
<?php endforeach;?>