<p class="wf-approve-sp">
	  <?php echo ($app_status_id == 1)?"<img class=approval-img src=$approved>": (($app_status_id == 2) ? "<img class=approval-img src=$rejected>"  : (($app_status_id == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));
	 	?>
  	  <span class="small"></span><br/>
      <span class="semi-bold"><?php echo get_name(sessId())?></span><br/>
      <span class="small"><?php echo dateIndo($date_app)?></span><br/>
      <span class="semi-bold"><?=get_user_position(get_nik(sessId()))?></span>
		</p>