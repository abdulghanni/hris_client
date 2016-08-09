<form class="form-no-horizontal-spacing" id="form-condensed">
	<div class="row">
        <div class="col-md-12">
            <div class="grid simple ">
                <div class="grid-body no-border grid-custom">
                      <h4>Company Sponsor Course</h4>
                        <table class="table no-more-tables table-hover">
                            <thead>
                                <tr>
                                    <th width="20%"><?php echo lang('course_id');?></th>
                                    <th width="40%"><?php echo lang('description');?></th>
                                    <th width="20%"><?php echo lang('course_registration_date');?></th>
                                    <th width="20%"><?php echo lang('course_status');?></th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php
                           		if( !empty( $course ) ){
                            		foreach($course as $key => $row) {        
							 ?>
                                <tr class="itemtraining" id="<?php echo $row['ID']?>">
                                    <td valign="middle"><a href="#" id="viewtraining-<?php echo $row['ID']?>"><?php echo $row['COURSEID']?></a></td>
                                    <td valign="middle"><span class="muted"><?php echo $row['DESCRIPTION']?></span></td>
                                    <td valign="middle">
                                        <span class="muted"><?php echo $row['REGISTRATIONDATE']?></span>
                                    </td>
                                    <td valign="middle">
                                        <span class="muted">
                                        <?php
												if($row['STATUS'] == 0){
													$course_status = 'Registration';
												}elseif($row['STATUS'] == 1){
													$course_status = 'Confirmation';
												}elseif($row['STATUS'] == 2){
													$course_status = 'Completed';
												}elseif($row['STATUS'] == 3){
													$course_status = 'Passed';
												}elseif($row['STATUS'] == 4){
													$course_status = 'Waiting List';
												}elseif($row['STATUS'] == 5){
													$course_status = 'Canceled';
												}elseif($row['STATUS'] == 6){
													$course_status = 'Drop Out';
												}else{
													$course_status = '-';
												}
												
												echo $course_status;
										?>
               							 </span>
                                    </td>
                                </tr>
                                <tr id="trainingdetail-<?php echo $row['ID']?>" style="display:none">
                                	<td class="detail" colspan="5">
                                		<div class="row">
                                			<form action="#" method="enctype">
						                  	<div class="col-md-12">
						                  		<h4>ID : #<?php echo $row['COURSEID']?></h4>
						                  		<div class="row form-row">
							                      <div class="col-md-2">
							                        <?php echo lang('course_id', 'course_id');?>
							                      </div>
							                      <div class="col-md-10">
							                        <input name="courseid" id="courseid" type="text"  class="form-control" placeholder="courseid" value="<?php echo $row['COURSEID']?>" disabled="disabled">
							                      </div>
							                    </div>
						                  		<div class="row form-row">
							                      <div class="col-md-2">
							                        <?php echo lang('description', 'description');?>
							                      </div>
							                      <div class="col-md-10">
							                        <input name="description" id="description" type="text"  class="form-control" placeholder="Description" value="<?php echo $row['DESCRIPTION']?>" disabled="disabled">
							                      </div>
							                    </div>
							                    
							                    
							                    <div class="row form-row">
							                      <div class="col-md-2">
							                        <?php echo lang('course_registration_date', 'course_registration_date');?>
							                      </div>
							                      <div class="col-md-10">
							                        <input name="registration_date" id="registration_date" type="text"  class="form-control" placeholder="Registration Date" value="<?php echo $row['REGISTRATIONDATE']?>" disabled="disabled">
							                      </div>
							                    </div>

							                    <div class="row form-row">
							                      <div class="col-md-2">
							                        <?php echo lang('course_status', 'course_status');?>
							                      </div>
							                      <div class="col-md-10">
							                        <input name="status" id="status" type="text"  class="form-control" placeholder="Status" value="<?php echo $course_status?>" disabled="disabled">
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
	$("tr.itemtraining").each(function() {
        var iditemtraining = $(this).attr('id');
        $('#viewtraining-' + iditemtraining).click(function (e){
	     	e.preventDefault();
	      	$('#trainingdetail-' + iditemtraining).toggle();
	    });
	});
</script>