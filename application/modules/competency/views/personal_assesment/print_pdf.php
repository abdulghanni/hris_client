<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Personal Competency Assesment</title>
<style type="text/css">
body{
  font-size: 12px!Improvement;
}
.row{
  clear: both;
}
.col-md-3{
  float: left;
  width: 30%;
}
.col-md-9{
    float: left;
    width: 70%;
}
.text-center{
  text-align:center;
}
</style>
<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet"  media="print" >
</head>

<body>
<div align="center">
  <img src="./assets/img/erlangga.jpg"/>
</div>

<div class="row">
        <div class="col-md-12">
            <div class="grid simple">
                <div class="grid-body no-border">
                <br/>
                  <div class="row-fluid">
               
                    <div class="row">
                      <div class="col-md-8">
                      <div class="row form-row">
                          <div >
                                  <label class="form-label text-right"><b>Kode Surat</b> : <?php echo $kode_surat ?></label>
                              </div>
                          </div>
                        <div class="row form-row">
                          <div>
                                  <label class="form-label text-right"><b>Periode</b> : <?=get_year_session($form->comp_session_id)?> </label>
                              </div>
                          </div>
                          
                        <div class="row form-row">
                          <div>
                                  <label class="form-label text-right"><b>Nama</b> : <?=get_name($form->nik)?></label>
                              </div>
                          </div>
                            <div class="row form-row">
                              <div >
                                <label class="form-label text-right"><b><?php echo lang('dept_div') ?></b> : <?php echo get_user_organization($form->nik) ?></label>
                              </div>
                            </div>
                            <div class="row form-row">
                              <div>
                                <label class="form-label text-right"><b>Position Group</b> : <?php echo get_pos_group($form->nik) ?></label>
                              </div>
                            </div>
                            <div class="row form-row">
                              <div >
                                <label class="form-label text-right"><b><?php echo lang('position') ?></b> : <?php echo get_user_position($form->nik) ?></label>
                              </div>
                            </div>
                      </div>
                  </div>
                    <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                  <br>
                    <table class="table table-bordered" width="100%">
                      <thead>
                        <tr>
                          <td width="5%" rowspan="2">
                           No
                            </td>
                          <td width="20%" rowspan="2">Kompetensi</td>
                          <td width="5%" rowspan="2" class="text-center">Standar Komp. (SK)</td>
                          <td width="5%" rowspan="2" class="text-center">Aktual Komp. (AK)</td>
                          <td width="5%" rowspan="2" class="text-center">Score GAP (AK-SK)</td>
                          <td width="60%" colspan="2" class="text-center">Program Improvement</td>
                        </tr>
                        <tr>
                          <td width="30%" class="text-center">Tindakan</td>
                          <!-- <td width="15%" class="text-center">Tanggal Pelaksanaan</td> -->
                          <td width="30%" class="text-center">PIC</td>
                          <!-- <td width="15%" class="text-center">Hasil</td> -->
                        </tr>
                      </thead>
                      <tbody>
                          <?php $j = 1;foreach($detail as $d){?>
                          <tr>
                            <td width="5%" class="text-center">
                              <?=$j++?>
                            </td>
                            <td class="text-left" width="25%">
                              <?=getValue('title', 'competency_def', array('id'=>'where/'.$d->competency_def_id))?>   
                            </td>
                            <td class="text-center">
                              <?=$d->sk?> 
                            </td>
                            <td class="text-center">
                              <?=$d->ak?> 
                            </td>
                            <td class="text-center">
                              <?=$d->gap?>  
                            </td>
                            <td>
                              <?=($d->competency_tindakan_id == 0) ? '-' : getValue('title', 'competency_tindakan', array('id'=>'where/'.$d->competency_tindakan_id,'is_deleted'=>'where/0'))?> 
                            </td>
                            <!-- <td><?=($d->tgl == '1970-01-01') ? '-' : dateIndo($d->tgl)?></td> -->
                            <td><?=(strlen($d->pic) > 0) ? $d->pic : '-' ?> </td>
                            <!-- <td><?=($d->hasil != '0') ? $d->hasil : '-'?>  </td> -->
                          </tr>
                          <?php } ?>
                          <tr>
                            <td width="5%" class="text-center">
                              
                            </td>
                            <td class="text-left" width="25%">
                              TOTAL 
                            </td>
                            <td class="text-center">
                              <?php echo $total_sk?>
                            </td>
                            <td class="text-center">
                              <?php echo $total_ak?>
                            </td>
                            <td class="text-center">
                              <?php echo $total_gap?>
                            </td>
                            <td colspan="4"></td>
                          </tr>
                      </tbody>
                    </table>
                  <div>
                </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
      </div><br><br><br>

      <div class="form-actions">
          <div class="col-md-12 text-center" style="width: 100%">
            <div class="row">
              <div class="col-md-3 text-center"><span class="semi-bold">Dibuat Oleh,</span><br/><br/><br/></div>
              <div class=" text-center" style="width: 60%; float: left;"></div>
              <div class="col-md-3 text-center"><span class="semi-bold">Mengetahui,</span><br/><br/><br/></div>
            </div>
                <div class="row wf-cuti">
                  <div class="col-md-3" id="lv1">
                      <p class="wf-approve-sp">
                        <span class="small"></span><br/>
                          <span class="semi-bold"><?php echo get_name($form->created_by)?></span><br/>
                          <span class="small"><?php echo dateIndo($form->created_on)?></span><br/>
                          <span class="semi-bold"><?=get_user_position($form->created_by)?></span>
                      </p>
                  </div>
                  <?php 
                    if($approver->num_rows()>0){
                      foreach($approver->result() as $a):
                  ?>
                  <div class="col-md-3" id="<?=$a->user_id?>">
                      <p class="wf-approve-sp">
                      <?php 
                        if($a->user_id == sessId() && $a->is_app == 0){ ?>
                          <div class="btn btn-success btn-cons" id="" type="button" data-toggle="modal" data-target="#submitModal<?=sessId()?>" style="margin-top: -15px;"><i class="icon-ok"></i>Submit</div><br/>
                          <span class="semi-bold"><?php echo get_name($a->user_id)?></span><br/>
                              <span class="small"><?php echo dateIndo($a->date_app)?></span><br/>
                              <span class="semi-bold"><?=get_user_position(get_nik($a->user_id))?></span>
                        <?php }else{ 
                          echo ($a->app_status_id == 1)?"<img class=approval-img src=$approved>": (($a->app_status_id == 2) ? "<img class=approval-img src=$rejected>"  : (($a->app_status_id == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));
                        ?>
                          <span class="small"></span><br/>
                          <span class="semi-bold"><?php echo get_name($a->user_id)?></span><br/>
                          <span class="small"><?php echo dateIndo($a->date_app)?></span><br/>
                          <span class="semi-bold"><?=get_user_position(get_nik($a->user_id))?></span>
                          <?php } ?>
                      </p>
                  </div>
                  <?php endforeach;}?>
                </div>
            </div> 
        </div>
    </div>
</div>
 
</body>
</html>
