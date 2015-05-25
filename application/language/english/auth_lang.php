<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Author: Daniel Davis
*         @ourmaninjapan
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.09.2013
*
* Description:  English language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'This form post did not pass our security checks.';

// Login
$lang['login_heading']         = 'Login';
$lang['login_subheading']      = 'Please login with your NIK and password below.';
$lang['login_identity_label']  = 'NIK:';
$lang['login_password_label']  = 'Password:';
$lang['login_remember_label']  = 'Remember Me:';
$lang['login_submit_btn']      = 'Login';
$lang['login_forgot_password'] = 'Forgot your password?';

// Index
$lang['index_heading']           = 'Users';
$lang['index_subheading']        = 'Below is a list of the users.';
$lang['index_fname_th']          = 'First Name';
$lang['index_ftitle_th']          = 'Title';
$lang['index_lname_th']          = 'Last Name';
$lang['index_email_th']          = 'Email';
$lang['index_groups_th']         = 'Groups';
$lang['index_status_th']         = 'Status';
$lang['index_action_th']         = 'Action';
$lang['index_active_link']       = 'Active';
$lang['index_inactive_link']     = 'Inactive';
$lang['index_create_user_link']  = 'Create a new user';
$lang['index_create_group_link'] = 'Create a new group';
$lang['index_course_title_th'] 	 = 'Course Title';
$lang['index_certificate_title_th'] 	= 'Certificate Title';
$lang['index_education_title_th'] 		= 'Education Title';
$lang['index_experience_title_th'] 	 	= 'Experience Title';
$lang['index_sk_title_th']		 = 'SK Title';
$lang['index_sti_title_th']		 = 'STI Title';
$lang['index_ikatan_dinas_title_th']		 = 'Ikatan Dinas Title';


// Deactivate User
$lang['deactivate_heading']                  = 'Deactivate User';
$lang['deactivate_subheading']               = 'Are you sure you want to deactivate the user \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Yes:';
$lang['deactivate_confirm_n_label']          = 'No:';
$lang['deactivate_submit_btn']               = 'Submit';
$lang['deactivate_validation_confirm_label'] = 'confirmation';
$lang['deactivate_validation_user_id_label'] = 'user ID';

