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
        <!-- <ul class="breadcrumb">
            <li>
                <p>KARYAWAN</p>
            </li> <i class="icon-angle-right"></i> 
            <li>
                <a href="#" class="active">User Management</a>
            </li>
        </ul> -->
        <div class="page-title">
            <i class="icon-custom-left"></i>
            <h3><span class="semi-bold"><?php echo lang('library_table_subheading');?></span></h3> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">                            
                    <div class="grid-body no-border">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><?php echo lang('search_of_subheading')?>&nbsp;<span class="semi-bold"><?php echo lang('library_table_subheading');?></span></h4>
                            </div>
                        </div>
                        <?php echo form_open(site_url('library_table/keywords'))?>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-3 search_label"><?php echo form_label(lang('title'),'title')?></div>
                                        <div class="col-md-9">
                                            <select name="title" class="select2" id="title" style="width:100%">
                                                <option value="0">--select title--</option>
                                                <?php foreach ($user_all->result_array() as $key => $value) {
                                                    echo '<option value="'.site_url($value['url']).'">'.$value['title'].'</option>';
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-12"><?php echo form_submit('submit','Search','class="btn btn-primary"')?></div>
                                    </div>
                                </div>   -->  
                            </div>
                        <?php echo form_close()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>