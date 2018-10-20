<tr>
	<td><?=$id?></td>
	<td>
		<input type="text" class="form-control" name="aspek_kompetensi[]" placeholder="isi Aspek Penilaian
kompetensi disini.....">
	</td>
	<td>
		<input type="text" id="bobot_kompetensi<?=$id?>" class="form-control text-right bobot_kompetensi" name="bobot_kompetensi[]" placeholder="....." onkeyup="hitungkompetensi('<?=$id?>')" min="0"  max="100"  value="0">
	</td>
	<td>
		<input type="text" id="target_kompetensi<?=$id?>" class="form-control text-right target_kompetensi" name="target_kompetensi[]" placeholder="....." onkeyup="hitungkompetensi('<?=$id?>')" min="0"  max="100"  value="0">
	</td>
	<td>
		<input type="text" id="nilai_kompetensi<?=$id?>" class="form-control text-right nilai_kompetensi" name="nilai_kompetensi[]" placeholder="....." min="0" max="100" value="0" onkeyup="hitungkompetensi('<?=$id?>')">
	</td>
	<td>
		<input type="text" id="persentase_kompetensi<?=$id?>" class="form-control text-right persentase_kompetensi" name="persentase_kompetensi[]" placeholder="....." readonly="readonly" value="0">
	</td>
</tr>