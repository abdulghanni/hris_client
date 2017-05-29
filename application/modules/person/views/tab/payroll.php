<form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Slip Gaji</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="5%">No</th>
			                                                
			                                                <th width="95%">Slip gaji</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        <?php 
											          	$data = get_filenames('d://xampp/htdocs/hris_client/hrd/');
											          	if(count($data) > 0)
											          	{
															foreach ($data as $key => $value) {
																if(substr($value,0,5) == get_nik($this->session->userdata('user_id')))
																{
																	echo '<tr>';
																		echo '<td>';
																			echo $key;
																		echo '</td>';
																		echo '<td>';
																			echo '<a href="'.base_url().'hrd/'.$value.'" target="_BLANK">'.$value.'</a>';
																		echo '</td>';
																	echo '</tr>';
																}
															}
														}else{
															echo '<tr>';
																echo '<td>';
																	echo 'Data tidak tersedia';
																echo '</td>';
															echo '</tr>';
														}
														//echo '</ul>';
														?>

			                                        
			                                        </tbody>
			                                    </table>
			                            </div>
			                        </div>
			                    </div>
	                		</div>
		                </form> 