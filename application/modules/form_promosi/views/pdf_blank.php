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
<?php foreach($form_promosi as $row):
$user_nik = get_nik($row->user_id);
$pengaju_nik = get_nik($row->created_by);
$approved = assets_url('img/approved_stamp.png');
$rejected = assets_url('img/rejected_stamp.png');
$signed = assets_url('img/signed.png');?>
<div class="style4">
  <div style="float: left; width: 54%;">
  Nomor : <?php echo "$form_id/$bu/$m/$y/$row->id" ?>
  </div>


  <div style="float: right; width: 28%;">
  <?= $location.', '.dateIndo($row->created_on)?>
  </div>

  <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
  Perihal : Pengajuan Promosi Karyawan <?= get_nik($row->user_id).' '.get_name($row->user_id)?><br/><br/>
  Kepada Yth.,<br/>
  Departemen HRD<br/>
  Di Tempat<br/>

  <p>Dengan hormat,</p>
  <p>Sesuai evaluasi kinerja karyawan terlampir, bersama ini kami sampaikan permohonan proses Promosi karyawan atas nama <?= get_name($row->user_id).' ('.get_nik($row->user_id).')' ?> dengan data sebagai berikut:</p>
</div>

  <table width="800" height="128" border-style:solid border="1" class="tg">
    <thead>
      <tr>
        <th width="20%"></th>
        <th width="40%">Baru</th>
        <th width="40%">Lama</th>
      </tr>
      <tr>
        <td><span class="style3">NIK</span></td>
        <td><div align="center"><?= get_nik($row->user_id) ?></div></td>
        <td><span class="style3"></span></td>
      </tr>
      <tr>
        <td><span class="style3">Nama</span></td>
        <td><div align="center"><?= get_name($row->user_id) ?></div></td>
        <td><span class="style3"></span></td>
      </tr>
      <tr>
        <td><span class="style3">Unit Bisnis</span></td>
        <td><span class="style3"><?php echo get_bu_name(substr($row->new_bu,0,2))?></span></td>
        <td><div align="center"><?php echo get_bu_name(substr($row->old_bu,0,2))?></div></td>
      </tr>
      <tr>
        <td><span class="style3">Dept/Bagian</span></td>
        <td><span class="style3"><?php echo get_organization_name($row->new_org)?> </span></td>
        <td><div align="center"><?php echo get_organization_name($row->old_org)?></div></td>
      </tr>
      <tr>
        <td><span class="style3">Jabatan </span></td>
        <td><span class="style3"><?php echo get_position_name($row->new_pos)?></span></td>
        <td><div align="center"><?php echo get_position_name($row->old_pos)?></div></td>
      </tr>
      <tr>
        <td><span class="style3">Tanggal Promosi </span></td>
        <td><div align="center"><?php echo dateIndo($row->date_promosi)?></div></td>
        <td><span class="style3"></span></td>
      </tr>
      <tr>
        <td height="100"><span class="style3">Alasan Promosi</span></td>
        <td colspan="2"><span class="style3"><?php echo $row->alasan?></span></td>
      </tr>
</table>
<div class="style4">
<p>Demikian surat pengajuan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
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
      <td width="200" align="center">&nbsp;</td>
      
      <td width="200" align="center"><span class="small"></span><br/></td>
      
      
      <td width="200" align="center"><span class="small"></span><br/></td>
      
      <td width="200" align="center"><span class="small"></span><br/></td>
    </tr>
    <tr>
      <td height="20" align="center" class="style3">&nbsp;</td>
    
      <td height="20" align="center" class="style3">&nbsp;</td>
    
    
      <td align="center" class="style3">&nbsp;</td>
    
      <td align="center" class="style3">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><br/>(Jabatan)</td>
    
      <td align="center"><br/>(Jabatan)</td>
    
      <td align="center"><br/>(Jabatan)</td>
      
      <td align="center"><br/>(HRD)</td>
    </tr>
  </tbody>
</table>

<?php endforeach;?>
</body>
</html>
