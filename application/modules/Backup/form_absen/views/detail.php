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
              <h4>Form Keterangan Tidak <span class="semi-bold">Absen</span></h4>
            </div>
            <div class="grid-body no-border">
            <?php 
            if($form_absen->num_rows()>0){
              foreach($form_absen->result() as $absen){?>
              <form class="form-no-horizontal-spacing" id=""> 
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">No</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo $absen->id?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Tanggal</label>
                      </div>
                      <div class="col-md-8">
                        <div class="input-append success no-padding">
                          <input type="text" class="form-control" name="date_tidak_hadir" value="<?php echo $absen->date?>" disabled="disabled">
                          <!-- <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> --> 
                        </div>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo $absen->name?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo $user_info['ORGANIZATION']; ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Keterangan</label>
                      </div>
                      <div class="col-md-9">
                        <div class="radio">
                          <?php 
                        if($absen->keterangan_id!=0){?>
                          <input checked="checked" id="tidak_absen_in" type="radio" name="keterangan" value="<?php echo $absen->keterangan_id?>">
                          <label for="<?php echo $absen->keterangan_absen;?>"><?php echo $absen->keterangan_absen;?></label>
                        <?php }else{?>
                          <input checked="checked" id="tidak_absen_in" type="radio" name="keterangan" value="0">
                          <label for="nO dATA">No Data</label>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Alasan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Alasan" value="<?php echo $absen->alasan?>" disabled="disabled">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="col-md-8 text-center">
                      <div class="row wf-cuti">
                        <div class="col-md-6">
                          Hormat Saya,<br/>
                          <p class="wf-approve-sp">
                            <span class="semi-bold"><?php echo $absen->name?></span><br/>
                            <span class="small"><?php echo $absen->created_on?></span><br/>
                          </p>
                        </div>
                        <div class="col-md-6">
                          Mengetahui,<br/>
                          <p class="wf-approve-sp">
                            <?php if($absen->is_app_lv2==1){?>
                            <span class="semi-bold"><?php echo $name_app_lv2?></span><br/>
                            <span class="small"><?php echo $absen->date_app_lv2?></span>
                            <?php } ?>
                          </p>
                          <p class="">(Ka. Cabang / Ka. Bagian)</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 text-center">
                      <div class="row wf-cuti">
                        <div class="col-md-12">
                          &nbsp;<br/>
                          <p class="wf-approve-sp">
                            <?php if($absen->is_app_lv1==1){?>
                            <span class="semi-bold"><?php echo $name_app_lv1?></span><br/>
                            <span class="small"><?php echo $absen->date_app_lv1?></span>
                            <?php } ?>
                          </p>
                          <p class="">(Supervisor)</p>
                        </div>
                      </div>
                    </div>
                </div>
              </form>
              <?php }}?>
            </div>
          </div>
        </div>
      </div>
              
    
      </div>
    
  </div>  
  <!-- END PAGE --> 