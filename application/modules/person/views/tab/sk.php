<form class="form-no-horizontal-spacing" id="form-condensed">
		                	<div class="row">
				                <div class="col-md-12">
			                        <div class="grid simple ">
			                            <div class="grid-body no-border grid-custom">
			                                  <h4>Surat Keputusan</h4>
			                                    <table class="table no-more-tables table-hover">
			                                        <thead>
			                                            <tr>
			                                                <th width="20%">SK Date</th>
			                                                <th width="15%">Nomor SK</th>
			                                                <th width="15%">Position</th>
			                                                <th width="10%">Departement</th>
			                                                <th width="10%">Tanggal Efektif</th>
			                                                <th width="10%">Tempat</th>
			                                                <th width="10%">Penandatangan</th>
			                                                <th width="10%">Posisi Penandatangan</th>
			                                            </tr>
			                                        </thead>
			                                        <tbody>
			                                       <?php
			                                       		if( !empty( $sk ) ){
			                                        		foreach($sk as $key => $row) {        
													 ?>
			                                            <tr class="itemsk" id="<?php echo $row['RECID']?>">
			                                                <td valign="middle"><a href="#" id="viewsk-<?php echo $row['RECID']?>"><?php echo $row['SKDATE']?></a></td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['TCN_SKNUMBER']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['POSITION']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['HRSDEPARTMENTID']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['EFFECTIVEDATE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['PLACE']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['HRSSIGNNAME']?></span>
			                                                </td>
			                                                <td valign="middle">
			                                                    <span class="muted"><?php echo $row['HRSSIGNPOSITION']?></span>
			                                                </td>
			                                            </tr>
			                                            <tr id="skdetail-<?php echo $row['RECID']?>" style="display:none">
			                                            	<td class="detail" colspan="8">
			                                            		<div class="row">
			                                            			<form action="#" method="enctype">
												                  	<div class="col-md-12">
												                  		<h4>ID : #<?php echo $row['RECID']?></h4>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">SK Date</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="sk_date" id="sk_date" type="text"  class="form-control" placeholder="sk_date" value="<?php echo $row['SKDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
												                  		<div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Nomor SK</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="nomor_sk" id="nomor_sk" type="text"  class="form-control" placeholder="nomor SK" value="<?php echo $row['TCN_SKNUMBER']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Position</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="position" id="position" type="text"  class="form-control" placeholder="Position" value="<?php echo $row['HRSPOSITIONID']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Departement</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="departement" id="departement" type="text"  class="form-control" placeholder="Departement" value="<?php echo $row['HRSDEPARTMENTID']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Tanggal Efektif</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="tanggal_efektif" id="tanggal_efektif" type="text"  class="form-control" placeholder="Tanggal Efektif" value="<?php echo $row['EFFECTIVEDATE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Tempat</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="tempat" id="tempat" type="text"  class="form-control" placeholder="penandatangan" value="<?php echo $row['PLACE']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Penandatangan</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="penandatangan" id="penandatangan" type="text"  class="form-control" placeholder="Penandatangan" value="<?php echo $row['HRSSIGNNAME']?>" disabled="disabled">
													                      </div>
													                    </div>
													                    <div class="row form-row">
													                      <div class="col-md-2">
													                        <label class="form-label text-right">Posisi Penandatangan</label>
													                      </div>
													                      <div class="col-md-10">
													                        <input name="posisi_penandatangan" id="posisi_penandatangan" type="text"  class="form-control" placeholder="Posisi Penandatangan" value="<?php echo $row['HRSSIGNPOSITION']?>" disabled="disabled">
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
	$("tr.itemsk").each(function() {
        var iditemsk = $(this).attr('id');
        $('#viewsk-' + iditemsk).click(function (e){
	     	e.preventDefault();
	      	$('#skdetail-' + iditemsk).toggle();
	    });
	});
</script>