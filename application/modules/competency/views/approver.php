<tr>
	<td><?=$id?></td>
	<td>Nama Approver</td>
	<td>
		<select class="select2" name="approver_id[]" style="width:100%">
			<option value="0">-- Pilih Approver --</option>
			<?php foreach ($users as $u) {
				echo '<option value="'.$u->id.'">'.get_name($u->id).'</option>';
			}?>
		</select>
	</td>
</tr>