 
  <!-- BEGIN PAGE -->
  <div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>

  <div class="content">    
      <div class="tabbable tabs-top">
        <ul class="nav nav-tabs" id="tab-1">
          <li><a href="<?php echo site_url('email')?>">Inbox</a></li>
          <li><a href="#">Sent</a></li>
          <li  class="active"><a href="<?php echo site_url('email/approve')?>">List Approve</a></li>
        </ul>
      <div class="tab-content">

        <!-- tabcertificate -->
        <div class="tab-pane active" id="tabsent">
          
                  <div class="table-responsive">
                            <table class="table table-bordered table-hover table-full-width " id="table" style="width: 100%;">
                                <thead>
                                     <tr>
                                     <th width="5%">No</th>
                                      <th width="5%">Nama App</th>
                                      <th width="5%">Date</th>
                                      <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $no=0;
                                foreach ($competency_form_kpi as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Form KPI</td>
                                  <td><?php echo dateIndo($key->created_on) ?></td>
                                  <td><a href="<?php echo base_url()."competency/form_kpi/approve/".$key->organization_id."/".$key->comp_session_id."/".$key->id."/".$key->competency_mapping_kpi_detail_id."/".$key->kpi_user_id ?>">Detail</a></td>
                                </tr>
                                <?php }
                                foreach ($form_penilaian as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Form Penilaian</td>
                                  <td><?php echo dateIndo($key->date_app) ?></td>
                                  <td><a href="<?php echo base_url()."competency/form_penilaian/approve/".$key->id ?>">Detail</a></td>
                                </tr>
                                <?php }
                                foreach ($kinerja_supporting as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Kinerja Supporting</td>
                                  <td><?php echo dateIndo($key->date_app) ?></td>
                                  <td><a href="<?php echo base_url()."competency/kinerja_supporting/approve/".$key->id ?>">Detail</a></td>
                                </tr>
                                <?php } 
                                foreach ($mapping_indikator as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Mapping Indikator</td>
                                  <td><?php echo dateIndo($key->date_app) ?></td>
                                  <td><a href="<?php echo base_url()."competency/mapping_indikator/approve/".$key->id ?>">Detail</a></td>
                                </tr>
                                <?php }
                                foreach ($mapping_standar as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Mapping Standar</td>
                                  <td><?php echo dateIndo($key->date_app) ?></td>
                                  <td><a href="<?php echo base_url()."competency/mapping_standar/approve/".$key->id ?>">Detail</a></td>
                                </tr>
                                <?php }   
                                foreach ($mapping_kpi as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Mapping KPI</td>
                                  <td><?php echo dateIndo($key->date_app) ?></td>
                                  <td><a href="<?php echo base_url()."competency/mapping_kpi/approve/".$key->id ?>">Detail</a></td>
                                </tr>
                                <?php }   
                                foreach ($monitoring_kpi as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Monitoring KPI</td>
                                  <td><?php echo dateIndo($key->date_app) ?></td>
                                  <td><a href="<?php echo base_url()."competency/monitoring_kpi/approve/".$key->id ?>">Detail</a></td>
                                </tr>
                                <?php }   
                                foreach ($personal_assesment as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Persnonal Assesment</td>
                                  <td><?php echo dateIndo($key->date_app) ?></td>
                                  <td><a href="<?php echo base_url()."competency/personal_assesment/approve/".$key->id ?>">Detail</a></td>
                                </tr>
                                <?php }   
                                foreach ($cuti1 as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Form Cuti</td>
                                  <td><?php echo dateIndo($key->created_on) ?></td>
                                  <td><a href="<?php echo base_url()."form_cuti/detail/".$key->id ?>">Detail</a></td>
                                </tr>
                                <?php }  
                                foreach ($cuti2 as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Form Cuti</td>
                                  <td><?php echo dateIndo($key->created_on) ?></td>
                                  <td><a href="<?php echo base_url()."form_cuti/detail/".$key->id ?>">Detail</a></td>
                                </tr>
                                <?php } foreach ($cuti3 as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Form Cuti</td>
                                  <td><?php echo dateIndo($key->created_on) ?></td>
                                  <td><a href="<?php echo base_url()."form_cuti/detail/".$key->id ?>">Detail</a></td>
                                </tr>
                                <?php } 
                                foreach ($izin1 as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Form Izin</td>
                                  <td><?php echo dateIndo($key->created_on) ?></td>
                                  <td><a href="<?php echo base_url()."form_tidak_masuk/detail/".$key->id ?>">Detail</a></td>
                                </tr>
                                <?php }  
                                foreach ($izin2 as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Form Izin</td>
                                  <td><?php echo dateIndo($key->created_on) ?></td>
                                  <td><a href="<?php echo base_url()."form_tidak_masuk/detail/".$key->id ?>">Detail</a></td>
                                </tr>
                                <?php } 
                                foreach ($perjalanan_dinas1 as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Perjalanan Dinas</td>
                                  <td><?php echo dateIndo($key->created_on) ?></td>
                                  <td><a href="<?php echo base_url()."form_pjd/submit/".$key->id ?>">Detail</a></td>
                                </tr>
                                <?php } 
                                foreach ($perjalanan_dinas2 as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Perjalanan Dinas</td>
                                  <td><?php echo dateIndo($key->created_on) ?></td>
                                  <td><a href="<?php echo base_url()."form_pjd/submit/".$key->id ?>">Detail</a></td>
                                </tr>
                                <?php } 
                                foreach ($perjalanan_dinas3 as $key) {
                                $no++;
                                ?>
                                <tr>
                                  <td><?php echo $no ?></td>
                                  <td>Perjalanan Dinas</td>
                                  <td><?php echo dateIndo($key->created_on) ?></td>
                                  <td><a href="<?php echo base_url()."form_pjd/submit/".$key->id ?>">Detail</a></td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>       
      </div>
    </div>
      <!-- END PAGE --> 
    </div>
  </div>
<script>

  
</script>
    