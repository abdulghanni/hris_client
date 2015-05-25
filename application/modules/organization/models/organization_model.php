<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organization_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getOrganization(){
        $this->db->select('organization.*, organization.id as id, parent.id as parent_id, parent.title as organization_parent, organization_class.title as organization_class, organization.title as title');
        $this->db->from('organization');
        $this->db->join('organization_class', 'organization.organization_class_id = organization_class.id', 'left');
        $this->db->join('organization as parent', 'organization.parent_organization_id = parent.id', 'left');
		$this->db->join('comp_session', 'organization.comp_session_id = comp_session.id', 'left');
		$this->db->order_by('organization.organization_class_id', 'asc');
		
		$this->db->where('organization.is_deleted', 0);
		$this->db->where('organization_class.is_deleted', 0);
		$this->db->where('comp_session.is_active', 1);
		
        $query = $this->db->get();
        return $query;
    }

    function add($data)
    {
        $this->db->insert('organization', $data);
    }
	
	function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('organization', $data);
	}
}