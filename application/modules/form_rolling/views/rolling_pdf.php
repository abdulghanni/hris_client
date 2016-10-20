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
<?php foreach($form_rolling as $row):
$user_nik = get_nik($row->user_id);
$pengaju_nik = get_nik($row->created_by);
$signed = assets_url('img/signed.png');
$approved = assets_url('img/approved_stamp.png');
$rejected = assets_url('img/rejected_stamp.png');
$pending = assets_url('img/pending_stamp.png');
?>
<div class="style4">
  <div style="float: left; width: 54%;">
  Nomor : <?php echo "$form_id/$bu/$m/$y/$row->id" ?>
  </div>


  <div style="float: right; width: 28%;">
  <?= $location.', '.dateIndo($row->created_on)?>
  </div>

  <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
  Perihal : Pengajuan Mutasi Karyawan <?= get_nik($row->user_id).' '.get_name($row->user_id)?><br/><br/>
  Kepada Yth.,<br/>
  Departemen HRD<br/>
  Di Tempat<br/>

  <p>Dengan hormat,</p>
  <p>Sesuai evaluasi kinerja karyawan terlampir, bersama ini kami sampaikan permohonan proses Mutasi karyawan atas nama <?= get_name($row->user_id).' ('.get_nik($row->user_id).')' ?> dengan data sebagai berikut:</p>
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
        <td><span class="style3">Tanggal Pengangkatan </span></td>
        <td><div align="center"><?php echo dateIndo($row->date_rolling)?></div></td>
        <td><span class="style3"></span></td>
      </tr>
      <tr>
        <td height="100"><span class="style3">Alasan Pengangkatan</span></td>
        <td colspan="2"><span class="style3"><?php echo $row->alasan?></span></td>
      </tr>
      <?php if(!empty($row->note_lv1)):?>
      <tr>
        <td height="100"><span class="style3">Catatan Atasan Langsung</span></td>
        <td colspan="2"><span class="style3"><?php echo $row->note_lv1?></span></td>
      </tr>
      <?php endif; ?>
      <?php if(!empty($row->note_lv2)):?>
      <tr>
        <td height="100"><span class="style3">Catatan Atasan Tidak Langsung</span></td>
        <td colspan="2"><span class="style3"><?php echo $row->note_lv2?></span></td>
      </tr>
      <?php endif; ?>
      <?php if(!empty($row->note_lv3)):?>
      <tr>
        <td height="100"><span class="style3">Catatan Atasan Lainnya</span></td>
        <td colspan="2"><span class="style3"><?php echo $row->note_lv3?></span></td>
      </tr>
      <?php endif; ?>
      <?php if(!empty($row->note_hrd)):?>
      <tr>
        <td height="100"><span class="style3">Catatan HRD</span></td>
        <td colspan="2"><span class="style3"><?php echo $row->note_hrd?></span></td>
      </tr>
      <?php endif; ?>
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
      <td width="200" align="center"><img class="approval-img-md" src=<?=$signed?>></td>
      <?php if(!empty($row->user_app_lv1)){?>
      <td width="200" align="center"><?php echo ($row->app_status_id_lv1 == 1)?"<img class=approval-img-md src=$approved>": (($row->app_status_id_lv1 == 2) ? "<img class=approval-img-md src=$rejected>"  : (($row->app_status_id_lv1 == 3) ? "<img class=approval-img-md src=$pending>" : "<span class='small'></span><br/>"));?></td>
      <?php }?>
      <?php if(!empty($row->user_app_lv2)){?>
      <td width="200" align="center"><?php echo ($row->app_status_id_lv2 == 1)?"<img class=approval-img-md src=$approved>": (($row->app_status_id_lv2 == 2) ? "<img class=approval-img-md src=$rejected>"  : (($row->app_status_id_lv2 == 3) ? "<img class=approval-img-md src=$pending>" : "<span class='small'></span><br/>"));?></td>
      <?php }?>
      <td width="200" align="center"><?php echo ($row->app_status_id_hrd == 1)?"<img class=approval-img-md src=$approved>":(($row->app_status_id_hrd == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/>');?></td>
    </tr>
    <tr>
      <td height="20" align="center" class="style3"><?php echo get_name($row->created_by)?></td>
    <?php if(!empty($row->user_app_lv1)){?>
      <td height="20" align="center" class="style3"><?php echo get_name($row->user_app_lv1)?></td>
    <?php }?>
    <?php if(!empty($row->user_app_lv2)){?>
      <td align="center" class="style3"><?php echo get_name($row->user_app_lv2)?></td>
    <?php }?>
      <td align="center" class="style3"><?php echo get_name($row->user_app_hrd)?></td>
    </tr>
    <tr>
      <td align="center"><?php echo dateIndo($row->created_on)?><br/><?php echo get_user_position($pengaju_nik)?></td>
    <?php if(!empty($row->user_app_lv1)){?>
      <td align="center"><?php echo dateIndo($row->date_app_lv1)?><br/><?php echo '('.get_user_position($row->user_app_lv1).')'?></td>
    <?php }?>
    <?php if(!empty($row->user_app_lv2)){?>
      <td align="center"><?php echo dateIndo($row->date_app_lv2)?><br/><?php echo '('.get_user_position($row->user_app_lv2).')'?></td>
      <?php }?>
      <td align="center"><?php echo dateIndo($row->date_app_hrd)?><br/>(HRD)</td>
    </tr>
  </tbody>
</table>
<br />
<?php if(!empty($row->user_app_lv3)){?>
<table width="800" align="center">
  <tbody>
    <tr>
      <td width="275" align="center"></td>
      <td width="200" align="center"><?php echo ($row->app_status_id_lv3 == 1)?"<img class=approval-img-md src=$approved>": (($row->app_status_id_lv3 == 2) ? "<img class=approval-img-md src=$rejected>"  : (($row->app_status_id_lv3 == 3) ? "<img class=approval-img-md src=$pending>" : "<span class='small'></span><br/>"));?></td>
      <td width="275" align="center"></td>
    </tr>
    <tr>
      <td height="20" align="center" class="style3"></td>
      <td align="center" class="style3"><?php echo get_name($row->user_app_lv3)?></td>
      <td align="center" class="style3"></td>
    </tr>
    <tr>
    <?php if(!empty($row->user_app_lv3)){?>
      <td></td>
      <td align="center"><?php echo dateIndo($row->date_app_lv3)?><br/><?php echo '('.get_user_position($row->user_app_lv3).')'?></td>
      <?php }?>
      <td align="center"></td>
    </tr>
  </tbody>
</table>
<?php }?>

<?php endforeach;?>
</body>
</html>
