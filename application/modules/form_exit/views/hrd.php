<p class="wf-approve-sp">
  <?php if($row->is_app_hrd == 1){
  echo ($row->app_status_id_hrd == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_hrd == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_hrd == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?><br />
    <span class="semi-bold"><?php echo get_name($row->user_app_hrd)?></span><br/>
  <span class="small"><?php echo dateIndo($row->date_app_hrd)?></span><br/>
  <?php }elseif($row->is_app_hrd == 0 && $is_admin_hrd == 1){?>
  <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalit"><i class="icon-ok"></i>Submit</div>
  <span class="semi-bold"></span><br/>
  <span class="semi-bold"></span><br/>
  <span class="small"></span>
  <?php }else{?>
  <span class="semi-bold"></span><br/>
  <span class="semi-bold"></span><br/>
  <span class="semi-bold"></span><br/>
  <span class="small"></span><br/>
  <?php } ?>
  <span class="semi-bold"></span><br/>
  <span class="semi-bold">HRD</span>
</p>