<div class="page-content">
    <div id="portlet-config" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
             <h3>Widget Settings</h3>
        </div>
        <div class="modal-body">Widget settings form goes here</div>
    </div>
    <div class="clearfix"></div>
    <div class="content">
        <div class="page-title">
            <i class="icon-custom-left"></i>
            <h3><?php echo lang('list_of_subheading')?>&nbsp;<span class="semi-bold"><?php echo lang('position_subheading');?></span></h3> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">                            
                    <div class="grid-body no-border">
                        <br/>
                        <div class="form-row">
                            <div class="col-md-4">
                              <div class="col-md-4">
                                <label class="form-label text-left">Depo/Cabang</label>
                              </div>
                              <div class="col-md-8">
                                <?php
                                    $style_bu='class="form-control input-sm select2" style="width:100%" id="bu" required';
                                    echo form_dropdown('bu',$bu,'',$style_bu);
                                  ?>
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="col-md-4">
                                <label class="form-label text-left">Bagian</label>
                              </div>
                              <div class="col-md-8">
                                <?php
                                  $style_org='class="select2" id="org" style="width:100%" required';
                                  echo form_dropdown("org",array(''=>'- Pilih Bagian -'),'',$style_org);
                                ?>
                              </div>
                              <div class="col-md-4">
                                <label class="form-label text-left"></label>
                              </div>
                              <div class="col-md-8">
                                <?php
                                  $style_org='class="select2" id="org_2" style="width:100%;display:none"';
                                  echo form_dropdown("org_2",array(''=>'- Pilih Bagian -'),'',$style_org);
                                ?>
                              </div>
                              <div id="org_child3" style="display:none">
                                <div class="col-md-4">
                                  <label class="form-label text-left"></label>
                                </div>
                                <div class="col-md-8">
                                  <?php
                                    $style_org='class="select2" id="org_3" style="width:100%"';
                                    echo form_dropdown("org_3",array(''=>'- Pilih Bagian -'),'',$style_org);
                                  ?>
                                </div>
                              </div>
                              <div id="org_child4" style="display:none">
                                <div class="col-md-4">
                                  <label class="form-label text-left"></label>
                                </div>
                                <div class="col-md-8">
                                  <?php
                                    $style_org='class="select2" id="org_4" style="width:100%"';
                                    echo form_dropdown("org_4",array(''=>'- Pilih Bagian -'),'',$style_org);
                                  ?>
                                </div>
                              </div>
                            </div>
                        </div>

                        <div id="table">
                          
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>


<!--Edit Modal-->
        <?php echo form_open('position/update/', array('id'=>'formupdate'))?>
        <div class="modal fade" id="editModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo lang('edit_pos_group', 'edit_pos_group')?></h4>
                    </div>
                        <p class="error_msg" id="MsgBad2" style="background: #fff; display: none;"></p>
                    <div class="modal-body">
                        <div class="row form-row">
                            <div class="col-md-12 text-center">
                                <h4>Competency</h4>
                            </div>
                        </div>

                        <?php foreach ($competency_group->result_array() as $row): ?>
                            <div class="row form-row">
                                <div class="col-md-4">
                                    <label>Competency Group : <?php echo $row['title']?></label>
                                </div>
                                <div class="col-md-8">
                                    <select name="competency_def<?php echo $row['id']?>[]" class="select2" id="competency<?php echo $row['id']?>_def" style="width:100%" placeholder="Competency" multiple>
                                    <?php
                                        $f_competency_def = array(
                                            'is_deleted' => "where/0",
                                            'comp_group_id' => "where/".$row['id'],
                                            'title' => "order/asc",
                                            );
                                        $q_competency_def = GetAll('competency_def',$f_competency_def);
                                        $competency_def = ($q_competency_def->num_rows() > 0 ) ? $q_competency_def : array();
                                        foreach($competency_def->result_array() as $value) {
                                            echo '<option value="'.$value['id'].'" >'.$value['title'].'</option>';
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>

                            <div id="position_conpetency_div">
                            <?php 
                            $f_position_competency = array(
                                            'position_competency.is_deleted' => "where/0",
                                            'position_competency.position_id' => "where/",
                                            'competency_def.comp_group_id' => "where/".$row['id']
                                            );
                            $q_competency_def = GetJoin('position_competency','competency_def','position_competency.competency_def_id = competency_def.id','left','position_competency.id as id,position_competency.position_id as position_id,position_competency.itj as itj,competency_def.title as competency_title',$f_position_competency);
                            if($q_competency_def->num_rows() > 0){ ?>
                            <div class="row form-row">
                                <div class="col-md-8 col-md-offset-4">
                                    <table class="table">
                                        <tr>
                                            <th>Competency</th>
                                            <th>ITJ</th>
                                        </tr>
                                        <?php foreach ($q_competency_def->result_array() as $comp): ?>
                                        <tr id="row_pos_comp<?php echo $comp['id']?>">
                                            <td>
                                                <input type="hidden" name="url_del_pos_comp<?php echo $comp['id']?>" value="<?php echo site_url('position/del_pos_comp/')?>">
                                                <a title="remove" id="pos_comp_del<?php echo $comp['id']?>" class="pos_comp_del" onclick="del_pos_comp('<?php echo $comp['id']?>','<?php echo site_url('position/del_pos_comp/')?>')">
                                                    <i class="icon-remove"></i>
                                                </a>
                                                <u class="pos_comp" id="pos_comp<?php echo $comp['id']?>" onClick="toggle_form_('<?php echo $comp['id']?>')"><?php echo $comp['competency_title']?></u>
                                            </td>
                                            <td id="itj<?php echo $comp['id']?>">
                                               <?php echo $comp['itj']?>
                                            </td>
                                            <td id="itj_box<?php echo $comp['id']?>" style="display:none;">
                                                <input type="text" class="form-control" name="itj_txt<?php echo $comp['id']?>" value="<?php echo $comp['itj']?>" placeholder="important to job" onChange="update_itj('<?php echo $comp['id']?>','<?php echo site_url('position/update_itj/')?>')">
                                                <div id="MsgBad"></div>
                                            </td>
                                        </tr>
                                        <?php endforeach;?> 
                                    </table>
                                </div>
                            </div>
                            <?php } ?>
                        </div>

                        <?php endforeach;?> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
                        <button type="submit" class="btn btn-primary lnkBlkWhtArw" style="margin-top: 3px;" id="submit"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button> 
                    </div>             
                </div>
            </div>
        </div>
       
        
        <?php echo form_close()?>
        <!-- End Edit Modal-->