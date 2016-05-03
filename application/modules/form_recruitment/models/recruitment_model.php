<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recruitment_model extends CI_Model
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

    public function where($where = 'users_recruitment.is_deleted', $value = NULL)
    {
        $this->trigger_events('where');

        if (!is_array($where))
        {
            $where = array($where => $value);
        }

        array_push($this->_ion_where, $where);

        return $this;
    }

    public function like($like, $value = NULL, $recruitment = 'both')
    {
        $this->trigger_events('like');

        if (!is_array($like))
        {
            $like = array($like => array(
                'value'    => $value,
                'recruitment' => $recruitment,
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
     * recruitment
     *
     * @return object recruitment
     * @author Abdul Ghanni
     **/
    public function recruitment($id = null)
    {
        $this->trigger_events('recruitment');

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
            $admin = is_admin();
            $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $is_admin_cabang = is_admin_cabang();$user = get_user_satu_bu($sess_nik);
            $is_approver = $this->approval->approver('recruitment', $sess_nik);

            if(!empty(is_have_subordinate(get_nik($sess_id)))){
            $sub_id = get_subordinate($sess_id);
            }else{
                $sub_id = '';
            }

            if(!empty(is_have_subsubordinate($sess_id))){
            $subsub_id = 'OR '.get_subsubordinate($sess_id);
            }else{
                $subsub_id = '';
            }

            //default selects
            $this->db->select(array(
            $this->tables['recruitment'].'.*',
            $this->tables['recruitment'].'.id as id',
            $this->tables['recruitment'].'.created_on as date_created',
            'kualifikasi'.'.*', 'kemampuan'.'.*',
            'status.title as status', 'urgensi.title as urgensi',
            'jurusan.title as jurusan', 'ipk.title as ipk','toefl.title as toefl',
            'brevet.title as brevet'
            ));
            
            
            $this->db->join('users', 'users_recruitment.user_id = users.id', 'left');
            $this->db->join('users_recruitment_kualifikasi as kualifikasi', 'users_recruitment.id = kualifikasi.user_recruitment_id', 'left');
            $this->db->join('users_recruitment_kemampuan as kemampuan', 'users_recruitment.id = kemampuan.user_recruitment_id', 'left');
            $this->db->join('recruitment_status as status', 'users_recruitment.status_id = status.id', 'left');
            $this->db->join('recruitment_urgensi as urgensi', 'users_recruitment.urgensi_id = urgensi.id', 'left');
            $this->db->join('recruitment_jurusan as jurusan', 'kualifikasi.jurusan = jurusan.id', 'left');
            $this->db->join('recruitment_brevet as brevet', 'kemampuan.brevet_id = brevet.id', 'left');
            $this->db->join('ipk as ipk', 'kualifikasi.ipk = ipk.id', 'left');
            $this->db->join('toefl as toefl', 'kualifikasi.toefl = toefl.id', 'left');
           
            $this->db->where('users_recruitment.is_deleted', 0);
            //$this->db->where('users.active', 0);
            //$this->db->where('receiver_id', (!empty($nik)) ? $nik : $this->session->userdata('user_id'));
            $this->db->order_by('users_recruitment.id', 'desc');
            if($is_approver == $sess_nik || $is_admin_cabang == 1){
                $this->db->where_in("users_recruitment.user_id", $user);
            }elseif($is_admin!=1){
                //$this->db->where("(users_recruitment.user_id= $sess_id $sub_id $subsub_id )",null, false);
                $this->db->where("(users_recruitment.user_id = $sess_id OR  users_recruitment.user_app_lv1 = '$sess_nik' OR users_recruitment.user_app_lv2 = '$sess_nik' OR users_recruitment.user_app_lv3 = '$sess_nik' OR users_recruitment.created_by = '$sess_id')",null, false);
            }
            if($id != null)
            {
                $this->db->where('users_recruitment.id', $id);
            }
            
        }
        
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

        $this->response = $this->db->get($this->tables['recruitment']);

        return $this;
    }

    
    public function get_jk($r = array())
    {
        $x = '';
        for ($i=0; $i <sizeof($r) ; $i++) { 
            if($i<1){
            $this->db->where('id', $r[$i]);
            }else{  
            $this->db->or_where('id', $r[$i]);  
            }
        }

        $q = $this->db->get('jenis_kelamin');
        return $q;
    }

    public function get_pendidikan($r = array())
    {
        $x = '';
        for ($i=0; $i <sizeof($r) ; $i++) { 
            if($i<1){
            $this->db->where('id', $r[$i]);
            }else{  
            $this->db->or_where('id', $r[$i]);  
            }
        }

        $q = $this->db->get('recruitment_pendidikan');
        return $q;
    }

    public function get_komputer($r = array())
    {
        $x = '';
        for ($i=0; $i <sizeof($r) ; $i++) { 
            if($i<1){
            $this->db->where('id', $r[$i]);
            }else{  
            $this->db->or_where('id', $r[$i]);  
            }
        }

        $q = $this->db->get('recruitment_komputer');
        return $q;
    }
    


    public function delete($ids, $data)
    {
       $ids = $ids;
       $count = 0;
        foreach ($ids as $id){

            $this->db->where('id', $id);
            $this->db->update('recruitment', $data);  
            $count = $count+1;
       }
       
        $count = 0;
    }

    public function create_($data1)
    {
        // insert the new recruitment
        $this->db->insert($this->tables['recruitment'], $data1);
        return TRUE;
    }

    public function update($id, array $data)
    {
        $this->trigger_events('pre_update_pos');

        $pos = $this->pos($id)->row();

        $this->db->trans_begin();

        // Filter the data passed
        $data = $this->_filter_data($this->tables['recruitment'], $data);

        $this->trigger_events('extra_where');
        $this->db->update($this->tables['recruitment'], $data, array('id' => $id));

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();

            $this->trigger_events(array('post_update_pos', 'post_update_pos_unsuccessful'));
            $this->set_error('update_unsuccessful');
            return FALSE;
        }

        $this->db->trans_commit();

        $this->trigger_events(array('post_update_pos', 'post_update_pos_unsuccessful'));
        $this->set_message('update_successful');
        return TRUE;
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

    public function pos($id = NULL)
    {
        $this->trigger_events('org_class');

        $this->limit(1);
        $this->where($this->tables['recruitment'].'.id', $id);

        $this->recruitment();

        return $this;
    }

    
    
}