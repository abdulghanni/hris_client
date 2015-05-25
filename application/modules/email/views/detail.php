 <!-- BEGIN PAGE -->
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
  <div class="page-title"> <a href="<?php echo site_url('email')?>" class="btn-back"><i class="icon-custom-left"></i></a>
        <h3>Back- <span class="semi-bold">Mail</span></h3>
        <div class="row clear_fix"><div class="col-md-12" id="respose" style="margin-top:3% "></div></div>
   </div>       
	 <div class="row">
	      <div class="col-md-12" id="preview-email-wrapper">
	        <div class="row">
	          <div class="col-md-12">
	             <div class="grid simple">
	              <div class="grid-title no-border">
	                <h4></h4>
	                <div class="tools">
	                  <a href="javascript:;" class="remove"></a>
	                </div>
	              </div>
	              <?php foreach($email as $row){?>
	              <div class="grid-body no-border" style="min-height: 850px;">
	                <div class="" >
	                  <h3 id="emailheading"><?php echo $row->subject?></h3>
	                  <br>
	                  <div class="control">                 
	                    <div class="pull-left">
	                    <?php echo get_name($row->sender_id) ?>
	                    <label class="inline"><span class="muted">&nbsp;to</span> <span class="bold small-text"><?php echo get_name($row->receiver_id)?></span></label>
	                    </div>
	                    <div class="pull-right">
	                      <span class="muted small-text"><?php echo $row->sent_on?></span>
	                    </div>
	                    <div class="clearfix"></div>
	                  </div>  
	                  <br>
	                  <div class="email-body">
	                    <p><?php echo $row->email_body?>
	                    </p>
	                  </div>            
	                </div>              
	              </div>
	              <?php } ?>
	              </div>  
	            </div>
	        </div>
	      </div>    
	    </div>
</div>

 </div>