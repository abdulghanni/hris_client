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
                  <h4><?php echo lang('list_of_submission'); ?> <a href="<?php echo site_url('form_cuti')?>"><span class="semi-bold"><?php echo lang('form_cuti_subheading'); ?></span></a></h4>
                  <div class="tools"> 
                    <a href="<?php echo site_url('form_cuti/input'); ?>" class="config"></a>
                  </div>
                  <div class="grid-body no-border">
                          <table class="table table-striped table-flip-scroll cf">
                              <thead>
                                <tr>
                                  <th width="20%"><?php echo 'Nama Pengaju' ?></th>
                                  <th width="15%"><?php echo lang('date_mulai_cuti') ?></th>
                                  <th width="20%"><?php echo lang('reason') ?></th>
                                  <th width="10%"><?php echo lang('count_day') ?></th>
                                  <th width="10%" style="text-align:center;">appr. spv</th>
                                  <th width="10%" style="text-align:center;">appr. ka. bag</th>
                                  <th width="10%" style="text-align:center;">appr. Atasan Lainnya</th>
                                  <th width="10%" style="text-align:center;">appr. HRD</th>
                                  <th width="10%" style="align:center;">cetak</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if ($_num_rows > 0) {
                                  foreach ($form_cuti as $user) :
                                  $id_cuti = $user->id;
                                  $session_nik = get_nik($this->session->userdata('user_id'));
                                  $id_user = $this->session->userdata('user_id');
                                  $txt_app_lv1 = $txt_app_lv2 = $txt_app_lv3 = $txt_app_hrd = "<i class='icon-minus' title = 'Pending'></i>";
                                  $approval_status_lv1 = ($user->approval_status_id_lv1 == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($user->approval_status_id_lv1 == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                  $approval_status_lv2 = ($user->approval_status_id_lv2 == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($user->approval_status_id_lv2 == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                  $approval_status_lv3 = ($user->approval_status_id_lv3 == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($user->approval_status_id_lv3 == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                  $approval_status_hrd = ($user->approval_status_id_hrd == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($user->approval_status_id_hrd == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                  
                  
                                  //Approval Level 1
                                  if(!empty($user->user_app_lv1) && $user->is_app_lv1 == 0 && $session_nik == $user->user_app_lv1){
                                      $txt_app_lv1 = "<a href='".site_url('form_cuti/detail/'.$user->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif(!empty($user->user_app_lv1)){
                                      $txt_app_lv1 = "<a href='".site_url('form_cuti/detail/'.$user->id)."''>$approval_status_lv1</a>";
                                    }else{
                                    $txt_app_lv1 = "<i class='icon-circle' title = 'Tidak Butuh Approval'></i>";
                                  }
                                  

                                  //ApprovalLevel 2
                                  
                                  if(!empty($user->user_app_lv2) && $user->is_app_lv2 == 0 && $session_nik == $user->user_app_lv2){
                                      $txt_app_lv2 = "<a href='".site_url('form_cuti/detail/'.$user->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif(!empty($user->user_app_lv2)){
                                      $txt_app_lv2 = "<a href='".site_url('form_cuti/detail/'.$user->id)."''>$approval_status_lv2</a>";
                                    }else{
                                    $txt_app_lv2 = "<i class='icon-circle' title = 'Tidak Butuh Approval'></i>";
                                  }

                                  //Approval Level 3

                                  if(!empty($user->user_app_lv3) && $user->is_app_lv3 == 0 && $session_nik == $user->user_app_lv3){
                                      $txt_app_lv3 = "<a href='".site_url('form_cuti/detail/'.$user->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif(!empty($user->user_app_lv3)){
                                      $txt_app_lv3 = "<a href='".site_url('form_cuti/detail/'.$user->id)."''>$approval_status_lv3</a>";
                                    }else{
                                    $txt_app_lv3 = "<i class='icon-circle' title = 'Tidak Butuh Approval'></i>";
                                  }

                                  //Approval HRD
                                    if(is_admin()&&$user->is_app_lv3 == 0){
                                      $txt_app_hrd = "<a href='".site_url('form_cuti/detail/'.$user->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif($user->is_app_lv3 == 1){
                                      $txt_app_hrd =  "<a href='".site_url('form_cuti/detail/'.$user->id)."''>$approval_status_hrd</a>";
                                    }


                                  // date cuti
                                  $date_now = date('Y-m-d');

                                  $datetime1 = new DateTime($date_now);
                                  $datetime2 = new DateTime($user->date_selesai_cuti);
                                  $interval = $datetime1->diff($datetime2);
                                  $sisa_cuti = $interval->format('%a');
                                  if ($datetime2 <= $datetime1) {
                                    $sisa_cuti = 0;
                                  }
                                  
                                  // user pengganti name
                                  $user_pengganti = $user->name;
                                  ?>
                                  <tr class="itemcuti" id="<?php echo $id_cuti; ?>">
                                  <td>
                                      <a href="#" id="viewcuti-<?php echo $id_cuti; ?>"><?php echo $user->name; ?></a>
                                    </td>
                                    <td>
                                      <?php echo dateIndo($user->date_mulai_cuti); ?>
                                    </td>
                                    <td>
                                      <?php echo $user->alasan_cuti; ?>
                                    </td>
                                    
                                    <td>
                                      <?php echo $user->jumlah_hari; ?> hari
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
                                       <a href="<?php echo site_url('form_cuti/form_cuti_pdf/'.$user->id)?>"><i class="icon-print"></i></a>
                                    </td>
                                  </tr>
                                  <tr id="cutidetail-<?php echo $id_cuti; ?>" style="display:none">
                                    <td class="detail" colspan="6">
                                      <div class="row">
                                        <form action="#" method="enctype">
                                          <div class="col-md-12">
                                            <h4>ID : #<?php echo $id_cuti; ?></h4>
                                            <div class="row form-row">
                                              <div class="col-md-2">
                                                <label class="form-label text-right"><?php echo lang('count_cuti') ?></label>
                                              </div>
                                              <div class="col-md-10">
                                                <input name="courseid" id="courseid" type="text"  class="form-control" placeholder="courseid" value="<?php echo (!empty(get_sisa_cuti($user->user_id)[0]['ENTITLEMENT']))?get_sisa_cuti($user->user_id)[0]['ENTITLEMENT']:'-'; ?>" disabled="disabled">
                                              </div>
                                            </div>
                                            <div class="row form-row">
                                              <div class="col-md-2">
                                                <label class="form-label text-right"><?php echo lang('year') ?></label>
                                              </div>
                                              <div class="col-md-10">
                                                <input name="description" id="description" type="text"  class="form-control" placeholder="Description" value="<?php echo $user->comp_session; ?>" disabled="disabled">
                                              </div>
                                            </div>
                                            <div class="row form-row">
                                              <div class="col-md-2">
                                                <label class="form-label text-right"><?php echo lang('start_cuti') ?></label>
                                              </div>
                                              <div class="col-md-10">
                                                <input name="registration_date" id="registration_date" type="text"  class="form-control" placeholder="Registration Date" value="<?php echo dateIndo($user->date_mulai_cuti); ?>" disabled="disabled">
                                              </div>
                                            </div>
                                            <div class="row form-row">
                                              <div class="col-md-2">
                                                <label class="form-label text-right"><?php echo lang('end_cuti') ?></label>
                                              </div>
                                              <div class="col-md-10">
                                                <input name="status" id="status" type="text"  class="form-control" placeholder="Status" value="<?php echo dateIndo($user->date_selesai_cuti); ?>" disabled="disabled">
                                              </div>
                                            </div>
                                            <div class="row form-row">
                                              <div class="col-md-2">
                                                <label class="form-label text-right"><?php echo lang('count_day') ?></label>
                                              </div>
                                              <div class="col-md-10">
                                                <input name="status" id="status" type="text"  class="form-control" placeholder="Status" value="<?php echo $user->jumlah_hari; ?> hari" disabled="disabled">
                                              </div>
                                            </div>
                                            <div class="row form-row">
                                              <div class="col-md-2">
                                                <label class="form-label text-right"><?php echo lang('reason') ?></label>
                                              </div>
                                              <div class="col-md-10">
                                                <input name="status" id="status" type="text"  class="form-control" placeholder="Status" value="<?php echo $user->alasan_cuti; ?>" disabled="disabled">
                                              </div>
                                            </div>
                                            <div class="row form-row">
                                              <div class="col-md-2">
                                                <label class="form-label text-right"><?php echo 'Remarks' ?></label>
                                              </div>
                                              <div class="col-md-10">
                                                <input name="status" id="status" type="text"  class="form-control" placeholder="Status" value="<?php echo $user->remarks; ?>" disabled="disabled">
                                              </div>
                                            </div>
                                            <div class="row form-row">
                                              <div class="col-md-2">
                                                <label class="form-label text-right"><?php echo lang('replacement') ?></label>
                                              </div>
                                              <div class="col-md-10">
                                                <input name="status" id="status" type="text"  class="form-control" placeholder="Status" value="<?php echo get_pengganti($user->id); ?>" disabled="disabled">
                                              </div>
                                            </div>
                                            <div class="row form-row">
                                              <div class="col-md-2">
                                                <label class="form-label text-right"><?php echo 'No. HP' ?></label>
                                              </div>
                                              <div class="col-md-10">
                                                <input name="status" id="status" type="text"  class="form-control" placeholder="Status" value="<?php echo $user->contact; ?>" disabled="disabled">
                                              </div>
                                            </div>
                                            <div class="row form-row">
                                              <div class="col-md-2">
                                                <label class="form-label text-right"><?php echo lang('addr_cuti') ?></label>
                                              </div>
                                              <div class="col-md-10">
                                                <input name="status" id="status" type="text"  class="form-control" placeholder="Status" value="<?php echo $user->alamat_cuti; ?>" disabled="disabled">
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                    </div>
                                  </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php } ?> 
                              </tbody>
                          </table>
                  </div>
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
	<!-- END PAGE -->