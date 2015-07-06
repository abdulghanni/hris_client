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
  font-size: 16px;
}
.style6 {
  color: #000000;
  font-weight: bold;
  font-size: 24px;
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
   <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>" width="296" height="80" /></p>
  <p align="center" class="style6">Form Pengajuan Karyawan Keluar</p>
</div>
<?php foreach($form_resignment as $row):
$approved = assets_url('img/approved_stamp.png');
$rejected = assets_url('img/rejected_stamp.png');
$user_nik = get_nik($row->user_id);
?>
<table width="1000" height="135" border="0" align="center" style="padding-left:30px">
  <tr>
    <td width="275" height="45"><span class="style3">NIK</span></td>
    <td width="10" height="45"><div align="center">:</div></td>
    <td width="445" height="45"><span class="style3"><?php echo $user_nik;?></span></td>
  </tr>
  <tr>
    <td height="45"><span class="style3">Nama Karyawan</span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo get_name($row->user_id)?></span></td>
  </tr>
  <tr>
    <td height="45"><span class="style3">Unit Bisnis </span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo get_user_bu($user_nik)?></span></td>
  </tr>
  <tr>
    <td height="45"><span class="style3">Dept/Bagian </span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo get_user_organization($user_nik)?></span></td>
  </tr>
  <tr>
    <td height="45"><span class="style3">Jabatan</span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo get_user_position($user_nik)?></span></td>
  </tr>
  <tr>
    <td height="45"><span class="style3">Tanggal Mulai Bekerja</span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo dateIndo(get_user_sen_date($user_nik));?></span></td>
  </tr>
   <tr>
    <td height="45"><span class="style3">Tanggal Keluar Kerja</span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo dateIndo($row->date_resign);?></span></td>
  </tr>
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
      <td width="250" align="center"><?php echo ($row->app_status_id_lv1 == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_lv1 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <td width="250" align="center"><?php echo ($row->app_status_id_lv2 == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_lv2 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <td width="250" align="center"><?php echo ($row->app_status_id_lv3 == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_lv3 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <td width="250" align="center"><?php echo ($row->app_status_id_hrd == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_hrd == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
    </tr>
    <tr>
    <?php if(!empty($row->user_app_lv1)){?>
      <td height="80" align="center" class="style3"><?php echo get_name($row->user_app_lv1)?></td>
    <?php }?>
    <?php if(!empty($row->user_app_lv2)){?>
      <td align="center" class="style3"><?php echo get_name($row->user_app_lv2)?></td>
    <?php }?>
    <?php if(!empty($row->user_app_lv3)){?>
      <td align="center" class="style3"><?php echo get_name($row->user_app_lv3)?></td>
    <?php }?>
      <td align="center" class="style3"><?php echo get_name($row->user_app_hrd)?></td>
    </tr>
    <tr >
    <?php if(!empty($row->user_app_lv1)){?>
      <td align="center"><?php echo dateIndo($row->date_app_lv1)?><br/>(Supervisor)</td>
    <?php }?>
    <?php if(!empty($row->user_app_lv2)){?>
      <td align="center"><?php echo dateIndo($row->date_app_lv2)?><br/>(Ka. Bagian)</td>
      <?php }?>
    <?php if(!empty($row->user_app_lv3)){?>
      <td align="center"><?php echo dateIndo($row->date_app_lv3)?><br/><?php echo '('.get_user_position($row->user_app_lv3).')'?></td>
    <?php } ?>
      <td align="center"><?php echo dateIndo($row->date_app_hrd)?><br/>(HRD)</td>
    </tr>
  </tbody>
</table>

<?php endforeach;?>
</body>
</html>
