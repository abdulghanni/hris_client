<select name="jurusan" id="jurusan" class="form-custom select2" style="width:100%" required>
  <?php if($jurusan->num_rows()>0){
    foreach($jurusan->result() as $row):?>
    <option value="<?php echo $row->id?>"><?php echo $row->title?></option>
  <?php endforeach;}?>
</select>