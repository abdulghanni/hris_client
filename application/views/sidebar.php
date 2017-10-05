<!-- BEGIN SIDEBAR -->
  <div class="page-sidebar" id="main-menu"> 
    <!-- BEGIN MINI-PROFILE -->
    <div class="user-info-wrapper"> 
      <div class="profile-wrapper">
        <img src="<?php
		
		if($s_photo && file_exists('./uploads/'.$u_folder.'/'.$s_photo)) {
        echo base_url().'uploads/'.$u_folder.'/80x80/'.$s_photo;
        }else{
        echo base_url().'assets/img/no-image.png';
        }
		?>" data-src="<?php echo assets_url('img/profiles/avatar.jpg'); ?>" data-src-retina="<?php echo assets_url('img/profiles/avatar2x.jpg'); ?>" width="69" height="69" />
      </div>
      <div class="user-info">
        <div class="greeting">Welcome</div>
        <div class="username" title="<?php echo lang('edit_button')?>"><a href="<?php echo site_url('auth/edit_user/'.$this->session->userdata('user_id'))?>"><?php echo get_nik($this->session->userdata('user_id')).' - '.$this->session->userdata('username')?></a></div>
        <div class="usergroup"><?=get_user_group($this->session->userdata('user_id'))?></div>
        <div class="status"><?php echo anchor(site_url('auth/logout'), lang('logout_link_label'), array('title' => lang('logout_link_label')));?></div>
        <br/> <br/>
      </div>
    </div>
    <!-- END MINI-PROFILE -->
  <!-- BEGIN SIDEBAR MENU --> 
    <ul>  
      <li class="start active "> 
        <a href="<?php echo base_url()?>"> <i class="icon-custom-home"></i> <span class="title">Halaman Depan</span> <span class="selected"></span> </a> 
      </li>      
      <!-- <li class=""> <a href="<?php echo site_url('attendance')?>"> <i class="icon-signin"></i> <span class="title">Kehadiran</span></a> -->
      <?php if(get_nik($this->session->userdata('user_id')) != 1){?><li class=""> <a href="<?php echo site_url('attendance_axapta')?>"> <i class="icon-signin"></i> <span class="title">Kehadiran (Axapta)</span></a><?php } ?>
      </li>
      <li class=""> <a href="javascript:;"> <i class="icon-plus-sign"></i> <span class="title">Form pengajuan</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          <?php if(is_spv($nik)||is_admin()||is_admin_bagian()):?><li > <a href="<?php echo site_url('form_recruitment')?>">Permintaan SDM</a></li><?php endif; ?>
          <!-- <li > <a href="<?php //echo site_url('person/payroll/'.$this->session->userdata('user_id'))?>">Slip gaji</a> </li> -->          
          <li > <a href="<?php echo site_url('form_promosi')?>">Promosi</a> </li>          
          <li > <a href="<?php echo site_url('form_demotion')?>">Demosi</a> </li>          
          <li > <a href="<?php echo site_url('form_rolling')?>">Mutasi</a> </li>    
          <li > <a href="<?php echo site_url('form_kenaikan_gaji')?>">Kenaikan Gaji</a> </li>    
          <li > <a href="<?php echo site_url('form_pengangkatan')?>">Pengangkatan</a> </li>    
          <li > <a href="<?php echo site_url('form_kontrak')?>">Perpanjangan Kontrak</a> </li>    
          <li > <a href="<?php echo site_url('form_pemutusan')?>">Pemutusan Kontrak</a> </li>    
          <li > <a href="<?php echo site_url('form_cuti')?>">Cuti</a> </li>
          <!--
          <li > <a href="<?php echo site_url('form_spd_dalam') ?>">Perjalanan dinas - dalam kota</a> </li>  
          <li > <a href="<?php echo site_url('form_spd_dalam_group') ?>">PJD - dalam kota (Group)</a> </li>         
          <li > <a href="<?php echo site_url('form_spd_luar') ?>">Perjalanan dinas - luar kota</a> </li>     
          <li > <a href="<?php echo site_url('form_spd_luar_group') ?>">PJD - luar kota (Group)</a> </li>
          -->   
          <li > <a href="<?php echo site_url('form_pjd') ?>">Perjalanan Dinas</a> </li>     
          <li > <a href="<?php echo site_url('form_pjd_training') ?>">Perjalanan Dinas Training/Meeting</a> </li>     
          <li > <a href="<?php echo site_url('form_absen')?>">Keterangan tidak absen</a> </li>
          <li > <a href="<?php echo site_url('form_tidak_masuk')?>">Izin tidak masuk</a> </li>
          <?php if(is_spv($nik)||is_admin()||is_admin_bagian()):?><li > <a href="<?php echo site_url('form_medical')?>">Kesehatan</a> </li><?php endif; ?>          
          <!--<li > <a href="<?php echo site_url('form_training')?>">Pelatihan</a> </li>-->       
          <li > <a href="<?php echo site_url('form_training_group')?>">Pelatihan</a> </li>
          <li > <a href="<?php echo site_url('form_resignment')?>">Pengunduran Diri</a> </li>
          <li > <a href="<?php echo site_url('form_phk')?>">PHK</a> </li>
          <li > <a href="<?php echo site_url('form_exit')?>">Rekomendasi Karyawan Keluar</a> </li>  
          <li > <a href="<?php echo site_url('form_template')?>">Form Template</a> </li>        
           </ul>
      </li>
      <?php if (is_spv($nik)||is_admin()):?>
      <?php //if (is_admin()):?>
      <li class=""> <a href="javascript:;"> <i class="icon-check"></i> <span class="title">Form Penilaian</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          <li > <a href="<?php echo site_url('competency/personal_assesment')?>">Personal Assesment</a></li>
          <li > <a href="<?php echo site_url('competency/form_penilaian')?>">Human Value Matrix</a></li>
          <li > <a href="<?php echo site_url('competency/form_kpi')?>">Monitoring KPI</a></li>
          <li > <a href="<?php echo site_url('competency/form_evaluasi_training')?>">Evaluasi Keefektifan Training</a></li>
          <li > <a href="<?php echo site_url('competency/kinerja_supporting')?>">Penilaian Kinerja Supporting</a></li>
        </ul>
      </li>   
    <?php endif;?>
    <?php if (is_admin() || is_admin_kompetensi()):?>
      <li class=""> <a href="javascript:;"> <i class="icon-cog"></i> <span class="title">Laporan</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          <li > <a href="<?php echo site_url('competency/monitoring_kpi')?>">Monitoring KPI Bulanan</a></li>
          <li > <a href="<?php echo site_url('competency/rekap_personal_assessment')?>">Rekapitulasi gap Kompetensi</a></li>
        </ul>
      </li>
      <?php endif;?>
      <!--<li class=""> <a href="javascript:;"> <i class="icon-custom-form"></i> <span class="title">Analisis & Laporan</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          <li > <a href="grids_simple.html">Laporan</a> </li>
          <li > <a href="grids_draggable.html">Analisa </a> </li>
        </ul>
      </li>
      <li class=""> <a href="javascript:;"> <i class="icon-cog"></i> <span class="title">Pengaturan</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          <li > <a href="tables.html">Pengelolaan akun</a> </li>
          <li > <a href="tables.html">Hak akses</a> </li>
          <li > <a href="datatables.html">Parameter pengaturan </a> </li>
        </ul>
      </li> -->
      <?php if(is_admin_inventaris()||is_admin()){?>
      <li class=""> <a href="javascript:;"> <i class="icon-cogs"></i> <span class="title">Setup perusahaan</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          <!--<li > <a href="<?php echo site_url('comp_session')?>">Company Session</a> </li>
          <li > <a href="<?php echo site_url('organization')?>">Organization</a> </li>
          <li > <a href="<?php echo site_url('position')?>">Position</a> </li>
          <li > <a href="<?php echo site_url('library_table')?>">Library Reference Table</a> </li>-->
          <?php if(is_admin_inventaris()):?><li ><a href="<?php echo site_url('inventory')?>"><i class="icon-briefcase"></i> Inventaris</a> </li><?php endif?>
          <?php if(is_admin()):?><li ><a href="<?php echo site_url('admin_khusus')?>"> Admin Khusus</a> </li><?php endif?>
          <?php if(is_admin()):?><li ><a href="<?php echo site_url('approval')?>"> Approval HRD</a> </li><?php endif?>
          <?php if(is_admin()):?><li ><a href="<?php echo site_url('approval_khusus')?>"> Approval Atasan Khusus</a> </li><?php endif?>
          <?php if(is_admin()):?><li ><a href="<?php echo site_url('biaya_pjd')?>"> Biaya PJD</a> </li><?php endif?>
          <?php if(is_admin()):?><li ><a href="<?php echo site_url('biaya_pjd_training')?>"> Biaya PJD Training/Meeting</a> </li><?php endif?>
          <?php if(is_admin()):?><li > <a href="<?php echo site_url('form_template')?>">Form Template</a> </li><?php endif?>
          <?php if(is_admin()):?><li ><a href="<?php echo site_url('auth/list_group')?>"> Group</a> </li><?php endif?>
          <?php if(is_admin()):?><li ><a href="<?php echo site_url('inventory_type')?>"> Inventaris</a> </li><?php endif?>
          <?php if(is_admin()):?><li ><a href="<?php echo site_url('notif_tambahan')?>"> Notifikasi Tambahan</a> </li><?php endif?>
          <?php if(is_admin()):?><li > <a href="<?php echo site_url('pengumuman')?>">Pengumuman</a> </li><?php endif?>
         
          <!--<?php if(is_admin()):?><li > <a href="<?php echo site_url('position')?>">Position</a> </li><?php endif?>-->
        </ul>
      </li>  
      <?php } ?>  
      <?php if (is_admin() || is_admin_kompetensi()):?>
      <li class=""> <a href="javascript:;"> <i class="icon-cogs"></i> <span class="title">Setup Kompetensi</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          
          <li > <a href="<?php echo site_url('competency_def')?>">Kompetensi</a></li>
          <li > <a href="<?php echo site_url('competency_group')?>">Kompetensi Tipe</a></li>
          <li > <a href="<?php echo site_url('competency_level')?>">Kompetensi Level</a></li>
          <li > <a href="<?php echo site_url('competency_penilaian')?>">Kompetensi Standar</a></li>
          <li > <a href="<?php echo site_url('competency_dasar')?>">Kompetensi Dasar</a></li>
          <li > <a href="<?php echo site_url('competency_kedisiplinan')?>">Kompetensi Kedisiplinan</a></li>
          <li > <a href="<?php echo site_url('competency/mapping_indikator')?>">Mapping Indikator</a></li>
          <li > <a href="<?php echo site_url('competency/mapping_standar')?>">Mapping Standar</a></li>
          <li > <a href="<?php echo site_url('competency/mapping_kpi')?>">Mapping KPI</a></li>
          <li > <a href="<?php echo site_url('competency_kinerja_supporting_config')?>">Sesi penilaian</a></li>
        </ul>
      </li>
      <?php endif;?>

      <?php if (is_admin() || is_admin_kompetensi()):?>
      <li class=""> <a href="javascript:;"> <i class="icon-cogs"></i> <span class="title">Setup Training</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          
           <?php if(is_admin()||is_admin_kompetensi()):?><li > <a href="<?php echo site_url('vendor')?>">Vendor</a> </li><?php endif?>
          <?php if(is_admin()||is_admin_kompetensi()):?><li > <a href="<?php echo site_url('form_training_notif')?>">Notifikasi training</a> </li><?php endif?>
          <?php if(is_admin()||is_admin_kompetensi()):?><li > <a href="<?php echo site_url('training')?>">Training</a> </li><?php endif?>
        </ul>
      </li>
      <?php endif;?>

    </ul>
    <div class="row">
            <div class="col-md-12">
    <p style="font-size:10px;padding-left:20px;">Page rendered in <?= $this->benchmark->elapsed_time()?> Seconds</p></div>
        </div>
    <a href="#" class="scrollup">Scroll</a>
    <div class="clearfix"></div>
    <!-- END SIDEBAR MENU --> 
  </div>
  <!-- END SIDEBAR -->