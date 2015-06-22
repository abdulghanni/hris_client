<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $title?></title>
</head>

<body>
<h2 style="text-align:center">Form Permintaan Pelatihan</h2>
<p>&nbsp;</p>
<table width="1000" border="1" align="center">
<?php
foreach($form_training_group->result() as $user):?>
  <tbody>
    <tr>
      <th width="44" height="45" scope="col">No.</th>
      <th width="361" scope="col">Keterangan</th>
      <th width="573" scope="col">Rincian</th>
    </tr>
    <tr>
      <td height="45" align="center">1</td>
      <td>&nbsp;NIK</td>
      <td>&nbsp;<?php echo (!empty($user_info))?$user_info['EMPLID']:'-';?></td>
    </tr>
    <tr>
      <td height="45" align="center">2</td>
      <td>&nbsp;Nama Karyawan</td>
      <td>&nbsp;<?php echo $user->name?></td>
    </tr>
    <tr>
      <td height="45" align="center">3</td>
      <td>&nbsp;Jabatan</td>
      <td>&nbsp;<?php echo (!empty($user_info))?$user_info['POSITION']:'-';?></td>
    </tr>
    <tr>
      <td height="45" align="center">4</td>
      <td>&nbsp;Dept/Bagian</td>
      <td>&nbsp;<?php echo (!empty($user_info))?$user_info['ORGANIZATION']:'-';?></td>
    </tr>
    <tr>
      <td height="45" align="center">5</td>
      <td>&nbsp;Nama Program Pelatihan</td>
      <td>&nbsp;<?php echo $user->training_name?></td>
    </tr>
    <tr>
      <td height="45" align="center">6</td>
      <td>&nbsp;Tujuan Pelatihan</td>
      <td>&nbsp;<?php echo $user->tujuan_training?></td>
    </tr>
  </tbody>
</table>
<table width="1000" border="1" align="center">
  <tbody>
    <tr>
      <th width="333" height="44" scope="col">Diusulkan Oleh</th>
      <th width="333" scope="col">Persetujuan Atasan</th>
      <th width="333" scope="col">Mengetahui HRD</th>
    </tr>
    <tr>
      <td height="117" align="center"><br/><br/><br/><br/><br/><?php echo $user->name?><br/><?php echo dateIndo($user->created_on)?></td>
      <td align="center"><br/><br/><br/><br/><br/><?php echo get_name($user->user_app_lv1)?><br/><?php echo dateIndo($user->date_app_lv1)?></td>
      <td align="center"><br/><br/><br/><br/><br/><?php echo get_name($user->user_app_lv2)?><br/><?php echo dateIndo($user->date_app_lv2)?></td>
    </tr>
  </tbody>
</table>
<table width="1001" height="43" border="" align="center">
  <tbody>
    <tr>
      <th scope="col">Bagian ini diisi oleh HRD</th>
    </tr>
  </tbody>
</table>
<table width="1000" border="1" align="center">
  <tbody>
  <tr>
      <td height="45" width="39" align="center">7</td>
      <td width="361">&nbsp;Tipe Pelatihan</td>
      <td width="573">&nbsp;<?php echo $user->training_type?></td>
    </tr>
    <tr>
      <td height="45" width="39" align="center">7</td>
      <td width="361">&nbsp;Penyelenggara</td>
      <td width="573">&nbsp;<?php echo $user->penyelenggara?></td>
    </tr>
    <tr>
      <td height="45" align="center">8</td>
      <td>&nbsp;Pembiayaan</td>
      <td>&nbsp;<?php echo $user->pembiayaan?></td>
    </tr>
    <tr>
      <td height="45" align="center">9</td>
      <td>&nbsp;Besar Biaya</td>
      <td>&nbsp;Rp.&nbsp;<?php echo $user->besar_biaya?></td>
    </tr>
    <tr>
      <td height="45" align="center">10</td>
      <td>&nbsp;Nama Narasumber</td>
      <td>&nbsp;<?php echo $user->narasumber?></td>
    </tr>
    <tr>
      <td height="45" align="center">11</td>
      <td>&nbsp;Nama Vendor</td>
      <td>&nbsp;<?php echo $user->vendor?></td>
    </tr>
    <tr>
      <td height="45" align="center">12</td>
      <td>&nbsp;Tempat Pelaksanaan :&nbsp;&nbsp; <?php echo $user->tempat?></td>
      <td>&nbsp;Tanggal & Jam Pelaksaan :&nbsp;&nbsp;<?php echo dateIndo($user->tanggal_mulai)?> s/d <?php echo dateIndo($user->tanggal_akhir)?>&nbsp;&nbsp;<?php echo $user->jam_mulai?> s/d <?php echo $user->jam_akhir?> </td>
    </tr>
    <tr>
      <td height="45" align="center">13</td>
      <td>&nbsp;Lama Pelaksanaan</td>
      <td>&nbsp;<?php echo $user->lama_training_bulan.' Bulan'.' '.$user->lama_training_hari.' Hari'?></td>
    </tr>
  </tbody>
<?php endforeach;?>
</table>
<p>&nbsp;</p>
</body>
</html>
