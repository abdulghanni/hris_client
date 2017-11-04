<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title?></title>
<style type="text/css">
<!--
tbody td{
  border-collapse:collapse;border-spacing:0; height:40px;font-family:Arial, sans-serif;font-size:14px;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;
}

th{
  border-collapse:collapse;border-spacing:0; height:40px;font-family:Arial, sans-serif;font-size:14px;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;
}
.style3 {
  font-size: 14px;
}
.style4 {
  font-size: 20px;
  font-weight: bold;
}

.style5 {
  font-size: 14px;
  font-weight: bold;
  text-align: center;
}

.style6 {
  font-weight: bold;
  font-size: 18px;
}
.style7 {
  padding-left: 20px;
  font-size: 17px;
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
  <p align="center" class="style6">REKAPITULASI RAWAT JALAN</p>
  <p style="font-size:10px;">No :  </p>
</div>
<table width="1200" height="128" border="0" class="style4">
<tr><td height="20"></td></tr>
<tr><td>Bagian :  </td></tr>
<tr><td height="30"></td></tr>
</table>

<table width="1000" height="128" class="style3">
  <thead>
    <tr>
      <th width="7%">NIK</th>
      <th width="25%">Nama</th>
      <th width="25%">Nama Pasien</th>
      <th width="15%">Hubungan</th>
      <th width="13%">Jenis Pemeriksaan</th>
      <th width="12%">Rupiah</th>
      <?php echo (!empty($detail_hrd)) ? '<th width="10%">Disetujui</th>' : '' ?>
    </tr>
  </thead>
  <tbody>
	<?php 
	  if(!empty($detail_hrd)){
      $colspan = 5;
	     $total = $detail_hrd[0]['rupiah'];
	      for($i=0;$i<sizeof($detail_hrd);$i++):
	      $is_approve = ($detail_hrd[$i]['is_approve'] == 1) ? 'Ya':'Tidak';
        $approved = assets_url('img/approved_stamp.png');
	      ?>
	  <tr>
	    <td> </td>
	    <td> </td>
	    <td> </td>
	    <td> </td>
	    <td> </td>
	    <td>Rp. </td>
	    <td align="center"> </td>
	  </tr>
	    <?php $total = $total_medical_hrd;
	    endfor;}else{
        $colspan = 4;
        $total = $detail[0]['rupiah'];
                             $approved = assets_url('img/approved_stamp.png');
                             $rejected = assets_url('img/rejected_stamp.png');
                            $pending = assets_url('img/pending_stamp.png');
                              for($i=0;$i<sizeof($detail);$i++):
                              ?>
                          <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td align="right">Rp. </td>
                          </tr>
      <?php
        if(sizeof($detail)>1 && isset($detail[$i+1])){
        $total = $total + $detail[$i+1]['rupiah'];
        }
        endfor;}
	    ?>
	    <tr>
	    <td align="right" colspan="<?=$colspan?>">Total : </td><td align="right" colspan="2">Rp. </td>
	   </tr>
	</tbody>
</table>
<p>&nbsp;</p>
<?php foreach ($form_medical as $row):?>
<table width="1000" align="center">
    <tr>
      <td width="333" height="10" align="center" class="style3">Hormat Kami,</td>
      <td width="333" align="center" class="style3">Menyetujui,</td>
      <td width="333" align="center" class="style3">Mengetahui</td>
    </tr>
    <tr>
      <td align="center" class="style3"><br/></td>
      <td align="center"><br/></td>
      <td align="center"><br/></td>
    </tr>
    <tr>
      <td align="center" class="style3"><br/>Pengaju</td>
      <td align="center" class="style3"><br/>HRD</td>
      <td align="center" class="style3"><br/>Atasan Langsung</td>
    </tr>
</table>
<?php if(!empty($row->user_app_lv2)):?>
<table width="1000" align="center">
    <tr>
      <td width="500" align="center" class="style3">Mengetahui</td>
      <?php if(!empty($row->user_app_lv3)){?>
      <td width="500" align="center" class="style3">Mengetahuie</td>
      <?php } ?>
    </tr>
    <tr>
      <td align="center"><span class="small"></span><br/>Jabatan 2</td>
      
      <td align="center"> <span class="small"></span><br/> </td>
      
    </tr>
    <tr>
      <td height="100" align="center" class="style3"> <br/><br/> <br/> </td>
       
      <td align="center" class="style3"> <br/><br/> <br/>Jabatan 3</td>
      
    </tr>
</table>
<?php endif; ?>
<?php endforeach?>
</body>
</html>
