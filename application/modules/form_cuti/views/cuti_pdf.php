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
  <p align="center" class="style6">Form Pengajuan Cuti</p>
</div>
<?php foreach($form_cuti as $user):?>
<table width="988" height="135" border="0" align="center" style="padding-left:30px">
  <tr>
    <td width="220" height="30"><span class="style3">NIK</span></td>
    <td width="10"><div align="center" class="style3">:</div></td>
    <td width="274"><div align="left" class="style3"><?php echo $nik?></div></td>
    <td width="200"><span class="style3">Dept/Bagian</span></td>
    <td width="10"><div align="center" class="style3">:</div></td>
    <td width="300"><span class="style3"><?php echo ucwords(strtolower($organization))?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Nama Karyawan </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo $user->first_name.' '.$user->last_name ?> </span></td>
    <td><span class="style3">Posisi</span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo ucwords(strtolower($position))?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Tanggal Mulai Kerja </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo dateIndo($seniority_date)?></span></td>
    <td><span class="style3">Tanggal Pengajuan </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo dateIndo($user->created_on)?> </span></td>
  </tr>
</table>
<p class="style7">Cuti Yang Akan Diambil </p>
<table width="988" height="135" border="0" style="padding-left:30px;">
  <tr>
    <td width="275" height="40"><span class="style3">Tahun</span></td>
    <td width="10" height="40"><div align="center">:</div></td>
    <td width="440" height="40"><span class="style3"><?php echo $user->session_year?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Tanggal Mulai Cuti </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo dateIndo($user->date_mulai_cuti).' s/d '.dateIndo($user->date_selesai_cuti)?> </span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Jumlah Hari </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->jumlah_hari?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Sisa Cuti </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $sisa_cuti?> Hari </span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Alasan</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->alasan_cuti?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Pengganti</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user_pengganti?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Alamat Selama Cuti </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->alamat_cuti?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Approval Status(SPV) </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->approval_status_lv1?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Note Supervisor </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->note_app_lv1?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Approval Status(Ka. Bag) </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->approval_status_lv2?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Note Ka. Bagian </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->note_app_lv2?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Approval Status(HRD) </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->approval_status_lv3?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Note HRD </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->note_app_lv3?></span></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p style="padding-left:20px"><strong>Disetujui Oleh,</strong></p>
<p>&nbsp;</p>
<table width="988" height="135" border="0" style="padding-left:150px">
  <tr>
    <td width="340"><div align="center" class="style4">
      <div align="center"><?php echo $nm_app_lv1?></div>
    </div></td>
    <td width="340"><div align="center" class="style4"><?php echo $nm_app_lv2?></div></td>
    <td width="340"><div align="center" class="style4"><?php echo $nm_app_lv3?></div></td>
  </tr>
  <tr>
    <td><div align="center" class="style4"><?php echo dateIndo($user->date_app_lv1)?></div></td>
    <td><div align="center" class="style4"><?php echo dateIndo($user->date_app_lv2)?></div></td>
    <td><div align="center" class="style4"><?php echo dateIndo($user->date_app_lv3)?></div></td>
  </tr>
  <tr>
    <td><div align="center" class="style4">(Supervisor)</div></td>
    <td><div align="center" class="style4">(Ka. Bagian) </div></td>
    <td><div align="center" class="style4">(HRD)</div></td>
  </tr>
</table>
<?php endforeach; ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
