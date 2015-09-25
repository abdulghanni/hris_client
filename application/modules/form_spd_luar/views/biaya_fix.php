<?php 
	if(!empty($biaya_fix)){
  $i = 1;foreach($biaya_fix->result() as $row):?>
  <tr>
    <td></td>
    <?php if($row->jumlah_biaya != 0):?>
    <input type="hidden" name="jumlah_biaya_fix[]" value="<?php echo $row->jumlah_biaya?>" class="biaya">
    <?php endif ?>
    <input type="hidden" name="biaya_fix_id[]" value="<?php echo $row->id?>">
    <td><?php echo $i++?></td>
    <td><?php echo $row->title,'/hari'?></td>
    <td align="right"><?php echo ($row->jumlah_biaya == 0) ? '<input id="saku" type="text" name="jumlah_biaya_fix[]" value="0" class="form-control text-right angka biaya">' : '<span style="text-align:right">'.number_format($row->jumlah_biaya, 0).'</span>';?> </td>
  </tr>
<?php  endforeach;}?>

<script type="text/javascript">
$("#saku").keyup(function() {
    var val = parseInt($(this).val());
    var total = 0;
    var total2 = 0;
    $('.biaya').each(function (index, element) {
        total = total + parseInt($(element).val());
    });

    $('.biaya-tambahan').each(function (index, element) {
        total2 = total2 + parseInt($(element).val());
    });

    val = total+total2;
   $("#total").val(val);
})

$(".angka").keydown(function(event) {
      // Allow only backspace and delete
      if ( event.keyCode == 46 || event.keyCode == 8 ) {
          // let it happen, don't do anything
      }
      else {
          // Ensure that it is a number and stop the keypress
          if (event.keyCode < 48 || event.keyCode > 57 ) {
              event.preventDefault(); 
          }   
      }
  });
</script>