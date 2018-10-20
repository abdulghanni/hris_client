<tr>
<td class="cek">
    <input type="checkbox" id="row<?=$id?>" value="" class="cek" name="row">
</td>
<td>
	<select class="select2 form-control" name="inventory_id[]">
	<?php foreach ($item as $r) {?>
		<option value="<?=$r->id?>"><?=$r->title?></option>
	<?php } ?>
	</select>
</td>
<td><input type="text" class="form-control note" name="note[]"></td>
</tr>