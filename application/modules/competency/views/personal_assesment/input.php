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
	        <h3>Kompetensi - <a href="<?=base_url($controller)?>"><?=$title?> - Input</a></h3> 
	    </div>
	    <div class="row">
	     	<div class="col-md-12">
		        <div class="grid simple">
		          	<div class="grid-body no-border">
		            <br/>
			            <div class="row-fluid">
					    	<?php
					    	$att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
					    	echo form_open_multipart($controller.'/add/', $att);
					   		?>
							<!-- <input type="hidden" id="form" value="form_penilaian"> -->
					   		<div class="row">
					            <div class="col-md-6">
					            	<div class="row form-row">
						            	<div class="col-md-3">
					                        <label class="form-label text-right">Nama</label>
					                    </div>
					                    <div class="col-md-9">
							            	<select class="select2" style="width:100%" id="emp" name="nik">
					                    		<option value="0">-- Pilih Karyawan --</option>
							            		<?php foreach($users as $u){?>
							            			<option value="<?=$u->nik?>"><?=$u->nik.' - '.$u->username?></option>
							            		<?php } ?>
							            	</select>
					                    </div>
					                </div>
					                <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('dept_div') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="organization" id="organization" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                        <input name="organization_id" id="organization_id" type="hidden"  class="form-control" placeholder="-" value="">
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right">Position Group</label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="position_group_id" id="position-group" type="text"  class="form-control" placeholder="-" value="" readonly>
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('position') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="position" id="position" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                      </div>
				                    </div>
					            </div>
					        </div>
				            <div class="row">
								<div class="col-md-12">
									<div id="result">

									</div>
								</div>
				            	<div id="approver">
				            		<fieldset>
				            			<legend>Approver</legend>
						            	<div class="col-md-12">
						            		<button id="btnAddApprover" type="button" class="btn btn-primary" onclick="addApprover('tblApprover')"><i class="icon-plus"></i> Tambah Approver</button>
						            	</div>
						            	<div class="col-md-7">
						            		<table class="table" id="tblApprover">
						            			<thead>
						            				<tr>
					                					<th width="1%"></th>
						                				<th width="29%"></th>
						                				<th width="70%"></th>
						                			</tr>
						            			</thead>
						            			<tbody>
						            				
						            			</tbody>
						            		</table>
						            	</div>
						            </fieldset>					            
								</div>
				            </div>
			            	<div id="submit" class="form-actions">
			                 	<div class="pull-right">
			                    	<button class="btn btn-success btn-cons" type="submit"><i class="icon-ok"></i> <?php echo lang('save_button') ?></button>
			                    	<a href="<?php echo site_url($controller) ?>"><button class="btn btn-white btn-cons" type="button"><?php echo lang('cancel_button') ?></button></a>
			                  	</div>
			                </div>
			              	<?php echo form_close(); ?>
			            </div>
		          	</div>
		        </div>
	      	</div>
	    </div>
  	</div>
</div>
