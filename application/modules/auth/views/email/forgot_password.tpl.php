<html>
<body>
    <h1><?php echo sprintf(lang('email_forgot_password_heading'), $identity);?></h1>
    <p>Anda melakukan permintaan untuk reset password akun anda di WEB-HRIS Erlangga,</p>
    <p><?php echo sprintf(lang('email_forgot_password_subheading'), "<a href='http://123.231.241.12/hris_client/auth/reset_password/".$forgotten_password_code."'>http://123.231.241.12/hris_client/auth/reset_password/".$forgotten_password_code."</a>");?></p>
    <p>Jika Anda tidak merasa melakukan permintaan reset password, abaikan pesan ini</p>
    <br/>
    <br/>
    <?php //buangan
    /*
		anchor('auth/reset_password/'. $forgotten_password_code, 'http://123.231.241.12/hris_client/auth/reset_password/'. $forgotten_password_code)
    */
    ?>
    <p>Terimakasih,</p>
</body>
</html>