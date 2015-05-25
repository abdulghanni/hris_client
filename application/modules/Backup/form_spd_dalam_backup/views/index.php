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
            <div class="grid simple ">
              <div class="grid-title no-border">
                <h4>Daftar Perjalanan Dinas <span class="semi-bold">Dalam Kota</span></h4>
                <div class="tools"> 
                  <a href="<?php echo site_url() ?>form_spd_dalam/input" class="config"></a>
                </div>
              </div>
                <div class="grid-body no-border"> 
                        <table class="table table-striped table-flip-scroll cf">
                            <thead>
                              <tr>
                                <th width="90%">Kegiatan</th>
                                <!-- <th width="9%">Pemberi tugas</th>
                                <th width="10%">Waktu</th>
                                <th width="10%">Keterangan</th> -->
                                <th width="10%" colspan="2" class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if ($_num_rows > 0) { ?>
                              <?php foreach ($form_spd_dalam as $spd) : ?>
                              <?php 
                                if ($spd->is_submit == 1) {
                                  $btn_dis = "disabled=\"disabled\"";
                                  $btn_sub = "Submitted";
                                  $btn_rep = "View Report";
                                }else{
                                  $btn_dis = "";
                                  $btn_sub = "Submit";
                                  $btn_rep = "Report";
                                }
                                
                               ?>
                                <tr>
                                  <td>
                                    <a href="<?php echo base_url() ?>form_spd_dalam/submit/<?php echo $spd->id ?>"><h4><?php echo $spd->title ?></h4>
                                      <div class="small-text-custom">
                                        <span>Pemberi tugas : </span><?php echo $spd->creator ?><br/>
                                        <span>Tanggal : </span><?php echo date('d F Y',strtotime($spd->date_spd)) .', '. date('H:i',strtotime($spd->start_time)) .' - '. date('H:i',strtotime($spd->end_time)) ?> WIB<br/>
                                        <span>Tempat : </span><?php echo $spd->destination ?>
                                      </div>
                                    </a>
                                  </td>
                                  <td>
                                    <div class="list-actions">
                                      <a href="<?php echo base_url() ?>form_spd_dalam/submit/<?php echo $spd->id ?>">
                                        <button <?php echo $btn_dis; ?> class="btn btn-primary btn-cons" type="button">
                                          <i class="icon-ok"></i>
                                           <?php echo $btn_sub; ?>
                                        </button>
                                      </a>
                                      <a href="<?php echo base_url() ?>form_spd_dalam/report/<?php echo $spd->id ?>">
                                        <button <?php echo $btn_dis; ?> class="btn btn-info btn-cons" type="button">
                                          <i class="icon-paste"></i>
                                          <?php echo $btn_rep; ?>
                                        </button>
                                      </a>
                                    </div>
                                  </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
      </div>
    </div>
            
  
    </div>
  
</div>  
<!-- END PAGE -->