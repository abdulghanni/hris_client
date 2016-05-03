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
            <h3><?php echo lang('list_of_subheading')?>&nbsp;<span class="semi-bold">Attendance(Axapta)</span></h3> 
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
                        <?php echo form_open(site_url('attendance_axapta/search'))?>
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
                        <?php echo form_close()?>
								        
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
                                    <th>NIK</th>
                                    <th>NAME</th>
                                    <th class="center">ATTENDANCE DATE</th>
                                    <th class="center">ATTENDANCE STATUS</th>
                                    <th class="center">ABSENSCE STATUS</th>
                                    <th class="center">CLOCK IN</th>
                                    <th class="center">CLOCK OUT</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($user_att)){
                            	for($i=0;$i<sizeof($user_att);$i++):?>
                            	<tr class="odd gradeX">
						                    <td><?php echo $user_att[$i]['EMPLID'];?></td>
						                    <td><?php echo get_name($user_att[$i]['EMPLID']);?></td>
						                    <td><?php echo dateIndo($user_att[$i]['ATTENDANCEDATE'])?></td>
						                    <td>
						                    	<?php echo ($user_att[$i]['ATTENDANCESTATUS'] === 1) ? 'PRESENCE' : (($user_att[$i]['ATTENDANCESTATUS']===2) ? 'Absence' : '' )?>
						                    </td>
						                    <td><?php echo get_status($user_att[$i]['ABSENCESTATUS'])?></td>
						                    <td><?php echo ($user_att[$i]['CLOCKIN'] != 0)?date('H:i:s', $user_att[$i]['CLOCKIN']) : '-';?></td>
						                    <td><?php echo ($user_att[$i]['CLOCKOUT'] != 0)?date('H:i:s', $user_att[$i]['CLOCKOUT']) : '-';?></td>
						                    
						                    <?php if($this->ion_auth->is_admin()) {?>
						                    <td valign="middle" class="center">
                                    <a href="<?php //echo site_url($filename.'/detail/'.$r['id'])?>">
                                        <button type="button" class="btn btn-info btn-small" title="<?php echo lang('edit_button')?>"><i class="icon-paste"></i></button>
                                    </a>
                                </td>
                              	<?php }?>
						        </tr>
						       <?php endfor;}?>
                            </tbody>
                        </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 page_limit">
                                <!--<?php echo form_open(uri_string());?>
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
                                    <?php echo $halaman;?>-->
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

<?php

function get_status($id){
    switch ($id) {
        case '15':
            return "Pulang Cepat";
            break;
        case '2':
            return "Libur";
            break;
        case '3':
            return "Kuliah";
            break;
        case '5':
            return "Cuti";
            break;
        case '6':
            return "PJD";
            break;
        case '8':
            return "OFF";
            break;
        case '9':
            return "Alpha";
            break;
        case '12':
            return "Sakit";
            break;
        case '13':
            return "Izin";
            break;
        case '14':
            return "Tidak Lengkap";
            break;
        case '18':
            return "Telat";
            break;
        
        default:
            return "-";
            break;
    }
}