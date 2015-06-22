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
                  <h4>Daftar Keterangan Tidak <span class="semi-bold">Absen</span></h4>
                  <div class="tools"> 
                    <a href="<?php echo site_url('form_absen/input')?>" class="config"></a>
                  </div>
                </div>
                  <div class="grid-body no-border">
                    <table class="table table-striped table-flip-scroll cf">
                        <thead>
                          <tr>
                            <th width="10%">Tanggal</th>
                            <th width="20%">Nama</th>
                            <th width="20%">Keterangan</th>
                            <th width="10%" style="text-align:center;">appr. spv</th>
                            <th width="10%" style="text-align:center;">appr. ka. bag</th>
                            <th width="10%" style="text-align:center;">appr. Atasan Lainnya</th>
                            <th width="10%" style="text-align:center;">appr. HRD</th>
                            <th width="10%" class="text-center">cetak</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          if($_num_rows > 0){
                          foreach($form_absen as $absen):
                          $txt_app_lv1 = $txt_app_lv2 = $txt_app_lv3 = $txt_app_hrd = "<i class='icon-minus' title = 'Pending'></i>";
                          $approval_status_lv1 = "<i class='icon-ok-sign' title = 'Approved'></i>";
                          $approval_status_lv2 = "<i class='icon-ok-sign' title = 'Approved'></i>";
                          $approval_status_lv3 = "<i class='icon-ok-sign' title = 'Approved'></i>";
                          $approval_status_hrd = "<i class='icon-ok-sign' title = 'Approved'></i>";

                        //Approval Level 1
                          if(empty($absen->user_app_lv1)){
                             $txt_app_lv1 = "<i class='icon-circle' title = 'Tidak Butuh Approval'></i>";
                            }elseif(!empty($absen->user_app_lv1 && $absen->is_app_lv1 == 1)){
                              $txt_app_lv1 = "<a href='".site_url('form_absen/detail/'.$absen->id)."''>$approval_status_lv2</a>";
                            }elseif(!empty($absen->user_app_lv1) && $absen->is_app_lv1 == 0 && $sess_nik == $absen->user_app_lv1){
                              $txt_app_lv1 = "<a href='".site_url('form_absen/detail/'.$absen->id)."''>
                                              <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                              </a>";
                            }
                          

                          //ApprovalLevel 2
                          
                          if(empty($absen->user_app_lv2)){
                             $txt_app_lv2 = "<i class='icon-circle' title = 'Tidak Butuh Approval'></i>";
                            }elseif(!empty($absen->user_app_lv2 && $absen->is_app_lv2 == 1)){
                              $txt_app_lv2 = "<a href='".site_url('form_absen/detail/'.$absen->id)."''>$approval_status_lv2</a>";
                            }elseif(!empty($absen->user_app_lv2) && $absen->is_app_lv2 == 0 && $sess_nik == $absen->user_app_lv2){
                              $txt_app_lv2 = "<a href='".site_url('form_absen/detail/'.$absen->id)."''>
                                              <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                              </a>";
                            }

                          //Approval Level 3

                          if(!empty($absen->user_app_lv3) && $absen->is_app_lv3 == 0 && $sess_nik == $absen->user_app_lv3){
                              $txt_app_lv3 = "<a href='".site_url('form_absen/detail/'.$absen->id)."''>
                                              <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                              </a>";
                            }elseif(!empty($absen->user_app_lv3) && $absen->is_app_lv3 == 1){
                              $txt_app_lv3 = "<a href='".site_url('form_absen/detail/'.$absen->id)."''>$approval_status_lv3</a>";
                            }else{
                            $txt_app_lv3 = "<i class='icon-circle' title = 'Tidak Butuh Approval'></i>";
                          }

                          //Approval HRD
                            if(is_admin()&&$absen->is_app_hrd == 0){
                              $txt_app_hrd = "<a href='".site_url('form_absen/detail/'.$absen->id)."''>
                                              <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                              </a>";
                            }elseif($absen->is_app_hrd == 1){
                              $txt_app_hrd =  "<a href='".site_url('form_absen/detail/'.$absen->id)."''>$approval_status_hrd</a>";
                            }

                          ?>
                            <tr>
                              <td>
                                <a href="<?php echo site_url('form_absen/detail/'.$absen->id)?>"><?php echo dateIndo($absen->date_tidak_hadir)?>
                                </a>
                              </td>
                              <td><?php echo get_name($absen->user_id)?></td>
                              <td><?php echo $absen->keterangan_absen;?> </td>
                              <td style="text-align:center;">
                                <?php echo $txt_app_lv1;?>
                              </td>
                              <td style="text-align:center;">
                                <?php echo $txt_app_lv2;?>
                              </td>
                              <td style="text-align:center;">
                                <?php echo $txt_app_lv3;?>
                              </td>
                              <td style="text-align:center;">
                                <?php echo $txt_app_hrd;?>
                              </td>
                              <td class="text-center">
                                <a href="<?php echo site_url('form_absen/form_absen_pdf/'.$absen->id)?>"><i class="icon-print" title="Print"></i></a>
                              </td>
                            </tr>
                            <?php endforeach;} ?>
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
                                echo '&nbsp;'.lang('found_subheading').'&nbsp;'.$num_rows_all.'&nbsp;'.'Keterangan';
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