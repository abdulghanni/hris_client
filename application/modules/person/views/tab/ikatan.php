<form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Ikatan Dinas</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="15%">ID</th>
			                                                <th width="15%">Type</th>
			                                                <th width="15%">Employee</th>
			                                                <th width="15%">Description</th>
			                                                <th width="15%">To Date</th>
			                                                <th width="15%">From Date</th>
			                                                <th width="10%">Amount</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        <?php
			                                       		if( !empty($ikatan_dinas) ){
			                                        		foreach($ikatan_dinas as $key => $row) {        
													?>
			                                            <tr class="itemikatandinas" id="<?php echo $row['RECID']?>">
			                                                <td valign="middle"><a href="#" id="viewikatandinas-<?php echo $row['RECID']?>"><?php echo $row['HRSEMPLODPID']?></a></td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['TYPE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['EMPLOYEE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['DESCRIPTION']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['FROMDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['TODATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['AMOUNT']?></span>
			                                                </td>
			                                            </tr>
			                                            <tr id="ikatandinasdetail-<?php echo $row['RECID']?>" style="display:none">
			                                            	<td class="detail" colspan="6">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['HRSEMPLODPID']?></h4>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">ID</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="penandatangan" id="penandatangan" type="text"  class="form-control" placeholder="Penandatangan" value="<?php echo $row['HRSEMPLODPID']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Type</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['TYPE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Employee</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['EMPLOYEE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Description</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['DESCRIPTION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">To Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['FROMDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">From Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['TODATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Amount</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['AMOUNT']?>" disabled="disabled">
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
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
			                                                <td valign="middle"><span class="muted">No Data</span></td>
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
	$("tr.itemikatandinas").each(function() {
        var iditemikatandinas = $(this).attr('id');
        $('#viewikatandinas-' + iditemikatandinas).click(function (e){
	     	e.preventDefault();
	      	$('#ikatandinasdetail-' + iditemikatandinas).toggle();
	    });
	});
</script>