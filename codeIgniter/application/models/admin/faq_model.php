<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Faq_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    //get faq details
    function get_faq_details($iFaqId) {
        $this->db->select('');
        $this->db->from('faq');
        $this->db->where('iFaqId', $iFaqId);
        $query = $this->db->get();
        return $query->row_array();
    }
    //edit faq
    function edit_faq($data) {
        $this->db->update("faq", $data, array('iFaqId' => $data['iFaqId']));
        return $this->db->affected_rows();
    }
    //add faq
    function add_faq($data) {
        $this->db->insert('faq', $data);
        return $this->db->insert_id();
    }
    //get faq
    function getallFaqs() {
        $this->db->select('f.iFaqId,f.vQuestion,f.eStatus,fc.vFaqCategoryName');
        $this->db->from('faq as f');
        $this->db->join('faq_category as fc', 'fc.iFaqCategoryId=f.iFaqCategoryId');
        $this->db->order_by('f.iFaqId desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    //get faqcategory
    function get_all_faqcategory() {
        $this->db->select('');
        $this->db->from('faq_category');
        $this->db->where('eStatus', 'Active');
        $this->db->order_by('iFaqCategoryId');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>