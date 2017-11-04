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
  <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>"/></p>
  <p align="center" class="style6">Form Pengajuan Rekomendasi Karyawan Keluar</p>
</div>
<?php 
foreach($form_exit->result() as $row):
$approved = assets_url('img/approved_stamp.png');
$rejected = assets_url('img/rejected_stamp.png');
?>
<table width="988" height="135" border="0" align="center" style="padding-left:30px">
  <tr>
    <td width="220" height="30"><span class="style3">No</span></td>
    <td width="10"><div align="center" class="style3">:</div></td>
    <td width="274"><div align="left" class="style3"> </div></td>
    <td height="40"><span class="style3">NIK </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"> </span></td>
    </tr>
  <tr>
    <td width="200"><span class="style3">Jabatan</span></td>
    <td width="10"><div align="center" class="style3">:</div></td>
    <td width="300"><span class="style3"> </span></td>
    <td><span class="style3">Nama Karyawan</span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"> </span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Wilayah </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"> </span></td>
    <td><span class="style3">Tanggal Masuk Kerja </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"> </span></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Status kepegawaian </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"> </span></td>
    
  </tr>
  <tr>
    <td><span class="style3">Tipe Rekomendasi </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"> </span></td>
    <td><span class="style3">Tanggal Keluar </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"> </span></td>
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
    <td>&nbsp; </td>
    <td align="center"> </td>
    <td>&nbsp; </td>
  </tr>
      <?php endforeach;}?>
  </tbody>
</table>
<table width="1000" align="center">
  <tbody>
    <tr>
      <th width="166" height="50"></th>
      <th width="166"></th>
      <th width="166">&nbsp;&nbsp;&nbsp;&nbsp;Mengetahui,</th>
      <th width="166"></th>
      <th width="166"></th>
      <th width="166"></th>
    </tr>
    <tr>
      <td align="center"> <span class="small"></span><br/> </td>
      <td align="center"> <span class="small"></span><br/> </td>
      <td align="center"> <span class="small"></span><br/> </td>
      <td align="center"> <span class="small"></span><br/> </td>
      <td align="center"> <span class="small"></span><br/> </td>
      <td align="center"> <span class="small"></span><br/> </td>
    </tr>
    <tr>
      <td height="80" align="center"> <br/> </td>
      <td align="center"> <br/> </td>
      <td align="center"> <br/> </td>
      <td align="center"><br/> </td>
      <td align="center"><br/> </td>
      <td align="center"><br/> </td>
    </tr>
    <tr >
      <td align="center">GA</td>
      <td align="center">SIE Koperasi</td>
      <td align="center">Perpustakaan</td>
      <td align="center">HRD Database</td>
      <td align="center">IT</td>
      <td align="center">Keuangan</td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>

<table width="1000" align="center">
  <tbody>
    <tr>
      <td align="center">
        <?php if(!empty($row->user_app_akunting) && (get_user_bu($user_nik) != 'BU Jakarta')):?>
           <span class="small"></span><br/> 
        <?php endif ?>
      </td>
      <td align="center">
        <?php if(!empty($row->user_app_audit) && (get_user_bu($user_nik) != 'BU Jakarta')):?>
          < <span class="small"></span><br/> 
        <?php endif ?>
      </td>
      <td align="center">
        <?php if(!empty($row->user_app_keuangan)):?>
           <span class="small"></span><br/> 
        <?php endif ?>
      </td>
      <td align="center">
        <?php if(!empty($row->user_app_asset)):?>
           <span class="small"></span><br/> 
        <?php endif ?>
      </td>
    </tr>
    <tr>
      <td height="80" align="center">
        <?php if(!empty($row->user_app_akunting) && (get_user_bu($user_nik) != 'BU Jakarta')):?>
          <br/> 
        <?php endif ?>
      </td>
      <td align="center">
        <?php if(!empty($row->user_app_audit) && (get_user_bu($user_nik) != 'BU Jakarta')):?>
          <br/> 
        <?php endif ?>
      </td>
      <td align="center">
        <?php if(!empty($row->user_app_keuangan)):?>
          <br/> 
        <?php endif ?>
      </td>
      <td align="center">
        <?php if(!empty($row->user_app_asset)):?>
           <br/> 
           <?php endif ?>
      </td>
    </tr>
    <tr >
      <td align="center">
        <?php if(!empty($row->user_app_akunting) && (get_user_bu($user_nik) != 'BU Jakarta')):?>
          Akunting
        <?php endif ?>  
      </td>
      <td align="center">
        <?php if(!empty($row->user_app_audit) && (get_user_bu($user_nik) != 'BU Jakarta')):?>
          Audit
        <?php endif ?>  
      </td>
      <td align="center">
        <?php if(!empty($row->user_app_keuangan)):?>
          Keuangan
        <?php endif ?>  
      </td>
      <td align="center">
        <?php if(!empty($row->user_app_asset)):?>
          Asset Management
        <?php endif ?>  
      </td>
    </tr>
  </tbody>
