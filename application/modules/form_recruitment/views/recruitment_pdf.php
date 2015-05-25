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
</style>
</head>
<body>
<h2 align="center">Formulir Permintaan SDM Baru</h2>
<?php foreach($form_recruitment->result() as $row):?>
<table class="tg" width="1000px" align="center">
  <tr>
    <td class="tg-031e">Unit Bisnis</td>
    <td class="tg-031e"><?php echo get_bu_name(substr($row->bu_id,0,2))?></td>
    <td class="tg-031e">Departement</td>
    <td class="tg-031e"><?php echo get_organization_name($row->parent_organization_id)?></td>
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
    <td class="tg-031e" colspan="2"><?php echo $row->komputer?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">&nbsp;&nbsp;&nbsp;b. Komunikasi</td>
    <td class="tg-031e" colspan="2"><?php echo $row->komunikasi?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">&nbsp;&nbsp;&nbsp;c. Grafika</td>
    <td class="tg-031e" colspan="2"><?php echo $row->grafika?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">&nbsp;&nbsp;&nbsp;d. Desain/Setting</td>
    <td class="tg-031e" colspan="2"><?php echo $row->desain?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">&nbsp;&nbsp;&nbsp;e. Brevet</td>
    <td class="tg-031e" colspan="2"><?php echo $row->brevet?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">&nbsp;&nbsp;&nbsp;f. Lain-lain</td>
    <td class="tg-031e" colspan="2"><?php echo $row->lain_lain?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">7. Portofolio</td>
    <td class="tg-031e" colspan="2"><?php echo $row->portofolio?></td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2">8. Pengalaman</td>
    <td class="tg-031e" colspan="2">Bidang : <?php echo $row->pengalaman?>&nbsp;&nbsp;&nbsp;&nbsp;Selama <?php echo $row->jumlah?> Tahun</td>
  </tr>
  <tr>
    <td height="100" colspan="4">Job Desc / Uraian Pekerjaan<br/></td>
  </tr>
  </table>
  <textarea class="jobdesc" rows="4" width="1000px" align="center"><?php echo $row->job_desc?></textarea>
  <table class="tg" width="1000px" align="center">
  <tr>
    <td class="tg-031e" colspan="2" align="center">Pemohon</td>
    <td class="tg-031e" colspan="4" align="center">Mengetahui/Menyetujui</td>
    <td class="tg-031e" colspan="2" align="center">Diterima HRD</td>
  </tr>
  <tr>
    <td class="tg-031e">Nama</td>
    <td class="tg-031e" width="200"><?php echo get_name($row->user_id)?></td>
    <td class="tg-031e">Nama</td>
    <td class="tg-031e" width="200"></td>
    <td class="tg-031e">Nama</td>
    <td class="tg-031e" width="200"></td>
    <td class="tg-031e">Nama</td>
    <td class="tg-031e" width="200"><?php echo get_name($row->user_app_hrd )?></td>
  </tr>
  <tr>
    <td class="tg-031e">Jabatan</td>
    <td class="tg-031e"><?php echo $position_pengaju?></td>
    <td class="tg-031e">Jabatan</td>
    <td class="tg-031e"></td>
    <td class="tg-031e">Jabatan</td>
    <td class="tg-031e"></td>
    <td class="tg-031e">Jabatan</td>
    <td class="tg-031e">HRD Database</td>
  </tr>
  <tr>
    <td class="tg-031e">Tanggal</td>
    <td class="tg-031e"><?php echo dateIndo($row->date_created)?></td>
    <td class="tg-031e">Tanggal</td>
    <td class="tg-031e"></td>
    <td class="tg-031e">Tanggal</td>
    <td class="tg-031e"></td>
    <td class="tg-031e">Tanggal</td>
    <td class="tg-031e"><?php echo dateIndo($row->date_app_hrd)?></td>
  </tr>
  <tr>
    <td class="tg-031e">Tanda Tangan</td>
    <td class="tg-031e"></td>
    <td class="tg-031e">Tanda Tangan</td>
    <td class="tg-031e"></td>
    <td class="tg-031e">Tanda Tangan</td>
    <td class="tg-031e"></td>
    <td class="tg-031e">Tanda Tangan</td>
    <td class="tg-031e"></td>
  </tr>
  <tr>
  <td height="100" colspan="8">Catatan<br/></td>
  </tr>
</table>
<textarea class="jobdesc" rows="4" width="1000px" align="center"><?php echo $row->note_hrd?></textarea>
<?php endforeach;?>
</body>
</html>
