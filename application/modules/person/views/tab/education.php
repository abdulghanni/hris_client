<form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Education</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="20%">Education</th>
			                                                <th width="20%">Description</th>
			                                                <th width="10%">Start Date</th>
			                                                <th width="10%">End Date</th>
			                                                <th width="10%">Degree</th>
			                                                <th width="10%">Education Group</th>
			                                                <th width="20%">Institution</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        <?php
			                                       		if( !empty( $education ) ){
			                                        		foreach($education as $key => $row) {        
													 ?>
			                                            <tr class="itemeducation" id="<?php echo $row['ID']?>">
			                                                <td valign="middle"><a href="#" id="vieweducation-<?php echo $row['ID']?>"><?php echo $row['EDUCATIONTYPE']?></a></td>
			                                                <td valign="middle"><span class="muted"><?php echo $row['DESCRIPTION']?></span></td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['STARTDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['ENDDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['EDUCATIONDEGREE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['EDUCATIONGROUP']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['EDUCATIONCENTER']?></span>
			                                                </td>
			                                            </tr>
			                                            <tr id="educationdetail-<?php echo $row['ID']?>" style="display:none">
			                                            	<td class="detail" colspan="7">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['ID']?></h4>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Education</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="education" id="education" type="text"  class="form-control" placeholder="education" value="<?php echo $row['EDUCATIONTYPE']?>" disabled="disabled">
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
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Degree</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="degree" id="degree" type="text"  class="form-control" placeholder="Degree" value="<?php echo $row['EDUCATIONDEGREE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Education Group</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="education_group" id="education_group" type="text"  class="form-control" placeholder="Education Group" value="<?php echo $row['EDUCATIONGROUP']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Institution</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="istitution" id="institution" type="text"  class="form-control" placeholder="Institution" value="<?php echo $row['EDUCATIONCENTER']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    
												                  	</div>
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
	$("tr.itemeducation").each(function() {
        var iditemeducation = $(this).attr('id');
        $('#vieweducation-' + iditemeducation).click(function (e){
	     	e.preventDefault();
	      	$('#educationdetail-' + iditemeducation).toggle();
	    });
	});

		                </script>