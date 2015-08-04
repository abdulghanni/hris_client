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
                  <h4>Daftar Permintaan <span class="semi-bold">Pelatihan</span></h4>
                  <?php if(is_have_subordinate($sess_id)||is_admin()||is_admin_bagian()){?>
                  <div class="tools"> 
                    <a href="<?php echo site_url('form_training/input')?>" class="config"></a>
                  </div>
                  <?php } ?>
                </div>
                  <div class="grid-body no-border">
                          <br/>   
                          <?php echo form_open(site_url('form_training/keywords'))?>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-3 search_label"><?php echo form_label('Nama','first_name')?></div>
                                        <div class="col-md-9"><?php echo bs_form_input($ftitle_search)?></div>
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
                                  <th width="15%">Nama Pengaju</th>
                                  <th width="15%">Nama Karyawan</th>
                                  <th width="10%">Nama pelatihan</th>
                                  <th width="10%">Tujuan</th>
                                  <th width="10%" style="text-align:center;">appr. spv</th>
                                  <th width="10%" style="text-align:center;">appr. ka. bag</th>
                                  <th width="10%" style="text-align:center;">appr. Atasan Lainnya</th>
                                  <th width="10%" style="text-align:center;">appr. HRD</th>
                                  <th width="10%" class="text-center">Cetak</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                               if($_num_rows>0){
                                foreach($form_training as $user):
                                    $txt_app_lv1 = $txt_app_lv2 = $txt_app_lv3 = $txt_app_hrd = "<i class='icon-minus' title = 'Pending'></i>";
                                    $approval_status_lv1 = ($user->approval_status_id_lv1 == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($user->approval_status_id_lv1 == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                    $approval_status_lv2 = ($user->approval_status_id_lv2 == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($user->approval_status_id_lv2 == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                    $approval_status_lv3 = ($user->approval_status_id_lv3 == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($user->approval_status_id_lv3 == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                    $approval_status_hrd = ($user->approval_status_id_hrd == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($user->approval_status_id_hrd == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                    
                    
                                    //Approval Level 1
                                    if(!empty($user->user_app_lv1) && $user->is_app_lv1 == 0 && $sess_nik == $user->user_app_lv1){
                                        $txt_app_lv1 = "<a href='".site_url('form_training/detail/'.$user->id)."''>
                                                        <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                        </a>";
                                      }elseif(!empty($user->user_app_lv1)){
                                        $txt_app_lv1 = "<a href='".site_url('form_training/detail/'.$user->id)."''>$approval_status_lv1</a>";
                                      }else{
                                      $txt_app_lv1 = "<i class='icon-circle' title = 'Tidak Butuh Approval'></i>";
                                    }
                                    

                                    //ApprovalLevel 2
                                    
                                    if(!empty($user->user_app_lv2) && $user->is_app_lv2 == 0 && $sess_nik == $user->user_app_lv2){
                                        $txt_app_lv2 = "<a href='".site_url('form_training/detail/'.$user->id)."''>
                                                        <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                        </a>";
                                      }elseif(!empty($user->user_app_lv2)){
                                        $txt_app_lv2 = "<a href='".site_url('form_training/detail/'.$user->id)."''>$approval_status_lv2</a>";
                                      }else{
                                      $txt_app_lv2 = "<i class='icon-circle' title = 'Tidak Butuh Approval'></i>";
                                    }

                                    //Approval Level 3

                                    if(!empty($user->user_app_lv3) && $user->is_app_lv3 == 0 && $sess_nik == $user->user_app_lv3){
                                        $txt_app_lv3 = "<a href='".site_url('form_training/detail/'.$user->id)."''>
                                                        <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                        </a>";
                                      }elseif(!empty($user->user_app_lv3)){
                                        $txt_app_lv3 = "<a href='".site_url('form_training/detail/'.$user->id)."''>$approval_status_lv3</a>";
                                      }else{
                                      $txt_app_lv3 = "<i class='icon-circle' title = 'Tidak Butuh Approval'></i>";
                                    }

                                     //Approval HRD
                                    if($this->approval->approver('training') == $sess_nik && $user->is_app_hrd == 0){
                                      $txt_app_hrd = "<a href='".site_url('form_training/detail/'.$user->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif($user->is_app_hrd == 1){
                                      $txt_app_hrd =  "<a href='".site_url('form_training/detail/'.$user->id)."''>$approval_status_hrd</a>";
                                    }
                                  ?>
                                  <tr>
                                    <td>
                                      <a href="<?php echo site_url('form_training/detail/'.$user->id)?>"><?php echo get_name($user->user_pengaju_id)?></a>
                                    </td>

                                    <td>
                                      <a href="<?php echo site_url('form_training/detail/'.$user->id)?>"><?php echo get_name($user->user_peserta_id)?></a>
                                    </td>

                                    <td>
                                      <?php echo $user->training_name?>
                                    </td>

                                    <td>
                                      <?php echo $user->tujuan_training?>
                                    </td>

                                    <td style="text-align:center;">
                                      <?php echo $txt_app_lv1;?>
                                    </td>
                                    <td style="text-align:center;">
                                      <?php echo $txt_app_lv2; ?>
                                    </td>
                                    <td style="text-align:center;">
                                      <?php echo $txt_app_lv3; ?>
                                    </td>
                                    <td style="text-align:center;">
                                      <?php echo $txt_app_hrd; ?>
                                    </td>
                                    <td class="text-center">
                                       <a href="<?php echo site_url('form_training/form_training_pdf/'.$user->id)?>"><i class="icon-print"></i></a>
                                    </td>
                                  </tr>
                              </tbody>
                              <?php endforeach;}?>
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