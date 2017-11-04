<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title?></title>
<style type="text/css">
html{
  font-size: 100%;
  height:100%;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif; 
  font-size: 10px;
}

.tg  {}
.tg td{ height:14px;font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;font-size:14px;padding-left:20px;border-style:solid;border-width:0px;overflow:hidden;}

.nama{
  font-size: 10px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}

.position{
  font-size: 9px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}

.tanggal{
  font-size: 8px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}
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
  font-size: 12px;
  font-weight: bold;
}

.approval-img-md{
    height:40px;
    width:80px;
    margin-bottom: 8px;
    z-index:-1;
}


#container1 {
  float:left;
  width:100%;
  position:relative;
  font-size: 12px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}

#container2 {
  float:left;
  width:100%;
  position:relative;
  font-size: 12px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}
#col1 {
  float:left;
  width:24%;
  text-align: center;
  position:relative;
  margin-top: 0px;
  left:77%;
  overflow:hidden;
}
#col2 {
  float:left;
  width:24%;
  text-align: center;
  position:relative;
  left:81%;
  overflow:hidden;
}
#col3 {
  float:left;
  width:24%;
  text-align: center;
  position:relative;
  left:85%;
  overflow:hidden;
}
#col4 {
  float:left;
  width:24%;
  text-align: center;
  position:relative;
  left:89%;
  overflow:hidden;
}

#atasan3 {
  float:left;
  width:30%;
  text-align: center;
  position:relative;
  left:77%;
  overflow:hidden;
}

#hormat {
  float:left;
  width:25%;
  text-align: center;
  position:relative;
  margin-bottom: 0px;
  left:77%;
  overflow:hidden;
}
.menyetujui {
  float:left;
  width:25%;
  text-align: center;
  position:relative;
  margin-bottom: 20px;
  left:70%;
  overflow:hidden;
  margin-left: 70px;
}
.atasan3 {
  float:left;
  width:25%;
  text-align: center;
  position:relative;
  margin-bottom: 20px;
  left:50%;
  overflow:hidden;
  margin-left: 50px;
}
}
</style>
</head>

<body>
<div align="center">
  <p align="left"><img src="<?php echo assets_url('img/erlangga.jpg')?>"/></p>
