<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approval {

    public function request($lv, $form, $id, $user_id, $detail)
    {
    	$CI =& get_instance();
    	$url = base_url().'form_'.$form.'/detail/'.$id;
        $user_app = getValue('user_app_'.$lv, 'users_'.$form, array('id'=>'where/'.$id));

    	switch ($form) {
            case "cuti":
                $form = 'Permohonan Cuti';
                $isi_email = get_name($user_id).' mengajukan '.$form.', untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br />'.$detail;
                break;
            case "absen":
                $form = 'Keterangan Tidak Absen';
                $isi_email = get_name($user_id).' mengajukan '.$form.', untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br />'.$detail;
                break;
            case "spd_dalam":
                $form = 'Perjalanan Dinas Dalam Kota';
                $isi_email = get_name($user_id).' membuat surat perintah perjalanan dinas dalam kota, untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br />'.$detail;
                break;
            case "spd_luar":
                $form = 'Perjalanan Dinas Luar Kota';
                $isi_email = get_name($user_id).' membuat surat perintah perjalanan dinas luar kota, untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br />'.$detail;
                break;
            case "spd_dalam_group":
                $form = 'Perjalanan Dinas Dalam Kota(Group)';
                $isi_email = get_name($user_id).' membuat surat perintah perjalanan dinas dalam kota(Group), untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br />'.$detail;
                break;
            case "spd_luar_group":
                $form = 'Perjalanan Dinas Luar Kota(Group)';
                $isi_email = get_name($user_id).' membuat surat perintah perjalanan dinas Luar kota(Group), untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br />'.$detail;
                break;
            case "promosi":
            	$form = 'Promosi Karyawan';
                $pengaju_id = $CI->session->userdata('user_id');
                $isi_email = get_name($pengaju_id).' mengajukan Promosi untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail;
            	break;
            case "demolition":
                $form = 'Demolition Karyawan';
                $pengaju_id = $CI->session->userdata('user_id');
                $isi_email = get_name($pengaju_id).' mengajukan Demolition untuk '.get_name($user_id).', untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br />'.$detail;
                break;
            case "recruitment":
                $form = 'Recruitment Karyawan';
                $isi_email = get_name($user_id).' mengajukan '.$form.', untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br />'.$detail;
                break;
            case "resignment":
                $form = 'Resign Karyawan';
                $isi_email = get_name($user_id).' mengajukan '.$form.', untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br />'.$detail;
                break;
            case "training":
                $form = 'Training Karyawan';
                $isi_email = get_name($user_id).' mengajukan '.$form.', untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br />'.$detail;
                break;
            case "training_group":
                $form = 'Training Karyawan (Group)';
                $isi_email = get_name($user_id).' mengajukan '.$form.', untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br />'.$detail;
                break;
            case "medical":
                $form = 'Rekapitulasi Rawat Inap';
                $isi_email = get_name($user_id).' membuat rekapitulasi rawat jalan dan inap, untuk melihat detail silakan <a class="klikmail" href='.$url.'>Klik Disini</a><br/>'.$detail;
                break;
            case "exit":
                $form = 'Rekomendasi Karyawan Keluar';
                $isi_email = get_name($user_id).' mengajukan '.$form.', untuk melihat detail silakan <a href='.$url.'>Klik Disini</a><br />'.$detail;
                break;
        }

        if($lv == 'hrd'){
        	$data = array(
                    'sender_id' => get_nik($user_id),
                    'receiver_id' => 1,
                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                    'subject' => 'Pengajuan '.ucfirst($form),
                    'email_body' => $isi_email,
                    'is_read' => 0,
                );
            $CI->db->insert('email', $data);
        }else{
	        if(!empty($user_app)):
	            $data = array(
	                    'sender_id' => get_nik($user_id),
	                    'receiver_id' => $user_app,
	                    'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
	                    'subject' => 'Pengajuan '.ucfirst($form),
	                    'email_body' => $isi_email,
	                    'is_read' => 0,
	                );
	            $CI->db->insert('email', $data);
	        endif;
        }
    }

    public function approve($form, $id, $approval_status, $detail)
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
            case "edit_user":
                $url = base_url().'edit_user_approval/'.$id;
                $receiver_id = getValue('user_id', 'users_edit_approval', array('id'=>'where/'.$id));
                $form = 'Perubahan Data Karywan';
                break;
            case "demolition":
                $receiver_id = getValue('created_by', 'users_'.$form, array('id'=>'where/'.$id));
                break;
            case "spd_dalam":
            case "spd_dalam_group":
            case "spd_luar":
            case "spd_luar_group":
                $receiver_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $receiver_id = get_id($receiver_id);
                $url = base_url().'form_'.$form.'/submit/'.$id;
                break;
            default:
            $receiver_id = getValue('user_id', 'users_'.$form, array('id'=>'where/'.$id));
        }

        $data = array(
                'sender_id' => get_nik($sess_id),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Status Pengajuan Permohonan '.ucfirst($form).' dari Atasan',
                'email_body' => "Status pengajuan $form anda $approval_status oleh $approver untuk detail silakan <a href=$url>Klik disini</a><br/>".$detail,
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
            case "demolition":
                $receiver_id = getValue('created_by', 'users_'.$form, array('id'=>'where/'.$id));
                break;
            case "spd_dalam":
            case "spd_dalam_group":
            case "spd_luar":
            case "spd_luar_group":
                $receiver_id = getValue('task_creator', 'users_'.$form, array('id'=>'where/'.$id));
                $receiver_id = get_id($receiver_id);
                $url = base_url().'form_'.$form.'/submit/'.$id;
                break;
            default:
            $receiver_id = getValue('user_id', 'users_'.$form, array('id'=>'where/'.$id));
        }

        $data = array(
                'sender_id' => get_nik($sess_id),
                'receiver_id' => get_nik($receiver_id),
                'sent_on' => date('Y-m-d-H-i-s',strtotime('now')),
                'subject' => 'Perubahan Status Pengajuan Permohonan '.ucfirst($form).' dari Atasan',
                'email_body' => "$approver melakukan perubahan status pengajuan $form anda menjadi $approval_status, untuk detail silakan <a href=$url>Klik disini</a><br/>".$detail,
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
}

/* End of file Approval.php */