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
                <h4>Form <span class="semi-bold"><a href="<?php echo site_url('inventory')?>">Inventaris Karyawan</a></span></h4>
              </div>
              <div class="grid-body no-border">
                 <?php echo form_open('inventory/add_inventory/'.$exit_id.'/'.$type,array("id"=>"formInv"));?>
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
                      <?php if($is_submit == 1 && is_admin_inventaris()){ ?>
                      <div class="row form-row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateInventarisModal"><i class="icon-edit"></i>&nbsp;Update Inventaris</button>
                        </div>
                      </div><br/>  
                      <?php } ?>
                      <div class="row form-row">
                        <div class="col-md-12">
                          <table class="table no-more-tables">
                            <tr>
                              <th>No</th>
                              <th>Item</th>
                              <th>Ketersediaan</th>
                              <th>Keterangan / Jenis</th>
                            </tr>
                            <?php 
                              $i=0;
                              if($users_inventory->num_rows()>0){
                                foreach ($users_inventory->result() as $row) :
                                  $radio_label = ($row->is_available==1)?'Ada':'Tidak';
                                  ?>
                            <tr>
                              <td><?php echo 1+$i++?></td>
                              <td><?php echo $row->title?></td>
                              <td>
                                <input type="hidden" name="inventory_id[]" value="<?php echo $row->id?>">
                                <label class="radio-inline">
                                  <input type="radio" name="is_available_<?php echo $i?>" id="is_available<?php echo $row->id?>-1" required value="1" checked><?php echo $radio_label?>
                                </label>
                              </td>
                              <td><input name="note_<?php echo $i?>" id="note<?php echo $row->id?>" type="text"  class="form-control" placeholder="" value="<?php echo $row->note?>" disabled></td>
                            </tr>
                                <?php endforeach;}else{
                              if($inventory->num_rows()>0){
                                  foreach($inventory->result() as $row):
                              ?>
                            <tr>
                              <td><?php echo 1+$i++?></td>
                              <td><?php echo $row->title?></td>
                              <td>
                                <input type="hidden" name="inventory_id[]" value="<?php echo $row->id?>">
                                <label class="radio-inline">
                                  <input type="radio" name="is_available_<?php echo $i?>" id="is_available<?php echo $row->id?>-1" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="is_available_<?php echo $i?>" id="is_available<?php echo $row->id?>-2" value="0">Tidak
                                </label>
                              </td>
                              <td><input name="note_<?php echo $i?>" id="note<?php echo $row->id?>" type="text"  class="form-control" placeholder="" value=""></td>
                            </tr>
                          <?php endforeach;}}?>
                          </table>
                          <?php if($is_submit == 0){?>
                          <div class="row form-row">
                            <div class="col-md-12">
                              <label class="bold form-label text-left"><?php echo 'Approval' ?></label>
                            </div>
                          </div>

                          <div class="row form-row">
                            <div class="col-md-1">
                              <label class="form-label text-left"><?php echo 'Atasan Langsung' ?></label>
                            </div>
                            <div class="col-md-5">
                              <select name="atasan1" id="atasan1" class="select2" style="width:100%">
                                  <option value="0">- Pilih Atasan Langsung -</option>
                                  <?php foreach ($user_atasan as $key => $up) : ?>
                                    <option value="<?php echo $up['ID'] ?>"><?php echo $up['NAME']; ?></option>
                                  <?php endforeach;?>
                              </select>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                  </div>
                  <div class="form-actions">
                    <?php
                    if($is_submit == 0){?>
                      <div class="pull-right">
                      <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                      <a href="<?php echo site_url('inventory')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
                      </div><?php 
                    }else{ ?>
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
                      <?php }} ?>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
              
    
      </div>
    
  </div>  
  <!-- END PAGE --> 


  <!-- update inventory Modal -->
<div class="modal fade" id="updateInventarisModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Inventaris Karyawan</h4>
        <p class="txtBold txtRed" class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      </div>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing"  id="formUpdateInv<?php echo $type?>">
          <div class="row form-row">
            <div class="col-md-12">
              <table class="table no-more-tables">
                <tr>
                  <th>No</th>
                  <th>Item</th>
                  <th>Ketersediaan</th>
                  <th>Keterangan</th>
                </tr>
                <?php 
                  $i=0;
                 if($inventory->num_rows()>0){
                                  foreach($inventory->result() as $row):
                              ?>
                            <tr>
                              <td><?php echo 1+$i++?></td>
                              <td><?php echo $row->title?></td>
                              <td>
                                <input type="hidden" name="inventory_id[]" value="<?php echo $row->id?>">
                                <label class="radio-inline">
                                  <input type="radio" name="is_available_<?php echo $i?>" id="is_available<?php echo $row->id?>-1" required value="1">Ada
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="is_available_<?php echo $i?>" id="is_available<?php echo $row->id?>-2" value="0">Tidak
                                </label>
                              </td>
                              <td><input name="note_<?php echo $i?>" id="note<?php echo $row->id?>" type="text"  class="form-control" placeholder="" value=""></td>
                            </tr>
                          <?php endforeach;}?>
                          </table>
              </table>

              <div class="row form-row">
                <div class="col-md-12">
                  <label class="bold form-label text-left"><?php echo 'Approval' ?></label>
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-3">
                  <label class="form-label text-left"><?php echo 'Atasan Langsung' ?></label>
                </div>
                <div class="col-md-8">
                  <select name="atasan1_update" id="atasan1_update" class="select2" style="width:100%">
                      <option value="0">- Pilih Atasan Langsung -</option>
                      <?php foreach ($user_atasan as $key => $up) : ?>
                        <option value="<?php echo $up['ID'] ?>"><?php echo $up['NAME']; ?></option>
                      <?php endforeach;?>
                  </select>
                </div>
              </div>

            </div>
          </div>
                                    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button id="btnUpdateInv<?php echo $type?>" class="btn btn-primary" data-loading-text="Loading..."><i class="icon-ok-sign"></i>&nbsp;Update</button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end add modal-->