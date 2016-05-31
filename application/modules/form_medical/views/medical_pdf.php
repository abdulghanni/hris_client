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
  <p style="font-size:10px;">No : <?= get_form_no($id)?></p>
</div>
<table width="1200" height="128" border="0" class="style4">
<tr><td height="20"></td></tr>
<tr><td>Bagian : <?php echo $bagian?></td></tr>
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
	    <td><?php echo get_nik($detail_hrd[$i]['karyawan_id'])?></td>
	    <td><?php echo get_name($detail_hrd[$i]['karyawan_id'])?></td>
	    <td><?php echo $detail_hrd[$i]['pasien']?></td>
	    <td><?php echo $detail_hrd[$i]['hubungan']?></td>
	    <td><?php echo $detail_hrd[$i]['jenis']?></td>
	    <td><?php echo  'Rp. '.number_format($detail_hrd[$i]['rupiah'], 0)?></td>
	    <td align="center"><?php echo $is_approve?></td>
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
                            <td><?php echo get_nik($detail[$i]['karyawan_id'])?></td>
                            <td><?php echo get_name($detail[$i]['karyawan_id'])?></td>
                            <td><?php echo $detail[$i]['pasien']?></td>
                            <td><?php echo $detail[$i]['hubungan']?></td>
                            <td><?php echo $detail[$i]['jenis']?></td>
                            <td align="right"><?php echo  'Rp. '.number_format($detail[$i]['rupiah'], 0)?></td>
                          </tr>
      <?php
        if(sizeof($detail)>1 && isset($detail[$i+1])){
        $total = $total + $detail[$i+1]['rupiah'];
        }
        endfor;}
	    ?>
	    <tr>
	    <td align="right" colspan="<?=$colspan?>">Total : </td><td align="right" colspan="2"><?php echo 'Rp. '.number_format($total, 0)?></td>
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
      <td align="center"><img class="approval-img-md" src="<?=assets_url('img/signed.png');?>"></td>
      <td align="center"><?php echo ($row->is_app_hrd == 1)?"<img class=approval-img-md src=$approved>":'<span class="small"></span><br/>';?></td>
      <td align="center"><?php echo ($row->is_app_lv1 == 1)?"<img class=approval-img-md src=$approved>":'<span class="small"></span><br/>';?></td>
    </tr>
    <tr>
      <td height="100" align="center" class="style3"><?php echo get_name($row->user_id)?><br/><br/><?php echo dateIndo($row->created_on) ?><br/><?php echo (!empty(get_user_position(get_nik($row->user_id)))) ? get_user_position(get_nik($row->user_id)) : ''?></td>
      <td align="center" class="style3"><?php echo get_name($row->user_app_hrd)?><br/><br/><?php echo dateIndo($row->date_app_hrd) ?><br>HRD</td>
      <td align="center" class="style3"><?php echo get_name($row->user_app_lv1)?><br/><br/><?php echo dateIndo($row->date_app_lv1) ?><br/><?php echo (!empty(get_user_position($row->user_app_lv1))) ? get_user_position($row->user_app_lv1) : ''?></td>
    </tr>
</table>
<?php if(!empty($row->user_app_lv2)):?>
<table width="1000" align="center">
    <tr>
      <td width="500" align="center" class="style3">Mengetahui</td>
      <?php if(!empty($row->user_app_lv3)){?>
      <td width="500" align="center" class="style3">Mengetahui</td>
      <?php } ?>
    </tr>
    <tr>
      <td align="center"><?php echo ($row->is_app_lv2 == 1)?"<img class=approval-img-md src=$approved>":'<span class="small"></span><br/>';?></td>
      <?php if(!empty($row->user_app_lv3)){?>
      <td align="center"><?php echo ($row->is_app_lv3 == 1)?"<img class=approval-img-md src=$approved>":'<span class="small"></span><br/>';?></td>
      <?php } ?>
    </tr>
    <tr>
      <td height="100" align="center" class="style3"><?php echo get_name($row->user_app_lv2)?><br/><br/><?php echo dateIndo($row->date_app_lv2) ?><br/><?php echo (!empty(get_user_position($row->user_app_lv2))) ? get_user_position($row->user_app_lv2) : ''?></td>
      <?php if(!empty($row->user_app_lv3)){?>
      <td align="center" class="style3"><?php echo get_name($row->user_app_lv3)?><br/><br/><?php echo dateIndo($row->date_app_lv3) ?><br/><?php echo (!empty(get_user_position($row->user_app_lv3))) ? get_user_position($row->user_app_lv3) : ''?></td>
      <?php } ?>
    </tr>
</table>
<?php endif; ?>
<?php endforeach?>
</body>
</html>
