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
            <h3>Kompetensi Tipe</h3> 
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
        <form action="#" id="form" class="form">
          <div class="modal-body">
              <div class="row form-row">
                <label class="control-label col-md-3">Title</label>
                <div class="col-md-9">
                  <input name="title" placeholder="Title" class="form-control" type="text">
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="row form-row">
                <label class="control-label col-md-3">Position Group</label>
                <div class="col-md-9">
                  <select class="select2">
                    <option>-- Pilih  Position Group --</option>
                    <?php foreach($position_group as $ps){?>
                    <option><?php echo $ps['DESCRIPTION']?></option>
                    <?php } ?>
                  </select>
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




