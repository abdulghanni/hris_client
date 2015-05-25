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
                <h4>Form Rekomendasi <span class="semi-bold">Karyawan Keluar</span></h4>
              </div>
              <div class="grid-body no-border">
                 <?php echo form_open("form_exit/add",array("id"=>"formaddexit"));?>
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-3">
                        <?php if(is_admin()){?>
                          <select id="emp" class="select2" style="width:100%" name="emp">
                          <?php
                          foreach ($all_users->result() as $u) :
                            $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                            <option value="<?php echo $u->id?>" <?php echo $selected?>><?php echo $u->username; ?></option>
                          <?php endforeach; ?>
                        </select>
                        <?php }else{?>
                            <?php if($subordinate->num_rows() > 0){?>
                            <select id="emp" class="" style="width:100%" name="emp">
                                <?php foreach($subordinate->result() as $row):?>
                            <option value="<?php echo $row->id?>"><?php echo get_name($row->id) ?></option>
                            <?php endforeach;?>
                        </select>
                            <?php }else{ ?>
                            <select>
                            <option value="0">-- Anda tidak mempunyai bawahan --</option>
                            </select>
                        <?php }}?>
                      </div>

                      <div class="col-md-2">
                        <label class="form-label text-right">Wilayah</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="" disabled="disabled">
                      </div>

                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">NIK</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="nik" type="text"  class="form-control" placeholder="NIK" value="" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="Dept/Bagian" value="" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="position" type="text"  class="form-control" placeholder="Jabatan" value="" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Tanggal Keluar</label>
                      </div>
                      <div class="col-md-3">
                        <div class="input-append success date">
                          <input type="text" class="form-control" id="sandbox-advance" name="date_exit" required>
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span>
                        </div>    
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
                                <label class="radio-inline">
                                  <input type="radio" name="seragam" id="seragam11" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="seragam" id="seragam2" value="0">Tidak
                                </label>
                              </td>
                              <td><input name="keterangan_seragam" id="form3LastName" type="text"  class="form-control" placeholder="" value=""></td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>ID Card</td>
                              <td>
                                <label class="radio-inline">
                                    <input type="radio" name="id_card" id="id_card1" required value="1"> Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="id_card" id="id_card2" value="0"> Tidak
                                </label>
                              </td>
                              <td><input name="keterangan_id_card" id="form3LastName" type="text"  class="form-control" placeholder="" value=""></td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>Sepeda motor / mobil</td>
                              <td>
                                <label class="radio-inline">
                                  <input type="radio" name="kendaraan" id="kendaraan1" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="kendaraan" id="kendaraan2" value="0">Tidak
                                </label>
                              </td>
                              <td><input name="keterangan_kendaraan" id="form3LastName" type="text"  class="form-control" placeholder="" value=""></td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td>STNK motor / mobil</td>
                              <td>
                                <label class="radio-inline">
                                  <input type="radio" name="stnk" id="stnk1" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="stnk" id="stnk2" value="0">Tidak
                                </label>
                              </td>
                              <td><input name="keterangan_stnk" id="form3LastName" type="text"  class="form-control" placeholder="" value=""></td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td>HP/Laptop/Ipad</td>
                              <td>
                                <label class="radio-inline">
                                  <input type="radio" name="gadget" id="gadget1" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="gadget" id="gadget2" value="0">Tidak
                                </label>
                              </td>
                              <td><input name="keterangan_gadget" id="keterangan" type="text"  class="form-control" placeholder="" value=""></td>
                            </tr>
                            <tr>
                              <td>6</td>
                              <td>Laporan serah terima</td>
                              <td>
                                <label class="radio-inline">
                                  <input type="radio" name="laporan" id="laporan1" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="laporan" id="laporan2" value="0">Tidak
                                </label>
                              </td>
                              <td><input name="keterangan_laporan" id="form3LastName" type="text"  class="form-control" placeholder="" value=""></td>
                            </tr>
                            <tr>
                              <td>7</td>
                              <td>Rekonsiliasi Saldo</td>
                              <td>
                                <label class="radio-inline">
                                  <input type="radio" name="saldo" id="saldo1" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="saldo" id="saldo2" value="0">Tidak
                                </label>
                              </td>
                              <td><input name="keterangan_saldo" id="form3LastName" type="text"  class="form-control" placeholder="" value=""></td>
                            </tr>
                            <tr>
                              <td>8</td>
                              <td>Pinjaman Koperasi</td>
                              <td>
                                <label class="radio-inline">
                                  <input type="radio" name="koperasi" id="koperasi1" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="koperasi" id="koperasi2" value="0">Tidak
                                </label>
                              </td>
                              <td><input name="keterangan_koperasi" id="form3LastName" type="text"  class="form-control" placeholder="" value=""></td>
                            </tr>
                            <tr>
                              <td>9</td>
                              <td>Pinjaman buku perpustakaan</td>
                              <td>
                                <label class="radio-inline">
                                  <input type="radio" name="buku" id="buku1" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="buku" id="buku2" value="0">Tidak
                                </label>
                              </td>
                              <td><input name="keterangan_buku" id="form3LastName" type="text"  class="form-control" placeholder="" value=""></td>
                            </tr>
                            <tr>
                              <td>10</td>
                              <td>Ikatan dinas</td>
                              <td>
                                <label class="radio-inline">
                                  <input type="radio" name="ikatan" id="ikatan1" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="ikatan" id="ikatan2" value="0">Tidak
                                </label>
                              </td>
                              <td><input name="keterangan_ikatan" id="form3LastName" type="text"  class="form-control" placeholder="" value=""></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                        <div class="row form-row">
                          <div class="col-md-12">
                            <h4>Kami rekomendasikan kep1 karyawan tersebut</h4>
                          </div>
                        </div>
                        <div class="row form-row">
                        <div class="col-md-12">
                          <table class="table no-more-tables">
                            <tr>
                              <td>1</td>
                              <td>Diberikan Uang Pesangon</td>
                              <td>
                                <label class="radio-inline">
                                  <input type="radio" name="pesangon" id="pesangon1" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="pesangon" id="pesangon2" value="0">Tidak
                                </label>
                              </td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>Diberikan uang pengganti hak</td>
                              <td>
                                <label class="radio-inline">
                                  <input type="radio" name="uang_ganti" id="uang_ganti1" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="uang_ganti" id="uang_ganti2" value="0">Tidak
                                </label>
                              </td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>Diberikan uang jasa</td>
                              <td>
                                <label class="radio-inline">
                                  <input type="radio" name="uang_jasa" id="uang_jasa1" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="uang_jasa" id="uang_jasa2" value="0">Tidak
                                </label>
                              </td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td>Diberikan surat keterangan kerja</td>
                              <td>
                                <label class="radio-inline">
                                  <input type="radio" name="skkerja" id="skkerja1" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="skkerja" id="skkerja2" value="0">Tidak
                                </label>
                              </td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td>Diberikan ijazah asli ybs</td>
                              <td>
                                <label class="radio-inline">
                                  <input type="radio" name="ijazah" id="ijazah1" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="ijazah" id="ijazah2" value="0">Tidak
                                </label>
                              </td>
                            </tr>
                          </table>
                        </div>

                        
                      
                  </div>
                  <?php if($subordinate->num_rows() > 0 || is_admin()){?>
                  <div class="form-actions">
                    <div class="pull-right">
                      <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                      <a href="<?php echo site_url('form_exit')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
                    </div>
                  </div>
                  <?php }?>
                </form>
              </div>
          </div>
        </div>
      </div>
              
    
      </div>
    
  </div>  
  <!-- END PAGE --> 