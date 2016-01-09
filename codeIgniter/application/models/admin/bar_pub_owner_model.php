<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Bar_Pub_Owner_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function getAllBarPubOwner(){
        $this->db->select('iOwnerId,vFirstName,vLastName,vEmail,eDesignation,eStatus');
        $this->db->from('bar_owner');
        $this->db->order_by('iOwnerId','desc');
        $query = $this->db->get();
        return $query->result_array();  
    }

    function getBarOwnerDetails($iOwnerId) {
        $this->db->select('iOwnerId,vFirstName,vLastName,vEmail,iMobileNo,dCreatedDate,eDesignation,eNotification,eStatus');
        $this->db->from('bar_owner');
        $this->db->where('iOwnerId', $iOwnerId);
        $query = $this->db->get();
        return $query->row_array();
    }
    function edit_bar_owner($data) {
        $this->db->update("bar_owner", $data, array('iOwnerId' => $data['iOwnerId']));
        return $this->db->affected_rows();
    }
    function add_bar_owner($data) {
        $this->db->insert('bar_owner', $data);
        return $this->db->insert_id();
    }
    function get_all_bar_owners($iOwnerId) {
        $this->db->select(' ');
        $this->db->from('bar_owner');
        $this->db->where('iOwnerId !=', $iOwnerId);
        $this->db->order_by('iOwnerId desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function bar_owner_exists($vEmail) {
        $this->db->select('');
        $this->db->from('bar_owner');
        $this->db->where('vEmail', $vEmail);
        $query = $this->db->get();
        return $query->num_rows();
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