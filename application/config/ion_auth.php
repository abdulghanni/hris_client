<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth
*
* Version: 2.5.2
*
* Author: Ben Edmunds
*         ben.edmunds@gmail.com
*         @benedmunds
*
* Added Awesomeness: Phil Sturgeon
*
* Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  10.01.2009
*
* Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
* Original Author name has been kept but that does not mean that the method has not been modified.
*
* Requirements: PHP5 or above
*
*/

/*
| -------------------------------------------------------------------------
| Tables.
| -------------------------------------------------------------------------
| Database table names.
*/
$config['tables']['users']           = 'users';
$config['tables']['groups']          = 'groups';
$config['tables']['users_groups']    = 'users_groups';
$config['tables']['login_attempts']  = 'login_attempts';
$config['tables']['organization_class']  = 'organization_class';
$config['tables']['position_group']  = 'position_group';
$config['tables']['position']  = 'position';
$config['tables']['organization']  = 'organization';
$config['tables']['users_employement']  = 'users_employement';
$config['tables']['comp_session']  = 'comp_session';
$config['tables']['payroll_type']  = 'payroll_type';
$config['tables']['marital']  = 'marital';
$config['tables']['resign_reason']  = 'resign_reason';
$config['tables']['library']  = 'library';
$config['tables']['exp_level']  = 'exp_level';
$config['tables']['grade']  = 'grade';
$config['tables']['email']  = 'email';
$config['tables']['ikatan_dinas_type']  = 'ikatan_dinas_type';
$config['tables']['course_status']  = 'course_status';
$config['tables']['certification_type']  = 'certification_type';
$config['tables']['award_warning_type']  = 'award_warning_type';
$config['tables']['education_group']  = 'education_group';
$config['tables']['education_center']  = 'education_center';
$config['tables']['exp_field']  = 'exp_field';
$config['tables']['empl_status']  = 'empl_status';
$config['tables']['employee_status']  = 'employee_status';
$config['tables']['exp_year']  = 'exp_year';
$config['tables']['education_degree']  = 'education_degree';
$config['tables']['active_inactive']  = 'active_inactive';
$config['tables']['users_cuti']  = 'users_cuti';
$config['tables']['alasan_cuti']  = 'alasan_cuti';
$config['tables']['users_cuti_plafon']  = 'users_cuti_plafon';
$config['tables']['users_spd_dalam_group']  = 'users_spd_dalam_group';
$config['tables']['users_spd_dalam_report_group']  = 'users_spd_dalam_report_group';
$config['tables']['users_spd_dalam']  = 'users_spd_dalam';
$config['tables']['users_spd_dalam_report']  = 'users_spd_dalam_report';
$config['tables']['users_spd_luar']  = 'users_spd_luar';
$config['tables']['users_spd_luar_report']  = 'users_spd_luar_report';
$config['tables']['users_spd_luar_group']  = 'users_spd_luar_group';
$config['tables']['users_spd_luar_report_group']  = 'users_spd_luar_report_group';
$config['tables']['transportation']  = 'transportation';
$config['tables']['city']  = 'city';
$config['tables']['keterangan_absen']  = 'keterangan_absen';
$config['tables']['users_absen']  = 'users_absen';
$config['tables']['users_training']  = 'users_training';
$config['tables']['users_training_group']  = 'users_training_group';
$config['tables']['penyelenggara']  = 'penyelenggara';
$config['tables']['pembiayaan']  = 'pembiayaan';
$config['tables']['training_type']  = 'training_type';
$config['tables']['recruitment']  = 'users_recruitment';
$config['tables']['users_medical']  = 'users_medical';
$config['tables']['users_resignment']  = 'users_resignment';
$config['tables']['alasan_resign']  = 'alasan_resign';
$config['tables']['users_promosi']  = 'users_promosi';
$config['tables']['users_demotion']  = 'users_demotion';
$config['tables']['users_rolling']  = 'users_rolling';
$config['tables']['users_exit']  = 'users_exit';
$config['tables']['users_approval']  = 'users_approval';

/*
 | Users table column and Group table column you want to join WITH.
 |
 | Joins from users.id
 | Joins from groups.id
 */
$config['join']['users']  = 'user_id';
$config['join']['groups'] = 'group_id';

/*
 | -------------------------------------------------------------------------
 | Hash Method (sha1 or bcrypt)
 | -------------------------------------------------------------------------
 | Bcrypt is available in PHP 5.3+
 |
 | IMPORTANT: Based on the recommendation by many professionals, it is highly recommended to use
 | bcrypt instead of sha1.
 |
 | NOTE: If you use bcrypt you will need to increase your password column character limit to (80)
 |
 | Below there is "default_rounds" setting.  This defines how strong the encryption will be,
 | but remember the more rounds you set the longer it will take to hash (CPU usage) So adjust
 | this based on your server hardware.
 |
 | If you are using Bcrypt the Admin password field also needs to be changed in order login as admin:
 | $2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36
 |
 | Be careful how high you set max_rounds, I would do your own testing on how long it takes
 | to encrypt with x rounds.
 |
 | salt_prefix: Used for bcrypt. Versions of PHP before 5.3.7 only support "$2a$" as the salt prefix
 | Versions 5.3.7 or greater should use the default of "$2y$".
 */
