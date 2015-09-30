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

.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{ height:40px;font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;font-size:14px;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{height:40px; font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;font-size:14px;font-weight:normal;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}

.nama{
  font-size: 14px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}

.position{
  font-size: 13px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}

.tanggal{
  font-size: 12px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}
.style3 {
  font-size: 16px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}
.style4 {
  font-size: 16px;
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
    height:70px;
    width:120px;
    margin-bottom: 8px;
    z-index:-1;
}


#container1 {
  float:left;
  width:100%;
  position:relative;
  font-size: 15px;
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
#menyetujui {
  float:left;
  width:25%;
  text-align: center;
  position:relative;
  margin-bottom: 20px;
  left:81%;
  overflow:hidden;
  margin-left: 150px;
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
  $total_fix = 0;
  $total_lain = 0;
  foreach ($task_detail as $td) : 

    $a = strtotime($td->date_spd_end);
    $b = strtotime($td->date_spd_start);

    $j = $a - $b;
    $jml_pjd = floor($j/(60*60*24)+1);
    ?>
    <br/>
<div class="style4">
  <div style="float: left; width: 54%;">
  Nomor : <?php echo "$form_id/$bu/$m/$y/$td->id" ?>
  </div>


  <div style="float: right; width: 28%;">
  <?= $location.', '.dateIndo($td->created_on)?>
  </div>

  <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
  Perihal : Pengajuan Dana PJD ke <?=$td->city_to?><br/><br/>
  Kepada Yth.,<br/>
  Departemen Keuangan<br/>
  Di Tempat<br/>

  <p>Dengan hormat,</p>
  <p>Sehubungan dengan adanya kegiatan dalam rangka <?=$td->title?> di <?=$td->city_to?>, bersama ini kami mengajukan perjalanan dinas sebagai berikut:</p>
  <div style="padding-left:15px;">
    <p>I.  &nbsp;Cabang/Depo yang dikunjungi&emsp;: <?=$td->city_to?></p>
    <p>II. Tanggal kunjungan&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;: <?= dateIndo($td->date_spd_start).' s/d '.dateIndo($td->date_spd_end)?></p>
    <p>III.Tujuan kunjungan &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;: <?=$td->title?></p>
  </div>
</div>
<?php endforeach; } ?>
<br/>
  <?php if ($td_num_rows > 0) {
      foreach ($task_detail as $td):

        $a = strtotime($td->date_spd_end);
        $b = strtotime($td->date_spd_start);

        $j = $a - $b;
        $jml_pjd = floor($j/(60*60*24)+1);
        ?>
  
<?php endforeach;}?>
<table width="1000" height="128" border-style:solid border="1" class="tg">
                      <thead>
                        <tr>
                          <th width="15%">Nama</th>
        <th width="5%">Gol</th>
        <th width="10%">Uang Makan(Rp)<br/><?=$jml_pjd?> Hari</th>
        <th width="10%">Uang Saku(Rp)<br/><?=$jml_pjd?> Hari</th>
        <th width="10%">Hotel(Rp)<br/><?=$jml_pjd?> Hari</th>
                          <?php 
                            $total_fix = 0;
                            $total_lain = 0;
                            foreach($biaya_pjd->result() as $b):
                          ?>
                          <th width="10%" class="text-center"><?php echo $b->jenis_biaya?>(Rp)</th>
                        <?php endforeach; ?> 
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($detail->result() as $key):?>
                        <tr>
                          <td>
                            
                            <?php echo get_name($key->user_id)?>
                          </td>
                          <td class="text-center">
                            <?php echo get_grade($key->user_id)?>
                          </td>
                          <?php $i = 0;
                              $c = $ci->db->select('users_spd_luar_group_biaya.jumlah_biaya')->from('users_spd_luar_group_biaya')->join('pjd_biaya','pjd_biaya.id = users_spd_luar_group_biaya.pjd_biaya_id', 'left')->where('user_spd_luar_group_id', $id)->where('user_id', $key->user_id)->where('pjd_biaya.type_grade != ', 0)->get();
                              foreach ($c->result() as $c) {
                              $total_fix += $c->jumlah_biaya*$jml_pjd;
                          ?>
                          <td align="right">

                          <?php 
                            $i++ ;
                            ?>
                            <span class="fix<?php echo $i ?>"><?php echo number_format($c->jumlah_biaya*$jml_pjd, 0)?></span>
                            
                            
                          </td>
                          <?php }
                            $j = 0;
                            $b = $ci->db->select('users_spd_luar_group_biaya.jumlah_biaya')->from('users_spd_luar_group_biaya')->join('pjd_biaya','pjd_biaya.id = users_spd_luar_group_biaya.pjd_biaya_id', 'left')->where('user_spd_luar_group_id', $id)->where('user_id', $key->user_id)->where('pjd_biaya.type_grade', 0)->get();
                              foreach ($b->result() as $b) {
                                $total_lain += $b->jumlah_biaya;
                          ?>
                          <?php $j++ ?>
                          <td align="right"><span class="tambahan<?php echo $j ?>"><?php echo number_format($b->jumlah_biaya, 0)?></span></td>
                            <?php } ?>
                        </tr>
                      <?php 
                      endforeach ?>
                      <tr>
                         <td colspan="2"><b>Sub Total(Rp)</b></td>
                          <td id="totalfix1" class="total_fix" align="right"><?= $uang_makan ?></td>
                          <td id="totalfix2" class="total_fix" align="right"><?= $uang_saku?></td>
                          <td id="totalfix3" class="total_fix" align="right"><?= $hotel?></td>
                          <?php foreach($biaya_pjd->result() as $b):;
                            $biaya_tambahan = $this->db->select("(SELECT SUM(jumlah_biaya) FROM users_spd_luar_group_biaya WHERE user_spd_luar_group_id=$id and pjd_biaya_id = $b->biaya_id) AS uang_makan", FALSE)->get()->row_array();
                            $tambahan = $biaya_tambahan['uang_makan'];?>
                            <td  class="total_tambahan" align="right"><?= number_format($tambahan, 0) ?></td>
                          <?php endforeach ?>
                        </tr>
                      <tr>
                        <td align="right" colspan="<?php $cs=5+sizeof($biaya_pjd->result());echo $cs;?>"><b>Total : Rp. <?php echo number_format($total_fix+$total_lain,0)?></b></td>
                      </tr>
                      </tbody>
                    </table>
