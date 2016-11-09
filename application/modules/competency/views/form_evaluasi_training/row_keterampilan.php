<tr>
	<td><?=$id?></td>
	<td><input type="text" class="form-control" name="keterampilan[]" placeholder="isi Keterampilan disini....."></td>
	<td class="text-center">
		<select class="select2" name="keterampilan_point_sebelum[]">
			<?php for ($j=1; $j < 6; $j++) { 
				echo "<option value='$j'>$j</option>";
			}
			?>
		</select>
	</td>
	<td class="text-center">
		<select class="select2" name="keterampilan_point_sesudah[]">
			<?php for ($k=1; $k < 6; $k++) { 
				echo "<option value='$k'>$k</option>";
			}
			?>
		</select>
	</td>
</tr>