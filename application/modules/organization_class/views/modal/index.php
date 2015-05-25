<?php foreach ($organization_class as $user):?>
<!--Edit Modal-->
        <?php echo form_open('organization_class/update/'.$user->id, array('id'=>'formupdate'.$user->id))?>
        <div class="modal fade" id="editModal<?php echo $user->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo lang('edit_course', 'edit_course')?></h4>
                    </div>
                        <p class="error_msg" id="MsgBad2<?php echo $user->id?>" style="background: #fff; display: none;"></p>
                    <div class="modal-body">
                        <div class="row form-row">
                            <div class="col-md-3">
                                <?php echo lang('title', 'title');?>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $user->title?>">         
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-md-3">
                                <?php echo lang('order_no', 'order_no');?>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="order_no" name="order_no" value="<?php echo $user->order_no?>">         
                            </div>
                        </div>
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

        <!--Delete Modal-->
        <div class="modal fade" id="deleteModal<?php echo $user->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('delete_confirmation').' for '.$user->title; ?></h4>
                </div>
              <?php echo form_open('organization_class/delete/'.$user->id, array("id"=>"formdelete".$user->id))?>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none"><span aria-hidden="true">&times;</span></button>
              <div class="modal-body">
                <p><?php echo lang('delete_this_data').$user->title.' ?'; ?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="icon-ban-circle"></i>&nbsp;<?php echo lang('cancel_button')?></button> 
                <button type="submit" class="btn btn-danger lnkBlkWhtArw" style="margin-top: 3px;"><i class="icon-warning-sign"></i>&nbsp;<?php echo lang('delete_button')?></button>
              </div>
                <?php echo form_close()?>
            </div>
          </div>
        </div>
        <!-- End Delete Modal-->
        <script type="text/javascript">
            $(document).ready(function(){
                $('#formupdate<?php echo $user->id?>').on("submit",function(response){
                    $.post($('#formupdate<?php echo $user->id?>').attr('action'), $('#formupdate<?php echo $user->id?>').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad2<?=$user->id?>').html(json.errors).fadeIn();
                        }else{
                            getTable();getModal();;
                            $("[data-dismiss=modal]").trigger({ type: "click" });
                            $('#MsgBad2<?=$user->id?>').hide();
                            $('#MsgGood').text('Data Updated').fadeIn().delay(3000).fadeOut("slow");
                        }
                    }, 'json');
                    return false;
                });

                $('#formdelete<?php echo $user->id?>').submit(function(response){
                    $.post($('#formdelete<?php echo $user->id?>').attr('action'), $('#formdelete<?php echo $user->id?>').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad').text('Delete Failed').fadeIn();
                        }else{
                            getTable();getModal();;
                            $("[data-dismiss=modal]").trigger({ type: "click" });
                            $('#MsgGood').text('Data Deleted').fadeIn().delay(4000).fadeOut("slow");
                        }
                    }, 'json');
                    return false;
                });
            });
        </script>
    <?php endforeach;?>