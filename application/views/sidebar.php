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
        <div class="username" title="<?php echo lang('edit_button')?>"><a href="<?php echo site_url('auth/edit_user/'.$this->session->userdata('user_id'))?>"><?php echo $this->session->userdata('username')?></a></div>
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
      <li class=""> <a href="<?php echo site_url('attendance')?>"> <i class="icon-signin"></i> <span class="title">Kehadiran</span></a>
      <?php if(!is_admin()){?><li class=""> <a href="<?php echo site_url('attendance_axapta')?>"> <i class="icon-signin"></i> <span class="title">Kehadiran (Axapta)</span></a><?php } ?>
      </li>
      <li class=""> <a href="javascript:;"> <i class="icon-plus-sign"></i> <span class="title">Form pengajuan</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          <li > <a href="<?php echo site_url('form_cuti')?>">Cuti</a> </li>
          <!--
		  <li > <a href="<?php echo site_url('form_cuti/approval_spv')?>">Approval Supervisor</a> </li>
          <li > <a href="<?php echo site_url('form_cuti/approval_kbg')?>">Approval Kabagian</a> </li>
          <li > <a href="<?php echo site_url('form_cuti/approval_hr')?>">Approval HR</a> </li>
		  -->
          <li > <a href="<?php echo site_url('form_spd_dalam') ?>">Perjalanan dinas - dalam kota</a> </li>         
          <li > <a href="<?php echo site_url('form_spd_dalam_group') ?>">PJD - dalam kota (Group)</a> </li>         
          <li > <a href="<?php echo site_url('form_spd_luar') ?>">Perjalanan dinas - luar kota</a> </li>     
          <li > <a href="<?php echo site_url('form_spd_luar_group') ?>">PJD - luar kota (Group)</a> </li>     
          <li > <a href="<?php echo site_url('form_absen')?>">Keterangan tidak absen</a> </li>          
          <li > <a href="<?php echo site_url('form_training')?>">Training</a> </li>          
          <li > <a href="<?php echo site_url('form_training_group')?>">Training (Group)</a> </li>          
          <?php if(is_admin_bagian()||is_admin()):?><li > <a href="<?php echo site_url('form_medical')?>">Medical</a> </li><?php endif; ?>
          <li > <a href="<?php echo site_url('form_promosi')?>">Promosi</a> </li>          
          <li > <a href="<?php echo site_url('form_demolition')?>">Demolition</a> </li>          
          <li > <a href="<?php echo site_url('form_rolling')?>">Rolling</a> </li>        
          <li > <a href="<?php echo site_url('form_exit')?>">Exit clearance</a> </li>          
          <!--<li > <a href="form_status.html">Status karyawan</a> </li> -->          
          <!--<li > <a href="<?php echo site_url('form_recruitment')?>">Retirement</a> </li> -->         
          <li > <a href="<?php echo site_url('form_resignment')?>">Resignment</a> </li>          
          <?php if(is_spv($nik)||is_admin()||is_admin_bagian()):?><li > <a href="<?php echo site_url('form_recruitment')?>">Recruitment</a></li><?php endif; ?>
        </ul>
      </li>
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
      <?php if(is_admin_bagian()||is_admin()){?>
      <li class=""> <a href="javascript:;"> <i class="icon-group"></i> <span class="title">Manage Company</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          <!--<li > <a href="<?php echo site_url('comp_session')?>">Company Session</a> </li>
          <li > <a href="<?php echo site_url('organization')?>">Organization</a> </li>
          <li > <a href="<?php echo site_url('position')?>">Position</a> </li>
          <!--<li > <a href="<?php echo site_url('library_table')?>">Library Reference Table</a> </li>-->
          <?php if(is_admin_bagian()):?><li ><a href="<?php echo site_url('inventory')?>"><i class="icon-briefcase"></i> Inventaris</a> </li><?php endif?>
          <?php if(is_admin()):?><li ><a href="<?php echo site_url('approval')?>"> Approval</a> </li><?php endif?>
        </ul>
      </li>  
      <?php } ?>    
    </ul>
    <a href="#" class="scrollup">Scroll</a>
    <div class="clearfix"></div>
    <!-- END SIDEBAR MENU --> 
  </div>
  <!-- END SIDEBAR -->