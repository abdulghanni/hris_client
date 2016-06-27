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
      <li class=""> <a href="<?php echo site_url('attendance')?>"> <i class="icon-signin"></i> <span class="title">Kehadiran</span></a>
      <?php if(get_nik($this->session->userdata('user_id')) != 1){?><li class=""> <a href="<?php echo site_url('attendance_axapta')?>"> <i class="icon-signin"></i> <span class="title">Kehadiran (Axapta)</span></a><?php } ?>
      </li>
      <li class=""> <a href="javascript:;"> <i class="icon-plus-sign"></i> <span class="title">Form pengajuan</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          <?php if(is_spv($nik)||is_admin()||is_admin_bagian()):?><li > <a href="<?php echo site_url('form_recruitment')?>">Permintaan SDM</a></li><?php endif; ?>
          <li > <a href="<?php echo site_url('form_promosi')?>">Promosi</a> </li>          
          <li > <a href="<?php echo site_url('form_demotion')?>">Demosi</a> </li>          
          <li > <a href="<?php echo site_url('form_rolling')?>">Mutasi</a> </li>    
          <li > <a href="<?php echo site_url('form_pengangkatan')?>">Pengangkatan</a> </li>    
          <li > <a href="<?php echo site_url('form_kontrak')?>">Perpanjangan Kontrak</a> </li>    
          <li > <a href="<?php echo site_url('form_cuti')?>">Cuti</a> </li>
          <!--
          <li > <a href="<?php echo site_url('form_spd_dalam') ?>">Perjalanan dinas - dalam kota</a> </li>  
          <li > <a href="<?php echo site_url('form_spd_dalam_group') ?>">PJD - dalam kota (Group)</a> </li>         
          <li > <a href="<?php echo site_url('form_spd_luar') ?>">Perjalanan dinas - luar kota</a> </li>     
          <li > <a href="<?php echo site_url('form_spd_luar_group') ?>">PJD - luar kota (Group)</a> </li>
          -->   
          <li > <a href="<?php echo site_url('form_pjd') ?>">Perjalanan Dinas</a> </li>     
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
      <li class=""> <a href="javascript:;"> <i class="icon-group"></i> <span class="title">Pengaturan perusahaan</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          <!--<li > <a href="<?php echo site_url('comp_session')?>">Company Session</a> </li>
          <li > <a href="<?php echo site_url('organization')?>">Organization</a> </li>
          <li > <a href="<?php echo site_url('position')?>">Position</a> </li>
          <li > <a href="<?php echo site_url('library_table')?>">Library Reference Table</a> </li>-->
          <?php if(is_admin_inventaris()):?><li ><a href="<?php echo site_url('inventory')?>"><i class="icon-briefcase"></i> Inventaris</a> </li><?php endif?>
          <?php if(is_admin()):?><li ><a href="<?php echo site_url('admin_khusus')?>"> Admin Khusus</a> </li><?php endif?>
          <?php if(is_admin()):?><li ><a href="<?php echo site_url('approval')?>"> Approval HRD</a> </li><?php endif?>
          <?php if(is_admin()):?><li ><a href="<?php echo site_url('approval_khusus')?>"> Approval Atasan Khusus</a> </li><?php endif?>
          <?php if(is_admin()):?><li > <a href="<?php echo site_url('form_template')?>">Form Template</a> </li><?php endif?>
          <?php if(is_admin()):?><li ><a href="<?php echo site_url('auth/list_group')?>"> Group</a> </li><?php endif?>
          <?php if(is_admin()):?><li ><a href="<?php echo site_url('inventory_type')?>"> Inventaris</a> </li><?php endif?>
          <?php if(is_admin()):?><li ><a href="<?php echo site_url('notif_tambahan')?>"> Notifikasi Tambahan</a> </li><?php endif?>
          <?php if(is_admin()):?><li > <a href="<?php echo site_url('pengumuman')?>">Pengumuman</a> </li><?php endif?>
          <!--<?php if(is_admin()):?><li > <a href="<?php echo site_url('position')?>">Position</a> </li><?php endif?>-->
        </ul>
      </li>  
      <?php } ?>  
      <?php if (is_admin()):?>
      <li class=""> <a href="javascript:;"> <i class="icon-group"></i> <span class="title">Kompetensi</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          <li > <a href="<?php echo site_url('competency_assessment')?>">Kompetensi Assessment</a></li>
          <li > <a href="<?php echo site_url('competency_behaviour')?>">Kompetensi Behaviour</a></li>
          <li > <a href="<?php echo site_url('competency_def')?>">Kompetensi Def</a></li>
          <li > <a href="<?php echo site_url('competency_group')?>">Kompetensi Group</a></li>
          <li > <a href="<?php echo site_url('competency_level')?>">Kompetensi Level</a></li>
        </ul>
      </li>  
    <?php endif;?>
    </ul>
    <a href="#" class="scrollup">Scroll</a>
    <div class="clearfix"></div>
    <!-- END SIDEBAR MENU --> 
  </div>
  <!-- END SIDEBAR -->