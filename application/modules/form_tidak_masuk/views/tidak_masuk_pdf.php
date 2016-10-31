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
  font-size: 22px;
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
  <p align="center" class="style6">Form Izin Tidak Masuk</p>
</div>
<?php foreach($form_tidak_masuk as $row):
$approved = assets_url('img/approved_stamp.png');
$rejected = assets_url('img/rejected_stamp.png');
$pending = assets_url('img/pending_stamp.png');
?>
<table width="1000" height="135" border="0" style="padding-left:30px;">
  <tr>
    <td width="275" height="50"><span class="style3">No</span></td>
    <td width="10" height="50"><div align="center">:</div></td>
    <td width="440" height="50"><span class="style3"><?php echo get_form_no($row->id)?></span></td>
  </tr>
  <tr>
    <td height="50"><span class="style3">Nama</span></td>
    <td height="50"><div align="center">:</div></td>
    <td height="50"><span class="style3"><?php echo get_name($row->user_id)?></span></td>
  </tr>
  <tr>
    <td height="50"><span class="style3">Bagian</span></td>
    <td height="50"><div align="center">:</div></td>
    <td height="50"><span class="style3"><?php echo get_user_organization($user_nik) ?></span></td>
  </tr>
  <tr>
    <td height="50"><span class="style3">Jabatan</span></td>
    <td height="50"><div align="center">:</div></td>
    <td height="50"><span class="style3"><?php echo get_user_position($user_nik) ?></span></td>
  </tr>
  <tr>
    <td height="50"><span class="style3">Tanggal Tidak Masuk </span></td>
    <td height="50"><div align="center">:</div></td>
    <td height="50"><span class="style3"><?php echo dateIndo($row->dari_tanggal)?> s/d <?php echo dateIndo($row->sampai_tanggal)?> (<?php echo $row->jml_hari?> Hari)</span></td>
  </tr>
  <tr>
    <td height="50"><span class="style3">Alasan</span></td>
    <td height="50"><div align="center">:</div></td>
    <td height="50"><span class="style3"><?php echo $alasan?></span></td>
  </tr>
  <tr>
    <td height="50"><span class="style3">Keterangan</span></td>
    <td height="50"><div align="center">:</div></td>
    <td height="50"><span class="style3"><?php echo $row->keterangan?></span></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="1000" align="center">
  <tbody>
    <tr>
      <th width="250" height="75"></th>
      <th width="250">Mengetahui,</th>
      <th width="250"></th>
      <th width="250"></th>
    </tr>
    <tr>
      <td width="250" align="center"><?php echo ($row->is_app_lv1 == 1)?"<img class=approval-img-md src=$approved>":(($row->is_app_lv1 == 2) ? "<img class=approval-img-md src=$rejected>":(($row->is_app_lv1 == 3) ? "<img class=approval-img-md src=$pending>":'<span class="small"></span><br/>'));?></td>
      <td width="250" align="center"><?php echo ($row->is_app_lv2 == 1)?"<img class=approval-img-md src=$approved>":(($row->is_app_lv2 == 2) ? "<img class=approval-img-md src=$rejected>":(($row->is_app_lv2 == 3) ? "<img class=approval-img-md src=$pending>":'<span class="small"></span><br/>'));?></td>
      <td width="250" align="center"><?php echo ($row->is_app_lv3 == 1)?"<img class=approval-img-md src=$approved>":(($row->is_app_lv3 == 2) ? "<img class=approval-img-md src=$rejected>":(($row->is_app_lv3 == 3) ? "<img class=approval-img-md src=$pending>":'<span class="small"></span><br/>'));?></td>
      <td width="250" align="center"><?php echo ($row->is_app_hrd == 1)?"<img class=approval-img-md src=$approved>":(($row->is_app_hrd == 2) ? "<img class=approval-img-md src=$rejected>":(($row->is_app_hrd == 3) ? "<img class=approval-img-md src=$pending>":'<span class="small"></span><br/>'));?></td>
    </tr>
    <tr>
      <td height="80" align="center" class="style3"><?php echo get_name($row->user_app_lv1)?></td>
      <td align="center" class="style3"><?php echo get_name($row->user_app_lv2)?></td>
      <td align="center" class="style3"><?php echo get_name($row->user_app_lv3)?></td>
      <td align="center" class="style3"><?php echo get_name($row->user_app_hrd)?></td>
    </tr>
    <tr >
      <td align="center"><?php echo dateIndo($row->date_app_lv1)?><br/>(Atasan Langsung)</td>
      <td align="center"><?php echo dateIndo($row->date_app_lv2)?><?php if(!empty($row->user_app_lv2)):?><br/><?php echo '('.get_user_position($row->user_app_lv2).')';endif;?></td>
      <td align="center"><?php echo dateIndo($row->date_app_lv3)?><?php if(!empty($row->user_app_lv3)):?><br/><?php echo '('.get_user_position($row->user_app_lv3).')';endif;?></td>
      <td align="center"><?php echo dateIndo($row->date_app_hrd)?><br/>(HRD)</td>
    </tr>
  </tbody>
</table>
<?php endforeach; ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
