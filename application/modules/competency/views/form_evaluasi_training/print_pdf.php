<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Penilaian Kinerja Supporting</title>

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
                <?php
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
                echo form_open_multipart($controller.'/add/', $att);
                ?>
              <!-- <input type="hidden" id="form" value="form_penilaian"> -->
                <div class="row">
                      <div class="col-md-6">
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
                              <div >
                                <label class="form-label text-right"><b><?php echo lang('position') ?></b> : <?php echo get_user_position($form->nik) ?></label>
                              </div>
                              </div>
                      <div class="row form-row">
                              <div >
                                <label class="form-label text-right"><b>Nama Training</b> : <?=$form->training_title?></label>
                              </div>
                            </div>
                            <div class="row form-row">
                              <div>
                                <label class="form-label text-right"><b>Tanggal Training</b> : <?=dateIndo($form->date_start)?></label>
                              </div>
                            </div>
                            <div class="row form-row">
                              <div class="col-md-3">
                                <label class="form-label text-right"><b>Selesai Training</b> : <?=date('d M Y',strtotime($form->date_end))?></label>
                              </div>
                            </div>
                    </div>
                  </div>
                  <hr/>

                  <div class="row">
                    <div class="col-md-12">
                            <div class="row form-row">
                                <div class="col-md-12">
                                  <h4 class="">Sasaran Training :</h4>
                                </div>
                                <div class="col-md-12">
                                  <textarea style="width: 100%" name="sasaran" class="form-control" placeholder="isi sasaran training disini....." readonly="readonly"><?=$form->sasaran?></textarea>
                              </div>
                            </div>
                    </div>
                  </div>
                  <hr/>

                  <div class="row">
                    <div class="col-md-12">
                            <div class="row form-row">
                                <div class="col-md-12">
                                  <h4 class="">Evaluasi Training :</h4>
                                </div>
                            <div class="col-md-12">
                                  <input style="width: 100%" type="text" class="form-control" name="" value="<?=getValue('title', 'competency_evaluasi_training', array('id'=>'where/'.$form->competency_evaluasi_training_id))?>" readonly>
                            </div>
                            <?php if($form->competency_evaluasi_training_id == 5 && !empty($form->competency_evaluasi_training_lain)){?>
                            <div class="col-md-12">
                                <input style="width: 100%" type="text" class="form-control" id="competency_evaluasi_training_lain" name="competency_evaluasi_training_lain" placeholder="Isi Evaluasi Training Lainnya Disini ....." value="<?=$form->competency_evaluasi_training_id?>">
                              </div>
                              <?php } ?>
                            </div>
                    </div>
                  </div>
                  <hr/>

                  <div class="row">
                    <div class="col-md-12">
                            <div class="row form-row">
                              <div class="col-md-12">
                                  <h4 class="">Metode Evaluasi :</h4>
                                </div>
                                <?php foreach($competency_metode as $key=>$v){?>
                                  <div class="col-md-12">
                                  <input style="width: 100%" type="text" class="form-control" name="" value="<?=getValue('title','competency_metode_evaluasi', array('id'=>'where/'.$v));?>" readonly>
                            </div>
                            <?php } ?>
                            </div>
                    </div>
                  </div>
                  <hr/>

                  <!-- POINT EVALUASI -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row form-row">
                              <div class="col-md-12">
                                  <h4 class="">Point Evaluasi :</h4>
                                </div>
                                <div class="row col-md-12">
                                  <div class="col-md-1" style="float: left; width: 15%">
                                    Nilai:
                                  </div>
                                  <div class="col-md-2" style="float: left; width: 15%">
                                    1 = Sangat Kurang
                                  </div>
                                  <div class="col-md-2" style="float: left; width: 15%">
                                    2 = Kurang
                                  </div>
                                  <div class="col-md-2" style="float: left; width: 15%">
                                    3 = Cukup
                                  </div>
                                  <div class="col-md-2" style="float: left; width: 15%">
                                    4 = Baik
                                  </div>
                                  <div class="col-md-2" style="float: left; width: 15%">
                                    5 = Sangat Baik
                                  </div>
                                  <br><br>
                                  <div style="clear: both; margin-bottom: 15px;"></div>
                                </div>
                                <div class="row">
                          <div class="col-md-12">
                            <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th width="5%">
                                          No.
                              </th>
                              <th width="75%" align="left">Pengetahuan</th>
                              <th width="10%" class="text-center">Sebelum Training</th>
                              <th width="10%" class="text-center">Sesudah Training</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1;foreach ($competency_pengetahuan as $p) { ?>
                              <tr>
                                <td><?=$i++?></td>
                                <td>
                                  <?=getValue('title', 'competency_pengetahuan', array('id'=>'where/'.$p->competency_pengetahuan_id))?>
                                </td>
                                <td class="text-center" align="center">
                                  <?=$p->point_sebelum?>
                                </td>
                                <td class="text-center" align="center">
                                  <?=$p->point_sesudah?>
                                  
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>

                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th width="5%">
                                          No.
                              </th>
                              <th width="75%" align="left">Sikap</th>
                              <th class="text-center" width="10%">Sebelum Training</th>
                              <th class="text-center" width="10%">Sesudah Training</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1;foreach ($competency_sikap as $p) { ?>
                              <tr>
                                <td><?=$i++?></td>
                                <td>
                                  <?=getValue('title', 'competency_sikap', array('id'=>'where/'.$p->competency_sikap_id))?>
                                </td>
                                <td class="text-center" align="center">
                                  <?=$p->point_sebelum?>
                                </td>
                                <td class="text-center" align="center">
                                  <?=$p->point_sesudah?>
                                  
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>

                        <table class="table table-bordered" id="tbl_keterampilan">
                          <thead>
                            <tr>
                              <th width="5%">
                                          No.
                              </th>
                              <th width="75%" align="left">Keterampilan</th>
                              <th class="text-center" width="10%">Sebelum Training</th>
                              <th class="text-center" width="10%">Sesudah Training</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1;foreach ($competency_keterampilan as $p) { ?>
                              <tr>
                                <td><?=$i++?></td>
                                <td>
                                  <?=$p->title?>
                                </td>
                                <td class="text-center" align="center">
                                  <?=$p->point_sebelum?>
                                </td>
                                <td class="text-center" align="center">
                                  <?=$p->point_sesudah?>
                                  
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>

                            <br/>
                            <br/>

                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th width="80%" align="left">Hasil / Output Pekerjaan</th>
                              <th class="text-center" width="10%">Sebelum Training</th>
                              <th class="text-center" width="10%">Sesudah Training</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1;foreach ($competency_output as $p) { ?>
                              <tr>
                                <td>
                                  <?=$p->title?>
                                </td>
                                <td class="text-center" align="center">
                                  <?=$p->point_sebelum?>
                                </td>
                                <td class="text-center" align="center">
                                  <?=$p->point_sesudah?>
                                  
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                              </div>
                          </div>
                            </div>
                    </div>
                  </div>
                  <!-- //POINT EVALUASI -->

                  <div class="row">
                    <div class="col-md-12">
                            <div class="row form-row">
                                <div class="col-md-8">
                                  <h4 class="">Tindak Lanjut dari Evaluasi :</h4>
                                </div>

                              <div class="col-md-4">
                                  <h4 class="">Realisasi Tanggal :</h4>
                                </div>
                                <div class="col-md-8">
                                  <textarea style="width: 100%" name="tindak_lanjut" class="form-control" placeholder="isi tindak lanjut dari evaluasi disini....." readonly="readonly"><?=$form->tindak_lanjut?></textarea>
                              </div>
                                <div class="col-md-4">
                                  <div id="datepicker_start" class="input-append date success no-padding">
                                    <input style="width: 100%" type="text" class="form-control" name="realisasi_tgl" value="<?=dateIndo($form->realisasi_tgl)?>" readonly>
                                    <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                                  </div>
                              </div>
                            </div>
                    </div>
                  </div>
                  <hr/>
                      <?php echo form_close(); ?>

                      <div class="form-actions">
                    <div class="col-md-12 text-center">
                      <div class="row">
                        <div class="col-md-4 text-center" style="float: left; width: 33%; text-align: center;"><span class="semi-bold">Evaluator,</span><br/><br/><br/></div>
                        <div class="col-md-4 text-center" style="float: left; width: 33%; text-align: center;"><span class="semi-bold">HRD,</span><br/><br/><br/></div>
                        <div class="col-md-4 text-center" style="float: left; width: 33%; text-align: center;"><span class="semi-bold">HRD Lainnya,</span><br/><br/><br/></div>
                        <div style="clear: both;"></div>
                      </div>
                          <div class="row wf-cuti">
                            <div class="col-md-4" id="lv1" style="float: left; width: 33%; text-align: center;">
                                <p class="wf-approve-sp">
                                  <span class="small"></span><br/>
                                    <span class="semi-bold"><?php echo get_name($form->created_by)?></span><br/>
                                    <span class="small"><?php echo dateIndo($form->created_on)?></span><br/>
                                    <span class="semi-bold"><?=get_user_position($form->created_by)?></span>
                                </p>
                            </div>

                            <div class="col-md-4" id="<?=sessId()?>" style="float: left; width: 33%; text-align: center;">
                                <p class="wf-approve-sp">
                                  <?php 
                                  if($form->hrd == sessNik() && $form->hrd == 0){ ?>
                                    <div class="btn btn-success btn-cons" id="" type="button" data-toggle="modal" data-target="#submitModal<?=sessId()?>" style="margin-top: -15px;"><i class="icon-ok"></i>Submit</div><br/>
                                    <span class="semi-bold"><?php echo get_name($form->hrd)?></span><br/>
                                        <span class="small"><?php echo dateIndo($form->date_app)?></span><br/>
                                        <span class="semi-bold"><?=get_user_position(get_nik($form->hrd))?></span>
                                  <?php }else{ 
                                    echo ($form->app_status_id == 1)?"<img class=approval-img src=$approved>": (($form->app_status_id == 2) ? "<img class=approval-img src=$rejected>"  : (($form->app_status_id == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));
                                  ?>
                                    <span class="small"></span><br/>
                                    <span class="semi-bold"><?php echo get_name($form->hrd)?></span><br/>
                                    <span class="small"><?php echo dateIndo($form->date_app)?></span><br/>
                                    <span class="semi-bold"><?=get_user_position(get_nik($form->hrd))?></span>
                                   <?php } ?>
                                </p>
                            </div>


                            <div class="col-md-4" id="<?=sessId()?>" style="float: left; width: 33%; text-align: center;">
                                <p class="wf-approve-sp">
                                  <?php 
                                  if($form->hrd2 == sessNik() && $form->hrd2 == 0){ ?>
                                    <div class="btn btn-success btn-cons" id="" type="button" data-toggle="modal" data-target="#submitModal2<?=sessId()?>" style="margin-top: -15px;"><i class="icon-ok"></i>Submit</div><br/>
                                    <span class="semi-bold"><?php echo $form->hrd2.' - '.sessNik().' - '.get_name($form->hrd2)?></span><br/>
                                        <span class="small"><?php echo dateIndo($form->hrd2_date_app)?></span><br/>
                                        <span class="semi-bold"><?=get_user_position(get_nik($form->hrd2))?></span>
                                  <?php }else{ 
                                    echo ($form->hrd2_app_status_id == 1)?"<img class=approval-img src=$approved>": (($form->hrd2_app_status_id == 2) ? "<img class=approval-img src=$rejected>"  : (($form->hrd2_app_status_id == 3) ? "<img class=approval-img src=$pending>" : "<span class='small'></span><br/>"));
                                  ?>
                                    <span class="small"></span><br/>
                                    <span class="semi-bold"><?php echo get_name($form->hrd2)?></span><br/>
                                    <span class="small"><?php echo dateIndo($form->hrd2_date_app)?></span><br/>
                                    <span class="semi-bold"><?=get_user_position(get_nik($form->hrd2))?></span>
                                   <?php } ?>
                                </p>
                            </div>
                            <div style="clear: both;"></div>
                          </div>
                      </div> 
                  </div>

                  </div>
                </div>
            
</body>
</html>
