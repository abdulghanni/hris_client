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
                <h4>Form <span class="semi-bold">Cuti</span> - Ka. Bagian / Ka. Cabang Approval</h4>
              </div>
              <div class="grid-body no-border">
                <form class="form-no-horizontal-spacing" id="formAppLv2"> 
                  <div class="row column-seperation">
                    <div class="col-md-5">
                      <h4>Informasi karyawan</h4>
                      <?php if ($_num_rows > 0) { ?>
                      <?php foreach ($form_cuti as $user) : ?>
                      <?php 
                      $cur_sess = date('Y');
                      $session_id = $this->session->userdata('user_id');
                      $notes_kabag = $user->note_app_lv2;
                      $approval_id = $user->approval_status_id_lv2;
                      // convert date time
                      $submission_date = dateIndo($user->created_on);
                      $date_start_cuti = dateIndo($user->date_mulai_cuti);
                      $date_end_cuti = dateIndo($user->date_selesai_cuti);

                      $date_app_lv1 = dateIndo($user->date_app_lv1);
                      $date_app_lv2 = dateIndo($user->date_app_lv2);
                      $date_app_lv3 = dateIndo($user->date_app_lv3);

                     ?>
                      <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">No</label>
                        
                      </div>
                      <div class="col-md-9">
                        <input name="no" id="no" type="text"  class="form-control" placeholder="No" value="<?php echo $user->id; ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('start_working') ?></label>
                      </div>
                      <div class="col-md-9">
                        <input name="seniority_date" id="seniority_date" type="text"  class="form-control" placeholder="Lama Bekerja" value="<?php echo dateIndo($seniority_date) ?>" disabled="disabled">
                      </div>
                    </div>          
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('name') ?></label>
                      </div>
                      <div class="col-md-9">
                        <input name="name" id="name" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->first_name.' '.$user->last_name; ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('dept_div') ?></label>
                      </div>
                      <div class="col-md-9">
                        <input name="organization" id="organization" type="text"  class="form-control" placeholder="Organization" value="<?php echo $organization; ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('position') ?></label>
                      </div>
                      <div class="col-md-9">
                        <input name="position" id="position" type="text"  class="form-control" placeholder="Jabatan" value="<?php echo $position; ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo lang('cuti_remain') ?></label>
                      </div>
                      <div class="col-md-9">
                        <input name="sisa_cuti" id="sisa_cuti" type="text"  class="form-control" placeholder="Sisa Cuti" value="<?php echo $sisa_cuti; ?>" disabled="disabled">
                      </div>
                    </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Tanggal pengajuan</label>
                        </div>
                        <div class="col-md-9">
                          <input name="tgl_pengajuan" id="tgl_pengajuan" type="text"  class="form-control" placeholder="Tanggal Pengajuan" value="<?php echo $submission_date; ?>" disabled="disabled">
                        </div>
                      </div> 
                    </div>
                    
                    <div class="col-md-7">
                      <h4>Cuti yang akan diambil</h4>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Tahun</label>
                        </div>
                        <div class="col-md-9">
                          <input name="tahuncuti" id="tahuncuti" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->session_year; ?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Tgl. mulai cuti</label>
                        </div>
                        <div class="col-md-4">
                          <input name="start_cuti" id="start_cuti" type="text"  class="form-control" placeholder="Nama" value="<?php echo $date_start_cuti; ?>" disabled="disabled">
                        </div>
                        <div class="col-md-1">
                          <label class="form-label text-center">s/d</label>
                        </div>
                        <div class="col-md-4">
                          <input name="end_cuti" id="end_cuti" type="text"  class="form-control" placeholder="Nama" value="<?php echo $date_end_cuti; ?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Jml. Hari</label>
                        </div>
                        <div class="col-md-2">
                          <input name="form3PostalCode" id="form3PostalCode" type="text"  class="form-control" placeholder="Jml. Hari" value="<?php echo $user->jumlah_hari; ?>" disabled="disabled">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Alasan</label>
                        </div>
                        <div class="col-md-9">
                          <select id="formalasan" class="select2" style="width:100%" disabled="disabled">
                          <?php if ($alasan_cuti > 0) { ?>
                              <?php foreach ($alasan_cuti as $cs) : ?>
                              <?php if ($cs->id == $user->alasan_cuti_id) {
                                $selected = "selected";
                              }else{
                                $selected = "";
                              } ?>
                                <option value="<?php echo $cs->id; ?>" <?php echo $selected; ?>><?php echo $cs->title;?> </option>
                              <?php endforeach; ?>                      
                          <?php } ?>
                          </select> 
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Pengganti</label>
                        </div>
                        <div class="col-md-9">
                          <input name="pengganti_cuti" id="pengganti_cuti" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->first_name.' '.$user->last_name; ?>" disabled="disabled">
                        </div>
                      </div>
                    
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Alamat selama cuti</label>
                        </div>
                        <div class="col-md-9">
                          <input name="alamat_cuti" id="alamat_cuti" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->alamat_cuti; ?>" disabled="disabled">
                        </div>
                      </div>

                      <?php if(!empty($user->approval_status_id_lv1)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Approval Status SPV</label>
                        </div>
                        <div class="col-md-9">
                          <input name="alamat_cuti" id="alamat_cuti" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->approval_status_lv1; ?>" disabled="disabled">
                        </div>
                      </div>
                      <?php } ?>

                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Note (spv): </label>
                        </div>
                        <div class="col-md-9">
                          <textarea name="notes_spv" class="custom-txtarea-form" disabled="disabled"><?php echo $user->note_app_lv1 ?></textarea>
                        </div>
                      </div>

                      <?php if(!empty($user->approval_status_id_lv2)){?>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Approval Status Ka. Bag</label>
                        </div>
                        <div class="col-md-9">
                          <input name="alamat_cuti" id="alamat_cuti" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user->approval_status_lv2; ?>" disabled="disabled">
                        </div>
                      </div>
                      <?php } ?>

                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Note (ka. bag): </label>
                        </div>
                        <div class="col-md-9">
                          <textarea name="notes_kbg" class="custom-txtarea-form" placeholder="Note ka. bagian isi disini"><?php echo $user->note_app_lv2 ?></textarea>
                        </div>
                      </div>

                      <input type="text" name="app_status" value="1" style="display:none" />

                    </div>
                  </div>
                  
                  
                  <div class="form-actions">
                    <div class="col-md-8 text-center">
                      Disetujui oleh,
                      <div class="row wf-cuti">
                        <div class="col-md-6">
                          <?php if ($user->is_app_lv1 == 1) { ?>
                            <p class="wf-approve-sp">
                              <span class="semi-bold"><?php echo $nm_app_lv1 ?></span><br>
                              <span class="small"><?php echo $date_app_lv1; ?></span><br>
                              (Supervisor)
                            </p>
                          <?php }else{ ?>
                            <p class="wf-approve-sm">(Supervisor)</p>
                          <?php } ?>
                        </div>
                          <div class="col-md-6">
                          <?php if ($user->is_app_lv2 == 1 && cek_subordinate(is_have_subsubordinate($session_id),'id', $user->user_id) == TRUE) { ?>
                            <p class="wf-approve-sp">
                              <span class="semi-bold"><?php echo $nm_app_lv2 ?></span><br>
                              <span class="small"><?php echo $date_app_lv2 ?></span><br>
                              (Ka. Cabang / Ka. Bagian)<br />
                              <button type='button' class='btn btn-info btn-small' title='Edit Approval' data-toggle="modal" data-target="#notapprovecutiModal"><i class='icon-paste'></i></button>
                            </p>   
                          <?php }elseif($user->is_app_lv2 == 1 && cek_subordinate(is_have_subsubordinate($session_id),'id', $user->user_id) == FALSE) { ?>
                          <p class="wf-approve-sp">
                              <span class="semi-bold"><?php echo $nm_app_lv2 ?></span><br>
                              <span class="small"><?php echo $date_app_lv2 ?></span><br>
                              (Ka. Cabang / Ka. Bagian)
                            </p>   
                            <?php }else{ 
                            if(cek_subordinate(is_have_subsubordinate($session_id),'id', $user->user_id)){
                                      if($user->is_app_lv2 == 0){?>
                            <button id="btn_app_lv2" class="btn btn-success btn-cons"><i class="icon-ok"></i>Approve</button>
                            <div class="btn btn-danger btn-cons" data-toggle="modal" data-target="#notapprovecutiModal"><i class="icon-remove"></i>Not Approve</div>
                            <?php }} ?>
                            <p class="">(Ka. Cabang / Ka. Bagian)</p>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 text-center">
                      &nbsp;
                      <div class="row wf-cuti">
                        <div class="col-md-12">
                          <?php if ($user->is_app_lv3 == 1) { ?>
                            <p class="wf-approve-sp">
                              <span class="semi-bold"><?php echo $nm_app_lv3 ?></span><br>
                              <span class="small"><?php echo $date_app_lv3 ?></span><br>
                              (Personalia)
                            </p>   
                          <?php }else{ ?>
                            <input type="hidden" name="cuti_id" value="<?php echo $user->id ?>">
                            <?php if(is_admin()){?>
                            <button id="btn_app_lv3" class="btn btn-success btn-cons"><i class="icon-ok"></i>Approve</button>
                            <button class="btn btn-danger btn-cons"><i class="icon-remove"></i>Not Approve</button>
                            <?php } ?>
                            <p class="">(Personalia)</p>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                  <?php } ?>
                </form>
              </div>
            </div>
          </div>
        </div>
	          	
		
      </div>
		
	</div>  
	<!-- END PAGE --> 

  <!-- Edit approval cuti Modal -->
<div class="modal fade" id="notapprovecutiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Approval Form Cuti</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" method="POST" action="<?php echo site_url('form_cuti/update_approve_kbg/'.$this->uri->segment(3))?>">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Status Approval </label>
              </div>
              <div class="col-md-12">
                <div class="radio">
                  <?php 
                  if($approval_status->num_rows() > 0){
                    foreach($approval_status->result() as $app){
                      $checked = ($app->id <> 0 && $app->id == $approval_id) ? 'checked = "checked"' : '';
                      ?>
                  <input id="app_status<?php echo $app->id?>" type="radio" name="app_status_update" value="<?php echo $app->id?>" <?php echo $checked?>>
                  <label for="app_status<?php echo $app->id?>"><?php echo $app->title?></label>
                  <?php }}else{?>
                  <input id="app_status" type="radio" name="app_status_update" value="0">
                  <label for="app_status">No Data</label>
                    <?php } ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Note (kabag) : </label>
              </div>
              <div class="col-md-12">
                <textarea name="notes_kabag_update" class="custom-txtarea-form" placeholder="Note Ka. Bagian isi disini"><?=$notes_kabag?></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <div type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></div> 
        <button type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end edit modal-->