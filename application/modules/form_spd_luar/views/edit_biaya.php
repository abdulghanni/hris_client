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
                <h4>Ubah Data <span class="semi-bold"><a href="<?php echo site_url('form_spd_luar_kota_group')?>">Perjalanan Dinas Luar Kota (Group)</a></span></h4>
              </div>
              <div class="grid-body no-border">
                <?php echo form_open(site_url('form_spd_luar/edit/'.$id)) ?>
            <div class="row">
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-right">Tgl. Berangkat</label>
                          </div>
                          <div class="col-md-8">
                            <div class="input-append date success no-padding">
                              <input type="text" id="from_date" class="form-control from_date" name="date_spd_start" value="<?php echo $spd_start ?>" required>
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
                              <input type="text" id="to_date" class="form-control to_date" name="date_spd_end" value="<?php echo $spd_start ?>" required>
                              <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                            </div>
                          </div>
                        </div>
                    <div class="col-md-7 col-md-offset-2">

                      <h5 class="text-center"><span class="semi-bold">Ketentuan Biaya Perjalanan Dinas</span></h5>
                      <div class="col-md-6 text-left">
                        <button type="button" id="btnAddBiaya" class="btn btn-primary btn-xs" onclick="addRow('dataTable')"><i class="icon-plus"></i>&nbsp;<?php echo 'Tambah Biaya';?></button>
                        <button type="button" id="btnRemove" class="btn btn-danger btn-xs" onclick="deleteRow('dataTable')" style="display: none;"><i class="icon-remove"></i>&nbsp;<?php echo 'Remove'?></button>
                      </div> 
                      <p>&nbsp;</p>
                          <p class="bold">Grade Penerima Tugas : <span id="grade" class="semi-bold"><?php echo get_grade($tc_id)?></span></p>
                            <div class="row form-row">
                              <div class="col-md-12">
                              <table id="dataTable" class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th width="2%"></th>
                                    <th width="2%">No</th>
                                    <th width="40%">Jenis Biaya</th>
                                    <th width="40%">Jumlah Biaya(Rp)</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php $total = 0;
                                  $i=1;foreach($biaya_pjd->result() as $row):
                                  //$jumlah_biaya = (!empty($row->type)) ? $row->jumlah_biaya*$jml_pjd : $row->jumlah_biaya;
                                  $jumlah_biaya = $row->jumlah_biaya;
                                  //$jumlah_hari = (!empty($row->type)) ? '/'.$jml_pjd.' hari' : '';
                                  $jumlah_hari = (!empty($row->type)) ? '/'.' hari' : '';
                                  $total += $jumlah_biaya;
                                ?>
                                  <tr>
                                    <td></td>
                                    <td><?php echo $i++?></td>
                                    <input type="hidden" name="biaya_id[]" value="<?php echo $row->id?>">
                                    <input type="hidden" name="biaya_tambahan_id[]" value="">
                                    <td><?php echo $row->jenis_biaya.$jumlah_hari?></td>
                                    <td align="right"><input type="text" name="jumlah_biaya[]" class="form-control" value="<?php echo number_format($jumlah_biaya, 0)?>"></td>
                                  </tr>
                                <?php endforeach; ?>
                                  <!--<tr>
                                    <td>&nbsp;</td>
                                    <td align="right">Total :</td>
                                    <td align="right"><?php echo number_format($total, 0) ?></td>
                                  </tr>-->
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
        <div class="form-actions">
                      <div class="pull-right">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="" type="submit"  class="btn btn-success btn-cons"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
        </div></div>
        <?php echo form_close()?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>