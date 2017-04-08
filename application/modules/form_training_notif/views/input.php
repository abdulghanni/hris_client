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
              <h4>Form Pengajuan <a href="<?php echo site_url('form_training_notif')?>"><span class="semi-bold">Notifikasi Pelatihan</span></a></h4>
            </div>
            <div class="grid-body no-border">
              <!--<form class="form-no-horizontal-spacing" id="formaddtraining" action="<?php echo site_url('form_training_notif/add')?>"> -->
              <?php 
              $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
              echo form_open('form_training_notif/add', $att);?>
                <div class="row column-seperation">
                  <div class="col-md-5">
                    <h4>Peserta Pelatihan</h4>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                      <?php if(is_admin()||is_admin_bagian()||is_admin_khusus()){?>
                      <select id="emp" class="select2" style="width:100%" name="emp">
                        <?php
                        foreach ($all_users->result() as $up) { ?>
                          <option value="<?php echo $up->id ?>"><?php echo $up->username; ?></option>
                        <?php } ?>
                      </select>
                      <?php }else{ ?>
                        <input type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($sess_id)?>" readonly>
                        <input id="emp" name="emp" type="hidden"  class="form-control" placeholder="Nama" value="<?php echo $sess_id?>">
                      <?php } ?>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="org_tc" id="organization" type="text"  class="form-control" value="" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="pos_tc" id="position" type="text"  class="form-control" value="" disabled="disabled">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="bold form-label text-right"><?php echo 'Approval' ?></label>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Langsung' ?></label>
                      </div>
                      <div class="col-md-9">
                        <?php
                          $style_up='class="select2" style="width:100%" id="atasan1"';
                          echo form_dropdown('atasan1',array('0'=>'- Pilih Atasan Langsung -'),'',$style_up);
                        ?>
                      </div>
                    </div>  
                    
                  </div>
                  <div class="col-md-7">
                    
                    <h4>Detail Pelatihan</h4>
                    <div class="row form-row">
                      <div class="col-md-3">
                              <label class="form-label text-left">Periode</label>
                          </div>
                          <div class="col-md-9">
                        <select class="select2" style="width:100%" id="comp_session_id" name="comp_session_id" required>
                              <option value="">-- Pilih Periode --</option>
                          <?php foreach($periode as $u){?>
                            <option value="<?php echo $u->id?>"><?php echo $u->year?></option>
                          <?php } ?>
                        </select>
                          </div>
                      </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Nama Pelatihan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="training_name"  type="text"  class="form-control"  value="" required>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Tanggal Pelatihan</label>
                      </div>
                          <div class="col-md-4">
                            <div id="datepicker_start" class="input-append date success no-padding">
                              <input type="text" class="form-control" name="tanggal_mulai" required>
                              <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                            </div>
                          </div>
                          <div class="col-md-1">S/D</div>
                          <div class="col-md-4">
                            <div id="datepicker_end" class="input-append date success no-padding">
                              <input type="text" class="form-control" name="tanggal_akhir" required>
                              <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button class="btn btn-danger btn-cons" id="btnSave" type="submit" style="display: none;"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_training_notif')?>"><button id="btnCancel" class="btn btn-white btn-cons" type="button" style="display: none;">Cancel</button></a>
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


<?php $all_users = $all_users->result();?>
<script type="text/javascript">
  function addRow(tableID){
  var table=document.getElementById(tableID);
  var rowCount=table.rows.length;
  var row=table.insertRow(rowCount);

  var cell1=row.insertCell(0);
  var element1=document.createElement("input");
  element1.type="checkbox";
  element1.name="chkbox[]";
  element1.className="checkbox1";
  cell1.appendChild(element1);

  var cell2=row.insertCell(1);
  cell2.innerHTML=rowCount+1-1;
  
  <?php if(is_admin()){?>
  var cell3=row.insertCell(2);
  cell3.innerHTML = "<select name='peserta[]' class='select2' style='width:100%'><option value='0'> -- Pilih Karyawan -- </option><?php foreach ($all_users as $key) :?><option value='<?php echo $key->nik ?>'><?php echo $key->username.' - '.$key->nik ?></option><?php endforeach;?></select>";  
  <?php }elseif(is_admin_bagian()){?>
  var cell3=row.insertCell(2);
  cell3.innerHTML = "<select name='peserta[]' class='select2' style='width:100%'><option value='0'> -- Pilih Karyawan -- </option><?php foreach ($penerima_tugas_satu_bu as $key => $up) :?><option value='<?php echo $up['ID'] ?>'><?php echo $up['NAME'].' - '.$up['ID'] ?></option><?php endforeach;?></select>"; 
  <?php }elseif(is_admin_khusus()){?>
  var cell3=row.insertCell(2);
  cell3.innerHTML = "<select name='peserta[]' class='select2' style='width:100%'><option value='0'> -- Pilih Karyawan -- </option><?php foreach ($users as $key => $up) :?><option value='<?php echo $up['nik'] ?>'><?php echo $up['username'].' - '.$up['nik'] ?></option><?php endforeach;?></select>"; 
  <?php } else { ?>
  var cell3=row.insertCell(2);
  cell3.innerHTML = "<select name='peserta[]' class='select2' style='width:100%'><option value='0'> -- Pilih Karyawan -- </option><?php foreach ($penerima_tugas as $key => $up) :?><option value='<?php echo $up['ID'] ?>'><?php echo $up['NAME'].' - '.$up['ID'] ?></option><?php endforeach;?></select>";  
  <?php } ?>
}
  function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}
</script>
