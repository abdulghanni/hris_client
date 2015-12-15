
	<div class="col-md-8">
	  <?php
		$style_pos='class="form-control select2" style="width:100%"';
		echo form_dropdown("org",$result,'',$style_pos);
	   ?>
	</div>
<script type="text/javascript"> $(document).find("select.select2").select2();</script>