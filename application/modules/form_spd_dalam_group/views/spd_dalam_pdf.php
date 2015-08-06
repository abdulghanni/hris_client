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
  font-size: 20px;
  font-weight: bold;
}
.style4 {
  font-size: 28px;
  font-weight: bold;
  text-align: center;
}

.style5 {
  font-size: 14px;
  font-weight: bold;
  text-align: center;
}

.style6 {
  color: #000000;
  font-weight: bold;
  font-size: 26px;
}
.style7 {
  padding-left: 20px;
  font-size: 17px;
  font-weight: bold;
}
-->
</style>
</head>

<body>
<div align="center">
  <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>"/></p>
  <p align="center" class="style6">Form Surat Tugas / Ijin </p>
</div>
<?php
	if ($td_num_rows > 0) {
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
<p>&nbsp;</p>
<p>&nbsp;</p>

<div style="float: left; text-align: center; width: 50%;" class="style5">
<?php if($td->task_creator !== get_nik($td->created_by)):?>
<p>Yang bersangkutan</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p class="wf-submit">
<span class="semi-bold">
<?php
    echo get_name($td->created_by);
?>
</span><br/>
<span class="small"><?php echo dateIndo($td->created_on) ?></span><br/>
<span class="small"><?php echo get_user_position(get_nik($td->created_by)) ?></span><br/>
</p>
<?php endif; ?>
</div>

<div style="float: right;text-align: center; width: 50%;" class="style5">
<p>Yang memberi tugas / ijin</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<span class="semi-bold"><?php echo get_name($td->task_creator) ?></span><br/>
<span class="small"><?php echo dateIndo($td->created_on) ?></span><br/>
</div> 
<?php endforeach;}?>
</body>
</html>
