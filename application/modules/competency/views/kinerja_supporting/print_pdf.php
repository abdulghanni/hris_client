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
                <div class="row">
                      <div class="col-md-12" style="width:100%">
                      <div class="row form-row">
                          <div >
                                  <label class="form-label text-right"><b>Kode Surat</b> : <?php echo $kode_surat ?></label>
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
                            </div>Aspek Penilaian
                      <div class="row form-row">
                          <div>
                                  <label class="form-label text-right"><b>Tanggal Mulai Bekerja</b> : <?=dateIndo(get_user_sen_date($form->nik))?> </label>
                              </div>
                          </div>
                            <div class="row form-row">
                          <div>
                                  <label class="form-label text-right"><b>Periode</b> : <?=get_year_session($form->comp_session_id)?> </label>
                              </div>
                          </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                            <table class="table table-bordered" width="100%" style="font-size:13px;" heigh="200px;">
                    <thead>
                      <tr>
                        <td width="5%" rowspan="2" valign="center">
                                    No.
                        </td>
                        <td width="65%" rowspan="2" class="text-center">Aspek Penilaian<br/> Performance(60%)</td>
                        <td widtd="30%" colspan="3" class="text-center">Penilaian</td>
                      </tr>
                      <tr>
                        <td class="text-center">Bobot</td>
                        <td class="text-center">Nilai</td>
                        <td class="text-center">(B/100) x N</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; foreach($performance as $p){?>
                      <tr>
                        <td><?=$i++?></td>
                        <td><?=$p->aspek?></td>
                        <td><?=$p->bobot?></td>
                        <td><?=$p->nilai?></td>
                        <td><?=$p->persentase?></td>
                      </tr>
                      <?php } ?>
                    </tbody>

                    <tfoot id="tbl_performance_footer">
                      <tr>
                        <td></td>
                        <td>Subtotal Nilai Performance</td>
                        <td><input class="form-control text-right" type="text" id="sub_total_bobot_performance" name="sub_total_bobot_performance" value="<?=$form->sub_total_bobot_performance?>" readonly="readonly"></td>
                        <td><input class="form-control text-right" id="sub_total_nilai_performance" type="text" name="sub_total_nilai_performance" value="<?=$form->sub_total_nilai_performance?>" readonly="readonly"></td>
                        <td><input class="form-control text-right" id="sub_total_persentase_performance" type="text" name="sub_total_persentase_performance" value="<?=$form->sub_total_persentase_performance?>" readonly="readonly"></td>
                      </tr>
                    </tfoot>
                  </table>
                    </div>
                  </div>
                  <br/>
                  <div class="row">
                    <div class="col-md-12">
                            <table class="table table-bordered" width="100%" style="font-size:13px;" heigh="200px;">
                    <thead>
                      <tr>
                        <td width="5%" rowspan="2" valign="center">
                                    No.
                        </td>
                        <td width="65%" rowspan="2" class="text-center">Aspek Penilaian<br/> Kompetensi(40%)</td>
                        <td widtd="30%" colspan="3" class="text-center">Penilaian</td>
                      </tr>
                      <tr>
                        <td class="text-center">Bobot</td>
                        <td class="text-center">Nilai</td>
                        <td class="text-center">(B/100) x N</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; foreach($kompetensi as $p){?>
                      <tr>
                        <td><?=$i++?></td>
                        <td><?=$p->aspek?></td>
                        <td><?=$p->bobot?></td>
                        <td><?=$p->nilai?></td>
                        <td><?=$p->persentase?></td>
                      </tr>
                      <?php } ?>
                    </tbody>

                    <tfoot id="tbl_kompetensi_footer">
                      <tr>
                        <td></td>
                        <td>Subtotal Nilai Kompetensi</td>
                        <td><input class="form-control text-right" type="text" id="sub_total_bobot_kompetensi" name="sub_total_bobot_kompetensi" value="<?=$form->sub_total_bobot_kompetensi?>" readonly="readonly"></td>
                        <td><input class="form-control text-right" id="sub_total_nilai_kompetensi" type="text" name="sub_total_nilai_kompetensi" value="<?=$form->sub_total_nilai_kompetensi?>" readonly="readonly"></td>
                        <td><input class="form-control text-right" id="sub_total_persentase_kompetensi" type="text" name="sub_total_persentase_kompetensi" value="<?=$form->sub_total_persentase_kompetensi?>" readonly="readonly"></td>
                      </tr>
                    </tfoot>
                  </table>
                    </div>
                  </div>
                  <hr/>
                    <div class="row">
                    <div class="col-md-12">
                            <table class="table table-bordered" width="100%" style="font-size:13px;" heigh="200px;">
                    <thead>
                      <tr>
                        <td width="5%" rowspan="2" valign="center">
                                    No.
                        </td>
                        <td width="65%" rowspan="2" class="text-center">Aspek Penilaian<br/> Kedisiplinan(10%)</td>
                        <td widtd="30%" colspan="3" class="text-center">Penilaian</td>
                      </tr>
                      <tr>
                        <td width="5%" class="text-center">Bobot</td>
                        <td width="5%" class="text-center">Target</td>
                        <td width="5%" class="text-center">Menit keterlambatan</td>
                        <td width="5%" class="text-center">Nilai</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; foreach($kedisiplinan as $p){?>
                      <tr>
                        <td><?=$i++?></td>
                        <td><?=$p->aspek?></td>
                        <td><?=$p->bobot?></td>
                        <td><?=$p->target?></td>
                        <td><?=$p->nilai?></td>
                        <td><?=$p->persentase?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                    </div>
                    <!-- <div class="col-md-12">
                      <button type="button" class="btn btn-small" id="btnAddPerformance" title="Klik disini untuk membuat pengajuan baru" onclick="addPerformance('tbl_performance')"><i class="icon-plus"></i> Tambah Aspek Penilaian Performance</button>
                    </div> -->
                  </div>
                  <hr/>
                    <div class="row">
                    <div class="col-md-12">
                      <table id="" class="table-bordered">
                    <tr>
                      <td width="85%" class="">&nbsp;&nbsp; <h5>Total Nilai Kinerja = (Performance x 60%) + (Kompetensi x 30%) + (Kedisiplinan x 10%)</h5></td>
                      <td class="text-right"><input class="form-control text-right" id="total_nilai" type="text" name="total_nilai" readonly="readonly" value="<?=$form->total?>"></td>
                    </tr>

                    <tr>
                      <td width="85%" class="">&nbsp;&nbsp; <h5>Konversi Nilai</h5></td>
                      <td class="text-right"><input class="form-control text-right" id="konversi_nilai" type="text" name="konversi_nilai" readonly="readonly" value="<?=$form->konversi?>"></td>
                    </tr>
                  </table>
                    </div>
                  </div>

                  <hr/>
                  <div class="row">
                    <div class="row form-row">
                        <div class="col-md-12">
                                <label class="form-label">1. Potensi Promosi</label>
                            </div>
                            <div class="col-md-12">
                          <textarea width="100%" name="potensi_promosi" class="form-control" placeholder="Isi disini...." readonly="readonly"><?=$form->potensi_promosi?></textarea>
                            </div>
                        </div>

                        <div class="row form-row">
                        <div class="col-md-12">
                                <label class="form-label">2. Catatan Pada Aspek Perilaku</label>
                            </div>
                            <div class="col-md-12">
                          <textarea width="100%" name="catatan_perilaku" class="form-control" placeholder="Isi disini...." readonly="readonly"><?=$form->catatan_perilaku?></textarea>
                            </div>
                        </div>

                        <div class="row form-row">
                        <div class="col-md-12">
                                <label class="form-label">3. Kebutuhan Training</label>
                            </div>
                            <div class="col-md-12">
                          <textarea width="100%" name="kebutuhan_training" class="form-control" placeholder="Isi disini...." readonly="readonly"><?=$form->kebutuhan_training?></textarea>
                            </div>
                        </div>

                        <div class="row form-row">
                        <div class="col-md-12">
                                <label class="form-label">4. Target Ke depan</label>
                            </div>
                            <div class="col-md-12">
                          <textarea width="100%" name="target_kedepan" class="form-control" placeholder="Isi disini...." readonly="readonly"><?=$form->target_kedepan?></textarea>
                            </div>
                        </div>
                  </div>

                  <br><br>
                      <div class="form-actions">
                    <div class="col-md-12 text-center">
                      <div class="row">
                        <div style="float: left; width: 30%" class="col-md-3 text-center"><span class="semi-bold">Dibuat Oleh,</span><br/><br/><br/></div>
                        <div style="float: left; width: 70%; text-align: center" class="col-md-9 text-center"><span class="semi-bold">Mengetahui,</span><br/><br/><br/></div>
                        <div style="clear:both;"></div>
                      </div>
                          <div class="row wf-cuti">
                            <div class="col-md-3" id="lv1" style="float: left; width: 30%">
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
                            <div class="col-md-3" id="<?=$a->user_id?>" style="float: left; width: 35%; ">
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
                          <div style="clear:both;"></div>
                      </div> 
                  </div>
                      <?php echo form_close(); ?>
                  </div>
                </div>
            </div>
          </div>
      </div>
</body>
</html>
