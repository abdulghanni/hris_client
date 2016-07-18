<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title?></title>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{ height:40px;font-family:Arial, sans-serif;font-size:14px;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{height:40px; font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.jobdesc{font-family:Arial, sans-serif;font-size:10px;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.approval-img-md{
    height:60px;
    width:120px;
    margin-bottom: 8px;
    z-index:-1;
}

.style6 {
  color: #000000;
  font-weight: bold;
  font-size: 18px;
}
.style7 {
  font-size: 10px;
}
</style>
</head>
<body>
<div align="center">
  <p align="left"><img src="<?php echo 'http://localhost/hris_client/assets/img/erlangga.jpg' ?>"/></p>
  <p align="center" class="style6">Daftar Inventaris Karyawan</p>
</div>
<table width="1000" height="135" border="0" align="center">
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
    <td><span class="style3"><?php echo get_name($user_nik) ?> </span></td>
    <td><span class="style3">Posisi</span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo ucwords(strtolower(get_user_position($user_nik)))?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Tanggal Mulai Kerja </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo dateIndo(get_user_sen_date($user_nik));?></span></td>
  </tr>
</table>
<table class="tg" width="1000px" align="center">
  <tr>
    <th>No</th>
    <th>Item</th>
    <th>Keterangan</th>
  </tr>
  <?php
    $i=0;
    if($users_inventory->num_rows()>0){
      foreach ($users_inventory->result() as $inv) :
        ?>
  <tr>
    <td width="50"><?php echo 1+$i++ ?></td>
    <td width="400"><?php echo $inv->title?></td>
    <td width="500"><?php echo $inv->note?></td>
  </tr>
<?php endforeach;}?>
</table>
</body>
</html>
