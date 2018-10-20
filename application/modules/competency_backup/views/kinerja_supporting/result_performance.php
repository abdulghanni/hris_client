<?php 
$no = 1;
$bobot_performance = 0;
$nilai_performance = 0;
$persentase_performance = 0;
foreach ($kpi_detail as $key => $value) { ?>
<tr>
	<td><?=$no?></td>
	<td>
		<input type="text" class="form-control" name="aspek_performance[]" placeholder="isi Aspek Penilaian
Performance disini....." value="<?php echo $value['kpi']?>">
	</td>
	<td>
		<input type="text" id="bobot_performance<?=$value['id']?>" class="form-control text-right bobot_performance" name="bobot_performance[]" placeholder="....." onkeyup="hitungPerformance('<?=$value['id']?>')" min="0"  max="100"  value="<?php echo $value['bobot_kpi']?>">
	</td>
	<td>
		<input type="text" id="target_performance<?=$value['id']?>" class="form-control text-right target_performance" name="target_performance[]" placeholder="....." onkeyup="hitungPerformance('<?=$value['id']?>')" min="0"  max="100"  value="<?php echo $value['target_kpi']?>">
	</td>
	<td>
		<input type="text" id="nilai_performance<?=$value['id']?>" class="form-control text-right nilai_performance" name="nilai_performance[]" placeholder="....." min="0" max="100" value="<?php echo $value['rata_rata']?>" onkeyup="hitungPerformance('<?=$value['id']?>')">
	</td>
	<td>
		<input type="text" id="persentase_performance<?=$value['id']?>" class="form-control text-right persentase_performance" name="persentase_performance[]" placeholder="....." readonly="readonly" value="<?php echo number_format((($value['bobot_kpi']/100)*$value['rata_rata']),2) ?>">
	</td>
</tr>
<?php 
	$no = $no+1;
	$bobot_performance = $bobot_performance + $value['bobot_kpi'];
	$nilai_performance = $nilai_performance + $value['rata_rata'];
	$persentase_performance = $persentase_performance + (($value['bobot_kpi']/100)*$value['rata_rata']);
	} 
?>
<tr>
	<td></td>
	<td>Subtotal Nilai Performance</td>
	<td><input class="form-control text-right" type="text" id="sub_total_bobot_performance" name="sub_total_bobot_performance" value="<?php echo $bobot_performance?>" readonly="readonly"></td>
	<td><input class="form-control text-right" type="text" id="sub_total_target_performance" name="sub_total_target_performance" value="<?php echo $target_performance?>" readonly="readonly"></td>
	<td><input class="form-control text-right" id="sub_total_nilai_performance" type="text" name="sub_total_nilai_performance" value="<?php echo $nilai_performance?>" readonly="readonly"></td>
	<td><input class="form-control text-right" id="sub_total_persentase_performance" type="text" name="sub_total_persentase_performance" readonly="readonly" value="<?php echo $nilai_performance?>" ></td>
</tr>

<!-- <tr>
	<td><?=$id?></td>
	<td>
		<input type="text" class="form-control" name="aspek_performance[]" placeholder="isi Aspek Penilaian
Performance disini.....">
	</td>
	<td>
		<input type="text" id="bobot_performance<?=$id?>" class="form-control text-right bobot_performance" name="bobot_performance[]" placeholder="....." onkeyup="hitungPerformance('<?=$id?>')" min="0"  max="100"  value="0">
	</td>
	<td>
		<input type="text" id="nilai_performance<?=$id?>" class="form-control text-right nilai_performance" name="nilai_performance[]" placeholder="....." min="0" max="100" value="0" onkeyup="hitungPerformance('<?=$id?>')">
	</td>
	<td>
		<input type="text" id="persentase_performance<?=$id?>" class="form-control text-right persentase_performance" name="persentase_performance[]" placeholder="....." readonly="readonly" value="0">
	</td>
</tr> -->