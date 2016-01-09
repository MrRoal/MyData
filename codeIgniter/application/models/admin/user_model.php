<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function getAllUserList($type){
        $this->db->select('iUserId,vFirstName,vLastName,vEmail,dBirthDate,eGender,vProfilePicture,eRole,eStatus');
        $this->db->from('users');
        $this->db->order_by('iUserId','desc');
        $query = $this->db->get();
        return $query->result_array();  
    }

    function get_user_details($iUserId) {
        $this->db->select('iUserId,vFirstName,vLastName,vEmail,imagetype,iMobileNo,dBirthDate,dCreatedDate,vProfilePicture,eGender,eRole,eStatus');
        $this->db->from('users');
        $this->db->where('iUserId', $iUserId);
        $query = $this->db->get();
        return $query->row_array();
    }
    function edit_user($data) {
        $this->db->update("users", $data, array('iUserId' => $data['iUserId']));
        return $this->db->affected_rows();
    }
    function add_user($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    function getAllExportUsers(){
        $this->db->select('iUserId,vFirstName,vLastName,vEmail,iMobileNo,dBirthDate,eGender,dCreatedDate,eRole,eStatus');
        $this->db->from('users');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_all_userss($iUserId) {
        $this->db->select(' ');
        $this->db->from('users');
        $this->db->where('iUserId !=', $iUserId);
        $this->db->order_by('iUserId desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function users_exists($vEmail) {
        $this->db->select('');
        $this->db->from('users');
        $this->db->where('vEmail', $vEmail);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function getUserEmailDetailsByUserId($iUserId){
        $this->db->select('iUserId,vEmail,eStatus');
        $this->db->from('users');
        $this->db->where('iUserId',$iUserId);     
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

    function getAllBookingListingByiUserId($iUserId){
        $this->db->select('bb.iBookBarId,bb.vBookCode,bb.vMobileNo,bb.eStatus,bb.dBookDate,bb.vNoOfPerson,bb.vDiscount,b.iBarId,b.vBarName,u.iUserId,u.vFirstName,u.vLastName,u.vEmail');
        $this->db->from('book_bar as bb');
        $this->db->join('bar as b','bb.iBarId=b.iBarId');
        $this->db->join('users as u','bb.iUserId=u.iUserId');
        $this->db->where('bb.iUserId',$iUserId);
        $this->db->order_by('bb.iBookBarId','desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getBookingDetailByiUserId($iBookBarId){
        $this->db->select('bb.iBookBarId,bb.vBookCode,bb.vMobileNo,bb.eStatus,bb.dBookDate,bb.vNoOfPerson,bb.vDiscount,b.iBarId,b.vBarName,u.iUserId,u.vFirstName,u.vLastName,u.vEmail');
        $this->db->from('book_bar as bb');
        $this->db->join('bar as b','bb.iBarId=b.iBarId');
        $this->db->join('users as u','bb.iUserId=u.iUserId');
        $this->db->where('bb.iBookBarId',$iBookBarId);
        $this->db->order_by('bb.iBookBarId','desc');
        $query = $this->db->get();
        return $query->row_array();
    }

}
?>