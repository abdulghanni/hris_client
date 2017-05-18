<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title?></title>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{ height:40px;font-family:Arial, sans-serif;font-size:14px;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{height:40px; font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.jobdesc{font-family:Arial, sans-serif;font-size:10px;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.approval-img-md{
    height:60px;
    width:120px;
    margin-bottom: 8px;
    z-index:-1;
}

.style6 {
  color: #000000;
  font-weight: bold;
  font-size: 18px;
}
.style7 {
  font-size: 10px;
}
</style>
</head>
<body>
<div align="center">
  <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>"/></p>
  <p align="center" class="style6">Formulir Permintaan SDM Baru</p>
  <p class="style7">No : <?= get_form_no($id) ?></p>
</div>
<?php foreach($recruitment as $row):
$approved = assets_url('img/approved_stamp.png');
$rejected = assets_url('img/rejected_stamp.png');
$signed = assets_url('img/signed.png');?>
<table class="tg" width="1000px" align="center">
  <tr>
    <td class="tg-031e">Unit Bisnis</td>
    <td class="tg-031e"><?php echo get_bu_name(substr($row->bu_id,0,2))?></td>
    <td class="tg-031e">Departement</td>
    <td class="tg-031e"><?php echo get_organization_name($row->organization_id)?></td>
  </tr>
  <tr>
    <td class="tg-031e">Bagian</td>
    <td class="tg-031e"><?php echo get_organization_name($row->organization_id)?></td>
    <td class="tg-031e">Jabatan</td>
    <td class="tg-031e"><?php echo get_position_name($row->position_id)?></td>
  </tr>
  <tr>
    <td class="tg-031e">Jumlah Yang Dibutuhkan</td>
    <td class="tg-031e"><?php echo $row->jumlah?></td>
    <td class="tg-031e">Status</td>
    <td class="tg-031e"><?php echo $row->status?></td>
  </tr>
  <tr>
    <td class="tg-031e">Urgensi / Kebutuhan</td>
    <td class="tg-031e" colspan="3"><?php echo $row->urgensi?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="4">Kualifikasi</td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">1. Jenis Kelamin</td>
    <td class="tg-031e" colspan="2">
    	<?php foreach($jenis_kelamin->result() as $jk):?>
              <input name="jenis_kelamin[]" class="checkbox1" type="checkbox" id="jenis_kelamin<?php echo $jk->id ?>" value="<?php echo $jk->id ?>" checked="checked" disabled="disabled">
                <label for="jenis_kelamin<?php echo $jk->id ?>"><?php echo $jk->title?></label>
        <?php endforeach;?>


    </td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">2. Pendidikan</td>
    <td class="tg-031e" colspan="2">
    	<?php 
          if($pendidikan->num_rows()>0){
            foreach($pendidikan->result() as $p):?>
            <input name="pendidikan[]" class="checkbox1" type="checkbox" id="pendidikan<?php echo $p->id ?>" value="<?php echo $p->id ?>" checked="checked" disabled="disabled">
              <label for="pendidikan<?php echo $p->id ?>"><?php echo $p->title?></label>
      <?php endforeach;} ?>

    </td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">3. Jurusan</td>
    <td class="tg-031e" colspan="2"><?php echo $row->jurusan?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">4. IPK</td>
    <td class="tg-031e" colspan="2"><?php echo $row->ipk?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">5. TOEFL</td>
    <td class="tg-031e" colspan="2"><?php echo $row->toefl?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="4">6. Kemampuan Teknis</td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">&nbsp;&nbsp;&nbsp;a. Komputer</td>
    <td class="tg-031e" colspan="2">
      <?php 
        if($komputer->num_rows()>0){
          foreach($komputer->result() as $p):?>
          <input name="komputer[]" class="checkbox1" type="checkbox" id="komputer<?php echo $p->id ?>" value="<?php echo $p->id ?>" checked="checked" disabled="disabled">
          <label for="komputer<?php echo $p->id ?>"><?php echo $p->title?></label>
      <?php endforeach;} ?>
    </td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">&nbsp;&nbsp;&nbsp;b. Bahasa Pemrograman</td>
    <td class="tg-031e" colspan="2"><?php echo $row->bahasa_pemrograman?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">&nbsp;&nbsp;&nbsp;c. Komunikasi</td>
    <td class="tg-031e" colspan="2"><?php echo $row->komunikasi?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">&nbsp;&nbsp;&nbsp;d. Grafika</td>
    <td class="tg-031e" colspan="2"><?php echo $row->grafika?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">&nbsp;&nbsp;&nbsp;e. Desain/Setting</td>
    <td class="tg-031e" colspan="2"><?php echo $row->desain?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">&nbsp;&nbsp;&nbsp;f. Brevet</td>
    <td class="tg-031e" colspan="2"><?php echo $row->brevet?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">&nbsp;&nbsp;&nbsp;g. Lain-lain</td>
    <td class="tg-031e" colspan="2"><?php echo $row->lain_lain?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">7. Portofolio</td>
    <td class="tg-031e" colspan="2"><?php echo $row->portofolio?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">8. Pengalaman</td>
    <td class="tg-031e" colspan="2">Bidang : <?php echo $row->pengalaman?>&nbsp;&nbsp;&nbsp;&nbsp;Selama <?php echo $row->lama_pengalaman?> Tahun</td>
  </tr>
  <tr>
    <td height="100" colspan="4">Job Desc / Uraian Pekerjaan<br/></td>
  </tr>
  </table>
  <textarea class="jobdesc" rows="10" width="1000px" align="center"><?php echo $row->job_desc?></textarea>
  <table class="tg" width="1000px" align="center">
 
  <tr>
    <td height="100" colspan="4">Catatan Pengaju<br/></td>
  </tr>
  </table>
  <textarea class="jobdesc" rows="2" width="1000px" align="center"><?php echo $row->note_pengaju?></textarea>
  <table class="tg" width="1000px" align="center">
  <tr>
    <td class="tg-031e" colspan="2" align="center">Pemohon</td>
    <?php for($i=1;$i<=4;$i++):
      $x = "user_app_lv".$i;
      $r = ($i==5)?$row->user_app_hrd:$row->$x;
      if(!empty($r)):?>
    <td class="tg-031e" colspan="2" align="center">Menyetujui</td>
    <?php endif;
          endfor; ?>
    <td class="tg-031e" colspan="2" align="center">Diterima HRD</td>
  </tr>
  <tr>
    <td class="tg-031e">Nama</td>
    <td class="tg-031e" width="200"><?php echo get_name($row->user_id)?></td>
    <?php for($i=1;$i<=5;$i++):
      $x = "user_app_lv".$i;
      $r = ($i==5)?$row->user_app_hrd:$row->$x;
      if(!empty($r)):?>
        <td class="tg-031e">Nama</td>
        <td class="tg-031e" width="200"><?php echo get_name($r)?></td>
      <?php endif;
            endfor; ?>
  </tr>
  <tr>
    <td class="tg-031e">Jabatan</td>
    <td class="tg-031e"><?php echo $position_pengaju?></td>
     <?php for($i=1;$i<=5;$i++):
      $x = "user_app_lv".$i;
      $r = ($i==5)?$row->user_app_hrd:$row->$x;
      if(!empty($r)):?>
    <td class="tg-031e">Jabatan</td>
    <td class="tg-031e"><?php echo ($i==5) ? "HRD" : get_user_position($r); ?></td>
    <?php endif;
          endfor; ?>
  </tr>
  <tr>
    <td class="tg-031e">Tanggal</td>
    <td class="tg-031e"><?php echo dateIndo($row->date_created)?></td>
    <?php for($i=1;$i<=5;$i++):
      $x = "date_app_lv".$i;
      $y = "user_app_lv".$i;
      $r = ($i==5)?$row->date_app_hrd:$row->$x;
      $rx = ($i==5)?$row->user_app_hrd:$row->$y;
      if(!empty($rx)):?>
    <td class="tg-031e">Tanggal</td>
    <td class="tg-031e"><?php echo dateIndo($r)?></td>
    <?php endif;
          endfor; ?>
  </tr>
  <tr>
    <td class="tg-031e">Tanda Tangan</td>
    <td class="tg-031e" align="center"><img class='approval-img-md' src=<?=$signed?>></td>
     <?php for($i=1;$i<=5;$i++):
      $x = "approval_status_id_lv".$i;
      $r = ($i==5)?$row->approval_status_id_hrd:$row->$x;
      if(!empty($r)):?>
    <td class="tg-031e">Tanda Tangan</td>
    <td class="tg-031e" align="center"><?php echo ($r == 1)?"<img class=approval-img-md src=$approved>":(($r == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small">&nbsp;</span><br/>');?>
    </td>
     <?php endif;
          endfor; ?>
  </tr>
</table>
<?php endforeach;?>
</body>
</html>
