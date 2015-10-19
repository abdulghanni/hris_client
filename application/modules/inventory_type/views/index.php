<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
             <h3>Widget Settings</h3>
        </div>
        <div class="modal-body">Widget settings form goes here</div>
    </div>
    <div class="clearfix"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">                            
                    <div class="grid-body no-border">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Daftar <span class="semi-bold">Inventaris</span></h4>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addModal"><i class="icon-plus"></i>&nbsp;<?php echo lang('add_button');?></button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="2%" class="text-center">No</th>
                                    <th width="30%" class="text-center">Nama Inventaris</th>
                                    <th width="20%" class="text-center">Tipe Inventaris</th>
                                    <th width="10%" class="text-center"><?php echo lang('index_action_th');?></th>                                  
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($inventory_type->result() as $row):?>
                                <tr>
                                    <td valign="middle"><span class="muted"><?= $row->id ?></span></td>
                                    <td valign="middle"><span class="muted"><?= $row->title ?></span></td>
                                    <td valign="middle"><span class="muted"><?= $row->type_inventory ?></span></td>
                                    <td valign="middle" class="text-center">
                                        <button type="button" class="btn btn-info btn-small" data-toggle="modal" data-target="#editModal<?=$row->id?>" title="<?php echo lang('edit_button')?>"><i class="icon-edit"></i></button>
                                    </td>
                                </tr>

        					<?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>
		<?php foreach($inventory_type->result() as $row):?>
        <div class="modal fade" id="editModal<?php echo $row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo 'Edit Inventaris'?></h4>
                    </div>
                    <div class="modal-body">
                    <form class="form-no-horizontal-spacing" id="formEdit<?php echo $row->id?>">
                        <input type="hidden" value="<?php echo $row->id?>" name="id" id="id" class="id">
	                        <div class="row">
					            <div class="col-md-3">Nama Inventaris</div>
					            <div class="col-md-9"><input type="text" class="form-control" name="title" value="<?= $row->title?>" /></div> 
					        </div>
				        	<br/>
					        <div class="row">
	                            <div class="col-md-3">Tipe Inventaris</div>
					            <div class="col-md-9">
					                <select class="select2" name="type_inventory_id">
					                <?php foreach($type_inventory as $type): 
					                		$selected=($row->type_inventory_id == $type->id) ? 'selected="selected"' : '';
					                ?>
					                	<option value="<?= $type->id?>" <?=$selected?>><?= $type->title?></option>
					                <?php endforeach ?>
					                </select>
					            </div>
	                        </div>  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
                        <button type="submit" class="btn btn-primary" style="margin-top: 3px;" id="btnEdit<?php echo $row->id?>"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button> 
                    </div>             
                </div>
                    <?php echo form_close();?>
            </div>
        </div>

<script src="<?php echo assets_url('js/jquery-1.8.3.min.js'); ?>"></script>
        <script type="text/javascript">
            $('#btnEdit'+<?php echo $row->id?>).click(function(){
                var $btn = $(this).button('loading');
                $('#formEdit'+<?php echo $row->id?>).submit(function(ev){
                    $.ajax({
                        type: 'POST',
                        url: 'inventory_type/update',
                        data: $('#formEdit'+<?php echo $row->id?>).serialize(),
                        success: function() {
                             $("[data-dismiss=modal]").trigger({ type: "click" });
                             location.reload(),
                             $btn.button('reset')
                        }
                    });
                    ev.preventDefault(); 
                });  
            });
        </script>
        <?php endforeach;?>



<!-- Add  Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Inventaris</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" id="formadd">
        <div class="row">
            <div class="col-md-3">Nama Inventaris</div>
            <div class="col-md-9"><input type="text" class="form-control" name="title" value="" /></div> 
        </div>
        <br/>
        <div class="row">
            <div class="col-md-3">Tipe Inventaris</div>
            <div class="col-md-9">
                <select class="form-control select2" name="type_inventory_id">
                <?php foreach($type_inventory as $type): ?>
                	<option value="<?= $type->id?>"><?= $type->title?></option>
                <?php endforeach ?>
                </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
         <button type="submit" class="btn btn-primary" style="margin-top: 3px;" id="btnadd"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button> 
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end add modal-->

