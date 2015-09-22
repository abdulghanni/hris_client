<html>
<body>
    <h1><?php echo sprintf(lang('email_forgot_password_heading'), $identity);?></h1>
    <p>Anda melakukan permintaan untuk reset password akun anda di WEB-HRIS Erlangga,</p>
    <p><?php echo sprintf(lang('email_forgot_password_subheading'), anchor('auth/reset_password/'. $forgotten_password_code, lang('email_forgot_password_link')));?></p>
    <p>Jika Anda tidak merasa melakukan permintaan reset password, abaikan pesan ini</p>
    <br/>
    <br/>
    
    <p>Terimakasih,</p>
</body>
</html>