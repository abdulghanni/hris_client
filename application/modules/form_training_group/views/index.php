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
              <div class="grid simple ">
                <div class="grid-title no-border">
                  <h4>Daftar Permintaan <span class="semi-bold">Pelatihan Group</span></h4>
                  <?php if(is_have_subordinate($sess_id)||is_admin()){?>
                  <div class="tools"> 
                    <a href="<?php echo site_url('form_training_group/input')?>" class="config"></a>
                  </div>
                  <?php } ?>
                </div>
                  <div class="grid-body no-border">
                        
                          <table class="table table-striped table-flip-scroll cf">
                              <thead>
                                <tr>
                                  <th width="20%">Nama Pengaju</th>
                                  <th width="20%">Nama Peserta</th>
                                  <th width="20%">Nama pelatihan</th>
                                  <th width="40%">Tujuan</th>
                                  <th width="10%" style="text-align:center;">APPR SPV</th>
                                  <th width="10%" style="text-align:center;">APPR HRD</th>
                                  <th width="10%" class="text-center">Cetak</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                              if($form_training_group->num_rows()>0){
                                foreach($form_training_group->result() as $user){
                                $id_training = $user->id;
                                $peserta = getAll('users_training_group', array('id'=>'where/'.$id_training))->row('user_peserta_id');
                                $p = explode(",", $peserta);
                                  $session_id = get_nik($this->session->userdata('user_id'));
                                  $id_user = $this->session->userdata('user_id');
                                  $txt_app_lv1 = $txt_app_lv2 = "<i class='icon-minus' title = 'Pending'></i>";
                                  $approval_status_lv1 = ($user->approval_status_id_lv1 == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($user->approval_status_id_lv1 == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                  $approval_status_lv2 = ($user->approval_status_id_lv2 == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($user->approval_status_id_lv2 == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                  // approval training
                                  //Approval Level 1
                                  
                                  if(!empty(is_have_subordinate($session_id)))
                                  {
                                    if(cek_subordinate(is_have_subordinate($session_id),'id', $user->user_pengaju_id)){
                                          if($user->is_app_lv1 == 0){
                                              $txt_app_lv1 = "<a href='".site_url('form_training_group/approval_spv/'.$user->id)."''>
                                                  <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-paste'></i></button>
                                              </a>";
                                          }else{
                                            $txt_app_lv1 =  "<a href='".site_url('form_training_group/approval_spv/'.$user->id)."''>$approval_status_lv1</a>";
                                            
                                          }
                                      }elseif($user->is_app_lv1== 1){
                                        $txt_app_lv1 =  "<a href='".site_url('form_training_group/approval_spv/'.$user->id)."''>$approval_status_lv1</a>";
                                      }elseif($user->is_app_lv1== 0){
                                         $txt_app_lv1 = "<i class='icon-minus' title = 'Pending'></i>";
                                      }
                                  }else{
                                    if ($user->is_app_lv1== 1){
                                    $txt_app_lv1 =  "<a href='".site_url('form_training_group/approval_spv/'.$user->id)."''>$approval_status_lv1</a>";
                                    }
                                  }

                                  //Approval Level 3
                                   if(is_admin()){
                                          if($user->is_app_lv2 == 0){
                                              $txt_app_lv2 = "<a href='".site_url('form_training_group/approval_hrd/'.$user->id)."''>
                                                  <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-paste'></i></button>
                                              </a>";
                                          }else{
                                            $txt_app_lv2 =  "<a href='".site_url('form_training_group/approval_hrd/'.$user->id)."''>$approval_status_lv2</a>";
                                            
                                          }
                                      }elseif($user->is_app_lv2== 1){
                                        $txt_app_lv2 =  "<a href='".site_url('form_training_group/approval_hrd/'.$user->id)."''>$approval_status_lv2</a>";
                                      }
                                  ?>

                                  <tr>
                                    <td>
                                      <a href="<?php echo site_url('form_training_group/detail/'.$user->id)?>"><?php echo get_name($user->user_pengaju_id)?></a>
                                    </td>

                                    <td>
                                    <?php
                                      for($i=0;$i<sizeof($p);$i++):
                                        $n = get_name($p[$i]).'<br/>';
                                    ?>
                                      <a href="<?php echo site_url('form_training_group/detail/'.$user->id)?>"><?php echo $n;?></a>
                                    <?php endfor;?>
                                    </td>

                                    <td>
                                      <?php echo $user->training_name?>
                                    </td>

                                    <td>
                                      <?php echo $user->tujuan_training?>
                                    </td>

                                    <td style="text-align:center;">
                                    <?php echo $txt_app_lv1?>
                                    </td>

                                    <td style="text-align:center;">
                                    <?php echo $txt_app_lv2?>
                                    </td>


                                    <td class="text-center">
                                      <?php if($user->is_app_lv1 == 1 && $user->is_app_lv2 == 1){?>
                                              <a href="<?php echo site_url('form_training_group/form_training_group_pdf/'.$user->id)?>"><i class="icon-print"></i></a>
                                            <?php }else{ ?>
                                              <i class="icon-print"></i>
                                            <?php } ?>
                                      </td>
                                  </tr>
                              </tbody>
                              <?php }}?>
                          </table>
                  </div>
              </div>
          </div>
        </div>
      </div>
	          	
		
      </div>
		
	</div>  
	<!-- END PAGE --> 