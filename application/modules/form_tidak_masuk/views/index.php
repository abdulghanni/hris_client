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
                  <h4>Daftar Izin Tidak <span class="semi-bold">Masuk</span></h4>
                  <div class="tools"> 
                    <a href="<?php echo site_url('form_tidak_masuk/input')?>" class="config"><button type="button" class="btn btn-primary btn-sm"><i class="icon-plus"></i>&nbsp;<?php echo lang('add_button');?></button></a>
                  </div>
                </div>
                  <div class="grid-body no-border">
                  <br/>   
                    <?php echo form_open(site_url('form_tidak_masuk/keywords'))?>
                      <div class="row">
                          <div class="col-md-5">
                              <div class="row">
                                  <div class="col-md-4 search_label"><?php echo form_label('Nama','first_name')?></div>
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
                            <th width="20%">No.</th>
                            <th width="15%">Tanggal</th>
                            <th width="15%">Nama</th>
                            <th width="15%">Alasan</th>
                            <th width="10%" class="text-center">appr. spv</th>
                            <th width="10%" class="text-center">appr. atasan tidak langsung</th>
                            <th width="10%" class="text-center">appr. Atasan Lainnya</th>
                            <th width="10%" class="text-center">appr. HRD</th>
                            <th width="10%" class="text-center">cetak</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          if($_num_rows > 0){
                          foreach($form_tidak_masuk as $tidak_masuk):
                          $txt_app_lv1 = $txt_app_lv2 = $txt_app_lv3 = $txt_app_hrd = "<i class='icon-question' title = 'Pending'></i>";
                          $approval_status_lv1 = "<i class='icon-ok-sign' title = 'Approved'></i>";
                          $approval_status_lv2 = "<i class='icon-ok-sign' title = 'Approved'></i>";
                          $approval_status_lv3 = "<i class='icon-ok-sign' title = 'Approved'></i>";
                          $approval_status_hrd = "<i class='icon-ok-sign' title = 'Approved'></i>";

                        //Approval Level 1
                          if(empty($tidak_masuk->user_app_lv1)){
                             $txt_app_lv1 = "<i class='icon-minus' title = 'Tidak Butuh Approval'></i>";
                            }elseif(!empty($tidak_masuk->user_app_lv1 && $tidak_masuk->is_app_lv1 == 1)){
                              $txt_app_lv1 = "<a href='".site_url('form_tidak_masuk/detail/'.$tidak_masuk->id)."''>$approval_status_lv2</a>";
                            }elseif(!empty($tidak_masuk->user_app_lv1) && $tidak_masuk->is_app_lv1 == 0 && $sess_nik == $tidak_masuk->user_app_lv1){
                              $txt_app_lv1 = "<a href='".site_url('form_tidak_masuk/detail/'.$tidak_masuk->id)."''>
                                              <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                              </a>";
                            }
                          

                          //ApprovalLevel 2
                          
                          if(empty($tidak_masuk->user_app_lv2)){
                             $txt_app_lv2 = "<i class='icon-minus' title = 'Tidak Butuh Approval'></i>";
                            }elseif(!empty($tidak_masuk->user_app_lv2 && $tidak_masuk->is_app_lv2 == 1)){
                              $txt_app_lv2 = "<a href='".site_url('form_tidak_masuk/detail/'.$tidak_masuk->id)."''>$approval_status_lv2</a>";
                            }elseif(!empty($tidak_masuk->user_app_lv2) && $tidak_masuk->is_app_lv2 == 0 && $sess_nik == $tidak_masuk->user_app_lv2){
                              $txt_app_lv2 = "<a href='".site_url('form_tidak_masuk/detail/'.$tidak_masuk->id)."''>
                                              <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                              </a>";
                            }

                          //Approval Level 3

                          if(empty($tidak_masuk->user_app_lv3)){
                             $txt_app_lv3 = "<i class='icon-minus' title = 'Tidak Butuh Approval'></i>";
                            }elseif(!empty($tidak_masuk->user_app_lv3 && $tidak_masuk->is_app_lv3 == 1)){
                              $txt_app_lv3 = "<a href='".site_url('form_tidak_masuk/detail/'.$tidak_masuk->id)."''>$approval_status_lv3</a>";
                            }elseif(!empty($tidak_masuk->user_app_lv3) && $tidak_masuk->is_app_lv3 == 0 && $sess_nik == $tidak_masuk->user_app_lv3){
                              $txt_app_lv3 = "<a href='".site_url('form_tidak_masuk/detail/'.$tidak_masuk->id)."''>
                                              <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                              </a>";
                            }

                          //Approval HRD
                            if($this->approval->approver('tidak_masuk') == $sess_nik && $tidak_masuk->is_app_hrd == 0){
                              $txt_app_hrd = "<a href='".site_url('form_tidak_masuk/detail/'.$tidak_masuk->id)."''>
                                              <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                              </a>";
                            }elseif($tidak_masuk->is_app_hrd == 1){
                              $txt_app_hrd =  "<a href='".site_url('form_tidak_masuk/detail/'.$tidak_masuk->id)."''>$approval_status_hrd</a>";
                            }

                          ?>
                            <tr>
                              <td>
                                <a href="<?php echo site_url('form_tidak_masuk/detail/'.$tidak_masuk->id)?>">
                                  <?php 
                                  echo get_form_no($tidak_masuk->id);
                                  ?>
                                </a>
                              </td>
                              <td>
                                <a href="<?php echo site_url('form_tidak_masuk/detail/'.$tidak_masuk->id)?>">
                                  <?php echo date('Y-m-d', strtotime($tidak_masuk->dari_tanggal))?>
                                </a>
                              </td>
                              <td>
                                <a href="<?php echo site_url('form_tidak_masuk/detail/'.$tidak_masuk->id)?>">
                                  <?php echo get_name($tidak_masuk->user_id)?>
                                </a>
                              </td>
                              <td><?php echo $tidak_masuk->alasan;?> </td>
                              <td class="text-center">
                                <?php echo $txt_app_lv1;?>
                              </td>
                              <td class="text-center">
                                <?php echo $txt_app_lv2;?>
                              </td>
                              <td class="text-center">
                                <?php echo $txt_app_lv3;?>
                              </td>
                              <td class="text-center">
                                <?php echo $txt_app_hrd;?>
                              </td>
                              <td class="text-center">
                                <a href="<?php echo site_url('form_tidak_masuk/form_tidak_masuk_pdf/'.$tidak_masuk->id)?>"  target="_blank"><i class="icon-print" title="Print"></i></a>
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