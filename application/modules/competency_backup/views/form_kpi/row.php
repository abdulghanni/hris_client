<tr>
	<td><?=$id?></td>
	<td>
		<select name="competency_level_id[]" class="select2" style="width:100%">
			<option>-- Pilih Kompetensi --</option>
			<?php foreach($com as $c){
				$competency_def = getValue('title', 'competency_def', array('id'=>'where/'.$c['competency_def_id']));
			?>
				<option value="<?=$c['id']?>"><?= $competency_def.' - Level '.$c['level']?></option>
			<?php } ?>
		</select>
	</td>
	<td>
		<textarea class="form-control" name="indikator[]"></textarea>
	</td>
</tr>