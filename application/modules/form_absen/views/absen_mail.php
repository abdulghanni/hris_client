<div class="grid simple">
            <div class="grid-title no-border">
              <h4>Form Keterangan Tidak <a href="<?php echo site_url('form_absen')?>"><span class="semi-bold">Absen</span></a></h4>
            </div>
            <div class="grid-body no-border">
            <?php 
            if($_num_rows>0){
              foreach($form_absen as $absen){?>
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
                          <input type="text" class="form-control" name="date_tidak_hadir" value="<?php echo dateIndo($absen->date_tidak_hadir)?>" disabled="disabled">
                        </div>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($absen->user_id)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_organization($user_nik)?>" disabled="disabled">
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
              </form>
              <?php }}?>
            </div>
          </div>