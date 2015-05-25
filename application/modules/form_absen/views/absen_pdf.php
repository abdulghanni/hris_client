<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title?></title>
<style type="text/css">
<!--
.style3 {
  font-size: 20px;
  font-weight: bold;
}
.style4 {
  font-size: 22px;
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
  font-size: 18px;
  font-weight: bold;
}
-->
</style>
</head>

<body>
<div align="center">
  <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>" width="296" height="80" /></p>
  <p align="center" class="style6">Form Keterangan Tidak Absen</p>
</div>
<?php foreach($form_absen->result() as $row):?>
<table width="988" height="135" border="0" style="padding-left:30px;">
  <tr>
    <td width="275" height="40"><span class="style3">No</span></td>
    <td width="10" height="40"><div align="center">:</div></td>
    <td width="440" height="40"><span class="style3"><?php echo $row->id?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Tanggal absen </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo dateIndo($row->date_tidak_hadir)?> </span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Nama Karyawan </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo get_name($row->user_id)?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Dept/Bagian</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user_info['ORGANIZATION']; ?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Keterangan</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $row->keterangan_absen?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Alasan</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $row->alasan?></span></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div style="float: left; text-align: center; width: 30%;" class="style5">
<p>Hormat Saya,</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p class="wf-submit">
<span class="semi-bold"><?php echo get_name($row->user_id) ?></span><br/>
<span class="small"><?php echo dateIndo($row->created_on) ?></span><br/>
</p>
</div>



<div style="float: right;text-align: center; width: 30%;" class="style5">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php if($row->is_app_lv1 == 1){?>
<span class="semi-bold"><?php echo get_name($row->user_app_lv1) ?></span><br/>
<span class="small"><?php echo dateIndo($row->date_app_lv1)?></span><br/>
<?php } ?>
<span class="small">(Supervisor)</span>
</div>

<div style="float: right;text-align: center; width: 30%;" class="style5">
<p>Mengetahui,</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php if($row->is_app_lv2 == 1){?>
<span class="semi-bold"><?php echo get_name($row->user_app_lv2) ?></span><br/>
<span class="small"><?php echo dateIndo($row->date_app_lv2)?></span><br/>
<?php } ?>
<span class="small">(Ka. Cabang / Ka. Bagian)</span>
</div>

<div style="clear: both; margin: 0pt; padding: 0pt; "></div>
<p>&nbsp;</p>
<?php endforeach; ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
