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
                <h4>Form Pengajuan <span class="semi-bold"><a href="<?php echo site_url('form_kenaikan_gaji')?>">Kenaikan Gaji</a></span></h4>
              </div>
              <div class="grid-body no-border">
                <?php
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
                echo form_open_multipart('form_kenaikan_gaji/add', $att);
                ?>
                  <div class="row column-seperation">
                    <div class="col-md-5">
                      <h4>Informasi karyawan</h4>
                      
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Nama</label>
                        </div>
                        <div class="col-md-9">
                          <?php if(is_admin()){?>
                            <select id="emp" class="select2" style="width:100%" name="emp">
                              <option value="0">-- Pilih Karyawan --</option>
                              <?php
                              foreach ($all_users->result() as $u) :
                                $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                                <option value="<?php echo $u->id?>" <?php echo $selected?>><?php echo $u->username.' - '.$u->nik; ?></option>
                              <?php endforeach; ?>
                            </select>
                          <?php }elseif($subordinate->num_rows() > 0){?>
                          <input type="hidden" id="empSess" value="<?= $sess_id ?>">
                            <select id="empBawahan" class="select2" style="width:100%" name="emp">
                              <option value="0">-- Pilih Karyawan --</option>
                              <?php foreach($subordinate->result() as $row):?>
                                <option value="<?php echo $row->id?>"><?php echo get_name($row->id).' - '.get_nik($row->id)?></option>
                              <?php endforeach;?>
                            </select>
                          <?php }else{ ?>
                            <select id="emp" class="select2" style="width:100%" name="emp">
                              <option value="0">-- Anda tidak mempunyai bawahan --</option>
                            </select>
                        <?php } ?>
                        </div>
                      </div>        
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Unit Bisnis</label>
                        </div>
                        <div class="col-md-9">
                          <input id="bu" class="form-control " placeholder="Unit Bisnis" value=""  disabled="disabled">
                          <input name="old_bu" id="bu_id" type="hidden"  class="form-control " placeholder="Unit Bisnis" value="">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Dept/Bagian</label>
                        </div>
                        <div class="col-md-9">
                          <input id="organization" class="form-control " placeholder="Dept/Bagian" value=""  disabled="disabled">
                          <input name="old_org" id="organization_id" type="hidden"  class="form-control " placeholder="Unit Bisnis" value="">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Jabatan</label>
                        </div>
                        <div class="col-md-9">
                          <input id="position" class="form-control " placeholder="Jabatan" value=""  disabled="disabled">
                          <input name="old_pos" id="position_id" type="hidden"  class="form-control " placeholder="Unit Bisnis" value="">
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right">Tanggal Mulai Bekerja</label>
                        </div>
                        <div class="col-md-9">
                          <input name="form3LastName" id="seniority_date" type="text"  class="form-control " placeholder="Nama" value=""  disabled="disabled" >
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-12">
                          <label class="bold form-label text-left"><?php echo 'Approval' ?></label>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left"><?php echo 'Atasan Langsung' ?></label>
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
                        <label class="form-label text-left"><?php echo 'Atasan Tidak Langsung' ?></label>
                      </div>
                      <div class="col-md-9">
                        <select name="atasan2" id="atasan2" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan Tidak Langsung -</option>
                        </select>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left"><?php echo 'Atasan Lainnya' ?></label>
                      </div>
                      <div class="col-md-9">
                        <select name="atasan3" id="atasan3" class="select2" style="width:100%">
                            <option value="0">- Pilih Atasan Lainnya -</option>
                        </select>
                      </div>
                    </div>

                    <input type="hidden" id="grade" value="">
                    <div id="lima_atasan" style="display:none">
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left"><?php echo 'Atasan Lainnya' ?></label>
                        </div>
                        <div class="col-md-9">
                          <select name="atasan4" id="atasan4" class="select2" style="width:100%">
                              <option value="0">- Pilih Atasan Lainnya -</option>
                          </select>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left"><?php echo 'Atasan Lainnya' ?></label>
                        </div>
                        <div class="col-md-9">
                          <select name="atasan5" id="atasan5" class="select2" style="width:100%">
                              <option value="0">- Pilih Atasan Lainnya -</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    </div>

                    <div class="col-md-7">
                      <h4>Kenaikan gaji Yang Diajukan</h4>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Unit Bisnis Baru</label>
                        </div>
                        <div class="col-md-8">
                          <?php
                            $style_bu='class="select2" style="width:100%" id="bu_new"  onChange="tampilOrg()"';
                            echo form_dropdown('bu',$bu,'',$style_bu);
                          ?>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Dept/Bagian Baru</label>
                        </div>
                        <div class="col-md-8">
                          <?php
                            $style_org='class="select2" id="org" onChange="tampilPos()" style="width:100%"';
                            echo form_dropdown("org",array('Pilih Organization'=>'- Pilih Organization -'),'',$style_org);
                          ?>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Jabatan Baru</label>
                        </div>
                       <div class="col-md-8">
                          <?php
                            $style_pos='class="select2" id="pos" style="width:100%"';
                            echo form_dropdown("pos",array('Pilih Position'=>'- Pilih Position -'),'',$style_pos);
                          ?>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Tgl. Kenaikan gaji</label>
                        </div>
                        <div class="col-md-8">
                          <div class="input-append date success no-padding">
                          <input type="text" class="form-control" name="date_kenaikan_gaji" required>
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                        </div>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Alasan Kenaikan gaji</label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="alasan" id="alasan" class="form-control" placeholder="Alasan kenaikan gaji" required></textarea>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-12">
                          <label class="bold form-label text-left">Attachment : </label>
                        </div>
                        <div class="col-md-12">
                          <table id="attachment">
                            <tr>
                              <td><input type='file' class="file" id="file" name='userfile[]' size='20'/></td>
                            </tr>
                          </table>
                          <button type="button" id="btnAddAttachment" class="btn btn-primary btn-xs" onclick="addAttachment()"><i class="icon-plus"></i>&nbsp;<?php echo lang('add_button').' Attachment';?></button><br/><br/>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                           <h5 class="text-center"><span class="semi-bold">Komponen Gaji</span></h5>
                            <div class="row form-row">
                              <div class="col-md-6 text-left">
                                <button type="button" id="btnAddBiaya" class="btn btn-primary btn-xs" onclick="addRow('dataTable')"><i class="icon-plus"></i>&nbsp;<?php echo 'Tambah';?></button>
                                <button type="button" id="btnRemoveBiaya" class="btn btn-danger btn-xs" onclick="deleteRow('dataTable')" style=""><i class="icon-remove"></i>&nbsp;<?php echo 'Hapus'?></button>
                              </div> 
                            </div>
                            <p>&nbsp;</p>
                            
                        
                            <div class="row form-row">
                              <div class="col-md-12">
                                <table id="dataTable" class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th width="2%"></th>
                                      <th width="2%">No</th>
                                      <th width="40%">Lama</th>
                                      <th width="40%">Baru</th>
                                    </tr>
                                  </thead>
                                </table>
                              </div>
                            </div>
                        </div>
                        </div>
                  </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_kenaikan_gaji')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
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
     buid = document.getElementById("bu_new").value;
     $.ajax({
         url:"<?php echo base_url();?>form_demotion/get_org/"+buid+"",
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
         url:"<?php echo base_url();?>form_demotion/get_pos/"+orgid+"",
         success: function(response){
         $("#pos").html(response);
         },
         dataType:"html"
     });
     return false;
 }

 function addAttachment(){
    var table=document.getElementById('attachment');
    var rowCount=table.rows.length;
    var row=table.insertRow(rowCount);

    var cell1=row.insertCell(0);
    var element1=document.createElement("input");
    element1.type="file";
    element1.name="userfile[]";
    element1.class="file";
    cell1.appendChild(element1);
  }

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
    cell3.innerHTML = "<input type='text' name='lama[]' class='form-control rupiah text-right'>";  
    
    var cell4=row.insertCell(3);
    cell4.innerHTML = "<input type='text' name='baru[]' class='form-control rupiah text-right'>";
  }
  function deleteRow(tableID)
  {
    try{
      var table=document.getElementById(tableID);
      var rowCount=table.rows.length;
      
        for(var i=0;i<rowCount;i++)
        {
          var row=table.rows[i];
          var chkbox=row.cells[0].childNodes[0];
          
          if(null!=chkbox&&true==chkbox.checked)
          {
            table.deleteRow(i);
            rowCount--;
            i--;
          }
        }
      }
      catch(e)
      {
        alert(e);
      }
    }
</script>

