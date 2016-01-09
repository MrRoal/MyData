<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Authentication_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /* Check Authentication */
    function check_auth($vEmail, $vPassword) {
        $this->db->select('');
        $this->db->from('admin');
        $this->db->where('eStatus', 'Active');
        $this->db->where('vEmail', $vEmail);
        $this->db->where('vPassword', $vPassword);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    //get login detail
    function checkadmin_mail($email) {
        $this->db->select('vEmail,vPassword,vFirstName,vLastName');
        $this->db->from('admin');
        $this->db->where('vEmail', $email);
        $this->db->where('eStatus', 'Active');
        $query = $this->db->get();
        return $query->row_array();
    } 

    function getUserRecord($vEmail) {
        $this->db->select('iUserId,vEmail');
        $this->db->from('users');
        $this->db->where('vEmail', $vEmail);
        $this->db->where('eStatus', 'Active');
        $query = $this->db->get();
        return $query->row_array();
    }  

    function getAdminRecord($vEmail) {
        $this->db->select('iAdminId,vEmail');
        $this->db->from('admin');
        $this->db->where('vEmail', $vEmail);
        $this->db->where('eStatus', 'Active');
        $query = $this->db->get();
        return $query->row_array();
    }  

    function updatecode(){
        $this->db->update("administrator", $data, array('vEmail'=>$data['vEmail']));
        return $this->db->affected_rows();     
    }
}
?>