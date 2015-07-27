<?php if($subordinate->num_rows() > 0){
foreach($subordinate->result() as $row):?>
  <div class="col-md-3">
    <div class="checkbox check-primary checkbox-circle" >
      <input name="peserta[]" class="checkbox1" type="checkbox" id="peserta<?php echo $row->id ?>" value="<?php echo $row->nik ?>">
        <label for="peserta<?php echo $row->id ?>"><?php echo get_name($row->id)?></label>
      </div>
  </div>
<?php endforeach;}else{?>
<input type="text" class="form-control" value="Karyawan yang dipilih tidak memiliki bawahan" disabled>
<?php } ?>