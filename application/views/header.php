<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse "> 
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="navbar-inner">
    <div class="header-seperation"> 
        <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">    
          <li class="dropdown"> 
          <a id="main-menu-toggle" href="#main-menu"  class="" > <div class="iconset top-menu-toggle-white"></div> </a> 
        </li>        
        </ul>
      <!-- BEGIN LOGO -->   
      <a href="index.html">
        <img src="<?php echo assets_url('img/logo.png'); ?>" class="logo"  data-src="<?php echo assets_url('img/logo.png'); ?>" data-src-retina="<?php echo assets_url('img/logo2x.png'); ?>" width="106" height="21"/>
      </a>
      <!-- END LOGO --> 
      <ul class="nav pull-right notifcation-center">    
        <li class="dropdown" id="header_task_bar"> 
          <a href="<?php echo base_url()?>" class="dropdown-toggle active" data-toggle=""> <div class="iconset top-home"></div> </a> 
        </li> 
        <li class="dropdown" id="header_inbox_bar" > 
          <a href="<?php echo site_url('email')?>" class="dropdown-toggle" > <div class="iconset top-messages"></div>  <span class="badge" id="msgs-badge"><?php echo $email_unread; ?></span></a>
        </li>
      </ul>
    </div>
    <!-- END RESPONSIVE MENU TOGGLER --> 
    <div class="header-quick-nav" > 
      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="pull-left"> 
          <ul class="nav quick-section">
            <li class="quicklinks"> 
              <a href="#" class="" id="layout-condensed-toggle" ><div class="iconset top-menu-toggle-dark"></div> </a> 
            </li>        
          </ul>
          <!--<ul class="nav quick-section">
             <li class="quicklinks"> <a href="#" class="" ><div class="iconset top-reload"></div> </a> </li> 
            <li class="quicklinks"> <span class="h-seperate"></span></li>
            <li class="quicklinks"> <a href="#" class="" ><div class="iconset top-tiles"></div></a> </li>
            <div class="input-prepend inside search-form no-boarder">
                <span class="add-on"> <a href="#" class="" ><div class="iconset top-search"></div></a></span>
                <input name="" type="text"  class="no-boarder " placeholder="Pencarian" style="width:250px;">
            </div> 
          </ul>-->
      </div>

      <!-- BEGIN CHAT TOGGLER -->
      <div class="pull-right">
        <ul class="nav quick-section ">
        <li class="quicklinks"> <span class="h-seperate"></span></li>
          <li class="quicklinks"> <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
            <div class="iconset top-settings-dark "></div>
            </a>
            <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
              <li><a href="<?php echo site_url('auth/edit_user/'.$this->session->userdata('user_id'))?>"><i class="icon-fixed-width icon-pencil"></i> Edit Profile</a></li>
              <li><a href="<?php echo site_url('email')?>"><i class="icon-fixed-width icon-envelope"></i> Mail  <span class="badge badge-important animated bounceIn"><?php echo $email_unread; ?></span></a></li>
              
              <li class="divider"></li>
              <li><a href="<?php echo site_url('auth/logout')?>"><i class="icon-fixed-width icon-signout"></i> Sign Out</a></li>
            </ul>
          </li>

          <li class="quicklinks"> <span class="h-seperate"></span></li>
        </ul>
      </div>
      <!-- END CHAT TOGGLER -->

      <!-- END TOP NAVIGATION MENU -->
    </div> 
    <!-- END TOP NAVIGATION MENU --> 
  </div>
  <!-- END TOP NAVIGATION BAR --> 
</div>
<!-- END HEADER -->
<!-- <header class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?php echo site_url(); ?>" class="navbar-brand">CodeIgniter Skeleton</a>
        </div>
        <nav class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo site_url(); ?>">Home</a></li>
                <li><a href="<?php echo site_url('addons'); ?>">Add-ons</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Example <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('todo'); ?>">Todo</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a target="_blank" href="https://github.com/anvoz/CodeIgniter-Skeleton">Github</a></li>
            </ul>
        </nav>
    </div>
</header> -->