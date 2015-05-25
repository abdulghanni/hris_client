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
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">
                    <div class="grid-title no-border">
                      <h4><?php echo lang('edit_user_subheading');?></h4>
                    </div>                          
                    <div class="grid-body no-border">
                        
                        <div class="row column-seperation">
                            <div <?php ( ! empty($message)) && print('class="alert alert-info"'); ?> id="infoMessage"><?php echo $message;?></div>
                            <?php echo form_open(uri_string());?>
                                <div class="col-md-12">
                                    <h4><?php echo lang('employee_information_subheading')?></h4>
                                    <div class="form-group">
                                        <?php echo lang('register_nik_label', 'nik');?>
                                        <?php echo bs_form_input($ftitle);?>                                       
                                    </div>
                                    <?php echo form_hidden('id', $org_class->id);?>
                                    <?php echo form_hidden($csrf); ?>
                                </div>
                                
                                <div class="form-actions-register">  
                                    <div class="pull-right">
                                      <button type="submit" class="btn btn-success"><i class="icon-ok"></i>&nbsp;<?php echo lang('save_button');?></button>
                                      <a href="<?php echo site_url('resign_reason/index')?>">
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