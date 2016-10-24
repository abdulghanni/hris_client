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
        <h3>Kompetensi - Mapping Standar</h3> 
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
          <div class="grid-body no-border email-body">
            <br/>
            <div class="row-fluid">
              <div class="row-fluid dataTables_wrapper">
                <div class="row form-row">
                  <label class="control-label col-md-3">Departement / Bagian</label>
                  <div class="col-md-9">
                    <select id="org" class="select2" style="width:100%">
                      <option value="0">-- Pilih  Departement/Bagian --</option>
                      <?php foreach($org as $r){?>
                      <option value="<?=$r['ID']?>"><?php echo $r['DESCRIPTION']?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div id="mapping-standar">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