</table>

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
      <td align="center"> </td>
    	<td></td>
    	<td></td>
    	<td></td>
    </tr>
    <tr>
      <td height="35" align="center">2</td>
      <td>&nbsp;Diberikan Uang Pengganti Hak</td>
      <td align="center"> </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="35" align="center">3</td>
      <td>&nbsp;Diberikan Uang Jasa</td>
      <td align="center"> </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="35" align="center">4</td>
      <td>&nbsp;Diberikan Surat Keterangan Kerja</td>
      <td align="center"> </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="35" align="center">5</td>
      <td>&nbsp;Diberikan Ijazah Asli Ybs.</td>
      <td align="center"> </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="35" align="center">6</td>
      <td>&nbsp;Diberikan Uang pisah (untuk resign/pengunduran diri)</td>
      <td align="center"> </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>
<?php if(!empty($row->note_mgr)){?>
<p class="style4">Catatan Manager GA Nasional</p>
<textarea class="style4" rows="2" width="100%"> </textarea>
<?php } ?>
<?php if(!empty($row->note_koperasi)){?>
<p class="style4">Catatan Sie Koperasi</p>
<textarea class="style4" rows="2" width="100%"> </textarea>
<?php } ?>
<?php if(!empty($row->note_perpus)){?>
<p class="style4">Catatan Perpustakaan</p>
<textarea class="style4" rows="2" width="100%"> </textarea>
<?php } ?>
<?php if(!empty($row->note_hrd)){?>
<p class="style4">Catatan HRD</p>
<textarea class="style4" rows="2" width="100%"> </textarea>
<?php } ?>
<?php if(!empty($row->note_it)){?>
<p class="style4">Catatan IT</p>
<textarea class="style4" rows="2" width="100%"> </textarea>
<?php } ?>
<?php if(!empty($row->note_lv1)){?>
<p class="style4">Catatan Atasan Langsung</p>
<textarea class="style4" rows="2" width="100%"> </textarea>
<?php } ?>
<?php if(!empty($row->note_lv2)){?>
<p class="style4">Catatan Atasan TIdak Langsung</p>
<textarea class="style4" rows="2" width="100%"> </textarea>
<?php } ?>
<?php if(!empty($row->note_lv3)){?>
<p class="style4">Catatan Atasan Lainnya</p>
<textarea class="style4" rows="2" width="100%"> </textarea>
<?php } ?>
<br />
 <p class="style4">Hubungi sekretariat HRD (021-xxxxxx)</p>
<p>&nbsp;</p>
<table width="1000" align="center">
  <tbody>
    <tr>
      <td width="333" height="10" align="center">Hormat Kami,</td>
      <td width="333" align="center"><?php  echo (!empty($row->user_app_lv1))?'Mengetahui/Menyetujui,':''?></td>
      <td width="333" align="center"><?php  echo (!empty($row->user_app_lv2))?'Mengetahui/Menyetujui,':''?></td>
    </tr>
    <tr>
      <td></td>
      <td align="center"> <span class="small"></span><br/> </td>
      <td align="center"> <span class="small"></span><br/> </td>
    </tr>
    <tr>
      <td align="center"> <br/> </td>
      <td align="center"> <br/> </td>
      <td align="center"> <br/> </td>
    </tr>
    <tr >
      <td align="center">Atasan Langsung</td>
      <td align="center">Atasan tidak langsung</td>
      <td align="center">Atasan lainnya</td>
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
      <td align="center"> <span class="small"></span><br/> </td>
      <td></td>
    <tr>
      <td align="center"></td>
      <td align="center"> <br/> </td>
      <td align="center"></td>
    </tr>
    <tr >
      <td align="center">Atasan lainnya</td>
      <td align="center">Atasan lainnya</td>
      <td align="center">Atasan lainnya</td>
    </tr>
  </tbody>
</table>
<?php }?>

<?php endforeach;?>
</body>
</html>
