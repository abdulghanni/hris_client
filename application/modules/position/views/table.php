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
  	<?php foreach ($position as $p) {$p_id = $p['ID'];?>
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
                <a class="btn btn-sm btn-primary btn-mini" href="javascript:void(0)" title="Edit" onclick="edit_('<?=$p_id?>')"><i class="icon-edit"></i> Edit</a>
                <button class='btn btn-danger btn-small' type="button"  value="Delete" data-toggle="modal" href="javascript:void()" title="<?php echo lang('delete_button')?>"><i class="icon-warning-sign"></i></button>   
            </td>
  		</tr>
  	<?php } ?>
  </tbody>
</table>

<script type="text/javascript">
  function edit_(id)
    {
      save_method = 'update';
      var url = 'position/get_modal/'+id;
      $('#modal').load(url);
      
      //$('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string

      //Ajax Load data from ajax
      $.ajax({
        url : "position/ajax_edit/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $(document).find("select.select2").select2();
            $('[name="id"]').val(data.HRSPOSITIONID);
            $('[name="description"]').val(data.DESCRIPTION);
            $('[name="positiongroup"]').val(data.HRSPOSITIONGROUPID);
            $('[name="type"]').val(data.HRSPOSITIONTYPEID);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }
</script>