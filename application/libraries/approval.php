<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Approval
*
*
* Author: Abdul Ghanni
*         abdul.ghanni2@gmail.com
*
*
* Requirements: PHP5 or above
*
*/
class Approval {

    public function request($lv, $form, $id, $user_id, $detail)
    {
    	$CI =& get_instance();
    	$url = base_url().'form_'.$form.'/detail/'.$id;
        $user_app = getValue('user_app_'.$lv, 'users_'.$form, array('id'=>'where/'.$id));

    	switch ($form) {
            case "cuti":
                $receiver = $CI->approval->approver($form);
                $form = 'Permohonan Cuti';
                $isi_email = get_name($user_id).' mengajukan '.$form.', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>';
                break;
            case "absen":
                $receiver = $CI->approval->approver($form);
                $form = 'Keterangan Tidak Absen';
                $isi_email = get_name($user_id).' mengajukan '.$form.', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>';
                break;
            case "spd_dalam":
                $receiver = $CI->approval->approver('dinas');
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Dalam Kota';
                $isi_email = get_name($user_id).' membuat surat perintah perjalanan dinas dalam kota, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>';
                break;
            case "spd_luar":
                $receiver = $CI->approval->approver('dinas');
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Luar Kota';
                $isi_email = get_name($user_id).' membuat surat perintah perjalanan dinas luar kota, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>';
                break;
            case "spd_dalam_group":
                $receiver = $CI->approval->approver('dinas');
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Dalam Kota(Group)';
                $isi_email = get_name($user_id).' membuat surat perintah perjalanan dinas dalam kota(Group), untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>';
                break;
            case "spd_luar_group":
                $receiver = $CI->approval->approver('dinas');
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Luar Kota(Group)';
                $isi_email = get_name($user_id).' membuat surat perintah perjalanan dinas Luar kota(Group), untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>';
                break;
            case "promosi":
                $receiver = $CI->approval->approver($form);
                $pengaju_id = getValue('created_by', 'users_'.$form, array('id'=>'where/'.$id));
            	$form = 'Promosi Karyawan';
                $isi_email = get_name($pengaju_id).' mengajukan Promosi untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>';
            	$user_id = $pengaju_id;
                break;
            case "demotion":
                $receiver = $CI->approval->approver('demosi');
                $pengaju_id = getValue('created_by', 'users_'.$form, array('id'=>'where/'.$id));
                $form = 'Demotion Karyawan';
                $isi_email = get_name($pengaju_id).' mengajukan Demotion karyawan untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>';
                $user_id = $pengaju_id;
                break;
            case "rolling":
                $receiver = $CI->approval->approver($form);
                $pengaju_id = getValue('created_by', 'users_'.$form, array('id'=>'where/'.$id));
                $form = 'Rolling Karyawan';
                $isi_email = get_name($pengaju_id).' mengajukan rolling karyawan untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>';
                $user_id = $pengaju_id;
                break;
            case "recruitment":
                $receiver = $CI->approval->approver($form);
                $form = 'Recruitment Karyawan';
                $isi_email = get_name($user_id).' mengajukan '.$form.', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>';
                break;
            case "resignment":
                $receiver = $CI->approval->approver($form);
                $form = 'Resign Karyawan';
                $isi_email = get_name($user_id).' mengajukan '.$form.', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>';
                break;
            case "training":
                $receiver = $CI->approval->approver($form);
                $form = 'Training Karyawan';
                $isi_email = get_name($user_id).' mengajukan '.$form.', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>';
                break;
            case "training_group":
                $receiver = $CI->approval->approver('training');
                $form = 'Training Karyawan (Group)';
                $isi_email = get_name($user_id).' mengajukan '.$form.', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>';
                break;
            case "medical":
                $receiver = $CI->approval->approver($form);
                $form = 'Rekapitulasi Rawat Inap';
                $isi_email = get_name($user_id).' membuat rekapitulasi rawat jalan dan inap, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>';
                break;
            case "exit":
                $receiver = $CI->approval->approver($form);
                $form = 'Rekomendasi Karyawan Keluar';
                $isi_email = get_name($user_id).' mengajukan '.$form.', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>';
                break;
        }

        if($lv == 'hrd'){
        	$data = array(
                    'sender_id' => get_nik($user_id),
                    'receiver_id' => $receiver,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => get_form_no($id).'Pengajuan '.ucfirst($form),
                    'email_body' => $isi_email,
                    'is_read' => 0,
                );
            $CI->db->insert('email', $data);
           //if(!empty(getEmail($receiver)))$CI->send_email(getEmail(receiver), 'Pengajuan '.ucfirst($form), $isi_email);
        }else{
	        if(!empty($user_app)):
	            $data = array(
	                    'sender_id' => get_nik($user_id),
	                    'receiver_id' => $user_app,
	                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
	                    'subject' => get_form_no($id).'-Pengajuan '.ucfirst($form),
	                    'email_body' => $isi_email,
	                    'is_read' => 0,
	                );
	            $CI->db->insert('email', $data);
	        endif;
        }
    }

