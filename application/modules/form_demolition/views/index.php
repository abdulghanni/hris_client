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
                  <h4>Daftar Pengajuan <span class="semi-bold">demolition</span></h4>
                  <?php if(is_have_subordinate($sess_id)||is_admin()){?>
                  <div class="tools"> 
                    <a href="<?php echo site_url('form_demolition/input') ?>" class="config"></a>
                  </div>
                  <?php } ?>
                </div>
                  <div class="grid-body no-border">
                          <table class="table table-striped table-flip-scroll cf">
                              <thead>
                                <tr>
                                  <th width="15%">Nama Pengaju</th>
                                  <th width="15%">Nama Karyawan</th>
                                  <th width="15%">Alasan Demolition</th>
                                  <th width="15%" class="text-center">Approval HRD</th>
                                  <th width="10%" class="text-center">Cetak</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php if($form_demolition->num_rows()>0){
                                foreach($form_demolition->result() as $row):?>
                                  <tr>
                                    <td><a href="<?php echo site_url('form_demolition/detail/'.$row->id)?>"><?php echo get_name($row->created_by)?></a></td>
                                    <td><?php echo get_name($row->user_id)?></td>
                                    <td><?php echo $row->alasan_demolition?></td>
                                    <td class="text-center">
                                    <?php if($row->is_app==1){?>
                                    <a href="<?php echo site_url('form_demolition/approval_hrd/'.$row->id)?>"><?php echo $row->approval_status?></a>
                                    <?php }elseif(is_admin() == true && $row->is_app == 0){?>
                                    <a href="<?php echo site_url('form_demolition/approval_hrd/'.$row->id)?>">
                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-paste'></i></button>
                                    </a>
                                    <?php }else{
                                      echo '-';
                                    }?>
                                    </td>
                                    <td class="text-center">
                                    <?php if($row->is_app == 1){?>
                                            <a href="<?php echo site_url('form_demolition/form_demolition_pdf/'.$row->id)?>"><i class="icon-print"></i></a>
                                          <?php }else{ ?>
                                            <i class="icon-print"></i>
                                          <?php } ?>
                                    </td>
                                  </tr>
                                  <?php endforeach; } ?> 
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