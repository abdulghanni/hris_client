<div class="page-content">
    <div id="portlet-config" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
             <h3>Widget Settings</h3>
        </div>
        <div class="modal-body">Widget settings form goes here</div>
    </div>
    <div class="clearfix"></div>
    <div class="content">
        <div class="page-title">
            <i class="icon-custom-left"></i>
            <h3>Training</h3> 
        </div>
          <div class="row">
            <div class="col-md-12">
              <div class="grid simple">
                <div class="grid-body no-border email-body">
                  <br/>
                  <div class="row-fluid">
                    <div class="row-fluid dataTables_wrapper">
                      <div class="clearfix"></div>
                      <button class="btn btn-success btn" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Add</button>
                      <br />
                      <br />
                      <input type="hidden" name="url_ajax_list" id="url_ajax_list" value="<?php echo $url_ajax_list ?>">
                      <input type="hidden" name="url_ajax_add" id="url_ajax_add" value="<?php echo $url_ajax_add ?>">
                      <input type="hidden" name="url_ajax_edit" id="url_ajax_edit" value="<?php echo $url_ajax_edit ?>">
                      <input type="hidden" name="url_ajax_delete" id="url_ajax_delete" value="<?php echo $url_ajax_delete ?>">
                      <input type="hidden" name="url_ajax_update" id="url_ajax_update" value="<?php echo $url_ajax_update ?>">
                      <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>Mulai training</th>
                            <th>Selesai training</th>
                            <th>Vendor</th>
                            <th>Deskripsi</th>
                            <th style="width:125px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

<!-- Bootstrap modal -->
  <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_form" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Form</h3>
        </div>
        <form action="#" id="form-competency" class="form">
          <div class="modal-body">
              <div class="row form-row">
                <label class="control-label col-md-3">Title</label>
                <div class="col-md-9">
                  <input name="training_title" placeholder="" class="form-control" type="text">
                  <span class="help-block"></span>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">Deskripsi</label>
                <div class="col-md-9">
                  <input name="training_deskripsi" placeholder="" class="form-control" type="text">
                  <span class="help-block"></span>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">Mulai pelatihan</label>
                <div class="col-md-9">
                  <div id="date_start" class="input-append success date no-padding">
                    <input name="date_start" placeholder="" class="form-control" type="text" required>
                    <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">Selesai pelatihan</label>
                <div class="col-md-9">
                  <div id="date_end" class="input-append date success no-padding">
                    <input type="text" class="form-control" name="date_end" required>
                    <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">Jam</label>
                <div class="col-md-2">
                  <input name="jam_mulai" placeholder="" class="form-control" type="text">
                  <span class="help-block"></span>
                </div>
                <label class="control-label col-md-3">s/d</label>
                <div class="col-md-2">
                  <input name="jam_akhir" placeholder="" class="form-control" type="text">
                  <span class="help-block"></span>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">Vendor</label>
                <div class="col-md-9">
                  <?php 
                    $js = 'class="select2" style="width:50%"';
                    echo form_dropdown('vendor_id', $options_vendor,'',$js); 
                  ?>
                  <span class="help-block"></span>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">Tipe training</label>
                <div class="col-md-9">
                  <?php 
                    $js = 'id="training_type_id" class="select2" style="width:50%"';
                    echo form_dropdown('training_type_id', $options_training_type,'',$js); 
                  ?>
                  <span class="help-block"></span>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">Penyelenggara</label>
                <div class="col-md-9">
                  <?php 
                    $js = 'id="penyelenggara_id" class="select2" style="width:50%"';
                    echo form_dropdown('penyelenggara_id', $options_penyelenggara,'',$js); 
                  ?>
                  <span class="help-block"></span>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">Pembiayaan</label>
                <div class="col-md-9">
                  <?php 
                    $js = 'id="pembiayaan_id" class="select2" style="width:50%"';
                    echo form_dropdown('pembiayaan_id', $options_pembiayaan,'',$js); 
                  ?>
                  <span class="help-block"></span>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">ikatan dinas</label>
                <div class="col-md-9">
                  <select name="ikatan_dinas_id" class="select2" id="ikatan_dinas_id" style="width:50%" >
                  <option value="0">Pilih Tipe Ikatan Dinas</option>
                  <?php if(!empty($ikatan)){
                    for($i=0;$i<sizeof($ikatan);$i++):
                    //$selected = ($user->ikatan == $ikatan[$i]['DESCRIPTION']) ? 'selected = selected' : '';
                    echo '<option value="'.$ikatan[$i]['DESCRIPTION'].'" >'.$ikatan[$i]['DESCRIPTION'].'</option>';
                    endfor;}
                  ?>
              </select>
              <span class="help-block"></span>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">Periode</label>
                <div class="col-md-9">
                  <?php 
                    $js = 'id="waktu_id" class="select2" style="width:50%"';
                    echo form_dropdown('waktu_id', $options_training_waktu,'',$js); 
                  ?>
                  <span class="help-block"></span>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">Besar biaya</label>
                <div class="col-md-9">
                  <input id="besar_biaya" name="besar_biaya" placeholder="" class="form-control" type="text">
                  <span class="help-block"></span>
                </div>
              </div>

              <div class="row form-row">
                <label class="control-label col-md-3">Tempat pelaksanaan</label>
                <div class="col-md-9">
                  <input name="tempat" placeholder="" class="form-control" type="text">
                  <span class="help-block"></span>
                </div>
              </div>

              

              <div class="row form-row">
                <label class="control-label col-md-3">Narasumber</label>
                <div class="col-md-9">
                  <input name="narasumber" placeholder="" class="form-control" type="text">
                  <span class="help-block"></span>
                </div>
              </div>

          </div>
          <div class="modal-footer">
            <input type="hidden" value="" name="id" class="form-control"> 
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Bootstrap modal -->




