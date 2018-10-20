<table class="table table-bordered tab-header-blue">
	<thead>
		<tr>
			<td>No.</td>
			<td>Nama Karyawan</td>
			<td>Periode</td>
			<td>Kuadran</td>
			<td>Rekomendasi</td>
			<td width="10%">Action</td>
		</tr>
	</thead>
	<?php 
	$no=0;
	foreach ($competency->result() as $key) {
		if($departement==$key->organization){
	$no++;
	?>
	<tbody>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo get_name($key->nik) ?></td>
			<td><?php echo get_year_session($key->comp_session_id) ?></td>
			<td><?php if(isset($key->kuadran->title)){echo $key->kuadran->title;} ?></td>
			<td><?php if(isset($key->rekomendasi->title)){echo $key->rekomendasi->title;} ?></td>
			<td><?php echo ' 
			<a href="'.base_url().'competency/form_penilaian/approve/'.$key->id.'"><button type="button" class="btn btn-primary" title="Klik disini untuk melihat detail"><i class="icon-info"></i></button></a>
             <a class="btn btn-sm btn-light-azure" target="_blank" href="'.base_url().'competency/form_penilaian/print_pdf/'.$key->id.'" title="Klik icon ini untuk mencetak form pengajuan"><i class="icon-print"></i></a>'; ?></td>
		</tr>
	</tbody>
	<?php } }?>
</table>