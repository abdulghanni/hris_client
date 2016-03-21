    <div class="modal fade bs-example-modal-lg" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Form</h3>
        </div>
        <form action="#" id="form" class="form">
          <div class="modal-body">
            <div class="row form-row">
              <div class="col-md-6">
                <div class="col-md-4"><label>Position ID</label></div>
                <div class="col-md-8"><input type="text" class="form-control" id="title" name="id" value="" placeholder="" disabled="disabled"></div>    
                <div class="col-md-4"><label>Description</label></div>
                <div class="col-md-8"><input type="text" class="form-control" id="title" name="description" value="" placeholder="" disabled="disabled"></div>              
              </div>
              <div class="col-md-6">
                <div class="col-md-4"><label>Position Type</label></div>
                <div class="col-md-8"><input type="text" class="form-control" id="title" name="type" value="" placeholder="" disabled="disabled"></div>    
                <div class="col-md-4"><label>Position Group</label></div>
                <div class="col-md-8"><input type="text" class="form-control" id="title" name="positiongroup" value="" placeholder="" disabled="disabled"></div>         
              </div>
            </div>

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
                                            'position_competency.position_id' => "where/".$id,
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
            <input type="hidden" value="" name="id" class="form-control"> 
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function save()
{
  $('#btnSave').text('saving...'); //change button text
  $('#btnSave').attr('disabled',true); //set button disable 

  
  var url = "position/update";

   // ajax adding data to database
      $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
           //if success close modal and reload ajax table
           /*$('#modal_form').modal('hide');
           reload_table();*/
           if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
            $('#modal_form').modal('hide');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert("Error adding / updating data");
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
        }
    });
}

function toggle_form_(idx){
            $('#itj' + idx).toggle();
            $('#itj_box' + idx).toggle();
        } 

        function update_itj(idx,url_update){           
            var itj_txt = $('input[name=itj_txt' + idx).val();
            var id_txt = idx;
           $.post(url_update, {itj : itj_txt,id : id_txt},function(json){
                if(json.st == 0){
                    $('#MsgBad').text('Update Failed').fadeIn();
                }else{
                    $('#itj' + idx).toggle();
                    $('#itj_box' + idx).toggle();
                    $('#itj' + idx).text(json.itj_new);
                }
            }, 'json');
            return false;
        }

        function del_pos_comp(idx,url_del_pos_comp){
            var id_txt = idx;
           $.post(url_del_pos_comp, {is_deleted : 1,id : id_txt},function(json){
                if(json.st == 0){
                    $('#MsgBad').text('Update Failed').fadeIn();
                }else{
                    $('#row_pos_comp' + idx).fadeOut();
                }
            }, 'json');
            return false;
        }
  </script>