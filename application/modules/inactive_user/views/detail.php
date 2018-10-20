<div class="page-content"> 
    <div class="clearfix"></div>
    <div class="content">
      <div id="container">
        <div class="row">
          <div class="col-md-12">
            <div class="grid simple">
              <div class="grid-title no-border">
                <h4>Form <span class="semi-bold"><a href="<?php echo site_url('inventory')?>">Inventaris Karyawan</a></span></h4>
              </div>
              <div class="grid-body no-border">
                <form id="formInv">
                <input type="hidden" id="exit_id" value="<?=$exit_id?>">
                <input type="hidden" id="type" value="<?=$type?>">
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="<?php echo get_name($user_nik)?>" disabled="disabled">
                        <input type="hidden" name="emp" value="<?php echo $user_id?>">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Wilayah</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="<?php echo get_user_bu($user_nik)?>" disabled="disabled">
                      </div>
                    </div>
                    
                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">NIK</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="nik" type="text"  class="form-control" placeholder="NIK" value="<?php echo $user_nik?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="Dept/Bagian" value="<?php echo get_user_organization($user_nik)?>" disabled="disabled">
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-2">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-3">
                        <input name="form3LastName" id="position" type="text"  class="form-control" placeholder="Jabatan" value="<?php echo get_user_position($user_nik)?>" disabled="disabled">
                      </div>
                    </div>
                      
                    <div class="row form-row">
                      <div class="col-md-12">
                        <h4>Inventaris yang Dimiliki</h4>
                      </div>
                    </div>
                    <?php $d = ''; if($is_submit == 1 && is_admin_inventaris()){
                        $d = "display:none";
                     ?>
                    <div class="row form-row">
                      <div class="col-md-12">
                          <button type="button" class="btn btn-primary" id="btnUpdateInv"><i class="icon-edit"></i>&nbsp;Update Inventaris</button>
                      </div>
                    </div><br/>  
                    <?php } ?>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <table class="table no-more-tables" id="table">
                          <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th>Keterangan / Jenis</th>
                          </tr>
                          <?php 
                            $i=0;
                            if($users_inventory->num_rows()>0){
                              foreach ($users_inventory->result() as $row) :
                          ?>
                          <tr>
                            <td class="no"><?php echo 1+$i++?></td>
                            <td class="cek" style="display: none">
                                <input type="checkbox" id="row<?=$i?>" value="" class="cek" name="row">
                            </td>
                            <td>
                              <?php echo $row->title?>
                              <input type="hidden" name="inventory_id[]" value="<?php echo $row->inventory_id?>">
                            </td>
                            <td><input name="note[]" id="note<?php echo $row->id?>" type="text"  class="form-control note" placeholder="" value="<?php echo $row->note?>" disabled></td>
                          </tr>
                          <?php endforeach;}else{?>
                          <td colspan="3" id="col-null">Item inventaris kosong</td>
                          <input type="hidden" id="baru" value="1">
                          <?php } ?>
                        </table>
                        <?php if(is_admin_inventaris()):?>
                          <button id="btnAdd" class="btn btn-primary btn-xs" type="button" style="<?= $d ?>" onclick="addRow('table')"><i class="icon-plus"></i> Tambah Item</button>
                          <button id="btnRemove" class="btn btn-danger btn-xs" type="button" style="display: none"><i class="icon-remove"></i> Hapus Item</button>
                        <?php endif;?>
                      </div>
                    </div>
                    <div id="atasan" style="display:none">
                      <div class="row form-row">
                        <div class="col-md-12">
                          <label class="bold form-label text-left">&nbsp;</label>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-left"><?php echo 'Approval Atasan' ?></label>
                        </div>
                        <div class="col-md-8">
                          <select name="atasan1" id="atasan1_update" class="select2" style="width:100%">
                              <option value="0">- Pilih Atasan Langsung -</option>
                              <?php foreach ($user_atasan as $key => $up) : ?>
                                <option value="<?php echo $up['ID'] ?>"><?php echo $up['NAME']; ?></option>
                              <?php endforeach;?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row pull-right" style="display:none" id="update-button">
                      <button type="button" class="btn btn-danger" id="btnCancel"><i class="icon-remove"></i>&nbsp;<?php echo 'Cancel'?></button>
                      <!--button id="btnUpdateInv<?php echo $type?>" class="btn btn-primary" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;Save</button-->
                      <button type="button" id="btnSave" class="btn btn-primary" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;Save</button>
                    </div>

                    <?php if(($is_submit == 1 && is_admin_inventaris()) || $user_app_lv1 == $sess_nik): ?>
                      <div class="form-actions" id="ttd">
                        <div class="col-md-4 text-center">
                          Diisi Oleh,<br/><br/>
                          <span class="semi-bold"><?php echo get_name($user_submit)?></span><br/>
                          <span class="small"><?php echo dateIndo($date_submit)?> </span><br/>  
                          <span class="semi-bold"><?php echo get_user_position(get_nik($user_submit))?></span><br/>
                        </div>
                        <?php if(!empty($user_edit)):?>
                        <div class="col-md-4 text-center">
                        Terakhir Diperbarui Oleh,<br/><br/>
                          <span class="semi-bold"><?php echo get_name($user_edit)?></span><br/>
                          <span class="small"><?php echo dateIndo($date_edit)?> </span><br/>  
                          <span class="semi-bold"><?php echo get_user_position(get_nik($user_edit))?></span><br/>
                        </div>
                        <?php endif; ?>
                        <div class="col-md-4 text-center">
                          Mengetahui,<br/><br/>
                          <?php if(!empty($user_app_lv1) && $is_app_lv1 == 0 && $user_app_lv1 == $sess_nik){?>
                          <button type="button" id="btnAppLv1<?php echo $type ?>" class="btn btn-success btn-cons" data-loading-text="Loading..."><i class="icon-ok"></i>Approve</button>
                          <?php }elseif($is_app_lv1 == 1){ ?>
                          <span class="semi-bold"><?php echo get_name($user_app_lv1)?></span><br/>
                          <span class="small"><?php echo dateIndo($date_app_lv1)?> </span><br/>  
                          <span class="semi-bold"><?php echo get_user_position($user_app_lv1)?></span><br/>
                        </div>
                        <?php } ?>
                      </div>
                    <?php endif;?>
                  </form>
                </div>
              </div>
           </div>
        </div>
      </div>
    </div>  
  <!-- END PAGE --> 
