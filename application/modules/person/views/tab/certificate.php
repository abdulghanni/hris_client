<form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Certificate</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="20%">Certificate type</th>
			                                                <th width="40%">Description</th>
			                                                <th width="20%">Start Date</th>
			                                                <th width="20%">End Date</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        <?php
			                                        	if( !empty( $certificate ) ){
			                                        		foreach($certificate as $key => $row) {        
													?>
			                                            <tr class="itemcertificate" id="<?php echo $row['ID']?>">
			                                                <td valign="middle"><a href="#" id="viewcertificate-<?php echo $row['ID']?>">
			                                                	<?php echo $row['CERTIFICATETYPE']?>
			                                                </a></td>
			                                                <td valign="middle"><span class="muted"><?php echo $row['DESCRIPTION']?></span></td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['STARTDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['ENDDATE']?></span>
			                                                </td>
			                                            </tr>
			                                            <tr id="certificatedetail-<?php echo $row['ID']?>" style="display:none">
			                                            	<td class="detail" colspan="5">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['CERTIFICATETYPE']?></h4>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Certificate Type</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="certificate_type" id="certificate_type" type="text"  class="form-control" placeholder="certificate_type" value="<?php echo $row['CERTIFICATETYPE']?>" disabled="disabled">
													                      </div>
													                    </div>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Description</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="description" id="description" type="text"  class="form-control" placeholder="Description" value="<?php echo $row['DESCRIPTION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    
													                    
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Start Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="start_date" id="start_date" type="text"  class="form-control" placeholder="Start Date" value="<?php echo $row['STARTDATE']?>" disabled="disabled">
													                      </div>
													                    </div>

													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">End Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="end_date" id="end_date" type="text"  class="form-control" placeholder="End Date" value="<?php echo $row['ENDDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    
												                  	</div>
												                  	<!-- <div class="form-actions">
																		<div class="pull-right">
																		  <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
																		  <button class="btn btn-white btn-cons" type="button">Cancel</button>
																		</div>
																	</div> -->
												                  </form>
												                  </div>
			                                            	</td>
			                                            </tr>
			                                           <?php }}else{?>
			                                            <tr>
			                                                <td valign="middle">No Data</td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"> <span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                            </tr>

			                                            <?php } ?>
			                                        </tbody>
			                                    </table>
			                            </div>
			                        </div>
			                    </div>
	                		</div>
		                </form>

		                <script type="text/javascript">
		                	
	$("tr.itemcertificate").each(function() {
        var iditemcertificate = $(this).attr('id');
        $('#viewcertificate-' + iditemcertificate).click(function (e){
	     	e.preventDefault();
	      	$('#certificatedetail-' + iditemcertificate).toggle();
	    });
	});
		                </script>