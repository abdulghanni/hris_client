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
  <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>" width="296" height="80" /></p>
  <p align="center" class="style6">REKAPITULASI RAWAT JALAN & INAP</p>
</div>

<table width="1200" height="128" border="0" class="style3">
<tr><td height="40"></td></tr>
<tr><td>Bagian : <?php echo $bagian?></td></tr>
<tr><td height="30"></td></tr>
</table>

<table width="1000" height="128" border="1" class="style3">
  <thead>
    <tr>
      <th width="7%">NIK</th>
      <th width="25%">Nama</th>
      <th width="25%">Nama Pasien</th>
      <th width="15%">Hubungan</th>
      <th width="13%">Jenis Pemeriksaan</th>
      <th width="12%">Rupiah</th>
      <th width="10%">Disetujui</th>
    </tr>
  </thead>
  <tbody>
	<?php 
	  if(!empty($detail_hrd)){
	     $total = $detail_hrd[0]['rupiah'];
	      for($i=0;$i<sizeof($detail_hrd);$i++):
	      $is_approve = ($detail_hrd[$i]['is_approve'] == 1) ? 'Ya':'Tidak';
	      ?>
	  <tr>
	    <td><?php echo get_nik($detail_hrd[$i]['karyawan_id'])?></td>
	    <td><?php echo get_name($detail_hrd[$i]['karyawan_id'])?></td>
	    <td><?php echo $detail_hrd[$i]['pasien']?></td>
	    <td><?php echo $detail_hrd[$i]['hubungan']?></td>
	    <td><?php echo $detail_hrd[$i]['jenis']?></td>
	    <td><?php echo  'Rp. '.number_format($detail_hrd[$i]['rupiah'], 0)?></td>
	    <td align="center"><?php echo $is_approve?></td>
	  </tr>
	    <?php
	    endfor;}
	    ?>
	    <tr>
	    <td align="right" colspan="5">Total : </td><td><?php echo 'Rp. '.number_format($total_medical_hrd, 0)?></td>
	   </tr>
	</tbody>
</table>
<br/>
<p>&nbsp;</p>
<p>&nbsp;</p>

<table width="1000" align="center">
  <tbody>
    <tr>
      <td width="333" height="10" align="center" class="style3">Hormat Kami,</td>
      <td width="333" align="center" class="style3">Menyetujui,</td>
      <td width="333" align="center" class="style3">Mengetahui</td>
    </tr>
    <tr>
      <td height="117" align="center" class="style3"><?php echo get_name($created_by)?><br/><?php echo dateIndo($created_on) ?><br/><?php echo (!empty(get_user_position(get_nik($created_by)))) ? get_user_position(get_nik($created_by)) : ''?></td>
      <td align="center" class="style3"><?php echo get_name($is_app_hrd)?><br/><?php echo dateIndo($user_app_hrd) ?><br/><?php echo (!empty(get_user_position($user_app_hrd))) ? get_user_position($user_app_hrd) : ''?></td>
      <td align="center" class="style3"><?php echo get_name($user_app)?><br/><?php echo dateIndo($date_app) ?><br/><?php echo (!empty(get_user_position($user_app))) ? get_user_position($user_app) : ''?></td>
    </tr>
  </tbody>
</table>
<!--
<div style="float: left; text-align: center; width: 30%;" class="style5">
<p>Hormat Kami,</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php echo get_name($created_by)?>
<br/>
<?php echo (!empty(get_user_position(get_nik($created_by)))) ? get_user_position(get_nik($created_by)) : ''?><br/>
<?php echo dateIndo($created_on) ?>
</div>

<div style="float: center;text-align: center; width: 30%;" class="style5">
<p>Disetujui, </p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<span class="semi-bold"><?php echo (!empty($user_app_hrd))?get_name($user_app_hrd):'' ?></span><br/>
<?php echo (!empty($user_app_hrd)) ? get_user_position($user_app_hrd) : ''?><br/>
<?php echo dateIndo($date_app_hrd) ?>
</div>

<div style="float: right;text-align: center; width: 30%;" class="style5">
<p>Mengetahui, </p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<span class="semi-bold"><?php echo (!empty($user_app))?get_name($user_app):'' ?></span><br/>
<?php echo (!empty($user_app)) ? get_user_position($user_app) : ''?><br/>
<?php echo dateIndo($date_app) ?>
</div>
-->
<div style="clear: both; margin: 0pt; padding: 0pt; "></div>
<p>&nbsp;</p>
</body>
</html>
