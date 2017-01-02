<div class="row form-row">
	<div class="col-md-3">&nbsp;</div>
	<div class="col-md-9">
	  <?php
		$style_pos='class="form-control select2" style="width:100%"';
		echo form_dropdown("kota[]",$result,'',$style_pos);
	   ?>
	</div>
</div>
<br/>
<script type="text/javascript"> $(document).find("select.select2").select2();</script>