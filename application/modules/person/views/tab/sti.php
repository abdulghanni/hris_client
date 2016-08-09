<form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Serah Terima Ijazah</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="5%">No Identitas</th>
			                                                <th width="10%">Ijazah Name</th>
			                                                <th width="5%">Ijazah No</th>
			                                                <th width="10%">Tempat/tanggal dikeluarkan</th>
			                                                <th width="10%">Dikeluarkan oleh</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                        <?php
			                                       		if( !empty( $sti ) ){
			                                        		foreach($sti as $key => $row) {          
													?>
			                                            <tr class="itemsertijah" id="<?php echo $row['RECID']?>">
			                                                <td valign="middle"><a href="#" id="viewsertijah-<?php echo $row['RECID']?>"><?php echo $row['IDENTITYNO']?></a></td>
			                                               
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['IJAZAH']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['NOMOR']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['IJAZAHHISTORY']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['INSTITUTION']?></span>
			                                                </td>
			                                            </tr>

			                                            <tr id="sertijahdetail-<?php echo $row['RECID']?>" style="display:none">
			                                            	<td class="detail" colspan="12">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['RECID']?></h4>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Tempat/tanggal diterbitkan</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="penandatangan" id="penandatangan" type="text"  class="form-control" placeholder="Penandatangan" value="<?php echo $row['PUBLISHEDPLACE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['AKTIFASIDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Sebagai</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['POSITION']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Description</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['RECEIVEDBY']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Acknowledge by</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['ACKNOWLEDGEBY']?>" disabled="disabled">
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
	$("tr.itemsertijah").each(function() {
        var iditemsertijah = $(this).attr('id');
        $('#viewsertijah-' + iditemsertijah).click(function (e){
	     	e.preventDefault();
	      	$('#sertijahdetail-' + iditemsertijah).toggle();
	    });
	});
</script>