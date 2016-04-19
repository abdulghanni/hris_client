<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
             <h3>Widget Settings</h3>
        </div>
        <div class="modal-body">Widget settings form goes here</div>
    </div>
    <div class="clearfix"></div>
    <div class="content">
        <!-- <ul class="breadcrumb">
            <li>
                <p>KARYAWAN</p>
            </li> <i class="icon-angle-right"></i> 
            <li>
                <a href="#" class="active">User Management</a>
            </li>
        </ul> -->
        <div class="page-title">
            <i class="icon-custom-left"></i>
            <h3><?php echo lang('list_of_subheading')?>&nbsp;<span class="semi-bold"><?php echo lang('att_subheading');?></span></h3> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">                            
                    <div class="grid-body no-border">
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <h4><?php echo lang('search_of_subheading')?>&nbsp;<span class="semi-bold"><?php echo lang('att_subheading');?></span></h4>
                            </div>
                        </div>
                        <?php echo form_open(site_url($filename.'/search'))?>
                            <div class="row">
                            		<?php if($this->ion_auth->is_admin()) {?>
                            		<div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-3 search_label"><?php echo form_label('Karyawan','karyawan')?></div>
                                        <div class="col-md-9"><?php echo form_dropdown('nik', GetOptUsers(), $s_nik)?></div>
                                    </div>
                                </div>
                              	<?php }?>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-3 search_label"><?php echo form_label('Bulan','bulan')?></div>
                                        <div class="col-md-9"><?php echo form_dropdown('bulan', GetOptMonth(), $s_bulan, "class='col-md-8'")?></div>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-3 search_label"><?php echo form_label('Tahun','tahun')?></div>
                                        <div class="col-md-9"><?php echo form_dropdown('tahun', GetOptYear(), $s_tahun, "class='col-md-8'")?></div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-info"><i class="icon-search"></i>&nbsp;<?php echo lang('search_button')?></button>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        <?php echo form_close()?>
                        <br/>
                        
                        <div class="row column-seperation">
								          <div class="col-md-4">
								            <div class="grid simple">
								              <div class="grid-title no-border">
								                <h4>Grafik <span class="semi-bold">Attendance</span></h4>
								              </div>
								              <div class="grid-body no-border grid-custom-height">
								              	<div id="donut-example" style="height:200px;"> </div>
								              </div>
								            </div>
								          </div>
								          <div class="col-md-4" style="border-right:none;">
								            <div class="grid simple">
								              <div class="grid-title no-border">
								                <h4>Rekap <span class="semi-bold">Attendance</span></h4>
								              </div>
								              <div class="grid-body no-border grid-custom-height">
								                  <div class="row form-row">
								                    <div class="col-md-2">
								                      <label class="form-label text-right">Total</label>
								                    </div>
								                    <div class="col-md-10">
								                      <input name="region" type="text"  class="form-control" placeholder="Total" value="<?php echo $rekap_hadir['total'];?>" disabled="disabled">
								                    </div>
								                  </div>
								                  <div class="row form-row">
								                    <div class="col-md-2">
								                      <label class="form-label text-right">Hadir</label>
								                    </div>
								                    <div class="col-md-10">
								                      <input name="region" type="text"  class="form-control" placeholder="Hadir" value="<?php echo $rekap_hadir['hadir'];?>" disabled="disabled">
								                    </div>
								                  </div>
								                  <div class="row form-row">
								                    <div class="col-md-2">
								                      <label class="form-label text-right">Telat</label>
								                    </div>
								                    <div class="col-md-10">
								                      <input name="region" type="text"  class="form-control" placeholder="Terlambat" value="<?php echo $rekap_hadir['terlambat'];?>" disabled="disabled">
								                    </div>
								                  </div>
								                  <div class="row form-row">
								                    <div class="col-md-2">
								                      <label class="form-label text-right">OFF</label>
								                    </div>
								                    <div class="col-md-10">
								                      <input name="postal_code" type="text"  class="form-control" placeholder="Off" value="<?php echo $rekap_hadir['off'];?>" disabled="disabled">
								                    </div>
								                  </div>
								              </div>
								            </div>
								          </div>
								
								
								          <div class="col-md-4">
								            <div class="grid simple">
								              <div class="grid-title no-border">
								                <h4>&nbsp;</h4>
								              </div>
								              <div class="grid-body no-border grid-custom-height">
								                  <div class="row form-row">
								                    <div class="col-md-2">
								                      <label class="form-label text-right">Cuti</label>
								                    </div>
								                    <div class="col-md-10">
								                      <input name="country" type="text"  class="form-control" placeholder="Cuti" value="<?php echo $rekap_hadir['cuti'];?>" disabled="disabled">
								                    </div>
								                  </div>
								                  <div class="row form-row">
								                    <div class="col-md-2">
								                      <label class="form-label text-right">Izin</label>
								                    </div>
								                    <div class="col-md-10">
								                      <input name="telephone" type="text"  class="form-control" placeholder="Ijin" value="<?php echo $rekap_hadir['ijin'];?>" disabled="disabled">
								                    </div>
								                  </div>  
								                  <div class="row form-row">
								                    <div class="col-md-2">
								                      <label class="form-label text-right">Sakit</label>
								                    </div>
								                    <div class="col-md-10">
								                      <input name="telephone" type="text"  class="form-control" placeholder="Sakit" value="<?php echo $rekap_hadir['sakit'];?>" disabled="disabled">
								                    </div>
								                  </div>
								                  <div class="row form-row">
								                    <div class="col-md-2">
								                      <label class="form-label text-right">Alpa</label>
								                    </div>
								                    <div class="col-md-10">
								                      <input name="telephone" type="text"  class="form-control" placeholder="Alpa" value="<?php echo $rekap_hadir['alpa'];?>" disabled="disabled">
								                    </div>
								                  </div>
								              </div>
								            </div>
								          </div>
								        </div>
								        
								        <br/>
								        <div class="row">
                            <div class="col-md-6">
                                <h4>Detail&nbsp;<span class="semi-bold"><?php echo lang('att_subheading');?></span></h4>
                            </div>
                        </div>
                        <div class="table-responsive">   
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><?php echo (is_admin())?anchor($filename.'/index/nik'.$s_nik.'/bln'.$s_bulan.'/thn'.$s_tahun.'/nik/'.(($sort_order == 'asc' && $sort_by == 'nik') ? 'desc' : 'asc').'/'.$limit, 'Karyawan'):'Karyawan';?></th>
                                    <th><?php echo (is_admin())?anchor($filename.'/index/nik'.$s_nik.'/bln'.$s_bulan.'/thn'.$s_tahun.'/date_full/'.(($sort_order == 'asc' && $sort_by == 'date_full') ? 'desc' : 'asc').'/'.$limit, 'Tanggal'):'Tanggal';?></th>
                                    <th class="center">Hadir</th>
								                    <th class="center">OFF</th>
								                    <th class="center">Cuti</th>
								                    <th class="center">Izin</th>
								                    <th class="center">Sakit</th>
								                    <th class="center">Alpa</th>
								                    <th class="center">Terlambat</th>
								                    <th class="center">Scan Masuk</th>
								                    <th class="center">Scan Pulang</th>
								                    <?php if($this->ion_auth->is_admin()) {?> <th class="center">Action</th><?php }?>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
						                	$param=array("jh","off","cuti","ijin","sakit","alpa","terlambat","scan_masuk","scan_pulang");
						                	foreach($rekap->result_array() as $r) {
						                	?>
                            	<tr class="odd gradeX">
						                    <td><?php echo $r['first_name'];?></td>
						                    <td><?php echo $r['tanggal']." ".GetMonthFull(intval($r['bulan']))." ".$r['tahun'];?></td>
						                    <?php
						                    foreach($param as $key) {
						                    	if($key=="jh") {
						                    		if($r[$key] && !$r['terlambat']) echo "<td class='center'><i class='icon-ok'></i></td>";
						                    		else echo "<td class='center'></td>";
						                    	}
						                    	else if($key=="scan_masuk" || $key=="scan_pulang") {
						                    		if(!$r[$key]) $r[$key]="-";
						                    		echo "<td class='center'>".$r[$key]."</td>";
						                    	}
						                    	else if($r[$key]) echo "<td class='center'><i class='icon-ok'></i></td>";
						                    	else echo "<td class='center'></td>";
						                    }
						                    ?>
						                    
						                    <?php if($this->ion_auth->is_admin()) {?>
						                    <td valign="middle" class="center">
                                    <a href="<?php echo site_url($filename.'/detail/'.$r['id'])?>">
                                        <button type="button" class="btn btn-info btn-small" title="<?php echo lang('edit_button')?>"><i class="icon-paste"></i></button>
                                    </a>
                                </td>
                              	<?php }?>
						                  </tr>
						                  <?php
						                	}
						                	?>
                            </tbody>
                        </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 page_limit">
                                <?php echo form_open(uri_string());?>
                                <?php 
                                    $selectComponentData = array(
                                        10  => '10',
                                        25 => '25',
                                        50 =>'50',
                                        75 => '75',
                                        100 => '100',);
                                    $selectComponentJs = 'class="select2" onChange="this.form.submit()" id="limit"';
                                    echo "Per page: ".form_dropdown('limit', $selectComponentData, $limit, $selectComponentJs);
                                    //echo lang('found_subheading').'&nbsp;'.$rekap_all->num_rows().'&nbsp;'.lang('att_subheading');
                                ?>
                                <?php echo form_close();?>
                            </div>
                            <div class="col-md-10">
                                <ul class="pagination">
                                    <?php echo $halaman;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>

<script src="<?php echo base_url();?>assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/plugins/jquery-ricksaw-chart/js/raphael-min.js"></script> 
<script src="<?php echo base_url();?>assets/plugins/jquery-morris-chart/js/morris.min.js"></script>
<script>
/* Table initialisation */
$(document).ready(function() {	
	Morris.Donut({
	  element: 'donut-example',
	  data: [
		{label: "Hadir", value: <?php echo $rekap_hadir['hadir'];?>},
		{label: "Cuti", value: <?php echo $rekap_hadir['cuti'];?>},
		{label: "Sakit", value: <?php echo $rekap_hadir['sakit'];?>},
		{label: "Ijin", value: <?php echo $rekap_hadir['ijin'];?>},
		{label: "OFF", value: <?php echo $rekap_hadir['off'];?>},
		{label: "Alpa", value: <?php echo $rekap_hadir['alpa'];?>}
	  ],
	  colors:['#60bfb6','#91cdec','#eceff1','#f35958','#52A68B','#FAA56B']
	});
});
</script>