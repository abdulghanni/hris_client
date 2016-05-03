<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_training_group_model extends CI_Model
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
     * form_training_group
     *
     * @return object form_training_group
     * @author Deni
     **/
    public function form_training_group($id = null)
    {
        $this->trigger_events('form_training_group');

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
            $is_approver = $this->approval->approver('training', $sess_nik);
            $is_admin = is_admin();
            $is_admin_legal = is_admin_legal();
            $is_admin_cabang = is_admin_cabang();
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
                $this->tables['users_training_group'].'.*',
                $this->tables['users_training_group'].'.id as id',
                $this->tables['penyelenggara'].'.title as penyelenggara',
                $this->tables['pembiayaan'].'.title as pembiayaan',
                $this->tables['training_type'].'.title as training_type',
                'training_ikatan_dinas.title as ikatan',
                'training_waktu.title as waktu',
                'status_lv1.title as approval_status_lv1',
                'status_lv2.title as approval_status_lv2',
                'status_lv3.title as approval_status_lv3',
                'status_hrd.title as approval_status_hrd',
            ));

            $this->db->join('users', 'users_training_group.user_pengaju_id = users.id', 'left');
            $this->db->join('penyelenggara', 'users_training_group.penyelenggara_id = penyelenggara.id', 'LEFT');
            $this->db->join('pembiayaan', 'users_training_group.pembiayaan_id = pembiayaan.id', 'LEFT');
            $this->db->join('training_type', 'users_training_group.training_type_id = training_type.id', 'LEFT');
            $this->db->join('training_ikatan_dinas', 'users_training_group.ikatan_dinas_id = training_ikatan_dinas.id', 'LEFT');
            $this->db->join('training_waktu', 'users_training_group.waktu_id = training_waktu.id', 'LEFT');
            $this->db->join('approval_status as status_lv1', 'users_training_group.approval_status_id_lv1 = status_lv1.id', 'left');
            $this->db->join('approval_status as status_lv2', 'users_training_group.approval_status_id_lv2 = status_lv2.id', 'left');
            $this->db->join('approval_status as status_lv3', 'users_training_group.approval_status_id_lv3 = status_lv3.id', 'left');
            $this->db->join('approval_status as status_hrd', 'users_training_group.approval_status_id_hrd = status_hrd.id', 'left');
            if($id != null)$this->db->where('users_training_group.id', $id);
            $this->db->where('users_training_group.is_deleted', 0);
            if($is_approver == $sess_nik || $is_admin_cabang == 1){
                $this->db->where_in("users_training_group.user_pengaju_id", $user);
            }elseif($is_admin!=1 && $is_admin_legal !=1){
                //$this->db->where("(users_training_group.user_id= $sess_id $sub_id $subsub_id )",null, false);
                $this->db->where("(users_training_group.user_pengaju_id = $sess_id OR users_training_group.user_peserta_id like '%$sess_nik%' OR  users_training_group.user_app_lv1 = '$sess_nik' OR users_training_group.user_app_lv2 = '$sess_nik' OR users_training_group.user_app_lv3 = '$sess_nik' OR users_training_group.created_by = '$sess_id')",null, false);
            }
            
            
            $this->db->order_by('users_training_group.id', 'desc');
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

        $this->response = $this->db->get($this->tables['users_training_group']);

        return $this;
    }
   
    public function render_session()
    {
         $this->trigger_events('form_training_group_input');

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
            //default selects
            $this->db->select(array(
                $this->tables['comp_session'].'.*',
                $this->tables['comp_session'].'.id as id',
                $this->tables['comp_session'].'.id as user_id',

                $this->tables['comp_session'].'.title as title',
                $this->tables['comp_session'].'.year as year'
            ));


            $this->db->where('comp_session.is_deleted', 0);
        }

        $this->trigger_events('extra_where');

        //run each where that was passed

        if (isset($this->_ion_where) && !empty($this->_ion_where))
        {
            foreach ($this->_ion_where as $where)
            {
                $this->db->where($where);
            }

            $this->_ion_where = array();
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

        $this->response = $this->db->get($this->tables['comp_session']);

        return $this;
    }

    public function get_comp_session_id()
    {
        $this->trigger_events('form_training_group_input');

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
            //default selects
            $this->db->select(array(
                $this->tables['comp_session'].'.*',
                $this->tables['comp_session'].'.id as id',
                $this->tables['comp_session'].'.id as user_id',
            ));
            
        }

        $this->trigger_events('extra_where');

        //run each where that was passed

        if (isset($this->_ion_where) && !empty($this->_ion_where))
        {
            foreach ($this->_ion_where as $where)
            {
                $this->db->where($where);
            }

            $this->_ion_where = array();
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

        $this->response = $this->db->get($this->tables['users']);

        return $this;
    }

    public function delete($id)
    {
        $this->trigger_events('pre_delete_frm_training');

        $this->db->trans_begin();

        // delete organization from users_training_group table
        $this->db->delete($this->tables['users_training_group'], array('id' => $id));

        // if user does not exist in database then it returns FALSE else removes the user from groups
        if ($this->db->affected_rows() == 0)
        {
            return FALSE;
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->trigger_events(array('post_delete_frm_training', 'post_delete_frm_training_unsuccessful'));
            $this->set_error('delete_unsuccessful');
            return FALSE;
        }

        $this->db->trans_commit();

        $this->trigger_events(array('post_delete_frm_training', 'post_delete_frm_training_successful'));
        $this->set_message('delete_successful');
        return TRUE;
    }

    public function create_($user_id = FALSE, $additional_data = array())
    {

        $data = array('user_pengaju_id'=>$user_id);

        //filter out any data passed that doesnt have a matching column in the form training table
        //and merge the set group data and the additional data
        if (!empty($additional_data)) $data = array_merge($this->_filter_data($this->tables['users_training_group'], $additional_data), $data);

        $this->trigger_events('extra_group_set');

        // insert the new form_training_group
        $this->db->insert($this->tables['users_training_group'], $data);
        $id = $this->db->insert_id();

        // report success
        $this->set_message('frm_training_creation_successful');
        // return the brand new id
        return $id;
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users_training_group', $data);
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

    public function frm_training($id = NULL)
    {
        $this->trigger_events('frm_training');

        $this->limit(1);
        $this->where($this->tables['users_training_group'].'.id', $id);

        $this->form_training_group();

        return $this;
    }

    
    
}