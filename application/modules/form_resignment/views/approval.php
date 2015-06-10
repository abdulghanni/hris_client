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
              <h4>Form Karyawan <span class="semi-bold"><a href="<?php echo site_url('form_resignment')?>">Keluar</a></span></h4>
            </div>
            <div class="grid-body no-border">
            <form id="formApp" class="form-no-horizontal-spacing">
              <?php 
                  if($form_resignment->num_rows()>0){
                    foreach ($form_resignment->result() as $row):
              ?>
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($row->user_id)?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Wilayah</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="<?php echo (!empty($user_info))?$user_info['BU']:'-';?>" disabled="disabled">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">NIK</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="nik" type="text"  class="form-control" placeholder="NIK" value="<?php echo (!empty($user_info))?$user_info['EMPLID']:'-';?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="Dept/Bagian" value="<?php echo (!empty($user_info))?$user_info['ORGANIZATION']:'-';?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="position" type="text"  class="form-control" placeholder="Jabatan" value="<?php echo (!empty($user_info))?$user_info['POSITION']:'-';?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Tanggal Akhir Kerja</label>
                      </div>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="sandbox-advance" name="date_resign" value="<?php echo dateIndo($row->date_resign)?>" required disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Alasan Berhenti Bekerja</label>
                      </div>
                    </div>
                    
                    <div class="row form-row">
                      <div class="col-md-12">
                        <div class="radio">
                            <input id="alasan_resign-<?php echo $row->id?>" type="radio" name="alasan_resign" value="<?php echo $row->id?>" checked="checked">
                            <label for="alasan_resign-<?php echo $row->id?>"><?php echo $row->alasan_resign?></label>
                          </div>
                        </div>
                      </div>
                    </div>

                      
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Apa alasan utama berhenti bekerja dari perusahaan ini? Jelaskan</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="" class="form-control" rows="3" name="desc_resign" disabled="disabled"><?php echo $row->desc_resign?></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Adakah prosedur perusahaan yang membuat anda tidak nyaman atau tidak bisa maksimum menjalankan tugasnya?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="procedure_resign" disabled="disabled"><?php echo $row->procedure_resign?></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Adakah hal yang memuaskan dari pekerjaan anda sekarang?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="kepuasan_resign" disabled="disabled"><?php echo $row->kepuasan_resign?></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Adakah saran untuk kami?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="saran_resign" disabled="disabled"><?php echo $row->saran_resign?></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Apakah anda mempertimbangkan di masa datang untuk kembali bekerja di perusahaan ini?</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="rework_resign" disabled="disabled"><?php echo $row->rework_resign?></textarea>
                      </div>
                    </div>
                    <?php if(!empty($row->note_lv1)){?>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Catatan Supervisor</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="note_hrd" <?php echo ($row->is_app_lv1==1)? 'disabled="disabled"' : ''?>><?php echo $row->note_lv1?></textarea>
                      </div>
                    </div>
                    <?php };
                      if(!empty($row->note_lv2)){?>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Catatan Ka. Bagian</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="note_hrd" <?php echo ($row->is_app_lv2==1)? 'disabled="disabled"' : ''?>><?php echo $row->note_lv2?></textarea>
                      </div>
                    </div>
                    <?php };
                    if(!empty($row->note_hrd)){
                    ?>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label text-left">Catatan Pewawancara</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <textarea id="text-editor" placeholder="Enter text ..." class="form-control" rows="3" name="note_hrd" <?php echo ($row->is_app_hrd==1)? 'disabled="disabled"' : ''?>><?php echo $row->note_hrd?></textarea>
                      </div>
                    </div><?php } ?>
                </div>
                <?php 
                  $approved = assets_url('img/approved_stamp.png');
                  $rejected = assets_url('img/rejected_stamp.png');
                ?>
                 <div class="form-actions">
                 <div class="row form-row">
                      <div class="col-md-12 text-center">
                      <?php if($row->is_app_lv1 == 1  && cek_subordinate(is_have_subordinate($session_id),'id', $row->user_id) == TRUE){?>
                          <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#updateresignmentspvModal"><i class='icon-edit'> Edit Approval</i></div>
                        <?php }elseif($row->is_app_lv2 == 1 && cek_subordinate(is_have_subsubordinate($session_id),'id', $row->user_id) == TRUE){?>
                          <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#updateresignmentkbgModal"><i class='icon-edit'> Edit Approval</i></div>
                        <?php }elseif($row->is_app_hrd == 1 && is_admin() == true){?>
                          <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#updateresignmenthrdModal"><i class='icon-edit'> Edit Approval</i></div>
                        <?php } ?>
                      </div>
                  </div>
                  <div class="col-md-12 text-center">
                      <div class="row wf-cuti">
                        <div class="col-md-3">
                          Karyawan Ybs,<br/><br/>
                          <p class="wf-approve-sp">
                            <span class="semi-bold"><?php echo get_name($row->user_id)?></span><br/>
                            <span class="small"><?php echo dateIndo($row->created_on)?></span><br/>
                          </p>
                        </div>
                        
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                          <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                            <?php 
                          $approved = assets_url('img/approved_stamp.png');
                          $rejected = assets_url('img/rejected_stamp.png');
                          if ($row->is_app_lv1 == 1) { 
                            echo ($row->app_status_id_lv1 == 1)? "<img class=approval_img_md src=$approved>":(($row->app_status_id_lv1 == 2) ? "<img class=approval_img_md src=$rejected>":'');?><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv1)?></span><br/>
                            <span class="semi-bold">Supervisor</span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv1)?></span><br/>
                            <?php }elseif($row->is_app_lv1 == 0 && cek_subordinate(is_have_subordinate($session_id),'id', $row->user_id) == TRUE){?>
                            <div class="btn btn-success btn-cons" data-toggle="modal" data-target="#submitresignmentspvModal"><i class="icon-ok"></i>Submit</div>
                            <span class="small"></span><br/>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <?php } ?>
                          </p>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                          <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                           <?php if ($row->is_app_lv2 == 1) { 
                            echo ($row->app_status_id_lv2 == 1)? "<img class=approval_img_md src=$approved>":(($row->app_status_id_lv2 == 2) ? "<img class=approval_img_md src=$rejected>":'');?><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv2)?></span><br/>
                            <span class="semi-bold">Ka. Bagian</span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv2)?></span><br/>
                            <?php }elseif($row->is_app_lv2 == 0 && cek_subordinate(is_have_subsubordinate($session_id),'id', $row->user_id) == TRUE){?>
                            <div class="btn btn-success btn-cons" type="" data-toggle="modal" data-target="#submitresignmentkbgModal"><i class="icon-ok"></i>Submit</div>
                            <span class="small"></span><br/>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <?php } ?>
                          </p>
                        </div>

                        <div class="col-md-3">
                          Pewawancara,<br/><br/>
                          <p class="wf-approve-sp">
                            <?php if($row->is_app_hrd==1){
                            echo ($row->app_status_id_hrd == 1)? "<img class=approval_img_md src=$approved>":(($row->app_status_id_hrd == 2) ? "<img class=approval_img_md src=$rejected>":'');?><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_hrd)?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_hrd)?></span>
                            <?php }elseif($row->is_app_hrd==0 && is_admin()){?>
                            <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitresignmenthrdModal"><i class="icon-ok"></i>Submit</div>
                            <?php }else{ ?>
                            <span class="semi-bold"></span><br/>
                            <span class="semi-bold">(HRD)</span>
                            <?php } ?>
                          </p>
                        </div>
                      </div>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
              
    
      </div>
    
  </div>  
  <!-- END PAGE -->

  <!-- do approval resignment Modal spv -->
