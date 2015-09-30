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

.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{ height:40px;font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;font-size:14px;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{height:40px; font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;font-size:14px;font-weight:normal;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}

.nama{
  font-size: 10px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}

.position{
  font-size: 8.8px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}

.tanggal{
  font-size: 8.5px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}
.style3 {
  font-size: 16px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}
.style4 {
  font-size: 11px;
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
    height:50px;
    width:90px;
    margin-bottom: 8px;
    z-index:-1;
}


#container1 {
  float:left;
  width:100%;
  position:relative;
  font-size: 11px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}
#col1 {
  float:left;
  width:25%;
  text-align: center;
  position:relative;
  margin-top: -4px;
  left:77%;
  overflow:hidden;
}
#col2 {
  float:left;
  width:25%;
  text-align: center;
  position:relative;
  left:81%;
  overflow:hidden;
}
#col3 {
  float:left;
  width:25%;
  text-align: center;
  position:relative;
  left:85%;
  overflow:hidden;
}
#col4 {
  float:left;
  width:25%;
  text-align: center;
  position:relative;
  left:89%;
  overflow:hidden;
}

#hormat {
  float:left;
  width:25%;
  text-align: center;
  position:relative;
  margin-bottom: 20px;
  left:77%;
  overflow:hidden;
}
#menyetujui {
  float:left;
  width:25%;
  text-align: center;
  position:relative;
  margin-bottom: 20px;
  left:81%;
  overflow:hidden;
  margin-left: 150px;
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
	foreach ($task_detail as $td) : 
?>
<div class="style4">
  <div style="float: left; width: 54%;">
  Nomor : <?php echo "$form_id/$bu/$m/$y/$td->id" ?>
  </div>


  <div style="float: right; width: 28%;">
  <?= $location.', '.dateIndo($td->created_on)?>
  </div>

  <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
  Perihal : Pengajuan PJD ke <?=$td->destination?>
  <p>Dengan hormat</p>
  <p>Sehubungan dengan adanya kegiatan dalam rangka <?=$td->title?> di <?=$td->destination?>, bersama ini kami mengajukan perjalanan dinas sebagai berikut:</p>
  <div style="padding-left:15px;">
    <p>I.  &nbsp;Cabang/Depo yang dikunjungi&emsp;: <?=$td->destination?></p>
    <p>II. Tanggal & Waktu kunjungan&emsp;&emsp;: <?= dateIndo($td->date_spd).', '.$td->start_time.' s/d '.$td->end_time?></p>
    <p>III.Tujuan kunjungan&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;: <?=$td->title?></p>
  </div>
</div>

<table width="800" align="center" height="128" class="tg">
  <thead>
    <tr>
      <th width="7%">NIK</th>
      <th width="25%">Nama</th>
      <th width="25%">Dept/Bagian</th>
      <th width="15%">Jabatan</th>
      <th width="8%">Submit</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $receiver = getAll('users_spd_dalam_group', array('id'=>'where/'.$id))->row('task_receiver');
  $p = explode(",", $receiver);
  $n='';
  for($i=0;$i<sizeof($p);$i++):?>
  <tr>
  <td class="tg-031e"><?php echo $p[$i]?></td>
  <td><?php echo get_name($p[$i])?></td>
  <td><?php echo get_user_organization($p[$i])?></td>
  <td><?php echo get_user_position($p[$i])?></td>
  <td align="center"><?php echo in_array($p[$i], $receiver_submit)?"Ya":"-"?></td>
  </tr>
<?php endfor;?>
  </tbody>
  </table>
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
  <div id="menyetujui">
    <!-- Column three start -->
    <span class="small">Menyetujui,</span>
  </div>
</div>

<div id="container1">
  <div id="col1">
    <!-- Column one start -->
    <span class="small"></span><br/><br/><br/><br/>
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
    <span class="position">(<?php echo get_user_position($td->user_app_hrd) ?>)</span><!-- Column two end -->
    <!-- Column four end -->
  </div>
</div>
<br />

<?php if (!empty($td->user_app_lv3)) :?>
<div id="container1">
  <div id="hormat">
    <span class="small">&nbsp;</span>
  </div>
  <div id="menyetujui">
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
