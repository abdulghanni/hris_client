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
              <h4>Form Permintaan <span class="semi-bold"><a href="<?php echo site_url('form_recruitment')?>">SDM Baru</a></span></h4>
            </div>
            <div class="grid-body no-border">
              <?php
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formApp');
                echo form_open();//'form_recruitment/add', $att);
                foreach($recruitment as $row):
                ?>
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Unit Bisnis</label>
                      </div>
                      <div class="col-md-4">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo get_bu_name(substr($row->bu_id,0,2))?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Departement</label>
                      </div>
                      <div class="col-md-4">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo get_organization_name($row->parent_organization_id)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Bagian</label>
                      </div>
                      <div class="col-md-4">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo get_organization_name($row->organization_id)?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-4">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo get_position_name($row->position_id)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jumlah yang dibutuhkan</label>
                      </div>
                      <div class="col-md-4">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo $row->jumlah?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Status</label>
                      </div>
                      <div class="col-md-4">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo $row->status?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Urgensi (Kebutuhan)</label>
                      </div>
                      <div class="col-md-10">
                        <input name="jumlah" id="form3LastName" type="text"  class="form-control" placeholder="-" value="<?php echo $row->urgensi?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <h4><strong>Kualifikasi :</strong></h4>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jenis Kelamin</label>
                      </div>
                      <?php 
                        if($jenis_kelamin->num_rows()>0){
                          foreach($jenis_kelamin->result() as $jk):?>
                      <div class="col-md-1">
                        <div class="checkbox check-primary checkbox-circle" >
                          <input name="jenis_kelamin[]" class="checkbox1" type="checkbox" id="jenis_kelamin<?php echo $jk->id ?>" value="<?php echo $jk->id ?>" checked="checked" disabled="disabled">
                            <label for="jenis_kelamin<?php echo $jk->id ?>"><?php echo $jk->title?></label>
                          </div>
                      </div>
                    <?php endforeach;} ?>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Pendidikan</label>
                      </div>
                      <?php 
                          if($pendidikan->num_rows()>0){
                            foreach($pendidikan->result() as $p):?>
                        <div class="col-md-2">
                          <div class="checkbox check-primary checkbox-circle" >
                            <input name="pendidikan[]" class="checkbox1" type="checkbox" id="pendidikan<?php echo $p->id ?>" value="<?php echo $p->id ?>" checked="checked" disabled="disabled">
                              <label for="pendidikan<?php echo $p->id ?>"><?php echo $p->title?></label>
                            </div>
                        </div>
                      <?php endforeach;} ?>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jurusan</label>
                      </div>
                      <div class="col-md-2">
                        <input name="jurusan" id="form3LastName" type="text"  class="form-control" placeholder="Jurusan" value="<?php echo $row->jurusan?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">IPK</label>
                      </div>
                      <div class="col-md-2">
                        <input name="ipk" id="form3LastName" type="text"  class="form-control" placeholder="IPK" value="<?php echo $row->ipk?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Toefl</label>
                      </div>
                      <div class="col-md-2">
                        <input name="toefl" id="form3LastName" type="text"  class="form-control" placeholder="Toefl" value="<?php echo $row->toefl?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <h4><strong>Kemampuan Teknis :</strong></h4>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Komputer</label>
                      </div>
                      <div class="col-md-10">
                        <?php 
                          if($komputer->num_rows()>0){
                            foreach($komputer->result() as $p):?>
                        <div class="col-md-2">
                          <div class="checkbox check-primary checkbox-circle" >
                            <input name="komputer[]" class="checkbox1" type="checkbox" id="komputer<?php echo $p->id ?>" value="<?php echo $p->id ?>" checked="checked" disabled="disabled">
                              <label for="komputer<?php echo $p->id ?>"><?php echo $p->title?></label>
                            </div>
                        </div>
                      <?php endforeach;} ?>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Bahasa Pemrograman</label>
                      </div>
                      <div class="col-md-10">
                        <input name="pemrograman" id="form3LastName" type="text"  class="form-control" placeholder="pemrograman" value="<?php echo $row->bahasa_pemrograman?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Komunikasi</label>
                      </div>
                      <div class="col-md-10">
                        <input name="komunikasi" id="form3LastName" type="text"  class="form-control" placeholder="Komunikasi" value="<?php echo $row->komunikasi?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Grafika</label>
                      </div>
                      <div class="col-md-10">
                        <input name="grafika" id="form3LastName" type="text"  class="form-control" placeholder="Grafika" value="<?php echo $row->grafika?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Desain/Setting</label>
                      </div>
                      <div class="col-md-10">
                        <input name="desain" id="form3LastName" type="text"  class="form-control" placeholder="Desain/Setting" value="<?php echo $row->desain?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Brevet</label>
                      </div>
                      <div class="col-md-10">
                        <input name="brevet" id="form3LastName" type="text"  class="form-control" placeholder="brevet" value="<?php echo $row->brevet?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Lain-lain</label>
                      </div>
                      <div class="col-md-10">
                        <input name="lain-lain" id="form3LastName" type="text"  class="form-control" placeholder="Lain-lain" value="<?php echo $row->lain_lain?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Portfolio</label>
                      </div>
                      <div class="col-md-10">
                        <input name="portofolio" id="form3LastName" type="text"  class="form-control" placeholder="Portfolio" value="<?php echo $row->portofolio?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Pengalaman</label>
                      </div>
                      <div class="col-md-2">
                        <input name="pengalaman" id="form3LastName" type="text"  class="form-control" placeholder="Bidang" value="<?php echo $row->pengalaman?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">selama</label>
                      </div>
                      <div class="col-md-1">
                        <input name="lama_pengalaman" id="form3LastName" type="text"  class="form-control" placeholder="" value="<?php echo $row->lama_pengalaman?>" disabled="disabled"> 
                      </div>
                      <div class="col-md-1">
                        <label class="form-label text-right">Tahun</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Job Desc</label>
                      </div>
                      <div class="col-md-10">
                        <textarea name="job_desc" id="text-editor" placeholder="Enter text ..." class="form-control" rows="10" disabled="disabled"><?php echo $row->job_desc?></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Catatan Pengaju</label>
                      </div>
                      <div class="col-md-10">
                        <textarea name="note_hrd" id="text-editor" placeholder="Enter text ..." class="form-control" rows="10" disabled="disabled"><?php echo $row->note_pengaju?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="row form-row">
                      <div class="col-md-12 text-center">
                      <?php if($row->is_app_lv1 == 1  && cek_subordinate(is_have_subordinate($session_id),'id', $row->user_id) == TRUE){?>
                          <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#updaterecruitmentspvModal"><i class='icon-edit'> Edit Approval</i></div>
                        <?php }elseif($row->is_app_lv2 == 1 && cek_subordinate(is_have_subsubordinate($session_id),'id', $row->user_id) == TRUE){?>
                          <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#updaterecruitmentkbgModal"><i class='icon-edit'> Edit Approval</i></div>
                        <?php }elseif($row->is_app_hrd == 1 && is_admin() == true){?>
                          <div class='btn btn-info btn-small text-center' title='Edit Approval' data-toggle="modal" data-target="#updaterecruitmenthrdModal"><i class='icon-edit'> Edit Approval</i></div>
                        <?php } ?>
                      </div>
                  </div>
                      <div class="row wf-cuti">
                      	<div class="col-md-12 text-center">
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                          <div class="col-md-12"><span class="semi-bold">Pemohon,</span><br/><br/></div>
                            <span class="semi-bold"><?php echo get_name($row->user_id)?></span><br/>
                            <span class="semi-bold"><?php echo $position_pengaju?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_created)?></span>
                          </p>
                        </div>

                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                          <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                            <?php 
                          $approved = assets_url('img/approved_stamp.png');
                          $rejected = assets_url('img/rejected_stamp.png');
                          if ($row->is_app_lv1 == 1) { 
                            echo ($row->approval_status_id_lv1 == 1)? "<img class=approval_img_recruitment src=$approved>":(($row->approval_status_id_lv1 == 2) ? "<img class=approval_img_recruitment src=$rejected>":'');?><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv1)?></span><br/>
                            <span class="semi-bold">Supervisor</span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv1)?></span><br/>
                            <?php }elseif($row->is_app_lv1 == 0 && cek_subordinate(is_have_subordinate($session_id),'id', $row->user_id) == TRUE){?>
                            <div class="btn btn-success btn-cons" data-toggle="modal" data-target="#submitrecruitmentspvModal"><i class="icon-ok"></i>Submit</div>
                            <span class="small"></span><br/>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <?php } ?>
                          </p>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                          <div class="col-md-12"><span class="semi-bold">Mengetahui / Menyetujui,</span><br/><br/></div>
                           <?php if ($row->is_app_lv2 == 1) { 
                            echo ($row->approval_status_id_lv2 == 1)? "<img class=approval_img_recruitment src=$approved>":(($row->approval_status_id_lv2 == 2) ? "<img class=approval_img_recruitment src=$rejected>":'');?><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv2)?></span><br/>
                            <span class="semi-bold">Ka. Bagian</span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv2)?></span><br/>
                            <?php }elseif($row->is_app_lv2 == 0 && cek_subordinate(is_have_subsubordinate($session_id),'id', $row->user_id) == TRUE){?>
                            <div class="btn btn-success btn-cons" type="" data-toggle="modal" data-target="#submitrecruitmentkbgModal"><i class="icon-ok"></i>Submit</div>
                            <span class="small"></span><br/>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <?php } ?>
                          </p>
                        </div>
                          
                        <div class="col-md-3">
                          <p class="wf-approve-sp">
                          <div class="col-md-12"><span class="semi-bold">Diterima HRD</span><br/><br/></div>
                            <?php if($row->is_app_hrd == 1){
                               echo ($row->approval_status_id_hrd == 1)? "<img class=approval_img_recruitment src=$approved>":(($row->approval_status_id_hrd == 2) ? "<img class=approval_img_recruitment src=$rejected>":'');?><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_hrd)?></span><br/>
                            <span class="semi-bold">HRD</span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_hrd)?></span><br/>
                            <?php }elseif($row->is_app_hrd == 0 && is_admin()){?>
                            <div class="btn btn-success btn-cons" id="btn_app_hrd" type="" data-toggle="modal" data-target="#submitrecruitmenthrdModal"><i class="icon-ok"></i>Submit</div>
                            <span class="small"></span><br/>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
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

<!-- do approval recruitment Modal spv -->
<div class="modal fade" id="submitrecruitmentspvModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Recruitment</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" method="POST" action="<?php echo site_url('form_recruitment/do_approve/lv1/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->approval_status_id_lv1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv1<?php echo $app->id?>" type="radio" name="app_status_lv1" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_lv1<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status_lv1" type="radio" name="app_status_lv1" value="0">
                  <label for="app_status_lv1">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Ka. Bag) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_lv1" class="custom-txtarea-form" placeholder="Note Supervisor isi disini"><?php echo $row->note_lv1?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end do modal--> 


