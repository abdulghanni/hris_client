<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $title?></title>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{ height:40px;font-family:Arial, sans-serif;font-size:14px;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{height:40px; font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.style6 {
  color: #000000;
  font-weight: bold;
  font-size: 14px;
}
.approval-img-md{
    height:60px;
    width:120px;
    margin-bottom: 8px;
    z-index:-1;
}
</style>
</head>

<body>
<div align="center">
  <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>"/></p>
  <p align="center" class="style6">Form Permintaan Pelatihan</p>
  <p style="font-size:10px">No :  </p>
</div>
<table class="tg" width="1000" border="1" align="center">
<?php
foreach($form_training_group as $user):
  $peserta = getAll('users_training_group', array('id'=>'where/'.$user->id))->row('user_peserta_id');
  $p = explode(",", $peserta);
  $approved = assets_url('img/approved_stamp.png');
  $rejected = assets_url('img/rejected_stamp.png');
  $signed = assets_url('img/signed.png');?>
  <tbody>
    <tr>
      <th width="44" height="45" scope="col">No.</th>
      <th width="361" scope="col">Keterangan</th>
      <th width="573" scope="col">Rincian</th>
    </tr>
    <tr>
      <td height="45" align="center">1</td>
      <td>&nbsp;Nama Karyawan</td>
      <td>
          <?php for($i=0;$i<sizeof($p);$i++):
            if(sizeof($p)!=1):?>
            <br/>
            <div>&nbsp;
              <input type="checkbox">
                <label> </label>
            </div>

          &nbsp;

          <?php else:?>
            &nbsp; 
          <?php endif;endfor; ?>
      </td>
    </tr>
    <tr>
      <td height="45" align="center">2</td>
      <td>&nbsp;Nama Program Pelatihan</td>
      <td>&nbsp; </td>
    </tr>
    <tr>
      <td height="45" align="center">3</td>
      <td>&nbsp;Tujuan Pelatihan</td>
      <td>&nbsp; </td>
    </tr>
  </tbody>
</table>
<table class="tg" width="1000" border="1" align="center">
  <tbody>
    <tr>
      <th width="333" height="44" scope="col">Diusulkan Oleh</th>
      <th width="333" scope="col">Persetujuan Atasan</th>
      <th width="333" scope="col">Mengetahui HRD</th>
    </tr>
   <tr>
      <td align="center"> <br/><br/><br/><br/><br/> <br/><br/> <br/> </td>
      <td align="center"> <br/><br/><br/><br/><br/> <br/><br/> <br/> </td>
    </tr>
    <?php if(!empty($user->user_app_lv2)):?>
      <tr>
        <th width="333"height="44" scope="col">Persetujuan Atasan Tidak Langsung</th>
        <?php if(!empty($user->user_app_lv3)):?><th scope="col">Persetujuan Atasan Lainnya</th><?php endif ?>
      </tr>
      <tr>
        <td align="center"> <br/><br/><br/><br/><br/> <br/><br/> <br/> </td>
        <?php if(!empty($user->user_app_lv3)):?><td align="center"> <br/><br/><br/><br/><br/> <br/><br/> <br/> </td><?php endif ?>
      </tr>
    <?php endif ?>
  </tbody>
</table>
<table class="tg" width="1001" height="43" border="" align="center">
  <tbody>
    <tr>
      <th scope="col">Bagian ini diisi oleh HRD</th>
    </tr>
  </tbody>
</table>
<table class="tg" width="1000" border="1" align="center">
  <tbody>
  <tr>
      <td height="45" width="39" align="center">4</td>
      <td width="361">&nbsp;Tipe Pelatihan</td>
      <td width="573">&nbsp; </td>
    </tr>
    <tr>
      <td height="45" width="39" align="center">5</td>
      <td width="361">&nbsp;Penyelenggara</td>
      <td width="573">&nbsp; </td>
    </tr>
    <tr>
      <td height="45" align="center">6</td>
      <td>&nbsp;Pembiayaan</td>
      <td>&nbsp; </td>
    </tr>
    <tr>
      <td height="45" align="center">7</td>
      <td>&nbsp;Tipe Ikatan Dinas</td>
      <td>&nbsp; </td>
    </tr>
    <tr>
      <td height="45" align="center">8</td>
      <td>&nbsp;Periode Ikatan Dinas</td>
      <td>&nbsp; </td>
    </tr>
    <tr>
      <td height="45" align="center">9</td>
      <td>&nbsp;Besar Biaya</td>
      <td>&nbsp;Rp.&nbsp;</td>
    </tr>
    <tr>
      <td height="45" align="center">10</td>
      <td>&nbsp;Nama Narasumber</td>
      <td>&nbsp; </td>
    </tr>
    <tr>
      <td height="45" align="center">11</td>
      <td>&nbsp;Nama Vendor</td>
      <td>&nbsp; </td>
    </tr>
    <tr>
      <td height="45" align="center">12</td>
      <td>&nbsp;Tempat Pelaksanaan :&nbsp;&nbsp;  </td>
      <td>&nbsp;Tanggal & Jam Pelaksanaan :&nbsp;&nbsp; s/d  &nbsp;&nbsp; s/d  </td>
    </tr>
    <tr>
      <td height="45" align="center">13</td>
      <td>&nbsp;Lama Pelaksanaan</td>
      <td>&nbsp; Bulan  Hari </td>
    </tr>
  </tbody>
<?php endforeach;?>
</table>
<p>&nbsp;</p>
</body>
</html>
