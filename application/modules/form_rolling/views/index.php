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
              <div class="grid simple ">
                <div class="grid-title no-border">
                  <h4>Daftar Pengajuan <span class="semi-bold">rolling</span></h4>
                  <div class="tools"> 
                    <a href="<?php echo site_url('form_rolling/input') ?>" class="config"></a>
                  </div>
                </div>
                  <div class="grid-body no-border">
                        
                          <table class="table table-striped table-flip-scroll cf">
                              <thead>
                                <tr>
                                  <th width="15%">Nama</th>
                                  <th width="15%">Jabatan Lama</th>
                                  <th width="15%">Tanggal Pengangkatan</th>
                                  <th width="15%">Jabatan Baru</th>
                                  <th width="15%">Tanggal Pengangkatan</th>
                                  <th width="10%">Approval</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                    <td><a href="<?php echo site_url('form_rolling/detail')?>">Wahyu Sucianto</a></td>
                                    <td>Staff HRD</td>
                                    <td>19-04-2010</td>
                                    <td>Manajer HRD</td>
                                    <td>05-05-2015</td>
                                    <td><a href="<?php echo site_url('form_rolling/approval_hrd')?>">Ya</td>
                                  </tr> 
                              </tbody>
                          </table>
                  </div>
              </div>
          </div>
        </div>
      </div>
              
    
      </div>
    
  </div>  
  <!-- END PAGE --> 