<br/>
<br/>
<?php if ($td_num_rows > 0) {
  foreach ($task_detail as $td):
?>
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
  <div id="menyetujui">
    <!-- Column three start -->
    <span class="small">Menyetujui,</span>
  </div>
</div>

<div id="container1">
  <div id="col1" style="margin-top:-4px;">
    <!-- Column one start -->
    <?php echo ($td->is_deleted == 1)?"<img class=approval-img-md src=$cancelled>":'<span class="small"></span><br/><br/><br/>';?><br/>
    <span class="nama"><?php echo get_name($td->task_creator) ?></span><br/>
    <span class="tanggal"><?php echo dateIndo($td->created_on) ?></span><br/>
    <span class="position">(<?php echo get_user_position($td->task_creator) ?>)</span>
   <!-- Column one end -->
  </div>
  <div id="col2">
    <!-- Column two start -->
    <?php echo ($td->app_status_id_lv1 == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_lv1 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/><br/><br/>');?><br/>
    <span class="nama"><?php echo get_name($td->user_app_lv1) ?></span><br/>
    <span class="tanggal"><?php echo dateIndo($td->date_app_lv1) ?></span><br/>
    <span class="position">(<?php echo get_user_position($td->user_app_lv1) ?>)</span><!-- Column two end -->
  </div>
  <div id="col3">&nbsp;
  <?php if (!empty($td->user_app_lv2)) :?>
    <!-- Column three start -->
    <?php echo ($td->app_status_id_lv2 == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_lv2 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/><br/><br/>');?><br/>
    <span class="nama"><?php echo get_name($td->user_app_lv2) ?></span><br/>
    <span class="tanggal"><?php echo dateIndo($td->date_app_lv2) ?></span><br/>
    <span class="position">(<?php echo get_user_position($td->user_app_lv2) ?>)</span><!-- Column two end -->
  <?php endif; ?>
  </div>
  <div id="col4">
    <!-- Column four start -->
    <?php echo ($td->app_status_id_hrd == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_hrd == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/><br/><br/>');?><br/>
    <span class="nama"><?php echo get_name($td->user_app_hrd) ?></span><br/>
    <span class="tanggal"><?php echo dateIndo($td->date_app_hrd) ?></span><br/>
    <span class="position">(HRD)</span><!-- Column two end -->
    <!-- Column four end -->
  </div>
</div>
<br />

<?php if (!empty($td->user_app_lv3)) :?>
<div id="container1">
  <div id="atasan3">
    <span class="small">&nbsp;</span>
  </div>
  <div id="menyetujui">
    <?php echo ($td->app_status_id_lv3 == 1)?"<img class=approval-img-md src=$approved>":(($td->app_status_id_lv3 == 2) ? "<img class=approval-img-md src=$rejected>":'<span class="small"></span><br/><br/><br/>');?><br/>
    <span class="nama"><?php echo get_name($td->user_app_lv3) ?></span><br/>
    <span class="tanggal"><?php echo dateIndo($td->date_app_lv3) ?></span><br/>
    <span class="position">(<?php echo get_user_position($td->user_app_lv3) ?>)</span><!-- Column two end -->
  </div>
</div>
<?php endif; ?>
<?php endforeach; } ?>

</body>
</html>
