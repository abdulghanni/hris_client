<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Form Penilaian</title>
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
  <p align="left"><img src="./assets/img/erlangga.jpg"/></p>
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
                                  <label class="form-label text-right"><b>Periode</b> : <?=get_year_session($form->comp_session_id)?></label>
                              </div>
                          </div>
                        <div class="row form-row">
                          <div >
                                  <label class="form-label text-right"><b>Karyawan Yang Dinilai</b> : <?=get_name($form->nik)?></label>
                              </div>
                          </div>
                        <div class="row form-row">
                              <div>
                                <label class="form-label text-right"><b><?php echo lang('start_working') ?></b> </label>
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
                <br>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th width="5%" rowspan="2" valign="center">
                          <!-- <div class="checkbox check-default">
                                      <input id="checkbox" type="checkbox" value="0"> 
                                      <label for="checkbox"></label>
                                    </div> -->
                                    No.
                        </th>
                        <th width="25%">Kompetensi</th>
                        <th width="25%" class="text-center">Kemampuan</th>
                        <th width="25%" class="text-center">Kemauan</th>
                      </tr>
                      <!-- <tr>
                        <th class="text-center">Kurang</th>
                        <th class="text-center">Mampu</th>
                        <th class="text-center">Kurang</th>
                        <th class="text-center">Mampu</th>
                      </tr> -->
                    </thead>
                    <tbody>
                      <?php $i = 1;foreach ($detail->result() as $r) { ?>
                        <tr>
                          <td><?=$i++?></td>
                          <td>
                            <?=getValue('title', 'competency_def', array('id'=>'where/'.$r->competency_penilaian_id))?>
                            <input type="hidden" name="competency_penilaian_id[<?=$r->id?>]" value="<?=$r->id?>">
                          </td>
                          <td class="text-center">
                            <?=($r->kemampuan == 1) ? "Mampu" : "Kurang";?>
                          </td>
                          
                          <td class="text-center">
                            <?=($r->kemauan == 1) ? "Mau" : "Kurang";?>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>

                <div class="col-md-12">
                  <h5>Kuadran :</h5>
                    <div class="radio radio-success">
                      <?php $qkuadran = getAll('competency_kuadran',array('id'=>'where/'.$form->kuadran_id));?>
                      <?php if($qkuadran->num_rows() > 0) { $val = $qkuadran->row_array() ?>
                                  <input id="kuad" name="kuadran_id" value="" type="radio" checked="checked">
                                  <label for="kuad"> <?=$val['id'].'. '.$val['title']?></label>
                                  <?php } else {}?>
                              </div>
                </div>

                <div class="col-md-12">
                  <h5>Rekomendasi :</h5>
                    <div class="radio radio-success"> 
                      <?php $qrekomendasi = getAll('competency_rekomendasi',array('id'=>'where/'.$form->rekomendasi_id));?>
                      <?php if($qrekomendasi->num_rows() > 0) { $val = $qrekomendasi->row_array(); ?>
                      <?php if($val['id'] == 1) { 
                    $label_rek = 'A';
                  }elseif($val['id'] == 2) {
                    $label_rek = 'B';
                  }elseif($val['id'] == 3) {
                    $label_rek = 'C';
                  }else{
                    $label_rek = 'D';
                  } ?>
                                  <input id="rek" name="rekomendasi_id" value="" type="radio" checked="checked">
                                  <label for="rek"> <?=$val['id'].'. '.$val['title']?></label>
                                  <?php } else {}?>
                                  <!-- <input id="rek" name="rekomendasi_id" value="" type="radio" checked="checked">
                                  <label for="rek"><?=getValue('title', 'competency_rekomendasi', array('id'=>'where/'.$form->rekomendasi_id))?></label> -->
                              </div>
                </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <br><br><br>
           <div class="form-actions">
          <div class="col-md-12 text-center" style="width: 100%">
            <div class="row">
              <div class="col-md-3 text-center"><span class="semi-bold">Dibuat Oleh,</span><br/><br/><br/></div>
              <div class=" text-center" style="width: 60%; float: left;"></div>
              <div class="col-md-3 text-center"><span class="semi-bold">Mengetahui,</span><br/><br/><br/><br/></div>
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
 
</body>
</html>
