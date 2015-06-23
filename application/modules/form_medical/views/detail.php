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
              <h4>Detail Rekapitulasi <span class="semi-bold"><a href="<?php echo site_url('form_medical')?>">Rawat Jalan & Inap</a></span></h4>
            </div>
            <div class="grid-body no-border">
            <h6 class="bold">BAGIAN : <?php echo $bagian?></h6>
              <form class="form-no-horizontal-spacing" id="formMedical"> 
                <div class="row column-seperation">

                  <hr/>
                  <h5 class="text-center"><span class="semi-bold">Rekapitulasi Rawat Jalan & Inap</span></h5>
                    <table id="dataTable" class="table table-bordered">
		    	            <thead>
                        <tr>
                          <th width="5%">NIK</th>
                          <th width="25%">Nama</th>
                          <th width="25%">Nama Pasien</th>
                          <th width="15%">Hubungan</th>
                          <th width="13%">Jenis Pemeriksaan</th>
                          <th width="12%">Rupiah</th>
                        </tr>
                      </thead>
		                  <tbody>
      					        <?php 
        					        if(!empty($detail)){
                             $total = $detail[0]['rupiah'];
                             $approved = assets_url('img/approved_stamp.png');
        					        	  for($i=0;$i<sizeof($detail);$i++):
                              ?>
      						        <tr>
      						        	<td><?php echo get_nik($detail[$i]['karyawan_id'])?></td>
      						        	<td><?php echo get_name($detail[$i]['karyawan_id'])?></td>
      						        	<td><?php echo $detail[$i]['pasien']?></td>
      						        	<td><?php echo $detail[$i]['hubungan']?></td>
      						        	<td><?php echo $detail[$i]['jenis']?></td>
      						        	<td><?php echo  'Rp. '.number_format($detail[$i]['rupiah'], 0)?></td>
      						        </tr>
                            <?php /*
                              if(sizeof($detail)>1){?>
                                <?php if($detail[$i]['karyawan_id'] != $detail[$i+1]['karyawan_id']){
                                    $sub_total = $detail[$i]['rupiah'] + $detail[$i+1]['rupiah']
                                  ?>
                                  <tr>
                                    <td align="right" colspan="5">Total <?php echo $detail[$i]['karyawan_id']?>: </td><td><?php echo $sub_total?></td>
                                  </tr>
                                  <?php } ?>
                            <?php };*/?>
        						        <?php
                            if(sizeof($detail)>1 && isset($detail[$i+1])){
                            $total = $total + $detail[$i+1]['rupiah'];
                            }
                            endfor;}
                            ?>
                            <tr>
                            <td align="right" colspan="5">Total : </td><td><?php echo 'Rp. '.number_format($total, 0)?></td>
                            </tr>
      					        </tbody>
		                  </table>
                    </div>
                  </div>
                </div>
                <?php if($_num_rows>0){
                  foreach($form_medical as $row):?>
                <div class="form-actions text-center">
                    <!-- <div class="col-md-12 text-center"> -->
                      <div class="row wf-spd">
                        <div class="col-md-4">
                          <p>Hormat Kami,</p>
                          <p class="wf-submit">
                          <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_id) ?></span><br/>
                            <span class="semi-bold"><?php echo (!empty(get_user_position(get_nik($row->user_id)))) ? get_user_position(get_nik($row->user_id)) : ''?></span><br/>
                            <span class="small"><?php echo dateIndo($row->created_on) ?></span><br/>
                          </p>
                        </div>

                        <div class="col-md-4">
                          <p>Mengetahui,</p>
                          <p class="wf-approve-sp">
                          <?php if($row->is_app_hrd==1) {
                            echo "<img class=approval_img src=$approved>"?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_hrd) ?></span><br/>
                            <span class="semi-bold"></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_hrd) ?></span><br/>
                            <?php }elseif(is_admin()&&$row->is_app_hrd==0){?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <button id="btn_app_hrd" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Submit</button>
                            <p class="">(HRD)</p>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <p class="">(HRD)</p>
                            <?php } ?>
                          </p>
                        </div>

                        <?php if(!empty($row->user_app_lv1)){?>
                        <div class="col-md-4">
                          <p>Disetujui,</p>
                          <p class="wf-approve-sp">
                          <?php if($row->is_app_lv1==1) {
                            echo "<img class=approval_img src=$approved>"?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv1) ?></span><br/>
                            <span class="semi-bold"><?php echo (!empty($row->user_app_lv1)) ? get_user_position($row->user_app_lv1) : ''?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv1) ?></span><br/>
                            <?php }elseif($row->is_app_lv1==0 && $sess_nik == $row->user_app_lv1){?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <button id="btn_app_lv1" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Submit</button>
                            <p class="">...............................</p>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <p class="">...............................</p>
                            <?php } ?>
                          </p>
                        </div>
                        <?php } ?>
                      </div>
                    <!-- /div> -->
                    <?php if(!empty($row->user_app_lv2)){?>
                        <div class="col-md-7">
                          <p>Mengetahui,</p>
                          <p class="wf-approve-sp">
                          <?php if($row->is_app_lv2==1) {
                            echo "<img class=approval_img src=$approved>"?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv2) ?></span><br/>
                            <span class="semi-bold"><?php echo (!empty($row->user_app_lv2)) ? get_user_position($row->user_app_lv2) : ''?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv2) ?></span><br/>
                            <?php }elseif($row->is_app_lv2==0 && $sess_nik == $row->user_app_lv2){?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <button id="btn_app_lv2" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Submit</button>
                            <p class="">...............................</p>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <p class="">...............................</p>
                            <?php } ?>
                          </p>
                        </div>
                        <?php } ?>

                        <?php if(!empty($row->user_app_lv3)){?>
                        <div class="col-md-2">
                          <p>Mengetahui,</p>
                          <p class="wf-approve-sp">
                          <?php if($row->is_app_lv3==1) {
                            echo "<img class=approval_img src=$approved>"?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="semi-bold"><?php echo get_name($row->user_app_lv3) ?></span><br/>
                            <span class="semi-bold"><?php echo (!empty($row->user_app_lv3)) ? get_user_position($row->user_app_lv3) : ''?></span><br/>
                            <span class="small"><?php echo dateIndo($row->date_app_lv3) ?></span><br/>
                            <?php }elseif($row->is_app_lv3==0 && $sess_nik == $row->user_app_lv3){?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <button id="btn_app_lv3" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Submit</button>
                            <p class="">...............................</p>
                            <?php }else{?>
                            <span class="semi-bold"></span><br/>
                            <span class="small"></span><br/>
                            <span class="small"></span><br/>
                            <p class="">...............................</p>
                            <?php } ?>
                          </p>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach;}?>
              </form>
             </div>  
            </div>
          </div>
        </div>
      </div>
	          	
		
      </div>
		
	</div>  
	<!-- END PAGE -->