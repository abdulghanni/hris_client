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
      <div class="row-fluid">
        <div class="span12">
          <div class="grid simple ">
            <div class="grid-title">
              <h4>List Pengajuan <span class="semi-bold"><?php echo $title ?></span></h4>
            </div>

            <div class="grid-body ">
            <a href="<?=base_url('form_'.$form_name.'/input')?>"><button type="button" class="btn btn-primary" title="Klik disini untuk membuat pengajuan baru"><i class="icon-plus"></i> Buat Pengajuan Baru</button><br/><br/></a>
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-full-width " id="table" style="width: 100%;">
                    <thead>
                         <tr>
                          <th rowspan="2" scope="col" width="5%" class="text-center">No</th>
                          <th rowspan="2" scope="col" width="5%">NIK</th>
                          <th rowspan="2" scope="col" width="15%">Nama</th>
                          <th rowspan="2" scope="col" width="10%">Tanggal Cuti</th>
                          <th rowspan="2" scope="col" width="10%">Alasan Cuti</th>
                          <th rowspan="2" scope="col" width="5%">Jml Hari</th>
                          <th colspan="4" scope="col" width="16%" class="text-center">Approval Atasan</th>
                          <th rowspan="2" scope="col" width="12%">Aksi</th>
                        </tr>
                        <tr>
                          <th scope="col" class="text-center" width="4%">Langsung</th>
                          <th scope="col" class="text-center" width="4%">Tidak Langsung</th>
                          <th scope="col" class="text-center" width="4%">Lainnya</th>
                          <th scope="col" class="text-center" width="4%">HRD</th>
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
<!-- END CONTAINER -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input id="group_id" type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-4">Name</label>
                            <div class="col-md-8">
                                <input name="title" placeholder="Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Value</label>
                            <div class="col-md-8">
                                <input name="value" placeholder="Code" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->