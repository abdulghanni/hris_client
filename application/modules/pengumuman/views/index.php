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
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <h4><span class="semi-bold">Pengumuman</span></h4>
                            </div>
                        </div>
                        <br/>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="30%" class="text-center">Teks Pengumuman</th>
                                    <th width="10%" class="text-center">Status</th>
                                    <th width="10%" class="text-center"><?php echo lang('index_action_th');?></th>                                  
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td valign="middle"><span class="muted"><?= $pengumuman ?></span></td>
                                    <td valign="middle"><span class="muted"><?= $status ?></span></td>
                                    <td valign="middle" class="text-center">
                                        <button type="button" class="btn btn-info btn-small" data-toggle="modal" data-target="#editModal" title="<?php echo lang('edit_button')?>"><i class="icon-edit"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>
        <!-- Add  Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ubah Pengumuman</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <form class="form-no-horizontal-spacing" id="formedit">
        <div class="form row">
            <div class="col-md-3">Teks Pengumuman</div>
            <div class="col-md-9"><input type="text" class="form-control" name="title" value="<?=$pengumuman?>" /></div> 
        </div>
        <div class="row">
            <div class="col-md-3">DiUmumkan?</div>
            <div class="col-md-9">
                <label class="radio-inline">
                  <input type="radio" name="is_publish" id="is_publish1" value="1" checked>Ya
                </label>
                <label class="radio-inline">
                  <input type="radio" name="is_publish" id="is_publish2" value="0">Tidak
                </label>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
         <button type="submit" class="btn btn-primary" style="margin-top: 3px;" id="btnedit"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button> 
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end add modal-->

