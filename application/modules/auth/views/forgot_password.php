<div class="row register-container column-seperation">  
    <div class="col-md-8 col-md-offset-2">
        <div class="grid simple">
            <div class="grid-title no-border">
              <h1>Reset Password</h1>
<p>Silakan masukan NIK anda, untuk dapat melakukan reset password akun anda </p>
            </div>
            <div class="grid-body no-border"> 
                <div <?php ( ! empty($message)) && print('class="alert alert-info"'); ?> id="infoMessage"><?php echo $message;?></div>
                
                            <?php echo form_open("auth/forgot_password");?>
                <!-- <form id="form_iconic_validation" action="#"> -->
                    <div class="row column-seperation">

    <p>
        <label for="email"><?php echo sprintf('NIK', $identity_label);?></label> <br />
        <?php echo bs_form_input($email);?>
    </p>

    <p><?php echo bs_form_submit('submit', lang('forgot_password_submit_btn'));?></p>

<?php echo form_close();?>
                    </div>
            </div>
        </div>
    </div>
</div>