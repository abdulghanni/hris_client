<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title?></title>
<style type="text/css">
<!--
tbody td{
  border-collapse:collapse;border-spacing:0; height:40px;font-family:Arial, sans-serif;font-size:14px;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;
}

th{
  border-collapse:collapse;border-spacing:0; height:40px;font-family:Arial, sans-serif;font-size:14px;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;
}

.style3 {
  font-size: 16px;
}
.style4 {
  font-size: 12px;
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
    height:12%;
    width:15%;
    z-index:-1;
}
}
-->
</style>
</head>

<body>
<div align="center">
  <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>"/></p>
  <p align="center" class="style6">Form Surat Perjalan Dinas Dalam Kota </p>
</div>
<?php
	if ($td_num_rows > 0) {
  $approved = assets_url('img/approved_stamp.png');
  $rejected = assets_url('img/rejected_stamp.png');
	foreach ($task_detail as $td) : 
?>
<p class="style7">Yang Memberi Tugas</p>
<table width="1000" height="128" border="0" style="padding-left:30px;" class="style3">
  <tr>
    <td width="275" height="40"><span class="style3">Nama</span></td>
    <td width="10" height="40"><div align="center">:</div></td>
    <td width="440" height="40"><?php echo get_name($td->task_creator) ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Bagian / Dept </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo get_user_organization($td->task_creator)?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Jabatan</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo get_user_position($td->task_creator);?></td>
  </tr>
</table>

<p class="style7">Memberi tugas / Ijin Kepada</p>
<table width="1000" align="center" height="128" style="padding-left:30px;" class="style3">
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
  <td><?php echo $p[$i]?></td>
  <td><?php echo get_name($p[$i])?></td>
  <td><?php echo get_user_organization($p[$i])?></td>
  <td><?php echo get_user_position($p[$i])?></td>
  <td align="center"><?php echo in_array($p[$i], $receiver_submit)?"Ya":"-"?></td>
  </tr>
<?php endfor;?>
  </tbody>
  </table>
 <table width="1000" align="center" height="128" style="padding-left:30px;" class="style3">
  <tr>
    <td height="40"><span class="style3">Melakukan tugas / ijin ke </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo $td->destination ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Dalam rangka  </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo $td->title; ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Tanggal</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php $task_date = dateIndo($td->date_spd) ?><?php echo $task_date; ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Waktu</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo date('H:i:s',strtotime($td->start_time)) ?> s/d <?php echo date('H:i:s',strtotime($td->end_time)) ?></td>
  </tr>
</table>

<div style="float: left; text-align: center; width: 50%;" class="style4">
<!--<p>Yang bersangkutan</p>
<?php if ($this->session->userdata('user_id') == $td->task_receiver && $td->is_submit == 0|| get_nik($this->session->userdata('user_id')) == $td->task_receiver && $td->is_submit == 0) { ?>
<p class="">...............................</p>
<?php }elseif ($this->session->userdata('user_id') != $td->task_receiver && $td->is_submit == 0) { ?>
<p class="">...............................</p>
<?php }else{ ?>
<span class="semi-bold"><?php echo get_name($td->task_receiver) ?></span><br/>
<span class="small"><?php echo dateIndo($td->date_submit) ?></span><br/>
<?php } ?>-->
</div>

<div style="float: right;text-align: center; width: 50%;" class="style4">
<p>Yang memberi tugas / ijin</p>
<span class="semi-bold"><?php echo get_name($td->task_creator) ?></span><br/>
<span class="small"><?php echo dateIndo($td->created_on) ?></span><br/>
</div> 
<?php endforeach;}?>
<div style="clear: both; margin: 0pt; padding: 0pt; "></div>
<br/>
<table width="1000" align="center" border="0">
    <tr>
      <tr width="250" height="100"></tr>
      <tr width="250"><b>Mengetahui/Menyetujui</b></tr>
      <tr width="250"></tr>
      <tr width="250"></tr>
    </tr>
    <tr>
      <?php if(!empty($td->user_app_lv1)){?>
      <td width="250" align="center"><?php echo ($td->app_status_id_lv1 == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_lv1 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <?php }?>
      <?php if(!empty($td->user_app_lv2)){?>
      <td width="250" align="center"><?php echo ($td->app_status_id_lv2 == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_lv2 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <?php }?>
      <?php if(!empty($td->user_app_lv3)){?>
      <td width="250" align="center"><?php echo ($td->app_status_id_lv3 == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_lv3 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <?php }?>
      <td width="250" align="center"><?php echo ($td->app_status_id_hrd == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_hrd == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
    </tr>
    <tr>
    <?php if(!empty($td->user_app_lv1)){?>
      <td height="80" align="center" class="style3"><?php echo get_name($td->user_app_lv1)?></td>
    <?php }?>
    <?php if(!empty($td->user_app_lv2)){?>
      <td align="center" class="style3"><?php echo get_name($td->user_app_lv2)?></td>
    <?php }?>
    <?php if(!empty($td->user_app_lv3)){?>
      <td align="center" class="style3"><?php echo get_name($td->user_app_lv3)?></td>
    <?php }?>
      <td align="center" class="style3"><?php echo get_name($td->user_app_hrd)?></td>
    </tr>
    <tr>
    <?php if(!empty($td->user_app_lv1)){?>
      <td align="center"><?php echo dateIndo($td->date_app_lv1)?><br/><?php echo get_user_position($td->user_app_lv1)?></td>
    <?php }?>
    <?php if(!empty($td->user_app_lv2)){?>
      <td align="center"><?php echo dateIndo($td->date_app_lv2)?><br/><?php echo get_user_position($td->user_app_lv2)?></td>
    <?php }?>
    <?php if(!empty($td->user_app_lv2)){?>
      <td align="center"><?php echo dateIndo($td->date_app_lv3)?><br/><?php echo get_user_position($td->user_app_lv3)?></td>
    <?php }?>
      <td align="center"><?php echo dateIndo($td->date_app_hrd)?><br/>(HRD)</td>
    </tr>
</table>
<br />

</body>
</html>
