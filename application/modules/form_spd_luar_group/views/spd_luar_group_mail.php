<div class="col-md-12">
          <div class="grid simple">
            <div class="grid-title no-border">
              <h4>Form <a href="<?php echo site_url('form_spd_luar_group')?>">Perjalanan Dinas <span class="semi-bold">Luar Kota (Group)</span></a></h4>
            </div>
            <div class="grid-body no-border">
              <!--<form class="form-no-horizontal-spacing" id="form_spd_dalam" action="<?php echo site_url().'form_spd_luar_group/do_submit/'.$id = $this->uri->segment(3, 0);?>" method="post">-->
              <form class="form-no-horizontal-spacing" id="formSpdLuar"> <div class="row column-seperation">
                  <div class="col-md-12">
                    <h4>Admin Pembuat Tugas</h4>
                    <?php if ($td_num_rows > 0) {
                      foreach ($task_detail as $td) :
                        $a = strtotime($td->date_spd_end);
                        $b = strtotime($td->date_spd_start);

                        $j = $a - $b;
                        $jml_pjd = floor($j/(60*60*24)+1);
                        ?>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Nama</label>
                      </div>
                      <div class="col-md-5">
                        <input name="name" id="name" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($td->task_creator) ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Dept/Bagian</label>
                      </div>
                      <div class="col-md-5">
                        <input name="org" id="org" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_organization($td->task_creator)?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Jabatan</label>
                      </div>
                      <div class="col-md-5">
                        <input name="position" id="position" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_user_position($td->task_creator)?>" disabled="disabled">
                      </div>
                    </div>
                  </div>
                  <p>&nbsp;</p>
                  <hr/>
                  <div class="col-md-12">
                    <h4>Memberi tugas / Ijin Kepada</h4>
                    <p></p>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <table id="dataTable" class="table table-bordered">
                          <thead>
                              <tr>
                                <th width="2%">No</th>
                                <th width="5%">NIK</th>
                                <th width="20%">Nama</th>
                                <th width="5%">Golongan</th>
                                <th width="20%">Dept/Bagian</th>
                                <th width="20%">Jabatan</th>
                                <th width="8%">Submit</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php for($i=0;$i<sizeof($receiver);$i++):
                              ?>
                              <tr>
                              <td height="50" align="center"><?php echo $i+1?></td>
                              <td  align="center"><?php echo $receiver[$i]?></td>
                              <td>&nbsp;<?php echo get_name($receiver[$i])?></td>
                                <td  align="center"><?php echo get_grade($receiver[$i])?></td>
                                <td>&nbsp;<?php echo get_user_organization($receiver[$i])?></td>
                                <td>&nbsp;<?php echo get_user_position($receiver[$i])?></td>
                                <td align="center"><?php echo in_array($receiver[$i], $receiver_submit)?"Ya":"-"?></td>
                              </tr>
                              <?php endfor?>
                            </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Tujuan</label>
                      </div>
                      <div class="col-md-5">
                        <input name="destination" id="destination" type="text"  class="form-control" placeholder="Tujuan" value="<?php echo $td->destination ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-left">Dalam Rangka</label>
                      </div>
                      <div class="col-md-5">
                        <input name="title" id="title" type="text"  class="form-control" placeholder="Dalam Rangka" value="<?php echo $td->title; ?>" disabled="disabled">
                      </div>
                    </div>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Kota Tujuan</label>
                        </div>
                        <div class="col-md-5">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kota Tujuan" value="<?php echo $td->city_to; ?>" disabled>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Dari</label>
                        </div>
                        <div class="col-md-5">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kota Asal" value="<?php echo $td->city_from; ?>" disabled>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Kendaraan</label>
                        </div>
                        <div class="col-md-5">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Kendaraan" value="<?php echo $td->transportation_nm; ?>" disabled>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Tgl. Berangkat</label>
                        </div>
                        <div class="col-md-4">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Tanggal Berangkat" value="<?php echo dateIndo($td->date_spd_start); ?>" disabled>
                        </div>
                      </div>
                      <div class="row form-row">
                        <div class="col-md-2">
                          <label class="form-label text-left">Tgl. Pulang</label>
                        </div>
                        <div class="col-md-4">
                          <input name="title" id="title" type="text"  class="form-control" placeholder="Tanggal Pulang" value="<?php echo dateIndo($td->date_spd_end); ?>" disabled>
                        </div>
                      </div>
                  </div>

                  &nbsp;<hr/>
<!--
                  <h5 class="text-center"><span class="semi-bold">Ketentuan Biaya Perjalan Dinas Luar Kota (Group)</span></h5>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th width="15%">Nama</th>
                          <th width="1%">Gol</th>
                          <th width="10%">Uang Makan</th>
                          <th width="10%">Uang Saku</th>
                          <th width="10%">Hotel</th>
                          <?php foreach($biaya_pjd->result() as $b):?>
                          <th width="10%"><?php echo $b->jenis_biaya?></th>
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
                          <?php $c = $ci->db->select('users_spd_luar_group_biaya.jumlah_biaya')->from('users_spd_luar_group_biaya')->join('pjd_biaya','pjd_biaya.id = users_spd_luar_group_biaya.pjd_biaya_id', 'left')->where('user_spd_luar_group_id', $id)->where('user_id', $key->user_id)->where('pjd_biaya.type_grade != ', 0)->get();
                              foreach ($c->result() as $c) { ?>
                          <td><?php echo number_format($c->jumlah_biaya*$jml_pjd, 0)?>
                          </td>
                          <?php } ?>
                          <?php
                            $b = $ci->db->select('users_spd_luar_group_biaya.jumlah_biaya')->from('users_spd_luar_group_biaya')->join('pjd_biaya','pjd_biaya.id = users_spd_luar_group_biaya.pjd_biaya_id', 'left')->where('user_spd_luar_group_id', $id)->where('user_id', $key->user_id)->where('pjd_biaya.type_grade', 0)->get();
                              foreach ($b->result() as $b) {
                          ?>
                          <td><?php echo number_format($b->jumlah_biaya*$jml_pjd, 0)?></td>
                            <?php } ?>
                        </tr>
                      <?php endforeach ?>
                      </tbody>
                    </table>
                    -->
                </div>
                        </div>
                      </div>
                    <!-- /div> -->
                  </div>
              </form>
            </div>
          </div>
        </div>
        <?php endforeach;}?>