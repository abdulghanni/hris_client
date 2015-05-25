<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title?></title>
<style type="text/css">
<!--
.style3 {
  font-size: 16px;
  font-weight: bold;
}
.style4 {
  font-size: 10px;
}
.style6 {
  color: #000000;
  font-weight: bold;
  font-size: 18px;
}
.style7 {
  padding-left: 20px;
  font-size: 14px;
  font-weight: bold;
}
-->
</style>
</head>

<body>
<div align="center">
  <!-- <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>" width="296" height="80" /></p>-->
  <p align="center" class="style6">Form Pengajuan Rekomendasi Karyawan Keluar</p>
</div>
<?php foreach($form_exit->result() as $row):?>
<table width="988" height="135" border="0" align="center" style="padding-left:30px">
  <tr>
    <td width="220" height="30"><span class="style3">NIK</span></td>
    <td width="10"><div align="center" class="style3">:</div></td>
    <td width="274"><div align="left" class="style3"><?php echo (!empty($user_info))?$user_info['EMPLID']:'-';?></div></td>
    <td height="40"><span class="style3">Nama Karyawan </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo get_name($row->user_id)?> </span></td>
    </tr>
  <tr>
    <td width="200"><span class="style3">Jabatan</span></td>
    <td width="10"><div align="center" class="style3">:</div></td>
    <td width="300"><span class="style3"><?php echo (!empty($user_info))?$user_info['POSITION']:'-';?></span></td>
    <td><span class="style3">Tanggal Mulai Kerja</span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo (!empty($user_info))?dateIndo($user_info['SENIORITYDATE']):'-';?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Wilayah </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo (!empty($user_info))?$user_info['BU']:'-';?></span></td>
    <td><span class="style3">Tanggal Keluar </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo dateIndo($row->date_exit)?> </span></td>
  </tr>
</table>
<p class="style7">Inventaris yang harus diserahkan </p>
<table width="1000" border="1" align="center">
  <tbody>
    <tr>
      <th width="50" height="40" scope="col">No.</th>
      <th width="400" scope="col">Item</th>
      <th width="100" scope="col">Status</th>
      <th width="400" scope="col">Keterangan</th>
    </tr>
    <tr>
      <td height="40" align="center">1</td>
      <td>&nbsp;Baju Seragam</td>
      <td align="center">&nbsp;<?php echo ($row->is_seragam == 1) ? 'Ada' : 'Tidak';?></td>
      <td>&nbsp;<?php echo $row->keterangan_seragam?></td>
    </tr>
    
    <tr>
      <td height="40" align="center">2</td>
      <td>&nbsp;ID Card</td>
      <td align="center">&nbsp;<?php echo ($row->is_id_card == 1) ? 'Ada' : 'Tidak';?></td>
      <td>&nbsp;<?php echo $row->keterangan_id_card?></td>
    </tr>
    <tr>
      <td height="40" align="center">3</td>
      <td>&nbsp;Sepeda Motor / Mobil</td>
      <td align="center">&nbsp;<?php echo ($row->is_kendaraan == 1) ? 'Ada' : 'Tidak';?></td>
      <td>&nbsp;<?php echo $row->keterangan_kendaraan?></td>
    </tr>
    <tr>
      <td height="40" align="center">4</td>
      <td>&nbsp;STNK Motor/Mobil</td>
      <td align="center">&nbsp;<?php echo ($row->is_stnk == 1) ? 'Ada' : 'Tidak';?></td>
      <td>&nbsp;<?php echo $row->keterangan_stnk?></td>
    </tr>
    <tr>
      <td height="40" align="center">5</td>
      <td>&nbsp;Hp/Laptop/Ipad</td>
      <td align="center">&nbsp;<?php echo ($row->is_gadget == 1) ? 'Ada' : 'Tidak';?></td>
      <td>&nbsp;<?php echo $row->keterangan_gadget?></td>
    </tr>
    <tr>
      <td height="40" align="center">6</td>
      <td>&nbsp;Laporan Serah Terima</td>
      <td align="center">&nbsp;<?php echo ($row->is_laporan == 1) ? 'Ada' : 'Tidak';?></td>
      <td>&nbsp;<?php echo $row->keterangan_laporan?></td>
    </tr>
    <tr>
      <td height="40" align="center">7</td>
      <td>&nbsp;Rekonsiliasi Saldo</td>
      <td align="center">&nbsp;<?php echo ($row->is_saldo == 1) ? 'Ada' : 'Tidak';?></td>
      <td>&nbsp;<?php echo $row->keterangan_saldo?></td>
    </tr>
    <tr>
      <td height="40" align="center">8</td>
      <td>&nbsp;Pinjaman Koperasi</td>
      <td align="center">&nbsp;<?php echo ($row->is_pinjaman_koperasi == 1) ? 'Ada' : 'Tidak';?></td>
      <td>&nbsp;<?php echo $row->keterangan_pinjaman_koperasi?></td>
    </tr>
    <tr>
      <td height="40" align="center">9</td>
      <td>&nbsp;Pinjaman Buku Perpustakaan</td>
      <td align="center">&nbsp;<?php echo ($row->is_pinjaman_buku == 1) ? 'Ada' : 'Tidak';?></td>
      <td>&nbsp;<?php echo $row->keterangan_pinjaman_buku?></td>
    </tr>
    <tr>
      <td height="40" align="center">10</td>
      <td>&nbsp;Ikatan Dinas</td>
      <td align="center">&nbsp;<?php echo ($row->is_ikatan == 1) ? 'Ada' : 'Tidak';?></td>
      <td>&nbsp;<?php echo $row->keterangan_ikatan?></td>
    </tr>
  </tbody>
