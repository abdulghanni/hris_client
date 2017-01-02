<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title?></title>
<style type="text/css">
html{
  font-size: 100%;
  height:100%;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif; 
  font-size: 10px;
}

.tg  {}
.tg td{ height:14px;font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;font-size:14px;padding-left:20px;border-style:solid;border-width:0px;overflow:hidden;}

.nama{
  font-size: 10px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}

.position{
  font-size: 9px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}

.tanggal{
  font-size: 8px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}
.style3 {
  font-size: 16px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}
.style4 {
  font-size: 12px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}
.style6 {
  color: #000000;
  font-weight: bold;
  font-size: 20px;
}
.style7 {
  padding-left: 20px;
  font-size: 12px;
  font-weight: bold;
}

.approval-img-md{
    height:40px;
    width:80px;
    margin-bottom: 8px;
    z-index:-1;
}


#container1 {
  float:left;
  width:100%;
  position:relative;
  font-size: 12px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}

#container2 {
  float:left;
  width:100%;
  position:relative;
  font-size: 12px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}
#col1 {
  float:left;
  width:24%;
  text-align: center;
  position:relative;
  margin-top: 0px;
  left:77%;
  overflow:hidden;
}
#col2 {
  float:left;
  width:24%;
  text-align: center;
  position:relative;
  left:81%;
  overflow:hidden;
}
#col3 {
  float:left;
  width:24%;
  text-align: center;
  position:relative;
  left:85%;
  overflow:hidden;
}
#col4 {
  float:left;
  width:24%;
  text-align: center;
  position:relative;
  left:89%;
  overflow:hidden;
}

#atasan3 {
  float:left;
  width:30%;
  text-align: center;
  position:relative;
  left:77%;
  overflow:hidden;
}

#hormat {
  float:left;
  width:25%;
  text-align: center;
  position:relative;
  margin-bottom: 0px;
  left:77%;
  overflow:hidden;
}
.menyetujui {
  float:left;
  width:25%;
  text-align: center;
  position:relative;
  margin-bottom: 20px;
  left:70%;
  overflow:hidden;
  margin-left: 70px;
}
.atasan3 {
  float:left;
  width:25%;
  text-align: center;
  position:relative;
  margin-bottom: 20px;
  left:50%;
  overflow:hidden;
  margin-left: 50px;
}
}
</style>
</head>

<body>
<div align="center">
  <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>"/></p>
