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
                <h4>Input Pengajuan <span class="semi-bold"><a href="<?php echo site_url('form_pengangkatan')?>"> Pengangkatan</a></span></h4>
              </div>
              <div class="grid-body no-border">
                <?php
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
                echo form_open_multipart('form_pengangkatan/add', $att);
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
                          <label class="form-label text-right">Status</label>
                        </div>
                        <div class="col-md-9">
                          <input id="statuss" class="form-control "  value=""  disabled="disabled">
                          <input name="old_status" id="status_id" type="hidden"  class="form-control " value="">
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

                    </div>

                    <div class="col-md-7">
                      <h4>Pengangkatan Yang Diajukan</h4>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Status Baru</label>
                        </div>
                        <div class="col-md-8">
                          <select name="status_pengangkatan_id" class="select2" style="width:100%">
                            <option value="0">-- Pilih Status Pengangkatan Baru --</option>
                            <?php foreach ($status->result() as $key) {
                              echo "<option value='$key->id'>$key->title</option>";
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Tgl. Pengangkatan</label>
                        </div>
                        <div class="col-md-8">
                          <div class="input-append date success no-padding">
                          <input type="text" class="form-control" name="date_pengangkatan" required>
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                        </div>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-4">
                          <label class="form-label text-left">Alasan Pengangkatan</label>
                        </div>
                        <div class="col-md-8">
                          <textarea name="alasan" id="alasan" class="form-control" placeholder="" required></textarea>
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
                          <button type="button" id="btnAddAttachment" class="btn-primary btn-xs" onclick="addAttachment()"><i class="icon-plus"></i>&nbsp;<?php echo lang('add_button').' Attachment';?></button><br/><br/>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_pengangkatan')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
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
  </script>