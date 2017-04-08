<tr>
	<td>Atasan</td>
	<td><?=$id?></td>
	<td>
		<select class="select2" name="approver_id[]" style="width:100%">
			<option value="0">-- Pilih Atasan --</option>
			<?php foreach ($users as $u) {
				echo '<option value="'.$u->id.'">'.get_name($u->id).'</option>';
			}?>
		</select>
	</td>
</tr>