</div>
<?php
if ($td_num_rows > 0) {
  $approved = assets_url('img/approved_stamp.png');
  $rejected = assets_url('img/rejected_stamp.png');
  $cancelled = assets_url('img/cancelled.png');
  $signed = assets_url('img/signed.png');
  foreach ($task_detail as $td) : 

    $a = strtotime($td->date_spd_end);
    $b = strtotime($td->date_spd_start);

    $j = $a - $b;
    $jml_pjd = floor($j/(60*60*24)+1);
    ?>
    <br/>
<div class="style4">
  <div style="float: left; width: 54%;">
  Nomor : <?php echo "$form_id/$bu/$m/$y/$td->id" ?>
  </div>


  <div style="float: right; width: 28%;">
  <?= $location.', '.dateIndo($td->created_on)?>
  </div>

  <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
  Perihal : Pengajuan Dana PJD Training / Meeting ke <?php $city = get_bu_name($td->to_city_id); echo ($city == "PUSAT") ? 'Jakarta' : $city;?><br/><br/>
  Kepada Yth.,<br/>
  <?= (!empty($td->diajukan_ke)) ? $td->diajukan_ke : "Departemen Keuangan";?><br/>
  <?= (!empty($td->jabatan)) ? $td->jabatan."<br/>" : "";?>
  Di Tempat<br/>

  <p>Dengan hormat,</p>
  <p>Sehubungan dengan kegiatan <?=$td->title?> di <?=get_bu_name($td->to_city_id)?>, maka kami mengajukan perjalanan dinas sebagai berikut:</p>
  <div style="padding-left:15px;">
    <p>I.  &nbsp;Cabang/Depo yang dikunjungi&emsp;: <?=get_bu_name($td->to_city_id)?></p>
    <p>II. Tanggal kunjungan&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;: <?= dateIndo($td->date_spd_start).' s/d '.dateIndo($td->date_spd_end)?> (<?=$jml_pjd?> Hari)</p>
    <p>III.Tujuan kunjungan &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;: <?=$td->title?></p>
    <p>IV.Pelaksana&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;: <?=$td->task_receiver.' - '.get_name($td->task_receiver)?></p>
    <p>V.&nbsp;Golongan&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;: <?= get_grade($td->task_receiver)?></p>
    <p>VI. Jabatan&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;: <?= get_user_position($td->task_receiver)?></p>
    <p>VII.Rincian Biaya</p>
<table width="630" class="tg">
<?php 
        $total = 0;
     $i=1;foreach($biaya_single->result() as $row):
     if($row->pjd_biaya_id%3 == 0){
     //$jumlah_biaya = (!empty($row->type)) ? $row->jumlah_biaya*($jml_pjd-1) : $row->jumlah_biaya;
     $jumlah_biaya = (!empty($row->type)) ? $row->jumlah_biaya : $row->jumlah_biaya;
      }else{
     //$jumlah_biaya = (!empty($row->type)) ? $row->jumlah_biaya*($jml_pjd) : $row->jumlah_biaya;
     $jumlah_biaya = (!empty($row->type)) ? $row->jumlah_biaya : $row->jumlah_biaya;
     }
     //$jumlah_hari = (!empty($row->type)) ? '/'.$jml_pjd.' hari' : '';
     $total += $jumlah_biaya;
    ?>
      <tr>
        <td width="200"><?php echo $i++.'. '.$row->jenis_biaya?></td>
        <td width="10">:</td>
        <td width="120" align="right"><?php echo number_format($jumlah_biaya, 0)?></td>
        <td width="300"></td>
      </tr>
    <?php endforeach ?>
     <tr>
        <td width="200"><b><?php echo '  Total Biaya'?></b></td>
        <td width="10">:</td>
        <td width="120" align="right"><b><?php echo number_format($total, 0)?></b></td>
        <td width="300"></td>
      </tr>
    </table>

    <p>VIII. Catatan</p>
    <table width="630" class="tg">
      <?php if(!empty($td->user_app_lv1) && (strlen($td->note_lv1) > 1) ) { ?>
        <tr>
          <td width="200"><?php echo get_user_position($td->user_app_lv1); ?></td>
          <td width="10">:</td>
          <td width="500"><?php echo $td->note_lv1; ?></td>
          
        </tr>
      <?php }?>
      <?php if(!empty($td->user_app_lv2) && (strlen($td->note_lv2) > 1) ) { ?>
        <tr>
          <td width="200"><?php echo get_user_position($td->user_app_lv2); ?></td>
          <td width="10">:</td>
          <td width="500"><?php echo $td->note_lv2; ?></td>
        </tr>
      <?php }?>
      <?php if(!empty($td->user_app_lv3) && (strlen($td->note_lv3) > 1) ) { ?>
        <tr>
          <td width="200"><?php echo get_user_position($td->user_app_lv3); ?></td>
          <td width="10">:</td>
          <td width="500"><?php echo $td->note_lv3; ?></td>
        </tr>
      <?php }?>
    </table>
  </div>
</div>
<div class="style4">
<p>Demikian surat pengajuan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
</div>
<br/>

<div id="container1">
  <div id="hormat">
    <!-- Column one start -->
    <span class="small">Hormat Kami,</span>
   <!-- Column one end -->
  </div>
  <div class="menyetujui">
    <!-- Column three start -->
    <span class="small">Menyetujui,</span>
  </div>
</div>

<div id="container1">
  <div id="col1" style="margin-top:-4px;">
    <!-- Column one start -->
    <?php echo ($td->is_deleted == 1)?"<img class=approval-img-md src=$cancelled>":"<img class=approval-img-md src=$signed>";?><br/>
    <span class="nama"><?php echo get_name($td->task_creator) ?></span><br/>
    <span class="tanggal"><?php echo dateIndo($td->created_on) ?></span><br/>
    <span class="position">(<?php echo get_user_position($td->task_creator) ?>)</span>
   <!-- Column one end -->
  </div>
  <div id="col2">
    <!-- Column two start -->
    <?php echo ($td->app_status_id_lv1 == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_lv1 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/><br/><br/>');?><br/>
    <span class="nama"><?php echo get_name($td->user_app_lv1) ?></span><br/>
    <span class="tanggal"><?php echo dateIndo($td->date_app_lv1) ?></span><br/>
    <span class="position">(<?php echo get_user_position($td->user_app_lv1) ?>)</span><!-- Column two end -->
  </div>
  <div id="col3">&nbsp;
  <?php if (!empty($td->user_app_lv2)) :?>
    <!-- Column three start -->
    <?php echo ($td->app_status_id_lv2 == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_lv2 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/><br/><br/>');?><br/>
    <span class="nama"><?php echo get_name($td->user_app_lv2) ?></span><br/>
    <span class="tanggal"><?php echo dateIndo($td->date_app_lv2) ?></span><br/>
    <span class="position">(<?php echo get_user_position($td->user_app_lv2) ?>)</span><!-- Column two end -->
  <?php endif; ?>
  </div>
  <div id="col4">
    <!-- Column four start -->
    <?php echo ($td->app_status_id_hrd == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_hrd == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/><br/><br/>');?><br/>
    <span class="nama"><?php echo get_name($td->user_app_hrd) ?></span><br/>
    <span class="tanggal"><?php echo dateIndo($td->date_app_hrd) ?></span><br/>
    <span class="position">(HRD)</span><!-- Column two end -->
    <!-- Column four end -->
  </div>
</div>
<br />

<?php if (!empty($td->user_app_lv3)) :?>
<div id="container2">
  <div id="atasan3">
    <span class="small">&nbsp;</span>
  </div>
  <div class="atasan3">
    <?php echo ($td->app_status_id_lv3 == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_lv3 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/><br/><br/>');?><br/>
    <span class="nama"><?php echo get_name($td->user_app_lv3) ?></span><br/>
    <span class="tanggal"><?php echo dateIndo($td->date_app_lv3) ?></span><br/>
    <span class="position">(<?php echo get_user_position($td->user_app_lv3) ?>)</span><!-- Column two end -->
  </div>
</div>
<?php endif; ?>
<?php endforeach; } ?>

</body>
</html>
