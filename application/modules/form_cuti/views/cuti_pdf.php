<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title?></title>
<style type="text/css">
<!--
.style3 {
  font-size: 20px;
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
  font-size: 16px;
  font-weight: bold;
}

.approval-img-md{
    height:12%;
    width:15%;
    z-index:-1;
}
-->
</style>
</head>

<body>
<div align="center">
  <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>"/></p>
  <p align="center" class="style6">Form Permohonan Cuti</p>
</div>
<?php foreach($form_cuti as $user):
$user_nik = get_nik($user->user_id);
$submission_date = dateIndo($user->created_on);
$date_start_cuti = dateIndo($user->date_mulai_cuti);
$date_end_cuti = dateIndo($user->date_selesai_cuti);
$approved = assets_url('img/approved_stamp.png');
$rejected = assets_url('img/rejected_stamp.png');
?>
<table width="1000" height="135" border="0" align="center" style="padding-left:30px">
  <tr>
    <td width="220" height="30"><span class="style3">NIK</span></td>
    <td width="10"><div align="center" class="style3">:</div></td>
    <td width="274"><div align="left" class="style3"><?php echo $user_nik?></div></td>
    <td width="200"><span class="style3">Dept/Bagian</span></td>
    <td width="10"><div align="center" class="style3">:</div></td>
    <td width="300"><span class="style3"><?php echo ucwords(strtolower(get_user_organization($user_nik)))?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Nama Karyawan </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo get_name($user->user_id) ?> </span></td>
    <td><span class="style3">Posisi</span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo ucwords(strtolower(get_user_position($user_nik)))?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Tanggal Mulai Kerja </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo dateIndo(get_user_sen_date($user_nik));?></span></td>
    <td><span class="style3">Tanggal Pengajuan </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo dateIndo($user->created_on)?> </span></td>
  </tr>
</table>
<p class="style7">Cuti Yang Akan Diambil </p>
<table width="1000" height="135" border="0" style="padding-left:30px;">
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
    <td height="40"><span class="style3"><?php echo $user->sisa_cuti?> Hari </span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Alasan</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->alasan_cuti?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Remarks</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->remarks?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Pengganti</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo get_name($user->user_pengganti) ?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">No. HP</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->contact?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Alamat Selama Cuti </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->alamat_cuti?></span></td>
  </tr>
  <?php if(!empty($user->note_app_lv1)){?>
  <tr>
    <td height="40"><span class="style3">Note (<?php echo strtok(get_name($user->user_app_lv1), " ")?>) </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->note_app_lv1?></span></td>
  </tr>
  <?php } ?>
  <?php if(!empty($user->note_app_lv2)){?>
  <tr>
    <td height="40"><span class="style3">Note (<?php echo strtok(get_name($user->user_app_lv2), " ")?>) </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->note_app_lv2?></span></td>
  </tr>
  <?php } ?>
  <?php if(!empty($user->note_app_lv3)){?>
  <tr>
    <td height="40"><span class="style3">Note (<?php echo strtok(get_name($user->user_app_lv3), " ")?>) </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->note_app_lv3?></span></td>
  </tr>
  <?php } ?>
  <?php if(!empty($user->note_app_hrd)){?>
  <tr>
    <td height="40"><span class="style3">Note (<?php echo strtok(get_name($user->user_app_hrd), " ")?>) </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><span class="style3"><?php echo $user->note_app_hrd?></span></td>
  </tr>
  <?php } ?>
</table>
<table width="1000" align="center">
  <tbody>
    <tr>
      <th width="250" height="75"></th>
      <th width="250">Disetujui Oleh,</th>
      <th width="250"></th>
      <th width="250"></th>
    </tr>
    <tr>
      <td width="250" align="center"><?php echo ($user->approval_status_id_lv1 == 1)?"<img class=approval-img-md src=$approved>":(($user->approval_status_id_lv1 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <td width="250" align="center"><?php echo ($user->approval_status_id_lv2 == 1)?"<img class=approval-img-md src=$approved>":(($user->approval_status_id_lv2 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <td width="250" align="center"><?php echo ($user->approval_status_id_lv3 == 1)?"<img class=approval-img-md src=$approved>":(($user->approval_status_id_lv3 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <td width="250" align="center"><?php echo ($user->approval_status_id_hrd == 1)?"<img class=approval-img-md src=$approved>":(($user->approval_status_id_hrd == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
    </tr>
    <tr>
      <td height="80" align="center" class="style3"><?php echo get_name($user->user_app_lv1)?></td>
      <td align="center" class="style3"><?php echo get_name($user->user_app_lv2)?></td>
      <td align="center" class="style3"><?php echo get_name($user->user_app_lv3)?></td>
      <td align="center" class="style3"><?php echo get_name($user->user_app_hrd)?></td>
    </tr>
    <tr >
      <td align="center"><?php echo dateIndo($user->date_app_lv1)?><br/>(Atasan Langsung)</td>
      <td align="center"><?php echo dateIndo($user->date_app_lv2)?><?php if(!empty($user->user_app_lv2)):?><br/><?php echo '('.get_user_position($user->user_app_lv2).')';endif;?></td>
      <td align="center"><?php echo dateIndo($user->date_app_lv3)?><?php if(!empty($user->user_app_lv3)):?><br/><?php echo '('.get_user_position($user->user_app_lv3).')';endif;?></td>
      <td align="center"><?php echo dateIndo($user->date_app_hrd)?><br/>(HRD)</td>
    </tr>
  </tbody>
</table>
<?php endforeach; ?>
<p>&nbsp;</p>
</body>
</html>
