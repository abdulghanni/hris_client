<?php defined('BASEPATH') OR exit('No direct script access allowed');

class notif_reminder extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();

        $this->load->database();
        //$this->load->model('notif_tambahan_model');

    }

    function cek(){
        //$this->load->library('email');
        $notif_reminder_var = getValue('var', 'notif_reminder_var');
        $now = new DateTime();
        $f_form = array('form_name'=>'where/cuti');
        $form = GetAll('form_id')->result();
        for($i=1;$i<4;$i++){
            foreach ($form as $f) {
                $form_name = $f->form_name;
                switch ($form_name) {
                    case 'Demosi':
                        $form_name = "demotion";
                        $subject_email = "Demosi";
                        break;
                    case 'pjd':
                        $form_name = "spd_luar_group";
                        $subject_email = "Perjalanan Dinas";
                        break;
                    case 'training':
                    case 'training-group':
                        $form_name = "training_group";
                        $subject_email = "Pelatihan";
                        break;
                    case 'absen':
                        $form_name = "absen";
                        $subject_email = "Keterangan Tidak Absen";
                    break;
                    case 'tidak-masuk':
                        $form_name = "tidak_masuk";
                        $subject_email = "Izin Tidak Masuk";
                    break;
                    case 'rolling':
                        $form_name = "rolling";
                        $subject_email = "Mutasi";
                    break;
                    case 'pemutusan':
                        $form_name = "pemutusan";
                        $subject_email = "Pemutusan Kontrak";
                    break;
                    case 'recruitment':
                        $form_name = "recruitment";
                        $subject_email = "Permintaan SDM Baru";
                    break;
                    case 'resignment':
                        $form_name = "resignment";
                        $subject_email = "Pengunduran Diri";
                    break;
                    case 'exit':
                        $form_name = "exit";
                        $subject_email = "Rekomendasi Karyawan Keluar";
                    break;

                    default:
                        $form_name = $form_name;
                        $subject_email = $form_name;
                        break;
                }

                $is_app = 'is_app_lv'.$i;
                $u = "user_app_lv".$i;
                $f_app = array($is_app=>'where/0','is_deleted'=>'where/0');
                $app = GetAll('users_'.$form_name, $f_app)->result();
                $base_url_ = 'http://10.1.1.13/hris_client/';

                foreach ($app as $a) {
                    $created_on = new DateTime($a->created_on);
                    $diff = $created_on->diff($now);
                    $diff = $diff->days;
                    $user_app = $a->$u;
                       if($diff > $notif_reminder_var && $diff < 30 && !empty($user_app)){
                            if($form_name == "spd_luar_group"){
                                $url = $base_url_.'form_pjd/submit/'.$a->id;
                            }else{
                                $url = $base_url_.'form_'.$form_name.'/detail/'.$a->id;
                            }
                            $subject_emailx = "Reminder Approval Pengajuan ".ucfirst($subject_email);
                            $isi_email = 'pengajuan '.$subject_email.' No : '.$a->id.' menunggu Approval dari anda, silakan <a class="klikmail" href='.$url.'>Klik Disini untuk melihat pengajuan melalui WEB HRIS PT. Erlangga</a><br />';
                            $user_bu = $this->get_user_bu($user_app);
                            $f =  array('form_type_id'=>'where/'.$f->id, 'bu'=>'where/'.$user_bu);
                            $cc = getValue('user_nik', 'users_notif_cc',$f);
                            if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), $subject_emailx, $isi_email, getEmail($cc));
                            print_r($user_app.' ---- '.$subject_emailx.'<br/>'.$isi_email.$cc.'<br/><br/><br/>');
                            echo "<br/>";//die();
                       }
                }
            }
        }
    }
    function cc_atasan(){
      error_reporting(E_ALL);
      /*

      is_app_lv1_akunting=1 AND
      is_app_lv1_audit=1 AND
      is_app_lv1_hrd=1 AND
      is_app_lv1_it=1 AND
      is_app_lv1_keuangan=1 AND
      is_app_lv1_koperasi=1 AND
      is_app_lv1_logistik=1 AND
      is_app_lv1_perpus=1 AND
      is_app_lv1=1 AND
      is_app_lv2=1 AND
      is_app_lv3=1 AND
      is_app_mgr=1 AND

      */

          $form_name = "exit";
          $subject_email = "Rekomendasi Karyawan Keluar";
          $base_url_ = 'http://10.1.1.13/hris_client/';

      $exit=$this->db->query(
        "SELECT * FROM users_exit WHERE
        is_app_akunting=1 AND
        is_app_asset=1 AND
        is_app_audit=1 AND
        is_app_hrd=1 AND
        is_app_it=1 AND
        is_app_keuangan=1 AND
        is_app_koperasi=1 AND
        is_app_perpus=1 AND
        sent_notification=0
        "
      )->result();

      //echo $this->db->last_query();
      foreach($exit as $ex){
        $bu=get_user_buid(GetValue('nik','users',array('id'=>'where/'.$ex->user_id)));
        if($bu=='50' || $bu=='51'){
          $url = $base_url_.'form_'.$form_name.'/detail/'.$ex->id;
          $subject_emailx = "Reminder Approval Pengajuan ".ucfirst($subject_email);
          $isi_email = 'pengajuan '.$subject_email.' No : '.$ex->id.' menunggu Approval dari anda, silakan <a class="klikmail" href='.$url.'>Klik Disini untuk melihat pengajuan melalui WEB HRIS PT. Erlangga</a><br />';

          $send=$this->send_email(getEmail('P0227'), $subject_emailx, $isi_email);
          if($send){
            $this->db->query("UPDATE users_exit SET sent_notification=1,sent_notification_date='".DATE('Y-m-d H:i:s')."' WHERE id='".$ex->id."'");
          }
          //echo "kirim";
        }
      }

    }
}
