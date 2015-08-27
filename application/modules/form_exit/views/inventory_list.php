<div class="row form-row">
  <div class="col-md-12">
    <h4>Inventaris yang harus diserahkan</h4>
  </div>
  </div>
  <div class="row form-row">
    <div class="col-md-12">
      <table class="table no-more-tables">
        <tr>
          <th>No</th>
          <th>Item</th>
          <th>Ketersediaan</th>
          <th>Keterangan</th>
        </tr>
        <?php
        if($laporan_num_rows<1){?>
        <tr>
          <td><?php echo '1'?></td>
          <td><?php echo 'Laporan Serah Terima'?></td>
          <td>
            <input type="hidden" name="laporan_id" value="<?php echo '10'?>">
            <label class="radio-inline">
              <input type="radio" name="is_available_laporan" id="is_available_laporan-1" value="1">Ada
            </label>
            <label class="radio-inline">
              <input type="radio" name="is_available_laporan" id="is_available_laporan-1" value="0">Tidak
            </label>
          </td>
          <td><input name="note_laporan" id="note_laporan" type="text"  class="form-control" placeholder="" value=""></td>
        </tr>
        <?php } ?>
        <?php
          $i=0;
          if($users_inventory->num_rows()>0){
            foreach ($users_inventory->result() as $inv) :
              ?>
        <tr>
          <td><?php echo ($laporan_num_rows>0)?1+$i++:2+$i++;?></td>
          <td><?php echo $inv->title?></td>
          <td>
            <input type="hidden" name="inventory_id[]" value="<?php echo $inv->id?>">
            <label class="radio-inline">
              <input type="radio" name="is_available_<?php echo $i?>" id="is_available<?php echo $inv->id?>-1" value="1" <?php echo ($inv->is_available==1)?'checked':''?>>Ada
            </label>
            <label class="radio-inline">
              <input type="radio" name="is_available_<?php echo $i?>" id="is_available<?php echo $inv->id?>-1" value="0" <?php echo ($inv->is_available==0)?'checked':''?>>Tidak
            </label>
          </td>
          <td><input name="note_<?php echo $i?>" id="note<?php echo $inv->id?>" type="text"  class="form-control" placeholder="" value="<?php echo $inv->note?>"></td>
        </tr>
            <?php endforeach;}?>
      </table>
    </div>
  </div>