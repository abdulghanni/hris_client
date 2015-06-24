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
                        <input name="emp" id="emp" type="text"  class="form-control" placeholder="Nama Karyawan" value="<?php echo $user_info['BU']?>" disabled="disabled">
                      </div>

                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">NIK</label>
                      </div>
                      <div class="col-md-3">
                        <input name="emp" id="emp" type="text"  class="form-control" placeholder="Nama Karyawan" value="<?php echo $user_info['EMPLID']?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-3">
                        <input name="emp" id="emp" type="text"  class="form-control" placeholder="Nama Karyawan" value="<?php echo $user_info['ORGANIZATION']?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-3">
                        <input name="emp" id="emp" type="text"  class="form-control" placeholder="Nama Karyawan" value="<?php echo $user_info['POSITION']?>" disabled="disabled">
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
                      
                      <?php $mgr_id = (!empty($mgr_ga_nas)) ? $mgr_ga_nas : 'D0001';?>
                      <div class="col-md-12 text-center"><div class="col-md-12 text-center"><span class="semi-bold">Mengetahui,</span><br/><br/><br/></div>
                      <div class="row wf-cuti">
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php 
                            $approved = assets_url('img/approved_stamp.png');
                            $rejected = assets_url('img/rejected_stamp.png');
                            if($row->is_app_mgr == 1){
                            echo ($row->app_status_id_mgr == 1)? "<img class=approval_img_md src=$approved>":(($row->app_status_id_mgr == 2) ? "<img class=approval_img_md src=$rejected>":'');?><br/>
                            <span class="semi-bold"><?php echo get_name(!empty($mgr_ga_nas) ? $mgr_ga_nas : 'D0001')?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_mgr)?></span><br/>
                            <?php }elseif($row->is_app_mgr == 0 && get_nik($sess_id) === $mgr_id){?>
                            
                            <span class="small"></span><br/>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <?php } ?>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold">Mgr GA Nasional</span>
                          </p>
                        </div>

                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php if($row->is_app_koperasi == 1){
                            echo ($row->app_status_id_koperasi == 1)? "<img class=approval_img_md src=$approved>":(($row->app_status_id_koperasi == 2) ? "<img class=approval_img_md src=$rejected>":'');?><br/>
                            <span class="semi-bold"><?php echo get_name($koperasi)?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_koperasi)?></span><br/>
                            <?php }elseif($row->is_app_koperasi == 0 && get_nik($sess_id) == $koperasi){?>
                            
                            <span class="small"></span><br/>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <?php } ?>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold">Sie Koperasi</span>
                          </p>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php if($row->is_app_perpus == 1){
                              echo ($row->app_status_id_perpus == 1)? "<img class=approval_img_md src=$approved>":(($row->app_status_id_perpus == 2) ? "<img class=approval_img_md src=$rejected>":'');?><br/>
                            <span class="semi-bold"><?php echo get_name($perpustakaan)?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_perpus)?></span><br/>
                            <?php }elseif($row->is_app_perpus == 0 && get_nik($sess_id) == $perpustakaan){?>
                            
                            <span class="small"></span><br/>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <?php } ?>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold">Perpustakaan</span>
                          </p>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php if($row->is_app_hrd == 1){
                            echo ($row->app_status_id_hrd == 1)? "<img class=approval_img_md src=$approved>":(($row->app_status_id_hrd == 2) ? "<img class=approval_img_md src=$rejected>":'');?><br/>
                            <span class="semi-bold"><?php echo get_name($hrd)?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_hrd)?></span><br/>
                            <?php }elseif($row->is_app_hrd == 0 && get_nik($sess_id) == $hrd){?>
                            
                            <span class="small"></span><br/>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <?php } ?>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold">HRD Database</span>
                          </p>
                        </div>
                        <!--PST242, PST263, PST2, PST129-->
                      </div>
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


                  <?php if(!empty($row->note_app)){?>
                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label text-left">Catatan Khusus</label>
                    </div>
                    <div class="col-md-12">
                      <textarea  id="text-editor" placeholder="Enter text ..." class="form-control" rows="2" disabled><?php echo $row->note_app?></textarea>
                    </div>
                  </div>
                  <?php }?>
                 <div class="form-actions">
                    <div class="row form-row">
                        <div class="col-md-12 text-center">
                        <?php if($row->is_app == 1 && is_admin() == true){?>
                            
                          <?php } ?>
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                      <div class="row wf-cuti">
                        <div class="col-md-4">
                          Hormat Kami,<br/><br/>
                          <p class="wf-approve-sp">
                            <span class="semi-bold"><?php echo get_name(get_superior($row->user_id))?></span><br/>
                            <span class="small"><?php echo dateIndo($row->created_on)?></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold">Atasan Langsung</span>
                          </p>
                        </div>

                        <div class="col-md-4"></div>
                        
                        <div class="col-md-4">
                          Mengetahui / Menyetujui,<br/><br/>
                          <p class="wf-approve-sp">
                            <?php if($row->is_app==1){
                              echo ($row->app_status_id == 1)? "<img class=approval_img_md src=$approved>":(($row->app_status_id == 2) ? "<img class=approval_img_md src=$rejected>":'');?><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app)?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app)?><br/>  
                            <span class="semi-bold"></span><br/>
                            <?php }elseif($row->is_app == 0 && is_admin()){?>
                            
                            <span class="small"></span><br/>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold"></span><br/>
                            <?php } ?>
                            <span class="semi-bold">ASM/Mgr/Kacab/BDM/CoE</span>
                          </p>
                        </div>
                      </div>
                    </div> 
                  </div>
                </div>
                </form>
              </div>
          </div>
<?php endforeach;?>