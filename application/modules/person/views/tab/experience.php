<form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Experience</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="20%">Company</th>
			                                                <th width="10%">Start Date</th>
			                                                <th width="10%">End Date</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        <?php
			                                       		if( !empty( $experience ) ){
			                                        		foreach($experience as $key => $row) {        
													 ?>
			                                            <tr class="itemexperience" id="<?php echo $row['ID']?>">
			                                                <td valign="middle"><a href="#" id="viewexperience-<?php echo $row['ID']?>"><?php echo $row['COMPANY']?></a></td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['STARTDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['ENDDATE']?></span>
			                                                </td>
			                                            </tr>
			                                            <tr id="experiencedetail-<?php echo $row['ID']?>" style="display:none">
			                                            	<td class="detail" colspan="3">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['ID']?></h4>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Company</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="company" id="company" type="text"  class="form-control" placeholder="company" value="<?php echo $row['COMPANY']?>" disabled="disabled">
													                      </div>
													                    </div>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Position</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="position" id="position" type="text"  class="form-control" placeholder="Position" value="<?php echo $row['POSITION']?>" disabled="disabled">
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
													                        <label class="form-label text-right">Street</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="street" id="street" type="text"  class="form-control" placeholder="street" value="<?php echo $row['ADDRESS']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Line of Business</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="lineofbusiness" id="lineofbusiness" type="text"  class="form-control" placeholder="Line of Business" value="<?php echo $row['LINEOFBUSSINESS']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Resignation Reason</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="resignation_reason" id="resignation_reason" type="text"  class="form-control" placeholder="Resignation Reason" value="<?php echo $row['RESIGNATIONREASON']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Last Salary</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="last_salary" id="last_salary" type="text"  class="form-control" placeholder="Last Salary" value="<?php echo $row['LASTSALARY']?>" disabled="disabled">
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
	
	$("tr.itemexperience").each(function() {
        var iditemexperience = $(this).attr('id');
        $('#viewexperience-' + iditemexperience).click(function (e){
	     	e.preventDefault();
	      	$('#experiencedetail-' + iditemexperience).toggle();
	    });
	});
</script>