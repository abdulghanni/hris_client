<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title?></title>
<style type="text/css">
<!--
.style3 {
  font-size: 16px;
  font-weight: bold;
}
.style4 {
  font-size: 10px;
}
.style6 {
  color: #000000;
  font-weight: bold;
  font-size: 18px;
}
.style7 {
  padding-left: 20px;
  font-size: 14px;
  font-weight: bold;
}
-->
</style>
</head>

<body>
<div align="center">
  <!-- <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>" width="296" height="80" /></p>-->
  <p align="center" class="style6">Form Pengajuan Promosi</p>
</div>
<?php foreach($form_promosi->result() as $row):?>
<table width="1000" height="135" border="0" align="center" style="padding-left:30px">
  <tr>
    <td width="275" height="45"><span class="style3">NIK</span></td>
    <td width="10" height="45"><div align="center">:</div></td>
    <td width="445" height="45"><span class="style3"><?php echo (!empty($user_info))?$user_info['EMPLID']:'-';?></span></td>
  </tr>
  <tr>
    <td height="45"><span class="style3">Nama Karyawan</span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo get_name($row->user_id)?></span></td>
  </tr>
  <tr>
    <td height="45"><span class="style3">Unit Bisnis </span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo get_bu_name($row->old_bu)?></span></td>
  </tr>
  <tr>
    <td height="45"><span class="style3">Dept/Bagian </span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo get_organization_name($row->old_org)?></span></td>
  </tr>
  <tr>
    <td height="45"><span class="style3">Jabatan</span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo get_position_name($row->old_pos)?></span></td>
  </tr>
  <tr>
    <td height="45"><span class="style3">Tanggal Pengangkatan</span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo (!empty($user_info))?dateIndo($user_info['SENIORITYDATE']):'-';?></span></td>
  </tr>
</table>

<p>&nbsp;</p>
<p class="style7">Promosi yang diajukan</p>
<table width="1000" height="135" border="0" style="padding-left:30px;">
  <tr>
    <td width="275" height="45"><span class="style3">Unit Bisnis</span></td>
    <td width="10" height="45"><div align="center">:</div></td>
    <td width="445" height="45"><span class="style3"><?php echo get_bu_name($row->new_bu)?></span></td>
  </tr>
  <tr>
    <td height="45"><span class="style3">Dept/Bagian</span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo get_organization_name($row->new_org)?> </span></td>
  </tr>
  <tr>
    <td height="45"><span class="style3">Jabatan </span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo get_position_name($row->new_pos)?></span></td>
  </tr>
  <tr>
    <td height="45"><span class="style3">Tanggal Pengangkatan </span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo dateIndo($row->date_promosi)?></span></td>
  </tr>
  <tr>
    <td height="45"><span class="style3">Alasan Pengangkatan</span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo $row->alasan?></span></td>
  </tr>
</table>
<?php if(!empty($row->note_hrd)){?>
<p class="style4">Catatan</p>
<textarea class="style4" rows="4" width="100%"><?php echo $row->note_hrd?></textarea>
<?php } ?>
<br />
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<table width="1000" align="center">
  <tbody>
    <tr>
      <td width="250" height="10" align="center" class="style3">Yang Mengajukan</td>
      <td width="250"></td>
      <td width="250"></td>
      <td width="250" align="center" class="style3">Menyetujui,</td>
    </tr>
    <tr>
      <td height="117" align="center" class="style3"><?php echo get_name($row->created_by)?><br/><?php echo dateIndo($row->created_on)?></td>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center" class="style3"><?php echo get_name($row->user_approved)?><br/><?php echo dateIndo($row->date_approved)?></td>
    </tr>
  </tbody>
</table>

<?php endforeach;?>
</body>
</html>
