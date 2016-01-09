<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class home_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function today_signup_user() {
        $today = date("Y-m-d");
        $this->db->select('iUserId,vFirstName,vLastName,vEmail,eStatus,dCreatedDate,iMobileNo');
        $this->db->from('users');
        $this->db->where('dCreatedDate', $today);
        $this->db->order_by('iUserId desc');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result_array();
    }

    function totalRegisterUsers(){
        $this->db->select('iUserId,vFirstName,vLastName,vEmail,eStatus,dCreatedDate');
        $this->db->from('users');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_currency(){
        $this->db->select('vValue');
        $this->db->from('configurations');
        $this->db->where('vName','CURRENCY');
        $query = $this->db->get();
        $res = $query->row_array();
        return $res['vValue'];
    }

    function get_allstates() {
        $this->db->select('iStateId,vState');
        $this->db->from('state');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_country() {
        $this->db->select('iCountryId,vCountry');
        $this->db->from('country');
        $query = $this->db->get();
        return $query->result_array();
    }

    function change_password($data) {
        $this->db->update("administrator", $data, array('iAdminId' => $data['iAdminId']));
        return $this->db->affected_rows();
    }

    function todayBarReservation(){
        $today = date("Y-m-d");
        $this->db->select('bb.iBookBarId,bb.iUserId,b.vBarName,u.vFirstName,u.vLastName,bb.vName,bb.dBookDate,bb.vDiscount');
        $this->db->from('book_bar as bb');
        $this->db->join('bar as b','bb.iBarId=b.iBarId');
        $this->db->join('users as u','bb.iUserId=u.iUserId','left');
        $this->db->where("DATE_FORMAT(bb.dAddedDate,'%Y-%m-%d')", $today);
        $this->db->order_by('bb.iBookBarId desc');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result_array();      
    }
}
?>