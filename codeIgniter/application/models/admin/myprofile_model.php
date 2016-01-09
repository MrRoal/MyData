<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class myprofile_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function check_auth($vEmail, $vPassword) {
        $this->db->select('u.iClientId,u.vFirstName,u.vLastName,u.vEmail,u.eStatus');
        $this->db->from('client as u');
        $this->db->where('u.eStatus', 'Active');
        $this->db->where('u.vEmail', $vEmail);
        $this->db->where('u.vPassword', $vPassword);
        $query = $this->db->get();
        return $query->row_array();
    }
    function count_user() {
        $this->db->select('u.iClientId,u.vFirstName,u.vLastName,u.vEmail,u.vPhone,u.eStatus');
        $this->db->from('client as u');
        $this->db->order_by('iClientId desc');
        return $this->db->count_all_results();
    }
    function get_user() {
        $this->db->select('u.iClientId,u.vFirstName,u.vLastName,u.vEmail,u.vPhone,u.eStatus');
        $this->db->from('client as u');
        $this->db->order_by('iClientId desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function add_user($data) {
        $query = $this->db->insert('client', $data);
        return $this->db->insert_id();
    }
    function edit_user($data) {
        $this->db->update("administrator", $data, array('iAdminId' => $data['iAdminId']));
        return $this->db->affected_rows();
    }
    function get_user_details($iAdminId) {
        $this->db->select('a.vFirstName, a.vLastName, a.vEmail, a.eStatus, a.iAdminId');
        $this->db->from('administrator as a');
        // $this->db->join('country AS c','a.iCountryId=c.iCountryId','LEFT');
        // $this->db->join('state AS s','a.iStateId=s.iStateId','LEFT');
        $this->db->where('iAdminId', $iAdminId);
        $query = $this->db->get();
        return $query->row_array();
    }
    function get_update_all($ids, $action) {
        $data = array('eStatus' => $action);
        $this->db->where_in('iClientId', $ids);
        $this->db->update('client', $data);
        return $this->db->affected_rows();
    }
    function delete_all($ids) {
        $this->db->where_in('iClientId', $ids);
        $this->db->delete('client');
    }
    function get_country() {
        $this->db->select('iCountryId,vCountry');
        $this->db->from('country');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_country_code($iCountryId) {
        $this->db->select('iCountryId,vCountry');
        $this->db->from('country');
        $this->db->where('iCountryId', $iCountryId);
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_states($iCountryId) {
        $this->db->select('iStateId,iCountryId,vState');
        $this->db->from('state');
        $this->db->where('iCountryId', $iCountryId);
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_states_code($iStateId) {
        $this->db->select('iStateId,iCountryId,vState');
        $this->db->from('state');
        $this->db->where('iStateId', $iStateId);
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_allstates() {
        $this->db->select('iStateId,vState');
        $this->db->from('state');
        $this->db->where('eStatus', 'Active');
        $query = $this->db->get();
        return $query->result_array();
    }
    function delete_image($iClientId) {
        $data['vProfileImage'] = '';
        $this->db->where('iClientId', $iClientId);
        return $this->db->update('client', $data);
    }
    function getuser_by_mail($mail) {
        $this->db->select('');
        $this->db->from('administrator');
        $this->db->where('vEmail', $mail);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_allstates_bycountry($iCountryId) {
        $this->db->select('iStateId,vState,iCountryId');
        $this->db->from('state');
        $this->db->where('iCountryId', $iCountryId);
        $this->db->where('eStatus', 'Active');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>