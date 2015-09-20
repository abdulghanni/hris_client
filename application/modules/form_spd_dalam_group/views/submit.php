<!-- BEGIN PAGE CONTAINER-->
  <div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content">  
		
		
	    <div id="container">
	    	<div class="row">
        <div class="col-md-12">
          <div class="grid simple">
            <div class="grid-title no-border">
              <h4>Form <a href="<?php echo site_url('form_spd_dalam_group')?>">Perjalanan Dinas <span class="semi-bold">Dalam Kota (Group)</span></a></h4>
            </div>
            <div class="grid-body no-border">
             <!-- <form class="form-no-horizontal-spacing" id="form_spd_dalam_group" action="<?php echo site_url().'form_spd_dalam_group/do_submit/'.$id = $this->uri->segment(3, 0);?>" method="post"> -->
              <form class="form-no-horizontal-spacing" id="formSpdDalam"> 
                <div class="row column-seperation">
                  <div class="col-md-5">
                    <h4>Admin Pembuat Tugas</h4>
                    <?php if ($td_num_rows > 0) {
                      foreach ($task_detail as $td) : ?>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                        <input name="name" id="name" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($td->task_creator) ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="org" id="org" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_organization($td->task_creator)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="position" id="position" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_position($td->task_creator)?>" disabled="disabled">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <h4>Memberi Tugas Kepada</h4>
                    
                    <div class="row form-row">
                      <div class="col-md-12">
                        <!--<textarea id="text-editor" placeholder="" class="form-control" rows="3"  disabled="disabled"><?php echo $task_receiver_nm?></textarea>-->
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>Nama</th>
                                <th>Dept/Bagian</th>
                                <th>Jabatan</th>
                                <th>Submit</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php for($i=0;$i<sizeof($receiver);$i++):?>
                              <tr>
                                <td><?php echo get_name($receiver[$i])?></td>
                                <td><?php echo get_user_organization($receiver[$i])?></td>
                                <td><?php echo get_user_position($receiver[$i])?></td>
                                <td class="text-center"><?php echo in_array($receiver[$i], $receiver_submit)?"<i class='icon-ok-sign' title = 'Submitted'></i>":"<i class='icon-minus' title = 'Pending'></i>"?></td>
                              </tr>
                            <?php endfor?>
                            </tbody>
                          </table>
                      </div>
                    </div>
                    <br/>
                    
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Tujuan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="destination" id="destination" type="text"  class="form-control" placeholder="Tujuan" value="<?php echo $td->destination ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Dalam Rangka</label>
                      </div>
                      <div class="col-md-9">
                        <input name="title" id="title" type="text"  class="form-control" placeholder="Dalam Rangka" value="<?php echo $td->title; ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Tgl. Berangkat</label>
                      </div>
                      <?php $task_date = dateIndo($td->date_spd) ?>
                      <div class="col-md-8">
                        <!-- <div class="input-append date success no-padding"> -->
                          <input type="text" class="form-control" name="start_cuti" value="<?php echo $task_date; ?>" disabled="disabled">
                          <!-- <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> --> 
                        <!-- </div> -->
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Waktu</label>
                      </div>
                      <div class="col-md-3">
                            <input type="text" class="form-control" name="spd_start_time" value="<?php echo date('H:i:s',strtotime($td->start_time)) ?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-left">s/d</label>
                      </div>
                      <div class="col-md-3">
                            <input type="text" class="form-control" name="spd_start_time" value="<?php echo date('H:i:s',strtotime($td->end_time)) ?>" disabled="disabled">
                      </div>
                    </div>

                    <?php if(!empty($td->note_lv1)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Note (Atasan Langsung): </label>
                        </div>
                        <div class="col-md-9">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $td->note_lv1 ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if(!empty($td->note_lv2)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Note (Atasan Tidak Langsung): </label>
                        </div>
                        <div class="col-md-9">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $td->note_lv2 ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if(!empty($td->note_lv3)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Note (Atasan Lainnya): </label>
                        </div>
                        <div class="col-md-9">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $td->note_lv3 ?></textarea>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if(!empty($td->note_hrd)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Note (hrd): </label>
                        </div>
                        <div class="col-md-9">
                          <textarea name="notes_spv" class="form-control" disabled="disabled"><?php echo $td->note_hrd ?></textarea>
                        </div>
                      </div>
                      <?php } ?>

                      
                  </div>
                </div>
                <div class="form-actions text-center">
                    <!-- <div class="col-md-12 text-center"> -->
                      <div class="row wf-spd">
                        <div class="col-md-6">
                          <p>Yang bersangkutan</p>
                          <?php if (in_array($this->session->userdata('user_id'), $receiver) && !in_array($this->session->userdata('user_id'), $receiver_submit)|| in_array(get_nik($this->session->userdata('user_id')),$receiver) && !in_array(get_nik($this->session->userdata('user_id')), $receiver_submit)) { ?>
                            <button id="btn_submit" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Submit</button>
                            <p class="">...............................</p>
                          <?php }elseif(in_array($this->session->userdata('user_id'), $receiver) && in_array($this->session->userdata('user_id'), $receiver_submit)|| in_array(get_nik($this->session->userdata('user_id')),$receiver) && in_array(get_nik($this->session->userdata('user_id')), $receiver_submit)) { ?>
                            <span class="semi-bold"><?php echo get_name($this->session->userdata('user_id')) ?></span><br/>
                            <span class="small"><?php echo dateIndo($td->date_submit) ?></span><br/>
                          <?php }else{ ?>
                          <p class="wf-submit">
                            <p class="">...............................</p>
                          </p>
                          <?php } ?>
                        </div>
                        <div class="col-md-6">
                          <p>Admin Pembuat Tugas</p>
                          <p class="wf-approve-sp">
                            <span class="semi-bold"><?php echo get_name($td->task_creator) ?></span><br/>
                            <span class="small"><?php echo dateIndo($td->created_on) ?></span><br/>
                          </p>
                        </div>
                      </div>

                    <div class="form-actions">
                      <div class="col-md-12 text-center"><div class="col-md-12 text-center"><span class="semi-bold">Mengetahui,</span><br/><br/><br/></div>
                      
                      <div class="row form-row">
                        <div class="col-md-12 text-center">
                          <?php  if($td->is_app_lv1 == 1 && get_nik($sess_id) == $td->user_app_lv1){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalLv1"><i class='icon-edit'> Edit Approval</i></div>
                          <?php }elseif($td->is_app_lv2 == 1 && get_nik($sess_id) == $td->user_app_lv2){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalLv2"><i class='icon-edit'> Edit Approval</i></div>
                          <?php }elseif($td->is_app_lv3 == 1 && get_nik($sess_id) == $td->user_app_lv3){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalLv3"><i class='icon-edit'> Edit Approval</i></div>
                          <?php }elseif($td->is_app_hrd == 1 && get_nik($sess_id) == $td->user_app_hrd){?>
                            <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#submitModalHrd"><i class='icon-edit'> Edit Approval</i></div>
                          <?php } ?>
                        </div>
                      </div>

                      <div class="row wf-cuti">
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            $approved = assets_url('img/approved_stamp.png');
                            $rejected = assets_url('img/rejected_stamp.png');
                            if(!empty($td->user_app_lv1) && $td->is_app_lv1 == 0 && get_nik($sess_id) == $td->user_app_lv1){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv1"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($td->user_app_lv1)?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo '('.get_user_position($td->user_app_lv1).')'?></span>
                            <?php }elseif(!empty($td->user_app_lv1) && $td->is_app_lv1 == 1){
                             echo ($td->app_status_id_lv1 == 1)?"<img class=approval_img_md src=$approved>":(($td->app_status_id_lv1 == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($td->user_app_lv1)?></span><br/>
                              <span class="small"><?php echo dateIndo($td->date_app_lv1)?></span><br/>
                              <span class="semi-bold"><?php echo '('.get_user_position($td->user_app_lv1).')'?></span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv1))?get_name($td->user_app_lv1):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv1))?'('.get_user_position($td->user_app_lv1).')':'';?></span>
                            <?php } ?>
                          </p>
                        </div>

                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($td->user_app_lv2) && $td->is_app_lv2 == 0 && get_nik($sess_id) == $td->user_app_lv2){?>
                             <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv2"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv2))?get_name($td->user_app_lv2):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo'('.get_user_position($td->user_app_lv2).')'?></span>
                            <?php }elseif(!empty($td->user_app_lv2) && $td->is_app_lv2 == 1){
                             echo ($td->app_status_id_lv2 == 1)?"<img class=approval_img_md src=$approved>":(($td->app_status_id_lv2 == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($td->user_app_lv2)?></span><br/>
                              <span class="small"><?php echo dateIndo($td->date_app_lv2)?></span><br/>
                              <span class="semi-bold"><?php echo '('.get_user_position($td->user_app_lv2).')'?></span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv2))?get_name($td->user_app_lv2):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv2))?'('.get_user_position($td->user_app_lv2).')':'';?></span>
                            <?php } ?>
                          </p>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if(!empty($td->user_app_lv3) && $td->is_app_lv3 == 0 && get_nik($sess_id) == $td->user_app_lv3){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalLv3"><i class="icon-ok"></i>Submit</div>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo  get_name($td->user_app_lv3)?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($td->user_app_lv3)?>)</span>
                            <?php }elseif(!empty($td->user_app_lv3) && $td->is_app_lv3 == 1){
                             echo ($td->app_status_id_lv3 == 1)?"<img class=approval_img_md src=$approved>":(($td->app_status_id_lv3 == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($td->user_app_lv3)?></span><br/>
                              <span class="small"><?php echo dateIndo($td->date_app_lv3)?></span><br/>
                              <span class="semi-bold">(<?php echo get_user_position($td->user_app_lv3)?>)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv3))?get_name($td->user_app_lv3):'';?></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo (!empty($td->user_app_lv3))?'('.get_user_position($td->user_app_lv3).')':'';?></span>
                            <?php } ?>
                          </p>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                            <?php
                            if($td->is_app_hrd == 0 && $this->approval->approver('dinas') == $sess_nik){?>
                              <div class="btn btn-success btn-cons" id="" type="" data-toggle="modal" data-target="#submitModalHrd"><i class="icon-ok"></i>Submit</div>
                              <span class="small"></span>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }elseif($td->is_app_hrd == 1){
                             echo ($td->app_status_id_hrd == 1)?"<img class=approval_img_md src=$approved>":(($td->app_status_id_hrd == 2) ? "<img class=approval_img_md src=$rejected>":'<span class="small"></span><br/>');?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"><?php echo get_name($td->user_app_hrd)?></span><br/>
                              <span class="small"><?php echo dateIndo($td->date_app_hrd)?></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php }else{?>
                              <span class="small"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="small"></span><br/>
                              <span class="semi-bold"></span><br/>
                              <span class="semi-bold">(HRD)</span>
                            <?php } ?>
                          </p>
                        </div>
                      </div>
                    </div> 
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
	</div>  
	<!-- END PAGE --> 