<!-- do approval recruitment Modal kbg -->
<div class="modal fade" id="submitrecruitmentkbgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Recruitment</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" method="POST" action="<?php echo site_url('form_recruitment/do_approve/lv2/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->approval_status_id_lv2) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_lv2<?php echo $app->id?>" type="radio" name="app_status_lv2" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_lv2<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status_lv2" type="radio" name="app_status_lv2" value="0">
                  <label for="app_status_lv2">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Ka. Bag) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_lv2" class="custom-txtarea-form" placeholder="Note Ka. Bagian isi disini"><?php echo $row->note_lv2?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end do modal--> 

<!-- do approval recruitment hrd Modal -->
<div class="modal fade" id="submitrecruitmenthrdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Recruitment</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" method="POST" action="<?php echo site_url('form_recruitment/do_approve/hrd/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->approval_status_id_hrd) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status_hrd<?php echo $app->id?>" type="radio" name="app_status_hrd" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status_hrd<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status_hrd" type="radio" name="app_status_hrd" value="0">
                  <label for="app_status_hrd">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (HRD) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="note_hrd" class="custom-txtarea-form" placeholder="Note hrd isi disini"><?php echo $row->note_hrd?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end do modal--> 

<!-- Edit approval recruitment Modal spv -->
<div class="modal fade" id="updaterecruitmentspvModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Recruitment</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" method="POST" action="<?php echo site_url('form_recruitment/update_approve/lv1/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->approval_status_id_lv1) ? 'checked = "checked"' : '';
                      ?>
                  <input id="update_app_status_lv1<?php echo $app->id?>" type="radio" name="update_app_status_lv1" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="update_app_status_lv1<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="update_app_status_lv1" type="radio" name="update_app_status_lv1" value="0">
                  <label for="update_app_status_lv1">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Ka. Bag) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="update_note_lv1" class="custom-txtarea-form" placeholder="Note Supervisor isi disini"><?php echo $row->note_lv1?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end edit modal--> 


