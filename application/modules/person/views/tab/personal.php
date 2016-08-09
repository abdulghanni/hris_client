 <div class="row column-seperation row-seperation" style="padding-bottom: 30px;">
    	<div class="col-md-8">
          <h4>Employee Identity
		  
		  
		  </h4>
		  
            <div class="row form-row">
              <div class="col-md-3">
                <?php echo lang('register_nik_label', 'nik');?>
              </div>
              <div class="col-md-9">
                <input type="text" class="form-control" value="<?php echo $nik?>" disabled="disabled">           
              </div>
            </div>
            <div class="row form-row">
             <div class="col-md-3">
               <?php echo lang('register_firstname_label', 'firstname');?>
              </div>
              <div class="col-md-9">
                <input type="text" class="form-control" value="<?php echo $first_name?>" disabled="disabled">
              </div>
            </div>
            <div class="row form-row">
             <div class="col-md-3">
               <?php echo lang('register_lastname_label', 'lasttname');?>
              </div>
              <div class="col-md-9">
                <input type="text" class="form-control" value="<?php echo $last_name?>" disabled="disabled">
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-3">
                <?php echo lang('register_dob_label', 'dob');?>
              </div>
              <div class="col-md-9">
	               <input type="text" class="form-control" value="<?php echo dateIndo($bod)?>" disabled="disabled">
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-3">
                <?php echo lang('register_marital_label', 'marital');?>
              </div>
              <div class="col-md-9">
              	<input type="text" class="form-control" value="<?php echo $marital?>" disabled="disabled">
              </div>
            </div>
			<div class="row form-row">
              <div class="col-md-3">
                <?php echo lang('aviva_number', 'aviva');?>
              </div>
              <div class="col-md-9">
              	<input type="text" class="form-control" value="<?php echo $aviva?>" disabled="disabled">
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-3">
                <?php echo 'BPJS Tenaga Kerja';?>
              </div>
              <div class="col-md-9">
              	<input type="text" class="form-control" value="<?php echo $bpjs_kerja?>" disabled="disabled">
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-3">
                <?php echo 'BPJS Kesehatan';?>
              </div>
              <div class="col-md-9">
              	<input type="text" class="form-control" value="<?php echo $bpjs_kesehatan?>" disabled="disabled">
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-3">
                <?php echo 'Bumida';?>
              </div>
              <div class="col-md-9">
              	<input type="text" class="form-control" value="<?php echo $bumida?>" disabled="disabled">
              </div>
            </div>
			
			<div class="row form-row">
              <div class="col-md-3">
                <?php echo lang('ktp_number', 'ktp');?>
              </div>
              <div class="col-md-9">
              	<input type="text" class="form-control" value="<?php echo $ktp?>" disabled="disabled">
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-3">
                KTP Valid Date
              </div>
              <div class="col-md-9">
              	<input type="text" class="form-control" value="<?php echo dateIndo($ktp_valid_date)?>" disabled="disabled">
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-3">
                <?php echo 'NPWP';?>
              </div>
              <div class="col-md-9">
              	<input type="text" class="form-control" value="<?php echo $npwp?>" disabled="disabled">
              </div>
            </div>
			
			<div class="row form-row">
              <div class="col-md-3">
                <?php echo lang('tax_category', 'tax');?>
              </div>
              <div class="col-md-9">
              	<input type="text" class="form-control" value="<?php echo $tax?>" disabled="disabled">
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-3">
                <?php echo 'Scan Kartu Keluarga';?>
              </div>
              <div class="col-md-3">
              	<?php if($s_kk && file_exists('./uploads/'.$u_folder.'/kk/'.$s_kk)) {?>
                <a href="<?php echo base_url()?>uploads/<?php echo $u_folder.'/kk/'.$s_kk?>" rel="prettyPhoto"><img alt="" height="80" width="80" src="<?php echo base_url()?>uploads/<?php echo $u_folder.'/kk/'.$s_kk?>" /></a>
                <?php }else{ ?>
                <img alt="" src="<?php echo base_url()?>assets/img/no-file.png" height="80" width="80">
                <?php } ?>
              </div>

              <div class="col-md-3">
                <?php echo 'Scan Akta Kelahiran';?>
              </div>
              <div class="col-md-3">
              	<?php if($s_akta && file_exists('./uploads/'.$u_folder.'/akta/'.$s_akta)) {?>
                <a href="<?php echo base_url()?>uploads/<?php echo $u_folder.'/akta/'.$s_akta?>" rel="prettyPhoto"><img alt="" height="80" width="80" src="<?php echo base_url()?>uploads/<?php echo $u_folder.'/akta/'.$s_akta?>"></a>
                <?php }else{ ?>
                <img alt="" src="<?php echo base_url()?>assets/img/no-file.png" height="80" width="80">
                <?php } ?>
              </div>

            </div>

        </div>
        

      	<div class="col-md-4">
      		<div class="grid simple" style="margin-bottom : 0px !important;">
           		<h4>Picture</h4>
        	</div>
        	 <?php if($s_photo && file_exists('./uploads/'.$u_folder.'/'.$s_photo)) {?>
                        <img alt="" src="<?php echo base_url()?>uploads/<?php echo $u_folder.'/225x225/'.$s_photo?>">
                        <?php }else{ ?>
                        <img alt="" src="<?php echo base_url()?>assets/img/no-image-big.png" class="img-responsive">
                        <?php } ?>
     	</div>
    </div>

    
    <div class="row row-seperation" style="margin-top: 20px;padding-bottom: 30px;">
    	<div class="col-md-12">
    		<h4>Employement</h4>
    		<div class="row form-row">
        		<div class="col-md-3">
                  <label class="form-label"><?php echo lang('seniority_date')?></label>
                </div>
               	<div class="col-md-9">
                	<input type="text" class="form-control" value="<?php echo dateIndo($seniority_date)?>" disabled="disabled">
              	</div>
        	</div>
        	<div class="row form-row">
        		<div class="col-md-3">
                  <label class="form-label"><?php echo lang('position')?></label>
                </div>
               	<div class="col-md-9">
              	<input type="text" class="form-control" value="<?php echo $position?>" disabled="disabled">
                </div>
        	</div>

        	<div class="row form-row">
        		<div class="col-md-3">
                  <label class="form-label"><?php echo lang('organization')?></label>
                </div>
               	<div class="col-md-9">
              	<input type="text" class="form-control" value="<?php echo $organization?>" disabled="disabled">
                </div>
        	</div>

        	<div class="row form-row">
        		<div class="col-md-3">
                  <label class="form-label"><?php echo 'Business Unit'?></label>
                </div>
               	<div class="col-md-9">
              	<input type="text" class="form-control" value="<?php echo $bu?>" disabled="disabled">
                </div>
        	</div>

        	<div class="row form-row">
        		<div class="col-md-3">
                  <label class="form-label"><?php echo lang('empl_status')?></label>
                </div>
                <div class="col-md-9">
              		<input type="text" class="form-control" value="<?php 
					if($empl_status == 1){
						echo 'Probation';
					}elseif($empl_status == 2){
						echo 'Permanent';
					}elseif($empl_status == 3){
						echo 'Contract';
					}elseif($empl_status == 4){
						echo 'Part Time';
					}elseif($empl_status == 5){
						echo 'Expat Contract';
					}elseif($empl_status == 6){
						echo 'Sick';
					}elseif($empl_status == 7){
						echo 'UPLeave';
					}elseif($empl_status == 8){
						echo 'Ahli';
					}elseif($empl_status == 9){
						echo 'Daily Contract';
					}elseif($empl_status == 10){
						echo 'Daily Permanent';
					}elseif($empl_status == 11){
						echo 'Job Training';
					}else{
						echo '-';
					}
					
					?>" disabled="disabled">
                </div>
        	</div>
        	<div class="row form-row">
        		<div class="col-md-3">
                  <label class="form-label"><?php echo lang('employee_status')?></label>
                </div>
                <div class="col-md-9">
              		<input type="text" class="form-control" value="<?php

									if($employee_status == 0){
										echo 'Work Center';
									}elseif($employee_status == 1){
										echo 'Employed';
									}elseif($employee_status == 2){
										echo 'Terminated';
									}elseif($employee_status == 3){
										echo 'Honorarium';
									}else{
										echo '-';
									}
									
									?>" disabled="disabled">
                </div>
        	</div>
        	<div class="row form-row">
        		<div class="col-md-3">
                  <label class="form-label"><?php echo lang('cost_center')?></label>
                </div>
                <div class="col-md-9">
                	<input type="text" class="form-control" value="<?php echo $cost_center?>" disabled="disabled">
              	</div>
        	</div>
        	<div class="row form-row">
        		<div class="col-md-3">
                  <label class="form-label"><?php echo lang('position_group')?></label>
                </div>
                <div class="col-md-9">
              		<input type="text" class="form-control" value="<?php echo $position_group?>" disabled="disabled">
                </div>
        	</div>
        	<div class="row form-row">
        		<div class="col-md-3">
                  <label class="form-label"><?php echo lang('grade')?></label>
                </div>
                <div class="col-md-9">
              		<input type="text" class="form-control" value="<?php echo $grade?>" disabled="disabled">
                </div>
        	</div>
        	<div class="row form-row">
        		<div class="col-md-3">
                  <label class="form-label"><?php echo lang('resign_reason')?></label>
                </div>
                <div class="col-md-9">
              		<input type="text" class="form-control" value="<?php echo $resign_reason?>" disabled="disabled">
                </div>
        	</div>
        	<div class="row form-row">
        		<div class="col-md-3">
                  <label class="form-label"><?php echo lang('active_inactive')?></label>
                </div>
                <div class="col-md-9">
              		<input type="text" class="form-control" value="<?php
          															 if($active_inactive==0){
          															 	echo 'Active';
          															 }elseif($active_inactive == 1){
          															 	echo 'Inactive';
          															 }else{
          															 	echo 'Active By Term';
          															 }?>"  disabled="disabled">
                </div>
        	</div>
        	
    	</div>
    </div>
    
    <div class="row " style="margin-top:20px;">
    	<div class="col-md-12">
    		<h4>CONTACT</h4>
    		<div class="row form-row">
        		<div class="col-md-3">
                  <?php echo lang('edit_user_mobile_phone_label', 'phone');?>
                </div>
                <div class="col-md-9">
                	<input type="text" class="form-control" value="<?php echo $phone?>" disabled="disabled">
              	</div>
        	</div>
        	<div class="row form-row">
        		<div class="col-md-3">
                  <?php echo lang('create_user_email_label', 'email');?>
                </div>
                <div class="col-md-9">
                	<input class="form-control" type="text" value="<?php echo $email?>" disabled="disabled">
              	</div>
        	</div>
        	<div class="row form-row">
        		<div class="col-md-3">
                  <?php echo lang('edit_user_previous_email_label', 'previous_email');?>
                </div>
                <div class="col-md-9">
                	<input type="text" class="form-control" value="<?php echo $previous_email?>" disabled="disabled">
              	</div>
        	</div>
        	<div class="row form-row">
        		<div class="col-md-3">
                  <?php echo lang('edit_user_bb_pin_label', 'bb_pin');?>
                </div>
                <div class="col-md-9">
                	<input type="text" class="form-control" value="<?php echo $bb_pin?>" disabled="disabled">
              	</div>
        	</div>
    	</div>
    </div>

<script type="text/javascript">
  $("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});

  var id = '#dialog';
    
  //Get the screen height and width
  var maskHeight = $(document).height();
  var maskWidth = $(window).width();
    
  //Set heigth and width to mask to fill up the whole screen
  $('#mask').css({'width':maskWidth,'height':maskHeight});

  //transition effect
  $('#mask').fadeIn(500); 
  $('#mask').fadeTo("slow",0.9);  
    
  //Get the window height and width
  var winH = $(window).height();
  var winW = $(window).width();
                
  //Set the popup window to center
  $(id).css('top',  winH/2-$(id).height()/2);
  $(id).css('left', winW/2-$(id).width()/2);
    
  //transition effect
  $(id).fadeIn(2000);   
    
  //if close button is clicked
  $('.window .close').click(function (e) {
  //Cancel the link behavior
  e.preventDefault();

  $('#mask').hide();
  $('.window').hide();
  });

</script>