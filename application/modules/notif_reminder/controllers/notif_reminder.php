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
        $this->load->library('email');
        $notif_reminder_var = getValue('var', 'notif_reminder_var');
        $now = new DateTime();
        $f_form = array('form_name'=>'where/cuti');
        $form = GetAllSelect('form_id', 'form_name')->result();
        for($i=1;$i<4;$i++){
            foreach ($form as $f) {
                $form_name = $f->form_name;
                switch ($form_name) {
                    case 'Demosi':
                        $form_name = "demotion";
                        break;
                    case 'pjd':
                        $form_name = "spd_luar_group";
                        break;
                    case 'training':
                    case 'training-group':
                        $form_name = "training_group";
                        break;
                    case 'tidak-masuk':
                        $form_name = "tidak_masuk";
                    break;
                    
                    default:
                        $form_name = $form_name;
                        break;
                }

                $is_app = 'is_app_lv'.$i;
                $u = "user_app_lv".$i;
                $f_app = array($is_app=>'where/0');
                $app = GetAll('users_'.$form_name, $f_app)->result();

                foreach ($app as $a) {
                    $created_on = new DateTime($a->created_on);
                    $diff = $created_on->diff($now);
                    $diff = $diff->days;
                    $user_app = $a->$u;
                       if($diff > $notif_reminder_var && $diff < 30 && !empty($user_app)){
                            echo $a->id." - $form_name <br/>";
                            echo $user_app." <br/>";
                            $subject_email = "Reminder Approval Pengajuan ".$form_name;
                            $isi_email = "Ada pengajuan yang membutuhkan Approval dari anda, silakan mengakses WEB-HRIS PT. Erlangga untuk melihat pengajuan yang belum anda approve ";
                            if(!empty(getEmail($user_app)))$this->send_email(getEmail($user_app), $subject_email, $isi_email);
                            print_r($this->email->print_debugger());
                            echo "<br/>";//die();
                       }
                }
            }
        }
    }
}