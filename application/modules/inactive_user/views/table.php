<tr>
    <th>#</th>
    <th>Item</th>
    <th>Keterangan / Jenis</th>
  </tr>
  <?php 
    $i=0;
    if($users_inventory->num_rows()>0){
      foreach ($users_inventory->result() as $row) :
  ?>
  <tr>
    <td class="no"><?php echo 1+$i++?></td>
    <td class="cek" style="display: none">
        <input type="checkbox" id="row<?=$i?>" value="" class="cek" name="row">
    </td>
    <td>
      <?php echo $row->title?>
      <input type="hidden" name="inventory_id[]" value="<?php echo $row->inventory_id?>">
    </td>
    <td><input name="note[]" id="note<?php echo $row->id?>" type="text"  class="form-control note" placeholder="" value="<?php echo $row->note?>" disabled></td>
  </tr>
  <?php endforeach;}else{?>
  <td colspan="3" id="col-null">Item inventaris kosong</td>
  <input type="hidden" id="baru" value="1">
  <?php } ?>