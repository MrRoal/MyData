<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin_management_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function getalladmin($type){
        $this->db->select('iAdminId,vFirstName,vLastName,vEmail,eRole,eStatus');
        $this->db->select("DATE_FORMAT(dCreatedDate,'%M %D, %Y %h:%i %p') AS dCreatedDate",FALSE);
        $this->db->from('admin');
        /*$this->db->where('eRole',$type);*/
        $this->db->order_by('iAdminId','desc');
        $query = $this->db->get();
        return $query->result_array();  
    }

    function get_admin_details($iAdminId) {
        $this->db->select('iAdminId,vFirstName,vLastName,vEmail,iMobileNo,dCreatedDate,eRole,eStatus');
        $this->db->from('admin');
        $this->db->where('iAdminId', $iAdminId);
        $query = $this->db->get();
        return $query->row_array();
    }
    function edit_admin($data) {
        $this->db->update("admin", $data, array('iAdminId' => $data['iAdminId']));
        return $this->db->affected_rows();
    }
    function add_admin($data) {
        $this->db->insert('admin', $data);
        return $this->db->insert_id();
    }
    function get_all_admins($iAdminId) {
        $this->db->select(' ');
        $this->db->from('admin');
        $this->db->where('iAdminId !=', $iAdminId);
        $this->db->order_by('iAdminId desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function admin_exists($vEmail) {
        $this->db->select('');
        $this->db->from('admin');
        $this->db->where('vEmail', $vEmail);
        $query = $this->db->get();
        return $query->num_rows();
    }

    //add permission of new admin
    function get_allmodules_accesspermission(){
        $this->db->select('iModuleId');
        $this->db->from('admin_modules');
        $this->db->where('vPath !=','');
        $this->db->where('eStatus','Active');
        return $this->db->get()->result_array();
    }

    function add_admindefault_permission($Data){
        $query=$this->db->insert('acc_mod_per_admin', $Data);
        return $this->db->insert_id();
    }

    function getallmodules(){
        $this->db->select('*');
        $this->db->from('admin_modules');
        $this->db->where('vPath !=','');
        $this->db->where('eStatus','Active');
        return $this->db->get()->result_array();
    }

    function checkmodules($iAdminId){
        $this->db->select('aa.*,a.vFirstName,a.vLastName');
        $this->db->from('acc_mod_per_admin as aa');
        $this->db->join('admin as a','aa.iAdminId=a.iAdminId');
        $this->db->from('acc_mod_per_admin');
        $this->db->where('aa.iAdminId',$iAdminId);
        return $this->db->get()->row_array();
    }

    function deletemodules($iAdminId){
        $this->db->delete('acc_mod_per_admin', array('iAdminId' => $iAdminId)); 
    }

    function save($Data){
        $this->db->insert('acc_mod_per_admin', $Data);
        return $this->db->insert_id();
    }

    function getAdminEmailDetailsByAdminId($iAdminId){
        $this->db->select('iAdminId,vEmail,eStatus');
        $this->db->from('admin');
        $this->db->where('iAdminId',$iAdminId);     
        $query = $this->db->get();
        return $query->row_array();
    }

    function checkEmailExistFromUser($vEmail){
        $this->db->select('vEmail');
        $this->db->from('users');
        $this->db->where('vEmail',$vEmail);
        $query = $this->db->get();
        $row=$query->num_rows();
        if($row > 0){
            return 'YES';
        }else{
            return 'NO';
        } 
    } 

    function checkEmailExistFromAdmin($vEmail){
        $this->db->select('vEmail');
        $this->db->from('admin');
        $this->db->where('vEmail',$vEmail);
        $query = $this->db->get();
        $row=$query->num_rows();
        if($row > 0){
            return 'YES';
        }else{
            return 'NO';
        } 
    }  

    function checkEmailExistFromOwners($vEmail){
        $this->db->select('vEmail');
        $this->db->from('bar_owner');
        $this->db->where('vEmail',$vEmail);
        $query = $this->db->get();
        $row=$query->num_rows();
        if($row > 0){
            return 'YES';
        }else{
            return 'NO';
        } 
    }    

}
?>