<?php for($i=1;$i<4;$i++):?>
<!--approval  Modal atasan -->
<div class="modal fade" id="<?php echo 'submitModalLv'.$i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form</h4>
      </div>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="<?php echo 'formAppLv'.$i?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $x = 'app_status_id_lv'.$i;
                      $y = 'note_lv'.$i;
                      $checked = ($app->id <> 0 && $app->id == $td->$x) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv<?php echo $i.'-'.$app->id?>" type="radio" name="<?php echo 'app_status_lv'.$i?>" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_lv<?php echo $i.'-'.$app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="<?php echo 'app_status_lv'.$i?>" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note : </label>
              </div>
              <div class="col-md-12">
                <textarea name="<?php echo 'note_lv'.$i?>" class="form-control" placeholder="Isi note disini...."><?php echo $td->$y?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="<?php echo 'btn_app_lv'.$i?>"  class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal-->
<?php endfor;?>

<!--approval  Modal HRD -->
<div class="modal fade" id="submitModalHrd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form</h4>
      </div>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formAppHrd">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $td->app_status_id_hrd) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_hrd<?php echo $app->id?>" type="radio" name="app_status_hrd" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_hrd<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="app_status_hrd" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_hrd" class="form-control" placeholder="Isi note disini...."><?php echo $td->note_hrd?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="btn_app_hrd"  class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end approve modal--> 



<?php endforeach;} ?>