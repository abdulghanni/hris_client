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
                            <?php echo form_open_multipart(uri_string());?>
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

                                            <div class="col-md-6">
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
                                                        echo '<option value="0">'.' -- Select User -- '.'</option>';
														foreach ($user_superior as $key => $up) {
                                                          $selected = ($up['ID'] == $selected_superior) ? 'selected = selected' : '';
														  echo '<option value="'.$up['ID'].'" '.$selected.'>'.$up['NAME'].'</option>';
														}
													  }else{?>
														  <option value="0">No Data</option>
														<?php }?>
                                                </select>
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
                                                            <?php echo $group['name'];?>
                                                        </label>
                                                    </div>
                                                <?php endforeach?>
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