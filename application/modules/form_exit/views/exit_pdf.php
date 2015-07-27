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
  <!-- <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>" width="296" height="80" /></p>-->
  <p align="center" class="style6">Form Pengajuan Rekomendasi Karyawan Keluar</p>
</div>
<?php foreach($form_exit->result() as $row):
$approved = assets_url('img/approved_stamp.png');
$rejected = assets_url('img/rejected_stamp.png');?>
<table width="988" height="135" border="0" align="center" style="padding-left:30px">
  <tr>
    <td width="220" height="30"><span class="style3">NIK</span></td>
    <td width="10"><div align="center" class="style3">:</div></td>
    <td width="274"><div align="left" class="style3"><?php echo $user_nik?></div></td>
    <td height="40"><span class="style3">Nama Karyawan </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo get_name($row->user_id)?> </span></td>
    </tr>
  <tr>
    <td width="200"><span class="style3">Jabatan</span></td>
    <td width="10"><div align="center" class="style3">:</div></td>
    <td width="300"><span class="style3"><?php echo get_user_position($user_nik)?></span></td>
    <td><span class="style3">Tanggal Mulai Kerja</span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo dateIndo(get_user_sen_date($user_nik))?></span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Wilayah </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo get_user_bu($user_nik)?></span></td>
    <td><span class="style3">Tanggal Keluar </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo dateIndo($row->date_exit)?> </span></td>
  </tr>
  <tr>
    <td><span class="style3">Tipe Rekomendasi </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo $row->exit_type?> </span></td>
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
    <?php 
    $i=0;
    if($users_inventory->num_rows()>0){
      foreach ($users_inventory->result() as $inv) :
        $radio_label = ($inv->is_available==1)?'Ada':'Tidak';
        ?>
  <tr>
    <td>&nbsp;<?php echo 1+$i++?></td>
    <td>&nbsp;<?php echo $inv->title?></td>
    <td align="center"><?php echo $radio_label?></td>
    <td>&nbsp;<?php echo $inv->note?></td>
  </tr>
      <?php endforeach;}?>
  </tbody>
