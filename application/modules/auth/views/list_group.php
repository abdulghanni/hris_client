
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
            <h3><?php echo lang('list_of_subheading')?>&nbsp;<span class="semi-bold">Groups</span></h3> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">                            
                    <div class="grid-body no-border">
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <h4><?php echo lang('search_of_subheading')?>&nbsp;<span class="semi-bold">Groups</span></h4>
                            </div>
                        </div>
                        <?php echo form_open(site_url('auth/search_group'))?>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-3 search_label"><?php echo form_label('Group Name','first_name')?></div>
                                        <div class="col-md-9"><?php echo bs_form_input($fname_search)?></div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-info"><i class="icon-search"></i>&nbsp;<?php echo lang('search_button')?></button>
                                            
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        <?php echo form_close()?>
                        <a href="<?php echo site_url('auth/create_group')?>"><button type="button" class="btn btn-primary btn-lg"><i class="icon-plus"></i>&nbsp;<?php echo lang('add_button');?></button></a>
                        <button type="button" class="btn" data-toggle="modal" data-target="#modal_upload"><span><i class="icon-upload"></i> Import <i class="fa fa-download"></i></span></button>
                        <br/>
                        <div <?php ( ! empty($message)) && print('class="alert alert-info text-center"'); ?> id="infoMessage"><?php echo $message;?></div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="1%">
                                        <div class="checkbox check-default">
                                            <input id="checkbox10" type="checkbox" value="1" class="checkall">
                                            <label for="checkbox10"></label>
                                        </div>
                                    </th>
                                    <th width="15%"><?php echo 'Group Name';?></th>
                                    <th width="15%"><?php echo 'Description'?></th>
                                    <th width="10%">Bussiness Unit</th>
                                    <th width="10%">Type</th>
                                    <th width="5%"><?php echo lang('index_action_th');?></th>                                  
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($groups as $user):?>
                                <tr>
                                    <td valign="middle">
                                         <div class="checkbox check-default">
                                            <input id="checkbox11" type="checkbox" value="1">
                                            <label for="checkbox11"></label>
                                        </div>
                                    </td>
                                    <td valign="middle"><?php echo $user->name;?></td>
                                    <td valign="middle"><?php echo $user->description;?></td>
                                    <!-- <td valign="middle"><span class="muted"><?php echo $user->last_name;?></span></td> -->
                                    <td valign="middle"><span class="muted"><?php echo get_bu_name($user->bu);?></span></td>
                                    <td valign="middle"><span class="muted"><?php 
                                        $type_inventory = ($user->type_inventory_id != 0) ? "($user->type_inventory)" : '';
                                        echo $user->admin_type.$type_inventory;?></span></td>
                                    <td valign="middle">
                                        <a href="<?php echo site_url('auth/edit_group/'.$user->id)?>"><button type="button" class="btn btn-info btn-small"   title="<?php echo lang('edit_button')?>"><i class="icon-edit"></i></button></a>
                                        <button class='btn btn-danger btn-small' type="button" value="Delete" data-toggle="modal" data-target="#deleteGroupModal<?php echo $user->id?>" title="<?php echo lang('delete_button')?>"><i class="icon-warning-sign"></i></button>
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
                                    echo '&nbsp;'.lang('found_subheading').'&nbsp;'.$num_rows_all.'&nbsp;'.'Groups';
                                ?>
                                <?php echo form_close();?>
                            </div>
                            <div class="col-md-10">
                                <ul class="pagination">
                                    <?php echo $halaman;?>
                                </ul>
                            </div>
                        </div>

<?php foreach ($groups as $user):?>
<!--Delete Modal-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="deleteGroupModal<?php echo $user->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('delete_confirmation').' for '.$user->name; ?></h4>
        </div>
      <form id="formDel<?php echo $user->id?>">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">
        <input type="hidden" name="id" value="<?php echo $user->id?>" />
        <p><?php echo lang('delete_this_data').$user->name.' ?'; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="icon-ban-circle"></i>&nbsp;<?php echo lang('cancel_button')?></button> 
        <button id="btnDel<?php echo $user->id?>" class="btn btn-danger" style="margin-top: 3px;"><i class="icon-warning-sign"></i>&nbsp;<?php echo lang('delete_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>
<script src="<?php echo assets_url('js/jquery-1.8.3.min.js'); ?>"></script>
<script type="text/javascript">
<?php foreach ($groups as $user):?>
    $("#btnDel<?php echo $user->id?>").click(function(){
        var $btn = $(this).button('loading');
        $("#formDel<?php echo $user->id?>").submit(function(ev){
            $.ajax({
                type: 'POST',
                url: 'http://localhost/hris_client/auth/delete_group',
                data: $("#formDel<?php echo $user->id?>").serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });
<?php endforeach; ?>
</script>

<!-- Upload excel modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_upload" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Import Data User Group</h3>
            </div>
            <?php echo form_open_multipart(base_url().'auth/upload_excel', array('id'=>'form_upload', 'class'=>'form-horizontal'));?>
            <div class="modal-body form">
                <div class="form-body">
                <div class="row form-row">
                    <div class="col-md-12 pull-right" style="margin: 10px 0px 20px 0px;" ><i class="fa fa-warning-sign" style="color:red ;text-shadow: 1px 1px 1px #ccc;font-size: 1em;"> Pastikan file berformat XLS/XLSX dan format tabel sesuai dengan template yang sudah disediakan.</i>
                    </div>
                </div>
                <div class="row form-row">
                    <div class="col-md-12 pull-right" style="margin: 10px 0px 20px 0px;" ><i class="fa fa-warning-sign" style="font-size: 1em;"> <a href="<?= assets_url('users_groups_upload_template.xls')?>">Download Template Upload User Group</i></a>
                    </div>
                </div>
                <div class="row form-row">
                    <div class="col-md-12">
                        <div class="col-md-3 pull-left"><b>Upload File</b></div>
                        <div class="col-md-9">
                            <input name="userfile" multiple="" type="file">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="upload">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

