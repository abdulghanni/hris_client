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
            <!--<th width="2%"><?php //echo anchor('auth/detail/'.$user->id.'/'.$ctitle_param.'/experience_title/'.(($sort_order == 'asc' && $sort_by == 'experience_title') ? 'desc' : 'asc'), lang('experience_description'));?></th>-->
            <th width="10%"><?php echo 'Company'//anchor('auth/index/'.$fname_param.'/'.$email_param.'/last_name/'.(($sort_order == 'asc' && $sort_by == 'last_name') ? 'desc' : 'asc'), lang('index_lname_th'));?></th>
            <th width="10%"><?php echo 'Position'//anchor('auth/index/'.$fname_param.'/'.$email_param.'/email/'.(($sort_order == 'asc' && $sort_by == 'email') ? 'desc' : 'asc'), lang('index_email_th'));?></th>
            <th width="10%"><?php echo 'Start Date';?></th>
            <th width="10%"><?php echo 'End Date';?></th>
            <th width="10%"><?php echo 'address';?></th>
            <th width="10%"><?php echo 'Line OF Business';?></th>
            <th width="5%"><?php echo 'Resign Reason';?></th>
            <th width="10%"><?php echo 'Last Salary';?></th>
            <th width="20%"><?php echo lang('index_action_th');?></th>                                  
        </tr>
    </thead>
    <tbody id="tabel">
        <?php if ($user_experience->num_rows() > 0){
        foreach($user_experience->result() as $row){?>
        <tr>
            <td valign="middle">
            <div class="checkbox check-default">
                <input id="checkbox<?php echo $row->id;?>" type="checkbox" value="<?php echo $row->id;?>">
                <label for="checkbox<?php echo $row->id;?>"></label>
            </div>
            </td>
            <!--<td valign="middle"><?php echo $row->id;?></td>-->
            <td valign="middle"><span class="muted"><?php echo $row->company;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->position;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->start_date;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->end_date;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->address;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->line_business;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->resign_reason;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->last_salary;?></span></td>
            <td valign="middle">
                <button type="button" class="btn btn-info btn-small" data-toggle="modal" data-target="#editexperienceModal<?php echo $row->id?>" title="<?php echo lang('edit_button')?>"><i class="icon-paste"></i></button>
                <button class='btn btn-danger btn-small' type="submit" name="remove_levels" value="Delete" data-toggle="modal" data-target="#deleteexperienceModal<?php echo $row->id?>" title="<?php echo lang('delete_button')?>"><i class="icon-warning-sign"></i></button>
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

<!--Delete Modal Window-->
<?php foreach($user_experience->result() as $row){?>
<div class="modal fade" id="deleteexperienceModal<?php echo $row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('delete_confirmation').' for '.$row->company; ?></h4>
        </div>
      <?php echo form_open('auth/delete_experience/'.$row->id, array("id"=>"formdelete".$row->id))?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">
        <p><?php echo lang('delete_this_data').$row->company.' ?'; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="icon-ban-circle"></i>&nbsp;<?php echo lang('cancel_button')?></button> 
        <button type="submit" class="btn btn-danger lnkBlkWhtArw" name="btn_update" id="btnRetPass" style="margin-top: 3px;"><i class="icon-warning-sign"></i>&nbsp;<?php echo lang('delete_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
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
<?php foreach($user_experience->result() as $row){?>
<div class="modal fade" id="editexperienceModal<?php echo $row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<?php echo form_open('auth/edit_experience/'.$row->id, array('id'=>'formupdate'.$row->id))?> 
  <div class="modal-dialog" id="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('edit_experience', 'edit_experience')?></h4>
        <p class="txtBold txtRed" class="error_msg" id="MsgBad2<?php echo $row->id?>" style="background: #fff; display: none;"></p>
      </div>
      <div class="modal-body">
        <?php echo form_open('auth/edit_experience/'.$row->id, array('id'=>'formupdate'.$row->id))?> 
             <div class="row form-row">
                <div class="col-md-3">
                    <?php echo lang('company', 'company');?>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="company" value="<?php echo $row->company?>">         
                </div>

                <div class="col-md-3">
                    <?php echo lang('position', 'position');?>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="position" value="<?php echo $row->position?>">         
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
                    <?php echo lang('address', 'address');?>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="address" value="<?php echo $row->address?>">         
                </div>

                 <div class="col-md-3">
                    <?php echo lang('line_business', 'line_business');?>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="line_business" value="<?php echo $row->line_business?>">         
                </div>

                 <div class="col-md-3">
                    <?php echo lang('resign_reason', 'resign_reason');?>
                </div>
                <div class="col-md-9">
                    <select name="resign_reason_id" class="select2" id="resign_reason_id" style="width:100%">
                        <?php
                            foreach ($resign_reason->result_array() as $key => $value) {
                            $selected = ($row->resign_reason_id <> 0 && $row->resign_reason_id == $value['id']) ? 'selected = selected' : '';
                            echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                            }
                            ?>
                    </select>              
                </div>

                 <div class="col-md-3">
                    <?php echo lang('last_salary', 'last_salary');?>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="last_salary" value="<?php echo $row->last_salary?>">         
                </div>


            </div>
                                    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
                <button type="submit" class="btn btn-primary lnkBlkWhtArw" style="margin-top: 3px;"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
       
    </div>
  </div>
   <?php echo form_close()?>
</div>

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
                $('#resign_reason_id').select2();
            });
</script>
<?php } ?>