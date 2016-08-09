<form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Award / Warning</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="15%">Award/Warning Type</th>
			                                                <th width="15%">Award/Warning ID</th>
			                                                <th width="15%">Description</th>
			                                                <th width="15%">Approved Date</th>
			                                                <th width="15%">SK Number</th>
			                                                <th width="10%">From Date</th>
			                                                <th width="10%">To Date</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        <?php
			                                       		if( !empty( $award ) ){
			                                        		foreach($award as $key => $row) {        
													?>
			                                            <tr class="itemaward" id="<?php echo $row['EMPLID']?>">
			                                                <td valign="middle"><a href="#" id="viewaward-<?php echo $row['EMPLID']?>"><?php echo $row['HRSAWARDWARNING']?></a></td>
			                                                
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['HRSEMPLAWARDWARNINGID']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['DESCRIPTION']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['SKAPPROVEDDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['SKDOCUMENTNUMBER']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['FROMDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['TODATE']?></span>
			                                                </td>
			                                            </tr>
			                                            <tr id="awarddetail-<?php echo $row['EMPLID']?>" style="display:none">
			                                            	<td class="detail" colspan="7">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['HRSEMPLAWARDWARNINGID']?></h4>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Award/Warning Type</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="penandatangan" id="penandatangan" type="text"  class="form-control" placeholder="Penandatangan" value="<?php echo $row['HRSAWARDWARNING']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Award/Warning ID</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['HRSEMPLAWARDWARNINGID']?>" disabled="disabled">
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
													                        <label class="form-label text-right">Approved Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['SKAPPROVEDDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">SK Number</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['SKDOCUMENTNUMBER']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">From Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['FROMDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">To Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['TODATE']?>" disabled="disabled">
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
	$("tr.itemaward").each(function() {
        var iditemaward = $(this).attr('id');
        $('#viewaward-' + iditemaward).click(function (e){
	     	e.preventDefault();
	      	$('#awarddetail-' + iditemaward).toggle();
	    });
	});
</script>