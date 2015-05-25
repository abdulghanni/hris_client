
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="1%">
                <div class="checkbox check-default">
                    <input id="checkbox10" type="checkbox" value="1" class="checkall">
                    <label for="checkbox10"></label>
                </div>
            </th>
            <th width="10%"><?php echo anchor('position_group/index/'.$ftitle_param.'/title/'.(($sort_order == 'asc' && $sort_by == 'title') ? 'desc' : 'asc'), lang('index_ftitle_th'));?></th>
            <th width="10%"><?php echo anchor('position_group/index/'.$ftitle_param.'/abbr/'.(($sort_order == 'asc' && $sort_by == 'abbr') ? 'desc' : 'asc'), lang('abbrevation'));?></th>
            <th width="10%"><?php echo anchor('position_group/index/'.$ftitle_param.'/level_order/'.(($sort_order == 'asc' && $sort_by == 'level_order') ? 'desc' : 'asc'), lang('level_order'));?></th>
            <th width="10%"><?php echo anchor('position_group/index/'.$ftitle_param.'/parent_position_group/'.(($sort_order == 'asc' && $sort_by == 'parent_position_group') ? 'desc' : 'asc'), lang('parent_position_group'));?></th>
            <th width="10%"><?php echo anchor('position_group/index/'.$ftitle_param.'/description/'.(($sort_order == 'asc' && $sort_by == 'description') ? 'desc' : 'asc'), lang('description'));?></th>
            <th width="10%"><?php echo lang('index_action_th');?></th>                                  
        </tr>
    </thead>
    <tbody>
        <?php if($_num_rows > 0) { ?>
            <?php foreach ($position_group as $user):?>
                <tr>
                    <td valign="middle">
                         <div class="checkbox check-default">
                            <input id="checkbox11" type="checkbox" value="1">
                            <label for="checkbox11"></label>
                        </div>
                    </td>
                    <td valign="middle"><?php echo $user->title;?></td>
                    <td valign="middle"><?php echo $user->abbr;?></td>
                    <td valign="middle"><?php echo $user->level_order;?></td>
                    <td valign="middle"><?php echo $user->parent_position_group;?></td>
                    <td valign="middle"><?php echo $user->description;?></td>
                    <td valign="middle">
                        <button type="button" class="btn btn-info btn-small" data-toggle="modal" data-target="#editModal<?php echo $user->id?>" title="<?php echo lang('edit_button')?>"><i class="icon-paste"></i></button>
                        
                        <button class='btn btn-danger btn-small' type="button" name="remove_levels" value="Delete" data-toggle="modal" data-target="#deleteModal<?php echo $user->id?>" title="<?php echo lang('delete_button')?>"><i class="icon-warning-sign"></i></button>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php }else{ ?>
                <tr>
                    <td valign="middle" colspan="3">
                        <p class="text-center">No Data</p>
                    </td>
                </tr>
        <?php } ?>
    </tbody>
</table>