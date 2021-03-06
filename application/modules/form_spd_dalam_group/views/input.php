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
              <h4>Form <a href="<?php echo site_url('form_spd_dalam_group')?>">Perjalanan Dinas <span class="semi-bold">Dalam Kota (Group)</span></a></h4>
            </div>
            <div class="grid-body no-border">
              <!--<form class="form-no-horizontal-spacing" id="add_spd_dalam_group" action="<?php echo site_url() ?>form_spd_dalam_group/add" method="post"> -->
              <?php 
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
                echo form_open('form_spd_dalam_group/add', $att);?>
                <div class="row column-seperation">
                  <div class="col-md-5">
                    <h4>Admin Pembuat Tugas</h4>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                      <?php if(is_admin()||is_admin_bagian()){?>
                      <select id="emp" class="select2" style="width:100%" name="emp_tc">
                        <?php
                        foreach ($all_users->result() as $up) { ?>
                          <option value="<?php echo (!empty(get_nik($up->id))) ? get_nik($up->id) : $up->id ?>"><?php echo $up->username; ?></option>
                        <?php } ?>
                      </select>
                      <?php }else{ ?>
                        <input type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($sess_id)?>" readonly>
                        <input id="emp" name="emp_tc" type="hidden"  class="form-control" placeholder="Nama" value="<?php echo get_nik($sess_id)?>">
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
                    <h4>Memberi Tugas Kepada</h4>
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
                        <label class="form-label text-left">Tujuan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="destination" id="destination" type="text"  class="form-control" placeholder="Tujuan" value="" required>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Dalam Rangka</label>
                      </div>
                      <div class="col-md-9">
                        <input name="title" id="title" type="text"  class="form-control" placeholder="Dalam Rangka" value="" required>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Tgl. Berangkat</label>
                      </div>
                      <div class="col-md-7">
                        <div class="input-append date success no-padding">
                          <input type="text" class="form-control" name="date_spd" required>
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                        </div>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Waktu</label>
                      </div>
                      <div class="col-md-2">
                        <div class="input-append bootstrap-timepicker">
                          <input name="spd_start_time" id="timepicker2" type="text" class="timepicker-24" value="" required>
                          <span class="add-on">
                              <i class="icon-time"></i>
                          </span>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <label class="form-label text-right">s/d</label>
                      </div>
                      <div class="col-md-2">
                        <div class="input-append bootstrap-timepicker">
                          <input name="spd_end_time" id="timepicker2" type="text" class="timepicker-24" value="" required>
                          <span class="add-on">
                              <i class="icon-time"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button class="btn btn-danger btn-cons" id="btnSave" type="submit" style="display: none;"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_spd_dalam_group')?>"><button id="btnCancel" class="btn btn-white btn-cons" type="button" style="display: none;">Cancel</button></a>
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
  <?php } else { ?>
  var cell3=row.insertCell(2);
  cell3.innerHTML = "<select name='peserta[]' class='select2' style='width:100%'><option value='0'> -- Pilih Karyawan -- </option><?php foreach ($penerima_tugas as $key => $up) :?><option value='<?php echo $up['ID'] ?>'><?php echo $up['NAME'].' - '.$up['ID'] ?></option><?php endforeach;?></select>";  
  <?php } ?>
}
  function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}
</script>