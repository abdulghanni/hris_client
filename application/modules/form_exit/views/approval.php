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
              </div>
              <div class="grid-body no-border">
                 <form id="" class="form-no-horizontal-spacing">
                    <?php foreach($form_exit->result() as $row):
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
                      
                      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
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
                            <tr>
                              <td>1</td>
                              <td>Baju Seragam</td>
                              <td>
                                  <?php $seragam = ($inventaris->is_seragam == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="seragam" type="radio" name="seragamn" value="<?php echo $inventaris->is_seragam?>" checked="checked">
                                    <label for="seragam"><?php echo $seragam?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_seragam" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_seragam?>" disabled="disabled"></td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>ID Card</td>
                              <td>
                                <?php $id_card = ($inventaris->is_id_card == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="id_card" type="radio" name="id_card" value="<?php echo $inventaris->is_id_card?>" checked="checked">
                                    <label for="id_card"><?php echo $id_card?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_id_card" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_id_card?>" disabled="disabled"></td>
                            </tr>
                           <tr>
                              <td>3</td>
                              <td>Sepeda Motor</td>
                              <td>
                                <?php $motor = ($inventaris->is_motor == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="motor" type="radio" name="motor" value="<?php echo $inventaris->is_motor?>" checked="checked">
                                    <label for="motor"><?php echo $motor?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_motor" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_motor?>" disabled="disabled"></td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td>Mobil</td>
                              <td>
                                <?php $mobil = ($inventaris->is_mobil == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="mobil" type="radio" name="mobil" value="<?php echo $inventaris->is_mobil?>" checked="checked">
                                    <label for="mobil"><?php echo $mobil?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_mobil" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_mobil?>" disabled="disabled"></td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td>STNK Motor</td>
                              <td>
                                <?php $stnk_motor = ($inventaris->is_stnk_motor == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="stnk_motor" type="radio" name="stnk_motor" value="<?php echo $inventaris->is_stnk_motor?>" checked="checked">
                                    <label for="stnk_motor"><?php echo $stnk_motor?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_stnk_motor" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_stnk_motor?>" disabled="disabled"></td>
                            </tr>
                            <tr>
                              <td>6</td>
                              <td>STNK Mobil</td>
                              <td>
                                <?php $stnk_mobil = ($inventaris->is_stnk_mobil == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="stnk_mobil" type="radio" name="stnk_mobil" value="<?php echo $inventaris->is_stnk_mobil?>" checked="checked">
                                    <label for="stnk_mobil"><?php echo $stnk_mobil?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_stnk_mobil" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_stnk_mobil?>" disabled="disabled"></td>
                            </tr>
                            <tr>
                              <td>7</td>
                              <td>HP</td>
                              <td>
                                <?php $hp = ($inventaris->is_hp == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="hp" type="radio" name="hp" value="<?php echo $inventaris->is_hp?>" checked="checked">
                                    <label for="hp"><?php echo $hp?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_hp" id="keterangan" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_hp?>" disabled="disabled"></td>
                            </tr>
                            <tr>
                              <td>8</td>
                              <td>Laptop</td>
                              <td>
                                <?php $laptop = ($inventaris->is_laptop == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="laptop" type="radio" name="laptop" value="<?php echo $inventaris->is_laptop?>" checked="checked">
                                    <label for="laptop"><?php echo $laptop?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_laptop" id="keterangan" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_laptop?>" disabled="disabled"></td>
                            </tr>
                            <tr>
                              <td>9</td>
                              <td>Ipad</td>
                              <td>
                                <?php $ipad = ($inventaris->is_ipad == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="ipad" type="radio" name="ipad" value="<?php echo $inventaris->is_ipad?>" checked="checked">
                                    <label for="ipad"><?php echo $ipad?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_ipad" id="keterangan" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_ipad?>" disabled="disabled"></td>
                            </tr>
                            <tr>
                              <td>10</td>
                              <td>Laporan serah terima</td>
                              <td>
                                <?php $laporan = ($inventaris->is_laporan == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="laporan" type="radio" name="laporan" value="<?php echo $inventaris->is_laporan?>" checked="checked">
                                    <label for="laporan"><?php echo $laporan?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_laporan" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_laporan?>" disabled="disabled"></td>
                            </tr>
                            <tr>
                              <td>11</td>
                              <td>Rekonsiliasi Saldo</td>
                              <td>
                                <?php $saldo = ($inventaris->is_saldo == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="saldo" type="radio" name="saldo" value="<?php echo $inventaris->is_saldo?>" checked="checked">
                                    <label for="saldo"><?php echo $saldo?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_saldo" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_saldo?>" disabled="disabled"></td>
                            </tr>
                            <tr>
                              <td>12</td>
                              <td>Pinjaman Koperasi</td>
                              <td>
                                <?php $pinjaman_koperasi = ($inventaris->is_pinjaman_koperasi == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="pinjaman_koperasi" type="radio" name="pinjaman_koperasi" value="<?php echo $inventaris->is_pinjaman_koperasi?>" checked="checked">
                                    <label for="pinjaman_koperasi"><?php echo $pinjaman_koperasi?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_koperasi" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_pinjaman_koperasi?>" disabled="disabled"></td>
                            </tr>
                            <tr>
                              <td>13</td>
                              <td>Pinjaman buku perpustakaan</td>
                              <td>
                                <?php $pinjaman_buku = ($inventaris->is_pinjaman_buku == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="pinjaman_buku" type="radio" name="pinjaman_buku" value="<?php echo $inventaris->is_pinjaman_buku?>" checked="checked">
                                    <label for="pinjaman_buku"><?php echo $pinjaman_buku?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_buku" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_pinjaman_buku?>" disabled="disabled"></td>
                            </tr>
                            <tr>
                              <td>14</td>
                              <td>Ikatan dinas</td>
                              <td>
                                <?php $ikatan = ($inventaris->is_ikatan == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="ikatan" type="radio" name="ikatan" value="<?php echo $inventaris->is_ikatan?>" checked="checked">
                                    <label for="ikatan"><?php echo $ikatan?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_ikatan" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_ikatan?>" disabled="disabled"></td>
                            </tr>
                            <tr>
                              <td>15</td>
                              <td>Kartu Kredit</td>
                              <td>
                                <?php $kartu_kredit = ($inventaris->is_kartu_kredit == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="kartu_kredit" type="radio" name="kartu_kredit" value="<?php echo $inventaris->is_kartu_kredit?>" checked="checked">
                                    <label for="kartu_kredit"><?php echo $kartu_kredit?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_kartu_kredit" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_kartu_kredit?>" disabled="disabled"></td>
                            </tr>
                            <tr>
                              <td>14</td>
                              <td>Pinjaman Subsidi Rumah</td>
                              <td>
                                <?php $pinjaman_subsidi = ($inventaris->is_pinjaman_subsidi == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="pinjaman_subsidi" type="radio" name="pinjaman_subsidi" value="<?php echo $inventaris->is_pinjaman_subsidi?>" checked="checked">
                                    <label for="pinjaman_subsidi"><?php echo $pinjaman_subsidi?></label>
                                  </div>
                              </td>
                              <td><input name="keterangan_pinjaman_subsidi" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $inventaris->keterangan_pinjaman_subsidi?>" disabled="disabled"></td>
                            </tr>
                          </table>
                        </div>
                      </div>

                      <?php $mgr_id = (!empty($mgr_ga_nas)) ? $mgr_ga_nas : 'D0001';?>
                  <div class="form-actions">
                    <div class="row form-row">
                        <div class="col-md-12 text-center">
                        <?php if($row->is_app_mgr == 1 && get_nik($sess_id) == $mgr_id){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitexitModalMgr"><i class='icon-edit'> Edit Approval</i></div>
                          <?php }elseif($row->is_app_koperasi == 1 && get_nik($sess_id) == $koperasi){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitexitModalKoperasi"><i class='icon-edit'> Edit Approval</i></div>
                          <?php }elseif($row->is_app_perpus == 1 && get_nik($sess_id) == $perpustakaan){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitexitModalPerpus"><i class='icon-edit'> Edit Approval</i></div>
                          <?php }elseif($row->is_app_hrd == 1 && get_nik($sess_id) == $hrd){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitexitModalHrd"><i class='icon-edit'> Edit Approval</i></div>
                          <?php } ?>
                        </div>
                    </div>

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
                            <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitexitModalMgr"><i class="icon-ok"></i>Submit</div>
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
                            <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitexitModalKoperasi"><i class="icon-ok"></i>Submit</div>
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
                            <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitexitModalPerpus"><i class="icon-ok"></i>Submit</div>
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
                            <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitexitModalHrd"><i class="icon-ok"></i>Submit</div>
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
                                <?php $pesangon = ($rekomendasi->is_pesangon == 1) ? 'Ada' : 'Tidak';?>
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
                                <?php $uang_ganti = ($rekomendasi->is_uang_ganti == 1) ? 'Ada' : 'Tidak';?>
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
                                <?php $uang_jasa = ($rekomendasi->is_uang_jasa == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="uang_jasa" type="radio" name="uang_jasa" value="<?php echo $rekomendasi->is_uang_jasa?>" checked="checked">
                                    <label for="uang_jasa"><?php echo $uang_jasa?></label>
                                  </div>
                              </td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td>Diberikan uang pisah</td>
                              <td>
                                <?php $uang_pisah = ($rekomendasi->is_uang_pisah == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="uang_pisah" type="radio" name="uang_pisah" value="<?php echo $rekomendasi->is_uang_pisah?>" checked="checked">
                                    <label for="uang_pisah"><?php echo $uang_pisah?></label>
                                  </div>
                              </td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td>Diberikan surat keterangan kerja</td>
                              <td>
                                <?php $sk_kerja = ($rekomendasi->is_sk_kerja == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="sk_kerja" type="radio" name="sk_kerja" value="<?php echo $rekomendasi->is_sk_kerja?>" checked="checked">
                                    <label for="sk_kerja"><?php echo $sk_kerja?></label>
                                  </div>
                              </td>
                            </tr>
                            <tr>
                              <td>6</td>
                              <td>Diberikan ijazah asli ybs</td>
                              <td>
                                <?php $ijazah = ($rekomendasi->is_ijazah == 1) ? 'Ada' : 'Tidak';?>
                                  <div class="radio">
                                      <input id="ijazah" type="radio" name="ijazah" value="<?php echo $rekomendasi->is_ijazah?>" checked="checked">
                                    <label for="ijazah"><?php echo $ijazah?></label>
                                  </div>
                              </td>
                            </tr>
                          </table>
                        </div>

                        
                      
                  </div>

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
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitexitModal"><i class='icon-edit'> Edit Approval</i></div>
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
                            <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitexitModal"><i class="icon-ok"></i>Submit</div><br />
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
        </div>
      </div>
              
    
      </div>
    
  </div>  
  <!-- END PAGE -->

<!-- do approval exit Modal ASM/Mgr/Kacab/BDM/CoE -->
<div class="modal fade" id="submitexitModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Exit Clearence</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
      <?php $action = ($row->is_app == 0)?'do':'update';?>
        <form class="form-no-horizontal-spacing" id="formAppAdmin">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval</label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->app_status_id) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status<?php echo $app->id?>" type="radio" name="app_status" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="app_status" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (ASM/Mgr/Kacab/BDM/CoE) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_app" class="custom-txtarea-form" placeholder="Note ASM/Mgr/Kacab/BDM/CoE isi disini"><?php echo $row->note_app?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit" id="btn_app_admin"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end do ASM/Mgr/Kacab/BDM/CoE--> 


<!-- do approval exit Modal mgr Ga Nasional -->
<div class="modal fade" id="submitexitModalMgr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Exit Clearence</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
      <?php $action = ($row->is_app_mgr == 0)?'do':'update';?>
        <form class="form-no-horizontal-spacing" id="formAppMgr" method="POST" action="<?php echo site_url('form_exit/'.$action.'_approve/lv1/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval</label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->app_status_id_mgr) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_mgr<?php echo $app->id?>" type="radio" name="app_status_mgr" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_mgr<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status_mgr" type="radio" name="app_status_mgr" value="0">
                  <label for="app_status_mgr">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Manager Ga Nasional) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_mgr" class="custom-txtarea-form" placeholder="Note Manager Ga Nasional isi disini"><?php echo $row->note_mgr?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit" id="btn_app_mgr" class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end do mgr Ga Nasional--> 

<!-- do approval exit Modal koperasi -->
<div class="modal fade" id="submitexitModalKoperasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Exit Clearence</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
      <?php $action = ($row->is_app_koperasi == 0)?'do':'update';?>
        <form class="form-no-horizontal-spacing" id="formAppKoperasi" method="POST" action="<?php echo site_url('form_exit/'.$action.'_approve/lv1/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval</label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->app_status_id_koperasi) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_koperasi<?php echo $app->id?>" type="radio" name="app_status_koperasi" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_koperasi<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status_koperasi" type="radio" name="app_status_koperasi" value="0">
                  <label for="app_status_koperasi">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Sie Koperasi) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_koperasi" class="custom-txtarea-form" placeholder="Note Sie Koperasi isi disini"><?php echo $row->note_koperasi?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit" id="btn_app_koperasi" class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end do Koperasi--> 

<!-- do approval exit Modal Perpustakaan -->
<div class="modal fade" id="submitexitModalPerpus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Exit Clearence</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
      <?php $action = ($row->is_app_perpus == 0)?'do':'update';?>
        <form class="form-no-horizontal-spacing" id="formAppPerpus" method="POST" action="<?php echo site_url('form_exit/'.$action.'_approve/lv1/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval</label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->app_status_id_perpus) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_perpus<?php echo $app->id?>" type="radio" name="app_status_perpus" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_perpus<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status_perpus" type="radio" name="app_status_perpus" value="0">
                  <label for="app_status_perpus">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Perpustakaan) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_perpus" class="custom-txtarea-form" placeholder="Note Perpustakaan isi disini"><?php echo $row->note_perpus?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit" id="btn_app_perpus" class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end do Perpustakaan--> 

<!-- do approval exit Modal HRD -->
<div class="modal fade" id="submitexitModalHrd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Exit Clearence</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
      <?php $action = ($row->is_app_hrd == 0)?'do':'update';?>
        <form class="form-no-horizontal-spacing" id="formAppHrd" method="POST" action="<?php echo site_url('form_exit/'.$action.'_approve/lv1/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval</label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->app_status_id_hrd) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_hrd<?php echo $app->id?>" type="radio" name="app_status_hrd" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_hrd<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status_hrd" type="radio" name="app_status_hrd" value="0">
                  <label for="app_status_hrd">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (HRD) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_hrd" class="custom-txtarea-form" placeholder="Note HRD isi disini"><?php echo $row->note_hrd?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit" id="btn_app_hrd" class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>

<?php endforeach;?>

