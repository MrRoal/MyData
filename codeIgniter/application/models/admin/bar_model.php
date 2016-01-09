<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Bar_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function getAllBarPubOwner(){
        $this->db->select("iOwnerId, vFirstName, vLastName");
        $this->db->from('bar_owner');
        $this->db->order_by('iOwnerId','desc');
        $query = $this->db->get();
        return $query->result_array();  
    }

    function getAllBarPubDetail(){
        $this->db->select("b.iBarId,b.vBarName,b.eStatus,b.eFeatured,concat_ws(' ',bo.vFirstName,bo.vLastName) as name",FALSE);
        $this->db->from('bar as b');
        $this->db->join('bar_owner as bo','bo.iOwnerId=b.iOwnerId',left);
        $this->db->order_by('b.iBarId','desc');
        $query = $this->db->get();
        return $query->result_array();  
    }

    function getBarOwnerDetails($iBarId) {
        $this->db->select('');
        $this->db->from('bar');
        $this->db->where('iBarId', $iBarId);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    function edit_barDetail($data) {
        $this->db->update("bar", $data, array('iBarId' => $data['iBarId']));
        return $this->db->affected_rows();
    }
    
    function add_bar($data) {
        $this->db->insert('bar', $data);
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

    function add_bar_gallery($data){
        $this->db->insert('bar_gallery', $data);
        return $this->db->insert_id();      
    }

    function edit_bar_gallery($data){
        $this->db->update("bar_gallery", $data, array('iBarGalleryId' => $data['iBarGalleryId']));
        return $this->db->affected_rows();      
    }

    function getAllBarGalleryImagesbyiBarId($iBarId){
        $this->db->select('bg.iBarGalleryId,bg.iBarId,bg.vImage,b.vBarName');
        $this->db->from('bar_gallery as bg');
        $this->db->join('bar as b','bg.iBarId=b.iBarId');
        $this->db->where('bg.iBarId', $iBarId);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getAllBarRedeemCode($iBarId){
        $this->db->select('rc.iRedeemCodeId,rc.iBarId,rc.vRedeemCode,rc.fDiscount,rc.eDiscountType,u.iUserId,u.vFirstName,u.vLastName');
        $this->db->from('redeem_code as rc');
        $this->db->join('users as u','rc.iUserId=u.iUserId');
        $this->db->where('rc.iBarId', $iBarId);
        $query = $this->db->get();
        return $query->result_array();      
    }

    function addRedeemCode($data){
        $this->db->insert('redeem_code', $data);
        return $this->db->insert_id();      
    }

    /*function getRedeemCodeDetailByRedeemCodeId($iRedeemCodeId){
        $this->db->select('iRedeemCodeId,iBarId,vRedeemCode,fDiscount,eDiscountType,eStatus');
        $this->db->from('redeem_code');
        $this->db->where('iRedeemCodeId', $iRedeemCodeId);
        $query = $this->db->get();
        return $query->row_array();
    }
*/
    function editRedeemCode($data){
        $this->db->update("redeem_code", $data, array('iRedeemCodeId' => $data['iRedeemCodeId']));
        return $this->db->affected_rows();
    }

    function getAllExportMerchants(){
        $this->db->select('b.iBarId,b.vBarName,b.tAboutBar,b.vAtmosphere,b.vFacilities,b.vLanguage,b.tHighlight,b.opening_hours,b.closing_hours,b.tAddress,b.eFeatured,b.vRedeemCode,b.fDiscount,b.eDiscountType,b.eStatus,bo.vFirstName,bo.vLastName');
        $this->db->from('bar as b');
        $this->db->join('bar_owner as bo','b.iOwnerId=bo.iOwnerId');
        $query = $this->db->get();
        return $query->result_array();      
    }

    function getBarRating($eStar,$iBarId){
        $this->db->select('eStar');
        $this->db->from('bar_rating');
        $this->db->where('eStar',$eStar);
        $this->db->where('iBarId',$iBarId);
        $que = $this->db->get();
        return $que->num_rows();
    }

    function getAllBarRedeemCodeDetail($iBarId){
        $this->db->select('bb.iBookBarId,bb.iBarId,bb.vMerchantCode,bb.vDiscount,bb.eDiscountType,bb.eStatus,bb.dRedeemDate,u.vFirstName,u.vLastName');
        $this->db->from('book_bar as bb');
        $this->db->join('users as u','bb.iUserId=u.iUserId','left');
        $this->db->where('bb.iBarId', $iBarId);
        $this->db->where('bb.vMerchantCode !=','');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getRedeemCodeDetailByRedeemCodeId($iBookBarId){
         $this->db->select('bb.iBookBarId,bb.iBarId,bb.vMerchantCode,bb.vDiscount,bb.eDiscountType,bb.eStatus,bb.dRedeemDate,u.vFirstName,u.vLastName,b.vBarName');
        $this->db->from('book_bar as bb');
        $this->db->join('users as u','bb.iUserId=u.iUserId','left');
        $this->db->join('bar as b','bb.iBarId = b.iBarId','left');
        $this->db->where('iBookBarId', $iBookBarId);
        $query = $this->db->get();
        return $query->row_array();
    }

}
?>