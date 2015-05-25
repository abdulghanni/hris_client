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
                  <h4>Daftar Rekomendasi <span class="semi-bold">Karyawan Keluar</span></h4>
                  <div class="tools"> 
                    <a href="<?php echo site_url('form_exit/input')?>" class="config"></a>
                  </div>
                </div>
                  <div class="grid-body no-border">
                        
                          <table class="table table-striped table-flip-scroll cf">
                              <thead>
                                <tr>
                                  <th width="10%">NIK</th>
                                  <th width="30%">Nama</th>
                                  <th width="12%" class="text-center">Approval Mgr GA Nasional</th>
                                  <th width="12%" class="text-center">Approval Koperasi</th>
                                  <th width="12%" class="text-center">Approval Perpustakaan</th>
                                  <th width="12%" class="text-center">Approval HRD</th>
                                  <th width="12%" class="text-center">Approval ASM/Mgr/Kacab/BDM/CoE</th>
                                  <th width="10%" class="text-center">Cetak</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php if($form_exit->num_rows()>0){
                                      foreach($form_exit->result() as $row):?>
                                  
                                  <tr>
                                    <td>
                                      <a href="<?php echo site_url('form_exit/detail/'.$row->id)?>"><?php echo get_nik($row->user_id)?></a>
                                    </td>
                                    <td>
                                      <?php echo get_name($row->user_id)?>
                                    </td>
                                    <td class="text-center">
                                      <?php
                                      $sess_id = $this->session->userdata('user_id');  
                                      $mgr_id = (!empty($mgr_ga_nas)) ? $mgr_ga_nas : 'D0001';
                                        if($row->is_app_mgr == 1){
                                          echo 'Approved';
                                        }elseif($row->is_app_mgr == 0 && get_nik($sess_id) == $mgr_id){
                                          echo "<a href='".site_url('form_exit/approval/'.$row->id)."''>
                                                  <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-paste'></i></button>
                                                </a>";
                                        }else{
                                          echo '-';
                                        }
                                      ?>
                                    </td>
                                    <td class="text-center">
                                      <?php
                                        if($row->is_app_koperasi == 1){
                                          echo 'Approved';
                                        }elseif($row->is_app_koperasi == 0 && get_nik($sess_id) == $koperasi){
                                          echo "<a href='".site_url('form_exit/approval/'.$row->id)."''>
                                                  <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-paste'></i></button>
                                                </a>";
                                        }else{
                                          echo '-';
                                        }
                                      ?>
                                    </td>
                                    <td class="text-center">
                                      <?php
                                        if($row->is_app_perpus == 1){
                                          echo 'Approved';
                                        }elseif($row->is_app_perpus == 0 && get_nik($sess_id) == $perpustakaan){
                                          echo "<a href='".site_url('form_exit/approval/'.$row->id)."''>
                                                  <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-paste'></i></button>
                                                </a>";
                                        }else{
                                          echo '-';
                                        }
                                      ?>
                                    </td>
                                    <td class="text-center">
                                      <?php
                                        if($row->is_app_hrd == 1){
                                          echo 'Approved';
                                        }elseif($row->is_app_hrd == 0 && get_nik($sess_id) == $hrd){
                                          echo "<a href='".site_url('form_exit/approval/'.$row->id)."''>
                                                  <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-paste'></i></button>
                                                </a>";
                                        }else{
                                          echo '-';
                                        }
                                      ?>
                                    </td>
                                    <td class="text-center">
                                      <?php
                                        if($row->is_app == 1){
                                          echo 'Approved';
                                        }elseif($row->is_app == 0 && is_admin()){
                                          echo "<a href='".site_url('form_exit/approval/'.$row->id)."''>
                                                  <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-paste'></i></button>
                                                </a>";
                                        }else{
                                          echo '-';
                                        }
                                      ?>
                                    </td>
                                    <td>
                                      <a href="<?php echo site_url('form_exit/form_exit_pdf/'.$row->id)?>"><i class="icon-print"></i></a>
                                    </td>
                                  </tr>
                                  <?php endforeach;}?>
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