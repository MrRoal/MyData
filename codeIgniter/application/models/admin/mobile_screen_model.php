<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mobile_screen_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function count_all() {
        $this->db->select("COUNT('iMobileScreenId') AS tot");
        $this->db->from('mobile_screen');
        $query = $this->db->get();
        return $query->row_array();
    }
    function get_banner_details($iMobileScreenId) {
        $this->db->select('');
        $this->db->from('mobile_screen');
        $this->db->where('iMobileScreenId', $iMobileScreenId);
        $query = $this->db->get();
        return $query->row_array();
    }
    function edit_banner($data) {
        $this->db->update("mobile_screen", $data, array('iMobileScreenId' => $data['iMobileScreenId']));
        return $this->db->affected_rows();
    }
    function add_banner($data) {
        $query = $this->db->insert('mobile_screen', $data);
        return $this->db->insert_id();
    }
    function getAllMobileImage() {
        $this->db->select('iMobileScreenId,vImage,eStatus,vTitle');
        $this->db->from('mobile_screen');
        $this->db->order_by('iMobileScreenId  desc');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>