<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_management extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/admin_management_model', '', TRUE);
        $this->smarty->assign("data", $this->data);
        if (!isset($this->session->userdata['happyhour_admin_info'])) {
            redirect($this->data['admin_url'] . 'authentication');
            exit;
        }
    }
    
    function index() {
        $this->data['menuAction'] = 'Administrator';
        $this->data['adminlist']=$this->admin_management_model->getalladmin('Admin');
        $this->data['tpl_name'] = "admin/admin_management/view_admin.tpl";
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['happyhour_admin_info'] = $this->session->userdata['happyhour_admin_info'];
        $this->breadcrumb->add('Dashboard', $this->data['admin_url'] . 'home');
        $this->breadcrumb->add('View Admin', '');
        $this->data['breadcrumb'] = $this->breadcrumb->output();
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }
    
    function action_update() {
        $this->data['menuAction'] = 'Administrator';
        $ids = $this->input->post('iId');
        $action = $this->input->post('action');
        $tableData['tablename'] = 'admin';
        $tableData['update_field'] = 'iAdminId';
        $count = $this->update_status($ids, $action, $tableData);
        if ($action == 'Delete') {
            $count = count($ids);
        } else {
            $count = $count;
        }
        $recordtitle = '';
        if ($count > 1) {
            $recordtitle = 'Records';
        } else {
            $recordtitle = 'Record';
        }
        if ($action == 'Delete') {
            $this->session->set_flashdata('message', "Total  ($count) " . $recordtitle . " Deleted Successfully");
        } else {
            $this->session->set_flashdata('message', "Total  ($count) " . $recordtitle . " Updated Successfully");
        }
        redirect($this->data['admin_url'] . 'admin_management');
    }

    function create() {
        $this->data['menuAction'] = 'Administrator';
        $eStatuses = field_enums('admin', 'eStatus');
        $eRole = field_enums('admin', 'eRole');
        $this->data['action'] = 'create';
        $this->data['label'] = 'Add';
        if ($this->input->post()) {
            $admin_detail = $this->input->post();
            $password = $this->input->post('vPassword');
            $admin_detail['vPassword'] = encrypt($this->input->post('vPassword'));
            $admin_detail['dCreatedDate'] = date('Y-m-d');
            $admin_detail['iMobileNo'] = '+65'.($this->input->post('iMobileNo'));
            $admin_detail['eStatus'] = 'Active';
            //print_r($admin_detail);exit;
            $iAdminId = $this->admin_management_model->add_admin($admin_detail);
            
            if($iAdminId>0){
                if($admin_detail['eRole']=='Admin'){
                    $this->data['moduleArr'] = $this->admin_management_model->get_allmodules_accesspermission();
                    $ListingiId = $this->data['moduleArr'];
                    $marr = array();
                    for ($i=0; $i < count($ListingiId); $i++) { 
                        $seqmodulelisting[$i] = $ListingiId[$i]['iModuleId'];
                    }
                    if($seqmodulelisting>0){
                        $Data['iAdminId'] = $iAdminId;
                        $Data['tListing'] = @implode(",", $seqmodulelisting);
                        $Data['tAdd'] = @implode(",",$seqmodulelisting);
                        $Data['tUpdate'] = @implode(",",$seqmodulelisting);
                        $Data['tDelete'] = @implode(",",$seqmodulelisting);
                        $Data['tActive'] = @implode(",",$seqmodulelisting);
                        $Data['tInactive'] = @implode(",",$seqmodulelisting);
                        $Data['tExportMerchant'] = 5;
                        $Data['tExportUsers'] = 6;
                        $Data['tSendPushnotification'] = 13;
                    }else{
                        $Data['tListing'] = "";
                        $Data['tAdd'] = "";
                        $Data['tUpdate'] = "";
                        $Data['tDelete'] = "";
                        $Data['tActive'] = "";
                        $Data['tInactive'] = "";
                        $Data['tExportMerchant'] = 5;
                        $Data['tExportUsers'] = 6;
                        $Data['tSendPushnotification'] = 13;
                    }
                    $iAccessId = $this->admin_management_model->add_admindefault_permission($Data);
                    $this->session->set_flashdata('message',"Administrator Added Successfully");
                    redirect($this->data['admin_url'].'admin_management');
                    exit;
                }else{
                    $this->session->set_flashdata('message',"Administrator Added Successfully");
                    redirect($this->data['admin_url'].'admin_management');
                    exit;
                }
            }else{
                $this->session->set_flashdata('message',"Administrator Not Added");
                redirect($this->data['admin_url'].'admin_management');
                exit;
            }
        }
        $this->breadcrumb->add('Dashboard', $this->data['admin_url'] . 'home');
        $this->breadcrumb->add('View Admin', $this->data['admin_url'] . "admin_management");
        $this->breadcrumb->add('Add Admin', '');
        $this->data['breadcrumb'] = $this->breadcrumb->output();
        $this->data['tpl_name'] = "admin/admin_management/add_edit_admin.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->assign('eStatuses', $eStatuses);
        $this->smarty->assign('eRole', $eRole);
        $this->smarty->view('admin/admin-template.tpl');
    }
    
    function update() {
        $this->data['menuAction'] = 'Administrator';
        $eStatuses = field_enums('admin', 'eStatus');
        $eRole = field_enums('admin', 'eRole');
        $this->data['action'] = 'update';
        $this->data['label'] = 'Edit';
        $iAdminId = $this->uri->segment(4);
        $this->data['admin_detail'] = $this->admin_management_model->get_admin_details($iAdminId);
        $this->data['admin_detail']['iMobileNo'] = substr($this->data['admin_detail']['iMobileNo'], 3);
        /* All Module */
        $this->data['moduleArr'] = $this->admin_management_model->getallmodules();
        /* Get Module by AdminId */
        if($iAdminId){
            $Arr =  $this->admin_management_model->checkmodules($iAdminId);
        }

        if($Arr){
            if($Arr['tListing']){
                $Arr['tListing'] = explode(",",$Arr['tListing']);    
            }
            if($Arr['tAdd']){
                $Arr['tAdd'] = explode(",",$Arr['tAdd']);
            }
            if($Arr['tUpdate']){
                $Arr['tUpdate'] = explode(",",$Arr['tUpdate']);
            }
            if($Arr['tDelete']){
                $Arr['tDelete'] = explode(",",$Arr['tDelete']);
            }
            if($Arr['tActive']){
                $Arr['tActive'] = explode(",",$Arr['tActive']);  
            }
            if($Arr['tInactive']){
                $Arr['tInactive'] = explode(",",$Arr['tInactive']);
            }
            if($Arr['tExportMerchant']){
                $Arr['tExportMerchant'] = explode(",",$Arr['tExportMerchant']);
            }
            if($Arr['tExportUsers']){
                $Arr['tExportUsers'] = explode(",",$Arr['tExportUsers']);
            }
            if($Arr['tSendPushnotification']){
                $Arr['tSendPushnotification'] = explode(",",$Arr['tSendPushnotification']);
            }
        }
        $this->smarty->assign("Arr",$Arr);

        if ($this->input->post()) {
            /*echo"<pre>";print_r($this->input->post());exit;*/
            $admin_detail = $this->input->post('admin_detail');
            $admin_detail['iAdminId'] = $this->input->post('iAdminId');
            $admin_detail['vFirstName'] = $this->input->post('vFirstName');
            $admin_detail['vLastName'] = $this->input->post('vLastName');
            $admin_detail['vEmail'] = $this->input->post('vEmail');
            $admin_detail['iMobileNo'] = '+65'.($this->input->post('iMobileNo'));
            $admin_detail['eRole'] = $this->input->post('eRole');
            $admin_detail['dModifiedDate'] = date('Y-m-d');

            $admin_detail['eStatus'] = $this->input->post('eStatus');
            
            $iAdminId = $this->admin_management_model->edit_admin($admin_detail);
            $this->session->set_flashdata('message', "Admin Profile Details Updated Successfully");
            redirect($this->data['admin_url'] . 'admin_management');
            exit;
        }
        $this->breadcrumb->add('Dashboard', $this->data['admin_url'] . 'home');
        $this->breadcrumb->add('View Admin', $this->data['admin_url'] . "admin_management");
        $this->breadcrumb->add('Edit Admin', '');
        $this->data['breadcrumb'] = $this->breadcrumb->output();
        $this->data['iAdminId'] = $iAdminId;
        $this->data['tpl_name'] = "admin/admin_management/add_edit_admin.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->assign('eStatuses', $eStatuses);
        $this->smarty->assign('eRole', $eRole);
        $this->smarty->view('admin/admin-template.tpl');
    }

    function edit(){
        $this->data['menuAction'] = 'Administrator';
        if($this->input->post()){
            $ListingiId = $this->input->post('ListingiId');
            $AddiId = $this->input->post('AddiId'); 
            $UpdateiId = $this->input->post('UpdateiId');
            $DeleteiId = $this->input->post('DeleteiId');
            $ActiveiId = $this->input->post('ActiveiId');
            $InactiveiId = $this->input->post('InactiveiId');
            $ExportMerchantiId = $this->input->post('ExportMerchantiId');
            $ExportUseriId = $this->input->post('ExportUsersId');
            $SendPushnotificationId = $this->input->post('SendPushnotificationId');
            $iAdminId = $this->input->post('iAdminId');
            
            $Data['iAdminId'] = $iAdminId;
            if(count($ListingiId) > 0){
                $Data['tListing'] = @implode(",",$ListingiId);
            }else{
                $Data['tListing'] = "";
            }
            if(count($AddiId) > 0){
                $Data['tAdd'] = @implode(",",$AddiId);
            }else{
                $Data['tAdd'] = "";
            }
            if(count($UpdateiId) > 0){
                $Data['tUpdate'] = @implode(",",$UpdateiId);
            }else{
                $Data['tUpdate'] = "";
            }
            if(count($DeleteiId) > 0){
                $Data['tDelete'] = @implode(",",$DeleteiId);
            }else{
                $Data['tDelete'] = "";
            }
            if(count($ActiveiId) > 0){
                $Data['tActive'] = @implode(",",$ActiveiId);
            }else{
                $Data['tActive'] = "";
            }
            if(count($InactiveiId) > 0){
                $Data['tInactive'] = @implode(",",$InactiveiId);
            }else{
                $Data['tInactive'] = "";
            }

            if(count($ExportMerchantiId) > 0){
                $Data['tExportMerchant'] = @implode(",",$ExportMerchantiId);
            }else{
                $Data['tExportMerchant'] = "";
            }
            
            if(count($ExportUseriId) > 0){
                $Data['tExportUsers'] = @implode(",",$ExportUseriId);
            }else{
                $Data['tExportUsers'] = "";
            }

            if(count($SendPushnotificationId) > 0){
                $Data['tSendPushnotification'] = @implode(",",$SendPushnotificationId);
            }else{
                $Data['tSendPushnotification'] = "";
            }

            if($iAdminId){
                $resultArr =  $this->admin_management_model->checkmodules($iAdminId);
                if(count($resultArr) > 0){
                    $this->admin_management_model->deletemodules($iAdminId);                   
                }
                $id = $this->admin_management_model->save($Data);      
                $this->session->set_flashdata('message',"Access Permission Updated Successfully.");
                redirect($this->data['admin_url'].'admin_management');
           }
        }
    }

    function checkEmailExist(){
        $iAdminId=$this->uri->segment(4);
        $oldAdminEmail=$this->admin_management_model->getAdminEmailDetailsByAdminId($iAdminId);
        if ($oldAdminEmail['vEmail'] == $this->input->post('vEmail')) {
           
             echo json_encode(array('valid' => true,));  
        }
        else{
            $chekemailfromUser=$this->admin_management_model->checkEmailExistFromUser($this->input->post('vEmail'));
            $chekemailfromAdmin=$this->admin_management_model->checkEmailExistFromAdmin($this->input->post('vEmail'));
            $chekemailfromBarOwner=$this->admin_management_model->checkEmailExistFromOwners($this->input->post('vEmail'));
           
            if($chekemailfromUser =='YES' || $chekemailfromBarOwner == 'YES' || $chekemailfromAdmin == 'YES'){
                echo json_encode(array('valid' => false,));  
            }
            else{ 
                echo json_encode(array('valid' => true,));    
            }
        }  
    }

    function get_admin_listing() {
        $this->data['menuAction'] = 'Administrator';
        $id = $this->data['userdata']['happyhour_admin_info']['iAdminId'];
        $all_admins = $this->admin_management_model->get_all_admins($id);
        if (count($all_admins) > 0) {
            foreach ($all_admins as $key => $value) {
                $fname = ucfirst($value['vFirstName']);
                $lname = ucfirst($value['vLastName']);
                $alldata[$key]['id'] = '<center><input type="checkbox" name="iId[]" id="iId" value="' . $value['iAdminId'] . '"></center>';
                $alldata[$key]['name'] = $fname . ' ' . $lname;
                $alldata[$key]['email'] = $value['vEmail'];
                $alldata[$key]['status'] = $value['eStatus'];
                $alldata[$key]['editlink'] = '<center><a href="' . $this->data['base_url'] . 'admin_management/update/' . $value['iAdminId'] . '"><i class="icon-pen icon2x"></i></a></center>';
            }
            $aData['aaData'] = $alldata;
        } else {
            $aData['aaData'] = '';
        }
        $json_lang = json_encode($aData);
        echo $json_lang;
        exit;
    }
    function check_email_exist() {
        $this->data['menuAction'] = 'Administrator';
        $vEmail = $this->input->get('email');
        $db_admin_email = $this->input->get('oldemail');
        if ($vEmail == $db_admin_email) {
            echo "sucess";
        } else {
            $checkexist = $this->admin_management_model->admin_exists($vEmail);
            if ($checkexist != 0) {
                echo "exitst";
            } else {
                echo "Not exitst";
            }
            exit;
        }
    }
}
?>