$config['hash_method']    = 'bcrypt';   // sha1 or bcrypt, bcrypt is STRONGLY recommended
$config['default_rounds'] = 8;          // This does not apply if random_rounds is set to true
$config['random_rounds']  = FALSE;
$config['min_rounds']     = 5;
$config['max_rounds']     = 9;
$config['salt_prefix']    = '$2y$';

/*
 | -------------------------------------------------------------------------
 | Authentication options.
 | -------------------------------------------------------------------------
 | maximum_login_attempts: This maximum is not enforced by the library, but is
 | used by $this->ion_auth->is_max_login_attempts_exceeded().
 | The controller should check this function and act
 | appropriately. If this variable set to 0, there is no maximum.
 */
$config['site_title']                 = "web-HRIS";       // Site Title, example.com
$config['admin_email']                = "andi@komunigrafik.com"; // Admin Email, admin@example.com
$config['default_group']              = 'members';           // Default group, use name
$config['admin_group']                = array(
                                        'admin' => 'admin',
                                        );             // Default administrators group, use name
$config['admin_bagian']               = array(
                                        'Admin HRD' => 'Admin HRD',
                                        'Admin IT' => 'Admin IT',
                                        'Admin logistik' => 'Admin Logistik',
                                        'Admin koperasi' => 'Admin Koperasi',
                                        'Admin perpustakaan' => 'Admin Perpustakaan',
                                        'Admin keuangan' => 'Admin keuangan',
                                        );
$config['admin_HRD']                  = 'Admin HRD';
$config['admin_IT']                   = 'Admin IT';
$config['admin_logistik']             = 'Admin Logistik';
$config['admin_koperasi']             = 'Admin Koperasi';
$config['admin_perpustakaan']         = 'Admin Perpustakaan';
$config['admin_keuangan']         	  = 'Admin keuangan';

$config['identity']                   = 'email';             // A database column which is used to login with
$config['min_password_length']        = 8;                   // Minimum Required Length of Password
$config['max_password_length']        = 20;                  // Maximum Allowed Length of Password
$config['email_activation']           = FALSE;               // Email Activation for registration
$config['manual_activation']          = TRUE;               // Manual Activation for registration
$config['remember_users']             = TRUE;                // Allow users to be remembered and enable auto-login
$config['user_expire']                = 86500;               // How long to remember the user (seconds). Set to zero for no expiration
$config['user_extend_on_login']       = FALSE;               // Extend the users cookies every time they auto-login
$config['track_login_attempts']       = FALSE;               // Track the number of failed login attempts for each user or ip.
$config['track_login_ip_address']     = TRUE;                // Track login attempts by IP Address, if FALSE will track based on identity. (Default: TRUE)
$config['maximum_login_attempts']     = 3;                   // The maximum number of failed login attempts.
$config['lockout_time']               = 600;                 // The number of seconds to lockout an account due to exceeded attempts
$config['forgot_password_expiration'] = 0;                   // The number of milliseconds after which a forgot password request will expire. If set to 0, forgot password requests will not expire.

/*
 | -------------------------------------------------------------------------
 | Cookie options.
 | -------------------------------------------------------------------------
 | remember_cookie_name Default: remember_code
 | identity_cookie_name Default: identity
 */
$config['remember_cookie_name'] = 'remember_code';
$config['identity_cookie_name'] = 'identity';

/*
 | -------------------------------------------------------------------------
 | Email options.
 | -------------------------------------------------------------------------
 | email_config:
 |    'file' = Use the default CI config or use from a config file
 |    array  = Manually set your email config settings
 */
$config['use_ci_email'] = FALSE; // Send Email using the builtin CI email class, if false it will return the code and the identity
$config['email_config'] = array(
    'mailtype' => 'html',
);

/*
 | -------------------------------------------------------------------------
 | Email templates.
 | -------------------------------------------------------------------------
 | Folder where email templates are stored.
 | Default: auth/
 */
$config['email_templates'] = 'auth/email/';

/*
 | -------------------------------------------------------------------------
 | Activate Account Email Template
 | -------------------------------------------------------------------------
 | Default: activate.tpl.php
 */
$config['email_activate'] = 'activate.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Forgot Password Email Template
 | -------------------------------------------------------------------------
 | Default: forgot_password.tpl.php
 */
$config['email_forgot_password'] = 'forgot_password.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Forgot Password Complete Email Template
 | -------------------------------------------------------------------------
 | Default: new_password.tpl.php
 */
$config['email_forgot_password_complete'] = 'new_password.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Salt options
 | -------------------------------------------------------------------------
 | salt_length Default: 22
 |
 | store_salt: Should the salt be stored in the database?
 | This will change your password encryption algorithm,
 | default password, 'password', changes to
 | fbaa5e216d163a02ae630ab1a43372635dd374c0 with default salt.
 */
$config['salt_length'] = 22;
$config['store_salt']  = FALSE;

/*
 | -------------------------------------------------------------------------
 | Message Delimiters.
 | -------------------------------------------------------------------------
 */
$config['delimiters_source']       = 'config';  // "config" = use the settings defined here, "form_validation" = use the settings defined in CI's form validation library
$config['message_start_delimiter'] = '<p>';     // Message start delimiter
$config['message_end_delimiter']   = '</p>';    // Message end delimiter
$config['error_start_delimiter']   = '<p>';     // Error mesage start delimiter
$config['error_end_delimiter']     = '</p>';    // Error mesage end delimiter

$config['list_limit'] = 10;
$config['uri_segment_pager'] = 7;

/* End of file ion_auth.php */
/* Location: ./application/config/ion_auth.php */
