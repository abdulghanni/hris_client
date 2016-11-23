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
              <h4><a href="<?php echo site_url('form_pjd')?>">Form Perjalanan Dinas </a></h4>
            </div>
            <div class="grid-body no-border">
              <!--<form class="form-no-horizontal-spacing" id="add_spd_luar" action="<?php echo site_url() ?>form_spd_luar/add" method="post">-->
              <?php 
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
                echo form_open('form_pjd/add', $att); ?>
                <div class="row column-seperation">
                  <div class="col-md-5">
                    <h4>Admin Pembuat Tugas</h4> 
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                      <?php if(is_admin()||is_admin_bagian()||is_admin_khusus()){?>
                        <select id="emp" class="select2" style="width:100%" name="emp_tc">
                          <?php
                          foreach ($all_users->result() as $u) :
                            $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                            <option value="<?php echo get_nik($u->id)?>" <?php echo $selected?>><?php echo $u->username; ?></option>
                          <?php endforeach; ?>
                        </select>
                      <?php }else{?>
                        <input type="text" class="form-control" value="<?php echo get_name($sess_nik)?>" disabled>
                        <input type="hidden" id="emp" name="emp_tc" value="<?php echo $sess_nik?>">
                      <?php } ?>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="org_tc" id="organization" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_organization($sess_nik);?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="pos_tc" id="position" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_position($sess_nik);?>" disabled="disabled">
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

                    <div class="row form-row atasanlain" style="display:none" id="atasan-3">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-9">
                        <select name="atasan3" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan -</option>
                        </select>
                      </div>
                    </div>

                    <div class="row form-row atasanlain" style="display:none" id="atasan-4">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-9">
                        <select name="atasan4" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan -</option>
                        </select>
                      </div>
                    </div> 

                    <div class="row form-row atasanlain" style="display:none" id="atasan-5">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-9">
                        <select name="atasan5" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan -</option>
                        </select>
                      </div>
                    </div> 

                    <div class="row form-row atasanlain" style="display:none" id="atasan-6">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-9">
                        <select name="atasan6" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan -</option>
                        </select>
                      </div>
                    </div> 

                    <div class="row form-row atasanlain" style="display:none" id="atasan-7">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-9">
                        <select name="atasan7" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan -</option>
                        </select>
                      </div>
                    </div> 

                    <div class="row form-row atasanlain" style="display:none" id="atasan-8">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-9">
                        <select name="atasan8" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan -</option>
                        </select>
                      </div>
                    </div> 

                    <div class="row form-row atasanlain" style="display:none" id="atasan-9">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-9">
                        <select name="atasan9" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan -</option>
                        </select>
                      </div>
                    </div> 

                    <div class="row form-row atasanlain" style="display:none" id="atasan-10">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-9">
                        <select name="atasan10" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan -</option>
                        </select>
                      </div>
                    </div>  

                   <div class="row form-row">
                      <div class="col-md-3">
                      </div>
                      <div class="col-md-9">
                          <button type="button" class="btn btn-primary btn-xs" onclick="tambahatasan()" id="addatasan" title="Tambah Atasan"><i class="icon-plus"></i>&nbsp;<?php echo '';?></button>&nbsp;<button type="button" class="btn btn-danger btn-xs" onclick="hapusatasanz()" id="hapusatasan"  title="Hapus Atasan" style="display: none;"><i class="icon-minus"></i>&nbsp;<?php echo '';?></button>
                          
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Diajukan Kepada' ?></label>
                      </div>
                      <div class="col-md-9">
                        <input type="text" name="diajukan_ke" class="form-control" required="required">
                      </div>
                    </div> 

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right"><?php echo 'Jabatan' ?></label>
                      </div>
                      <div class="col-md-9">
                        <input type="text" name="jabatan" class="form-control" required="required">
                      </div>
                    </div> 
                    
                  </div>
                  <div class="col-md-7">
                    <h4>Memberi Tugas Kepada</h4>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <button type="button" id="btnAdd" class="btn btn-primary btn-xs" onclick="addEmp('dataTableEmp')"><i class="icon-plus"></i>&nbsp;<?php echo lang('add_button');?></button>
                        <button type="button" id="btnRemove" class="btn btn-danger btn-xs" onclick="deleteEmp('dataTableEmp')" style="display: none;"><i class="icon-remove" ></i>&nbsp;<?php echo 'Remove'?></button>
                      </div> 
                    </div>
                    <p></p>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <table id="dataTableEmp" class="table table-bordered">
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
                        <label class="form-label text-right">Jenis PJD</label>
                      </div>
                      <div class="col-md-9"> <?php echo form_radio('tipe_pjd','ac')?>&nbsp;&nbsp;Antar Cabang&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php echo form_radio('tipe_pjd','intern')?>&nbsp;&nbsp;Intern
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Tujuan PJD</label>
                      </div>
                      <div class="col-md-9">
                        <input name="destination" id="destination" type="text"  class="form-control" placeholder="Tujuan" value="" required>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Deskripsi</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" id="title" name="title" required></textarea>
                      </div>
                    </div>

                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Dari Cabang</label>
                          </div>
                          <div class="col-md-9">
                            <?php
                                $style_bu='class="form-control input-sm select2" style="width:100%" id="fromCabang"  required';
                                echo form_dropdown('city_from',$bu,'',$style_bu);
                              ?>
                          </div>
                        </div>
                        <br/>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Ke Cabang</label>
                          </div>
                          <div class="col-md-9">
                            <?php
                                $style_bu='class="form-control input-sm select2" style="width:100%" id="toCabang" required';
                                echo form_dropdown('city_to',$bu,'',$style_bu);
                              ?>
                          </div>
                        </div>
                        <br/>
                         <div class="row form-row">
                            <div class="col-md-3">
                              <label class="form-label text-right">Kota Tujuan</label>
                            </div>
                            <div class="col-md-9">
                              <?php
                                  $style_pos='class="select2 kota" id="kota" style="width:100%" required';
                                  echo form_dropdown("kota[]",array(''=>'- Pilih Kota -'),'',$style_pos);
                                ?>
                            </div>
                          </div>

                              <div id="kotaLain"></div>

                          <div class="row form-row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-9">
                              <button type="button" class="btn-primary" id="btnTambahKota" style="display:none">Tambah Kota</button>
                            </div>
                          </div>

                          <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Nama Kantor Cabang</label>
                          </div>
                          <div class="col-md-9">
                            <input type="text" class="form-control" name="nama_kantor_cabang">
                          </div>
                        </div>

                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Kendaraan</label>
                          </div>
                          <div class="col-md-9">
                            <select id="vehicle" name="vehicle[]" class="select2" style="width:100%">
                              <?php if ($tl_num_rows > 0) {
                              foreach ($transportation_list as $tl) :
                              ?>    
                              <option value="<?php echo $tl->id ?>" ><?php echo $tl->title ?></option>
                            <?php endforeach;
                            } ?>
                            </select>
                          </div>
                        </div>
                        <div id="kendaraanLain"></div>
                        <div class="row form-row">
                          <div class="col-md-3"></div>
                          <div class="col-md-9">
                            <button type="button" class="btn-primary" id="btnTambahKendaraan" style="">Tambah Kendaraan</button>
                          </div>
                        </div><br/>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Tgl. Berangkat</label>
                          </div>
                          <div class="col-md-8">
                            <div class="input-append date success no-padding">
                              <input type="text" class="form-control from_date" name="date_spd_start" value="" required>
                              <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                            </div>
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Tgl. Pulang</label>
                          </div>
                          <div class="col-md-8">
                            <div class="input-append date success no-padding">
                              <input type="text" class="form-control to_date" name="date_spd_end" value="" required>
                              <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                            </div>
                          </div>
                        </div>
                    </div>
                    <br/>
                    <hr/>
                       <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                           <h5 class="text-center"><span class="semi-bold">Ketentuan Biaya Perjalanan Dinas</span></h5>
                            <div class="row form-row">
                              <div class="col-md-6 text-left">
                                <button type="button" id="btnAddBiaya" class="btn btn-primary btn-xs" onclick="addRow('dataTable')"><i class="icon-plus"></i>&nbsp;<?php echo 'Tambah Biaya';?></button>
                                <button type="button" id="btnRemoveBiaya" class="btn btn-danger btn-xs" onclick="deleteRow('dataTable')" style=""><i class="icon-remove"></i>&nbsp;<?php echo 'Hapus'?></button>
                              </div> 
                            </div>
                            <p>&nbsp;</p>
                            <div class="row form-row"><div class="col-md-12 text-center"><i class="icon-warning-sign" style="color:grey ;text-shadow: 1px 1px 1px #ccc;font-size: 14px;"> Biaya uang makan, uang saku & hotel diisi dihalaman selanjutnya </i></div>
                        
                            <div class="row form-row">
                              <div class="col-md-12">
                                <table id="dataTable" class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th width="2%"></th>
                                      <th width="2%">No</th>
                                      <th width="40%">Jenis Biaya</th>
                                      <th width="40%">Jumlah Biaya</th>
                                    </tr>
                                  </thead>
                                </table>
                              </div>
                            </div>
                        </div>
                        </div>

                  </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button  id="btnSave" class="btn btn-danger btn-cons" type="submit" style="display: none;"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url() ?>form_pjd"><button id="btnCancel" class="btn btn-white btn-cons" type="button" style="display: none;">Cancel</button></a>
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
    function tambahatasan(){
        var skrg=$(".atasanlain:visible").length;
        var idskrg=skrg+3;
        $("#atasan-"+idskrg).show();
        $("#hapusatasan").show();
        if(idskrg==10){
        $("#addatasan").hide();
            
        }
       //alert(idskrg);
    }
    function hapusatasanz(){
        var skrg=$(".atasanlain:visible").length;
        var idskrg=skrg+2;
        $("#atasan-"+idskrg).hide();
        $("#addatasan").show();
        if(idskrg==3){
        $("#hapusatasan").hide();
            
        }
       //alert(idskrg);
    }
  function addEmp(tableID){
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
  cell3.innerHTML = "<select name='peserta[]' class='select2' style='width:100%'><?php foreach ($all_users as $key) :?><option value='<?php echo $key->nik ?>'><?php echo $key->username.' - '.$key->nik ?></option><?php endforeach;?></select>";  
  <?php }elseif(is_admin_bagian()){?>
  var cell3=row.insertCell(2);
  cell3.innerHTML = "<select name='peserta[]' class='select2' style='width:100%'><?php foreach ($penerima_tugas_satu_bu as $key => $up) :?><option value='<?php echo $up['ID'] ?>'><?php $reg = (is_registered($up['ID'])) ? '' : ' - Belum Terdaftar';echo $up['NAME'].' - '.$up['ID'].$reg ?></option><?php endforeach;?></select>"; 
  <?php }elseif(is_admin_khusus()){?>
  var cell3=row.insertCell(2);
  cell3.innerHTML = "<select name='peserta[]' class='select2' style='width:100%'><option value='0'> -- Pilih Karyawan -- </option><?php foreach ($users as $key => $up) :?><option value='<?php echo $up['nik'] ?>'><?php echo $up['username'].' - '.$up['nik'] ?></option><?php endforeach;?></select>"; 
  <?php } else { ?>
  var cell3=row.insertCell(2);
  cell3.innerHTML = "<select name='peserta[]' class='select2' style='width:100%'><?php foreach ($penerima_tugas as $key => $up) :?><option value='<?php echo $up['ID'] ?>'><?php $reg = (is_registered($up['ID'])) ? '' : ' - Belum Terdaftar';echo $up['NAME'].' - '.$up['ID'].$reg ?></option><?php endforeach;?></select>";  
  <?php } ?>
}
  function deleteEmp(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}
</script>

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
  var cell3=row.insertCell(2);
  cell3.innerHTML = "<select name='biaya_tambahan_id[]' class='select2' style='width:100%'><?php foreach($biaya_tambahan->result() as $row):?><option value='<?php echo $row->id?>'><?php echo $row->title?></option><?php endforeach;?></select>";  
  var cell4=row.insertCell(3);
  cell4.innerHTML = "<input type='text' name='jumlah_biaya_tambahan[]' class='form-control rupiah text-right'>";
}
  function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}
</script>