<!-- Edit approval recruitment Modal kbg -->
<div class="modal fade" id="updaterecruitmentkbgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Recruitment</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" method="POST" action="<?php echo site_url('form_recruitment/update_approve/lv2/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->approval_status_id_lv2) ? 'checked = "checked"' : '';
                      ?>
                  <input id="update_app_status_lv2<?php echo $app->id?>" type="radio" name="update_app_status_lv2" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="update_app_status_lv2<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="update_app_status_lv2" type="radio" name="update_app_status_lv2" value="0">
                  <label for="update_app_status_lv2">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (Ka. Bag) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="update_note_lv2" class="custom-txtarea-form" placeholder="Note Ka. Bagian isi disini"><?php echo $row->note_lv2?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end edit modal--> 

<!-- Edit approval recruitment hrd Modal -->
<div class="modal fade" id="updaterecruitmenthrdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Recruitment</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" method="POST" action="<?php echo site_url('form_recruitment/update_approve/hrd/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $row->approval_status_id_hrd) ? 'checked = "checked"' : '';
                      ?>
                  <input id="update_app_status_hrd<?php echo $app->id?>" type="radio" name="update_app_status_hrd" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="update_app_status_hrd<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="update_app_status_hrd" type="radio" name="update_app_status_hrd" value="0">
                  <label for="update_app_status_hrd">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (HRD) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="update_note_hrd" class="custom-txtarea-form" placeholder="Note hrd isi disini"><?php echo $row->note_hrd?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end edit modal--> 



<?php endforeach;?>