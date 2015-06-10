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
                  <h4>Daftar Permintaan <span class="semi-bold">SDM Baru</span></h4>
                  <div class="tools"> 
                    <a href="<?php echo site_url('form_recruitment/input')?>" class="config"></a>
                  </div>
                </div>
                  <div class="grid-body no-border">
                        
                          <table class="table table-striped table-flip-scroll cf">
                              <thead>
                                <tr>
                                  <th width="20%">Nama Pengaju</th>
                                  <th width="10%">Unit Bisnis</th>
                                  <th width="40%">Job Desc</th>
                                  <th width="10%" class="text-center">Approval SPV</th>
                                  <th width="10%" class="text-center">Approval Ka. Bag</th>
                                  <th width="10%" class="text-center">Approval HRD</th>
                                  <th width="10%" class="text-center">Cetak</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                if($_num_rows >0){
                                  foreach($recruitment as $row):
                                  $approval_status_lv1 = ($row->approval_status_id_lv1 == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($row->approval_status_id_lv1 == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                  $approval_status_lv2 = ($row->approval_status_id_lv2 == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($row->approval_status_id_lv2 == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                  $approval_status_hrd = ($row->approval_status_id_hrd == 1)? "<i class='icon-ok-sign' title = 'Approved'></i>" : (($row->approval_status_id_hrd == 2) ? "<i class='icon-remove-sign' title = 'Rejected'></i>" : "<i class='icon-minus' title = 'Pending'></i>");
                                    ?>
                                  <tr>
                                    <td>
                                      <a href="<?php echo site_url('form_recruitment/detail/'.$row->id)?>"><?php echo get_name($row->user_id)?></a>
                                    </td>
                                    <td>
                                     <?php echo get_bu_name(substr($row->bu_id,0,2))?>
                                    </td>
                                    <td>
                                      <?php echo $row->job_desc?>
                                    </td>
                                    <td class="text-center">
                                    <?php if($row->is_app_lv1 == 1){?>
                                       <a href="<?php echo site_url('form_recruitment/approval/'.$row->id)?>"><?php echo $approval_status_lv1?></a>
                                      <?php }elseif($row->is_app_lv1 == 0 && cek_subordinate(is_have_subordinate($session_id),'id', $row->user_id)){
                                        echo "<a href='".site_url('form_recruitment/approval/'.$row->id)."''>
                                                  <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-paste'></i></button>
                                                </a>";
                                      }else{
                                       echo "<i class='icon-minus' title = 'Pending'></i>";
                                      }?>
                                    </td>
                                    <td class="text-center">
                                    <?php if($row->is_app_lv2 == 1){?>
                                       <a href="<?php echo site_url('form_recruitment/approval/'.$row->id)?>"><?php echo $approval_status_lv2?></a>
                                      <?php }elseif($row->is_app_lv2 == 0 && cek_subordinate(is_have_subsubordinate($session_id),'id', $row->user_id)){
                                        echo "<a href='".site_url('form_recruitment/approval/'.$row->id)."''>
                                                  <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-paste'></i></button>
                                                </a>";
                                      }else{
                                       echo "<i class='icon-minus' title = 'Pending'></i>";
                                      }?>
                                    </td>
                                    <td class="text-center">
                                    <?php if($row->is_app_hrd == 1){?>
                                       <a href="<?php echo site_url('form_recruitment/approval/'.$row->id)?>"><?php echo $approval_status_hrd?></a>
                                      <?php }elseif($row->is_app_hrd == 0 && is_admin()){
                                        echo "<a href='".site_url('form_recruitment/approval/'.$row->id)."''>
                                                  <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-paste'></i></button>
                                                </a>";
                                      }else{
                                       echo "<i class='icon-minus' title = 'Pending'></i>";
                                      }?>
                                    </td>
                                    <td class="text-center">
                                      <a href="<?php echo site_url('form_recruitment/recruitment_pdf/'.$row->id)?>"><i class="icon-print"></i></a>
                                    </td>
                                  </tr>
                                  <?php endforeach;}?>
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