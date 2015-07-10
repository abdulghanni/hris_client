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

-->
</style>
</head>

<body>
<div align="center">
  <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>" width="296" height="80" /></p>
  <p align="center" class="style6">Form Surat Tugas / Ijin </p>
</div>
<?php
if ($td_num_rows > 0) {
  foreach ($task_detail as $td) : 

    $a = strtotime($td->date_spd_end);
    $b = strtotime($td->date_spd_start);

    $j = $a - $b;
    $jml_pjd = floor($j/(60*60*24)+1);
    ?>
<table width="1200" height="128" border="0" class="style3">
<tr class="style4"><td>Yang bertanda tangan dibawah ini : </td></tr>
<tr><td height="30"></td></tr>
  <tr>
    <td width="275" height="40"><span class="style3">Nama</span></td>
    <td width="10" height="40"><div align="center">:</div></td>
    <td width="440" height="40"><?php echo get_name($td->task_creator) ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Bagian / Dept </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo get_user_organization($td->task_creator)?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Jabatan</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo get_user_position($td->task_creator);?></td>
  </tr>
<?php endforeach; }?> 
</table>

<table width="1200" height="128" border="0" class="style3">
<tr><td height="40"></td></tr>
<tr><td>Memberi tugas / ijin kepada : </td></tr>
<tr><td height="30"></td></tr>
</table>

<table width="1500" height="128" border="1" class="style3">
  <thead>
    <tr>
      <th width="2%">No</th>
      <th width="5%">NIK</th>
      <th width="20%">Nama</th>
      <th width="5%">Golongan</th>
      <th width="20%">Dept/Bagian</th>
      <th width="20%">Jabatan</th>
      <th width="8%">Submit</th>
    </tr>
  </thead>
  <tbody>
    <?php for($i=0;$i<sizeof($receiver);$i++):
    ?>
    <tr>
    <td height="50" align="center"><?php echo $i+1?></td>
    <td  align="center"><?php echo $receiver[$i]?></td>
    <td>&nbsp;<?php echo get_name($receiver[$i])?></td>
      <td  align="center"><?php echo get_grade($receiver[$i])?></td>
      <td>&nbsp;<?php echo get_user_organization($receiver[$i])?></td>
      <td>&nbsp;<?php echo get_user_position($receiver[$i])?></td>
      <td align="center"><?php echo in_array($receiver[$i], $receiver_submit)?"Ya":"-"?></td>
    </tr>
    <?php endfor?>
  </tbody>
</table>
<br/>
<table width="1200" height="128" border="0" style="" class="style3">
  <?php if ($td_num_rows > 0) {
      foreach ($task_detail as $td):

        $a = strtotime($td->date_spd_end);
        $b = strtotime($td->date_spd_start);

        $j = $a - $b;
        $jml_pjd = floor($j/(60*60*24)+1);
        ?>
  <tr>
    <td height="40"><span class="style3">Melakukan tugas / ijin ke </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo $td->destination ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Dalam rangka  </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo $td->title; ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Kota Tujuan</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo $td->city_to; ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Dari Kota</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo $td->city_from; ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Kendaraan</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo $td->transportation_nm; ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Tanggal</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo dateIndo($td->date_spd_start) ?> s/d <?php echo dateIndo($td->date_spd_end) ?></td>
  </tr>
</table>
<?php endforeach;}?>
<table width="1200" height="128" border="0" class="style3">
<tr><td height="40"></td></tr>
<tr><td>Ketentuan Biaya Perjalan Dinas : </td></tr>
<tr><td height="30"></td></tr>
</table>
<table width="1650" height="128" border="1" class="style3">
  <thead>
    <tr>
      <th width="1%">No</th>
      <th width="7%">NIK</th>
      <th width="15%">Nama</th>
      <th width="8%">Hotel</th>
      <th width="8%">Uang Makan</th>
      <th width="8%">Uang Saku</th>
      <th width="8%">Entertain</th>
      <th width="8%">Taxi</th>
      <th width="8%">Toll</th>
      <th width="8%">BBM</th>
      <th width="8%">Tiket Pesawat</th>
      <th width="8%">Lain-lain</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($biaya_pjd_group->result() as $pjd):?>
    <tr>
    <td height="50"  align="center"><?php echo $i++?></td>
    <td  align="center"><?php echo $pjd->user_id?></td>
    <td>&nbsp;<?php echo get_name($pjd->user_id)?></td>
    <td>Rp. <?php echo  number_format($pjd->hotel*$jml_pjd, 0)?></td>
    <td>Rp. <?php echo  number_format($pjd->uang_makan*$jml_pjd, 0)?></td>
    <td>Rp. <?php echo  number_format($pjd->uang_saku*$jml_pjd, 0)?></td>
    <td>Rp. <?php echo  number_format($pjd->biaya_entertain*$jml_pjd, 0)?></td>
    <td>Rp. <?php echo  number_format($pjd->biaya_taxi*$jml_pjd, 0)?></td>
    <td>Rp. <?php echo  number_format($pjd->biaya_toll*$jml_pjd, 0)?></td>
    <td>Rp. <?php echo  number_format($pjd->biaya_bbm*$jml_pjd, 0)?></td>
    <td>Rp. <?php echo  number_format($pjd->biaya_tiket_pesawat*$jml_pjd, 0)?></td>
    <td>Rp. <?php echo  number_format($pjd->biaya_lain*$jml_pjd, 0)?></td>
    </tr>
    <?php endforeach?>
  </tbody>
</table>

<p>&nbsp;</p>
<?php if ($td_num_rows > 0) {
  foreach ($task_detail as $td):
?>
<div style="float: left; text-align: center; width: 45%;" class="style5">
<p>Yang bersangkutan</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php if ($this->session->userdata('user_id') == $td->task_receiver && $td->is_submit == 0|| get_nik($this->session->userdata('user_id')) == $td->task_receiver && $td->is_submit == 0) { ?>
<p class="">...............................</p>
<?php }elseif ($this->session->userdata('user_id') != $td->task_receiver && $td->is_submit == 0) { ?>
<p class="">...............................</p>
<?php }else{ ?>
<p class="wf-submit">
<span class="semi-bold">
<?php
  for($i=0;$i<sizeof($receiver_submit);$i++):
    echo get_name($receiver_submit[$i]).',';
  endfor;
?>
</span><br/>
<span class="small"><?php echo dateIndo($td->date_submit) ?></span><br/>
</p>
<?php } ?>
</div>

<div style="float: right;text-align: center; width: 45%;" class="style5">
<p>Yang memberi tugas / ijin</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<span class="semi-bold"><?php echo get_name($td->task_creator) ?></span><br/>
<span class="small"><?php echo dateIndo($td->created_on) ?></span><br/>
</div> 
<?php endforeach;} ?>
</body>
</html>
