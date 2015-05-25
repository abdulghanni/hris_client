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
        <div class="page-title">
            <a href="<?php echo site_url('auth')?>"><i class="icon-custom-left"></i></a>
            <h3><?php echo lang('list_of_subheading')?>&nbsp;<span class="semi-bold"><?php echo lang('users_experience_subheading');?></span></h3> 
        </div>
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
                                                    </div>
                                                    <!-- <div class="row">
                                                        <div class="col-md-5">
                                                            <?php echo lang('register_organization_label', 'organization');?>
                                                        </div>
                                                        <div class="col-md-7">
                                                            : <?php echo strtoupper($organization);?>
                                                        </div>                               
                                                    </div> 
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <?php echo lang('register_position_label', 'position');?>
                                                        </div>
                                                        <div class="col-md-7">
                                                            : <?php echo strtoupper($position);?>
                                                        </div>                               
                                                    </div>-->
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

                        <!--start experience Row -->

                        <div class="row">
                            
                                <div class="grid simple ">                            
                                    <div class="grid-body no-border">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4><?php echo lang('users_experience_subheading');?></h4>  
  
                                            </div>
                                        </div>
                                        <?php echo form_open('auth/search/'.$user->id, array( 'id'=>'search'))?>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-2 search_label"><?php echo form_label(lang('index_experience_title_th'),'experience_title_search')?></div>
                                                        <div class="col-md-10"><?php echo bs_form_input(array('id'=>'title', 'name'=>'title'));?></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <button type="submit" class="btn btn-info"><i class="icon-search"></i>&nbsp;<?php echo lang('search_button')?></button>
                                                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addexperienceModal"><i class="icon-plus"></i>&nbsp;<?php echo lang('add_button');?></button>
                                                    </div>
                                                </div>    
                                            </div>
                                        <?php echo form_close()?>
                                        
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="tabel" class="row">

                                        <div class="row">
                                            
                                            <div class="col-md-2 page_limit">
                                                <!--<?php echo form_open(uri_string());?>
                                                <?php/* 
                                                    $selectComponentData = array(
                                                        10  => '10',
                                                        25 => '25',
                                                        50 =>'50',
                                                        75 => '75',
                                                        100 => '100',);
                                                    $selectComponentJs = 'class="select2" onChange="this.form.submit()" id="limit"';
                                                    echo "Per page: ".form_dropdown('limit', $selectComponentData, $limit, $selectComponentJs);
                                                */?> -->
                                                <?php echo form_close();?>
                                            </div>
                                            <div class="col-md-10">
                                                <ul class="pagination">
                                                    <?php// echo $halaman;?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           
                        </div>
             </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>


<!-- Add experience Modal -->
<div class="modal fade" id="addexperienceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('add_experience', 'add_experience')?></h4>
        <p class="txtBold txtRed" class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      </div>
      <div class="modal-body">
        <?php echo form_open('auth/add_experience/'.$user->id, array('id'=>'formadd'))?> 
             <div class="row form-row">
                <div class="col-md-3">
                    <?php echo lang('company', 'company');?>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="company">         
                </div>

                <div class="col-md-3">
                    <?php echo lang('position', 'position');?>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="position">         
                </div>

                <div class="col-md-3">
                    <?php echo lang('start_date', 'start_date');?>
                </div>
                <div class="col-md-9">
                        <div class="input-with-icon right">
                            <div class="input-append success date no-padding">
                                <input type="text" class="form-control" name="start_date">
                                <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                            </div>
                        </div>
                </div>

                <div class="col-md-3">
                    <?php echo lang('end_date', 'end_date');?>
                </div>
                <div class="col-md-9">
                        <div class="input-with-icon right">
                            <div class="input-append success date no-padding">
                                <input type="text" class="form-control" name="end_date">
                                <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                            </div>
                        </div>
                </div>

                 <div class="col-md-3">
                    <?php echo lang('address', 'position');?>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="address">         
                </div>

                 <div class="col-md-3">
                    <?php echo lang('line_business', 'line_business');?>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="line_business">         
                </div>

                 <div class="col-md-3">
                    <?php echo lang('resign_reason', 'resign_reason');?>
                </div>
                <div class="col-md-9">
                    <select name="resign_reason_id" class="select2" id="resign_reason_id" style="width:100%">
                        <?php
                            foreach ($resign_reason->result_array() as $key => $value) {
                            $selected = ($resign_reason_id <> 0 && $resign_reason_id == $value['id']) ? 'selected = selected' : '';
                            echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                            }
                            ?>
                    </select>              
                </div>

                 <div class="col-md-3">
                    <?php echo lang('last_salary', 'last_salary');?>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="last_salary">         
                </div>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit" class="btn btn-primary lnkBlkWhtArw" name="btn_add" id="btnRetPass" style="margin-top: 3px;"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>

<!--end add modal-->

<script type="text/javascript">
    window.onload = function(){getTable();};  
    function getTable() 
    {
        $('#tabel').load('<?php echo site_url('auth/get_experience/'.$user->id); ?>');
    }
</script>