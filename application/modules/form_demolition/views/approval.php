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
                <h4>Form <span class="semi-bold"><a href="<?php echo site_url('form_demolition')?>">Demolition</a></span></h4>
              </div>
              <div class="grid-body no-border">
                <form class="form-no-horizontal-spacing" id="formApp"> 
                  <div class="row column-seperation">
                    <div class="col-md-5">
                      <h4>Informasi karyawan</h4>
                      <?php if($form_demolition->num_rows()>0){
                        foreach($form_demolition->result() as $row):
                          $approval_id = $row->app_status_id;
                          $note_hrd = $row->note_hrd;?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">NIK</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_nik($row->user_id)?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Nama</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($row->user_id)?>" disabled="disabled">
                        </div>
                      </div>          
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Unit Bisnis</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo (!empty($user_info))?$user_info['BU']:'-';?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Dept/Bagian</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo (!empty($user_info))?$user_info['ORGANIZATION']:'-';?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Jabatan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo (!empty($user_info))?$user_info['POSITION']:'-';?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Tanggal Pengangkatan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo (!empty($user_info['SENIORITYDATE']))?dateIndo($user_info['SENIORITYDATE']):'-'?>" disabled="disabled">
                        </div>
                      </div>
                      
                      
                    </div>
                    <div class="col-md-7">
                      <h4>Demolition Yang Diajukan</h4>
                      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Alasan Demolition</label>
                        </div>
                        <div class="col-md-8">
                          <input name="alasan" id="alasan" type="text"  class="form-control " placeholder="Alasan" value="<?php echo $row->alasan_demolition?>" disabled="disabled" >
                        </div>
                      </div>
                      <input name="app_status"  type="hidden"  class="form-control " placeholder="Alasan" value="1">
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Memenuhi Syarat</label>
                        </div>

                        <div class="col-md-8">
                          <label class="radio-inline">
                            <input type="radio" name="syarat" id="syarat1" required value="1" <?php echo ($row->memenuhi_syarat==1)?'checked="checked"':''?>>Ya
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="syarat" id="syarat2" value="0" <?php echo ($row->memenuhi_syarat==0)?'checked="checked"':''?>>Tidak
                          </label>
                        </div>
                        </div>

                      <?php //if(!empty($row->note_hrd)){?>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Note (hrd): </label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="note" class="custom-txtarea-form" <?php echo (is_admin())?'':'disabled="disabled"'?>><?php echo $row->note_hrd ?></textarea>
                        </div>
                      </div>
                      <?php //} ?>


                      </div>
                      
                    </div>
                </div>
                <div class="form-actions text-center">
                    <!-- <div class="col-md-12 text-center"> -->
                      <div class="row wf-cuti">
                        <div class="col-md-6">
                          <p>Yang mengajukan</p>
                          <p class="wf-approve-sp">
                            <span class="semi-bold"><?php echo get_name($row->created_by)?></span><br/>
                            <span class="small"><?php echo dateIndo($row->created_on)?></span><br/>
                          </p>
                        </div>
                        <div class="col-md-6">
                          <p>Menyetujui</p>
                          <p class="wf-approve-sp">
                            <?php if($row->is_app == 1 && is_admin() == false){?>
                            <span class="semi-bold"><?php echo get_name($row->user_app)?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app)?></span><br/>
                            <?php }elseif($row->is_app == 1 && is_admin() == true){?>
                            <span class="semi-bold"><?php echo get_name($row->user_app)?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app)?></span><br/>
                            <button type='button' class='btn btn-info btn-small' title='Edit Approval' data-toggle="modal" data-target="#notapprovedemolitionModal"><i class='icon-paste'></i></button>
                            <?php }else{?>
                             <button class="btn btn-success btn-cons" id="btn_app" type="submit"><i class="icon-ok"></i>Approve</button>
                             <span class="btn btn-danger btn-cons" data-toggle="modal" data-target="#notapprovedemolitionModal"><i class="icon-remove"></i> Not Approve</span>
                            <p class="">...............................</p>
                            <?php } ?>
                          </p>
                          
                        </div>
                      </div>
                    <!-- /div> -->
                  </div>
              </form>
            <?php endforeach;} ?>
              </div>
            </div>
          </div>
        </div>
              
    
      </div>
    
  </div>  
  <!-- END PAGE --> 

   <!-- Edit approval demolition Modal -->
<div class="modal fade" id="notapprovedemolitionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form demolition</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" id="formUpdateApp">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $approval_id) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status<?php echo $app->id?>" type="radio" name="app_status" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="app_status" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (HRD) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note" class="custom-txtarea-form" placeholder="Note supervisor isi disini"><?=$note_hrd?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="btn_app_update"  class="btn btn-success btn-cons" type="submit"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end edit modal--> 