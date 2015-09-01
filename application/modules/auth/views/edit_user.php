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
        <!-- <ul class="breadcrumb">
            <li>
                <p>KARYAWAN</p>
            </li> <i class="icon-angle-right"></i> 
            <li>
                <a href="#" class="active">User Management</a>
            </li>
        </ul> -->
        <div class="page-title">
            <a href="<?php echo site_url('auth')?>"><i class="icon-custom-left"></i></a>
            <h3><?php echo lang('edit_user_heading');?></h3> 
        </div>
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="search-bar grid simple ">      
                    <select name="dep" id="sdep" class="simple-dropdown select2">
                        <option value="" selected="selected">Semua departmen</option>
                        <option value="1">Factory Management</option>
                        <option value="2">Process</option>
                        <option value="3">Engineering Sec. Mechanical</option>
                        <option value="4">Engineering Sec. Power Plant</option>                                    
                    </select>
                    <button type="button" class="btn btn-primary btn-cons"><i class="icon-search"></i>&nbsp;&nbsp;Cari</button>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">
                    <div class="grid-title no-border">
                      <h4><?php echo lang('edit_user_subheading');?></h4>
                    </div>                          
                    <div class="grid-body no-border">
                        
                        <div class="row column-seperation">
                            <div <?php ( ! empty($message)) && print('class="alert alert-info"'); ?> id="infoMessage"><?php echo $message;?></div>
                            <?php echo form_open_multipart(uri_string(), array('id'=>'formedituser'));?>
                                <div class="col-md-6">
                                    <h4><?php echo lang('employee_information_subheading')?></h4>
                                    <div class="form-group">
                                        <!-- <div class="input-with-icon right"> -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!-- input foto -->
                                                    <?php echo lang('register_foto_label', 'photo');?>
                                                    <?php echo form_upload($photo);?>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php echo lang('register_nik_label', 'nik');?>
                                                    <?php echo bs_form_input($nik);?>                               
                                                </div>
                                            </div>

                                            <div class="=col-md-6">
                                                <?php if($s_photo && file_exists('./uploads/'.$u_folder.'/'.$s_photo)) {?>
                                                <img alt="" src="<?php echo base_url()?>uploads/<?php echo $u_folder.'/80x80/'.$s_photo?>">
                                                <?php }else{ ?>
                                                <img alt="" src="<?php echo base_url()?>assets/img/no-image.png" class="img-responsive">
                                                <?php } ?>
                                            </div>
                                    </div>
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
                                        <?php echo lang('register_dob_label', 'dob');?>
                                        <div class="input-with-icon right">
                                            <div class="input-append success date no-padding">
                                                <?php echo bs_form_input($bod);?>
                                                <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                            </div>
                                        </div>
                                    </div>
									
                                    <div class="form-group">
                                        <?php echo lang('register_marital_label', 'marital');?>
                                        <div class="input-with-icon right">
                                            <div class="input-with-icon right">                                       
                                            <i class=""></i>
                                                <select name="marital_id" class="select2" id="marital_id" style="width:100%">
                                                    <?php
                                                        foreach ($marital->result_array() as $key => $value) {
                                                            $selected = ($marital_id <> 0 && $marital_id == $value['id']) ? 'selected = selected' : '';
                                                            echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
									
									
                                    <div class="form-group">
                                        <?php echo 'Superior Name';?>
                                        <div class="input-with-icon right">
                                            <div class="input-with-icon right">                                       
                                            <i class=""></i>
                                                <select name="superior_id" class="select2" id="superior_id" style="width:100%">
                                                    <?php if (!empty($user_superior))  {
                                                        echo '<option value="0">'.' -- Pilih Atasan -- '.'</option>';
														foreach ($user_superior as $key => $up) {
                                                          $selected = ($up['ID'] == $selected_superior) ? 'selected = selected' : '';
														  echo '<option value="'.$up['ID'].'" '.$selected.'>'.$up['NAME'].'</option>';
														}
													  }else{?>
														  <option value="0">Tidak ada karyawan dengan grade lebih tinggi</option>
														<?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <!-- <div class="input-with-icon right"> -->
                                        <div class="row text-center">
                                            <div class="col-md-6">
                                                <!-- input foto -->
                                                <?php echo 'Scan Kartu Keluarga';?><br/>
                                                <div class='btn' title='Upload KK' data-toggle="modal" data-target="#uploadkkModal"><i class="icon-upload"> Upload</i></div><br/>
                                            </div>
                                            <div class="col-md-6">
                                                <?php echo 'Scan Akta Kelahiran';?><br/>
                                                <div class='btn' title='Upload Akta' data-toggle="modal" data-target="#uploadaktaModal"><i class="icon-upload"> Upload</i></div><br/>                           
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-6 text-center">
                                                <?php if($s_kk && file_exists('./uploads/'.$u_folder.'/kk/'.$s_kk)) {?>
                                                <a href="<?php echo base_url()?>uploads/<?php echo $u_folder.'/kk/'.$s_kk?>" rel="prettyPhoto"><img alt="" height="80" width="80" src="<?php echo base_url()?>uploads/<?php echo $u_folder.'/kk/'.$s_kk?>" /></a>
                                                <?php }else{ ?>
                                                <img alt="" src="<?php echo base_url()?>assets/img/no-file.png" height="80" width="80">
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <?php if($s_akta && file_exists('./uploads/'.$u_folder.'/akta/'.$s_akta)) {?>
                                                <a href="<?php echo base_url()?>uploads/<?php echo $u_folder.'/akta/'.$s_akta?>" rel="prettyPhoto"><img alt="" height="80" width="80" src="<?php echo base_url()?>uploads/<?php echo $u_folder.'/akta/'.$s_akta?>"></a>
                                                <?php }else{ ?>
                                                <img alt="" src="<?php echo base_url()?>assets/img/no-file.png" height="80" width="80">
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
									
                                </div>
                                <div class="col-md-6">
                                    <h4><?php echo lang('user_contact_subheading')?></h4>
                                    <div class="form-group">
                                        <?php echo lang('edit_user_mobile_phone_label', 'phone');?>
                                        <div class="input-with-icon  right">                                       
                                            <i class=""></i>
                                            <?php echo bs_form_input($phone);?>                                
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo lang('edit_user_previous_email_label', 'previous_email');?>
                                        <div class="input-with-icon  right">                                       
                                            <i class=""></i>
                                            <?php echo bs_form_input($previous_email);?>                                
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo lang('edit_user_bb_pin_label', 'bb_pin');?>
                                        <div class="input-with-icon  right">                                       
                                            <i class=""></i>
                                            <?php echo bs_form_input($bb_pin);?>                                
                                        </div>
                                    </div>
                                    <h4><?php echo lang('user_information_subheading')?></h4> 
                                    <div class="form-group">
                                        <?php echo lang('create_user_email_label', 'email');?>
                                        <div class="input-with-icon  right">                                       
                                            <i class=""></i>
                                            <?php echo bs_form_input($email);?>                                
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo lang('edit_user_password_label', 'password');?>
                                        <div class="input-with-icon  right">                                       
                                            <i class=""></i>
                                            <?php echo bs_form_input($password);?>                               
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?>
                                        <div class="input-with-icon  right">                                       
                                            <i class=""></i>
                                            <?php echo bs_form_input($password_confirm);?>                               
                                        </div>
                                    </div>

                                    <?php if ($this->ion_auth->is_admin()): ?>
                                        <div class="form-group">
                                            <?php echo lang('edit_user_groups_heading');?>
                                            <div class="input-with-icon right">                                     
                                                
                                                <?php foreach ($groups as $group):?>
                                                <div class="checkbox check-success">
                                                    <?php
                                                        $gID=$group['id'];
                                                        $checked = null;
                                                        $item = null;
                                                        foreach($currentGroups as $grp) {
                                                            if ($gID == $grp->id) {
                                                                $checked= ' checked="checked"';
                                                                break;
                                                            }
                                                        }
                                                        ?>
                                                        <input type="checkbox" id="checkbox<?php echo $group['id'];?>" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                                                        <label for="checkbox<?php echo $group['id'];?>">
                                                            <?php 
                                                                $bu = (!empty($group['bu']))?' - ['.get_bu_name($group['bu']).']':'';
                                                                echo $group['name'].$bu;
                                                            ?>
                                                        </label>
                                                    </div>
                                                <?php endforeach?>
                                                <input type="checkbox" id="checkboxuser" name="groups[]" value="2" checked="checked" style="display:none">
                                            </div>
                                        </div>
                                    <?php endif ?>

                                    <?php echo form_hidden('id', $user->id);?>
                                    <?php echo form_hidden($csrf); ?>
                                </div>
                                <div class="form-actions-register">  
                                    <div class="pull-right">
                                      <button type="submit" class="btn btn-success"><i class="icon-ok"></i>&nbsp;<?php echo lang('save_button');?></button>
                                      <a href="<?php echo site_url('auth/index')?>">
                                        <button class="btn btn-white" type="button"><?php echo lang('cancel_button')?></button>
                                      </a>
                                    </div>
                                </div>
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>

<!-- Upload KK Modal -->
<div class="modal fade" id="uploadkkModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo 'Upload Scan Kartu Keluarga'?></h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <?php echo form_open_multipart('auth/do_upload_file/'.$user->id.'/kk', array('id'=>'formkk'))?>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Scan Kartu Keluarga : </label>
              </div>
              <div class="col-md-12">
              <?php echo form_upload($kk);?>
              </div>
              <div class="col-md-12">
               <?php if($s_kk && file_exists('./uploads/'.$u_folder.'/kk/'.$s_kk)) {?>
                <img alt="" height="80" width="80" src="<?php echo base_url()?>uploads/<?php echo $u_folder.'/kk/'.$s_kk?>">
                <?php }else{ ?>
                <img alt="" src="<?php echo base_url()?>assets/img/no-file.png" class="img-responsive">
                <?php } ?>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit" class="btn btn-primary lnkBlkWhtArw" name="btn_add" id="btnRetPass" style="margin-top: 3px;"><i class="icon-ok-sign"></i>&nbsp;<?php echo 'Upload'?></button> 
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end  modal-->

<!-- Upload akta Modal -->
<div class="modal fade" id="uploadaktaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo 'Upload Scan Akta Kelahiran'?></h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <?php echo form_open_multipart('auth/do_upload_file/'.$user->id.'/akta', array('id'=>'formakta'))?>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Scan Akta Kelahiran : </label>
              </div>
              <div class="col-md-12">
              <?php echo form_upload($akta);?>
              </div>
              <div class="col-md-12">
               <?php if($s_akta && file_exists('./uploads/'.$u_folder.'/akta/'.$s_akta)) {?>
                <img alt="" height="80" width="80" src="<?php echo base_url()?>uploads/<?php echo $u_folder.'/akta/'.$s_akta?>">
                <?php }else{ ?>
                <img alt="" src="<?php echo base_url()?>assets/img/no-file.png" class="img-responsive">
                <?php } ?>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit" class="btn btn-primary lnkBlkWhtArw" name="btn_add" id="btnRetPass" style="margin-top: 3px;"><i class="icon-ok-sign"></i>&nbsp;<?php echo 'Upload'?></button> 
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end  modal-->

