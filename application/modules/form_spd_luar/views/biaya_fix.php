<?php 
	if(!empty($biaya_fix)){
  $i = 1;foreach($biaya_fix->result() as $row):?>
  <tr>
    <td></td>
    <input type="hidden" name="jumlah_biaya_fix[]" value="<?php echo $row->jumlah_biaya?>">
    <input type="hidden" name="biaya_fix_id[]" value="<?php echo $row->id?>">
    <td><?php echo $i++?></td>
    <td><?php echo $row->title?></td>
    <td><?php echo $row->jumlah_biaya?></td>
  </tr>
<?php  endforeach;}?>