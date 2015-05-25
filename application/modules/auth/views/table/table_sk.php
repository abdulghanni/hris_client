<script src="<?php echo assets_url('js/edit_user.js'); ?>"></script>
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="1%">
                <div class="checkbox check-default">
                    <input id="checkbox10" type="checkbox" value="1" class="checkall">
                    <label for="checkbox10"></label>
                </div>
            </th>
            <!-- <th width="10%"><?php //echo anchor('auth/detail/'.$user->id.'/'.$ctitle_param.'/sk_title/'.(($sort_order == 'asc' && $sort_by == 'sk_title') ? 'desc' : 'asc'), lang('sk_description'));?></th> -->
            <th width="10%"><?php echo lang('sk_date')//anchor('auth/index/'.$fname_param.'/'.$email_param.'/last_name/'.(($sort_order == 'asc' && $sort_by == 'last_name') ? 'desc' : 'asc'), lang('index_lname_th'));?></th>
            <th width="10%"><?php echo lang('sk_no')//anchor('auth/index/'.$fname_param.'/'.$email_param.'/email/'.(($sort_order == 'asc' && $sort_by == 'email') ? 'desc' : 'asc'), lang('index_email_th'));?></th>
            <th width="10%"><?php echo lang('position');?></th>
            <th width="10%"><?php echo lang('departement');?></th>
            <th width="10%"><?php echo lang('effective_date');?></th>
            <th width="10%"><?php echo lang('location');?></th>
            <th width="5%"><?php echo lang('sign_name');?></th>
            <th width="10%"><?php echo lang('sign_position');?></th>
            <th width="20%"><?php echo lang('index_action_th');?></th>                                  
        </tr>
    </thead>
    <tbody>
        <?php if ($user_sk->num_rows() > 0){
        foreach($user_sk->result() as $row){?>
        <tr>
            <td valign="middle">
                <div class="checkbox check-default">
                    <input id="checkbox<?php echo $row->id;?>" type="checkbox" value="<?php echo $row->id;?>">
                    <label for="checkbox<?php echo $row->id;?>"></label>
                </div>
            </td>
            <!--<td valign="middle"><?php echo $row->id;?></td>-->
            <td valign="middle"><span class="muted"><?php echo $row->sk_date;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->sk_no;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->position;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->departement;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->effective_date;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->location;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->sign_name;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->sign_position;?></span></td>
            <td valign="middle">
                <button type="button" class="btn btn-info btn-small" data-toggle="modal" data-target="#editskModal<?php echo $row->id?>" title="<?php echo lang('edit_button')?>"><i class="icon-paste"></i></button>
                <button class='btn btn-danger btn-small' type="submit" name="remove_levels" value="Delete" data-toggle="modal" data-target="#deleteskModal<?php echo $row->id?>" title="<?php echo lang('delete_button')?>"><i class="icon-warning-sign"></i></button>
            </td>
        </tr>
        <?php }}else{?>
        <tr>
            <td valign="middle" colspan="5">
                <p class="text-center">No Data</p>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<!--Delete Modal Window-->
<?php foreach($user_sk->result() as $row){?>
<div class="modal fade" id="deleteskModal<?php echo $row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('delete_confirmation').' for '.$row->sk_no; ?></h4>
        </div>
      <?php echo form_open('auth/delete_sk/'.$row->id, array("id"=>"formdelete".$row->id))?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">
        <p><?php echo lang('delete_this_data').$row->sk_no.' ?'; ?></p>
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="icon-ban-circle"></i>&nbsp;<?php echo lang('cancel_button')?></button> 
            <button type="submit" class="btn btn-danger lnkBlkWhtArw" style="margin-top: 3px;"><i class="icon-warning-sign"></i>&nbsp;<?php echo lang('delete_button')?></button>
        </div>
        <?php echo form_close()?>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
 $('#formdelete<?php echo $row->id?>').submit(function(response){
                    $.post($('#formdelete<?php echo $row->id?>').attr('action'), $('#formdelete<?php echo $row->id?>').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad').text('Delete Failed').fadeIn();
                        }else{
                            getTable();
                            $("[data-dismiss=modal]").trigger({ type: "click" });
                            $('#MsgGood').text('Data Deleted').fadeIn().delay(4000).fadeOut("slow");
                        }
                    }, 'json');
                    return false;
                });
            });
