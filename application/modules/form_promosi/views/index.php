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
                  <h4>Daftar Pengajuan <span class="semi-bold"><a href="<?php echo site_url('form_promosi')?>">Promosi</a></span></h4>
                  <div class="tools"> 
                    <a href="<?php echo site_url('form_promosi/input') ?>" class="config"></a>
                  </div>
                </div>
                  <div class="grid-body no-border">
                        
                          <table class="table table-striped table-flip-scroll cf">
                              <thead>
                                <tr>
                                  <th width="15%">Nama</th>
                                  <th width="15%">Jabatan Lama</th>
                                  <th width="15%">Tanggal Pengangkatan</th>
                                  <th width="15%">Jabatan Baru</th>
                                  <th width="15%">Tanggal Pengangkatan</th>
                                  <th class="text-center" width="10%">Approval</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if($form_promosi->num_rows()>0){
                                  foreach($form_promosi->result() as $row):?>
                                  <tr>
                                    <td><a href="<?php echo site_url('form_promosi/detail/'.$row->id)?>"><?php echo $row->username?></a></td>
                                    <td><?php echo get_position_name($row->old_pos)?></td>
                                    <td><?php echo dateIndo(get_seniority_date(get_nik($row->user_id)))?></td>
                                    <td><?php echo get_position_name($row->new_pos)?></td>
                                    <td><?php echo dateIndo($row->date_promosi)?></td>
                                    <td class="text-center">
                                    <?php if($row->is_approved==1){?>
                                    <a href="<?php echo site_url('form_promosi/approval_hrd/'.$row->id)?>"><?php echo $row->approval_status?></a>
                                    <?php }elseif(is_admin() == true && $row->is_approved == 0){?>
                                    <a href="<?php echo site_url('form_promosi/approval_hrd/'.$row->id)?>">
                                      <button type='button' class='btn btn-info btn-small' title='Make Approval'><i class='icon-paste'></i></button>
                                    </a>
                                    <?php }else{
                                      echo '-';
                                    }?>
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