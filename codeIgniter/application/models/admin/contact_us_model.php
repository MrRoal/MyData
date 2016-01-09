<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class contact_us_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function getAllContactListing() {
        $this->db->select('iContectID,vFirstName,vLastName,vEmail,iMobileNo,tMassage');
        $this->db->select("DATE_FORMAT(dAddedDate,'%d %M %Y') As dAddedDate", FALSE);
        $this->db->from('contact_us');
        $this->db->order_by('iContectID desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_contact_details($iContectID) {
        $this->db->select('iContectID,vFirstName,vLastName,vEmail,iMobileNo,tMassage,dAddedDate');
        $this->db->from('contact_us');
        $this->db->where('iContectID', $iContectID);
        $query = $this->db->get();
        return $query->row_array();
    }
    function get_country() {
        $this->db->select('iCountryId,vCountry');
        $this->db->from('country');
        $query = $this->db->get();
        return $query->result_array();
    }
    function getContact() {
        $this->db->select('iContectID,vFirstName,vLastName,vEmail,iMobileNo,tMassage');
        $this->db->select("DATE_FORMAT(dAddedDate,'%d %M %Y') As dAddedDate", FALSE);
        $this->db->from('contact_us');
        $this->db->order_by('iContectID desc');
        $query = $this->db->get();
        return $query->num_rows();
    }
    function getAllContactDetails() {
        $this->db->select('iContectID,vFirstName,vLastName,vEmail,iMobileNo,tMassage');
        $this->db->select("DATE_FORMAT(dAddedDate,'%d %M %Y') As dAddedDate", FALSE);
        $this->db->from('contact_us');
        $this->db->order_by('iContectID desc');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>