// Create User
$lang['create_user_heading']                           = 'Create User';
$lang['create_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['create_user_fname_label']                       = 'First Name:';
$lang['create_user_lname_label']                       = 'Last Name:';
$lang['create_user_company_label']                     = 'Company Name:';
$lang['create_user_email_label']                       = 'Email:';
$lang['create_user_phone_label']                       = 'Phone:';
$lang['create_user_password_label']                    = 'Password:';
$lang['create_user_password_confirm_label']            = 'Confirm Password:';
$lang['create_user_submit_btn']                        = 'Create User';
$lang['create_user_validation_fname_label']            = 'First Name';
$lang['create_user_validation_lname_label']            = 'Last Name';
$lang['create_user_validation_email_label']            = 'Email Address';
$lang['create_user_validation_phone1_label']           = 'First Part of Phone';
$lang['create_user_validation_phone2_label']           = 'Second Part of Phone';
$lang['create_user_validation_phone3_label']           = 'Third Part of Phone';
$lang['create_user_validation_company_label']          = 'Company Name';
$lang['create_user_validation_password_label']         = 'Password';
$lang['create_user_validation_password_confirm_label'] = 'Password Confirmation';

// Edit User
$lang['edit_user_heading']                           = 'Edit User';
$lang['edit_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['edit_user_fname_label']                       = 'First Name:';
$lang['edit_user_lname_label']                       = 'Last Name:';
$lang['edit_user_company_label']                     = 'Company Name:';
$lang['edit_user_email_label']                       = 'Email:';
$lang['edit_user_phone_label']                       = 'Phone:';
$lang['edit_user_password_label']                    = 'Password: (if changing password)';
$lang['edit_user_password_confirm_label']            = 'Confirm Password: (if changing password)';
$lang['edit_user_groups_heading']                    = 'Member of groups';
$lang['edit_user_submit_btn']                        = 'Save User';
$lang['edit_user_validation_fname_label']            = 'First Name';
$lang['edit_user_validation_lname_label']            = 'Last Name';
$lang['edit_user_validation_email_label']            = 'Email Address';
$lang['edit_user_validation_phone1_label']           = 'First Part of Phone';
$lang['edit_user_validation_phone2_label']           = 'Second Part of Phone';
$lang['edit_user_validation_phone3_label']           = 'Third Part of Phone';
$lang['edit_user_validation_company_label']          = 'Company Name';
$lang['edit_user_validation_groups_label']           = 'Groups';
$lang['edit_user_validation_password_label']         = 'Password';
$lang['edit_user_validation_password_confirm_label'] = 'Password Confirmation';


// Create Group
$lang['create_group_title']                  = 'Create Group';
$lang['create_group_heading']                = 'Create Group';
$lang['create_group_subheading']             = 'Please enter the group information below.';
$lang['create_group_name_label']             = 'Group Name:';
$lang['create_group_desc_label']             = 'Description:';
$lang['create_group_submit_btn']             = 'Create Group';
$lang['create_group_validation_name_label']  = 'Group Name';
$lang['create_group_validation_desc_label']  = 'Description';

// Edit Group
$lang['edit_group_title']                  = 'Edit Group';
$lang['edit_group_saved']                  = 'Group Saved';
$lang['edit_group_heading']                = 'Edit Group';
$lang['edit_group_subheading']             = 'Please enter the group information below.';
$lang['edit_group_name_label']             = 'Group Name:';
$lang['edit_group_desc_label']             = 'Description:';
$lang['edit_group_submit_btn']             = 'Save Group';
$lang['edit_group_validation_name_label']  = 'Group Name';
$lang['edit_group_validation_desc_label']  = 'Description';

// Change Password
$lang['change_password_heading']                               = 'Change Password';
$lang['change_password_old_password_label']                    = 'Old Password:';
$lang['change_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['change_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['change_password_submit_btn']                            = 'Change';
$lang['change_password_validation_old_password_label']         = 'Old Password';
$lang['change_password_validation_new_password_label']         = 'New Password';
$lang['change_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Forgot Password
$lang['forgot_password_heading']                 = 'Forgot Password';
$lang['forgot_password_subheading']              = 'Please enter your %s so we can send you an email to reset your password.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Submit';
$lang['forgot_password_validation_email_label']  = 'Email Address';
$lang['forgot_password_username_identity_label'] = 'Username';
$lang['forgot_password_email_identity_label']    = 'Email';
$lang['forgot_password_email_not_found']         = 'No record of that email address.';

// Reset Password
$lang['reset_password_heading']                               = 'Change Password';
$lang['reset_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['reset_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['reset_password_submit_btn']                            = 'Change';
$lang['reset_password_validation_new_password_label']         = 'New Password';
$lang['reset_password_validation_new_password_confirm_label'] = 'Confirm New Password';


//additional
$lang['login_user_heading']						= 'Sign in Web-HRIS';
$lang['company_name']							= 'PT. Penerbit Erlangga';
$lang['register_here']							= 'Register here';
$lang['register_opening_description']			= 'for PT. Penerbit Erlangga web-HRIS account.';
$lang['user_registration']						= 'User Registration';
$lang['employee_information_subheading']		= 'Employee Information';
$lang['course_information_subheading']			= 'Company Sponsor Course Information';
$lang['user_contact_subheading']						= 'Contact Information';
$lang['register_foto_label']						= 'Foto';
$lang['register_nik_label']						= 'NIK';
$lang['register_fullname_label']				= 'Fullname';
$lang['register_dob_label']						= 'Date of birth';
$lang['register_bu_label']						= 'Business Unit';
$lang['register_organization_label']						= 'Organization';
$lang['register_position_label']						= 'Position';
$lang['register_marital_label']						= 'Marital Status';
$lang['register_firstname_label']						= 'First name';
$lang['register_lastname_label']						= 'Last name';
$lang['user_information_subheading']						= 'User Information';
$lang['back_button_label']						= 'Back';
$lang['list_of_subheading']						= 'List of -';
$lang['users_subheading']						= 'Users';
$lang['org_class_subheading']						= 'Organization Class';
$lang['edit_user_validation_bod_label']            = 'Date of Birth';
$lang['edit_user_validation_business_unit_id_label']            = 'Business Unit';
$lang['edit_user_validation_position_id_label']            = 'Position';
$lang['edit_user_validation_marital_label']            = 'Marital Status';
$lang['edit_user_mobile_phone_label']            = 'Mobile Phone';
$lang['edit_user_previous_email_label']            = 'Previous Email';
$lang['edit_user_bb_pin_label']            = 'BB Pin';
$lang['logout_link_label']            = 'Logout';
$lang['search_of_subheading'] = 'Search';
$lang['user_subheading'] = 'User';
$lang['course_subheading'] = 'Courses';
$lang['certificate_subheading'] = 'Certificates';
$lang['education_subheading'] = 'Educations';
$lang['experience_subheading'] = 'Experiences';
$lang['found_subheading'] = 'Found';
$lang['search_name_email'] = 'Name or Email';
$lang['users_employement_subheading'] = "User's Employement";
$lang['users_course_subheading'] = "User's Course";
$lang['users_certificate_subheading'] = "User's Certificate";
$lang['users_education_subheading'] = "User's Education";
$lang['users_experience_subheading'] = "User's Experience";
$lang['users_sk_subheading'] = "User's Surat Keputusan";
$lang['users_sti_subheading'] = "User's Serah Terima Jabatan";
$lang['users_sti_subheading'] = "User's Serah Terima Jabatan";
$lang['users_jabatan_subheading'] = "User's Position History";
$lang['users_award_subheading'] = "User's Award / Warning";
$lang['users_ikatan_dinas_subheading'] = "User's Ikatan Dinas";
$lang['delete_confirmation'] = "Delete Confirmation";
$lang['delete_this_data'] = "Are you sure want to delete ";
$lang['personal_label'] = "Personal";
$lang['order_no'] = "Order No";
$lang['add_org_class'] = "Add Organization Class";
$lang['add_pos_group'] = "Add Position Group";
$lang['edit_pos_group'] = "Edit Position Group";
$lang['pos_group_subheading'] = "Position Group";
$lang['position_subheading'] = "Position";
$lang['abbr'] = "Abbreviation";
$lang['level_order'] = "Level Order";
$lang['parent_pos_group_id'] = "Parent Position Group";

//button
$lang['add_button'] = 'Add';
$lang['save_button'] = 'Save';
$lang['close_button'] = 'Close';
$lang['edit_button'] = 'Edit';
$lang['delete_button'] = 'Delete';
$lang['cancel_button'] = 'Cancel';
$lang['search_button'] = 'Search';

//person label
$lang['aviva_number']='Aviva Number';
$lang['bpjs_number']='BPJS Number';
$lang['ktp_number']='KTP Number';
$lang['tax_category']='Tax Category';
$lang['person_employement_label'] = 'Employement';
$lang['person_course_label'] = 'Company Course';
$lang['person_certificate_label'] = 'Certificate';
$lang['person_education_label'] = 'Education';
$lang['person_experience_label'] = 'Experience';
$lang['person_sk_label'] = 'Surat Keputusan';
$lang['person_sti_label'] = 'Surat Terima Ijazah';
$lang['person_jabatan_label'] = 'Position History';
$lang['person_award_label'] = 'Award Warning';
$lang['person_ikatan_label'] = 'Ikatan Dinas';

//users employement
$lang['seniority_date']='Seniority Date';
$lang['empl_status']='Employee Status';
$lang['employee_status']='Status';
$lang['cost_center']='Cost Center';
$lang['position_group']='Position Group';
$lang['active_inactive']='Active Inactive';

//Users Course

$lang['course_id'] = 'Course ID';
$lang['course_description'] = 'Course Title';
$lang['course_registration_date'] = 'Registration Date';
$lang['course_status'] = 'Course Status';
$lang['add_course'] = 'Add Course';
$lang['edit_course'] = 'Edit Course';


//Users Certificate

$lang['certificate_id'] = 'Certificate ID';
$lang['certification_type'] = 'Certification Type';
$lang['start_date'] = 'Start Date';
$lang['end_date'] = 'End Date';
$lang['add_certificate'] = 'Add Certificate';
$lang['edit_certificate'] = 'Edit Certificate';

//Users Education

$lang['education'] = 'Education';
$lang['description'] = 'Description';
$lang['education_group'] = 'Education Group';
$lang['education_degree'] = 'Education Degree';
$lang['institution'] = 'Institution';
$lang['add_education'] = 'Add Education';
$lang['edit_education'] = 'Edit Education';

//Users Exp

$lang['company'] = 'Company';
$lang['position'] = 'Position';
$lang['address'] = 'Address';
$lang['line_business'] = 'Line Of Business';
$lang['resign_reason'] = 'Resign Reason';
$lang['last_salary'] = 'Last Salary';
$lang['add_experience'] = 'Add Experience';
$lang['edit_experience'] = 'Edit Experience';

//Users SK

$lang['sk_date'] = 'SK Date';
$lang['sk_no'] = 'SK No';
$lang['departement'] = 'Departement';
$lang['effective_date'] = 'Effective Date';
$lang['location'] = 'Location';
$lang['sign_name'] = 'Sign Name';
$lang['sign_position'] = 'Sign Position';
$lang['add_sk'] = 'Add SK';
$lang['edit_sk'] = 'Edit SK';

//Users STI
$lang['add_sti'] = 'Add STI';
$lang['edit_sti'] = 'Edit STI';
$lang['identity_no'] = 'Identity No';
$lang['ijazah_name'] = 'Ijazah Name';
$lang['ijazah_number'] = 'Ijazah Number';
$lang['ijazah_history'] = 'Ijazah History';
$lang['published_place'] = 'Published Place';
$lang['activation_date'] = 'Activation Date';
$lang['receivedby'] = 'Received By';
$lang['acknowledgeby'] = 'Acknowledge By';

//Users Position history
$lang['add_jabatan'] = 'Add Position History';
$lang['edit_jabatan'] = 'Edit Position History';
$lang['organization'] = 'Organization';
$lang['employee_group'] = 'Employee Group';
$lang['branch'] = 'branch';
$lang['grade'] = 'Grade';
$lang['personel_action'] = 'Personel Action';

//Users Award Warning
$lang['add_award'] = 'Add Award Warning';
$lang['edit_award'] = 'Edit Award Warning';
$lang['award_warning_type'] = 'Award Warning Type';
$lang['app_date'] = 'App Date';
$lang['title'] = 'Title';
$lang['sk_number'] = 'SK Number';

//Users Ikatan Dinas
$lang['ikatan_dinas_type'] = 'Ikatan Dinas Type';
$lang['amount'] = 'Amount';
$lang['add_ikatan_dinas'] = 'Add Ikatan Dinas';
$lang['edit_ikatan_dinas'] = 'Edit Ikatan Dinas';

//organization
$lang['parent_organization'] = 'Organization Parent';
$lang['organization_class'] = 'Organization Class';
$lang['org_subheading'] = 'Organization';
$lang['structure_subheading'] = 'Structure';

//organization_class
$lang['edit_validation_ftitle_label'] = 'Title';
$lang['add_organization'] = 'Add Organization';
$lang['edit_organization'] = 'Edit Organization';

//position Group
$lang['level_order'] = 'Level Order';
$lang['parent_position_group'] = 'Parent Position Group';

//position class
$lang['abbrevation'] = 'Abbrevation';
$lang['position_parent'] = 'Position Parent';

//company session
$lang['year']		 = 'Year';
$lang['is_absence']		 = 'Absence system';
$lang['is_active']		 = 'Active status';
$lang['comp_session_subheading']		 = 'Company Session';
$lang['true_lable']		 = 'Yes';
$lang['false_lable']	 = 'No';
$lang['add_comp_session']	 = 'Add Company Session';
$lang['payroll_type']	 = 'Payroll Type';

//marital
$lang['mar_subheading'] = "Marital";
$lang['add_mar'] = "Add Marital";
$lang['edit_mar'] = 'Edit Marital';

//resign reason
$lang['res_reason_subheading'] = "Resign Reason";
$lang['add_res_reason'] = "Add Resign Reason";
$lang['edit_res_reason'] = 'Edit Resign Reason';

//experience level
$lang['exp_lvl_subheading'] = "Experience Level";
$lang['add_exp_lvl'] = "Add Experience Level";
$lang['edit_exp_lvl'] = 'Edit Experience Level';

//grade
$lang['gra_subheading'] = "Grade";
$lang['add_gra'] = "Add Grade";
$lang['edit_gra'] = 'Edit Grade';

//ikatan dinas type
$lang['iktn_dns_type_subheading'] = "Ikatan Dinas Type";
$lang['add_iktn_dns_type'] = "Add Ikatan Dinas Type";
$lang['edit_iktn_dns_type'] = 'Edit Ikatan Dinas Type';

//course status
$lang['crs_status_subheading'] = "Course Status";
$lang['add_crs_status'] = "Add Course Status";
$lang['edit_crs_status'] = 'Edit Course Status';

//certification type
$lang['crt_type_subheading'] = "Certification Type";
$lang['add_crt_type'] = "Add Certification Type";
$lang['edit_crt_type'] = 'Edit Certification Type';

//award warning type
$lang['awrd_warn_type_subheading'] = "Award Warning Type";
$lang['add_awrd_warn_type'] = "Add Award Warning Type";
$lang['edit_awrd_warn_type'] = 'Edit Award Warning Type';

//education group
$lang['edu_group_subheading'] = "Education Group";
$lang['add_edu_group'] = "Add Education Group";
$lang['edit_edu_group'] = 'Edit Education Group';

//education center
$lang['edu_center_subheading'] = "Education Center";
$lang['add_edu_center'] = "Add Education Center";
$lang['edit_edu_center'] = 'Edit Education Center';

//experience field
$lang['exp_fld_subheading'] = "Experience Field";
$lang['add_exp_fld'] = "Add Experience Field";
$lang['edit_exp_fld'] = 'Edit Experience Field';

//empl status
$lang['empl_stat_subheading'] = "Empl Status";
$lang['add_empl_stat'] = "Add Empl Status";
$lang['edit_empl_stat'] = 'Edit Empl Status';

//employee status
$lang['employee_stat_subheading'] = "Employee Status";
$lang['add_employee_stat'] = "Add Employee Status";
$lang['edit_employee_stat'] = 'Edit Employee Status';

//library table
$lang['library_table_subheading'] = 'Library Table';

//experience year
$lang['exp_yr_subheading'] = "Experience Year";
$lang['add_exp_yr'] = "Add Experience Year";
$lang['edit_exp_yr'] = 'Edit Experience Year';

//education degree
$lang['edu_degree_subheading'] = "Education Degree";
$lang['add_edu_degree'] = "Add Education Degree";
$lang['edit_edu_degree'] = 'Edit Education Degree';

//active inactive
$lang['act_inactive_subheading'] = "Active Inactive";
$lang['add_act_inactive'] = "Add Active Inactive";
$lang['edit_act_inactive'] = 'Edit Active Inactive';

//form_cuti
$lang['form'] = "Form";
$lang['list_of_submission'] = "Daftar Pengajuan";
$lang['form_cuti_subheading'] = "Cuti";
$lang['date_mulai_cuti'] = "Tanggal Mulai Cuti";
$lang['reason'] = "Alasan";
$lang['count_cuti'] = "Jumlah cuti";
$lang['start_cuti'] = "Mulai Cuti";
$lang['end_cuti'] = "Selesai Cuti";
$lang['count_day'] = "Jumlah Hari";
$lang['replacement'] = "Pengganti";
$lang['addr_cuti'] = "Alamat selama cuti";
$lang['emp_info'] = "Informasi Karyawan";
$lang['start_working'] = "Mulai Bekerja";
$lang['dept_div'] = "Dept/Bagian";
$lang['position'] = "Jabatan";
$lang['cuti_remain'] = "Sisa Cuti (hari)";
$lang['cuti_input_subheading'] = "Cuti yang akan diambil";
$lang['start_cuti_date'] = "Tgl. mulai cuti";
$lang['name'] = "Nama";





