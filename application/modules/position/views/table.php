<table class="table table-bordered">
  <thead>
      <tr>
          <th width="1%">
              <div class="checkbox check-default">
                  <input id="checkbox10" type="checkbox" value="1" class="checkall">
                  <label for="checkbox10"></label>
              </div>
          </th>
         <th width="10%">Position ID</th>
          <th width="10%">Description</th>
          <th width="10%">Position Group</th>
    <th width="10%">Position Type</th>
    <th width="10%">Departement</th>
    <!-- <th width="10%"><?php echo anchor('position/index/'.$ftitle_param.'/description/'.(($sort_order == 'asc' && $sort_by == 'description') ? 'desc' : 'asc'), lang('description'));?></th> -->
    <th width="10%"><?php echo lang('index_action_th');?></th>                                  
      </tr>
  </thead>
  <tbody>
  	<?php foreach ($position as $p) {?>
  		<tr>
  			<td valign="middle">
                 <div class="checkbox check-default">
                    <input id="checkbox11" type="checkbox" value="1">
                    <label for="checkbox11"></label>
                </div>
            </td>
            <td><?= $p['ID']?></td>
            <td><?= $p['DESCRIPTION']?></td>
            <td><?= $p['POSITIONGROUP']?></td>
            <td><?= $p['TYPE']?></td>
            <td><?= get_organization_name($id)?></td>
            <td valign="middle">
                <button type="button" class="btn btn-info btn-small" data-toggle="modal" data-target="#editModal" title="<?php echo lang('edit_button')?>"><i class="icon-paste"></i></button>
                <button class='btn btn-danger btn-small' type="button" name="remove_levels" value="Delete" data-toggle="modal" data-target="#deleteModal<?php echo $p['ID']?>" title="<?php echo lang('delete_button')?>"><i class="icon-warning-sign"></i></button>   
            </td>
  		</tr>
  	<?php } ?>
  </tbody>
</table>