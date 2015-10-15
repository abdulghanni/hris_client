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
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Daftar&nbsp;<span class="semi-bold">Karyawan Untuk approval Khusus</span></h4>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addModal"><i class="icon-plus"></i>&nbsp;<?php echo lang('add_button');?></button>
                                        </div>
                                    </div>
                        <div <?php ( ! empty($message)) && print('class="alert alert-info text-center"'); ?> id="infoMessage"><?php echo $message;?></div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center"><?php echo anchor('auth/index/'.$fname_param.'/username/'.(($sort_order == 'asc' && $sort_by == 'username') ? 'desc' : 'asc'), 'NIK');?></th>
                                    <th width="30%" class="text-center"><?php echo anchor('auth/index/'.$fname_param.'/email/'.(($sort_order == 'asc' && $sort_by == 'email') ? 'desc' : 'asc'), 'Nama')?></th>
                                    <th width="10%" class="text-center"><?php echo lang('index_action_th');?></th>                                  
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($approval_khusus as $user):?>
                                <tr>
                                    <td valign="middle"><?php echo $user->nik;?></td>
                                    <td valign="middle"><span class="muted"><?php echo $user->username;?></span></td>
                                    <td valign="middle" class="text-center">
                                        <button type="button" class="btn btn-info btn-small" data-toggle="modal" data-target="#editModal<?php echo $user->id?>" title="<?php echo lang('edit_button')?>"><i class="icon-edit"></i></button>
                                        <button class='btn btn-danger btn-small' type="submit" name="remove_levels" value="Delete" data-toggle="modal" data-target="#deleteModal<?php echo $user->id?>" title="<?php echo lang('delete_button')?>"><i class="icon-warning-sign"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>
<script src="<?php echo assets_url('js/jquery-1.8.3.min.js'); ?>"></script>
<?php foreach ($approval_khusus as $user):?>
        <div class="modal fade" id="editModal<?php echo $user->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo 'Edit Approval Khusus'?></h4>
                    </div>
                    <div class="modal-body">
                    <form class="form-no-horizontal-spacing" id="formEdit<?php echo $user->id?>">
                        <input type="hidden" value="<?php echo $user->id?>" name="id" id="id" class="id">
                        <div class="row form-row">
                            <div class="col-md-3">
                                <?php echo 'Nama Karyawan';?>
                            </div>
                            <div class="col-md-9">
                                <select name="nik_update" class="select2" id="" style="width:100%">
                                <?php
                                    foreach ($users->result_array() as $key => $value) {
                                    $selected = ($user->nik === $value['nik']) ? 'selected = selected' : '';
                                    echo '<option value="'.$value['nik'].'" '.$selected.'>'.$value['username'].' - '.$value['nik'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                               
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
                        <button type="submit" class="btn btn-primary" style="margin-top: 3px;" id="btnEdit<?php echo $user->id?>"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button> 
                    </div>             
                </div>

                    <?php echo form_close();?>
            </div>
        </div>

<!--Delete Modal-->
<div class="modal fade" id="deleteModal<?php echo $user->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('delete_confirmation').' for '.$user->username; ?></h4>
        </div>
      <form class="form-no-horizontal-spacing" id="formdelete<?php echo $user->id?>">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">
        <input type="hidden" value="<?php echo $user->id?>" name="id" id="id" class="id">
        <p><?php echo lang('delete_this_data').$user->username.' ?'; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="icon-ban-circle"></i>&nbsp;<?php echo lang('cancel_button')?></button> 
        <button type="submit" class="btn btn-danger" style="margin-top: 3px;" id="btndelete<?php echo $user->id?>"><i class="icon-ok-sign"></i>&nbsp;Delete</button> 
     </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>

        <script type="text/javascript">
            $('#btnEdit'+<?php echo $user->id?>).click(function(){
                var $btn = $(this).button('loading');
                $('#formEdit'+<?php echo $user->id?>).submit(function(ev){
                    $.ajax({
                        type: 'POST',
                        url: 'approval_khusus/update',
                        data: $('#formEdit'+<?php echo $user->id?>).serialize(),
                        success: function() {
                             $("[data-dismiss=modal]").trigger({ type: "click" });
                             location.reload(),
                             $btn.button('reset')
                        }
                    });
                    ev.preventDefault(); 
                });  
            });

            $('#btndelete'+<?php echo $user->id?>).click(function(){
                var $btn = $(this).button('loading');
                $('#formdelete'+<?php echo $user->id?>).submit(function(ev){
                    $.ajax({
                        type: 'POST',
                        url: 'approval_khusus/delete',
                        data: $('#formdelete'+<?php echo $user->id?>).serialize(),
                        success: function() {
                             $("[data-dismiss=modal]").trigger({ type: "click" });
                             location.reload(),
                             $btn.button('reset')
                        }
                    });
                    ev.preventDefault(); 
                });  
            });
        </script>
        <?php endforeach;?>


        <!-- Add  Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Karyawan Untuk Approval Khusus</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <?php //echo form_open('auth/add_award/'.$user->id, array('id'=>'formadd'))?> 
        <form class="form-no-horizontal-spacing" id="formadd">
        <div class="row form-row">
            <div class="col-md-3">
                <?php echo 'Nama Karyawan';?>
            </div>
            <div class="col-md-9">
                <select name="nik" class="select2" id="" style="width:100%">
                <?php
                    foreach ($users->result_array() as $key => $value) {
                    $selected = ($user->user_nik === $value['nik']) ? 'selected = selected' : '';
                    echo '<option value="'.$value['nik'].'" '.$selected.'>'.$value['username'].' - '.$value['nik'].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>                            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
         <button type="submit" class="btn btn-primary" style="margin-top: 3px;" id="btnadd"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button> 
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end add modal-->

