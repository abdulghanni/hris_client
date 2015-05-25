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
             <!--<th width="2%"><?php //echo anchor('auth/detail/'.$user->id.'/'.$ctitle_param.'/education_title/'.(($sort_order == 'asc' && $sort_by == 'education_title') ? 'desc' : 'asc'), lang('education_description'));?></th>-->
            <th width="10%"><?php echo lang('education')//anchor('auth/index/'.$fname_param.'/'.$email_param.'/last_name/'.(($sort_order == 'asc' && $sort_by == 'last_name') ? 'desc' : 'asc'), lang('index_lname_th'));?></th>
            <th width="10%"><?php echo lang('description')//anchor('auth/index/'.$fname_param.'/'.$email_param.'/email/'.(($sort_order == 'asc' && $sort_by == 'email') ? 'desc' : 'asc'), lang('index_email_th'));?></th>
            <th width="10%"><?php echo lang('start_date');?></th>
            <th width="10%"><?php echo lang('end_date');?></th>
            <th width="10%"><?php echo lang('education_group');?></th>
            <th width="10%"><?php echo lang('education_degree');?></th>
            <th width="10%"><?php echo lang('institution');?></th>
            <th width="15%"><?php echo lang('index_action_th');?></th>                                  
        </tr>
    </thead>
    <tbody id="tabel">
        <?php if ($user_education->num_rows() > 0){
            foreach($user_education->result() as $row){?>
        <tr>
            <td valign="middle">
                <div class="checkbox check-default">
                    <input id="checkbox<?php echo $row->id;?>" type="checkbox" value="<?php echo $row->id;?>">
                    <label for="checkbox<?php echo $row->id;?>"></label>
                </div>
            </td>
            <!--<td valign="middle"><?php echo $row->id;?></td>-->
            <td valign="middle"><span class="muted"><?php echo $row->education;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->description;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->start_date;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->end_date;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->edu_group;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->degree;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->institution;?></span></td>
            <td valign="middle">
                <button type="button" class="btn btn-info btn-small" data-toggle="modal" data-target="#editeducationModal<?php echo $row->id?>" title="<?php echo lang('edit_button')?>"><i class="icon-paste"></i></button>
                <button class='btn btn-danger btn-small' type="submit" name="remove_levels" value="Delete" data-toggle="modal" data-target="#deleteeducationModal<?php echo $row->id?>" title="<?php echo lang('delete_button')?>"><i class="icon-warning-sign"></i></button>
            </td>
        </tr>
        <?php }}else{?>
        <tr>
            <td valign="middle" colspan="10">
                <p class="text-center">No Data</p>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php foreach($user_education->result() as $row){?>

<!--Edit MOdal-->
 <?php echo form_open('auth/edit_education/'.$row->id, array('id'=>'formupdate'.$row->id))?>
<div class="modal fade" id="editeducationModal<?php echo $row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('edit_education', 'edit_education')?></h4>
            </div>
                <p class="error_msg" id="MsgBad2<?php echo $row->id?>" style="background: #fff; display: none;"></p>
            <div class="modal-body"> 
                <div class="row form-row">
                    <div class="col-md-3">
                        <?php echo lang('education', 'education_title');?>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="title" id="education_title" value="<?php echo $row->education?>">         
                    </div>

                    <div class="col-md-3">
                        <?php echo lang('description', 'education_title');?>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="description" value="<?php echo $row->description?>">         
                    </div>


                    <div class="col-md-3">
                        <?php echo lang('start_date', 'start_date');?>
                    </div>
                    <div class="col-md-9">
                            <div class="input-with-icon right">
                                <div class="input-append success date no-padding">
                                    <input type="text" class="form-control" name="start_date" value="<?php echo $row->start_date?>">
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
                                    <input type="text" class="form-control" name="end_date" value="<?php echo $row->end_date?>">
                                    <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                </div>
                            </div>
                    </div>

                    <div class="col-md-3">
                        <?php echo lang('education_group', 'education_group');?>
                    </div>
                    <div class="col-md-9">
                        <select name="education_group_id" class="select2" id="education_group_id" style="width:100%">
                            <?php
                                if($q_education_group->num_rows() > 0){
                                foreach ($education_group->result_array() as $key => $value) {
                                $selected = ($row->education_group_id <> 0 && $row->education_group_id == $value['id']) ? 'selected = selected' : '';
                                echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                }}else{
                                    echo '<option value="0">'.'No Data'.'</option>';
                                }
                                ?>
                            </select>        
                    </div>

                    <div class="col-md-3">
                        <?php echo lang('education_degree', 'education_degree');?>
                    </div>
                    <div class="col-md-9">
                        <select name="education_degree_id" class="select2" id="education_degree_id" style="width:100%">
                             <?php  if($q_education_degree->num_rows() > 0){
                                foreach ($education_degree->result_array() as $key => $value) {
                                $selected = ($row->education_degree_id <> 0 && $row->education_degree_id == $value['id']) ? 'selected = selected' : '';
                                echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                }}else{
                                    echo '<option value="0">'.'No Data'.'</option>';
                                }
                            
                                ?>
                            </select>        
                    </div>

                    <div class="col-md-3">
                        <?php echo lang('institution', 'institution');?>
                    </div>
                    <div class="col-md-9">
                        <select name="education_center_id" class="select2" id="education_center_id" style="width:100%">
                            <?php
                                if($q_education_center->num_rows() > 0){
                                foreach ($education_center->result_array() as $key => $value) {
                                $selected = ($row->education_center_id <> 0 && $row->education_center_id == $value['id']) ? 'selected = selected' : '';
                                echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                }}else{ echo '<option value="0">'.'No Data'.'</option>';
                                }
                            ?>
                        </select>       
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
                //$('#education_status_id').select2();
            });

</script>

<!--Delete Modal-->
<div class="modal fade" id="deleteeducationModal<?php echo $row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('delete_confirmation').' for '.$row->description; ?></h4>
        </div>
      <?php echo form_open('auth/delete_education/'.$row->id, array("id"=>"formdelete".$row->id))?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">
        <p><?php echo lang('delete_this_data').$row->description.' ?'; ?></p>
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