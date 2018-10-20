<table class="table table-bordered tab-header-blue">
	<thead>
		<tr>
			<td>No.</td>
			<td>Nama Karyawan</td>
			<td>Periode</td>
			<td>Standar Kompetensi(SK)</td>
			<td>Aktual Kompetensi(AK)</td>
			<td>Score GAP(AK-SK)</td>
			<td>Action</td>
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
			<td><?php echo $key->sk ?></td>
			<td><?php echo $key->ak ?></td>
			<td><?php echo $key->gap ?></td>
			<td><?php echo ' 
			<a href="'.base_url().'competency/personal_assesment/approve/'.$key->id.'"><button type="button" class="btn btn-primary" title="Klik disini untuk melihat detail"><i class="icon-info"></i></button></a>
            <a class="btn btn-sm btn-light-azure" target="_blank" href="'.base_url().'competency/personal_assesment/print_pdf/'.$key->id.'" title="Klik icon ini untuk mencetak form pengajuan"><i class="icon-print"></i></a>'; ?></td>
		</tr>
	</tbody>
	<?php } ?>
</table>