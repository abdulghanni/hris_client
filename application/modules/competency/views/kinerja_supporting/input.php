<div class="page-content">
  	<div id="portlet-config" class="modal hide">
      <div class="modal-header">
          <button data-dismiss="modal" class="close" type="button"></button>
           <h3>Widget Settings</h3>
      </div>
      <div class="modal-body">Widget settings form goes here</div>
  	</div>
  	<div class="clearfix"></div>
 	<div class="content">
	    <div class="page-title">
	        <i class="icon-custom-left"></i>
	        <h3>Kompetensi - <a href="<?=base_url($controller)?>"><?=$title?> - Input</a></h3> 
	    </div>
	    <div class="row">
	     	<div class="col-md-12">
		        <div class="grid simple">
		          	<div class="grid-body no-border">
		            <br/>
			            <div class="row-fluid">
					    	<?php
					    	$att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
					    	echo form_open_multipart($controller.'/add/', $att);
					   		?>
							<!-- <input type="hidden" id="form" value="form_penilaian"> -->
					   		<div class="row">
					            <div class="col-md-6">
					            	<div class="row form-row">
						            	<div class="col-md-3">
					                        <label class="form-label text-right">Nama</label>
					                    </div>
					                    <div class="col-md-9">
							            	<select class="select2" style="width:100%" id="emp" name="nik">
							            		<option value="0">-- Pilih Karyawan --</option>
							            		<?php foreach($users as $u){?>
							            			<option value="<?=$u->nik?>"><?=$u->nik.' - '.$u->username?></option>
							            		<?php } ?>
							            	</select>
					                    </div>
					                </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('dept_div') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="organization" id="organization" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                        <input type="hidden" id="organization_id" name="organization_id" value="">
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('position') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="position" id="position" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                        <input type="hidden" id="position_id" name="position_id" value="">
				                      </div>
				                    </div>
					            </div>

					            <div class="col-md-6">
					        		<div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right">Tanggal Mulai Bekerja</label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="position" id="seniority_date" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right">Periode Penilaian</label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="periode" id="" type="text"  class="form-control" placeholder="-" value="" required="required">
				                      </div>
				                    </div>
					        	</div>
					        </div>

					        <div class="row">
					        	<div class="col-md-12">
				                    <table class="table table-bordered" id="tbl_performance">
										<thead>
											<tr>
												<td width="5%" rowspan="2" valign="center">
								                    No.
												</td>
												<td width="65%" rowspan="2" class="text-center">Aspek Penilaian<br/> Performance(60%)</td>
												<td widtd="30%" colspan="3" class="text-center">Penilaian</td>
											</tr>
											<tr>
												<td class="text-center">Bobot</td>
												<td class="text-center">Nilai</td>
												<td class="text-center">(B/100) x N</td>
											</tr>
										</thead>
										<tbody>
											
										</tbody>

										<tfoot id="tbl_performance_footer" style="display: none">
											<tr>
												<td></td>
												<td>Subtotal Nilai Performance</td>
												<td><input class="form-control text-right" type="text" id="sub_total_bobot_performance" name="sub_total_bobot_performance" readonly="readonly"></td>
												<td><input class="form-control text-right" id="sub_total_nilai_performance" type="text" name="sub_total_nilai_performance" readonly="readonly"></td>
												<td><input class="form-control text-right" id="sub_total_persentase_performance" type="text" name="sub_total_persentase_performance" readonly="readonly"></td>
											</tr>
										</tfoot>
									</table>
					        	</div>
					        	<div class="col-md-12">
					        		<button type="button" class="btn btn-small" id="btnAddPerformance" title="Klik disini untuk membuat pengajuan baru" onclick="addPerformance('tbl_performance')"><i class="icon-plus"></i> Tambah Aspek Penilaian Performance</button>
					        	</div>
					        </div>
					        <br/>
					        <br/>
					        <br/>
					        <div class="row">
					        	<div class="col-md-12">
				                    <table class="table table-bordered" id="tbl_kompetensi">
										<thead>
											<tr>
												<td width="5%" rowspan="2" valign="center">
								                    No.
												</td>
												<td width="65%" rowspan="2" class="text-center">Aspek Penilaian<br/> Kompetensi(40%)</td>
												<td widtd="30%" colspan="3" class="text-center">Penilaian</td>
											</tr>
											<tr>
												<td class="text-center">Bobot</td>
												<td class="text-center">Nilai</td>
												<td class="text-center">(B/100) x N</td>
											</tr>
										</thead>
										<tbody>
											
										</tbody>

										<tfoot id="tbl_kompetensi_footer" style="display: none">
											<tr>
												<td></td>
												<td>Subtotal Nilai Kompetensi</td>
												<td><input class="form-control text-right" type="text" id="sub_total_bobot_kompetensi" name="sub_total_bobot_kompetensi" readonly="readonly"></td>
												<td><input class="form-control text-right" id="sub_total_nilai_kompetensi" type="text" name="sub_total_nilai_kompetensi" readonly="readonly"></td>
												<td><input class="form-control text-right" id="sub_total_persentase_kompetensi" type="text" name="sub_total_persentase_kompetensi" readonly="readonly"></td>
											</tr>
										</tfoot>
									</table>
					        	</div>
					        	<div class="col-md-12">
					        		<button type="button" class="btn btn-small" id="btnAddKompetensi" title="Klik disini untuk membuat pengajuan baru" onclick="addKompetensi('tbl_kompetensi')"><i class="icon-plus"></i> Tambah Aspek Penilaian Kompetensi</button>
					        	</div>
					        </div>
					        <hr/>
				            
				            <div class="row">
					        	<div class="col-md-12">
					        		<table id="" class="table-bordered">
										<tr>
											<td width="85%" class="">&nbsp;&nbsp; <h5>Total Nilai Kinerja = (Performance x 60%) + (Kompetensi x 40%)</h5></td>
											<td class="text-right"><input class="form-control text-right" id="total_nilai" type="text" name="total" readonly="readonly" value="0"></td>
										</tr>

										<tr>
											<td width="85%" class="">&nbsp;&nbsp; <h5>Konversi Nilai</h5></td>
											<td class="text-right"><input class="form-control text-right" id="konversi_nilai" type="text" name="konversi" readonly="readonly" value="E"></td>
										</tr>
									</table>
					        	</div>
					        </div>

					        <hr/>
					        <div class="row">
					        	<div class="row form-row">
					            	<div class="col-md-12">
				                        <label class="form-label">1. Potensi Promosi</label>
				                    </div>
				                    <div class="col-md-12">
						            	<textarea name="potensi_promosi" class="form-control" placeholder="Isi disini...."></textarea>
				                    </div>
				                </div>

				                <div class="row form-row">
					            	<div class="col-md-12">
				                        <label class="form-label">2. Catatan Pada Aspek Perilaku</label>
				                    </div>
				                    <div class="col-md-12">
						            	<textarea name="catatan_perilaku" class="form-control" placeholder="Isi disini...."></textarea>
				                    </div>
				                </div>

				                <div class="row form-row">
					            	<div class="col-md-12">
				                        <label class="form-label">3. Kebutuhan Training</label>
				                    </div>
				                    <div class="col-md-12">
						            	<textarea name="kebutuhan_training" class="form-control" placeholder="Isi disini...."></textarea>
				                    </div>
				                </div>

				                <div class="row form-row">
					            	<div class="col-md-12">
				                        <label class="form-label">4. Target Ke depan</label>
				                    </div>
				                    <div class="col-md-12">
						            	<textarea name="target_kedepan" class="form-control" placeholder="Isi disini...."></textarea>
				                    </div>
				                </div>
					        </div>

					        <div id="approver">
			            		<fieldset>
			            			<legend>Approver</legend>
					            	<div class="col-md-12">
					            		<button id="btnAddApprover" type="button" class="btn btn-primary" onclick="addApprover('tblApprover')"><i class="icon-plus"></i> Tambah Approver</button>
					            	</div>
					            	<div class="col-md-7">
					            		<table class="table" id="tblApprover">
					            			<thead>
					            				<tr>
				                					<th width="1%"></th>
					                				<th width="29%"></th>
					                				<th width="70%"></th>
					                			</tr>
					            			</thead>
					            			<tbody>
					            				
					            			</tbody>
					            		</table>
					            	</div>
					            </fieldset>					            
							</div>
							
			            	<div id="submit" class="form-actions">
			                 	<div class="pull-right">
			                    	<button class="btn btn-success btn-cons" type="submit"><i class="icon-ok"></i> <?php echo lang('save_button') ?></button>
			                    	<a href="<?php echo site_url($controller) ?>"><button class="btn btn-white btn-cons" type="button"><?php echo lang('cancel_button') ?></button></a>
			                  	</div>
			                </div>
			              	<?php echo form_close(); ?>
			            </div>
		          	</div>
		        </div>
	      	</div>
	    </div>
  	</div>
</div>
