<input type="hidden" id="form_name" value="<?=$form_name?>">
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
            <div class="row">
              <div class="col-md-7">
              <a href="<?=base_url('form_'.$form_name.'/input')?>"><button type="button" class="btn btn-primary" title="Klik disini untuk membuat pengajuan baru"><i class="icon-plus"></i> Buat Pengajuan Baru</button><br/><br/></a>
              </div>
              <div class="col-md-5">
                <select class="form-control select2" id="opt">
                  <option value="1" <?=($this->session->userdata('status') == 1) ? 'selected="selected"' : ''?>>Tampilkan Pengajuan Yang Belum Selesai</option>
                  <option value="2" <?=($this->session->userdata('status') == 2) ? 'selected="selected"' : ''?>>Tampilkan Pengajuan Yang Sudah Selesai</option>
                  <option value="3" <?=($this->session->userdata('status') == 3) ? 'selected="selected"' : ''?>>Tampilkan Semua Pengajuan</option>
                </select>
              </div>
            </div>
            <br/>
            <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-full-width " id="table" style="width: 100%;">
                    <thead>
                         <tr>
                          <th rowspan="2" scope="col" width="5%" class="text-center">No</th>
                          <th rowspan="2" scope="col" width="5%">NIK</th>
                          <th rowspan="2" scope="col" width="10%">Nama</th>
                          <th rowspan="2" scope="col" width="15%">Posisi yang dibutuhkan</th>
                          <!-- <th rowspan="2" scope="col" width="10%">Job Desc</th> -->
                          <th rowspan="2" scope="col" width="10%">Tanggal Pengajuan</th>
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
      </div>
</div>
<!-- END CONTAINER -->

 <!--Delete Modal-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Apakah anda yakin ingin membatalkan pengajuan ini ?</h4>
        </div>
      <form id="form-delete">
        <input type="hidden" id="form-name" value="<?php echo $form ?>">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none"><span aria-hidden="true">&times;</span></button>
        <input type="hidden" name="id" value="">
        <input type="hidden" name="form" value="">
        <input type="hidden" name="form-no" value="">
      <div class="modal-body">
        <p>Apakah anda yakin ingin membatalkan pengajuan ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="icon-ban-circle"></i>&nbsp;<?php echo lang('cancel_button')?></button> 
       <button id="remove" type="button" class="btn btn-danger" style="margin-top: 3px;" onclick="del()"><i class="icon-warning-sign"></i>&nbsp;<?php echo lang('delete_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>