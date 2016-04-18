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
                    <a href="<?php echo site_url('form_cuti/input'); ?>" class="config"><button type="button" class="btn btn-primary btn-sm"><i class="icon-plus"></i>&nbsp;<?php echo lang('add_button');?></button></a>
                  </div>  
                  <div class="grid-body no-border">
                            <br/>   
                            <?php echo form_open(site_url('form_cuti/keywords'))?>
                              <div class="row">
                                  <div class="col-md-5">
                                      <div class="row">
                                          <div class="col-md-4 search_label"><?php echo form_label('Nama Pemohon','first_name')?></div>
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
                                  <th width="1%"></th>
                                  <th width="17%"><?php echo 'No.' ?></th>
                                  <th width="15%"><?php echo 'NIK.' ?></th>
                                  <th width="15%"><?php echo 'Nama Pemohon' ?></th>
                                  <th width="12%" class="text-center">tgl. mulai cuti</th>
                                  <!-- <th width="15%"><?php //echo lang('reason') ?></th> -->
                                  <th width="8%" class="text-center">Jml. Hari</th>
                                  <th width="10%" class="text-center">appr. atasan langsung</th>
                                  <th width="10%" class="text-center">appr. atasan tidak langsung</th>
                                  <th width="10%" class="text-center">appr. Atasan Lainnya</th>
                                  <th width="10%" class="text-center">appr. HRD</th>
                                  <th width="10%" class="text-center">cetak</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if ($_num_rows > 0) {
                                  foreach ($form_cuti as $user) :
                                  $id_cuti = $user->id;
                                  $session_nik = get_nik($this->session->userdata('user_id'));
                                  $id_user = $this->session->userdata('user_id');
                                  $txt_app_lv1 = $txt_app_lv2 = $txt_app_lv3 = $txt_app_hrd = "<i class='icon-question' title = 'no respond'></i>";
                                  $approval_status_lv1 = ($user->approval_status_id_lv1 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($user->approval_status_id_lv1 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($user->approval_status_id_lv1 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'No Respond'></i>"));
                                  $approval_status_lv2 = ($user->approval_status_id_lv2 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($user->approval_status_id_lv2 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($user->approval_status_id_lv2 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'No Respond'></i>"));
                                  $approval_status_lv3 = ($user->approval_status_id_lv3 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($user->approval_status_id_lv3 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($user->approval_status_id_lv3 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'No Respond'></i>"));
                                  $approval_status_hrd = ($user->approval_status_id_hrd == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($user->approval_status_id_hrd == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($user->approval_status_id_hrd == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'No Respond'></i>"));
                                  
                  
                                  //Approval Level 1
                                  if(!empty($user->user_app_lv1) && $user->is_app_lv1 == 0 && $session_nik == $user->user_app_lv1){
                                      $txt_app_lv1 = "<a href='".site_url('form_cuti/detail/'.$user->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif(!empty($user->user_app_lv1)){
                                      $txt_app_lv1 = "<a href='".site_url('form_cuti/detail/'.$user->id)."''>$approval_status_lv1</a>";
                                    }else{
                                    $txt_app_lv1 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval'></i>";
                                  }
                                  

                                  //ApprovalLevel 2
                                  
                                  if(!empty($user->user_app_lv2) && $user->is_app_lv2 == 0 && $session_nik == $user->user_app_lv2){
                                      $txt_app_lv2 = "<a href='".site_url('form_cuti/detail/'.$user->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif(!empty($user->user_app_lv2)){
                                      $txt_app_lv2 = "<a href='".site_url('form_cuti/detail/'.$user->id)."''>$approval_status_lv2</a>";
                                    }else{
                                    $txt_app_lv2 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval'></i>";
                                  }

                                  //Approval Level 3

                                  if(!empty($user->user_app_lv3) && $user->is_app_lv3 == 0 && $session_nik == $user->user_app_lv3){
                                      $txt_app_lv3 = "<a href='".site_url('form_cuti/detail/'.$user->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif(!empty($user->user_app_lv3)){
                                      $txt_app_lv3 = "<a href='".site_url('form_cuti/detail/'.$user->id)."''>$approval_status_lv3</a>";
                                    }else{
                                    $txt_app_lv3 = "<i class='icon-minus' style='color:black;' title = 'Tidak Butuh Approval'></i>";
                                  }

                                  //Approval HRD
                                    if($this->approval->approver('cuti') == $sess_nik && $user->is_app_hrd == 0){
                                      $txt_app_hrd = "<a href='".site_url('form_cuti/detail/'.$user->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif($user->is_app_hrd == 1){
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
                                    <!--td><?php echo ($user->is_app_lv1 == 0) ? '<button id="'.$user->id.'"  class="remove btn btn-danger btn-mini" type="button" title="Batalkan Pengajuan"><i class="icon-remove"></i></button>' : ''?></td-->
                                    <td><?php echo (($user->is_app_lv1 == 0 && $user->created_by == $id_user) || is_admin()) ? '<button onclick="showModal('.$user->id.')" class="btn btn-danger btn-mini" type="button" title="Remove File"><i class="icon-remove"></i></button>' : ''?></td>
                                    <td>
                                      <a href="#" id="viewcuti-<?php echo $id_cuti; ?>">
                                      <?php
                                        $nik = get_nik($user->user_id);
                                        $bu = get_user_buid($nik);
                                        $date = date('m', strtotime($user->created_on)).'/'.date('Y', strtotime($user->created_on));
                                        echo $form_id.'/'.$bu.'/'.$date.'/'.$user->id;
                                      ?>
                                      </a>
                                    </td> 
                                     <td>
                                      <?php echo $nik ?>
                                    </td>
                                    <td>
                                      <a href="#" id="viewcuti-<?php echo $id_cuti; ?>"><?php echo $user->name; ?></a>
                                    </td>
                                    <td>
                                      <?php echo date('Y-m-d', strtotime($user->date_mulai_cuti)); ?>
                                    </td>
                                   <!--  <td>
                                      <?php echo $user->alasan_cuti ?>
                                    </td> -->
                                    
                                    <td class="text-center">
                                      <?php echo $user->jumlah_hari; ?> hari
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
                                      <?php echo $txt_app_hrd; ?>
                                    </td>
                                    <td class="text-center">
                                       <a href="<?php echo site_url('form_cuti/form_cuti_pdf/'.$user->id)?>"  target="_blank"><i class="icon-print"></i></a>
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
                                                <label class="form-label text-right"><?php echo 'Sisa Cuti' ?></label>
                                              </div>
                                              <div class="col-md-10">
                                                <input name="courseid" id="courseid" type="text"  class="form-control" placeholder="courseid" value="<?php echo $user->sisa_cuti ?>" disabled="disabled">
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
                                                <input name="status" id="status" type="text"  class="form-control" placeholder="Status" value="<?php echo get_name($user->user_pengganti); ?>" disabled="disabled">
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

  <!--Delete Modal-->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Apakah anda yakin ingin membatalkan pengauan ini ?</h4>
        </div>
      <?php echo form_open('auth/delete_course/',array("id"=>"form"))?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none"><span aria-hidden="true">&times;</span></button>
        <input type="hidden" name="id" value="">
      <div class="modal-body">
        <p>Apakah anda yakin ingin membatalkan pengauan ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="icon-ban-circle"></i>&nbsp;<?php echo lang('cancel_button')?></button> 
        <button id="remove" type="button" class="btn btn-danger lnkBlkWhtArw" style="margin-top: 3px;"><i class="icon-warning-sign"></i>&nbsp;<?php echo lang('delete_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>