<form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Riwayat Jabatan</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="10%">Organization Unit</th>
			                                                <th width="10%">Position Description</th>
			                                                <th width="10%">Empl Group</th>
			                                                <th width="10%">Grade</th>
			                                                <th width="10%">Branch ID</th>
			                                                <th width="10%">Personnel Action ID</th>
			                                                <th width="10%">Tanggal SK</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        <?php
			                                       		if( !empty( $jabatan ) ){
			                                        		foreach($jabatan as $key => $row) {        
													?>
			                                            <tr class="itemjabatan" id="<?php echo $row['ID']?>">
			                                                <td valign="middle"><a href="#" id="viewjabatan-<?php echo $row['ID']?>"><?php echo $row['ORGANIZATION']?></a></td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['POSITION']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['EMPLGROUP']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['GRADE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['BRANCH']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['PERSONACTION']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['SKDATE']?></span>
			                                                </td>
			                                            </tr>
			                                            <tr id="jabatandetail-<?php echo $row['ID']?>" style="display:none">
			                                            	<td class="detail" colspan="8">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['ID']?></h4>
													                   
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Organization Unit</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['ORGANIZATION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Position Description</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['POSITION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Empl Group</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['EMPLGROUP']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Grade</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['GRADE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">branch ID</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['BRANCH']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Personnel Action ID</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['PERSONACTION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">tanggal SK</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['SKDATE']?>" disabled="disabled">
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
	$("tr.itemjabatan").each(function() {
        var iditemjabatan = $(this).attr('id');
        $('#viewjabatan-' + iditemjabatan).click(function (e){
	     	e.preventDefault();
	      	$('#jabatandetail-' + iditemjabatan).toggle();
	    });
	});
</script>