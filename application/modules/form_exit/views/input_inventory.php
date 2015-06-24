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
                <h4>Form Input <span class="semi-bold">Inventaris Karyawan</span></h4>
              </div>
              <div class="grid-body no-border">
                 <?php echo form_open('form_exit/add_inventory/'.$exit_id.'/'.$type,array("id"=>"formaddexit"));?>
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
                      
                      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
                      <div class="row form-row">
                        <div class="col-md-12">
                          <h4>Inventaris yang harus diserahkan</h4>
                        </div>
                      </div>
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
                        </div>
                  </div>
                  <div class="form-actions">
                    <?php if($is_submit == 0){?>
                      <div class="pull-right">
                      <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                      <a href="<?php echo site_url('form_exit')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
                      </div>
                    <?php }else{?>
                    <div class="col-md-12 text-center">
                    Diisi Oleh,<br/><br/>
                    <span class="semi-bold"><?php echo get_name($user_submit)?></span><br/>
                    <span class="small"><?php echo dateIndo($date_submit)?> </span><br/>  
                    <span class="semi-bold"><?php echo get_user_position(get_nik($user_submit))?></span><br/>
                    </div>
                    <?php } ?>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
              
    
      </div>
    
  </div>  
  <!-- END PAGE --> 