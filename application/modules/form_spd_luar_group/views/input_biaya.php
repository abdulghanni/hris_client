<!-- BEGIN PAGE CONTAINER-->
  <div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content">  
      <div id="container">
        <div class="row">
          <div class="col-md-12">
            <div class="grid simple">
              <div class="grid-title no-border">
                <h4>Detail Ketentuan Biaya <span class="semi-bold"><a href="<?php echo site_url('form_medical')?>">Perjalanan Dinas Luar Kota (Group)</a></span></h4>
              </div>
              <div class="grid-body no-border">
                <?php echo form_open('form_spd_luar_group/update_biaya/'.$id)?>
                  <div class="row column-seperation">
                    <hr/>
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
                            <?php 
                              $c = $ci->get_biaya_pjd($key->user_id);
                              foreach ($c->result() as $k) :
                            ?>
                          <td>
                          <input type="hidden" class="form-control" name="emp[]" value="<?php echo $key->user_id?>" />
                            <input type="hidden" class="form-control" name="biaya_fix_id[]" value="<?php echo $k->id?>" />
                            <input type="text" class="form-control text-right"  name="biaya_fix[]" value="<?php echo $k->jumlah_biaya;?>" />
                          </td>
                            <?php endforeach;
                              $b = $ci->db->select('id, jumlah_biaya')->where('user_id', $key->user_id)->where('user_spd_luar_group_id', $id)->get('users_spd_luar_group_biaya');
                              foreach ($b->result() as $b) {
                            ?>
                          <td>
                            <input type="hidden" class="form-control" name="biaya_tambahan_id[]" value="<?php echo $b->id?>"/>
                            <input type="text" class="form-control text-right" name="biaya_tambahan[]" value="<?php echo $b->jumlah_biaya?>"/>
                          </td>
                            <?php } ?>
                        </tr>
                      <?php endforeach ?>
                      </tbody>
                    </table>

                    <div class="form-actions">
                      <div class="pull-right">
                        <button id="" class="btn btn-success btn-cons" type="submit" ><i class="icon-ok"></i> <?php echo lang('save_button') ?></button>
                        <a href="<?php echo site_url('form_spd_luar_group') ?>"><button id="btnCancelMedical" class="btn btn-white btn-cons" type="button" ><?php echo lang('cancel_button') ?></button></a>
                      </div>
                    </div>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
