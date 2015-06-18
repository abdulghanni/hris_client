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
                  <h4>Daftar Rekapitulasi <span class="semi-bold"><a href="<?php echo site_url('form_medical')?>">Rawat Jalan & Inap</a></span></h4>
                  <div class="tools"> 
                    <a href="<?php echo site_url('form_medical/input')?>" class="config"></a>
                  </div>
                </div>
                  <div class="grid-body no-border">
                        
                          <table class="table table-striped table-flip-scroll cf">
                              <thead>
                                <tr>
                                  <th width="10%">Tanggal </th>
                                  <th width="20%">Nama Pembuat Rekap </th>
                                  <th width="40%">Bagian</th>
                                  <th width="10%" class="text-center">Approval Atasan</th>
                                  <th width="10%" class="text-center">Cetak</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php if($_num_rows>0){
                                foreach($form_medical as $row):
                                  $app_status = ($row->is_app == 1)?"<a href='".site_url('form_absen/detail/'.$row->id)."''><i class='icon-ok-sign' title='Approved'></i></a>" : "<i class='icon-minus' title='Pending'></i>";
                                  ?>
                                  <tr>
                                    <td><a href="<?php echo site_url('form_medical/detail/'.$row->id)?>"><?php echo dateIndo($row->created_on)?></a></td>
                                    <td>
                                      <a href="<?php echo site_url('form_medical/detail/'.$row->id)?>"><?php echo get_name($row->user_id)?></a>
                                    </td>
                                    <td>
                                      <?php echo get_user_organization(get_nik($row->user_id))?>
                                    </td>
                                    <td class="text-center"><?php echo $app_status?></td>
                                    <td class="text-center"><a href="<?php echo site_url('form_medical/form_medical_pdf/'.$row->id)?>"><i class="icon-print" title="Print"></i></a></td>
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