<div class="row row-offcanvas row-offcanvas-right">
  <div class="col-xs-12 col-sm-12 col-md-12">
    <p class="pull-right visible-xs">
      <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
    </p>
    <div class="row sidebar">
      <div class="col-2 col-sm-2 col-lg-2">
          <ul>
            <li>
              Vacancies
              <ul>
                <?php if($kategori) { ?>
                  <?php foreach ($kategori as $k) { ?>
                    <li><?php echo '<a href="'.site_url('karir/c/'.$k['id']).'">'.$k['title'].'</a>'?></li>
                  <?php } ?>
                <?php } ?>
                
              </ul>
            </li>
            <?php if($this->session->userdata('login') == TRUE){ ?>
              <li><?php echo '<a href="'.site_url('profilesimple/').'">Edit Profile</a>'; ?></li>
              <li><?php echo '<a href="'.site_url('member/myvacancy').'">My list application</a>'; ?></li>
              <li><a href="#">Aptitude Test</a> </li>
            <?php } ?>
          </ul>
      </div>
      <div class="col-10 col-sm-10 col-lg-10">
        <div class="row">
           <div class="col-12 col-sm-12 col-lg-12" style="padding-left:0px;">
            <h2>My Job List</h2>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
