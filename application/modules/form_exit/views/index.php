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
                  <?php if(is_have_subordinate($sess_id)||is_admin()){?>
                  <div class="tools"> 
                    <a href="<?php echo site_url('form_exit/input') ?>" class="config"></a>
                  </div>
                  <?php } ?>
                </div>
                  <div class="grid-body no-border">
                           <br/>   
                            <?php echo form_open(site_url('form_exit/keywords'))?>
                              <div class="row">
                                  <div class="col-md-5">
                                      <div class="row">
                                          <div class="col-md-4 search_label"><?php echo form_label('Nama Pengaju','first_name')?></div>
                                          <div class="col-md-8"><?php echo bs_form_input($ftitle_search)?></div>
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <button type="submit" class="btn btn-info"><i class="icon-search"></i>&nbsp;<?php echo lang('search_button')?></button>
                                          </div>
                                      </div>
                                  </div>    
                              </div>
                          <?php echo form_close()?>     
                          <table class="table table-striped table-flip-scroll cf">
                              <thead>
                                <tr>
                                  <th width="1%">NIK</th>
                                  <th width="10%">Nama</th>
                                  <th width="10%">Tanggal Keluar</th>
                                  <th width="2%" class="text-center">Approval Mgr GA Nasional</th>
                                  <th width="2%" class="text-center">Approval Koperasi</th>
                                  <th width="2%" class="text-center">Approval Perpustakaan</th>
                                  <th width="2%" class="text-center">Approval HRD</th>
                                  <th width="2%" class="text-center">Approval IT</th>
                                  <th width="2%" class="text-center">Approval Keuangan</th>
                                  <th width="2%" class="text-center">Approval Asset Mgr</th>
                                  <th width="2%" class="text-center">appr. spv</th>
                                  <th width="2%" class="text-center">appr. ka.bag</th>
                                  <th width="2%" class="text-center">appr. Atasan Lainnya</th>
                                  <th width="2%" class="text-center">Cetak</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php if($_num_rows>0){
                                      foreach($form_exit as $row):
                                      $txt_app_lv1 = $txt_app_lv2 = $txt_app_lv3 = $txt_app_asset =  $txt_app_hrd = $txt_app_mgr = $txt_app_koperasi = $txt_app_perpus = $txt_app_it = $txt_app_keuangan = "<i class='icon-minus' title = 'Pending'></i>";
                                      $approval_status = ($row->app_status_id== 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($row->app_status_id== 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                      $approval_status_mgr = ($row->app_status_id_mgr== 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($row->app_status_id_mgr== 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                      $approval_status_koperasi = ($row->app_status_id_koperasi== 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($row->app_status_id_koperasi== 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                      $approval_status_perpus = ($row->app_status_id_perpus== 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($row->app_status_id_perpus== 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                      $approval_status_hrd = ($row->app_status_id_hrd== 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($row->app_status_id_hrd== 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                      $approval_status_it = ($row->app_status_id_it== 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($row->app_status_id_it== 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                      $approval_status_keuangan = ($row->app_status_id_keuangan== 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($row->app_status_id_keuangan== 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                      
                                      $approval_status_lv1 = ($row->app_status_id_lv1 == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($row->app_status_id_lv1 == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                      $approval_status_lv2 = ($row->app_status_id_lv2 == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($row->app_status_id_lv2 == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                      $approval_status_lv3 = ($row->app_status_id_lv3 == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($row->app_status_id_lv3 == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                      $approval_status_asset = ($row->app_status_id_asset == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($row->app_status_id_asset == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                  
                                   //Approval Level 1
                                    if(!empty($row->user_app_lv1) && $row->is_app_lv1 == 0 && $sess_nik == $row->user_app_lv1){
                                        $txt_app_lv1 = "<a href='".site_url('form_exit/detail/'.$row->id)."''>
                                                        <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                        </a>";
                                      }elseif(!empty($row->user_app_lv1)){
                                        $txt_app_lv1 = "<a href='".site_url('form_exit/detail/'.$row->id)."''>$approval_status_lv1</a>";
                                      }else{
                                      $txt_app_lv1 = "<i class='icon-circle' title = 'Tidak Butuh Approval'></i>";
                                    }
                                    

                                    //ApprovalLevel 2
                                    
                                    if(!empty($row->user_app_lv2) && $row->is_app_lv2 == 0 && $sess_nik == $row->user_app_lv2){
                                        $txt_app_lv2 = "<a href='".site_url('form_exit/detail/'.$row->id)."''>
                                                        <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                        </a>";
                                      }elseif(!empty($row->user_app_lv2)){
                                        $txt_app_lv2 = "<a href='".site_url('form_exit/detail/'.$row->id)."''>$approval_status_lv2</a>";
                                      }else{
                                      $txt_app_lv2 = "<i class='icon-circle' title = 'Tidak Butuh Approval'></i>";
                                    }

                                    //Approval Level 3

                                    if(!empty($row->user_app_lv3) && $row->is_app_lv3 == 0 && $sess_nik == $row->user_app_lv3){
                                        $txt_app_lv3 = "<a href='".site_url('form_exit/detail/'.$row->id)."''>
                                                        <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                        </a>";
                                      }elseif(!empty($row->user_app_lv3)){
                                        $txt_app_lv3 = "<a href='".site_url('form_exit/detail/'.$row->id)."''>$approval_status_lv3</a>";
                                      }else{
                                      $txt_app_lv3 = "<i class='icon-circle' title = 'Tidak Butuh Approval'></i>";
                                    }

                                    if(!empty($row->user_app_asset) && $row->is_app_asset == 0 && $sess_nik == $row->user_app_asset){
                                        $txt_app_asset = "<a href='".site_url('form_exit/detail/'.$row->id)."''>
                                                        <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                        </a>";
                                      }elseif(!empty($row->user_app_asset)){
                                        $txt_app_asset = "<a href='".site_url('form_exit/detail/'.$row->id)."''>$approval_status_asset</a>";
                                      }else{
                                      $txt_app_asset = "<i class='icon-circle' title = 'Tidak Butuh Approval'></i>";
                                    }

                                     //Approval HRD
                                    if(is_admin_hrd()&&$row->is_app_hrd == 0){
                                      $txt_app_hrd = "<a href='".site_url('form_exit/detail/'.$row->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif($row->is_app_hrd == 1){
                                      $txt_app_hrd =  "<a href='".site_url('form_exit/detail/'.$row->id)."''>$approval_status_hrd</a>";
                                    }

                                    //Approval mgr
                                    if(is_admin_logistik()&&$row->is_app_mgr == 0){
                                      $txt_app_mgr = "<a href='".site_url('form_exit/detail/'.$row->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif($row->is_app_mgr == 1){
                                      $txt_app_mgr =  "<a href='".site_url('form_exit/detail/'.$row->id)."''>$approval_status_mgr</a>";
                                    }

                                    //Approval it
                                    if(is_admin_it()&&$row->is_app_it == 0){
                                      $txt_app_it = "<a href='".site_url('form_exit/detail/'.$row->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif($row->is_app_it == 1){
                                      $txt_app_it =  "<a href='".site_url('form_exit/detail/'.$row->id)."''>$approval_status_it</a>";
                                    }

                                    //Approval koperasi
                                    if(is_admin_koperasi()&&$row->is_app_koperasi == 0){
                                      $txt_app_koperasi = "<a href='".site_url('form_exit/detail/'.$row->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif($row->is_app_koperasi == 1){
                                      $txt_app_koperasi =  "<a href='".site_url('form_exit/detail/'.$row->id)."''>$approval_status_koperasi</a>";
                                    }

                                    //Approval perpus
                                    if(is_admin_perpus()&&$row->is_app_perpus == 0){
                                      $txt_app_perpus = "<a href='".site_url('form_exit/detail/'.$row->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif($row->is_app_perpus == 1){
                                      $txt_app_perpus =  "<a href='".site_url('form_exit/detail/'.$row->id)."''>$approval_status_perpus</a>";
                                    }

                                    //Approval keuangan
                                    if(is_admin_keuangan()&&$row->is_app_keuangan == 0){
                                      $txt_app_keuangan = "<a href='".site_url('form_exit/detail/'.$row->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif($row->is_app_keuangan == 1){
                                      $txt_app_keuangan =  "<a href='".site_url('form_exit/detail/'.$row->id)."''>$approval_status_keuangan</a>";
                                    }
                                  ?>

                                  <tr>
                                    <td>
                                      <a href="<?php echo site_url('form_exit/detail/'.$row->id)?>"><?php echo get_nik($row->user_id)?></a>
                                    </td>
                                    <td>
                                      <a href="<?php echo site_url('form_exit/detail/'.$row->id)?>"><?php echo get_name($row->user_id)?></a>
                                    </td>
                                    <td>
                                      <?php echo dateIndo($row->date_exit)?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $txt_app_mgr; ?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $txt_app_koperasi; ?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $txt_app_perpus; ?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $txt_app_hrd; ?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $txt_app_it; ?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $txt_app_keuangan; ?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $txt_app_asset; ?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $txt_app_lv1;?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $txt_app_lv2; ?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $txt_app_lv3; ?>
                                    </td>
                                    <td class="text-center">
                                      <a href="<?php echo site_url('form_exit/form_exit_pdf/'.$row->id)?>" target="_blank"><i class="icon-print"></i></a>
                                    </td>
                                  </tr>
                                  <?php endforeach;}?>
                              </tbody>
                          </table>

                          <?php if($_num_rows>0):?>
                          <div class="row">
                            <div class="col-md-4 page_limit">
                                <?php echo form_open(uri_string());?>
                                <?php 
                                    $selectComponentData = array(
                                        10  => '10',
                                        25 => '25',
                                        50 =>'50',
                                        75 => '75',
                                        100 => '100',);
                                    $selectComponentJs = 'class="select2" onChange="this.form.submit()" id="limit"';
                                    echo "Per page: ".form_dropdown('limit', $selectComponentData, $limit, $selectComponentJs);
                                    echo '&nbsp;'.lang('found_subheading').'&nbsp;'.$num_rows_all.'&nbsp;'.'Pengajuan';
                                ?>
                                <?php echo form_close();?>
                            </div>

                            <div class="col-md-10">
                              <ul class="dataTables_paginate paging_bootstrap pagination">
                                  <?php echo $halaman;?>
                              </ul>
                            </div>
                          </div>
                        <?php endif; ?>
                
                  </div>
              </div>
          </div>
        </div>
      </div>
              
    
      </div>
    
  </div>  
  <!-- END PAGE --> 