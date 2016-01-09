<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function getAllBarList(){
    	$this->db->select("iBarId,vBarName");
        $this->db->from('bar');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getcount_ActCode_assign($dBookDate,$iBarId){
    	$date = $dBookDate .' '."00:00:00";
        $this->db->select('');
        $this->db->from('book_bar');
        $this->db->where('dBookDate',$date);
        $this->db->where('iBarId',$iBarId);
        return $this->db->count_all_results(); 
    }

     function getcount_ActCode_assign_holemonth($start_assigndate,$end_assigndate,$iBarId){

        $this->db->select('');
        $this->db->from('book_bar');
        $this->db->where('dBookDate >=',$start_assigndate);
        $this->db->where('dBookDate <=',$end_assigndate);
        $this->db->where('iBarId',$iBarId);
        return $this->db->count_all_results(); 
    }

    /*function getcount_ActCode_assign_holemonth($start_assigndate,$end_assigndate,$iBarId){
 
        $this->db->select('');
        $this->db->from('book_bar');
        $this->db->where('dBookDate >=',$start_assigndate);
        $this->db->where('dBookDate <=',$end_assigndate);
        $this->db->where('iBarId',$iBarId);
        return $this->db->count_all_results(); 
    }*/

    function get_all_book_list(){
        $this->db->select('bb.iBookBarId,bb.vBookCode,b.iBarId,b.vBarName');
        $this->db->from('book_bar as bb');
        $this->db->join('bar as b','bb.iBarId=b.iBarId');
        $query = $this->db->get();
        return $query->result_array();    
    }
    
    function getAllMostBookBarList($start_date,$end_date)  {
        $this->db->select('bb.iBookBarId,bb.vBookCode,b.iBarId,b.vBarName');
        $this->db->from('book_bar as bb');
         $this->db->join('bar as b','bb.iBarId=b.iBarId');
        $this->db->where('dBookDate >=',$start_date);
        $this->db->where('dBookDate <=',$end_date);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getAllBarListing($start_date,$end_date){
        $this->db->select('b.iBarId,b.vBarName,bo.iOwnerId,bo.vFirstName,bo.vLastName,bo.vEmail,bo.iMobileNo,bo.eDesignation');
        $this->db->from('book_bar as bb');
        $this->db->join('bar as b','bb.iBarId=b.iBarId');
        $this->db->join('bar_owner as bo','b.iOwnerId=bo.iOwnerId');
        $this->db->where('bb.dBookDate >=',$start_date);
        $this->db->where('bb.dBookDate <=',$end_date);
        $this->db->group_by('b.iBarId');
        $query = $this->db->get();
        return $query->result_array();   
    }

    function getTotalIndividualBarCount($iBarId){
        $this->db->select('');
        $this->db->from('book_bar');
        $this->db->where('iBarId',$iBarId);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getAllMostUserList($start_date,$end_date)  {
        $this->db->select('bb.iBookBarId,bb.iUserId,bb.vName,bb.vEmail,u.vFirstName,u.vLastName,u.iMobileNo');
        $this->db->select('u.vEmail as email');
        $this->db->from('book_bar as bb');
        $this->db->join('users as u','bb.iUserId = u.iUserId','left');
        $this->db->where('dBookDate >=',$start_date);
        $this->db->where('dBookDate <=',$end_date);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getAllUserList($start_date,$end_date,$iUserId){
        //print_r($field);
        $this->db->select('bb.iBookBarId,bb.iUserId,bb.vName,bb.vEmail,u.vFirstName,u.vLastName');
        $this->db->select('u.vEmail as email');
        $this->db->from('book_bar as bb');
        $this->db->join('users as u','bb.iUserId = u.iUserId','left');
        $this->db->where('bb.dBookDate >=',$start_date);
        $this->db->where('bb.dBookDate <=',$end_date);
        $this->db->where('bb.iUserId',$iUserId);
        $query = $this->db->get();
        //print_r($query);exit;
        return $query->result_array();
    }

    function getUserList($start_date,$end_date){
        //print_r($field);
        $this->db->select('bb.iBookBarId,bb.iUserId,bb.vName,bb.vEmail,u.vFirstName,u.vLastName,u.iMobileNo');
        $this->db->select('u.vEmail as email');
        $this->db->from('book_bar as bb');
        $this->db->join('users as u','bb.iUserId = u.iUserId','left');
        $this->db->where('bb.dBookDate >=',$start_date);
        $this->db->where('bb.dBookDate <=',$end_date);
        $this->db->group_by('bb.iUserId');
        $query = $this->db->get();
        //print_r($query);exit;
        return $query->result_array();
    }

}
?>