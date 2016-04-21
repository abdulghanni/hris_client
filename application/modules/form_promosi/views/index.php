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
                  <h4>Daftar Pengajuan <span class="semi-bold"><a href="<?php echo site_url('form_promosi')?>">Promosi</a></span></h4>
                  <?php if(is_have_subordinate($sess_id)||is_admin()){?>
                  <div class="tools"> 
                    <a href="<?php echo site_url('form_promosi/input') ?>" class="config"><button type="button" class="btn btn-primary btn-sm"><i class="icon-plus"></i>&nbsp;<?php echo lang('add_button');?></button></a>
                  </div>
                  <?php } ?>
                </div>
                  <div class="grid-body no-border">
                          <?php if($_num_rows>0){?>
                          <br/>   
                          <?php echo form_open(site_url('form_promosi/keywords'))?>
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
                        <div class="table-responsive">      
                          <table class="table table-striped table-flip-scroll cf">
                              <thead>
                                <tr>
                                  <th width="1%"></th>
                                  <th width="20%">No.</th>
                                  <th width="15%">Nama Karyawan</th>
                                  <th width="15%">Nama Pemohon</th>
                                  <th width="20%">Jabatan Lama</th>
                                  <th width="20%">Jabatan Baru</th>
                                  <th width="5%">Tanggal Pengangkatan</th>
                                  <th width="5%" class="text-center">appr. atasan langsung</th>
                                  <th width="5%" class="text-center">appr. atasan tidak langsung</th>
                                  <th width="5%" class="text-center">appr. Atasan Lainnya</th>
                                  <th width="5%" class="text-center">appr. HRD</th>
                                  <th width="5%" class="text-center">Cetak</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  foreach($form_promosi as $user):
                                  $txt_app_lv1 = $txt_app_lv2 = $txt_app_lv3 = $txt_app_hrd = "<i class='icon-question' title = 'no respond'></i>";
                                  $approval_status_lv1 = ($user->app_status_id_lv1 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($user->app_status_id_lv1 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($user->app_status_id_lv1 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'No Respond'></i>"));
                                  $approval_status_lv2 = ($user->app_status_id_lv2 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($user->app_status_id_lv2 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($user->app_status_id_lv2 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'No Respond'></i>"));
                                  $approval_status_lv3 = ($user->app_status_id_lv3 == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($user->app_status_id_lv3 == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($user->app_status_id_lv3 == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'No Respond'></i>"));
                                  $approval_status_hrd = ($user->app_status_id_hrd == 1)? "<i class='icon-ok-sign' style='color:green;' title = 'Approved'></i>" : (($user->app_status_id_hrd == 2) ? "<i class='icon-remove-sign' style='color:red;'  title = 'Rejected'></i>"  : (($user->app_status_id_hrd == 3) ? "<i class='icon-exclamation-sign' style='color:orange;' title = 'Pending'></i>" : "<i class='icon-question' title = 'No Respond'></i>"));
                                  
                    
                                    //Approval Level 1
                                    if(!empty($user->user_app_lv1) && $user->is_app_lv1 == 0 && $sess_nik == $user->user_app_lv1){
                                        $txt_app_lv1 = "<a href='".site_url('form_promosi/detail/'.$user->id)."''>
                                                        <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                        </a>";
                                      }elseif(!empty($user->user_app_lv1)){
                                        $txt_app_lv1 = "<a href='".site_url('form_promosi/detail/'.$user->id)."''>$approval_status_lv1</a>";
                                      }else{
                                      $txt_app_lv1 = "<i class='icon-minus' title = 'Tidak Butuh Approval'></i>";
                                    }
                                    

                                    //ApprovalLevel 2
                                    
                                    if(!empty($user->user_app_lv2) && $user->is_app_lv2 == 0 && $sess_nik == $user->user_app_lv2){
                                        $txt_app_lv2 = "<a href='".site_url('form_promosi/detail/'.$user->id)."''>
                                                        <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                        </a>";
                                      }elseif(!empty($user->user_app_lv2)){
                                        $txt_app_lv2 = "<a href='".site_url('form_promosi/detail/'.$user->id)."''>$approval_status_lv2</a>";
                                      }else{
                                      $txt_app_lv2 = "<i class='icon-minus' title = 'Tidak Butuh Approval'></i>";
                                    }

                                    //Approval Level 3

                                    if(!empty($user->user_app_lv3) && $user->is_app_lv3 == 0 && $sess_nik == $user->user_app_lv3){
                                        $txt_app_lv3 = "<a href='".site_url('form_promosi/detail/'.$user->id)."''>
                                                        <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                        </a>";
                                      }elseif(!empty($user->user_app_lv3)){
                                        $txt_app_lv3 = "<a href='".site_url('form_promosi/detail/'.$user->id)."''>$approval_status_lv3</a>";
                                      }else{
                                      $txt_app_lv3 = "<i class='icon-minus' title = 'Tidak Butuh Approval'></i>";
                                    }

                                     //Approval HRD
                                    if($this->approval->approver('promosi', $nik) == $sess_nik &&$user->is_app_hrd == 0){
                                      $txt_app_hrd = "<a href='".site_url('form_promosi/detail/'.$user->id)."''>
                                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-edit'></i></button>
                                                      </a>";
                                    }elseif($user->is_app_hrd == 1){
                                      $txt_app_hrd =  "<a href='".site_url('form_promosi/detail/'.$user->id)."''>$approval_status_hrd</a>";
                                    }
                                  ?>
                                  <input type="hidden" id="form-name" value="<?php echo $form ?>">
                                  <tr>
                                    <td><?php echo (($user->is_app_lv1 == 0 && $user->created_by == $sess_id) || is_admin()) ? '<button onclick="showModal('.$user->id.')" class="btn btn-danger btn-mini" type="button" title="Batalkan Pengajuan"><i class="icon-remove"></i></button>' : ''?>
                                     </td>
                                    <td><a href="<?php echo site_url('form_promosi/detail/'.$user->id)?>">
                                      <?php
                                        $nik = get_nik($user->user_id);
                                        $bu = get_user_buid($nik);
                                        $date = date('m', strtotime($user->created_on)).'/'.date('Y', strtotime($user->created_on));
                                        echo $form_id.'/'.$bu.'/'.$date.'/'.$user->id
                                      ?>
                                    </a></td>
                                    <input type="hidden" id="form-no<?=$user->id?>" value="<?php echo $form_id.'/'.$bu.'/'.$date.'/'.$user->id?>">
                                    <td><a href="<?php echo site_url('form_promosi/detail/'.$user->id)?>"><?php echo get_name($user->user_id)?></a></td>
                                    <td><a href="<?php echo site_url('form_promosi/detail/'.$user->id)?>"><?php echo get_name($user->created_by)?></a></td>
                                    <td><?php echo get_position_name($user->old_pos)?></td>
                                    <td><?php echo get_position_name($user->new_pos)?></td>
                                    <td><?php echo date('Y-m-d', strtotime($user->date_promosi))?></td>
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
                                       <a href="<?php echo site_url('form_promosi/form_promosi_pdf/'.$user->id)?>" target="_blank"><i class="icon-print"></i></a>
                                    </td>
                                  </tr> 
                                <?php endforeach;}?>
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
    
  </div>  
  <!-- END PAGE --> 
  
  <!--Delete Modal-->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Apakah anda yakin ingin membatalkan pengajuan ini ?</h4>
        </div>
      <?php echo form_open('auth/delete_course/',array("id"=>"form"))?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none"><span aria-hidden="true">&times;</span></button>
        <input type="hidden" name="id" value="">
        <input type="hidden" name="form" value="">
        <input type="hidden" name="form-no" value="">
      <div class="modal-body">
        <p>Apakah anda yakin ingin membatalkan pengajuan ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="icon-ban-circle"></i>&nbsp;<?php echo lang('cancel_button')?></button> 
        <button id="remove" type="button" class="btn btn-danger lnkBlkWhtArw" style="margin-top: 3px;"><i class="icon-warning-sign"></i>&nbsp;<?php echo lang('delete_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>