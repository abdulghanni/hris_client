<select class="select2" id="parent_org" onChange="tampilOrg()" style="width:100%" required>
	<?php for($i=0;$i<sizeof($result);$i++):?>
		<option value="<?php echo $result[$i]['PARENT_ID'].','.$result[$i]['ID']?>"><?php echo $result[$i]['DESCRIPTION']?></option>
	<?php endfor;?>
</select>