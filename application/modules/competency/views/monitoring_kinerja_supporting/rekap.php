<table class="table table-bordered tab-header-blue">
	<thead>
		<tr>
			<td>No.</td>
			<td>Nama Karyawan</td>
			<td>Periode</td>
			<td>Total Kinerja</td>
			<td>Konversi Nilai</td>
			<td>Potensi Promosi</td>
			<td>Catatan Perilaku</td>
			<td>Kebutuhan Training</td>
			<td>Target Kedepan</td>

			<td width="10%">Action</td>
		</tr>
	</thead>
	<?php 
	$no=0;
	foreach ($competency->result() as $key) {
	$no++;
	?>
	<tbody>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo get_name($key->nik) ?></td>
			<td><?php echo get_year_session($key->comp_session_id) ?></td>
			<td><?php echo $key->total ?></td>
			<td><?php echo $key->konversi ?></td>
			<td><?php echo $key->potensi_promosi ?></td>
			<td><?php echo $key->catatan_perilaku ?></td>
			<td><?php echo $key->kebutuhan_training ?></td>
			<td><?php echo $key->target_kedepan ?></td>
			<td><?php echo ' 
			<a href="'.base_url().'competency/kinerja_supporting/approve/'.$key->id.'"><button type="button" class="btn btn-primary" title="Klik disini untuk melihat detail"><i class="icon-info"></i></button></a>
             <a class="btn btn-sm btn-light-azure" target="_blank" href="'.base_url().'competency/kinerja_supporting/print_pdf/'.$key->id.'" title="Klik icon ini untuk mencetak form pengajuan"><i class="icon-print"></i></a>'; ?></td>
		</tr>
	</tbody>
	<?php } ?>
</table>