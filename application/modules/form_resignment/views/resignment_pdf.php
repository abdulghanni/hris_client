<<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title?></title>
<style type="text/css">
<!--
.style3{
  font-size: 16px;
  font-weight: bold;
}
.style4{
  font-size: 10px;
}
.style6{
  color: #000000;
  font-weight: bold;
  font-size: 18px;
}
.style7{
  padding-left: 20px;
  font-size: 12px;
  font-weight: bold;
}

.style8{
  font-size: 11px;
}
.style9{
  padding-left: 20px;
  font-size: 11px;
}
-->
</style>
</head>

<body>
<div align="center">
  <!-- <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>" width="296" height="80" /></p>-->
  <p align="center" class="style6">Form Pengajuan Karyawan Keluar</p>
</div>
<?php foreach($form_resignment->result() as $row):?>
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
    <td><span class="style3">Tanggal Akhir Kerja </span></td>
    <td><div align="center" class="style3">:</div></td>
    <td><span class="style3"><?php echo dateIndo($row->date_resign)?> </span></td>
  </tr>
</table>
<p class="style7">Alasan Berhenti Kerja </p>
<div class="style8">
<div class="row form-row">
                      <div class="col-md-12">
                      <div class="checkbox check-primary checkbox-circle" >
                        <?php 
                        if($alasan->num_rows()>0){
                          foreach($alasan->result() as $alasan):?>
                          <input name="alasan[]" class="checkbox1" type="checkbox" id="alasan<?php echo $alasan->id ?>" value="<?php echo $alasan->id ?>" checked="checked" disabled="disabled">
                            <label for="alasan<?php echo $alasan->id ?>"><?php echo $alasan->title?></label>
                        <?php endforeach;} ?>

                      </div>
                      </div>
                      </div>
                    </div>
</div>

<div class="style9">
<p>1.&nbsp;Apa alasan utama berhenti bekerja dari perusahaan ini? Jelaskan</p>
&nbsp;&nbsp;&nbsp;&nbsp;<textarea rows="3" name="desc_resign" width="95%"><?php echo $row->desc_resign?></textarea>
<p>2.&nbsp;Adakah prosedur perusahaan yang membuat anda tidak nyaman atau tidak bisa maksimum menjalankan tugasnya?</p>
&nbsp;&nbsp;&nbsp;&nbsp;<textarea rows="3" name="desc_resign" width="95%"><?php echo $row->procedure_resign?></textarea>
<p>3.&nbsp;Adakah hal yang memuaskan dari pekerjaan anda sekarang?</p>
&nbsp;&nbsp;&nbsp;&nbsp;<textarea rows="3" name="desc_resign" width="95%"><?php echo $row->kepuasan_resign?></textarea>
<p>4.&nbsp;Adakah saran untuk kami?</p>
&nbsp;&nbsp;&nbsp;&nbsp;<textarea rows="3" name="desc_resign" width="95%"><?php echo $row->saran_resign?></textarea>
<p>5.&nbsp;Apakah anda mempertimbangkan di masa datang untuk kembali bekerja di perusahaan ini?</p>
&nbsp;&nbsp;&nbsp;&nbsp;<textarea rows="3" name="desc_resign" width="95%"><?php echo $row->rework_resign?></textarea>

<p>&nbsp;&nbsp;&nbsp;Catatan Pewawancara</p>
&nbsp;&nbsp;&nbsp;&nbsp;<textarea rows="3" name="desc_resign" width="95%"><?php echo $row->note_hrd?></textarea>

</div>

<br />
<table width="1000" align="center">
  <tbody>
    <tr>
      <td width="250" height="10" align="center">Karyawan Ybs,</td>
      <td width="250"></td>
      <td width="250"></td>
      <td width="250" align="center">Pewawancara,</td>
    </tr>
    <tr>
      <td height="117" align="center"><?php echo get_name($row->user_id)?><br/><?php echo dateIndo($row->created_on)?></td>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center"><?php echo get_name($row->user_app)?><br/><?php echo dateIndo($row->date_app)?></td>
    </tr>
  </tbody>
</table>

<?php endforeach;?>
</body>
</html>
