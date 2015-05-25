<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getUserid($id)
    {
        $query = $this->db->where('user_id', $id)->get('users_employement');
        return $query;
    }

    function addEmp($id, $data)
    {
        $this->db->insert('users_employement', $data);
    }

    function updateEmp($id, $data){
        $this->db->where('user_id', $id);
        $this->db->update('users_employement', $data);
    }

    function getCourse($id,$title_post){
        $this->db->select('users_course.id, users_course.course_status_id as status_id, users_course.title as description, users_course.registration_date, course_status.title as status');
        $this->db->from('users_course');
        $this->db->join('course_status', 'users_course.course_status_id = course_status.id');

        $this->db->where('users_course.user_id', $id);
        $this->db->where('users_course.is_deleted', 0);
        $this->db->like('users_course.title',$title_post);
        
        $query = $this->db->get();
        return $query;
    }

    function addCourse($data)
    {
    	$this->db->insert('users_course', $data);
    }

    function editCourse($id, $data){
    	$this->db->where('id', $id);
    	$this->db->update('users_course', $data);
    }

    function deleteCourse($id, $data){
    	$this->db->where('id', $id);
    	$this->db->update('users_course', $data);
    }

    function addCertificate($data)
    {
    	$this->db->insert('users_certificate', $data);
    }

    function editCertificate($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_certificate', $data);
    }

    function deleteCertificate($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_certificate', $data);
    }

    function addEducation($data)
    {
        $this->db->insert('users_education', $data);
    }

    function editEducation($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_education', $data);
    }

    function deleteEducation($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_education', $data);
    }

    function addExperience($data)
    {
        $this->db->insert('users_experience', $data);
    }

    function editExperience($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_experience', $data);
    }

    function deleteExperience($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_experience', $data);
    }

    function addsk($data)
    {
        $this->db->insert('users_sk', $data);
    }

    function editsk($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_sk', $data);
    }

    function deletesk($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_sk', $data);
    }

    function addsti($data)
    {
        $this->db->insert('users_sti', $data);
    }

    function editsti($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_sti', $data);
    }

    function deletesti($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_sti', $data);
    }

    function addjabatan($data)
    {
        $this->db->insert('users_jabatan', $data);
    }

    function editjabatan($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_jabatan', $data);
    }

    function deletejabatan($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_jabatan', $data);
    }

    function addaward($data)
    {
        $this->db->insert('users_awardwarning', $data);
    }

    function editaward($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_awardwarning', $data);
    }

    function deleteaward($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_awardwarning', $data);
    }

    function addikatan($data)
    {
        $this->db->insert('users_ikatan_dinas', $data);
    }

    function editikatan($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_ikatan_dinas', $data);
    }

    function deleteikatan($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users_ikatan_dinas', $data);
    }

}