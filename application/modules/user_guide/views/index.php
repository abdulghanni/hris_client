
<div class="col-md-12">
        <div class="grid simple">
    
            <div class="grid-title">
              <a href="<?= base_url()?>"><h4><i class="icon-home"></i> Kembali Ke Halaman Depan</h4></a>
              <h3>Panduan Penggunaan Web HRIS Erlangga</h3>
            </div>
            <div class="grid-body no-border"> 
                
    <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-pills" id="tab-4">
            <li class="active"><a href="#tab4user">Sebagai User</a></li>
            
            <?php if(is_spv($nik)||is_admin()): ?><li><a href="#tab4atasan">Sebagai Atasan</a></li><?php endif;?>
                
            <?php if(is_admin_bagian()||is_admin()):?><li><a href="#tab4admdept">Sebagai Admin Departement</a></li><?php endif;?>
            <?php if(is_admin_inventaris()||is_admin()):?><li><a href="#tab4adminv">Sebagai Admin Inventaris</a></li><?php endif;?>
            <?php if(is_admin()):?><li><a href="#tab4admin">Sebagai Super Admin</a></li><?php endif;?>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab4user">
              <div class="row column-seperation">
                <div class="col-md-4">
                  <div class="cf nestable-lists">
                        <div class="dd" id="nestable">
                            <ol class="dd-list">
                                <li>
                                    <a href="<?= assets_url('user_guide/User-Guide-Web-HRIS(USER).docx')?>"><div class="dd-handle">Download Panduan Lengkap (User)</div></a>
                                </li>
                                <li class="dd-item" data-id="1">
                                    <div class="dd-handle" id="register">Cara Registrasi</div>
                                </li>
                                <li class="dd-item" data-id="2">
                                    <div class="dd-handle" id="lupa">Lupa Password</div>
                                </li>
                                <li class="dd-item" data-id="3">
                                    <div class="dd-handle" id="edit">Merubah Profile dan Password</div>
                                </li>
                                <li class="dd-item" data-id="4">
                                    <div class="dd-handle" id="absen">Keterangan Tidak Absen</div>
                                </li>
                                <li class="dd-item" data-id="8">
                                    <div class="dd-handle" id="tidak_masuk">Izin Tidak Masuk</div>
                                </li>
                                <li class="dd-item" data-id="5">
                                    <div class="dd-handle" id="cuti">Mengajukan Cuti</div>
                                </li>
                                <li class="dd-item" data-id="6">
                                    <div class="dd-handle" id="pjd">Melakukan Perjalanan Dinas</div>
                                </li>
                                <li class="dd-item" data-id="7">
                                    <div class="dd-handle" id="resign">Mengajukan Pengunduran Diri</div>
                                </li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <br>
                </div>
                <div class="col-md-8">
                  <div id="help"></div>
                </div>
              </div>
            </div>

            <!-- Sebagai Atasan -->
            <div class="tab-pane" id="tab4atasan">
              <div class="row column-seperation">
                <div class="col-md-4">
                  <div class="cf nestable-lists">
                        <div class="dd" id="nestable">
                            <ol class="dd-list">
                                <li>
                                    <a href="<?= assets_url('user_guide/User-Guide-Web-HRIS(ATASAN).docx')?>"><div class="dd-handle">Download Panduan Lengkap</div></a>
                                </li>
                                <li class="dd-item" data-id="1">
                                    <div class="dd-handle" id="recruit">Permintaan SDM Baru</div>
                                </li>
                                <li class="dd-item" data-id="2">
                                    <div class="dd-handle" id="promosi">Promosi, Demosi & Mutasi</div>
                                </li>
                                <li class="dd-item" data-id="3">
                                    <div class="dd-handle" id="pengangkatan">Pengangkatan</div>
                                </li>
                                <li class="dd-item" data-id="4">
                                    <div class="dd-handle" id="perpanjangan">Perpanjangan Kontrak</div>
                                </li>
                                <li class="dd-item" data-id="4">
                                    <div class="dd-handle" id="rekomendasi">Rekomendasi Karyawan Keluar</div>
                                </li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <br>
                </div>
                <div class="col-md-8">
                  <div id="help2"></div>
                </div>
              </div>
            </div>

            <!-- Sebagai HRD -->
            <div class="tab-pane " id="tab4hrd">
              <div class="row column-seperation">
                <div class="col-md-4">
                  <div class="cf nestable-lists">
                        <div class="dd" id="nestable">
                            <ol class="dd-list">
                                
                                <li class="dd-item" data-id="4">
                                    <div class="dd-handle">Cara Mengajukan Pengunduran Diri</div>
                                </li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <br>
                </div>
                <div class="col-md-8">
                  <div id="help8"></div>
                </div>
              </div>
            </div>

            <!-- Sebagai Admin Dept -->
            <div class="tab-pane " id="tab4admdept">
              <div class="row column-seperation">
                <div class="col-md-4">
                  <div class="cf nestable-lists">
                        <div class="dd" id="nestable">
                            <ol class="dd-list">
                                <li>
                                    <a href="<?= assets_url('user_guide/User-Guide-Web-HRIS(admin_dept).docx')?>"><div class="dd-handle">Download Panduan Lengkap</div></a>
                                </li>
                                <li class="dd-item" data-id="1">
                                    <div class="dd-handle" id="pjd_admin">Perjalanan Dinas</div>
                                </li>
                                <li class="dd-item" data-id="2">
                                    <div class="dd-handle" id="training_admin">Pelatihan Karyawan</div>
                                </li>
                                <li class="dd-item" data-id="3">
                                    <div class="dd-handle" id="medical">Kesehatan</div>
                                </li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <br>
                </div>
                <div class="col-md-8">
                  <div id="help3"></div>
                </div>
              </div>
            </div>

            <!-- Sebagai admin inv -->
            <div class="tab-pane " id="tab4adminv">
              <div class="row column-seperation">
                <div class="col-md-4">
                  <div class="cf nestable-lists">
                        <div class="dd" id="nestable">
                            <ol class="dd-list">
                                <li class="dd-item" data-id="1">
                                    <a href="<?= assets_url('user_guide/User-Guide-Web-HRIS(admin_inv).docx')?>"><div class="dd-handle">Download Panduan Lengkap</div></a>
                                </li>
                                <li class="dd-item" data-id="2">
                                    <div class="dd-handle" id="inv">Menambah & Mengubah Inventaris</div>
                                </li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <br>
                </div>
                <div class="col-md-8">
                  <div id="help5"></div>
                </div>
              </div>
            </div>

            <!-- Sebagai super admin -->
            <div class="tab-pane " id="tab4admin">
              <div class="row column-seperation">
                <div class="col-md-4">
                  <div class="cf nestable-lists">
                        <div class="dd" id="nestable">
                            <ol class="dd-list">
                                
                                <li>
                                    <a href="<?= assets_url('user_guide/User-Guide-Web-HRIS(Super Admin).docx')?>"><div class="dd-handle">Download Panduan (Super Admin)</div></a>
                                </li>
                                <li class="dd-item" data-id="1">
                                    <div class="dd-handle" id="depan">Halaman Depan</div>
                                </li>
                                <li class="dd-item" data-id="2">
                                    <div class="dd-handle" id="khusus">Pengaturan Admin Khusus</div>
                                </li>
                                <li class="dd-item" data-id="3">
                                    <div class="dd-handle" id="hrd">Pengaturan Approval HRD</div>
                                </li>
                                <li class="dd-item" data-id="4">
                                    <div class="dd-handle" id="atasan">Pengaturan Atasan Khusus</div>
                                </li>
                                <li class="dd-item" data-id="8">
                                    <div class="dd-handle" id="template">Pengaturan Form Template</div>
                                </li>
                                <li class="dd-item" data-id="5">
                                    <div class="dd-handle" id="group">Pengaturan Group</div>
                                </li>
                                <li class="dd-item" data-id="6">
                                    <div class="dd-handle" id="inventaris">Pengaturan Inventaris</div>
                                </li>
                                <li class="dd-item" data-id="7">
                                    <div class="dd-handle" id="pengumuman">Pengaturan Pengumuman</div>
                                </li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <br>
                </div>
                <div class="col-md-8">
                  <div id="help6"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
    </div>

            </div>
        </div>
    </div>