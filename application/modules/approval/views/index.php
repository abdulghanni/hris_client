<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        <p class="txtBold txtRed" id="passMsgBad" style="background: #fff; display: none;"><!-- show if failure -->
                                               
                                            </p>
      </div>
      <div class="modal-body">
     <?= form_open('auth/submit', array('id'=>'frm'))?> 
                                    <div class="row form-row">
                                      <div class="col-md-3">
                                        <?php echo lang('register_nik_label', 'nik');?>
                                      </div>
                                      <div class="col-md-9">
                                        <input type="text" class="form-control" name="nik" value=""> 
                                        <input type="text" class="form-control" name="name" value="">          
                                      </div>
                                    </div>
                                    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        <input type="submit" name="btn_submit" id="btnRetPass" value="submit" class="lnkBlkWhtArw" style="margin-top: 3px;">
      </div>
    <?= form_close()?>
    </div>
  </div>
</div>

<!-- <a class="btn btn-primary" href="#" rel="async" ajaxify="<?php echo site_url('auth/auth_ajax/test_ajaxify'); ?>">Tambah</a> -->
<!-- Modal End -->


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
            <i class="icon-custom-left"></i>
            <h3>List&nbsp;<span class="semi-bold">HRD</span></h3> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">                            
                    <div class="grid-body no-border">
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <h4><?php echo lang('search_of_subheading')?>&nbsp;<span class="semi-bold"><?php echo lang('user_subheading');?></span></h4>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-4 search_label">Nama HRD</div>
                                        <div class="col-md-8">
                                        <input type="text" name="hrd-name" id="hrd-name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-4 search_label">Unit Bisnis</div>
                                        <div class="col-md-8">
                                        <?php
                                            $style_bu='class="form-control input-sm select2" style="width:100%" id="bu" required';
                                            echo form_dropdown('bu',$bu,'',$style_bu);
                                          ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <br/>
                        <div id="table"></div>
                        <!--
                        <div class="row">
                            <div class="col-md-4 page_limit">
                                <?php echo form_open(uri_string());?>
                                <?php 
                                    $selectComponentData = array(
                                        10  => '10',
                                        25 => '25',
                                        50 =>'50',
                                        75 => '75',
                                        100 => '100',);
                                    $selectComponentJs = 'class="select2" onChange="this.form.submit()" id="limit"';
                                    echo "Per page: ".form_dropdown('limit', $selectComponentData, $limit, $selectComponentJs);
                                    echo '&nbsp;'.lang('found_subheading').'&nbsp;'.$num_rows_all.'&nbsp;'.lang('users_subheading');
                                ?>
                                <?php echo form_close();?>
                            </div>
                            <div class="col-md-10">
                                <ul class="pagination">
                                    <?php echo $halaman;?>
                                </ul>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo 'Edit Approval'?></h4>
                    </div>
                    <div class="modal-body">
                    <form class="form-no-horizontal-spacing" id="formEdit">
                        <input type="hidden" value="" name="id" id="id" class="id">
                        <div class="row form-row">
                            <div class="col-md-3">
                                <?php echo 'Nama Karyawan';?>
                            </div>
                            <div class="col-md-9">
                                <select name="nik" class="select2" id="nik" style="width:100%">
                                <?php
                                    foreach ($users->result_array() as $key => $value) {
                                    $selected = ($user->user_nik === $value['nik']) ? 'selected = selected' : '';
                                    echo '<option value="'.$value['nik'].'" '.$selected.'>'.$value['username'].' - '.$value['nik'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row form-row">
                            <div class="col-md-3">
                                <?php echo 'Tipe Form';?>
                            </div>
                            <div class="col-md-9">
                                <select name="form_type_id" class="select2" id="form_type_id" style="width:100%">
                                <?php
                                    foreach ($form_type->result_array() as $key => $value) {
                                    $selected = ($user->form_type_id === $value['id']) ? 'selected = selected' : '';
                                    echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['indo'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
                        <button type="button" class="btn btn-primary" style="margin-top: 3px;" id="btnSave" onclick="save()"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button> 
                    </div>             
                </div>

                    <?php echo form_close();?>
            </div>
        </div>