</table>
<table width="1000" align="center">
  <tbody>
    <tr>
      <th width="250" height="20" scope="col"></th>
      <th width="250" scope="col">&nbsp;&nbsp;&nbsp;&nbsp;Mengetahui,</th>
      <th width="250" scope="col"></th>
      <th width="250" scope="col"></th>
    </tr>
    <tr>
      <td height="117" align="center"><?php echo get_name($row->user_app_mgr)?><br/><?php echo dateIndo($row->date_app_mgr)?></td>
      <td align="center"><?php echo get_name($row->user_app_koperasi)?><br/><?php echo dateIndo($row->date_app_koperasi)?></td>
      <td align="center"><?php echo get_name($row->user_app_perpus)?><br/><?php echo dateIndo($row->date_app_perpus)?></td>
      <td align="center"><?php echo get_name($row->user_app_hrd)?><br/><?php echo dateIndo($row->date_app_hrd)?></td>
    </tr>
    <tr >
      <td align="center">Manager GA Nasional</td>
      <td align="center">SIE Koperasi</td>
      <td align="center">Perpustakaan</td>
      <td align="center">HRD Database</td>
    </tr>
  </tbody>
</table>

<p class="style7">Kami rekomendasikan kepada karyawan tersebut </p>
<table width="1000" align="center">
  <tbody>
    <tr>
      <td width="50" height="35" align="center">No.</td>
      <td width="350">Rekomendasi</td>
      <td width="100" align="center">Status</td>
      <td width="50"></td>
      <td width="350"></td>
      <td width="100"></td>
    </tr>
    <tr>
      <td height="35" align="center">1</td>
      <td>&nbsp;Diberikan Uang Pesangon</td>
      <td align="center">&nbsp;<?php echo ($row->is_uang_pesangon == 1) ? 'Ada' : 'Tidak';?></td>
    	<td></td>
    	<td></td>
    	<td></td>
    </tr>
    <tr>
      <td height="35" align="center">2</td>
      <td>&nbsp;Diberikan Uang Pengganti Hak</td>
      <td align="center">&nbsp;<?php echo ($row->is_uang_ganti == 1) ? 'Ada' : 'Tidak';?></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="35" align="center">3</td>
      <td>&nbsp;Diberikan Uang Jasa</td>
      <td align="center">&nbsp;<?php echo ($row->is_uang_jasa == 1) ? 'Ada' : 'Tidak';?></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="35" align="center">4</td>
      <td>&nbsp;Diberikan Surat Keterangan Kerja</td>
      <td align="center">&nbsp;<?php echo ($row->is_sk_kerja == 1) ? 'Ada' : 'Tidak';?></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="35" align="center">5</td>
      <td>&nbsp;Diberikan Ijazah Asli Ybs.</td>
      <td align="center">&nbsp;<?php echo ($row->is_ijazah == 1) ? 'Ada' : 'Tidak';?></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    
  </tbody>
</table>
<?php if(!empty($row->note_app)){?>
<p class="style4">Catatan Khusus</p>
<textarea class="style4" rows="4" width="100%"><?php echo $row->note_app?></textarea>
<?php } ?>
<br />
<table width="1000" align="center">
  <tbody>
    <tr>
      <td width="250" height="10" align="center">Hormat Kami,</td>
      <td width="250"></td>
      <td width="250"></td>
      <td width="250" align="center">Mengetahui/Menyetujui,</td>
    </tr>
    <tr>
      <td height="117" align="center"><?php echo get_name($row->created_by)?><br/><?php echo dateIndo($row->created_on)?></td>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center"><?php echo get_name($row->user_app)?><br/><?php echo dateIndo($row->date_app)?></td>
    </tr>
    <tr >
      <td align="center">Atasan Langsung</td>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center">ASM/Mgr/Kacab/BDM/CoE</td>
    </tr>
  </tbody>
</table>

<?php endforeach;?>
</body>
</html>
