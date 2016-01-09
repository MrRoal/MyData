<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Faqcategory_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    //get colors details
    function get_faqcategory_details($iFaqCategoryId) {
        $this->db->select('');
        $this->db->from('faq_category');
        $this->db->where('iFaqCategoryId', $iFaqCategoryId);
        $query = $this->db->get();
        return $query->row_array();
    }
    //edit colors
    function edit_faqcategory($data) {
        $this->db->update("faq_category", $data, array('iFaqCategoryId' => $data['iFaqCategoryId']));
        return $this->db->affected_rows();
    }
    //add colors
    function add_faqcategory($data) {
        $this->db->insert('faq_category', $data);
        return $this->db->insert_id();
    }
    //get colors
    function get_all_faqcategory() {
        $this->db->select('');
        $this->db->from('faq_category');
        $this->db->order_by('iFaqCategoryId desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function faqcategory_exists($vFaqcategoryName) {
        $vfaqcategoryname = urldecode($vFaqcategoryName);
        $this->db->select('');
        $this->db->from('faq_category');
        $this->db->where('vFaqCategoryName', $vfaqcategoryname);
        $query = $this->db->get();
        return $query->result_array();
    }
    function edit_banner($data) {
        $this->db->update("faq_category", $data, array('iFaqCategoryId' => $data['iFaqCategoryId']));
        return $this->db->affected_rows();
    }
}
?>