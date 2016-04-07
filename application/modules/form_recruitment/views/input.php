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
              <h4>Form Permintaan <span class="semi-bold"><a href="<?php echo site_url('form_recruitment')?>">SDM Baru</a></span></h4>
            </div>
            <div class="grid-body no-border">
              <?php
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
                echo form_open('form_recruitment/add', $att);
                ?>
                <div class="row column-seperation">  

                  <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Unit Bisnis</label>
                      </div>
                      <div class="col-md-6">
                        <?php
                            $style_bu='class="form-control input-sm select2" style="width:100%" id="bu"  onChange="tampilOrg()" required';
                            echo form_dropdown('bu',$bu,'',$style_bu);
                          ?>
                      </div>
                  </div>
                  <br/>
                  <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Dept / Bagian</label>
                      </div>
                      <div class="col-md-6">
                        <?php
                          $style_org='class="select2" id="org" onChange="tampilPos()" style="width:100%" required';
                          echo form_dropdown("org",array(''=>'- Pilih Bagian -'),'',$style_org);
                        ?>
                      </div>
                  </div>

                  <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-6">
                        <?php
                            $style_pos='class="select2" id="pos" style="width:100%" required';
                            echo form_dropdown("pos",array(''=>'- Pilih Position -'),'',$style_pos);
                          ?>
                      </div>
                  </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jml yang dibutuhkan</label>
                      </div>
                      <div class="col-md-4">
                        <input name="jumlah" id="jumlah" type="text"  class="form-control" placeholder="Jml" value="" required>
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Status</label>
                      </div>
                      <div class="col-md-4">
                        <select name="status"  id="status" class="form-custom select2" style="width:100%" required>
                        <?php if($status->num_rows()>0){
                          foreach($status->result() as $row):?>
                          <option value="<?php echo $row->id?>"><?php echo $row->title?></option>
                        <?php endforeach;}?>
                        </select>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Urgensi (Kebutuhan)</label>
                      </div>
                      <div class="col-md-10">
                        <select name="urgensi" id="urgensi" class="form-custom select2" style="width:100%" required>
                          <?php if($urgensi->num_rows()>0){
                          foreach($urgensi->result() as $row):?>
                          <option value="<?php echo $row->id?>"><?php echo $row->title?></option>
                        <?php endforeach;}?>
                        </select>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <h4><strong>Kualifikasi :</strong></h4>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jenis Kelamin</label>
                      </div>
                      <?php 
                        if($jenis_kelamin->num_rows()>0){
                          foreach($jenis_kelamin->result() as $row):?>
                      <div class="col-md-1">
                        <div class="checkbox check-primary checkbox-circle" >
                          <input name="jenis_kelamin[]" class="checkbox1" type="checkbox" id="jenis_kelamin<?php echo $row->id ?>" value="<?php echo $row->id ?>" checked="checked">
                            <label for="jenis_kelamin<?php echo $row->id ?>"><?php echo $row->title?></label>
                          </div>
                      </div>
                    <?php endforeach;} ?>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Pendidikan</label>
                      </div>
                      <?php 
                          if($pendidikan->num_rows()>0){
                            foreach($pendidikan->result() as $row):?>
                        <div class="col-md-2">
                          <div class="checkbox check-primary checkbox-circle" >
                            <input name="pendidikan[]" class="checkbox1" type="checkbox" id="pendidikan<?php echo $row->id ?>" value="<?php echo $row->id ?>" checked="checked">
                              <label for="pendidikan<?php echo $row->id ?>"><?php echo $row->title?></label>
                            </div>
                        </div>
                      <?php endforeach;} ?>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jurusan</label>
                      </div>
                      <div class="col-md-3">
                        <select name="jurusan" id="jurusan" class="form-custom select2" style="width:100%" required>
                          <?php if($jurusan->num_rows()>0){
                            foreach($jurusan->result() as $row):?>
                            <option value="<?php echo $row->id?>"><?php echo $row->title?></option>
                          <?php endforeach;}?>
                        </select>
                      </div>
                      <div class="col-md-1">
                        <label class="form-label text-right">IPK(Min)</label>
                      </div>
                      <div class="col-md-2">
                        <select name="ipk" id="ipk" class="form-custom select2" style="width:100%" required>
                          <?php if($ipk->num_rows()>0){
                            foreach($ipk->result() as $row):?>
                            <option value="<?php echo $row->id?>"><?php echo $row->title?></option>
                          <?php endforeach;}?>
                        </select>
                      </div>
                      <div class="col-md-1">
                        <label class="form-label text-right">Toefl(Min)</label>
                      </div>
                      <div class="col-md-2">
                        <select name="toefl" id="toefl" class="form-custom select2" style="width:100%" required>
                          <?php if($toefl->num_rows()>0){
                            foreach($toefl->result() as $row):?>
                            <option value="<?php echo $row->id?>"><?php echo $row->title?></option>
                          <?php endforeach;}?>
                        </select>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-4">
                        <h4><strong>Kemampuan Teknis :</strong></h4>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Komputer</label>
                      </div>
                      <div class="col-md-10">
                        <?php 
                          if($komputer->num_rows()>0){
                            foreach($komputer->result() as $row):?>
                        <div class="col-md-3">
                          <div class="checkbox check-primary checkbox-circle" >
                            <input name="komputer[]" class="checkbox1" type="checkbox" id="komputer<?php echo $row->id ?>" value="<?php echo $row->id ?>">
                              <label for="komputer<?php echo $row->id ?>"><?php echo $row->title?></label>
                            </div>
                        </div>
                      <?php endforeach;} ?>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Bahasa Pemrograman</label>
                      </div>
                      <div class="col-md-10">
                        <input name="pemrograman" id="pemrograman" type="text"  class="form-control" placeholder="Bahasa Pemrograman" value="">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Komunikasi</label>
                      </div>
                      <div class="col-md-10">
                        <input name="komunikasi" id="form3LastName" type="text"  class="form-control" placeholder="Komunikasi" value="">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Grafika</label>
                      </div>
                      <div class="col-md-10">
                        <input name="grafika" id="form3LastName" type="text"  class="form-control" placeholder="Grafika" value="">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Desain/Setting</label>
                      </div>
                      <div class="col-md-10">
                        <input name="desain" id="form3LastName" type="text"  class="form-control" placeholder="Desain/Setting" value="">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Brevet</label>
                      </div>
                      <div class="col-md-10">
                        <select name="brevet" id="brevet" class="form-custom select2" style="width:100%">
                          <?php if($brevet->num_rows()>0){?>
                          <option value="0">- Pilih Brevet</option>
                          <?php foreach($brevet->result() as $row):?>
                          <option value="<?php echo $row->id?>"><?php echo $row->title?></option>
                        <?php endforeach;}?>
                        </select>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Lain-lain</label>
                      </div>
                      <div class="col-md-10">
                        <input name="lain-lain" id="form3LastName" type="text"  class="form-control" placeholder="Lain-lain" value="">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Portfolio</label>
                      </div>
                      <div class="col-md-10">
                        <input name="portofolio" id="form3LastName" type="text"  class="form-control" placeholder="Portfolio" value="">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Pengalaman</label>
                      </div>
                      <div class="col-md-2">
                        <input name="pengalaman" id="form3LastName" type="text"  class="form-control" placeholder="Bidang" value="">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">selama</label>
                      </div>
                      <div class="col-md-1">
                        <input name="lama_pengalaman" id="form3LastName" type="text"  class="form-control" placeholder="" value=""> 
                      </div>
                      <div class="col-md-1">
                        <label class="form-label text-right">Tahun</label>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Job Desc</label>
                      </div>
                      <div class="col-md-10">
                        <textarea name="job_desc" id="text-editor" placeholder="Enter text ..." class="form-control" rows="10" required></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Catatan Pengaju</label>
                      </div>
                      <div class="col-md-10">
                        <textarea name="note_pengaju" id="text-editor" placeholder="Enter text ..." class="form-control" rows="10"></textarea>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="bold form-label text-left"><?php echo 'Approval' ?></label>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left"><?php echo 'Atasan Langsung' ?></label>
                      </div>
                      <div class="col-md-5">
                        <?php if(is_admin()){?>
                        <select id="atasan1" class="select2" style="width:100%" name="atasan1" >
                        <option value="0">- Pilih Atasan Langsung -</option>
                          <?php
                          foreach ($all_users->result() as $u) :
                            $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                            <option value="<?php echo $u->nik?>" <?php echo $selected?>><?php echo $u->username?></option>
                          <?php endforeach; ?>
                        </select>
                        <?php }else{ ?>
                        <select name="atasan1" id="atasan1" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan Langsung -</option>
                            <?php foreach ($user_atasan as $key => $up) : ?>
                              <option value="<?php echo $up['ID'] ?>"><?php echo $up['NAME']; ?></option>
                            <?php endforeach;?>
                          </select>
                            <?php }?>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left"><?php echo 'Atasan Tidak Langsung' ?></label>
                      </div>
                      <div class="col-md-5">
                        <select name="atasan2" id="atasan2" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan Tidak Langsung -</option>
                        </select>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-5">
                        <?php if(is_admin()){?>
                        <select id="atasan3" class="select2" style="width:100%" name="atasan3" >
                        <option value="0">- Pilih Atasan Lainnya -</option>
                          <?php
                          foreach ($all_users->result() as $u) :
                            $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                            <option value="<?php echo $u->nik?>" <?php echo $selected?>><?php echo $u->username?></option>
                          <?php endforeach; ?>
                        </select>
                        <?php }else{ ?>
                        <select name="atasan3" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan Lainnya -</option>
                            <?php foreach ($user_atasan as $key => $up) : ?>
                              <option value="<?php echo $up['ID'] ?>"><?php echo $up['NAME']; ?></option>
                            <?php endforeach;?>
                          </select>
                            <?php }?>
                      </div>
                    </div>


                  </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button id="btnAdd" class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_recruitment')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
	          	
		
      </div>
		
	</div>  
	<!-- END PAGE -->

  <script type="text/javascript">

 function tampilOrg()
 {
     orgid = document.getElementById("bu").value;
     $.ajax({
         url:"<?php echo base_url();?>form_recruitment/get_org/"+orgid+"",
         success: function(response){
         $("#org").html(response);
         },
         dataType:"html"
     });
     return false;
 }
 
 function tampilPos()
 {
     orgid = document.getElementById("org").value;
     $.ajax({
         url:"<?php echo base_url();?>form_recruitment/get_pos/"+orgid+"",
         success: function(response){
         $("#pos").html(response);
         },
         dataType:"html"
     });
     return false;
 }
</script>