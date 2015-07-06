<?php if(get_grade($nik) == 'G08' || get_grade($nik) == 'G09'){ ?>
<div class="row form-row">
  <div class="col-md-2">
    <label class="form-label text-left"><?php echo 'Admin Asset Management' ?></label>
  </div>
  <div class="col-md-4">
    <?php
      $style_up='class="form-control select2" id=""';
      echo form_dropdown('asset_mng',$result,'',$style_up);
    ?>
  </div>
</div>
<?php } else {
  echo '';
} ?>