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
              <h4>Form Pengajuan <a href="<?php echo site_url('form_training_group')?>"><span class="semi-bold">Pelatihan</span></a></h4>
            </div>
            <div class="grid-body no-border">
              <!--<form class="form-no-horizontal-spacing" id="formaddtraining" action="<?php echo site_url('form_training_group/add')?>"> -->
              <?php 
              $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
              echo form_open('form_training_group/add', $att);?>
                <div class="row column-seperation">
                  <div class="col-md-5">
                    <h4>Yang Mengajukan Pelatihan</h4>
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

                   <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Tidak Langsung' ?></label>
                      </div>
                      <div class="col-md-9">
                        <select name="atasan2" id="atasan2" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan Tidak Langsung -</option>
                        </select>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-9">
                        <select name="atasan3" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan Lainnya -</option>
                        </select>
                      </div>
                    </div>    
                    
                  </div>
                  <div class="col-md-7">
                    <h4>Peserta Pelatihan</h4>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <button type="button" id="btnAdd" class="btn btn-primary btn-xs" onclick="addRow('dataTable')"><i class="icon-plus"></i>&nbsp;<?php echo lang('add_button');?></button>
                        <button type="button" id="btnRemove" class="btn btn-danger btn-xs" onclick="deleteRow('dataTable')" style="display: none;"><i class="icon-remove"></i>&nbsp;<?php echo 'Remove'?></button>
                      </div> 
                    </div>
                    <p></p>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <table id="dataTable" class="table table-bordered">
                          <thead>
                            <tr>
                              <th width="2%"></th>
                              <th width="2%">No</th>
                              <th width="96%">Nama</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Pelatihan</label>
                      </div>
                      <div class="col-md-9">
                         <?php 
                          $js = 'id="training_id" class="select2" style="width:50%" required';
                          echo form_dropdown('training_id', $options_training,'',$js); 
                        ?>
                      </div>
                      <div class="col-md-3">
                        <label class="form-label text-left">Nama Pelatihan</label>
                      </div>
                      <div class="col-md-9">
                        <input id="training_name" name="training_name" type="text"  class="form-control"  required readonly="readonly">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Tujuan Pelatihan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="tujuan_training" id="tujuan_training" type="text"  class="form-control" required readonly="readonly">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button class="btn btn-danger btn-cons" id="btnSave" type="submit" style="display: none;"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_training_group')?>"><button id="btnCancel" class="btn btn-white btn-cons" type="button" style="display: none;">Cancel</button></a>
                    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url()?>">
                    <input type="hidden" name="date_start" id="date_start" >
                    <input type="hidden" name="date_end" id="date_end" >
                    <input type="hidden" name="vendor_id" id="vendor_id" >
                    <input type="hidden" name="training_type_id" id="training_type_id" >
                    <input type="hidden" name="penyelenggara_id" id="penyelenggara_id" >
                    <input type="hidden" name="pembiayaan_id" id="pembiayaan_id" >
                    <input type="hidden" name="ikatan_dinas_id" id="ikatan_dinas_id" >
                    <input type="hidden" name="waktu_id" id="waktu_id" >
                    <input type="hidden" name="besar_biaya" id="besar_biaya" >
                    <input type="hidden" name="tempat" id="tempat" >
                    <input type="hidden" name="jam_mulai" id="jam_mulai" >
                    <input type="hidden" name="jam_akhir" id="jam_akhir" >
                    <input type="hidden" name="narasumber" id="narasumber" >
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
