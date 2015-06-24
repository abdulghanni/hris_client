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
                <h4>Daftar Perjalanan Dinas <span class="semi-bold">Luar Kota</span></h4>
                <div class="tools"> 
                  <a href="<?php echo site_url() ?>form_spd_luar/input" class="config"></a>
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
                              <?php foreach ($form_spd_luar as $spd) : ?>
                              <?php 
                                $report_num = getAll('users_spd_luar_report', array('user_spd_luar_id'=>'where/'.$spd->id))->num_rows();
                                if ($spd->is_submit == 1 && $report_num == 1) {
                                  $btn_dis = "disabled=\"disabled\"";
                                  $btn_sub = "Submitted";
                                  $report_disable = (get_nik($sess_id) == $spd->task_receiver)?'':'';
                                }elseif($spd->is_submit == 1 && $report_num == 0){
                                  $btn_dis = "disabled=\"disabled\"";
                                  $btn_sub = "Submitted";
                                  $report_disable = (get_nik($sess_id) == $spd->task_receiver)?'':'disabled';
                                }else{
                                  $btn_dis = '';
                                  $report_disable = 'disabled';
                                  $btn_sub = "Submit";
                                }
                                $btn_rep = ($report_num>0)?'View Report':(($report_num < 1 && get_nik($sess_id) == $spd->task_receiver)?'Create Report':'Report');
                               ?>
                                <tr>
                                  <td>
                                    <a href="<?php echo base_url() ?>form_spd_luar/submit/<?php echo $spd->id ?>"><h4><?php echo $spd->title ?></h4>
                                      <div class="small-text-custom">
                                        <span>Pemberi tugas : </span><?php echo $spd->creator ?><br/>
                                        <span>Penerima tugas : </span><?php echo get_name($spd->task_receiver) ?><br/>
                                        <span>Tanggal : </span><?php echo dateIndo($spd->date_spd_start) ?><br/>
                                        <span>Tempat : </span><?php echo $spd->destination ?><br />
                                        <span>Kota Tujuan : </span><?php echo $spd->city_to ?>
                                      </div>
                                    </a>
                                  </td>
                                  <td>
                                    <div class="list-actions">
                                      <a href="<?php echo site_url('form_spd_luar/submit/'.$spd->id)?>">
                                        <button <?php echo $btn_dis; ?> class="btn btn-primary btn-cons" type="button">
                                          <i class="icon-ok"></i>
                                           <?php echo $btn_sub; ?>
                                        </button>
                                      </a>
                                      <button class="btn btn-info btn-cons" type="button" onclick='window.location.href="<?php echo base_url()?>form_spd_luar/report/<?php echo $spd->id ?>"' <?php echo $report_disable?>>
                                          <i class="icon-paste"></i>
                                          <?php echo $btn_rep; ?>
                                        </button>
                                      </a>
                                      <a href="<?php echo base_url() ?>form_spd_luar/pdf/<?php echo $spd->id ?>">
                                        <button class="btn btn-info btn-cons" type="button">
                                          <i class="icon-print"></i>
                                          Print
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