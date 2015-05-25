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
                  <h4>Daftar Pengajuan <span class="semi-bold">Karyawan Keluar</span></h4>
                  <div class="tools"> 
                    <a href="<?php echo site_url('form_resignment/input')?>" class="config"></a>
                  </div>
                </div>
                  <div class="grid-body no-border">
                        
                          <table class="table table-striped table-flip-scroll cf">
                              <thead>
                                <tr>
                                  <th width="10%">NIK</th>
                                  <th width="30%">Nama</th>
                                  <th width="10%">Tanggal Keluar</th>
                                  <th width="10%" style="text-align:center;">Approval HRD</th>
                                  <th width="10%" class="text-center">Cetak</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php if($form_resignment->num_rows()>0){
                                foreach($form_resignment->result() as $row):?>
                                  <tr>
                                    <td>
                                      <a href="<?php echo site_url('form_resignment/detail/'.$row->id)?>"><?php echo get_nik($row->user_id)?></a>
                                    </td>
                                    <td>
                                      <?php echo get_name($row->user_id)?>
                                    </td>
                                    <td>
                                      <?php echo dateIndo($row->date_resign)?>
                                    </td>
                                    <td style="text-align:center;">
                                    <?php if($row->is_app==1){?>
                                      <a href="<?php echo site_url('form_resignment/approval_hrd/'.$row->id)?>">Approved</a>
                                    <?php }elseif($row->is_app==0 && is_admin()){?>
                                      <a href="<?php echo site_url('form_resignment/approval_hrd/'.$row->id)?>">
                                        <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-paste'></i></button>
                                      </a>
                                      <?php}else{
                                          echo '-';
                                        ?>
                                      
                                      <?php } ?>
                                    </td>
                                    <td class="text-center">
                                      <a href="<?php echo site_url('form_resignment/form_resignment_pdf/'.$row->id)?>"><i class="icon-print"></i></a>
                                    </td>
                                  </tr>
                              <?php endforeach;} ?>
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