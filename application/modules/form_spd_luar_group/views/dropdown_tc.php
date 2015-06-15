
<?php 
if(!empty($subordinate)){
for($i=0;$i<sizeof($subordinate);$i++):?>
  <div class="col-md-5">
    <div class="checkbox check-primary checkbox-circle" >
      <input name="peserta[]" class="checkbox1" type="checkbox" id="peserta<?php echo $subordinate[$i]['ID'] ?>" value="<?php echo $subordinate[$i]['ID']?>">
        <label for="peserta<?php echo $subordinate[$i]['ID'] ?>"><?php echo get_name($subordinate[$i]['ID'])?></label>
     </div>
  </div>
<?php endfor;}else{?>
	<input name="org_tr" id="org_tr" type="text"  class="form-control" placeholder="Dept/Bagian" value="Tidak ada user dengan departemen yang sama" disabled="disabled">
<?php }?>