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
        <div class="page-title">
            <a href="<?php echo site_url('auth')?>"><i class="icon-custom-left"></i></a>
            <h3>Subtitute User</h3> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">
                    <div class="grid-title no-border">
                    </div>                          
                    <div class="grid-body no-border">
                        
                        <div class="row column-seperation">
                            
                            <?php echo form_open(current_url());?>
                                <p>
                                    <label>Users :</label><br />
                                    <input type="hidden" id="base_url" value="<?=base_url()?>">
                                    <select id="user_id" name="user_id" class="select2 form-control">
                                        <?php foreach($users as $key=>$value) { ?>
                                            <option value="<?php echo $value['id']?>"><?php echo $value['nik'].' - '.$value['username']?></option>    
                                        <?php } ?>
                                    </select>
                                </p>
                                <p><button type="button" id="subtitute_user" class="btn btn-info">Subtitute user</button></p>
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>
