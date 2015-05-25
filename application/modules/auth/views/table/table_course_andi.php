
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="1%">
                <div class="checkbox check-default">
                    <input id="checkbox10" type="checkbox" value="1" class="checkall">
                    <label for="checkbox10"></label>
                </div>
            </th>
            <!-- <th width="10%"><?php //echo anchor('auth/detail/'.$user->id.'/'.$ctitle_param.'/course_title/'.(($sort_order == 'asc' && $sort_by == 'course_title') ? 'desc' : 'asc'), lang('course_description'));?></th> -->
            <th width="10%"><?php echo 'Description'//anchor('auth/index/'.$fname_param.'/'.$email_param.'/last_name/'.(($sort_order == 'asc' && $sort_by == 'last_name') ? 'desc' : 'asc'), lang('index_lname_th'));?></th>
            <th width="10%"><?php echo 'Registration Date'//anchor('auth/index/'.$fname_param.'/'.$email_param.'/email/'.(($sort_order == 'asc' && $sort_by == 'email') ? 'desc' : 'asc'), lang('index_email_th'));?></th>
            <th width="10%"><?php echo 'Status';?></th>
            <th width="10%"><?php echo lang('index_action_th');?></th>                                  
        </tr>
    </thead>
    <tbody id="tabel">
    <?php if ($user_course->num_rows() > 0){
                foreach($user_course->result() as $row){?>
        <tr>
            <td valign="middle">
                 <div class="checkbox check-default">
                    <input id="checkbox<?php echo $row->id;?>" type="checkbox" value="<?php echo $row->id;?>">
                    <label for="checkbox<?php echo $row->id;?>"></label>
                </div>
            </td>


            <!-- <td valign="middle"><?php echo $row->id;?></td> -->
            <td valign="middle"><span class="muted"><?php echo $row->description;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->registration_date;?></span></td>
            <td valign="middle"><span class="muted"><?php echo $row->status;?></span></td>
            <td valign="middle">
                <button type="button" class="btn btn-info btn-small" data-toggle="modal" data-target="#editCourseModal<?= $row->id?>"><i class="icon-paste"></i>&nbsp;<?php echo lang('edit_button')?></button>
                <button class='btn btn-danger btn-small' type="submit" name="remove_levels" value="Delete" data-toggle="modal" data-target="#deleteCourseModal<?php echo $row->id?>"><i class="icon-warning-sign"></i>&nbsp;<?php echo lang('delete_button')?></button>
            </td>

        </tr>
    <?php }}else{?>
        <tr>
            <td valign="middle" colspan="5">
                <p class="text-center">No Data</p>
            </td>
           <!--  <td valign="middle">
                 <div class="checkbox check-default">
                    <input id="checkbox11" type="checkbox" value="1">
                    <label for="checkbox11"></label>
                </div>
            </td>
            <td valign="middle">No Data</td>
            <td valign="middle"><span class="muted">No Data</span></td>
            <td valign="middle"><span class="muted">No Data</span></td>
            <td valign="middle"><span class="muted">No Data</span></td>
            <td valign="middle">
                No Data
            </td> -->
        </tr>

    <?php } ?>

    </tbody>
</table>
<!-- <div class="row">
    <div class="col-md-6">
        <h4><?php echo lang('found_subheading')?>&nbsp;<span class="semi-bold"><?php echo $num_rows_course;?>&nbsp;<?php echo lang('course_subheading');?></span></h4>  
    </div>
    
</div> -->