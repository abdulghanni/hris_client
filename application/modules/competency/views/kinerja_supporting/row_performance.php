<tr>
	<td><?=$id?></td>
	<td>
		<input type="text" class="form-control" name="aspek_performance[]" placeholder="isi Aspek Penilaian
Performance disini.....">
	</td>
	<td>
		<input type="text" id="bobot_performance<?=$id?>" class="form-control text-right bobot_performance" name="bobot_performance[]" placeholder="....." onkeyup="hitungPerformance('<?=$id?>')" min="0"  max="100"  value="0">
	</td>
	<td>
		<input type="text" id="target_performance<?=$id?>" class="form-control text-right target_performance" name="target_performance[]" placeholder="....." onkeyup="hitungPerformance('<?=$id?>')" min="0"  max="100"  value="0">
	</td>
	<td>
		<input type="text" id="nilai_performance<?=$id?>" class="form-control text-right nilai_performance" name="nilai_performance[]" placeholder="....." min="0" max="100" value="0" onkeyup="hitungPerformance('<?=$id?>')">
	</td>
	<td>
		<input type="text" id="persentase_performance<?=$id?>" class="form-control text-right persentase_performance" name="persentase_performance[]" placeholder="....." readonly="readonly" value="0">
	</td>
</tr>