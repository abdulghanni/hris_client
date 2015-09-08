<?php 
	if(!empty($biaya_fix)){
  $i = 1;foreach($biaya_fix->result() as $row):?>
  <tr>
    <td></td>
    <?php if($row->jumlah_biaya != 0):?>
    <input type="hidden" name="jumlah_biaya_fix[]" value="<?php echo $row->jumlah_biaya?>">
    <?php endif ?>
    <input type="hidden" name="biaya_fix_id[]" value="<?php echo $row->id?>">
    <td><?php echo $i++?></td>
    <td><?php echo $row->title,'/hari'?></td>
    <td align="right"><?php echo ($row->jumlah_biaya == 0) ? '<input type="text" name="jumlah_biaya_fix[]" value="0" class="form-control rupiah">' : '<span style="text-align:right">'.number_format($row->jumlah_biaya, 0).'</span>';?> </td>
  </tr>
<?php  endforeach;}?>