    public function by_admin($form, $id, $created_by, $created_for, $detail)
    {
        $CI =& get_instance();
        $url = base_url().'form_'.$form.'/detail/'.$id;
        switch ($form) {
            case "absen":
                $form = 'Keterangan Tidak Absen';
                $created_for = get_nik($created_for);
                break;
            case "cuti":
                $form = 'Permohonan Cuti';
                $created_for = get_nik($created_for);
                break;
            case "resignment":
                $form = 'Resign';
                $created_for = get_nik($created_for);
                break;
            case "training":
                $form = 'Pelatihan Karyawan';
                $created_for = get_nik($created_for);
                break;
            case "training_group":
                $form = 'Pelatihan Karyawan (Group)';
                $created_for = get_nik($created_for);
                break;
            case "medical":
                $form = 'Rekapitulasi Rawat Jalan & Inap';
                $created_for = get_nik($created_for);
                break;
            case "spd_dalam":
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Dalam Kota';
                break;
            case "spd_luar":
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Luar Kota';
                break;
            case "spd_dalam_group":
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Dalam Kota (Group)';
                break;
            case "spd_luar_group":
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Luar Kota (Group)';
                break;
            
            /*
            default:
                # code...
                break;
            */
        }
        $data = array(
                'sender_id' => $created_by,
                'receiver_id' => $created_for,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => get_form_no($id).'Pengajuan '.ucfirst($form),
                'email_body' => get_name($created_by).' membuat pengajuan '.$form.' atas nama anda, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>',
                'is_read' => 0,
            );
        $CI->db->insert('email', $data);
    }

