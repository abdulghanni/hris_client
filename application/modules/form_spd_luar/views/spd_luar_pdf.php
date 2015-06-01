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
  <p align="center" class="style6">Form Surat Tugas / Ijin </p>
</div>
<?php
	if ($tc_num_rows > 0) {
	foreach ($task_creator as $tc) :
?>
<table width="988" height="128" border="0" style="padding-left:30px;" class="style3">
<tr class="style4"><td>Yang bertanda tangan dibawah ini : </td></tr>
<tr><td height="30"></td></tr>
  <tr>
    <td width="275" height="40"><span class="style3">Nama</span></td>
    <td width="10" height="40"><div align="center">:</div></td>
    <td width="440" height="40"><?php echo $tc->user_name ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Bagian / Dept </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo (!empty($user_info))?$user_info['ORGANIZATION']:'-';?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Jabatan</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo (!empty($user_info))?$user_info['POSITION']:'-';?></td>
  </tr>
<?php endforeach; 
}
?> 

<tr><td height="40"></td></tr>
<tr class="style4"><td>Memberi tugas / ijin kepada : </td></tr>
<tr><td height="30"></td></tr>
  <tr>
    <td width="275" height="40"><span class="style3">Nama</span></td>
    <td width="10" height="40"><div align="center">:</div></td>
    <td width="440" height="40"><?php echo $task_receiver_nm ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Bagian / Dept </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo $task_receiver_org ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Jabatan</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo $task_receiver_pos ?></td>
  </tr>
  <?php if ($td_num_rows > 0) {
      foreach ($task_detail as $td) { 

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

<h5 align="center"><span class="semi-bold">Ketentuan Biaya Perjalanan Dinas</span></h5>
                          <table width="988" height="128" border="1" class="style3">
                            <thead>
                              <tr>
                                <th>Golongan</th>
                                <th>Hotel</th>
                                <th>Uang Makan</th>
                                <th>Uang Saku</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><?php echo $biaya_pjd['grade']?></td>
                                <td>Rp. <?php echo $biaya_pjd['hotel']*$jml_pjd?></td>
                                <td>Rp. <?php echo $biaya_pjd['uang_makan']*$jml_pjd?></td>
                                <td>Rp. <?php echo $biaya_pjd['uang_saku']*$jml_pjd?></td>
                              </tr>
                            </tbody>
                          </table>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<div style="float: left; text-align: center; width: 50%;" class="style5">
<p>Yang bersangkutan</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php if ($this->session->userdata('user_id') == $td->task_receiver && $td->is_submit == 0|| get_nik($this->session->userdata('user_id')) == $td->task_receiver && $td->is_submit == 0) { ?>
<p class="">...............................</p>
<?php }elseif ($this->session->userdata('user_id') != $td->task_receiver && $td->is_submit == 0) { ?>
<p class="">...............................</p>
<?php }else{ ?>
<p class="wf-submit">
<span class="semi-bold"><?php echo get_name($td->task_receiver) ?></span><br/>
<span class="small"><?php echo dateIndo($td->date_submit) ?></span><br/>
</p>
<?php } ?>
</div>

<div style="float: right;text-align: center; width: 50%;" class="style5">
<p>Yang memberi tugas / ijin</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<span class="semi-bold"><?php echo get_name($td->task_creator) ?></span><br/>
<span class="small"><?php echo dateIndo($td->created_on) ?></span><br/>
</div> 
<?php  }
} ?>

<div style="clear: both; margin: 0pt; padding: 0pt; "></div>
<p>&nbsp;</p>
</body>
</html>
