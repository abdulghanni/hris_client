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
                  <h4>Daftar Keterangan Tidak <span class="semi-bold">Absen</span></h4>
                  <div class="tools"> 
                    <a href="<?php echo site_url('form_absen/input')?>" class="config"></a>
                  </div>
                </div>
                  <div class="grid-body no-border">
                        
                          <table class="table table-striped table-flip-scroll cf">
                              <thead>
                                <tr>
                                  <th width="10%">Tanggal</th>
                                  <th width="10%">Nama</th>
                                  <th width="20%">Keterangan</th>
                                  <th width="10%">appr. spv</th>
                                  <th width="10%">appr. ka. bag</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                              if($form_absen->num_rows()>0){
                                 
                              foreach($form_absen->result() as $absen){

                                  $id_cuti = $absen->id;
                                  $session_id = get_nik($this->session->userdata('user_id'));
                                  $id_user = $this->session->userdata('user_id');
                                  $txt_app_lv1 = $txt_app_lv2 = $txt_app_lv3 = "-";

                                if(!empty(is_have_subordinate($session_id)))
                                  {
                                    if(cek_subordinate(is_have_subordinate($session_id),'id', $absen->user_id)){
                                          if($absen->is_app_lv1 == 0){
                                              $txt_app_lv1 = "<a href='".site_url('form_absen/approval_spv/'.$absen->id)."''>
                                                  <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-paste'></i></button>
                                              </a>";
                                          }else{
                                            $txt_app_lv1 =  "<a href='".site_url('form_absen/approval_spv/'.$absen->id)."''>Ya</a>";
                                            
                                          }
                                      }elseif($absen->is_app_lv1== 1){
                                        $txt_app_lv1 =  "<a href='".site_url('form_absen/approval_spv/'.$absen->id)."''>Ya</a>";
                                      }elseif($absen->is_app_lv1== 0){
                                         $txt_app_lv1 = '-';
                                      }
                                  }else{
                                    if ($absen->is_app_lv1== 1){
                                    $txt_app_lv1 =  "<a href='".site_url('form_absen/approval_spv/'.$absen->id)."''>Ya</a>";
                                    }
                                  }

                                  //ApprovalLevel 2
                                  
                                  if(!empty(is_have_subsubordinate($id_user)))
                                  {
                                    if(cek_subordinate(is_have_subsubordinate($id_user),'id', $absen->user_id)){
                                          if($absen->is_app_lv2 == 0){
                                              $txt_app_lv2 = "<a href='".site_url('form_absen/approval_kbg/'.$absen->id)."''>
                                                  <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-paste'></i></button>
                                              </a>";
                                          }else{
                                            $txt_app_lv2 =  "<a href='".site_url('form_absen/approval_kbg/'.$absen->id)."''>Ya</a>";
                                            
                                          }
                                     }else{
                                     
                                     }
                                  }else{
                                    if ($absen->is_app_lv2== 1){
                                    $txt_app_lv2 =  "<a href='".site_url('form_absen/approval_spv/'.$absen->id)."''>Ya</a>";
                                    }
                                  }


                                ?>
                                  <tr>
                                    <td>
                                      <a href="<?php echo site_url('form_absen/detail/'.$absen->id)?>"><?php echo $absen->date?>
                                      </a>
                                    </td>
                                    <td>
                                      <?php echo $absen->name?>
                                    </td>
                                    <td>
                                      <?php
                                        if($absen->keterangan_id!=0){
                                          echo $absen->keterangan_absen;
                                        }else{
                                          echo 'No Data';
                                        }
                                      ?>
                                    </td>
                                    <td style="text-align:center;">
                                      <?php echo $txt_app_lv1;?>
                                    </td>
                                    <td style="text-align:center;">
                                      <?php echo $txt_app_lv2;?>
                                    </td>
                                  </tr>
                                  <?php }} ?>
                              </tbody>
                          </table>
                  </div>
              </div>
          </div>
        </div>
      </div>
	          	
		
      </div>
		
	</div>  
	<!-- END PAGE --> 