
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="1%">
                <div class="checkbox check-default">
                    <input id="checkbox10" type="checkbox" value="1" class="checkall">
                    <label for="checkbox10"></label>
                </div>
            </th>
            <th width="10%"><?php echo anchor('position/index/'.$ftitle_param.'/title/'.(($sort_order == 'asc' && $sort_by == 'title') ? 'desc' : 'asc'), lang('index_ftitle_th'));?></th>
            <th width="10%"><?php echo anchor('position/index/'.$ftitle_param.'/abbr/'.(($sort_order == 'asc' && $sort_by == 'abbr') ? 'desc' : 'asc'), lang('abbrevation'));?></th>
            <th width="10%"><?php echo anchor('position/index/'.$ftitle_param.'/position_group/'.(($sort_order == 'asc' && $sort_by == 'position_group') ? 'desc' : 'asc'), lang('position_group'));?></th>
			<th width="10%"><?php echo anchor('position/index/'.$ftitle_param.'/position_parent/'.(($sort_order == 'asc' && $sort_by == 'position_parent') ? 'desc' : 'asc'), lang('position_parent'));?></th>
			<th width="10%"><?php echo anchor('position/index/'.$ftitle_param.'/organization/'.(($sort_order == 'asc' && $sort_by == 'organization') ? 'desc' : 'asc'), lang('organization'));?></th>
			<th width="10%"><?php echo anchor('position/index/'.$ftitle_param.'/description/'.(($sort_order == 'asc' && $sort_by == 'description') ? 'desc' : 'asc'), lang('description'));?></th>
			<th width="10%"><?php echo lang('index_action_th');?></th>                                  
        </tr>
    </thead>
    <tbody>
        <?php if($_num_rows > 0) { ?>
            <?php foreach ($position as $user):?>
                <tr>
                    <td valign="middle">
                         <div class="checkbox check-default">
                            <input id="checkbox11" type="checkbox" value="1">
                            <label for="checkbox11"></label>
                        </div>
                    </td>
                    <td valign="middle"><?php echo $user->title;?></td>
                    <td valign="middle"><?php echo $user->abbr;?></td>
                    <td valign="middle"><?php echo $user->position_group;?></td>
                    <td valign="middle"><?php echo $user->position_parent;?></td>
                    <td valign="middle"><?php echo $user->organization;?></td>
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