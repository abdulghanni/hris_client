<?php if($competency_mapping_indikator->num_rows > 0){ ?>
<div class="table-responsive">
<table class="table table-bordered" width="100%">
	<thead>
		<tr>
			<td width="5%" rowspan="2">
				<div class="checkbox check-default">
                  <input id="checkbox" type="checkbox" value="0"> 
                  <label for="checkbox"></label>
                </div>
			</td>
			<td width="20%" rowspan="2">Kompetensi</td>
			<td width="5%" rowspan="2" class="text-center">Standar Komp. (SK)</td>
			<td width="5%" rowspan="2" class="text-center">Aktual Komp. (AK)</td>
			<td width="5%" rowspan="2" class="text-center">Score GAP (AK-SK)</td>
			<td width="60%" colspan="4" class="text-center">Program Improvement</td>
		</tr>
		<tr>
			<td width="15%" class="text-center">Tindakan</td>
			<td width="15%" class="text-center">Tanggal Pelaksanaan</td>
			<td width="15%" class="text-center">PIC</td>
			<td width="15%" class="text-center">Hasil</td>
		</tr>
	</thead>
	<tbody>
			<?php $i = 1;foreach($competency_group as $cg){
				$kompetensi = getAll('competency_def', array('comp_group_id'=>'where/'.$cg->id), array('id'=>$def_indikator));
			?>
				<tr>
					<th colspan="2" width="30%"><?= $cg->title ?></th>
				<?php $j = 1;foreach($kompetensi->result() as $k){
					$f = array('position_group_id'=>'where/'.$pos_group_id, 'competency_def_id'=>'where/'.$k->id);
					$sk = getValue('level', 'competency_mapping_standar_detail', $f);
				?>
				<tr>
					<td width="5%">
						<?=$j++?>
					</td>
					<td class="text-left" width="25%">
						<?=$k->title?>
						<input type="hidden" name="competency_def_id[]" value="<?=$k->id?>">		
					</td>
					<td class="text-center">
						<!-- <?=$sk?> -->
						<input type="text" id="sk<?=$k->id?>" name="sk[]" class="form-control text-center" value="<?=$sk?>" readonly>
					</td>
					<td>
						<select id="ak<?=$k->id?>" class="select2" name="ak[]" onchange='getGap("<?=$k->id?>")'>
							<?php for ($i=0; $i <=4 ; $i++) { 
								echo "<option value='$i'>$i</option>";
							}?>
						</select>
					</td>
					<td>
						<input id="gap<?=$k->id?>" type="text" name="gap[]" class="form-control text-center" value="0" readonly="readonly">
					</td>
					<td>
						<select id="" class="select2" name="competency_tindakan_id[]">
							<option value="0">-- Pilih Tindakan --</option>
							<?php foreach ($tindakan as $t) { 
								echo "<option value='$t->id'>$t->title</option>";
							}?>
						</select>
					</td>
					<td><input name="tgl[]" class="tanggal form-control" required></td>
					<td><input type="text" name="pic[]" class="form-control"></td>
					<td><input type="text" name="hasil[]" class="form-control"></td>
				</tr>
				<?php } ?>
			<?php } ?>
	</tbody>
</table>
<div>

<script type="text/javascript" src="<?=assets_url('js/bootstrap-datepicker.js')?>"></script>
<link rel="stylesheet" type="text/css" href="<?=assets_url('css/datepicker.css')?>">
<script type="text/javascript">
	function getGap(id){
		var sk = parseInt($("#sk"+id).val());
		var ak = parseInt($("#ak"+id).val());
		$("#gap"+id).val(ak-sk);
	}

	$(function() 
	{
		$('.tanggal')
		.datepicker({
			todayHighlight: true,
			autoclose: true,
			format: "yyyy-mm-dd"
		});
	});
</script>
<?php }else{ ?> 
	<label class="label label-warning">Departement <?=get_organization_name($org_id);?> Belum Mempunyai Mapping Kompetensi</label>
<?php } ?>