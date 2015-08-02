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
  <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>"/></p>
  <p align="center" class="style6">Form Pengajuan Rolling</p>
</div>
<?php foreach($form_rolling as $row):
$user_nik = get_nik($row->user_id);
$pengaju_nik = get_nik($row->created_by);
$approved = assets_url('img/approved_stamp.png');
$rejected = assets_url('img/rejected_stamp.png');?>
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
    <td height="45"><span class="style3">Tanggal Mulai Bekerja</span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo dateIndo(get_seniority_date($user_nik));?></span></td>
  </tr>
</table>

<p class="style7">rolling yang diajukan</p>
<table width="1000" height="135" border="0" style="padding-left:30px;">
  <tr>
    <td width="275" height="45"><span class="style3">Unit Bisnis</span></td>
    <td width="10" height="45"><div align="center">:</div></td>
    <td width="445" height="45"><span class="style3"><?php echo get_bu_name(substr($row->new_bu,0,2))?></span></td>
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
    <td height="45"><span class="style3">Tanggal rolling </span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo dateIndo($row->date_rolling)?></span></td>
  </tr>
  <tr>
    <td height="45"><span class="style3">Alasan rolling</span></td>
    <td height="45"><div align="center">:</div></td>
    <td height="45"><span class="style3"><?php echo $row->alasan?></span></td>
  </tr>
</table>
<?php if(!empty($row->note_lv1)){?>
<p class="style4">Catatan Supervisor</p>
<textarea class="style4" rows="2" width="100%"><?php echo $row->note_lv1?></textarea>
<?php } ?>
<?php if(!empty($row->note_lv2)){?>
<p class="style4">Catatan Ka. Bagian</p>
<textarea class="style4" rows="2" width="100%"><?php echo $row->note_lv2?></textarea>
<?php } ?>
<?php if(!empty($row->note_lv3)){?>
<p class="style4">Catatan Atasan Lainnya</p>
<textarea class="style4" rows="2" width="100%"><?php echo $row->note_lv3?></textarea>
<?php } ?>
<?php if(!empty($row->note_hrd)){?>
<p class="style4">Catatan HRD</p>
<textarea class="style4" rows="2" width="100%"><?php echo $row->note_hrd?></textarea>
<?php } ?>
<br />
<table width="1000" align="center">
  <tbody>
    <tr>
      <th width="250" height="75">Diajukan Oleh,</th>
      <th width="250"></th>
      <th width="250">&nbsp;&nbsp;Mengetahui</th>
      <th width="250"></th>
    </tr>
    <tr>
      <td width="250" align="center"></td>
      <?php if(!empty($row->user_app_lv1)){?>
      <td width="250" align="center"><?php echo ($row->app_status_id_lv1 == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_lv1 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <?php }?>
      <?php if(!empty($row->user_app_lv2)){?>
      <td width="250" align="center"><?php echo ($row->app_status_id_lv2 == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_lv2 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <?php }?>
      <td width="250" align="center"><?php echo ($row->app_status_id_hrd == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_hrd == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
    </tr>
    <tr>
      <td height="80" align="center" class="style3"><?php echo get_name($row->created_by)?></td>
    <?php if(!empty($row->user_app_lv1)){?>
      <td height="80" align="center" class="style3"><?php echo get_name($row->user_app_lv1)?></td>
    <?php }?>
    <?php if(!empty($row->user_app_lv2)){?>
      <td align="center" class="style3"><?php echo get_name($row->user_app_lv2)?></td>
    <?php }?>
      <td align="center" class="style3"><?php echo get_name($row->user_app_hrd)?></td>
    </tr>
    <tr>
      <td align="center"><?php echo dateIndo($row->created_on)?><br/><?php echo get_user_position($pengaju_nik)?></td>
    <?php if(!empty($row->user_app_lv1)){?>
      <td align="center"><?php echo dateIndo($row->date_app_lv1)?><br/>(Supervisor)</td>
    <?php }?>
    <?php if(!empty($row->user_app_lv2)){?>
      <td align="center"><?php echo dateIndo($row->date_app_lv2)?><br/>(Ka. Bagian)</td>
      <?php }?>
      <td align="center"><?php echo dateIndo($row->date_app_hrd)?><br/>(HRD)</td>
    </tr>
  </tbody>
</table>

<?php if(!empty($row->user_app_lv3)){?>
<table width="1000" align="center">
  <tbody>
    <tr>
      <td width="333" align="center"></td>
      <td width="333" align="center"><?php echo ($row->app_status_lv3 == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_lv3 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <td width="333" align="center"></td>
    </tr>
    <tr>
      <td height="80" align="center" class="style3"></td>
      <td align="center" class="style3"><?php echo get_name($row->user_app_lv3)?></td>
      <td align="center" class="style3"></td>
    </tr>
    <tr>
      <td align="center"><?php echo dateIndo($row->date_app_lv1)?><br/></td>
    <?php if(!empty($row->user_app_lv3)){?>
      <td align="center"><?php echo dateIndo($row->date_app_lv3)?><br/><?php echo '('.get_user_position($row->user_app_lv3).')'?></td>
      <?php }?>
      <td align="center"></td>
    </tr>
  </tbody>
</table>
<?php }?>

<?php endforeach;?>
</body>
</html>
