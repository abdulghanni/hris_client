<div class="row register-container column-seperation">  
    <div class="col-md-8 col-md-offset-2">
        <div class="grid simple">
            <div class="grid-title no-border">
              <h4><?php echo lang('user_registration')?></h4>
            </div>
            <div class="grid-body no-border"> 
                <div <?php ( ! empty($message)) && print('class="alert alert-info"'); ?> id="infoMessage"><?php echo $message;?></div>
                <?php echo form_open("auth/register_user",array("id"=>"form_iconic_validation_"));?>
                <!-- <form id="form_iconic_validation" action="#"> -->
                    <div class="row column-seperation">
                        <div class="col-md-6">
                            <h4><?php echo lang('employee_information_subheading')?></h4>
                            <div class="form-group">
                                <?php echo lang('register_nik_label', 'nik');?>
                                <div class="input-with-icon right">                                       
                                    <i class=""></i>
                                    <?php echo bs_form_input($nik);?>                                 
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo lang('register_fullname_label', 'fullname');?>
                                <div class="input-with-icon right">                                       
                                    <i class=""></i>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php echo bs_form_input($first_name);?>
                                        </div>
                                        <div class="col-md-6">
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
                        </div>
                        <div class="col-md-6">
                            <h4><?php echo lang('user_information_subheading')?></h4> 
                            <div class="form-group">
                                <?php echo lang('create_user_email_label', 'email');?>
                                <div class="input-with-icon  right">                                       
                                    <i class=""></i>
                                    <?php echo bs_form_input($email);?>                                
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo lang('create_user_password_label', 'password');?>
                                <div class="input-with-icon  right">                                       
                                    <i class=""></i>
                                    <?php echo bs_form_input($password);?>                               
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo lang('create_user_password_confirm_label', 'password_confirm');?>
                                <div class="input-with-icon  right">                                       
                                    <i class=""></i>
                                    <?php echo bs_form_input($password_confirm);?>                               
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-actions-register">  
                            <div class="pull-right">
                              <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i><?php echo lang('create_user_submit_btn');?></button>
                              <button type="button" class="btn btn-white btn-cons" id="kembali-login"><?php echo lang('back_button_label')?></button>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>