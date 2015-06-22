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
      <th width="5%">NIK</th>
      <th width="25%">Nama</th>
      <th width="25%">Nama Pasien</th>
      <th width="15%">Hubungan</th>
      <th width="13%">Jenis Pemeriksaan</th>
      <th width="12%">Rupiah</th>
    </tr>
  </thead>
  <tbody>
	<?php 
	  if(!empty($detail)){
	     $total = $detail[0]['rupiah'];
	      for($i=0;$i<sizeof($detail);$i++):
	      ?>
	  <tr>
	    <td height="50"><?php echo get_nik($detail[$i]['karyawan_id'])?></td>
	    <td><?php echo get_name($detail[$i]['karyawan_id'])?></td>
	    <td><?php echo $detail[$i]['pasien']?></td>
	    <td><?php echo $detail[$i]['hubungan']?></td>
	    <td><?php echo $detail[$i]['jenis']?></td>
	    <td><?php echo  'Rp. '.number_format($detail[$i]['rupiah'], 0)?></td>
	  </tr>
	    <?php /*
	      if(sizeof($detail)>1){?>
	        <?php if($detail[$i]['karyawan_id'] != $detail[$i+1]['karyawan_id']){
	            $sub_total = $detail[$i]['rupiah'] + $detail[$i+1]['rupiah']
	          ?>
	          <tr>
	            <td align="right" colspan="5">Total <?php echo $detail[$i]['karyawan_id']?>: </td><td><?php echo $sub_total?></td>
	          </tr>
	          <?php } ?>
	    <?php };*/?>
	    <?php
	    if(sizeof($detail)>1 && isset($detail[$i+1])){
	    $total = $total + $detail[$i+1]['rupiah'];
	    }
	    endfor;}
	    ?>
	    <tr>
	    <td height="70" align="right" colspan="5">Total : </td><td><?php echo 'Rp. '.number_format($total, 0)?></td>
	    </tr>
	</tbody>
</table>
<br/>
<p>&nbsp;</p>
<p>&nbsp;</p>

<div style="float: left; text-align: center; width: 50%;" class="style5">
<p>Hormat Kami,</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php echo get_name($created_by)?>
<br/>
<?php echo (!empty(get_user_position(get_nik($created_by)))) ? get_user_position(get_nik($created_by)) : ''?><br/>
<?php echo dateIndo($created_on) ?>
</div>

<div style="float: right;text-align: center; width: 50%;" class="style5">
<p>Disetujui, </p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<span class="semi-bold"><?php echo (!empty($user_app))?get_name($user_app):'' ?></span><br/>
<?php echo (!empty($user_app)) ? get_user_position(get_nik($user_app)) : ''?><br/>
<?php echo dateIndo($date_app) ?>
</div>

<div style="clear: both; margin: 0pt; padding: 0pt; "></div>
<p>&nbsp;</p>
</body>
</html>
