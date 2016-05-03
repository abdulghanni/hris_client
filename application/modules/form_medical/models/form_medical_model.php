<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_medical_model extends CI_Model
{
     /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $tables = array();

    /**
     * Identity
     *
     * @var string
     **/
    public $identity;

    /**
     * Where
     *
     * @var array
     **/
    public $_ion_where = array();

    /**
     * Select
     *
     * @var array
     **/
    public $_ion_select = array();

    /**
     * Like
     *
     * @var array
     **/
    public $_ion_like = array();

    /**
     * Limit
     *
     * @var string
     **/
    public $_ion_limit = NULL;

    /**
     * Offset
     *
     * @var string
     **/
    public $_ion_offset = NULL;

    /**
     * Order By
     *
     * @var string
     **/
    public $_ion_order_by = NULL;

    /**
     * Order
     *
     * @var string
     **/
    public $_ion_order = NULL;

    /**
     * Hooks
     *
     * @var object
     **/
    protected $_ion_hooks;

    /**
     * Response
     *
     * @var string
     **/
    protected $response = NULL;

    /**
     * message (uses lang file)
     *
     * @var string
     **/
    protected $messages;

    /**
     * error message (uses lang file)
     *
     * @var string
     **/
    protected $errors;

    /**
     * error start delimiter
     *
     * @var string
     **/
    protected $error_start_delimiter;

    /**
     * error end delimiter
     *
     * @var string
     **/
    protected $error_end_delimiter;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->config('ion_auth', TRUE);
        $this->load->helper('cookie');
        $this->load->helper('date');
        $this->lang->load('ion_auth');

        //initialize db tables data
        $this->tables  = $this->config->item('tables', 'ion_auth');

        //initialize messages and error
        $this->messages    = array();
        $this->errors      = array();
        $delimiters_source = $this->config->item('delimiters_source', 'ion_auth');

        //load the error delimeters either from the config file or use what's been supplied to form validation
        if ($delimiters_source === 'form_validation')
        {
            //load in delimiters from form_validation
            //to keep this simple we'll load the value using reflection since these properties are protected
            $this->load->library('form_validation');
            $form_validation_class = new ReflectionClass("CI_Form_validation");

            $error_prefix = $form_validation_class->getProperty("_error_prefix");
            $error_prefix->setAccessible(TRUE);
            $this->error_start_delimiter = $error_prefix->getValue($this->form_validation);
            $this->message_start_delimiter = $this->error_start_delimiter;

            $error_suffix = $form_validation_class->getProperty("_error_suffix");
            $error_suffix->setAccessible(TRUE);
            $this->error_end_delimiter = $error_suffix->getValue($this->form_validation);
            $this->message_end_delimiter = $this->error_end_delimiter;
        }
        else
        {
            //use delimiters from config
            $this->message_start_delimiter = $this->config->item('message_start_delimiter', 'ion_auth');
            $this->message_end_delimiter   = $this->config->item('message_end_delimiter', 'ion_auth');
            $this->error_start_delimiter   = $this->config->item('error_start_delimiter', 'ion_auth');
            $this->error_end_delimiter     = $this->config->item('error_end_delimiter', 'ion_auth');
        }


        //initialize our hooks object
        $this->_ion_hooks = new stdClass;

        $this->trigger_events('model_constructor');
    }

    public function limit($limit)
    {
        $this->trigger_events('limit');
        $this->_ion_limit = $limit;

        return $this;
    }

    public function offset($offset)
    {
        $this->trigger_events('offset');
        $this->_ion_offset = $offset;

        return $this;
    }

    public function where($where, $value = NULL)
    {
        $this->trigger_events('where');

        if (!is_array($where))
        {
            $where = array($where => $value);
        }

        array_push($this->_ion_where, $where);

        return $this;
    }

    public function like($like, $value = NULL, $position = 'both')
    {
        $this->trigger_events('like');

        if (!is_array($like))
        {
            $like = array($like => array(
                'value'    => $value,
                'position' => $position,
            ));
        }

        array_push($this->_ion_like, $like);

        return $this;
    }

    public function select($select)
    {
        $this->trigger_events('select');

        $this->_ion_select[] = $select;

        return $this;
    }

    public function order_by($by, $order='desc')
    {
        $this->trigger_events('order_by');

        $this->_ion_order_by = $by;
        $this->_ion_order    = $order;

        return $this;
    }

    public function row()
    {
        $this->trigger_events('row');

        $row = $this->response->row();
        $this->response->free_result();

        return $row;
    }

    public function row_array()
    {
        $this->trigger_events(array('row', 'row_array'));

        $row = $this->response->row_array();
        $this->response->free_result();

        return $row;
    }

    public function result()
    {
        $this->trigger_events('result');

        $result = $this->response->result();
        $this->response->free_result();

        return $result;
    }

    public function result_array()
    {
        $this->trigger_events(array('result', 'result_array'));

        $result = $this->response->result_array();
        $this->response->free_result();

        return $result;
    }

    public function num_rows()
    {
        $this->trigger_events(array('num_rows'));

        $result = $this->response->num_rows();
        $this->response->free_result();

        return $result;
    }

    /**
     * form_medical
     *
     * @return object form_medical
     * @author Deni
     **/
    public function form_medical($id=null)
    {
        $this->trigger_events('form_medical');

        if (isset($this->_ion_select) && !empty($this->_ion_select))
        {
            foreach ($this->_ion_select as $select)
            {
                $this->db->select($select);
            }

            $this->_ion_select = array();
        }
        else
        {
            $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $is_approver = $this->approval->approver('medical', $sess_nik);
            $user = get_user_satu_bu($sess_nik);
            if(!empty(is_have_subordinate(get_nik($sess_id)))){
            $sub_id = get_subordinate($sess_id);
            }else{
                $sub_id = '';
            }
            $is_admin = is_admin();
            
            $is_admin_cabang = is_admin_cabang();
            //default selects
            $this->db->select(array(
                $this->tables['users_medical'].'.*',
                $this->tables['users_medical'].'.id as id',
                ));

            $this->db->join('users', 'users.id = users_medical.user_id', 'LEFT');
			
            $this->db->where('users_medical.is_deleted', 0);
            if($id != null)
            {
                $this->db->where('users_medical.id', $id);
            }
            if($is_approver == $sess_nik || $is_admin_cabang == 1){
                $this->db->where_in("users_medical.user_id", $user);
            }elseif($is_admin!=1){
                $this->db->where("(users_medical.user_id = $sess_id OR  users_medical.user_app_lv1 = '$sess_nik' OR users_medical.user_app_lv2 = '$sess_nik' OR users_medical.user_app_lv3 = '$sess_nik' OR users_medical.created_by = '$sess_id')",null, false);
            }

            $this->db->order_by('users_medical.id', 'desc');
        }

        $this->trigger_events('extra_where');

        //run each where that was passed

        if (isset($this->_ion_like) && !empty($this->_ion_like))
        {
            foreach ($this->_ion_like as $like)
            {
                $this->db->or_like($like);
            }

            $this->_ion_like = array();
        }

        if (isset($this->_ion_limit) && isset($this->_ion_offset))
        {
            $this->db->limit($this->_ion_limit, $this->_ion_offset);

            $this->_ion_limit  = NULL;
            $this->_ion_offset = NULL;
        }
        else if (isset($this->_ion_limit))
        {
            $this->db->limit($this->_ion_limit);

            $this->_ion_limit  = NULL;
        }

        //set the order
        if (isset($this->_ion_order_by) && isset($this->_ion_order))
        {
            $this->db->order_by($this->_ion_order_by, $this->_ion_order);

            $this->_ion_order    = NULL;
            $this->_ion_order_by = NULL;
        }

        $this->response = $this->db->get($this->tables['users_medical']);

        return $this;
    }

    public function form_medical_detail($id)
    {
        $r = getValue('user_medical_detail_id', 'users_medical', array('id'=>'where/'.$id));
        $r = explode(',', $r);
        $this->db->select('users_medical_detail.*, medical_hubungan.title as hubungan, medical_jenis_pemeriksaan.title as jenis');
        $this->db->from('users_medical_detail');

        $this->db->join('medical_hubungan', 'users_medical_detail.hubungan_id = medical_hubungan.id');
        $this->db->join('medical_jenis_pemeriksaan', 'users_medical_detail.jenis_pemeriksaan_id = medical_jenis_pemeriksaan.id');

        for($i=0;$i<sizeof($r)-1;$i++):
        $this->db->or_where('users_medical_detail.id',$r[$i]);
        endfor;

        $this->db->order_by('karyawan_id', 'asc');
        return $q = $this->db->get();
    }

    public function form_medical_hrd($id)
    {
        $r = getValue('user_medical_detail_id', 'users_medical', array('id'=>'where/'.$id));
        $r = explode(',', $r);
        $this->db->select('users_medical_detail.karyawan_id, users_medical_detail.pasien, medical_hubungan.title as hubungan, medical_jenis_pemeriksaan.title as jenis, users_medical_hrd.rupiah as rupiah, users_medical_hrd.is_approve');
        $this->db->from('users_medical_detail');

        $this->db->join('medical_hubungan', 'users_medical_detail.hubungan_id = medical_hubungan.id');
        $this->db->join('medical_jenis_pemeriksaan', 'users_medical_detail.jenis_pemeriksaan_id = medical_jenis_pemeriksaan.id');
        $this->db->join('users_medical_hrd', 'users_medical_detail.id = users_medical_hrd.user_medical_detail_id');

        for($i=0;$i<sizeof($r)-1;$i++):
        $this->db->or_where('users_medical_detail.id',$r[$i]);
        endfor;

        $this->db->order_by('karyawan_id', 'asc');
        return $q = $this->db->get();
    }

    public function get_total_medical_hrd($id)
    {
        $r = getValue('user_medical_detail_id', 'users_medical', array('id'=>'where/'.$id));
        $r = explode(',', $r);
        $qq = '';
        for($i=0;$i<sizeof($r)-1;$i++):
            if($i == sizeof($r)-2){
                 $qq.= ' user_medical_detail_id = '.$r[$i];
            }else{
            $qq.= ' user_medical_detail_id = '.$r[$i].' OR ';
        }
        endfor;

        $this->db->select_sum('users_medical_hrd.rupiah');
        $this->db->from('users_medical_detail');

        $this->db->join('users_medical_hrd', 'users_medical_detail.id = users_medical_hrd.user_medical_detail_id');
        $this->db->where('is_approve', 1);

        //$this->db->or_where('users_medical_detail.id',$r[$i]);
        $this->db->where("($qq)",null, false);

        $this->db->order_by('karyawan_id', 'asc');
        return $q = $this->db->get()->row('rupiah');
    }

    public function delete($id)
    {
        $this->trigger_events('pre_delete_frm_medical');

        $this->db->trans_begin();

        // delete organization from users_medical table
        $this->db->delete($this->tables['users_medical'], array('id' => $id));

        // if user does not exist in database then it returns FALSE else removes the user from groups
        if ($this->db->affected_rows() == 0)
        {
            return FALSE;
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->trigger_events(array('post_delete_frm_medical', 'post_delete_frm_medical_unsuccessful'));
            $this->set_error('delete_unsuccessful');
            return FALSE;
        }

        $this->db->trans_commit();

        $this->trigger_events(array('post_delete_frm_medical', 'post_delete_frm_medical_successful'));
        $this->set_message('delete_successful');
        return TRUE;
    }

    public function create_($user_id = FALSE, $additional_data = array())
    {

        $data = array('user_id'=>$user_id);

        //filter out any data passed that doesnt have a matching column in the form medical table
        //and merge the set group data and the additional data
        if (!empty($additional_data)) $data = array_merge($this->_filter_data($this->tables['users_medical'], $additional_data), $data);

        $this->trigger_events('extra_group_set');

        // insert the new form_medical
        $this->db->insert($this->tables['users_medical'], $data);
        $id = $this->db->insert_id();

        // report success
        $this->set_message('frm_medical_creation_successful');
        // return the brand new id
        return $id;
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users_medical', $data);
    }

    public function trigger_events($events)
    {
        if (is_array($events) && !empty($events))
        {
            foreach ($events as $event)
            {
                $this->trigger_events($event);
            }
        }
        else
        {
            if (isset($this->_ion_hooks->$events) && !empty($this->_ion_hooks->$events))
            {
                foreach ($this->_ion_hooks->$events as $name => $hook)
                {
                    $this->_call_hook($events, $name);
                }
            }
        }
    }

    /**
     * set_message_delimiters
     *
     * Set the message delimiters
     *
     * @return void
     * @author Ben Edmunds
     **/
    public function set_message_delimiters($start_delimiter, $end_delimiter)
    {
        $this->message_start_delimiter = $start_delimiter;
        $this->message_end_delimiter   = $end_delimiter;

        return TRUE;
    }

    /**
     * set_error_delimiters
     *
     * Set the error delimiters
     *
     * @return void
     * @author Ben Edmunds
     **/
    public function set_error_delimiters($start_delimiter, $end_delimiter)
    {
        $this->error_start_delimiter = $start_delimiter;
        $this->error_end_delimiter   = $end_delimiter;

        return TRUE;
    }

    /**
     * set_message
     *
     * Set a message
     *
     * @return void
     * @author Ben Edmunds
     **/
    public function set_message($message)
    {
        $this->messages[] = $message;

        return $message;
    }

    /**
     * messages
     *
     * Get the messages
     *
     * @return void
     * @author Ben Edmunds
     **/
    public function messages()
    {
        $_output = '';
        foreach ($this->messages as $message)
        {
            $messageLang = $this->lang->line($message) ? $this->lang->line($message) : '##' . $message . '##';
            $_output .= $this->message_start_delimiter . $messageLang . $this->message_end_delimiter;
        }

        return $_output;
    }

    /**
     * messages as array
     *
     * Get the messages as an array
     *
     * @return array
     * @author Raul Baldner Junior
     **/
    public function messages_array($langify = TRUE)
    {
        if ($langify)
        {
            $_output = array();
            foreach ($this->messages as $message)
            {
                $messageLang = $this->lang->line($message) ? $this->lang->line($message) : '##' . $message . '##';
                $_output[] = $this->message_start_delimiter . $messageLang . $this->message_end_delimiter;
            }
            return $_output;
        }
        else
        {
            return $this->messages;
        }
    }

    /**
     * set_error
     *
     * Set an error message
     *
     * @return void
     * @author Ben Edmunds
     **/
    public function set_error($error)
    {
        $this->errors[] = $error;

        return $error;
    }

    /**
     * errors
     *
     * Get the error message
     *
     * @return void
     * @author Ben Edmunds
     **/
    public function errors()
    {
        $_output = '';
        foreach ($this->errors as $error)
        {
            $errorLang = $this->lang->line($error) ? $this->lang->line($error) : '##' . $error . '##';
            $_output .= $this->error_start_delimiter . $errorLang . $this->error_end_delimiter;
        }

        return $_output;
    }

    /**
     * errors as array
     *
     * Get the error messages as an array
     *
     * @return array
     * @author Raul Baldner Junior
     **/
    public function errors_array($langify = TRUE)
    {
        if ($langify)
        {
            $_output = array();
            foreach ($this->errors as $error)
            {
                $errorLang = $this->lang->line($error) ? $this->lang->line($error) : '##' . $error . '##';
                $_output[] = $this->error_start_delimiter . $errorLang . $this->error_end_delimiter;
            }
            return $_output;
        }
        else
        {
            return $this->errors;
        }
    }

    protected function _filter_data($table, $data)
    {
        $filtered_data = array();
        $columns = $this->db->list_fields($table);

        if (is_array($data))
        {
            foreach ($columns as $column)
            {
                if (array_key_exists($column, $data))
                    $filtered_data[$column] = $data[$column];
            }
        }

        return $filtered_data;
    }

    public function frm_medical($id = NULL)
    {
        $this->trigger_events('frm_medical');

        $this->limit(1);
        $this->where($this->tables['users_medical'].'.id', $id);

        $this->form_medical();

        return $this;
    }

    
    
}