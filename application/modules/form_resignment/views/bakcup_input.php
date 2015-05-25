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
              <h4>Form Karyawan <span class="semi-bold">Keluar</span></h4>
            </div>
            <div class="grid-body no-border">
              <form class="form-no-horizontal-spacing" id=""> 
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-4">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="Mauro Icardi" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Tanggal Akhir Kerja</label>
                      </div>
                      <div class="col-md-4">
                        <div class="input-append success date">
                          <input type="text" class="form-control" id="sandbox-advance">
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span>
                        </div>    
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-4">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Jabatan" value="IT Support" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Wilayah</label>
                      </div>
                      <div class="col-md-4">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Wilayah" value="" >
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Alasan Berhenti Bekerja</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <div class="radio">
                            <input id="perusahaan_lain" type="radio" name="alasan_resign" value="1">
                            <label for="perusahaan_lain">Diterima di perusahaan lain</label>
                            <input id="kuliah" type="radio" name="alasan_resign" value="2">
                            <label for="kuliah">Kuliah lagi</label>
                            <input id="lingkungan_kerja" type="radio" name="alasan_resign" value="3">
                            <label for="lingkungan_kerja">Lingkungan kerja tidak nyaman</label>
                            <input id="kesehatan" type="radio" name="alasan_resign" value="4">
                            <label for="kesehatan">Kesehatan tidak mendukung</label>
                            <input id="pendapatan" type="radio" name="alasan_resign" value="5">
                            <label for="pendapatan">pendapatan tidak sesuai harapan</label>
                            <input id="lainnya" type="radio" name="alasan_resign" value="6">
                            <label for="lainnya">Lainnya</label>
                          </div>
                        </div>
                      </div>
                    </div>

                      
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Apa alasan utama berhenti bekerja dari perusahaan ini? Jelaskan</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="desc_resign"></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Adakah prosedur perusahaan yang membuat anda tidak nyaman atau tidak bisa maksimum menjalankan tugasnya?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="procedure_resign"></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Adakah hal yang memuaskan dari pekerjaan anda sekarang?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="kepuasan_resign"></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Adakah saran untuk kami?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="saran_resign"></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Apakah anda mempertimbangkan di masa datang untuk kembali bekerja di perusahaan ini? ?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="rework_resign"></textarea>
                      </div>
                    </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                    <a href="form_absent.html"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
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