</table>
<table width="1000" align="center">
  <tbody>
    <tr>
      <th width="200" height="50"></th>
      <th width="200">&nbsp;&nbsp;&nbsp;&nbsp;Mengetahui,</th>
      <th width="200"></th>
      <th width="200"></th>
      <th width="200"></th>
    </tr>
    <tr>
      <td align="center"><?php echo ($row->app_status_id_mgr == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_mgr == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <td align="center"><?php echo ($row->app_status_id_koperasi == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_koperasi == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <td align="center"><?php echo ($row->app_status_id_perpus == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_perpus == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <td align="center"><?php echo ($row->app_status_id_hrd == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_hrd == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <td align="center"><?php echo ($row->app_status_id_it == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_it == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
    </tr>
    <tr>
      <td height="80" align="center"><?php echo get_name($row->user_app_mgr)?><br/><?php echo dateIndo($row->date_app_mgr)?></td>
      <td align="center"><?php echo get_name($row->user_app_koperasi)?><br/><?php echo dateIndo($row->date_app_koperasi)?></td>
      <td align="center"><?php echo get_name($row->user_app_perpus)?><br/><?php echo dateIndo($row->date_app_perpus)?></td>
      <td align="center"><?php echo get_name($row->user_app_hrd)?><br/><?php echo dateIndo($row->date_app_hrd)?></td>
      <td align="center"><?php echo get_name($row->user_app_it)?><br/><?php echo dateIndo($row->date_app_it)?></td>
    </tr>
    <tr >
      <td align="center">Manager GA Nasional</td>
      <td align="center">SIE Koperasi</td>
      <td align="center">Perpustakaan</td>
      <td align="center">HRD Database</td>
      <td align="center">IT</td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
<?php if(!empty($row->user_app_asset)):?>
<table width="1000" align="center">
  <tbody>
    <tr>
      <td></td>
      <td></td>
      <td align="center"><?php echo ($row->app_status_id_asset == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_asset == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="80" align="center"></td>
      <td align="center"></td>
      <td align="center"><?php echo get_name($row->user_app_asset)?><br/><?php echo dateIndo($row->date_app_asset)?></td>
      <td align="center"></td>
      <td align="center"></td>
    </tr>
    <tr >
      <td align="center"></td>
      <td align="center"></td>
      <td align="center">Asset Management</td>
      <td align="center"></td>
      <td align="center"></td>
    </tr>
  </tbody>
</table>
<?php endif ?>
<pagebreak>
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
      <td align="center">&nbsp;<?php echo ($row->is_uang_pesangon == 1) ? 'Ya' : 'Tidak';?></td>
    	<td></td>
    	<td></td>
    	<td></td>
    </tr>
    <tr>
      <td height="35" align="center">2</td>
      <td>&nbsp;Diberikan Uang Pengganti Hak</td>
      <td align="center">&nbsp;<?php echo ($row->is_uang_ganti == 1) ? 'Ya' : 'Tidak';?></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="35" align="center">3</td>
      <td>&nbsp;Diberikan Uang Jasa</td>
      <td align="center">&nbsp;<?php echo ($row->is_uang_jasa == 1) ? 'Ya' : 'Tidak';?></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="35" align="center">3</td>
      <td>&nbsp;Diberikan Uang pisah</td>
      <td align="center">&nbsp;<?php echo ($row->is_uang_pisah == 1) ? 'Ya' : 'Tidak';?></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="35" align="center">4</td>
      <td>&nbsp;Diberikan Surat Keterangan Kerja</td>
      <td align="center">&nbsp;<?php echo ($row->is_sk_kerja == 1) ? 'Ya' : 'Tidak';?></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="35" align="center">5</td>
      <td>&nbsp;Diberikan Ijazah Asli Ybs.</td>
      <td align="center">&nbsp;<?php echo ($row->is_ijazah == 1) ? 'Ya' : 'Tidak';?></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    
  </tbody>
</table>
<?php if(!empty($row->note_mgr)){?>
<p class="style4">Catatan Manager GA Nasional</p>
<textarea class="style4" rows="4" width="100%"><?php echo $row->note_mgr?></textarea>
<?php } ?>
<?php if(!empty($row->note_koperasi)){?>
<p class="style4">Catatan Sie Koperasi</p>
<textarea class="style4" rows="4" width="100%"><?php echo $row->note_koperasi?></textarea>
<?php } ?>
<?php if(!empty($row->note_perpus)){?>
<p class="style4">Catatan Perpustakaan</p>
<textarea class="style4" rows="4" width="100%"><?php echo $row->note_perpus?></textarea>
<?php } ?>
<?php if(!empty($row->note_hrd)){?>
<p class="style4">Catatan HRD</p>
<textarea class="style4" rows="4" width="100%"><?php echo $row->note_hrd?></textarea>
<?php } ?>
<?php if(!empty($row->note_it)){?>
<p class="style4">Catatan IT</p>
<textarea class="style4" rows="4" width="100%"><?php echo $row->note_it?></textarea>
<?php } ?>
<?php if(!empty($row->note_lv1)){?>
<p class="style4">Catatan Supervisor</p>
<textarea class="style4" rows="4" width="100%"><?php echo $row->note_lv1?></textarea>
<?php } ?>
<?php if(!empty($row->note_lv2)){?>
<p class="style4">Catatan Ka. Bagian</p>
<textarea class="style4" rows="4" width="100%"><?php echo $row->note_lv2?></textarea>
<?php } ?>
<?php if(!empty($row->note_lv3)){?>
<p class="style4">Catatan Atasan Lainnya</p>
<textarea class="style4" rows="4" width="100%"><?php echo $row->note_lv3?></textarea>
<?php } ?>
<br />
<p>&nbsp;</p>
<table width="1000" align="center">
  <tbody>
    <tr>
      <td width="333" height="10" align="center">Hormat Kami,</td>
      <td width="333" align="center">Mengetahui/Menyetujui,</td>
      <td width="333" align="center">Mengetahui/Menyetujui,</td>
    </tr>
    <tr>
      <td></td>
      <td align="center"><?php echo ($row->app_status_id_lv1 == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_lv1 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <td align="center"><?php echo ($row->app_status_id_lv2 == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_lv2 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
    </tr>
    <tr>
      <td align="center"><?php echo get_name($row->created_by)?><br/><?php echo dateIndo($row->created_on)?></td>
      <td align="center"><?php echo get_name($row->user_app_lv1)?><br/><?php echo dateIndo($row->date_app_lv1)?></td>
      <td align="center"><?php echo get_name($row->user_app_lv2)?><br/><?php echo dateIndo($row->date_app_lv2)?></td>
    </tr>
    <tr >
      <td align="center">Atasan Langsung</td>
      <td align="center"><?php echo get_user_position($row->user_app_lv1);?></td>
      <td align="center"><?php echo get_user_position($row->user_app_lv2);?></td>
    </tr>
  </tbody>
</table>
<br />
<p>&nbsp;</p>
<?php if(!empty($row->user_app_lv3)){?>
<table width="1000" align="center">
  <tbody>
    <tr>
      <td width="333" height="10" align="center"></td>
      <td width="333" align="center">Mengetahui/Menyetujui,</td>
      <td width="333" align="center"></td>
    </tr>
    <tr>
      <td></td>
      <td align="center"><?php echo ($row->app_status_id_lv3 == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_lv3 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <td></td>
    <tr>
      <td align="center"></td>
      <td align="center"><?php echo get_name($row->user_app_lv3)?><br/><?php echo dateIndo($row->date_app_lv3)?></td>
      <td align="center"></td>
    </tr>
    <tr >
      <td align="center"></td>
      <td align="center"><?php echo get_user_position($row->user_app_lv3);?></td>
      <td align="center"></td>
    </tr>
  </tbody>
</table>
<?php }?>

<?php endforeach;?>
</body>
</html>
