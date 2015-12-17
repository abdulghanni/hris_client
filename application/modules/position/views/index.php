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

<div id="modal"> 

</div>


