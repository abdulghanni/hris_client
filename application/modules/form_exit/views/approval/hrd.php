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
              <h4>Form Permintaan <span class="semi-bold">SDM Baru</span></h4>
            </div>
            <div class="grid-body no-border">
              <form class="form-no-horizontal-spacing" id=""> 
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Unit Bisnis</label>
                      </div>
                      <div class="col-md-4">
                        <select id="unitbisnis" class="form-custom1 select2" disabled="disabled">
                          <option value="0">None</option>
                          <option value="1">Cab. Jakarta</option>
                          <option value="2">Cab. Bandung</option>
                          <option value="3">Cab. Surabaya</option>
                          <option value="4">Cab. Semarang</option>
                          <option value="5" selected="selected">Head Office</option>
                        </select>
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Departement</label>
                      </div>
                      <div class="col-md-4">
                        <select id="departement" class="form-custom1 select2" disabled="disabled">
                          <option value="0">None</option>
                          <option value="1" selected="selected">Departement 1</option>
                          <option value="2">Departement 2</option>
                          <option value="3">Departement 3</option>
                          <option value="4">Departement 4</option>
                          <option value="5">Departement 5</option>
                        </select>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Bagian</label>
                      </div>
                      <div class="col-md-4">
                        <select id="bagian" class="form-custom1 select2" disabled="disabled">
                          <option value="0">None</option>
                          <option value="1" selected="selected">Bagian 1</option>
                          <option value="2">Bagian 2</option>
                          <option value="3">Bagian 3</option>
                          <option value="4">Bagian 4</option>
                          <option value="5">Bagian 5</option>
                        </select>
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-4">
                        <select id="jabatan" class="form-custom1 select2" disabled="disabled">
                          <option value="0">None</option>
                          <option value="1" selected="selected">Jabatan 1</option>
                          <option value="2">Jabatan 2</option>
                          <option value="3">Jabatan 3</option>
                          <option value="4">Jabatan 4</option>
                          <option value="5">Jabatan 5</option>
                        </select>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jml yang dibutuhkan</label>
                      </div>
                      <div class="col-md-4">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Jml" value="1" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Status</label>
                      </div>
                      <div class="col-md-4">
                        <select id="jabatan" class="form-custom1 select2"  disabled="disabled">
                          <option value="0">Harian</option>
                          <option value="1">Kontrak</option>
                          <option value="2">OJT</option>
                          <option value="3" selected="selected">Tetap</option>
                        </select>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Urgensi (Kebutuhan)</label>
                      </div>
                      <div class="col-md-10">
                        <select id="jabatan" class="form-custom1 select2"  disabled="disabled">
                          <option value="0"> < 15 hari</option>
                          <option value="1" selected="selected"> 15 - 30 hari</option>
                          <option value="2"> > 30 hari</option>
                        </select>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <h4><strong>Kualifikasi :</strong></h4>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jenis Kelamin</label>
                      </div>
                      <div class="col-md-1">
                        <div class="checkbox check-primary checkbox-circle" >
                          <input id="jnskelamin1" type="checkbox" value="1" checked="checked">
                          <label for="jnskelamin1">Pria</label>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="checkbox check-primary checkbox-circle" >
                          <input id="jnskelamin2" type="checkbox" value="2" >
                          <label for="jnskelamin2">Wanita</label>
                        </div>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Pendidikan</label>
                      </div>
                      <div class="col-md-1">
                        <div class="checkbox check-primary checkbox-circle" >
                          <input id="pendidikan1" type="checkbox" value="1" >
                          <label for="pendidikan1">SMA</label>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="checkbox check-primary checkbox-circle" >
                          <input id="pendidikan2" type="checkbox" value="2" checked="checked">
                          <label for="pendidikan2">D-3</label>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="checkbox check-primary checkbox-circle" >
                          <input id="pendidikan3" type="checkbox" value="3" checked="checked">
                          <label for="pendidikan3">S-1</label>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="checkbox check-primary checkbox-circle" >
                          <input id="pendidikan4" type="checkbox" value="4" >
                          <label for="pendidikan4">S-2</label>
                        </div>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jurusan</label>
                      </div>
                      <div class="col-md-2">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Jurusan" value="Teknik Informatika, Sistem Informasi" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">IPK</label>
                      </div>
                      <div class="col-md-2">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="IPK" value="min. 2,75" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Toefl</label>
                      </div>
                      <div class="col-md-2">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Toefl" value="210" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <h4><strong>Kemampuan Teknis :</strong></h4>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Komputer</label>
                      </div>
                      <div class="col-md-10">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Komputer" value="Office, Email, Web Programming" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Komunikasi</label>
                      </div>
                      <div class="col-md-10">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Komunikasi" value="-" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Grafika</label>
                      </div>
                      <div class="col-md-10">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Grafika" value="-" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Desain/Setting</label>
                      </div>
                      <div class="col-md-10">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Desain/Setting" value="Photoshop, Corel" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Brevet</label>
                      </div>
                      <div class="col-md-10">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="brevet" value="-" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Lain-lain</label>
                      </div>
                      <div class="col-md-10">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Lain-lain" value="-" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Portfolio</label>
                      </div>
                      <div class="col-md-10">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Portfolio" value="-" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Pengalaman</label>
                      </div>
                      <div class="col-md-2">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Bidang" value="Web programming" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">selama</label>
                      </div>
                      <div class="col-md-1">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="" value="1" disabled="disabled"> 
                      </div>
                      <div class="col-md-1">
                        <label class="form-label text-right">Tahun</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Job Desc</label>
                      </div>
                      <div class="col-md-10">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="10" disabled="disabled">
                          Dapat membuat aplikasi dengan bahasa PHP framework CI / Laravel / Yii, dapat melakukan slicing psd to html
                        </textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="col-md-12 text-center">
                      <div class="row wf-cuti">
                        <div class="col-md-4">
                          Diusulkan oleh,<br/><br/>
                          <p class="wf-approve-sp">
                            <span class="semi-bold">Mauro Icardi</span><br/>
                            <span class="small">02 Januari 2015</span><br/>
                          </p>
                        </div>
                        <div class="col-md-4">
                          Persetujuan atasan,<br/><br/>
                          <p class="wf-approve-sp">
                            <span class="semi-bold">Andrea Ranochia</span><br/>
                            <span class="small">02 Januari 2015</span>
                          </p>
                        </div>
                        <div class="col-md-4">
                          Mengetahui HRD,<br/><br/>
                          <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i>Approve</button>
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