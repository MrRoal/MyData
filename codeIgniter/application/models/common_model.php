<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_address_for_contact_us() {
		$this->db->select('vValue');
		$this->db->from('configurations');
		$this->db->where('vName', 'CONTACT_US_ADDRESS');
		$que = $this->db->get();
		$res = $que->row_array();
		return $res['vValue'];
	}
	// USE FOR DELETE IMAGE
	function list_sysemaildata($EmailCode) {
		$this->db->select('');
		$this->db->from('emailtemplate');
		$this->db->where('vEmailCode', $EmailCode);
		return $this->db->get();
	}
	// update the status of record (single or multiple)
	function get_update_all($ids, $action, $tableData) {
		$data = array('eStatus' => $action);
		$this->db->where_in($tableData['update_field'], $ids);
		$this->db->update($tableData['tablename'], $data);
		return $this->db->affected_rows();
	}
	// USE FOR GET ALL CATEGORIE'S IMAGE
	function get_category_details($fieldId, $tableData) {
		$this->db->select($tableData['image_field']);
		$this->db->from($tableData['tablename']);
		$this->db->where($tableData['update_field'], $fieldId);
		$query = $this->db->get();
		// echo "<pre>";print_r($query->result());
		return $query->row_array();
	}
	
	function Get_vehicle_compny(){
		$this->db->select('');
		$this->db->from('vehicle_companies');
		$que=$this->db->get();
		return $que->result_array();
	}
	// USE FOR DELETE RECORDS
	function delete_record($ids, $tableData) {
		$this->db->where_in($tableData['update_field'], $ids);
		$this->db->delete($tableData['tablename']);
	}
	// USE FOR DELETE IMAGE
	function delete_image($tableData) {
		$this->db->where($tableData['update_field'], $tableData['field_id']);
		return $this->db->delete($tableData['tablename']);
	}
	// USE FOR DELETE IMAGE
	function get_admin_details($iAdminId,$eUserType) {
		if($eUserType != ''){
            $this->db->select('iAdminId,vFirstName,vLastName,vEmail,iMobileNo,dCreatedDate,eRole,eStatus');
            $this->db->from('admin');
            /*$this->db->join('acc_mod_per_admin as aa','aa.iAdminId=a.iAdminId','left');*/
            $this->db->where('iAdminId',$iAdminId);
            $query = $this->db->get();
            return $query->row_array();
        }
        else{
            $this->db->select('iAdminId,vFirstName,vLastName,vEmail,iMobileNo,dCreatedDate,eRole,eStatus');
            $this->db->from('admin');
            $this->db->where('iAdminId',$iAdminId);
            $query = $this->db->get();
            return $query->row_array();
        }
	}

	function get_sub_driver_category_details($fieldId, $tableData) {
		$this->db->select($tableData['image_field']);
		$this->db->from($tableData['tablename']);
		$this->db->where($tableData['update_field'], $fieldId);
		$query = $this->db->get();
		return $query->row_array();
	}
	//get all country list
	function getcity() {
		$this->db->select('');
		$this->db->from('city');
		$this->db->order_by('vCity', 'ASC');
		$this->db->where('eStatus', 'Active');
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_check_city_vehicle_fare($iCityId,$vehicle_Id) {
		$this->db->select('count(iFareId) as fare');
		$this->db->from('fare_detail');
		$this->db->where('eStatus', 'Active');
		$this->db->where('iVehicleCompanyId',$vehicle_Id);
		$this->db->where('iCityId',$iCityId);
		$query = $this->db->get();
		return $query->row_Array();
	}
	function get_brazil_city() {
		$this->db->select('');
		$this->db->from('city');
		$this->db->where('eStatus', 'Active');
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_city($iCityId) {
		$this->db->select('iCityId,vCity');
		$this->db->from('city');
		$this->db->where('iCityId', $iCityId);
		$this->db->where('eStatus', 'Active');
		$query = $this->db->get();
		return $query->row_array();
	}
	//get all country list
	function getslider() {
		$this->db->select('iBannerId,vBannerImage,vBannerTitle,tDescription');
		$this->db->from('banner');
		$this->db->where('eStatus', 'Active');
		$this->db->order_by('iOrderNo', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_country_code($iCountryId) {
		$this->db->select('vCountryMobileCode');
		$this->db->from('country');
		$this->db->where('iCountryId', $iCountryId);
		$query = $this->db->get()->row_array();
		return $query['vCountryMobileCode'];
	}
	// Add Contact Us
	function add_contact_us($data) {
		$query = $this->db->insert('contact_us', $data);
		return $this->db->insert_id();
	}
	function getpages($vPagecode) {
		$this->db->select('iSPageId,vPageName,tContent_en,eStatus');
		$this->db->from('static_pages');
		$this->db->where('vPageTitle', $vPagecode);
		$this->db->where('eStatus', 'Active');
		return $this->db->get()->row_array();
	}
	function get_driver_details($iDriverId) {
		$this->db->select('iDriverId,vFirstName,vLastName,vEmail,vProfileImage,iParentDriverId,vPassword');
		$this->db->from('driver');
		$this->db->where('iDriverId', $iDriverId);
		$query = $this->db->get();
		return $query->row_array();
	}
	function get_client_details($iClientId) {
		$this->db->select('iClientId,vFirstName,vLastName,vEmail,vProfileImage,vPassword');
		$this->db->from('client');
		$this->db->where('iClientId', $iClientId);
		$query = $this->db->get();
		return $query->row_array();
	}
	function get_company_details($iCompanyId) {
		$this->db->select('iCompanyId,vCompanyEmail,iParentDriverId,vCompnayName as vFirstName,vPassword');
		$this->db->from('company_information');
		$this->db->where('iCompanyId', $iCompanyId);
		$query = $this->db->get();
		return $query->row_array();
	}
	//get all Faq category list
	function get_faqcategory() {
		$this->db->select('iFaqCategoryId,vFaqCategoryName,vImage');
		$this->db->from('faq_category');
		$this->db->where('eStatus', 'Active');
		$query = $this->db->get();
		return $query->result_array();
	}
	function getinactive() {
		$this->db->select('iFaqCategoryId');
		$this->db->from('faq_category');
		$this->db->where('eStatus', 'Inactive');
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_faq($id) {
		$this->db->select('');
		$this->db->where('iFaqCategoryId', $id);
		$this->db->from('faq');
		$que = $this->db->get();
		return $que->result_array();
	}
	function get_faqquestion($num_limit, $rec_limit, $pagingflag, $iFaqCategoryId) {
		$this->db->select('f.iFaqId,f.vQuestion,f.vAnswer,fc.vFaqCategoryName,f.iFaqCategoryId');
		$this->db->from('faq as f');
		$this->db->join('faq_category as fc', 'fc.iFaqCategoryId=f.iFaqCategoryId');
		$this->db->where('f.iFaqCategoryId', $iFaqCategoryId);
		$this->db->where('f.eStatus', 'Active');
		if ($pagingflag != '') {
			$this->db->limit($rec_limit, $num_limit);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	function yourdriver($num_limit, $rec_limit, $pagingflag) {
		$this->db->select('iDriverId,vFirstName,vLastName,vProfileImage,tDescrption,iParentDriverId');
		$this->db->from('driver');
		$this->db->where('eStatus', 'Active');
		$this->db->order_by('iDriverId', 'desc');
		if ($pagingflag != '') {
			$this->db->limit($rec_limit, $num_limit);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	function yourteam($num_limit, $rec_limit, $pagingflag) {
		$this->db->select('iTeamMemberId,vFirstName,vLastName,vProfileImage,tDescrption');
		$this->db->from('your_team');
		$this->db->where('eStatus', 'Active');
		$this->db->order_by('iTeamMemberId', 'desc');
		if ($pagingflag != '') {
			$this->db->limit($rec_limit, $num_limit);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	function popularPlaceDetail($iPopularPlaceId) {
		$this->db->select('');
		$this->db->from('popular_place');
		$this->db->where('iPopularPlaceId', $iPopularPlaceId);
		return $this->db->get()->row_array();
	}
	function get_all_country() {
		$this->db->select('iCountryId,vCountry');
		$this->db->from('country');
		$query = $this->db->get();
		return $query->result_array();
	}
	function getCarTypes() {
		$this->db->select('');
		$this->db->from('vehicle_companies');
		$this->db->where('eStatus', 'Active');
		$query = $this->db->get();
		return $query->result_array();
	}
	function getDriverByCity($iCityId) {
		$this->db->select('iDriverId');
		$this->db->from('driver');
		$this->db->where('iCityId', $iCityId);
		$this->db->where('eStatus', 'Active');
		$this->db->order_by('iDriverId', 'desc');
		return $this->db->get()->result_array();
	}
	function checkVehicleDetail($iDriverId) {
		$this->db->select('vm.iVehicleCompanyId');
		$this->db->from('vehicle_attribute as va');
		$this->db0->join('vehicle_models as vm', 'va.iModelId=vm.iModelId');
		$this->db->where('va.iDriverId', $iDriverId);
		$this->db->where('va.eStatus', 'Approve');
		return $this->db->get()->result_array();
	}
	function getAvailableCartypes($availebleCarTyes) {
		$this->db->select('');
		$this->db->from('vehicle_companies');
		$this->db->where_in('iVehicleCompanyId', $availebleCarTyes);
		$this->db->where('eStatus', 'Active');
		return $this->db->get()->result_array();
	}
	function getvehiclecompny($iVehicleCompanyId) {
		$this->db->select('vCompany');
		$this->db->where('iVehicleCompanyId', $iVehicleCompanyId);
		$this->db->from('vehicle_companies');
		$que = $this->db->get();
		return $que->row_array();
	}
	function getFareDetails($iVehicleCompanyId, $iCityId) {;
		$this->db->select('');
		$this->db->where('iVehicleCompanyId', $iVehicleCompanyId);
		$this->db->where('iCityId', $iCityId);
		$this->db->from('fare_detail');
		return $this->db->get()->row_array();
	}
	function get_city_id($cityname) {
		$this->db->select('iCityId');
		$this->db->from('city');
		$this->db->where('vCity', $cityname);
		$this->db->where('eStatus','Active');
		return $this->db->get()->row_array();
	}
	function allFixRide($iCityId) {
		$this->db->select('fr.*');
		$this->db->from('fix_ride as fr');
		$this->db->where('fr.iCityId', $iCityId);
		$this->db->where('eStatus', 'Active');
		$this->db->order_by('fr.iRideId', 'DESC');
		return $this->db->get()->result_array();
	}
	function rateByCar($iRideId, $iVehicleCompanyId) {
		$this->db->select('iRateId,fTotalPrice');
		$this->db->from('fix_ride_rates');
		$this->db->where('iRideId', $iRideId);
		$this->db->where('iVehicleCompanyId', $iVehicleCompanyId);
		return $this->db->get()->row_array();
	}
	function allCarType() {
		$this->db->select('iVehicleCompanyId,vCompany,vSeatingCapacity,vCarimage');
		$this->db->from('vehicle_companies');
		$this->db->where('eStatus', 'Active');
		$this->db->order_by('iVehicleCompanyId', 'ASC');
		return $this->db->get()->result_array();
	}
	function vechicles_by_driver_city($iDriverId, $iCarTypeId) {
		$this->db->select('iDriverId,iCarTypeId');
		$this->db->from('drivers_vehicle_information');
		$this->db->where('iCarTypeId', $iCarTypeId);
		$this->db->where('iDriverId', $iDriverId);
		$this->db->where('eStatus', 'Approve');
		// echo "<pre>";print_r($this->db->get()->row_array());exit;
		return $this->db->get()->row_array();
	}
	function getdriverdetail($iDriverId) {
		$this->db->select('iDriverId,vFirstName,vLastName,vProfileImage,tDescrption,iParentDriverId');
		$this->db->from('driver');
		$this->db->where('iDriverId', $iDriverId);
		$query = $this->db->get();
		return $query->row_array();
	}
	function getCityId($cityname) {
		$this->db->select('');
		$this->db->from('city');
		$this->db->where('vCity', $cityname);
		return $this->db->get()->row_array();
	}
	function checkCityForQuote($iCityId) {
		$this->db->select('');
		$this->db->from('fare_detail');
		$this->db->where('iCityId', $iCityId);
		return $this->db->get()->result_array();
	}
	function getAllState() {
		$this->db->select('');
		$this->db->from('state');
		/*$this->db->where('iCountryId',$iCountryId);*/
		$this->db->where('eStatus', 'Active');
		return $this->db->get()->result_array();
	}
	function getState() {
		$this->db->select('iStateId,vState');
		$this->db->from('state');
		$this->db->where('iCountryId', 1);
		return $this->db->get()->result_array();
	}
	function get_cities($iStateId) {
		$this->db->select('');
		$this->db->from('city');
		$this->db->where('iStateId', $iStateId);
		$this->db->where('eStatus', 'Active');
		$query = $this->db->get();
		return $query->result_array();
	}
	function getdriver() {
		$this->db->select('');
		$this->db->from('driver');
		$que = $this->db->get();
		return $que->result_array();
	}
	function getcitybystateid($iStateId) {
		$this->db->select('');
		$this->db->from('city');
		$this->db->where('iStateId', $iStateId);
		$this->db->where('eStatus', 'Active');
		$query = $this->db->get();
		return $query->result_array();
	}
	function getMobileSlide() {
		$this->db->select('');
		$this->db->from('mobile_banner');
		$this->db->where('eStatus', 'Active');
		$query = $this->db->get();
		return $query->result_array();
	}
	function getVehicleCompanyByCityId($iCityId) {
		$this->db->select('vc.vCompany,vc.iVehicleCompanyId');
		$this->db->from('fare_detail as fd');
		$this->db->join('vehicle_companies as vc', 'fd.iVehicleCompanyId=vc.iVehicleCompanyId');
		$this->db->where('fd.iCityId', $iCityId);
		$query = $this->db->get();
		return $query->result_array();
	}
	function getVehicleCompanyByvehicleid($iVehicleCompanyId) {
		$this->db->select('vCompany');
		$this->db->from('vehicle_companies');
		$this->db->where('iVehicleCompanyId', $iVehicleCompanyId);
		$query = $this->db->get();
		return $query->row_array();
	}
	function getAllFixRide() {
		$this->db->select('fr.*');
		$this->db->from('fix_ride as fr');
		$this->db->where('eStatus', 'Active');
		$this->db->order_by('fr.iRideId', 'DESC');
		$this->db->limit(5);
		return $this->db->get()->result_array();
	}
	function ajax_getAllFixRide($start) {
		$this->db->select('fr.*');
		$this->db->from('fix_ride as fr');
		$this->db->where('eStatus', 'Active');
		$this->db->order_by('fr.iRideId', 'DESC');
		$this->db->limit(5, $start);
		return $this->db->get()->result_array();
	}
	function getAllFixRide_count() {
		$this->db->select('fr.*');
		$this->db->from('fix_ride as fr');
		$this->db->where('eStatus', 'Active');
		$this->db->order_by('fr.iRideId', 'DESC');
		return $this->db->count_all_results();
	}
	function FixedRateByCar($iRideId, $iVehicleCompanyId) {
		$this->db->select('iRateId,fTotalPrice');
		$this->db->from('fix_ride_rates');
		$this->db->where('iRideId', $iRideId);
		$this->db->where('iVehicleCompanyId', $iVehicleCompanyId);
		return $this->db->get()->row_array();
	}

	//access permission function
	function getleftbar(){
        $this->db->select('*');
        $this->db->from('admin_modules');
        $this->db->where('iParentId','0');
        $this->db->where('eStatus','Active');
        $this->db->order_by('iDisporder','asc');
        return $this->db->get()->result_array();
    }

    function getmodulename($iModuleId){
        $this->db->select('*');
        $this->db->from('admin_modules');
        $this->db->where('eStatus','Active');
        $this->db->order_by('iDisporder','asc');
        $this->db->where('iParentId',$iModuleId);
        return $this->db->get()->result_array();
    }

    function get_adminper_details($iAdminId,$eRole){ 
        if($eRole != ''){
            $this->db->select('a.*,aa.*');
            $this->db->select('a.iAdminId as iAdminId');
            $this->db->from('admin as a');
            $this->db->join('acc_mod_per_admin as aa','aa.iAdminId=a.iAdminId','left');
            $this->db->where('a.iAdminId',$iAdminId);
            $query = $this->db->get();
            return $query->row_array();
        }
        else{
            $this->db->select('*');
            $this->db->from('admin');
            $this->db->where('iAdminId',$iAdminId);
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    function getparentid($iModuleId){
        $this->db->select('iParentId');
        $this->db->from('admin_modules');
        $this->db->where('iModuleId',$iModuleId);
        $this->db->where('eStatus','Active');
        $query=$this->db->get()->row_array();
        return $query['iParentId'] ;
    }

    function getmoduleid($vPath){
        $this->db->select('iModuleId,iParentId');
        $this->db->from('admin_modules');
        $this->db->where('eStatus','Active');
        $this->db->where('vPath',$vPath);
        return $this->db->get()->row_array();
    }

  	function get_image_details($fieldId, $tableData) {
        $this->db->select($tableData['image_field']);
        $this->db->from($tableData['tablename']);
        $this->db->where($tableData['update_field'], $fieldId);
        $query = $this->db->get();
        // echo "<pre>";print_r($query->result());
        return $query->row_array();
    }
    
    // USE FOR DELETE IMAGE
    function delete_images($tableData) {
        // echo "<pre>";print_r($tableData);exit;
        $data[$tableData['image_field']] = '';
        $this->db->where($tableData['update_field'], $tableData['field_id']);
        return $this->db->update($tableData['tablename'], $data);
    }  

    function update_imagetype($tableData){
    	$data[$tableData['image_type']] = 'withouturl';
        $this->db->where($tableData['update_field'], $tableData['field_id']);
        return $this->db->update($tableData['tablename'], $data);
    }

    function getUserIdByHashCode($hashcode){
  		$this->db->select('iUserId');
        $this->db->from('users');
        $this->db->where('vHashCode', $hashcode);
        $query = $this->db->get();
        return $query->row_array();  	
    }

    function editResetPassword($data){
    	$this->db->update("users", $data, array('iUserId' => $data['iUserId']));
        return $this->db->affected_rows();
    }

    function saveContactUs($data){
  		$this->db->insert('contact_us', $data);
        return $this->db->insert_id();  	
    }
}
?>