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
            <h3><?php echo lang('edit_group_heading');?></h3> 
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
                      <h4><?php echo lang('edit_group_subheading');?></h4>
                    </div>                          
                    <div class="grid-body no-border">
                        
                        <div class="row column-seperation">
                            <div <?php ( ! empty($message)) && print('class="alert alert-info"'); ?> id="infoMessage"><?php echo $message;?></div>
                            <?php echo form_open(current_url());?>
                                <div class="col-md-12 ">
                                    <h4><?php echo lang('employee_information_subheading')?></h4>
                                    <div class="form-group">
                                        <?php echo lang('edit_group_name_label', 'group_name');?>
                                        <div class="input-with-icon right">                                       
                                            <i class=""></i>
                                            <?php echo bs_form_input($group_name);?>                               
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo lang('edit_group_desc_label', 'description');?>
                                        <div class="input-with-icon right">                                       
                                            <i class=""></i>
                                            <?php echo bs_form_input($group_description);?>                              
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions-register">  
                                    <div class="pull-right">
                                      <button type="submit" class="btn btn-success btn-cons"><i class="icon-ok"></i>&nbsp;<?php echo lang('edit_group_submit_btn');?></button>
                                      <a href="<?php echo site_url('auth/index')?>">
                                            <button class="btn btn-white btn-cons" type="button"><?php echo lang('cancel_button')?></button>
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