<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Push_notification_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function get_push_notification_text(){
        $this->db->select('');
        $this->db->from('push_notification_text');
        $this->db->order_by('iPushNotificationId','desc');
        $query = $this->db->get();
        return $query->result_array();   
    }

    function getAllUsers(){
        $this->db->select('iUserId,vFirstName,vLastName');
        $this->db->from('users');
        $this->db->where('eStatus','Active');
        $query = $this->db->get();
        return $query->result_array();
    }

    function add_pushNotification($data){
        $this->db->insert('push_notification_text',$data);
        return $this->db->insert_id();
    }

    function add_pushNotificationUser($data){
        $this->db->insert('push_notification_users',$data);
        return $this->db->insert_id();   
    }

    function get_device_details($id){
        $this->db->select('device_id');
        $this->db->from('device_master');
        $this->db->where('iUserId',$id);
        $query = $this->db->get();
        return $query->row_array();   
    }

    function get_all_notofication_users($iPushNotificationId){
        $this->db->select('u.iUserId,u.vFirstName,u.vLastName,u.vEmail');
        $this->db->from('push_notification_users p');
        $this->db->join('users u','p.iUserId=u.iUserId');
        $this->db->where('p.iPushNotificationId',$iPushNotificationId);
        $query = $this->db->get();
        return $query->result_array();   
    }

}
?>