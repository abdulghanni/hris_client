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
	        <h3>Kompetensi - <a href="<?=base_url($controller)?>">Mapping Indikator - Input</a></h3> 
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
				            
				            <div class="row">
				            	<div class="col-md-12">
				            		<ul>
				            			<li>
				            				<h4><span class="label label-warning">Check List pada kompetensi yang digunakan di Departemen / Bagian </span></h4>
				            			</li>
				            		</ul>
				            	</div>
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="5%" rowspan="2" valign="center">
													<!-- <div class="checkbox check-default">
								                      <input id="checkbox" type="checkbox" value="0"> 
								                      <label for="checkbox"></label>
								                    </div> -->
								                    No.
												</th>
												<th width="25%" rowspan="2">Kompetensi</th>
												<th width="25%" colspan="2" class="text-center">Kemampuan</th>
												<th width="25%" colspan="2" class="text-center">Kemauan</th>
												<th width="25%" rowspan="2">Alasan</th>
											</tr>
											<tr>
												<th class="text-center">Kurang</th>
												<th class="text-center">Mampu</th>
												<th class="text-center">Kurang</th>
												<th class="text-center">Mampu</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1;foreach ($competency_penilaian as $r) { ?>
												<td><?=$i?></td>
												<td>
													<?=$r->title?>
													<input type="hidden" name="competency_penilaian_id[]" value="<?=$r->id?>">
												</td>
												<td class="text-center">
													<div class="checkbox check-default">
								                      <input id="kemampuan<?=$r->id?>" type="checkbox" value="0"> 
								                      <label for="checkbox"></label>
								                    </div>
												</td>
												<td class="text-center">
													<div class="checkbox check-default">
								                      <input id="kemauan<?=$r->id?>" type="checkbox" value="0"> 
								                      <label for="checkbox"></label>
								                    </div>
												</td>
												<td class="text-center">
													<div class="checkbox check-default">
								                      <input id="checkbox" type="checkbox" value="0"> 
								                      <label for="checkbox"></label>
								                    </div>
												</td>
												<td class="text-center">
													<div class="checkbox check-default">
								                      <input id="checkbox" type="checkbox" value="0"> 
								                      <label for="checkbox"></label>
								                    </div>
												</td>
												<td><textarea class="form-control"></textarea></td>
											<?php } ?>
										</tbody>
									</table>
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