<div class="modal fade" id="submitresignmentspvModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form resignment</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" method="POST" action="<?php echo site_url('form_resignment/do_approve/lv1/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->app_status_id_lv1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv1<?php echo $app->id?>" type="radio" name="app_status_lv1" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_lv1<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status_lv1" type="radio" name="app_status_lv1" value="0">
                  <label for="app_status_lv1">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Ka. Bag) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_lv1" class="custom-txtarea-form" placeholder="Note Supervisor isi disini"><?php echo $row->note_lv1?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end do modal--> 


<!-- do approval resignment Modal kbg -->
<div class="modal fade" id="submitresignmentkbgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form resignment</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" method="POST" action="<?php echo site_url('form_resignment/do_approve/lv2/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->app_status_id_lv2) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv2<?php echo $app->id?>" type="radio" name="app_status_lv2" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_lv2<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status_lv2" type="radio" name="app_status_lv2" value="0">
                  <label for="app_status_lv2">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Ka. Bag) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_lv2" class="custom-txtarea-form" placeholder="Note Ka. Bagian isi disini"><?php echo $row->note_lv2?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end do modal--> 

<!-- do approval resignment hrd Modal -->
<div class="modal fade" id="submitresignmenthrdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form resignment</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" method="POST" action="<?php echo site_url('form_resignment/do_approve/hrd/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->app_status_id_hrd) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_hrd<?php echo $app->id?>" type="radio" name="app_status_hrd" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_hrd<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status_hrd" type="radio" name="app_status_hrd" value="0">
                  <label for="app_status_hrd">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (HRD) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_hrd" class="custom-txtarea-form" placeholder="Note hrd isi disini"><?php echo $row->note_hrd?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end do modal--> 

