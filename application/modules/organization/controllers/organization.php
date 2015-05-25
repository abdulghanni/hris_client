<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Organization extends MX_Controller {

    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        
        $this->load->database();
        $this->load->model('organization/organization_model','organization_model');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');

    }

    //redirect if needed, otherwise display the user list
    function index()
    {

        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin())
        {
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
			
            $organization = $this->organization_model->getOrganization();
			$menu=$this->get_menu($organization->result(),0);
			$this->data['menu'] = $menu;
            $this->data['organization'] = $organization;

            $f_organization_class = array("is_deleted" => 0);
            $q_organization_class = GetAll('organization_class', $f_organization_class);
            $this->data['q_organization_class'] = $q_organization_class;
            $this->data['organization_class'] = ($q_organization_class->num_rows() > 0 ) ? $q_organization_class : array();

            $f_organization = array("is_deleted" => 0);
            $q_organization = GetAll('organization', $f_organization);
            $this->data['q_organization'] = $q_organization;
            $this->data['parent'] = ($q_organization->num_rows() > 0 ) ? $q_organization : array();

            $this->_render_page('organization/index', $this->data);
        }
    }

	public function get_menu($results,$parent_id)
	{
		$menu='</span><ul>';
		for($i=0;$i<sizeof($results);$i++)
		{
			if($results[$i]->parent_id==$parent_id)
			{
				$btnadd = '<button type="button" class="btn btn-primary btn-mini" data-toggle="modal" data-target="#addModal'.$results[$i]->id.'" style="margin-top:10px;"><i class="icon-plus"></i>&nbsp;'.lang('add_button').' '.$results[$i]->organization_class.'</button>';
				$btnedit = '</span>&nbsp;<button type="button" class="btn btn-info btn-mini" title="'.lang('edit_button').'" data-toggle="modal" data-target="#editorganizationModal'.$results[$i]->id.'"><i class="icon-paste"></i></button>';
				$btndelete = '&nbsp;<button class="btn btn-danger btn-mini" type="button" title="'.lang('delete_button').'" data-toggle="modal" data-target="#deleteModal'.$results[$i]->id.'"><i class="icon-warning-sign"></i></button>';
				if($this->has_child($results,$results[$i]->id))
				{
					$sub_menu= $this->get_menu($results,$results[$i]->id);
					$menu.='<li><span><i class="icon-minus-sign"></i>&nbsp;'.$results[$i]->title.'&nbsp;-&nbsp;'.$results[$i]->organization_class.$btnedit.$btndelete.$sub_menu.$btnadd.'</li>';
				}
				else
				{
					$menu.='<li><span><i class="icon-minus-sign"></i>&nbsp;'.$results[$i]->title.'&nbsp;-&nbsp;'.$results[$i]->organization_class.$btnedit.$btndelete.'<br />'.$btnadd.'</li>';
				}
				
			}
		}
		$menu.='</ul>';
		return $menu;
	}
	public function has_child($results,$id)
	{
		for($i=0;$i<sizeof($results);$i++)
		{
			if($results[$i]->parent_id==$id)
			{
				return true;
			}
		}
		return false;
	}
	
	function get_table()
	{
		if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
        {
            //redirect them to the home page because they must be an administrator to view this
            //return show_error('You must be an administrator to view this page.');
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
			$organization = $this->organization_model->getOrganization();
			$menu=$this->get_menu($organization->result(),0);
			$this->data['menu'] = $menu;
            $this->data['organization'] = $organization;
			
			$this->_render_page('organization/table/index', $this->data);
		}
	}
	
	function get_modal()
	{
		if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
        {
            //redirect them to the home page because they must be an administrator to view this
            //return show_error('You must be an administrator to view this page.');
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
			$organization = $this->organization_model->getOrganization();

            $this->data['organization'] = $organization;

            $f_organization_class = array("is_deleted" => 0);
            $q_organization_class = GetAll('organization_class', $f_organization_class);
            $this->data['q_organization_class'] = $q_organization_class;
            $this->data['organization_class'] = ($q_organization_class->num_rows() > 0 ) ? $q_organization_class : array();

            $f_organization = array("is_deleted" => 0);
            $q_organization = GetAll('organization', $f_organization);
            $this->data['q_organization'] = $q_organization;
            $this->data['parent'] = ($q_organization->num_rows() > 0 ) ? $q_organization : array();

            $this->_render_page('organization/modal/index', $this->data);
		}
	}

    function add()
    {
		if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin())
        {
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
			$this->form_validation->set_rules('title','Title','trim|required');
			 if($this->form_validation->run() == FALSE)
			{
				echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
			}
			else
			{       
				$data = array(
						'title' => $this->input->post('title'),
						'parent_organization_id' => $this->input->post('parent_organization_id'),
						'organization_class_id' => $this->input->post('organization_class_id'),
						'created_on'        => date('Y-m-d H:i:s',strtotime('now')),
						'created_by'        => $this->session->userdata('user_id'),
					);
				$this->organization_model->add($data);
				
				echo json_encode(array('st'=>1));
            
			}
		}
    }
	
	function update($id)
	{
		if (!$this->ion_auth->logged_in())
			{
				redirect('auth/login', 'refresh');
			}
			elseif (!$this->ion_auth->is_admin())
			{
				return show_error('You must be an administrator to view this page.');
			}
			else
			{
				$this->form_validation->set_rules('title','Title','trim|required');
				 if($this->form_validation->run() == FALSE)
				{
					echo json_encode(array('st'=>0, 'errors'=>validation_errors('<div class="alert alert-danger" role="alert">', '</div>')));
				}
				else
				{       
					$data = array(
							'title' => $this->input->post('title'),
							'parent_organization_id' => $this->input->post('parent_organization_id'),
							'organization_class_id' => $this->input->post('organization_class_id'),
							'edited_on'        => date('Y-m-d H:i:s',strtotime('now')),
							'edited_by'        => $this->session->userdata('user_id'),
						);
					$this->organization_model->update($id, $data);
					
					echo json_encode(array('st'=>1));
				
				}
			}
	}
	
	function delete($id)
	{
		if (!$this->ion_auth->logged_in())
			{
				redirect('auth/login', 'refresh');
			}
			elseif (!$this->ion_auth->is_admin())
			{
				return show_error('You must be an administrator to view this page.');
			}
			else
			{
				$data = array(
							'is_deleted'		=> 1,
							'deleted_on'        => date('Y-m-d H:i:s',strtotime('now')),
							'deleted_by'        => $this->session->userdata('user_id'),
						);
				$this->organization_model->update($id, $data);
					
				echo json_encode(array('st'=>1));
			}
	}

    function _render_page($view, $data=null, $render=false)
    {
        // $this->viewdata = (empty($data)) ? $this->data: $data;
        // $view_html = $this->load->view($view, $this->viewdata, $render);
        // if (!$render) return $view_html;
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

            /*if ( ! in_array($view, array('auth/index')))
            {*/
                if(in_array($view, array('organization/index')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('jquery.min.js');
                    $this->template->add_js('bootstrap.min.js');

                    $this->template->add_js('jquery-ui-1.10.1.custom.min.js');
                    $this->template->add_js('jquery.sidr.min.js');
                    $this->template->add_js('breakpoints.js');
                    $this->template->add_js('select2.min.js');
                    $this->template->add_js('core.js');

                    $this->template->add_js('main.js');
                    $this->template->add_js('respond.min.js');
                    
                    $this->template->add_css('jquery-ui-1.10.1.custom.min.css');
                    $this->template->add_css('plugins/select2/select2.css');
                    $this->template->add_css('main.css');
                }

                if ( ! empty($data['title']))
                {
                    $this->template->set_title($data['title']);
                }

                $this->template->load_view($view, $data);
        }
        else
        {
            return $this->load->view($view, $data, TRUE);
        }
    }
}