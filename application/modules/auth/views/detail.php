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
            <h3><?php echo lang('list_of_subheading')?>&nbsp;<span class="semi-bold"><?php echo lang('users_employement_subheading');?></span></h3> 
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
                      <h4><a href="<?php echo site_url('auth/index')?>"><?php echo lang('change_user_detail_link')?></a></h4>
                    </div>                          
                    <div class="grid-body no-border">
                        
                        <div class="row">
                                <div class="col-md-4">
                                    <h4><?php echo lang('employee_information_subheading')?></h4>
                                    <div class="form-group">
                                        <!-- <div class="input-with-icon right"> -->
                                            <div class="row">
                                               <!--  <div class="col-md-6">
                                                    <?php if($s_photo && file_exists('./uploads/'.$u_folder.'/'.$s_photo)) {?>
                                                    <img alt="" src="<?php echo base_url()?>uploads/<?php echo $u_folder.'/225x225/'.$s_photo?>">
                                                    <?php }else{ ?>
                                                    <img alt="" src="<?php echo base_url()?>assets/img/no-image.png" class="img-responsive">
                                                    <?php } ?>
                                                </div> -->
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <?php echo lang('register_firstname_label', 'firstname');?>
                                                        </div>
                                                        <div class="col-md-7">
                                                            : <?php echo strtoupper($first_name);?>&nbsp;<?php echo strtoupper($last_name);?> 
                                                        </div>                               
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <?php echo lang('register_nik_label', 'nik');?>
                                                        </div>
                                                        <div class="col-md-7">
                                                            : <?php echo strtoupper($nik);?>
                                                        </div>                               
                                                    </div><!-- 
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <?php echo lang('register_organization_label', 'organization');?>
                                                        </div>
                                                        <div class="col-md-7">
                                                            : <?php echo strtoupper($organization);?>
                                                        </div>                               
                                                    </div> -->
                                                    <!-- <div class="row">
                                                        <div class="col-md-5">
                                                            <?php echo lang('register_position_label', 'position');?>
                                                        </div>
                                                        <div class="col-md-7">
                                                            : <?php echo strtoupper($position);?>
                                                        </div>                               
                                                    </div> -->
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <?php echo lang('register_dob_label', 'dob');?>
                                                        </div>
                                                        <div class="col-md-7">
                                                            : <?php echo strtoupper(date('d-m-Y',strtotime($bod)));?>
                                                        </div>                               
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <?php echo lang('register_marital_label', 'marital');?>
                                                        </div>
                                                        <div class="col-md-7">
                                                            : <?php echo strtoupper($marital_id);?>
                                                        </div>                               
                                                    </div>
                                                </div>
                                                
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4><?php echo lang('user_contact_subheading')?></h4>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <?php echo lang('edit_user_mobile_phone_label', 'phone');?>
                                            </div>
                                            <div class="col-md-7">
                                                : <?php echo strtoupper($phone);?>
                                            </div>                               
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <?php echo lang('create_user_email_label', 'email');?>
                                            </div>
                                            <div class="col-md-7">
                                                : <?php echo $email;?>
                                            </div>                               
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <?php echo lang('edit_user_previous_email_label', 'previous_email');?>
                                            </div>
                                            <div class="col-md-7">
                                                : <?php echo $previous_email;?>
                                            </div>                               
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <?php echo lang('edit_user_bb_pin_label', 'bb_pin');?>
                                            </div>
                                            <div class="col-md-7">
                                                : <?php echo strtoupper($bb_pin);?>
                                            </div>                               
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4><?php echo lang('user_photo_subheading')?></h4>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php if($s_photo && file_exists('./uploads/'.$u_folder.'/'.$s_photo)) {?>
                                                    <img alt="" src="<?php echo base_url()?>uploads/<?php echo $u_folder.'/100x100/'.$s_photo?>">
                                                <?php }else{ ?>
                                                    <img alt="" src="<?php echo base_url()?>assets/img/no-image.png" class="img-responsive">
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <?php echo $this->load->view('auth_detail_navbar');?>
                        <hr />

                        <!--start employement Row -->

                        <div class="row">
                            <div class="grid simple ">                            
                                <div class="grid-body no-border">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4><?php echo lang('users_employement_subheading');?></h4>
                                        </div>
                                    </div>
                                        
                                         <?php 
                                            if ($user_employement->num_rows()>0){
                                            foreach($user_employement->result() as $row){
                                    
                                            ($user_id->num_rows()>0) ? $param = 'update' : $param = 'add';
                                            echo form_open('auth/'.$param.'_empl/'.$user->id)?> 
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-center" id="infoMessage"><?php echo $message;?></div>
                                            </div>
                                        </div>
                                        <div class="row form-row">

                                             <div class="col-md-3">
                                                <?php echo lang('seniority_date', 'seniority_date');?>
                                            </div>
                                            <div class="col-md-9">
                                                    <div class="input-with-icon right">
                                                        <div class="input-append success date no-padding">
                                                            <input type="text" class="form-control" id="seniority_date" name="seniority_date" value="<?php echo $row->seniority_date?>">
                                                            <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="col-md-3">
                                                <?php echo lang('position', 'position');?>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="position_id" class="select2" id="position_id_detail" style="width:100%">
                                                    <?php
                                                        if($q_position->num_rows() > 0){
                                                        foreach ($position->result_array() as $key => $value) {
                                                        $selected = ($row->position_id <> 0 && $row->position_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                        }}else{
                                                            echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <input type="hidden" class="form-control" id="pos_group_url" name="pos_group_url" value="<?php echo site_url('auth/get_pos_group')?>">         
                                                    <input type="hidden" class="form-control" id="position_group_id" name="position_group_id" value="<?php echo $row->position_group_id?>">         
                                                    <input type="hidden" class="form-control" id="organization_id" name="organization_id" value="<?php echo $row->organization_id?>">         

                                            </div>

                                            <!-- <div class="col-md-3">
                                                <?php echo lang('position_group', 'position_group');?>
                                                <input type="hidden" class="form-control" id="pos_group_url" name="pos_group_url" value="<?php echo site_url('auth/get_pos_group')?>">         
                                            </div>
                                            <div class="col-md-9">
                                                <select name="position_group_id" class="" id="position_group_id_edit" style="width:100%" readonly>
                                                    <?php
                                                        if($q_position_group->num_rows() > 0){
                                                        foreach ($position_group->result_array() as $key => $value) {
                                                        $selected = ($row->position_group_id <> 0 && $row->position_group_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                        }}else{
                                                        echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                    </select>        
                                            </div>

                                            <div class="col-md-3">
                                                <?php echo lang('organization', 'organization');?>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="organization_id" class="" id="organization_id_edit" style="width:100%" readonly>
                                                    <?php
                                                        if($q_organization->num_rows() > 0){
                                                        foreach ($organization->result_array() as $key => $value) {
                                                        $selected = ($row->organization_id <> 0 && $row->organization_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                         }}else{
                                                            echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                    </select>        
                                            </div> -->

                                            <div class="col-md-3">
                                                <?php echo lang('empl_status', 'empl_status');?>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="empl_status_id" class="select2" id="empl_status_id" style="width:100%">
                                                    <?php
                                                        if($q_empl_status->num_rows() > 0){
                                                        foreach ($empl_status->result_array() as $key => $value) {
                                                        $selected = ($row->empl_status_id <> 0 && $row->empl_status_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                        }}else{
                                                          echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                    </select>        
                                            </div>

                                            <div class="col-md-3">
                                                <?php echo lang('employee_status', 'employee_status');?>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="employee_status_id" class="select2" id="employee_status_id" style="width:100%">
                                                    <?php
                                                        if($q_employee_status->num_rows() > 0){
                                                        foreach ($employee_status->result_array() as $key => $value) {
                                                        $selected = ($row->employee_status_id <> 0 && $row->employee_status_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                          }}else{
                                                            echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                    </select>        
                                            </div>

                                            <div class="col-md-3">
                                                <?php echo lang('cost_center', 'cost_center');?>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="cost_center" name="cost_center" value="<?php echo $row->cost_center?>">         
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <?php echo lang('grade', 'grade');?>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="grade_id" class="select2" id="grade_id" style="width:100%">
                                                    <?php
                                                        if($q_grade->num_rows() > 0){
                                                        foreach ($grade->result_array() as $key => $value) {
                                                        $selected = ($row->grade_id <> 0 && $row->grade_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                            }}else{
                                                               echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                </select>        
                                            </div>

                                            <div class="col-md-3">
                                                <?php echo lang('resign_reason', 'resign_reason');?>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="resign_reason_id" class="select2" id="resign_reason_id" style="width:100%">
                                                    <?php
                                                        if($q_resign_reason->num_rows() > 0){
                                                        foreach ($resign_reason->result_array() as $key => $value) {
                                                        $selected = ($row->resign_reason_id <> 0 && $row->resign_reason_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                        }}else{
                                                        echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                </select>        
                                            </div>

                                            <div class="col-md-3">
                                                <?php echo lang('active_inactive', 'active_inactive');?>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="active_inactive_id" class="select2" id="active_inactive_id" style="width:100%">
                                                    <?php
                                                        if($q_active_inactive->num_rows() > 0){
                                                        foreach ($active_inactive->result_array() as $key => $value) {
                                                        $selected = ($row->active_inactive_id <> 0 && $row->active_inactive_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                        }}else{
                                                            echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                </select>        
                                            </div>
											
											 <div class="col-md-3">
                                                <?php echo 'Nama Atasan';?>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="atasan_id" class="select2" id="atasan_id" style="width:100%">
                                                    <?php
                                                        if($q_atasan->num_rows() > 0){
                                                        foreach ($atasan->result_array() as $key => $value) {
                                                        $selected = ($row->atasan_id <> 0 && $row->atasan_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['username'].'</option>';
                                                        }}else{
                                                            echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                </select>        
                                            </div>
											
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary lnkBlkWhtArw" name="btn_add" id="btnRetPass" style="margin-top: 3px;"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
                                      
                                        <?php echo form_close()?>
                                </div>
                            </div>
                        </div>
                        <?php }}
						
						else{
							
                                       ($user_id->num_rows()>0) ? $param = 'update' : $param = 'add';
                                        echo form_open('auth/'.$param.'_empl/'.$user->id)?> 
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-center" id="infoMessage"><?php echo $message;?></div>
                                            </div>
                                        </div>
                                        <div class="row form-row">

                                             <div class="col-md-3">
                                                <?php echo lang('seniority_date', 'seniority_date');?>
                                            </div>
                                            <div class="col-md-9">
                                                    <div class="input-with-icon right">
                                                        <div class="input-append success date no-padding">
                                                            <input type="text" class="form-control" id="seniority_date" name="seniority_date" value="-">
                                                            <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="col-md-3">
                                                <?php echo lang('position', 'position');?>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="position_id" class="select2" id="position_id" style="width:100%">
                                                    <?php
                                                        if($q_position->num_rows() > 0){
                                                        foreach ($position->result_array() as $key => $value) {
                                                        $selected = ($row->position_id <> 0 && $row->position_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                        }}else{
                                                            echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <input type="hidden" class="form-control" id="pos_group_url" name="pos_group_url" value="<?php// echo site_url('auth/get_pos_group')?>">         
                                                    <input type="hidden" class="form-control" id="position_group_id" name="position_group_id" value="<?php// echo $row->position_group_id?>">         
                                                    <input type="hidden" class="form-control" id="organization_id" name="organization_id" value="<?php// echo $row->organization_id?>">       
                                            </div>

                                            <!-- <div class="col-md-3">
                                                <?php echo lang('position_group', 'position_group');?>
                                            </div>

                                            <div class="col-md-9">
                                                <select name="position_group_id" class="select2" id="position_group_id" style="width:100%">
                                                    <?php
                                                        if($q_position_group->num_rows() > 0){
                                                        foreach ($position_group->result_array() as $key => $value) {
                                                        $selected = ($row->position_group_id <> 0 && $row->position_group_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                        }}else{
                                                        echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                    </select>        
                                            </div>

                                            <div class="col-md-3">
                                                <?php echo lang('organization', 'organization');?>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="organization_id" class="select2" id="organization_id" style="width:100%">
                                                    <?php
                                                        if($q_organization->num_rows() > 0){
                                                        foreach ($organization->result_array() as $key => $value) {
                                                        $selected = ($row->organization_id <> 0 && $row->organization_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                         }}else{
                                                            echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                    </select>        
                                            </div> -->

                                            <div class="col-md-3">
                                                <?php echo lang('empl_status', 'empl_status');?>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="empl_status_id" class="select2" id="empl_status_id" style="width:100%">
                                                    <?php
                                                        if($q_empl_status->num_rows() > 0){
                                                        foreach ($empl_status->result_array() as $key => $value) {
                                                        $selected = ($row->empl_status_id <> 0 && $row->empl_status_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                        }}else{
                                                          echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                    </select>        
                                            </div>

                                            <div class="col-md-3">
                                                <?php echo lang('employee_status', 'employee_status');?>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="employee_status_id" class="select2" id="employee_status_id" style="width:100%">
                                                    <?php
                                                        if($q_employee_status->num_rows() > 0){
                                                        foreach ($employee_status->result_array() as $key => $value) {
                                                        $selected = ($row->employee_status_id <> 0 && $row->employee_status_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                          }}else{
                                                            echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                    </select>        
                                            </div>

                                            <div class="col-md-3">
                                                <?php echo lang('cost_center', 'cost_center');?>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="cost_center" name="cost_center" value="-">         
                                            </div>
                                            

                                            <div class="col-md-3">
                                                <?php echo lang('grade', 'grade');?>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="grade_id" class="select2" id="grade_id" style="width:100%">
                                                    <?php
                                                        if($q_grade->num_rows() > 0){
                                                        foreach ($grade->result_array() as $key => $value) {
                                                        $selected = ($row->grade_id <> 0 && $row->grade_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                            }}else{
                                                               echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                </select>        
                                            </div>

                                            <div class="col-md-3">
                                                <?php echo lang('resign_reason', 'resign_reason');?>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="resign_reason_id" class="select2" id="resign_reason_id" style="width:100%">
                                                    <?php
                                                        if($q_resign_reason->num_rows() > 0){
                                                        foreach ($resign_reason->result_array() as $key => $value) {
                                                        $selected = ($row->resign_reason_id <> 0 && $row->resign_reason_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                        }}else{
                                                        echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                </select>        
                                            </div>

                                            <div class="col-md-3">
                                                <?php echo lang('active_inactive', 'active_inactive');?>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="active_inactive_id" class="select2" id="active_inactive_id" style="width:100%">
                                                    <?php
                                                        if($q_active_inactive->num_rows() > 0){
                                                        foreach ($active_inactive->result_array() as $key => $value) {
                                                        $selected = ($row->active_inactive_id <> 0 && $row->active_inactive_id == $value['id']) ? 'selected = selected' : '';
                                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                                        }}else{
                                                            echo '<option value="0">'.'No Data'.'</option>';
                                                        }
                                                        ?>
                                                </select>        
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary lnkBlkWhtArw" name="btn_add" id="btnRetPass" style="margin-top: 3px;"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
                                      
                                        <?php echo form_close()?>
                                </div>
                            </div>
                        </div>

                        <?php } ?>
                    
            </div>
        </div>
    <!-- END PAGE -->
</div>