<!-- Edit approval resignment Modal spv -->
<div class="modal fade" id="updateresignmentspvModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form resignment</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" method="POST" action="<?php echo site_url('form_resignment/update_approve/lv1/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->app_status_id_lv1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="update_app_status_lv1<?php echo $app->id?>" type="radio" name="update_app_status_lv1" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="update_app_status_lv1<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="update_app_status_lv1" type="radio" name="update_app_status_lv1" value="0">
                  <label for="update_app_status_lv1">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Ka. Bag) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="update_note_lv1" class="custom-txtarea-form" placeholder="Note Supervisor isi disini"><?php echo $row->note_lv1?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end edit modal--> 


<!-- Edit approval resignment Modal kbg -->
<div class="modal fade" id="updateresignmentkbgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form resignment</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" method="POST" action="<?php echo site_url('form_resignment/update_approve/lv2/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->app_status_id_lv2) ? 'checked = "checked"' : '';
                      ?>
                  <input id="update_app_status_lv2<?php echo $app->id?>" type="radio" name="update_app_status_lv2" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="update_app_status_lv2<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="update_app_status_lv2" type="radio" name="update_app_status_lv2" value="0">
                  <label for="update_app_status_lv2">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Ka. Bag) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="update_note_lv2" class="custom-txtarea-form" placeholder="Note Ka. Bagian isi disini"><?php echo $row->note_lv2?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end edit modal--> 

<!-- Edit approval resignment hrd Modal -->
<div class="modal fade" id="updateresignmenthrdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form resignment</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" method="POST" action="<?php echo site_url('form_resignment/update_approve/hrd/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->app_status_id_hrd) ? 'checked = "checked"' : '';
                      ?>
                  <input id="update_app_status_hrd<?php echo $app->id?>" type="radio" name="update_app_status_hrd" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="update_app_status_hrd<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="update_app_status_hrd" type="radio" name="update_app_status_hrd" value="0">
                  <label for="update_app_status_hrd">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (HRD) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="update_note_hrd" class="custom-txtarea-form" placeholder="Note hrd isi disini"><?php echo $row->note_hrd?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end edit modal--> 
<?php endforeach;}?>