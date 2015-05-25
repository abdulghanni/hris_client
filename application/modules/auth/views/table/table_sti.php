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
            <!--<th width="10%"><?php //echo anchor('auth/detail/'.$user->id.'/'.$ctitle_param.'/sti_title/'.(($sort_order == 'asc' && $sort_by == 'sti_title') ? 'desc' : 'asc'), lang('sti_description'));?></th> -->
            <!--<th width="2%"><?php echo lang('identity_no')//anchor('auth/index/'.$fname_param.'/'.$email_param.'/last_name/'.(($sort_order == 'asc' && $sort_by == 'last_name') ? 'desc' : 'asc'), lang('index_lname_th'));?></th>-->
            <th width="10%"><?php echo lang('ijazah_name')//anchor('auth/index/'.$fname_param.'/'.$email_param.'/email/'.(($sort_order == 'asc' && $sort_by == 'email') ? 'desc' : 'asc'), lang('index_email_th'));?></th>
            <!--<th width="2%"><?php echo lang('ijazah_number');?></th>-->
            <!--<th width="2%"><?php echo lang('ijazah_history');?></th>-->
            <th width="10%"><?php echo lang('institution')?></th>
            <th width="10%"><?php echo lang('activation_date')?></th>
            <!--<th width="2%"><?php echo lang('published_place')?></th>-->
            <th width="10%"><?php echo lang('position');?></th>
            <!--<th width="2%"><?php echo lang('receivedby');?></th>-->
            <!--<th width="2%"><?php echo lang('acknowledgeby');?></th>-->
            <th width="12%"><?php echo lang('index_action_th');?></th>                                  
        </tr>
    </thead>
    <tbody id="tabel">
        <?php if ($user_sti->num_rows() > 0){
        foreach($user_sti->result() as $row){?>
        <tr>
            <td valign="middle">
                <div class="checkbox check-default">
                    <input id="checkbox<?php echo $row->id;?>" type="checkbox" value="<?php echo $row->id;?>">
                    <label for="checkbox<?php echo $row->id;?>"></label>
                </div>
            </td>
            <!--<td valign="middle"><?php echo $row->id;?></td>-->
            <!--<td valign="middle"><span class="muted"><?php echo $row->identity_no;?></span></td>-->
            <td valign="middle"><span class="muted"><?php echo $row->ijazah_name;?></span></td>
            <!--<td valign="middle"><span class="muted"><?php echo $row->ijazah_number;?></span></td>-->
            <!--<td valign="middle"><span class="muted"><?php echo $row->ijazah_history;?></span></td>-->
            <td valign="middle"><span class="muted"><?php echo $row->institution;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->activation_date;?></span></td>
           <!-- <td valign="middle"><span class="muted"><?php echo $row->published_place;?></span></td>-->
            <td valign="middle"><span class="muted"><?php echo $row->position;?></span></td>
            <!--<td valign="middle"><span class="muted"><?php echo $row->receivedby;?></span></td>-->
            <!--<td valign="middle"><span class="muted"><?php echo $row->acknowledgeby;?></span></td>-->
            <td valign="middle">
                <button type="button" class="btn btn-info btn-small" data-toggle="modal" data-target="#editstiModal<?php echo $row->id?>" title="<?php echo lang('edit_button')?>"><i class="icon-paste"></i></button>
                <button class='btn btn-danger btn-small' type="submit" name="remove_levels" value="Delete" data-toggle="modal" data-target="#deletestiModal<?php echo $row->id?>" title="<?php echo lang('delete_button')?>"><i class="icon-warning-sign"></i></button>
            </td>
        </tr>
        <?php }}else{?>
        <tr>
            <td valign="middle" colspan="12">
                <p class="text-center">No Data</p>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php foreach($user_sti->result() as $row){?>
<!--Edit Modal-->

<div class="modal fade" id="editstiModal<?php echo $row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <?php echo form_open('auth/edit_sti/'.$row->id, array('id'=>'formupdate'.$row->id))?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('edit_sti', 'edit_sti')?></h4>
            </div>
                <p class="error_msg" id="MsgBad2<?php echo $row->id?>" style="background: #fff; display: none;"></p>
            <div class="modal-body">
                
                <div class="row form-row">
                      <div class="col-md-3">
                        <?php echo lang('identity_no', 'identity_no');?>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="identity_no" value="<?php echo $row->identity_no?>">         
                        </div>

                        <div class="col-md-3">
                            <?php echo lang('ijazah_name', 'ijazah_name');?>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="ijazah_name" value="<?php echo $row->ijazah_name?>">         
                        </div>

                        <div class="col-md-3">
                            <?php echo lang('ijazah_number', 'ijazah_no');?>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="ijazah_no" value="<?php echo $row->ijazah_number?>">         
                        </div>

                        <div class="col-md-3">
                            <?php echo lang('ijazah_history', 'ijazah_history');?>
                        </div>
                         <div class="col-md-9">
                            <input type="text" class="form-control" name="ijazah_history" value="<?php echo $row->ijazah_history?>">         
                        </div>

                        <div class="col-md-3">
                            <?php echo lang('institution', 'institution');?>
                        </div>
                         <div class="col-md-9">
                            <input type="text" class="form-control" name="institution" value="<?php echo $row->institution?>">         
                        </div>

                        <div class="col-md-3">
                            <?php echo lang('published_place', 'published_place');?>
                        </div>
                         <div class="col-md-9">
                            <input type="text" class="form-control" name="published_place" value="<?php echo $row->published_place?>">         
                        </div>

                        <div class="col-md-3">
                            <?php echo lang('activation_date', 'activation_date');?>
                        </div>
                        <div class="col-md-9">
                                <div class="input-with-icon right">
                                    <div class="input-append success date no-padding">
                                        <input type="text" class="form-control" name="activation_date" value="<?php echo $row->activation_date?>">
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
                                    foreach ($position->result_array() as $key => $value) {
                                    $selected = ($row->position_id <> 0 && $row->position_id == $value['id']) ? 'selected = selected' : '';
                                    echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                    }
                                    ?>
                            </select>        
                        </div>

                        <div class="col-md-3">
                            <?php echo lang('receivedby', 'received_by');?>
                        </div>
                        <div class="col-md-9">
                            <select name="receivedby_id" class="select2" id="receivedby_id" style="width:100%">
                                <?php
                                    foreach ($receivedby->result_array() as $key => $value) {
                                    $selected = ($row->receivedby_id <> 0 && $row->receivedby_id == $value['id']) ? 'selected = selected' : '';
                                    echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['first_name'].'</option>';
                                    }
                                    ?>
                                </select>        
                        </div>

                        <div class="col-md-3">
                            <?php echo lang('acknowledgeby', 'acknowledgeby');?>
                        </div>
                        <div class="col-md-9">
                            <select name="acknowledgeby_id" class="select2" id="acknowledgeby_id" style="width:100%">
                                <?php
                                    foreach ($acknowledgeby->result_array() as $key => $value) {
                                    $selected = ($row->acknowledgeby_id <> 0 && $row->acknowledgeby_id == $value['id']) ? 'selected = selected' : '';
                                    echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['first_name'].'</option>';
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

        <?php echo form_close()?>  
</div>
 
<!-- End Edit Modal-->

<!--Delete Modal-->
<div class="modal fade" id="deletestiModal<?php echo $row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('delete_confirmation').' for '.$row->ijazah_name; ?></h4>
        </div>
      <?php echo form_open('auth/delete_sti/'.$row->id, array("id"=>"formdelete".$row->id))?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">
        <p><?php echo lang('delete_this_data').$row->ijazah_name.' ?'; ?></p>
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
                $('#position_id').select2();
            });

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
<script type="text/javascript">
    $(document).ready(function(){
    $("#order").click(function(){
      $('#tabel').load('<?php echo base_url()?>'+'auth/get_sti/'+1+'/'+0+'/desc');
    });
});
</script>