</script>
<?php } ?>

<!--Edit Modal-->
<?php foreach($user_sk->result() as $row){?>
<?php echo form_open('auth/edit_sk/'.$row->id, array('id'=>'formupdate'.$row->id))?> 
<div class="modal fade" id="editskModal<?php echo $row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('edit_sk', 'edit_sk')?></h4>
            <p class="txtBold txtRed" class="error_msg" id="MsgBad<?php echo $row->id?>" style="background: #fff; display: none;"></p>
        </div>
            <div class="modal-body">
                
                <div class="row form-row">

                    <div class="col-md-3">
                        <?php echo lang('sk_date', 'sk_date');?>
                    </div>
                    <div class="col-md-9">
                            <div class="input-with-icon right">
                                <div class="input-append success date no-padding">
                                    <input type="text" class="form-control" name="sk_date" value="<?php echo $row->sk_date?>">
                                    <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
                            </div>
                    </div>

                    <div class="col-md-3">
                        <?php echo lang('sk_no', 'sk_no');?>
                    </div>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="sk_no" value="<?php echo $row->sk_no?>">
                    </div>

                    <div class="col-md-3">
                            <?php echo lang('position', 'position');?>
                        </div>
                        <div class="col-md-9">
                            <select name="position_id" class="select2" id="position_id" style="width:100%">
                                <?php
                                    foreach ($position->result_array() as $key => $value) {
                                    $selected = ($row->position_id <> 0 && $row->position_id == $value['id']) ? 'selected = selected' : '';
                                    echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                    }
                                    ?>
                            </select>        
                        </div>

                        <div class="col-md-3">
                            <?php echo lang('departement', 'departement');?>
                        </div>
                        <div class="col-md-9">
                            <select name="departement_id" class="select2" id="departement_id" style="width:100%">
                                <?php
                                    if($q_departement->num_rows() > 0){ 
                                    foreach ($departement->result_array() as $key => $value) {
                                    $selected = ($row->departement_id <> 0 && $row->departement_id == $value['id']) ? 'selected = selected' : '';
                                    echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                    }}else{
                                    echo '<option value="0">'.'No Data'.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    <div class="col-md-3">
                        <?php echo lang('effective_date', 'effective_date');?>
                    </div>
                    <div class="col-md-9">
                            <div class="input-with-icon right">
                                <div class="input-append success date no-padding">
                                    <input type="text" class="form-control" name="effective_date" value="<?php echo $row->effective_date?>">
                                    <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
                            </div>
                    </div>

                    <div class="col-md-3">
                        <?php echo lang('location', 'location');?>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="location" value="<?php echo $row->location?>">         
                    </div>

                    <div class="col-md-3">
                        <?php echo lang('sign_name', 'sign_name');?>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="sign_name" value="<?php echo $row->sign_name?>">         
                    </div>

                    <div class="col-md-3">
                        <?php echo lang('sign_position', 'sign_position');?>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="sign_position" value="<?php echo $row->sign_position?>">         
                    </div>
                </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
                <button type="submit" class="btn btn-primary lnkBlkWhtArw" style="margin-top: 3px;"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        
    </div>
  </div>
</div>
<?php echo form_close()?>
<script type="text/javascript">
    $(document).ready(function(){
                $('#formupdate<?php echo $row->id?>').submit(function(response){
                    $.post($('#formupdate<?php echo $row->id?>').attr('action'), $('#formupdate<?php echo $row->id?>').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad2<?php echo $row->id?>').html(json.errors).fadeIn();
                        }else{
                            getTable();
                            $("[data-dismiss=modal]").trigger({ type: "click" });
                            $('#MsgBad2<?php echo $row->id?>').hide();
                            $('#MsgGood').text('Data Updated').fadeIn().delay(3000).fadeOut("slow");
                        }
                    }, 'json');
                    return false;
                });
                //$('#sk_status_id').select2();
            });
</script>
<?php } ?>