    public function approve($form, $id, $approval_status, $detail)
    {
    	$CI =& get_instance();
    	$sess_id = $CI->session->userdata('user_id');
    	$url = base_url().'form_'.$form.'/detail/'.$id;
        $approver = get_name(get_nik($sess_id));
        $approval_status = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));

        switch ($form) {
            case "edit_user":
                $url = base_url().'auth/edit_user_approval/'.$id;
                $receiver_id = getValue('user_id', 'users_edit_approval', array('id'=>'where/'.$id));
                $form = 'Perubahan Data Karywan';
            break;
            case "promosi":
                $receiver_id = getValue('created_by', 'users_'.$form, array('id'=>'where/'.$id));
            break;
            case "demotion":
                $receiver_id = getValue('created_by', 'users_'.$form, array('id'=>'where/'.$id));
            break;
            case "rolling":
                $receiver_id = getValue('created_by', 'users_'.$form, array('id'=>'where/'.$id));
                break;
            case "spd_dalam":
                $receiver_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $receiver_id = get_id($receiver_id);
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Dalam Kota';
            break;
            case "spd_dalam_group":
                $receiver_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $receiver_id = get_id($receiver_id);
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Dalam Kota (Group)';
            break;
            case "spd_luar":
                $receiver_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $receiver_id = get_id($receiver_id);
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Luar Kota';
            break;
            case "spd_luar_group":
                $receiver_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $receiver_id = get_id($receiver_id);
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Luar Kota (Group)';
            break;
            case "absen":
                $receiver_id = getValue('user_id', 'users_'.$form, array('id'=>'where/'.$id));
                $form = 'Keterangan Tidak Absen';
                break;
            default:
            $receiver_id = getValue('user_id', 'users_'.$form, array('id'=>'where/'.$id));
        }

        $data = array(
                'sender_id' => get_nik($sess_id),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => get_form_no($id).'['.$approval_status.']Status Pengajuan Permohonan '.ucfirst($form).' dari Atasan',
                'email_body' => "Status pengajuan $form anda $approval_status oleh $approver untuk detail silakan <a href=$url>Klik disini</a><br/>".$detail.'<br />untuk melihat detail silakan <a href='.$url.'>Klik Disini</a>',
                'is_read' => 0,
            );
        $CI->db->insert('email', $data);
    }

    public function update_approve($form, $id, $approval_status, $detail)
    {
    	$CI =& get_instance();
        $sess_id = $CI->session->userdata('user_id');
        $url = base_url().'form_'.$form.'/detail/'.$id;
        $approver = get_name(get_nik($sess_id));
        $approval_status = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));

        switch ($form) {
            case "promosi":
                $receiver_id = getValue('created_by', 'users_'.$form, array('id'=>'where/'.$id));
                break;
            case "demotion":
                $receiver_id = getValue('created_by', 'users_'.$form, array('id'=>'where/'.$id));
                break;
            case "rolling":
                $receiver_id = getValue('created_by', 'users_'.$form, array('id'=>'where/'.$id));
                break;
            case "spd_dalam":
                $receiver_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $receiver_id = get_id($receiver_id);
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Dalam Kota';
            break;
            case "spd_dalam_group":
                $receiver_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $receiver_id = get_id($receiver_id);
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Dalam Kota (Group)';
            break;
            case "spd_luar":
                $receiver_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $receiver_id = get_id($receiver_id);
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Luar Kota';
            break;
            case "spd_luar_group":
                $receiver_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $receiver_id = get_id($receiver_id);
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Luar Kota (Group)';
            break;
            default:
            $receiver_id = getValue('user_id', 'users_'.$form, array('id'=>'where/'.$id));
        }

        $data = array(
                'sender_id' => get_nik($sess_id),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => get_form_no($id).'['.$approval_status.']Perubahan Status Pengajuan Permohonan '.ucfirst($form).' dari Atasan',
                'email_body' => "$approver melakukan perubahan status pengajuan $form anda menjadi $approval_status, untuk detail silakan <a class='klikmail' href=$url>Klik disini</a><br/>".$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>',
                'is_read' => 0,
            );
        $CI->db->insert('email', $data);
    }

    public function not_approve($form, $id, $receiver_id, $approval_status, $detail)
    {
        $CI =& get_instance();
        $sess_id = $CI->session->userdata('user_id');
        $url = base_url().'form_'.$form.'/detail/'.$id;
        $approver = get_name(get_nik($sess_id));
        $approval_status = getValue('title', 'approval_status', array('id'=>'where/'.$approval_status));

        switch ($form) {
            case "promosi":
                $user_id = getValue('created_by', 'users_'.$form, array('id'=>'where/'.$id));
                break;
            case "demotion":
                $user_id = getValue('created_by', 'users_'.$form, array('id'=>'where/'.$id));
                break;
            case "rolling":
                $user_id = getValue('created_by', 'users_'.$form, array('id'=>'where/'.$id));
                break;
            case "spd_dalam":
                $user_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Dalam Kota';
            break;
            case "spd_dalam_group":
                $user_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Dalam Kota (Group)';
            break;
            case "spd_luar":
                $user_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Luar Kota';
            break;
            case "spd_luar_group":
                $user_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $url = base_url().'form_'.$form.'/submit/'.$id;
                $form = 'Perjalanan Dinas Luar Kota (Group)';
            break;
            case "training":
                $user_id = getValue('user_pengaju_id', 'users_'.$form, array('id'=>'where/'.$id));
                break;
            case "training_group":
                $user_id = getValue('user_pengaju_id', 'users_'.$form, array('id'=>'where/'.$id));
                break;
            default:
            $user_id = getValue('user_id', 'users_'.$form, array('id'=>'where/'.$id));
        }

        $data = array(
                'sender_id' => get_nik($sess_id),
                'receiver_id' => $receiver_id,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => get_form_no($id).'['.$approval_status.']Status Pengajuan Permohonan '.ucfirst($form).' dari Atasan',
                'email_body' => "Status pengajuan $form yang diajukan oleh ".get_name($user_id).' '.$approval_status. ' oleh '.get_name($sess_id)." untuk detail silakan <a class='klikmail' href=$url>Klik Disini</a><br />".$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>',
                'is_read' => 0,
            );
        $CI->db->insert('email', $data);
    }

    public function edit_user($id)
    {
        $CI =& get_instance();
        $sess_id = $CI->session->userdata('user_id');
        $url = base_url().'auth/edit_user_approval/'.$id;
        $user_id = getValue('user_id','users_edit_approval', array('id'=>'where/'.$id));
        $data = array(
                'sender_id' => get_nik($user_id),
                'receiver_id' => 1,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Perubahan Data Karyawan',
                'email_body' => get_name($user_id)." mengajukan perubahan data pribadinya, untuk detail silakan <a href=$url>Klik disini</a><br/>",
                'is_read' => 0,
            );
        $CI->db->insert('email', $data);
    }

    public function request_exit($id)
    {
        $CI =& get_instance();
        $url = base_url().'form_exit/input/'.$id;
        $atasan = get_superior($id);
        $data = array(
                'sender_id' => get_nik($id),
                'receiver_id' => $atasan,
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => get_form_no($id).'Permintaan Rekomendasi Karyawan Keluar (Resign)',
                'email_body' => get_name($id)." mengajukan permintaan rekomendasi karyawan keluar (resign), silakan klik tautan berikut untuk menginput data <a href=$url>$url</a><br/>",
                'is_read' => 0,
            );
        $CI->db->insert('email', $data);
    }

    public function task_receiver($form, $id, $detail)
    {
        $CI =& get_instance();
        $sess_id = $CI->session->userdata('user_id');
        $url = base_url().'form_'.$form.'/submit/'.$id;

        switch ($form) {
            case "spd_dalam":
            case "spd_luar":
                $user_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $receiver_id = getValue('task_receiver', 'users_'.$form, array('id'=>'where/'.$id));
                $form = ($form == 'spd_dalam') ? 'Dalam Kota' : 'Luar Kota';
                $form = 'Perjalanan Dinas'.' '.ucfirst($form);

                $data = array(
                    'sender_id' => get_nik($sess_id),
                    'receiver_id' => $receiver_id,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => get_form_no($id).'[Approved]Status Pengajuan Permohonan '.ucfirst($form).' dari HRD',
                    'email_body' => "Status pengajuan $form yang diajukan oleh ".get_name($user_id).' untuk anda, disetujui oleh '.get_name($sess_id)." untuk detail silakan <a class='klikmail' href=$url>Klik Disini</a><br />".$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>',
                    'is_read' => 0,
                );
                if($CI->db->insert('email', $data)) return TRUE;
            break;
            case "spd_dalam_group":
            case "spd_luar_group":
                $user_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $receivers_id = getValue('task_receiver', 'users_'.$form, array('id'=>'where/'.$id));
                $receiver_id = explode(',',$receivers_id);
                $form = ($form == 'spd_dalam_group') ? 'Dalam Kota (Group)' : 'Luar Kota (Group)';
                $form = 'Perjalanan Dinas'.' '.ucfirst($form);

                for($i=0;$i<sizeof($receiver_id);$i++):
                    $data = array(
                        'sender_id' => get_nik($sess_id),
                        'receiver_id' => $receiver_id[$i],
                        'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                        'subject' => get_form_no($id).'[Approved]Status Pengajuan Permohonan '.ucfirst($form).' dari HRD',
                        'email_body' => "Status pengajuan $form yang diajukan oleh ".get_name($user_id).' untuk anda, disetujui oleh '.get_name($sess_id)." untuk detail silakan <a class='klikmail' href=$url>Klik Disini</a><br />".$detail.'<br />untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a>',
                        'is_read' => 0,
                    );
                    if($CI->db->insert('email', $data)) return TRUE;
                endfor;
            break;
        }
    }

    public function approver($form)
    {
        $form_type_id = getValue('id', 'form_type', array('title'=>'like/'.$form));
        $approver = getValue('user_nik', 'users_approval', array('form_type_id'=>'where/'.$form_type_id));

        return $approver;
    }
}

/* End of file Approval.php */