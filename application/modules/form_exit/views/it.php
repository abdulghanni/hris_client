<p class="wf-approve-sp">
  <?php if($row->is_app_it == 1){
  echo ($row->app_status_id_it == 1)?"<img class=approval-img src=$approved>": (($row->app_status_id_it == 2) ? "<img class=approval-img src=$rejected>"  : (($row->app_status_id_it == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));?><br />
    <span class="semi-bold"><?php echo get_name($row->user_app_it)?></span><br/>
  <span class="small"><?php echo dateIndo($row->date_app_it)?></span><br/>
  <?php }elseif($row->is_app_it == 0 && $is_admin_it == 1){?>
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
  <span class="semi-bold">IT</span>
</p>