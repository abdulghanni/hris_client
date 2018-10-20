<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Person_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getUserEmp($id)
    {
        $this->db->select('users_employement.*, position.title as position , employee_status.title as employee_status, empl_status.title as empl_status, position_group.title as position_group, grade.title as grade, resign_reason.title as resign_reason, active_inactive.title as active_inactive');
        $this->db->from('users_employement');
        $this->db->join('position', 'users_employement.position_id = position.id', 'left');
        $this->db->join('organization', 'users_employement.organization_id = organization.id', 'left');
        $this->db->join('empl_status', 'users_employement.empl_status_id = empl_status.id', 'left');
        $this->db->join('employee_status', 'users_employement.employee_status_id = employee_status.id', 'left');
        $this->db->join('position_group', 'users_employement.position_group_id = position_group.id', 'left');
        $this->db->join('grade', 'users_employement.grade_id = grade.id', 'left');
        $this->db->join('resign_reason', 'users_employement.resign_reason_id = resign_reason.id', 'left');
        $this->db->join('active_inactive', 'users_employement.active_inactive_id = active_inactive.id', 'left');

        $this->db->where('users_employement.user_id', $id);

        $query = $this->db->get();
        return $query;
    }

    function getUserCourse($id, $filter=null, $sort=null){
        $this->db->select('users_course.id, users_course.course_status_id as status_id, users_course.title as description, users_course.registration_date, course_status.title as status');
        $this->db->from('users_course');
        $this->db->join('course_status', 'users_course.course_status_id = course_status.id');

        $this->db->where('users_course.user_id', $id);
        $this->db->where('users_course.is_deleted', 0);
        if($filter){
            $this->db->like('users_course.title', $filter);
        }

        if($sort){
            $this->db->order_by('users_course.title', $sort);
        }

        $query = $this->db->get();
        return $query;
    }

    function getUserCertificate($id, $filter=null){
        $this->db->select('users_certificate.id, certification_type.title as certification_type,users_certificate.description, users_certificate.start_date, users_certificate.end_date');
        $this->db->from('users_certificate');
        $this->db->join('certification_type', 'users_certificate.certification_type_id = certification_type.id');

        $this->db->where('users_certificate.user_id', $id);
        $this->db->where('users_certificate.is_deleted', 0);

        if($filter){
            $this->db->like('certification_type.title', $filter);
        }

        $query = $this->db->get();
        return $query;
    }

    function getUserEducation($id, $filter=null){
        $this->db->select('education_group.title as edu_group, users_education.id, users_education.user_id, users_education.title as education, users_education.description, users_education.start_date, users_education.end_date, users_education.education_center_id, education_center.title as institution, users_education.education_degree_id, education_degree.title as degree');
        
        $this->db->from('users_education');
        $this->db->join('education_degree', 'users_education.education_degree_id = education_degree.id','left');
        $this->db->join('education_group', 'users_education.education_group_id = education_group.id','left');
        $this->db->join('education_center', 'users_education.education_center_id = education_center.id','left');

        $this->db->where('users_education.user_id', $id);
        $this->db->order_by('users_education.id','asc');
        $this->db->where('users_education.is_deleted', 0);

        if($filter){
            $this->db->like('users_education.title', $filter);
        }

        $query = $this->db->get();
        return $query;
    }

    function getUserExperience($id, $filter=null){
        $this->db->select('users_experience.*, resign_reason.title as resign_reason');
        $this->db->from('users_experience');
        /*$this->db->join('exp_field', 'users_experience.exp_field_id = exp_field.id');
        $this->db->join('exp_level', 'users_experience.exp_level_id = exp_level.id');
        $this->db->join('exp_year', 'users_experience.exp_year_id = exp_year.id');
        exp_field.title as field, exp_level.title as level, exp_year.title as year,
        */
        $this->db->join('resign_reason', 'users_experience.resign_reason_id = resign_reason.id');

        $this->db->where('users_experience.user_id', $id);
        $this->db->order_by('users_experience.id','asc');
        $this->db->where('users_experience.is_deleted', 0);

        if($filter){
            $this->db->like('users_experience.company', $filter);
        }

        $query = $this->db->get();
        return $query;
    }

    function getUserSk($id, $filter=null){
        $this->db->select('users_sk.*, departement.title as departement, position.title as position');
        $this->db->from('users_sk');
        $this->db->join('departement', 'users_sk.departement_id = departement.id', 'left');
        $this->db->join('position', 'users_sk.position_id = position.id');

        $this->db->where('users_sk.user_id', $id);
        $this->db->order_by('users_sk.id','asc');
        $this->db->where('users_sk.is_deleted', 0);

        if($filter){
            $this->db->like('users_sk.sk_no', $filter);
        }

        $query = $this->db->get();
        return $query;
    }

    function getUserSti($id, $filter=null){
        $this->db->select('users_sti.*, users.username, position.title as position, acknowledge.username as acknowledgeby, received.username as receivedby');
        $this->db->from('users_sti');
        $this->db->join('users', 'users_sti.user_id = users.id');
        $this->db->join('position', 'users_sti.position_id = position.id');
        $this->db->join('users as acknowledge', 'users_sti.acknowledgeby_id = acknowledge.id', 'left');
        $this->db->join('users as received', 'users_sti.receivedby_id = received.id', 'left');

        $this->db->where('user_id', $id);
        $this->db->order_by('users_sti.id','asc');
        $this->db->where('users_sti.is_deleted', 0);

        if($filter){
            $this->db->like('users_sti.ijazah_name', $filter);
        }

        $query = $this->db->get();
        return $query;
    }

    function getUserJabatan($id, $filter=null){
        $this->db->select('users_jabatan.*, users.username, organization.title as organization,groups.description as groups, position.title as position, grade.title as grade');
        
        $this->db->from('users_jabatan');
        $this->db->join('users', 'users_jabatan.user_id = users.id');
        $this->db->join('organization', 'users_jabatan.organization_id = organization.id');
        $this->db->join('grade', 'users_jabatan.grade_id = grade.id');
        $this->db->join('position', 'users_jabatan.position_id = position.id');
        $this->db->join('groups', 'users_jabatan.employee_group_id = groups.id', 'left');

        $this->db->where('user_id', $id);
        $this->db->where('users_jabatan.is_deleted', 0);

        if($filter){
            $this->db->like('organization.title', $filter);
        }

        $query = $this->db->get();
        return $query;
    }

    function getUserAward($id, $filter=null){
        $this->db->select('users_awardwarning.id, users_awardwarning.app_date, users_awardwarning.award_warning_type_id, users_awardwarning.description, users_awardwarning.end_date, users_awardwarning.sk_number, users_awardwarning.start_date, users_awardwarning.title, award_warning_type.title as type');
        $this->db->from('users_awardwarning');
        $this->db->join('award_warning_type', 'users_awardwarning.award_warning_type_id = award_warning_type.id', 'left');

        $this->db->where('user_id', $id);
        $this->db->where('users_awardwarning.is_deleted', 0);

        if($filter){
            $this->db->like('users_awardwarning.title', $filter);
        }

        $query = $this->db->get();
        return $query;
    }
   
    function getUserIkatanDinas($id, $filter=null){
        $this->db->select('users_ikatan_dinas.id, ikatan_dinas_type.title as type, users.username, users_ikatan_dinas.title, users_ikatan_dinas.start_date, users_ikatan_dinas.end_date, users_ikatan_dinas.amount');
        $this->db->from('users_ikatan_dinas');
        $this->db->join('users', 'users_ikatan_dinas.user_id = users.id');
        $this->db->join('ikatan_dinas_type', 'users_ikatan_dinas.ikatan_dinas_type = ikatan_dinas_type.id', 'left');
        
        $this->db->where('users_ikatan_dinas.is_deleted', 0);

        if($filter){
            $this->db->like('users_ikatan_dinas.title', $filter);
        }

        $query = $this->db->get();
        return $query;
    }

    function getUsers($id){
        $this->db->select('users.*, marital.title as marital_title');
        $this->db->from('users');
        $this->db->join('marital', 'users.marital_id = marital.id');
        $this->db->where('users.id', $id);

        $query = $this->db->get();
        return $query;
    }
	
	 function getNik($id){
        $this->db->select('users.*, marital.title as marital_title');
        $this->db->from('users');
        $this->db->join('marital', 'users.marital_id = marital.id');
        $this->db->where('users.nik', $id);

        $query = $this->db->get();
        return $query;
    }

    function payroll_injection($data=array())
    {
        $this->db->insert_batch('users_payroll', $data); 
    }

    function getAllPayroll()
    {
        $this->db->select('*');
        $this->db->from('users_payroll');
        $query = $this->db->get();
        return $query; 
    }

    function getPayrollbyNik($nik=0)
    {
        $this->db->select('*');
        $this->db->from('users_payroll');
        $this->db->where('nik',$nik);
        $this->db->order_by('filename','desc');
        $query = $this->db->get();
        return $query; 
    }




}