</div>
<?php
if ($td_num_rows > 0) {
  $approved = assets_url('img/approved_stamp.png');
  $rejected = assets_url('img/rejected_stamp.png');
  $cancelled = assets_url('img/cancelled.png');
  $signed = assets_url('img/signed.png');
  foreach ($task_detail as $td) : 

    $a = strtotime($td->date_spd_end);
    $b = strtotime($td->date_spd_start);

    $j = $a - $b;
    $jml_pjd = floor($j/(60*60*24)+1);
    ?>
    <br/>
<div class="style4">
  <div style="float: left; width: 54%;">
  Nomor :  
  </div>


  <div style="float: right; width: 28%;">
  Lokasi,
  </div>

  <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
  Perihal : Pengajuan Dana PJD ke  <br/><br/>
  Kepada Yth.,<br/>
   Departemen Keuangan <br/>
   
  Di Tempat<br/>

  <p>Dengan hormat,</p>
  <p>Sehubungan dengan kegiatan ... di ..., maka kami mengajukan perjalanan dinas sebagai berikut:</p>
  <div style="padding-left:15px;">
    <p>I.  &nbsp;Cabang/Depo yang dikunjungi&emsp;:  </p>
    <p>II. Tanggal kunjungan&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;: ... s/d ... (... Hari)</p>
    <p>III.Tujuan kunjungan &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;: ...</p>
    <p>IV.Pelaksana&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;: ... - ...</p>
    <p>V.&nbsp;Golongan&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;: ...</p>
    <p>VI. Jabatan&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;: ...</p>
    <p>VII.Rincian Biaya</p>
<table width="630" class="tg">
<?php 
        $total = 0;
     $i=1;foreach($biaya_single->result() as $row):
     if($row->pjd_biaya_id%3 == 0){
     $jumlah_biaya = (!empty($row->type)) ? $row->jumlah_biaya*($jml_pjd-1) : $row->jumlah_biaya;
      }else{
     $jumlah_biaya = (!empty($row->type)) ? $row->jumlah_biaya*($jml_pjd) : $row->jumlah_biaya;
     }
     //$jumlah_hari = (!empty($row->type)) ? '/'.$jml_pjd.' hari' : '';
     $total += $jumlah_biaya;
    ?>
      <tr>
        <td width="200"><?php echo $i++?></td>
        <td width="10">:</td>
        <td width="120" align="right">...</td>
        <td width="300"></td>
      </tr>
    <?php endforeach ?>
     <tr>
        <td width="200"><b><?php echo '  Total Biaya'?></b></td>
        <td width="10">:</td>
        <td width="120" align="right"><b>...</b></td>
        <td width="300"></td>
      </tr>
    </table>

    <p>VIII. Catatan</p>
    <table width="630" class="tg">
      <?php if(!empty($td->user_app_lv1) && (strlen($td->note_lv1) > 1) ) { ?>
        <tr>
          <td width="200">jabatan 1</td>
          <td width="10">:</td>
          <td width="500">...</td>
          
        </tr>
      <?php }?>
      <?php if(!empty($td->user_app_lv2) && (strlen($td->note_lv2) > 1) ) { ?>
        <tr>
          <td width="200">jabtan 2</td>
          <td width="10">:</td>
          <td width="500">...</td>
        </tr>
      <?php }?>
      <?php if(!empty($td->user_app_lv3) && (strlen($td->note_lv3) > 1) ) { ?>
        <tr>
          <td width="200">jabtan 3</td>
          <td width="10">:</td>
          <td width="500">...</td>
        </tr>
      <?php }?>
    </table>
  </div>
</div>
<div class="style4">
<p>Demikian surat pengajuan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
</div>
<br/>

<div id="container1">
  <div id="hormat">
    <!-- Column one start -->
    <span class="small">Hormat Kami,</span>
   <!-- Column one end -->
  </div>
  <div class="menyetujui">
    <!-- Column three start -->
    <span class="small">Menyetujui,</span>
  </div>
</div>

<div id="container1">
  <div id="col1" style="margin-top:-4px;">
    <!-- Column one start -->
    <br/>
    <span class="nama"> </span><br/><br/><br/><br/>
    <span class="tanggal"> </span><br/>
    <span class="position">(Pengaju)</span>
   <!-- Column one end -->
  </div>
  <div id="col2">
    <!-- Column two start -->
    <span class="small"></span><br/><br/><br/><br/>
    <span class="nama"></span><br/>
    <span class="tanggal"></span><br/>
    <span class="position">(Jabatan 1)</span><!-- Column two end -->
  </div>
  <div id="col3">&nbsp;
  <span class="small"></span><br/><br/><br/><br/>
    <span class="nama"></span><br/>
    <span class="tanggal"></span><br/>
    <span class="position">(Jabatan 2)</span><!-- Column two end -->
  
  </div>
  <div id="col4">
    <!-- Column four start -->
    <span class="small"></span><br/><br/><br/><br/>
    <span class="nama"></span><br/>
    <span class="tanggal"></span><br/>
    <span class="position">(HRD)</span><!-- Column two end -->
    <!-- Column four end -->
  </div>
</div>
<br />

<?php if (!empty($td->user_app_lv3)) :?>
<div id="container2">
  <div id="atasan3">
    <span class="small">&nbsp;</span>
  </div>
  <div class="atasan3">
    <span class="small"></span><br/><br/><br/><br/>
    <span class="nama"></span><br/>
    <span class="tanggal"></span><br/>
    <span class="position">(Jabatan 3)</span><!-- Column two end -->
  </div>
</div>
<?php endif; ?>
<?php endforeach; } ?>

</body>
</html>
