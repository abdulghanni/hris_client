<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title?></title>
<style type="text/css">
<!--
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{ height:40px;font-family:Arial, sans-serif;font-size:14px;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{height:40px; font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}

.style3 {
  font-size: 16px;
}
.style4 {
  font-size: 12px;
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
  <p align="center" class="style6">Form Surat Perjalan Dinas Dalam Kota </p>
</div>
<?php
if ($td_num_rows > 0) {
  $approved = assets_url('img/approved_stamp.png');
  $rejected = assets_url('img/rejected_stamp.png');
  $total_fix = 0;
  $total_lain = 0;
  foreach ($task_detail as $td) : 

    $a = strtotime($td->date_spd_end);
    $b = strtotime($td->date_spd_start);

    $j = $a - $b;
    $jml_pjd = floor($j/(60*60*24)+1);
    ?>
<table width="1000" height="128" border="0" class="style3">
<tr class="style4"><td>Yang bertanda tangan dibawah ini : </td></tr>
<tr><td height="30"></td></tr>
  <tr>
    <td width="275" height="40"><span class="style3">Nama</span></td>
    <td width="10" height="40"><div align="center">:</div></td>
    <td width="440" height="40"><?php echo get_name($td->task_creator) ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Bagian / Dept </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo get_user_organization($td->task_creator)?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Jabatan</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo get_user_position($td->task_creator);?></td>
  </tr>
<?php endforeach; }?> 
</table>

<table width="1000" height="128" border="0" class="style3">
<tr><td height="40"></td></tr>
<tr><td>Memberi tugas / ijin kepada : </td></tr>
<tr><td height="30"></td></tr>
</table>

<table width="1200" height="128" border-style:solid border="1" class="tg">
  <thead>
    <tr>
      <th width="2%">No</th>
      <th width="5%">NIK</th>
      <th width="20%">Nama</th>
      <th width="20%">Dept/Bagian</th>
      <th width="20%">Jabatan</th>
      <th width="8%">Submit</th>
    </tr>
  </thead>
  <tbody>
    <?php for($i=0;$i<sizeof($receiver);$i++):
    ?>
    <tr>
    <td class="tg-031e" height="50" align="center"><?php echo $i+1?></td>
    <td  align="center"><?php echo $receiver[$i]?></td>
    <td>&nbsp;<?php echo get_name($receiver[$i])?></td>
      <td>&nbsp;<?php echo get_user_organization($receiver[$i])?></td>
      <td>&nbsp;<?php echo get_user_position($receiver[$i])?></td>
      <td align="center"><?php echo in_array($receiver[$i], $receiver_submit)?"Ya":"-"?></td>
    </tr>
    <?php endfor?>
  </tbody>
</table>
<br/>
<table width="1000" height="128" border="0" style="" class="style3">
  <?php if ($td_num_rows > 0) {
      foreach ($task_detail as $td):

        $a = strtotime($td->date_spd_end);
        $b = strtotime($td->date_spd_start);

        $j = $a - $b;
        $jml_pjd = floor($j/(60*60*24)+1);
        ?>
  <tr>
    <td height="40"><span class="style3">Melakukan tugas / ijin ke </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo $td->destination ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Dalam rangka  </span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo $td->title; ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Kota Tujuan</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo $td->city_to; ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Dari Kota</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo $td->city_from; ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Kendaraan</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo $td->transportation_nm; ?></td>
  </tr>
  <tr>
    <td height="40"><span class="style3">Tanggal</span></td>
    <td height="40"><div align="center">:</div></td>
    <td height="40"><?php echo dateIndo($td->date_spd_start) ?> s/d <?php echo dateIndo($td->date_spd_end) ?></td>
  </tr>
</table>
<?php endforeach;}?>
<table width="1200" height="128" border="0" class="style3">
<tr><td height="40"></td></tr>
<tr><td>Ketentuan Biaya Perjalan Dinas : </td></tr>
<tr><td height="30"></td></tr>
</table>
<table width="1200" height="128" border-style:solid border="1" class="tg">
  <thead>
    <tr>
      <th width="15%">Nama</th>
        <th width="5%">Gol</th>
        <th width="10%" colspan="2">Uang Makan</th>
        <th width="10%" colspan="2">Uang Saku</th>
        <th width="10%" colspan="2">Hotel</th>
        <?php foreach($biaya_pjd->result() as $b):?>
        <th width="10%" colspan="2"><?php echo $b->jenis_biaya?></th>
      <?php endforeach; ?> 
    </tr>
  </thead>
  <tbody>
    <?php foreach ($detail->result() as $key):?>
      <tr>
        <td class="tg-031e" height="50">
          
          <?php echo get_name($key->user_id)?>
        </td>
        <td align="center">
          <?php echo get_grade($key->user_id)?>
        </td>
        <?php $c = $ci->db->select('users_spd_luar_group_biaya.jumlah_biaya')->from('users_spd_luar_group_biaya')->join('pjd_biaya','pjd_biaya.id = users_spd_luar_group_biaya.pjd_biaya_id', 'left')->where('user_spd_luar_group_id', $id)->where('user_id', $key->user_id)->where('pjd_biaya.type_grade != ', 0)->get();
            foreach ($c->result() as $c) {
            $total_fix += $c->jumlah_biaya*$jml_pjd;
        ?>
        <td border="0" width="5px">Rp.</td>
        <td align="right"><?php echo number_format($c->jumlah_biaya*$jml_pjd, 0)?> </td>
        <?php } ?>
        <?php
          $b = $ci->db->select('users_spd_luar_group_biaya.jumlah_biaya')->from('users_spd_luar_group_biaya')->join('pjd_biaya','pjd_biaya.id = users_spd_luar_group_biaya.pjd_biaya_id', 'left')->where('user_spd_luar_group_id', $id)->where('user_id', $key->user_id)->where('pjd_biaya.type_grade', 0)->get();
            foreach ($b->result() as $b) {
            $total_lain += $b->jumlah_biaya;
        ?>
        <td border="0" width="10px">Rp.</td>
        <td align="right"><?php echo number_format($b->jumlah_biaya, 0)?> </td>
          <?php } ?>
      </tr>
    <?php endforeach ?>
    <tr>
      <td align="right" colspan="<?php $cs=8+sizeof($biaya_pjd->result())*2;echo $cs;?>"><b>Total : Rp. <?php echo number_format($total_fix+$total_lain,0)?></b></td>
    </tr>
    </tbody>
</table>
<br/>
<?php if ($td_num_rows > 0) {
  foreach ($task_detail as $td):
?>

<div style="float: right;text-align: center; width: 50%;" class="style4">
<p>Yang memberi tugas / ijin</p>
<span class="semi-bold"><?php echo get_name($td->task_creator) ?></span><br/>
<span class="small"><?php echo dateIndo($td->created_on) ?></span><br/>
</div> 
<div style="clear: both; margin: 0pt; padding: 0pt; "></div>
<br/>
<table width="1000" align="center">
  <tbody>
    <tr>
      <th width="250" height="100"></th>
      <th width="250">Mengetahui/Menyetujui</th>
      <th width="250"></th>
      <th width="250"></th>
    </tr>
    <tr>
      <?php if(!empty($td->user_app_lv1)){?>
      <td width="250" align="center"><?php echo ($td->app_status_id_lv1 == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_lv1 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <?php }?>
      <?php if(!empty($td->user_app_lv2)){?>
      <td width="250" align="center"><?php echo ($td->app_status_id_lv2 == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_lv2 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <?php }?>
      <?php if(!empty($td->user_app_lv3)){?>
      <td width="250" align="center"><?php echo ($td->app_status_id_lv3 == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_lv3 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
      <?php }?>
      <td width="250" align="center"><?php echo ($td->app_status_id_hrd == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_hrd == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
    </tr>
    <tr>
    <?php if(!empty($td->user_app_lv1)){?>
      <td align="center" class="style3"><?php echo get_name($td->user_app_lv1)?></td>
    <?php }?>
    <?php if(!empty($td->user_app_lv2)){?>
      <td align="center" class="style3"><?php echo get_name($td->user_app_lv2)?></td>
    <?php }?>
    <?php if(!empty($td->user_app_lv3)){?>
      <td align="center" class="style3"><?php echo get_name($td->user_app_lv3)?></td>
    <?php }?>
      <td align="center" class="style3"><?php echo get_name($td->user_app_hrd)?></td>
    </tr>
    <tr>
    <?php if(!empty($td->user_app_lv1)){?>
      <td align="center"><?php echo dateIndo($td->date_app_lv1)?><br/><?php echo get_user_position($td->user_app_lv1)?></td>
    <?php }?>
    <?php if(!empty($td->user_app_lv2)){?>
      <td align="center"><?php echo dateIndo($td->date_app_lv2)?><br/><?php echo get_user_position($td->user_app_lv2)?></td>
    <?php }?>
    <?php if(!empty($td->user_app_lv3)){?>
      <td align="center"><?php echo dateIndo($td->date_app_lv3)?><br/><?php echo get_user_position($td->user_app_lv3)?></td>
    <?php }?>
      <td align="center"><?php echo dateIndo($td->date_app_hrd)?><br/>(HRD)</td>
    </tr>
  </tbody>
</table>
<br />
<?php endforeach;}?>
</body>
</html>
