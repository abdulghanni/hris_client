<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
             <h3>Widget Settings</h3>
        </div>
        <div class="modal-body">Widget settings form goes here</div>
    </div>
    <div class="clearfix"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">
                    <div class="grid-body no-border">
                        
                        <div class="row column-seperation">
                            <?php if(!empty($user)):
                                echo form_open_multipart(uri_string(), array('id'=>'formedituser'));?>
                                <div class="col-md-6">
                                    <h4><?php echo 'Data Karyawan Saat Ini'?></h4>
                                    <div class="form-group">
                                        <div class="input-with-icon right">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <?php echo lang('register_firstname_label', 'firstname');?>
                                                    <?php echo bs_form_input($first_name);?>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php echo lang('register_lastname_label', 'lastname');?>
                                                    <?php echo bs_form_input($last_name);?>                             
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-with-icon right">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <?php echo lang('register_dob_label', 'dob');?>
                                                    <?php echo bs_form_input($bod);?>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php echo lang('register_marital_label', 'marital');?>
                                                    <?php echo bs_form_input($marital);?>                          
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-with-icon right">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <?php echo lang('edit_user_bb_pin_label', 'bb_pin');?>
                                                    <?php echo bs_form_input($bb_pin);?>
                                                </div>
                                                <div class="col-md-6">          
                                                    <?php echo lang('edit_user_mobile_phone_label', 'phone');?>
                                                    <?php echo bs_form_input($phone);?>                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php echo lang('edit_user_previous_email_label', 'previous_email');?>
                                        <?php echo bs_form_input($previous_email);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4><?php echo 'Perubahan yang Diajukan'?></h4>
                                    <div class="form-group">
                                        <div class="input-with-icon right">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <?php echo lang('register_firstname_label', 'firstname');?>
                                                    <?php echo bs_form_input($first_name_n);?>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php echo lang('register_lastname_label', 'lastname');?>
                                                    <?php echo bs_form_input($last_name_n);?>                             
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-with-icon right">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <?php echo lang('register_dob_label', 'dob');?>
                                                    <?php echo bs_form_input($bod_n);?>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php echo lang('register_marital_label', 'marital');?>
                                                    <?php echo bs_form_input($marital_n);?>                          
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-with-icon right">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <?php echo lang('edit_user_bb_pin_label', 'bb_pin');?>
                                                    <?php echo bs_form_input($bb_pin_n);?>
                                                </div>
                                                <div class="col-md-6">          
                                                    <?php echo lang('edit_user_mobile_phone_label', 'phone');?>
                                                    <?php echo bs_form_input($phone_n);?>                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <?php echo lang('edit_user_previous_email_label', 'previous_email');?>
                                        <?php echo bs_form_input($previous_email_n);?>
                                    </div>
                                </div>

                                    <?php if(!empty($note)){?>
                                    <div class="form-group">
                                          <div class="col-md-2">
                                            <label class="form-label text-right">Note (Administrator): </label>
                                          </div>
                                          <div class="col-md-4">
                                            <textarea name="note_lv1" class="custom-txtarea-form" placeholder="Note  isi disini" disabled="disabled"><?php echo $note ?></textarea>
                                          </div>
                                        </div>
                                    <?php } ?>
                                <div class="form-actions-register">  

      <?php if(($is_app == 0 && is_admin()) || ($is_app == 0 && is_admin_cabang())){?>
                                    <div class="pull-right">
                                      <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submiteditModal"><i class="icon-ok"></i>Submit</div>
                                      <a href="<?php echo site_url('auth/index')?>">
                                        <button class="btn btn-white" type="button"><?php echo lang('cancel_button')?></button>
                                      </a>
                                    </div>
                                </div>
                                <?php }elseif($is_app == 1){
                            $approved = assets_url('img/approved_stamp.png');
                            $rejected = assets_url('img/rejected_stamp.png');?>
                        <div class="row wf-cuti">
                        <div class="col-md-3 pull-right text-center">
                        <div class="col-md-12 text-center"><div class="col-md-12 text-center"><span class="semi-bold">Status Perubahan,</span><br/><br/><br/></div>
                          <p class="wf-approve-sp">
                           <?php echo ($app_status_id == 1)?"<img class=approval_img_md src=$approved>":(($app_status_id == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($user_app)?></span><br/>
                              <span class="small"><?php echo dateIndo($date_app)?></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(Administrator)</span>
                              </p>
                              </div>
                              </div>
      <?php }?>
                            <?php echo form_close();
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>

<!--approval edit_approval Modal Lv1 -->
<div class="modal fade" id="submiteditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Edit Profile</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" id="formApp">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $app_status_id) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv1<?php echo $app->id?>" type="radio" name="app_status" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_lv1<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="app_status" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Administrator) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note" class="custom-txtarea-form" placeholder="Note Administrator isi disini"><?php echo $note?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit" id="btn_app"  class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
      
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal Lv1--> 