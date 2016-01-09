<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Bookingbar_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    //get faq details
    function getAllBookingBarList() {
        $this->db->select('b.vBarName,bb.iBarId,bb.iBookBarId,bb.iUserId,bb.dBookDate,bb.vBookCode,bb.vName,bb.vEmail,bb.vMobileNo,bb.eStatus');
        $this->db->select("DATE_FORMAT(bb.dBookDate, '%d %M %Y %H:%i:%s') as dBookDate", FALSE);
       /* $this->db->select("u.vEmail as email");*/
        /*$this->db->select("u.iMobileNo as mobileNo");*/
        $this->db->from('book_bar as bb');
        $this->db->join('bar as b','bb.iBarId = b.iBarId');
        /*$this->db->join('users as u','bb.iUserId = u.iUserId','left');*/
        $query = $this->db->get();
        return $query->result_array();
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