<input type="hidden" id="form_name" value="<?=$form_name?>">
<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
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
            <h3>Daftar Aktifasi user WebHRIS</span></h3> 
            <input type="hidden" name="is_admin" id="is_admin" class="form-control" value="<?php echo $is_admin; ?>">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">                            
                    <div class="grid-body no-border">
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-full-width " id="table_inv" style="width: 100%;">
                                <thead>
                                     <tr>
                                      <th width="5%">NIK</th>
                                      <th width="15%">Nama</th>
                                      <th width="10%">Aktif/tidak aktif</th>
                                      <!-- <th width="10%">Inventaris</th>
                                      <th width="5%">Submit</th> -->
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
    <!-- END PAGE -->
</div>