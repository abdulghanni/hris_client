<table class="table table-bordered tab-header-blue">
	<thead>
		<tr>
			<td>No.</td>
			<td>Nama Karyawan</td>
			<td>Periode</td>
			<td>Hasil</td>
			<td>Sebelum Training</td>
			<td>Sesudah Training</td>
			<td>Tindak Lanjut Evaluasi</td>
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
			<td><?php if(isset($key->output->title)) echo $key->output->title ?></td>
			<td><?php if(isset($key->output->point_sebelum)) echo $key->output->point_sebelum ?></td>
			<td><?php if(isset($key->output->point_sesudah)) echo $key->output->point_sesudah ?></td>
			<td><?php echo $key->tindak_lanjut ?></td>
			<td><?php echo ' 
			<a href="'.base_url().'competency/form_evaluasi_training/approve/'.$key->id.'"><button type="button" class="btn btn-primary" title="Klik disini untuk melihat detail"><i class="icon-info"></i></button></a>
             <a class="btn btn-sm btn-light-azure" target="_blank" href="'.base_url().'competency/form_evaluasi_training/print_pdf/'.$key->id.'" title="Klik icon ini untuk mencetak form pengajuan"><i class="icon-print"></i></a>'; ?></td>
		</tr>
	</tbody>
	<?php }?>
</table>