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
            <i class="icon-custom-left"></i>
            <h3><?php echo lang('org_subheading')?>&nbsp;<span class="semi-bold"><?php echo lang('structure_subheading');?></span></h3> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">                            
                    <div class="grid-body no-border">
                        <br/>
						<div id="MsgGood" class="alert alert-success text-center" style="display:none;"></div>
						<div id="tabel">
						
						</div>
	
	
		
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>

<div id="modal"></div>

<script type="text/javascript">
    window.onload = function(){getModal();getTable()};  
    function getTable() 
    {
        $('#tabel').load('<?php echo site_url('organization/get_table/'); ?>');
    }
	
	function getModal() 
    {
        $('#modal').load('<?php echo site_url('organization/get_modal/'); ?>');
    }
	
</script>
