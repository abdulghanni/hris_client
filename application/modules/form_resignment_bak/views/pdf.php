<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title?></title>
<style type="text/css">
<!--

.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{ height:40px;font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;font-size:14px;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{height:40px; font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;font-size:14px;font-weight:normal;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}


.style3 {
  font-size: 16px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}
.style4 {
  font-size: 12px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}
.style6 {
  color: #000000;
  font-weight: bold;
  font-size: 20px;
}
.style7 {
  padding-left: 20px;
  font-size: 16px;
  font-weight: bold;
}

.approval-img-md{
    height:60px;
    width:105px;
    margin-bottom: 8px;
    z-index:-1;
}
-->
</style>
</head>

<body>
<div align="center">
  <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>"/></p>
</div> 
<?php foreach($form_resignment as $row):
$user_nik = get_nik($row->user_id);
$pengaju_nik = get_nik($row->created_by);
$approved = assets_url('img/approved_stamp.png');
$rejected = assets_url('img/rejected_stamp.png');?>
<div class="style4" style="padding-top: 50px;">
  <div style="float: left; width: 54%;">
  Nomor :  
  </div>


  <div style="float: right; width: 28%;">
  Lokasi, 
  </div>

  <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
  Perihal : Pengajuan Pengunduran Diri Karyawan  <br/><br/>
  Kepada Yth.,<br/>
  Departemen HRD<br/>
  Di Tempat<br/>

  <p>Dengan hormat,</p>
  <p>Bersama ini saya yang bertandatangan dibawah ini dengan data sebagai berikut: </p>
</div>

  <table width="800" height="128" border-style:solid border="1" class="tg">
      <tr>
        <td><span class="style3">NIK</span></td>
        <td><div align="center"> </div></td>
      </tr>
      <tr>
        <td><span class="style3">Nama</span></td>
        <td><div align="center"> </div></td>
      </tr>
      <tr>
        <td><span class="style3">Unit Bisnis</span></td>
        <td><span class="style3"> </span></td>
      </tr>
      <tr>
        <td><span class="style3">Dept/Bagian</span></td>
        <td><span class="style3"> </span></td>
      </tr>
      <tr>
        <td><span class="style3">Jabatan </span></td>
        <td><span class="style3"> </span></td>
      </tr>
      <tr>
        <td><span class="style3">Golongan </span></td>
        <td><span class="style3"> </span></td>
      </tr>
      <tr>
        <td><span class="style3">Tanggal Mulai Bekerja </span></td>
        <td><div align="center"> </div></td>
      </tr>
      <tr>
        <td><span class="style3">Nama Pewawancara </span></td>
        <td><div align="center"> </div></td>
      </tr>
      <tr>
        <td><span class="style3">Tanggal Wawancara </span></td>
        <td><div align="center"> </div></td>
      </tr>
      <?php if(strlen($row->note_lv1) > 0) { ?>
      <tr>
        <td><span class="style3">Note (atasan langsung)</span></td>
        <td><div align="center"> </div></td>
      </tr>
      <?php } ?>
      <?php if(strlen($row->note_lv2) > 0) { ?>
      <tr>
        <td><span class="style3">Note (Atasan tidak langsung)</span></td>
        <td><div align="center"> </div></td>
      </tr>
      <?php } ?>
      <?php if(strlen($row->note_lv3) > 0) { ?>
      <tr>
        <td><span class="style3">Note (Atasan lainnya)</span></td>
        <td><div align="center"> </div></td>
      </tr>
      <?php } ?>
</table>
<div class="style4">
<p>Terhitung tanggal   mengajukan pengunduran diri dengan alasan  , 
Demikian surat pengunduran diri ini saya sampaikan, atas perhatian dan kerjasamanya saya ucapkan terima kasih.
</p>
</div>
<table width="800" align="center">
  <tbody>
    <tr>
      <th width="200" height="50">Diajukan Oleh,</th>
      <th width="200"></th>
      <th width="200">&nbsp;&nbsp;Mengetahui</th>
      <th width="200"></th>
    </tr>
    <tr>
      <td width="200" align="center"></td>
      <?php if(!empty($row->user_app_lv1)){?>
      <td width="200" align="center"> <span class="small"></span><br/> </td>
      <?php }?>
      <?php if(!empty($row->user_app_lv2)){?>
      <td width="200" align="center"> <span class="small"></span><br/> </td>
      <?php }?>
      <td width="200" align="center"> <span class="small"></span><br/> </td>
    </tr>
    <tr>
      <td height="20" align="center" class="style3"> </td>
    <?php if(!empty($row->user_app_lv1)){?>
      <td height="20" align="center" class="style3"> </td>
    <?php }?>
    <?php if(!empty($row->user_app_lv2)){?>
      <td align="center" class="style3"> </td>
    <?php }?>
      <td align="center" class="style3"> </td>
    </tr>
    <tr>
      <td align="center"> <br/>Jabatan</td>
    <?php if(!empty($row->user_app_lv1)){?>
      <td align="center"><br/>Jabatan atasan langsung</td>
    <?php }?>
    <?php if(!empty($row->user_app_lv2)){?>
      <td align="center"><br/>Jabatan atasan tidak langsung</td>
      <?php }?>
      <td align="center"><br/>(HRD)</td>
    </tr>
  </tbody>
</table>
<br />
<?php if(!empty($row->user_app_lv3)){?>
<table width="800" align="center">
  <tbody>
    <tr>
      <td width="275" align="center"></td>
      <td width="275" align="center"> <span class="small"></span><br/> </td>
      <td width="275" align="center"></td>
    </tr>
    <tr>
      <td height="20" align="center" class="style3"></td>
      <td align="center" class="style3"> </td>
      <td align="center" class="style3"></td>
    </tr>
    <tr>
    <?php if(!empty($row->user_app_lv3)){?>
      <td></td>
      <td align="center"> <br/>Jabatan atasan lainnya</td>
      <?php }?>
      <td align="center"></td>
    </tr>
  </tbody>
</table>
<?php }?>

<?php endforeach;?>
</body>
</html>
