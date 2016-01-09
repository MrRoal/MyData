<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends Front_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('driver_contact_model', '', TRUE);
        $this->load->model('client_info_model', '', TRUE);
        $this->load->model('sub_driver_model', '', TRUE);
        $this->load->model('login_model', '', TRUE);
        if ($this->session->userdata['ridein_front_info']['iDriverId'] == '') {
            redirect($this->data['base_url']);
            exit;
        }
        $this->smarty->assign("data", $this->data);
    }
    //use for display dashboard
    function index() {
        $this->data['activeclass'] = 'dashboard';
        $iDriverId = $this->session->userdata['ridein_front_info']['iDriverId'];
        $this->data['iDriverId'] = $iDriverId;
        $latestTrip = $this->driver_contact_model->getLatestTrip($iDriverId);
        /*echo "<pre>";print_r($latestTrip);exit;*/
        $this->data['licence_status'] = $this->driver_contact_model->check_driver_licence_information_status($iDriverId);
        $this->data['TripTotRecord'] = $this->driver_contact_model->getCountLatestTrip($iDriverId);
        for ($i = 0;$i < count($latestTrip);$i++) {
            $TripDate = new DateTime($latestTrip[$i]['dTripDate']);
            $endDate = new DateTime($latestTrip[$i]['dRideEndDate']);
            $Trip = $TripDate->diff($endDate);
            if ($Trip->d) {
                $tmp['D'] = $Trip->d . ' D ';
            }
            if ($Trip->h) {
                $tmp['H'] = $Trip->h . ' H ';
            }
            if ($Trip->i) {
                $tmp['M'] = $Trip->i . ' M ';
            }
            if ($Trip->s) {
                $tmp['S'] = $Trip->s . ' S';
            }
            $latestTrip[$i]['duration'] = $tmp['D'] . $tmp['H'] . $tmp['M'] . $tmp['S'];
            /*$latestTrip[$i]['duration'] = $Trip->h.' H '.$Trip->i.' Min';*/
            $latestTrip[$i]['rider_name'] = $this->driver_contact_model->ridername($latestTrip[$i]['iClientId']);
            $latestTrip[$i]['fFinalPayment'] = $latestTrip[$i]['fFinalPayment'];
        }
        $checkLicence = $this->driver_contact_model->checkLincenceInformation($iDriverId);
        /*if ((empty($checkLicence)) || ($checkLicence['eVerifiedStatus'] == 'Not Checked')) {
        $this->session->set_flashdata('message',"To get your Registration Approved<br> It is important you fill in your valid license information as earliest.");
        $this->data['message'] = $this->session->flashdata('message');
        }*/
        $this->data['tripDetails'] = $latestTrip;
        $this->data['tpl_name'] = "dashboard.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('template.tpl');
    }
    function ajax_data_change() {
        $start = $this->uri->segment(3);
        $end = $this->uri->segment(4);
        $iDriverId = $this->session->userdata['ridein_front_info']['iDriverId'];
        $latestTrip = $this->driver_contact_model->getLatestTrip($iDriverId);
        for ($i = 0;$i < count($latestTrip);$i++) {
            $TripDate = new DateTime($latestTrip[$i]['dTripDate']);
            $endDate = new DateTime($latestTrip[$i]['dRideEndDate']);
            $Trip = $TripDate->diff($endDate);
            $latestTrip[$i]['duration'] = $Trip->h . ' H ' . $Trip->i . ' Min';
            $latestTrip[$i]['rider_name'] = $this->driver_contact_model->ridername($latestTrip[$i]['iClientId']);
            $latestTrip[$i]['fFinalPayment'] = round(($latestTrip[$i]['fBaseFare']) + ($latestTrip[$i]['fDistance'] * $latestTrip[$i]['fPerMileFare']) + ($latestTrip[$i]['fTotalMinute'] * $latestTrip[$i]['fPerMinFare']));
        }
        $j = 0;
        if ($end > count($latestTrip)) {
            $end = count($latestTrip);
        }
        for ($i = $start;$i < $end;$i++) {
            $data1[$j] = $latestTrip[$i];
            $j++;
        }
        $this->data['tripDetails'] = $data1;
        $this->data['TripTotRecord'] = count($latestTrip);
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('driver_dashboard_dataexchanger.tpl');
    }
    function client_detail() {
        $this->data['activeclass'] = 'dashboard';
        $iDriverId = $this->session->userdata['ridein_front_info']['iDriverId'];
        $tripid = $this->uri->segment(3);
        $tripsDetail = $this->driver_contact_model->trip_detail($tripid);
        /*echo "<pre>";print_r($tripsDetail);exit;*/
        $transactionDetails = $this->driver_contact_model->transactionDetail($tripsDetail['iCustomerCreditCardId']);
        /*echo "<pre>";print_r($transactionDetails);exit;*/
        $this->data['iTripId'] = $tripsDetail['iTripId'];
        $this->data['totalRate'] = $tripsDetail['fRating'];
        if ($tripsDetail['ePaymentType'] == 'Cash') {
            $this->data['vCardName'] = '';
            $this->data['vCardImage'] = "cash.png";
            $this->data['vCreditcardNo'] = "";
        } else {
            $this->data['vCardName'] = $transactionDetails['vCardName'];
            $this->data['vCardImage'] = $transactionDetails['vCardImage'];
            $this->data['vCreditcardNo'] = $this->decrypt_text($transactionDetails['vCreditcardNo']);
        }
        $this->data['MinimumFare'] = number_format($tripsDetail['MinimumFare'], 2);
        $this->data['fBaseFare'] = $tripsDetail['fBaseFare'];
        $this->data['fPerMileFare'] = $tripsDetail['fPerMileFare'];
        $this->data['fPerMinFare'] = $tripsDetail['fPerMinFare'];
        $this->data['dSubtotalPayment'] = number_format($tripsDetail['dSubtotalPayment'], 2);
        $this->data['fFinalPayment'] = $tripsDetail['fFinalPayment'];
        $this->data['TotalDiscount'] = number_format($tripsDetail['dInvitePromoCodeDiscount'] + $tripsDetail['dNewsLetterPromocodeDiscount'], 2);
        $iClientId = $tripsDetail['iClientId']['iClientId'];
        $this->data['Trippatner'] = $this->driver_contact_model->get_trip_patner($iClientId, $tripid);
        $tripsDetail['iClientId']['iClientId'];
        $tripsDetail['fFinalPayment'] = $tripsDetail['fFinalPayment'];
        $this->data['trip_detail'] = $tripsDetail;
        $sourceLatLong = explode("|", $tripsDetail['tPickUpAddressLatLong']);
        $DestinationLatLong = explode("|", $tripsDetail['tDestinationAddressLatLong']);
        $this->data['trip_detail']['sourcelat'] = $sourceLatLong[0];
        $this->data['trip_detail']['sourcelong'] = $sourceLatLong[1];
        $this->data['trip_detail']['destinationlat'] = $DestinationLatLong[0];
        $this->data['trip_detail']['destinationlong'] = $DestinationLatLong[1];
        $this->data['tpl_name'] = "driver_trip_detail.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('template.tpl');
    }
    function valemeil() {
        $driverid = $this->uri->segment(3);
        $email = $this->input->post('email');
        $flag = $this->driver_contact_model->valemail($email, $driverid);
        if ($flag > 0) {
            echo "same";
            exit;
        } else {
            $flag2 = $this->driver_contact_model->varemaildriver($email);
            if ($flag2 > 0) {
                echo "exist";
                exit;
            }
            $flag3 = $this->driver_contact_model->varemailclient($email);
            if ($flag3 > 0) {
                echo "exist";
                exit;
            }
            echo "new";
        }
    }
    //use for display dashboard
    function contactinfo() {
        /*echo"<pre>";print_r($this->data);exit;*/
        $this->data['activeclass'] = 'contactinfo';
        $iDriverId = $this->session->userdata['ridein_front_info']['iDriverId'];
        $this->data['dcontact'] = $this->driver_contact_model->get_driver_details($iDriverId);
        $this->data['dcontact']['vPassword'] = $this->decrypt($this->data['dcontact']['vPassword']);
        /*$this->data['dcpmpanyinfo']=$this->driver_contact_model->get_Compamy_info($iDriverId);*/
        $this->data['dlicenseinfo'] = $this->driver_contact_model->get_licence_info($iDriverId);
        $this->data['bankinfo'] = $this->driver_contact_model->get_bank_info($iDriverId);
        $countries = $this->driver_contact_model->get_country();
        $this->data['country'] = $countries;
        $states = $this->driver_contact_model->get_allstates_bycountry($this->data['dcontact']['iCountryId']);
        $this->data['allprovince'] = $states;
        $this->data['all_driver_category'] = $this->login_model->get_all_drivercategory();
        $city = $this->driver_contact_model->get_all_cities($this->data['dcontact']['iStateId']);
        $this->data['city'] = $city;
        if ($this->input->post()) {
            $driverDetails = $this->input->post('driver');
            $licence_info = $this->input->post('licence_info');
            $iDriverId = $this->session->userdata['ridein_front_info']['iDriverId'];
            $vari = $this->driver_contact_model->varify($iDriverId);
            $driver['vFirstName'] = $driverDetails['vFirstName'];
            $driver['vLastName'] = $driverDetails['vLastName'];
            if ($driverDetails['vPassword']) {
                $driver['vPassword'] = encrypt($driverDetails['vPassword']);
            }
            $driver['tAddress'] = mysql_real_escape_string($driverDetails['tAddress']);
            /*$driver['vCountryMobileCode'] = "+1";*/
            /*$driver['iCountryId'] = 1;*/
            $driver['iStateId'] = $driverDetails['iStateId'];
            $getCountry = $this->driver_contact_model->getCountryID($driver['iStateId']);
            $driver['iCountryId'] = $getCountry['iCountryId'];
            $driver['iCityId'] = $driverDetails['iCityId'];
            $driver['vPostalCode'] = $driverDetails['vPostalCode'];
            $driver['iMobileNo'] = $driverDetails['iMobileNo'];
            $driver['vBusinessNumber'] = $driverDetails['vBusinessNumber'];
            $driver['eStatus'] = 'Active';
            $driver['dRegisterDate'] = date('Y-m-d');
            $licence_info['iDriverId'] = $iDriverId;
            /*if($_FILES['license']['name']!=''){
            $size=array();
            $size['width']='228';
                $size['height']='228';
                $size['width2']='57';
                $size['height2']='57';
            $licence_info['vDocument']=$_FILES['license']['name'];
            $image_uploaded =$this->do_upload_img($iDriverId,'vehicle_document','license',$size);
            }
            if($_FILES['TexiLicence']['name']!=''){
            $size=array();
            $size['width']='228';
                $size['height']='228';
                $size['width2']='57';
                $size['height2']='57';
            $licence_info['vTexiLicence']=$_FILES['TexiLicence']['name'];
            $image_uploaded =$this->do_upload_img($iDriverId,'texi_doc_img','TexiLicence',$size);
            }
            
            if($_FILES['PoliceReport']['name']!=''){
            $size=array();
            $size['width']='228';
                $size['height']='228';
                $size['width2']='57';
                $size['height2']='57';
            $licence_info['vPoliceReport']=$_FILES['PoliceReport']['name'];
            $image_uploaded =$this->do_upload_img($iDriverId,'police_report','PoliceReport',$size);
            }
            */
            if ($vari > 0) {
                $this->driver_contact_model->edit_licence($licence_info);
            } else {
                $this->driver_contact_model->add_licence($licence_info);
            }
            if ($_FILES['vProfileImage']['name'] != '') {
                $size = array();
                $size['width'] = '228';
                $size['height'] = '228';
                $size['width2'] = '57';
                $size['height2'] = '57';
                $driver['vProfileImage'] = $_FILES['vProfileImage']['name'];
                $image_uploaded = $this->do_upload_img($iDriverId, 'driver', 'vProfileImage', $size);
                $driver['vProfileImage'] = $image_uploaded;
                $driver['iDriverId'] = $iDriverId;
                $iDriverId = $this->driver_contact_model->edit_driver($driver);
            }
            $driver['iDriverId'] = $this->input->post('iDriverId');
            $Bank = $this->input->post('Bank');
            $Bank['iBankDetailId'] = $this->input->post('iBankDetailId');
            $iDriverId = $this->driver_contact_model->edit_driver($driver);
            /*$Bank['iDriverId']=$driver['iDriverId'];
            if($Bank['iBankDetailId'] != ""){
            $iBankDetailId = $this->driver_contact_model->edit_bankdetail($Bank);
            }
            else
            {
            $iBankDetailId = $this->driver_contact_model->add_bankdetail($Bank);
            }*/
            $this->session->set_flashdata('message', "Your Profile details were updated successfully");
            redirect($this->data['admin_url'] . 'driver-contact-info');
            exit;
        }
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['tpl_name'] = "contactinfo.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('template.tpl');
    }
    function dellicence() {
        $driverid = $this->input->get('id');
        $field = $this->input->get('field');
        $folder = $this->input->get('folder');
        $upload_path = $this->config->item('base_path');
        $url = $upload_path . "/uploads/" . $folder . "/" . $driverid;
        $this->driver_contact_model->dellicenceimg($driverid, $field);
        array_map('unlink', glob($url . "/*"));
        redirect($this->data['admin_url'] . 'driver-contact-info');
    }
    function deleteicon() {
        $upload_path = $this->config->item('base_path');
        $iDriverId = $this->input->get('id');
        $iParentDriverId = $this->input->get('parent');
        $crop_imag = array();
        $crop_imag['image1'] = '160X180_';
        $crop_imag['image2'] = '42X37_';
        $crop_imag['image3'] = '228X228_';
        $crop_imag['image4'] = '57X57_';
        $tableData['tablename'] = 'driver';
        $tableData['update_field'] = 'iDriverId';
        $tableData['image_field'] = 'vProfileImage';
        $tableData['crop_image'] = $crop_imag;
        if ($iParentDriverId == 0) {
            $tableData['folder_name'] = 'driver';
        } else {
            $tableData['folder_name'] = 'subdriver';
        }
        $tableData['field_id'] = $iDriverId;
        $deleteImage = $this->delete_image($tableData);
        redirect($this->data['admin_url'] . 'driver-contact-info');
    }
    function vehicles() {
        $this->data['activeclass'] = 'vehicles';
        $this->data['tpl_name'] = "vehicles.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('template.tpl');
    }
    function documents() {
        $this->data['activeclass'] = 'documents';
        $iDriverId = $this->session->userdata['ridein_front_info']['iDriverId'];
        $this->data['iDriverId'] = $iDriverId;
        $this->data['base_upload'] = $this->config->item('base_upload');
        $this->data['licence_info'] = $this->driver_contact_model->get_licence_info($iDriverId);
        //echo "<pre>";print_r($this->data['licence_info']);exit;
        if ($this->input->post()) {
            $licence_info = $this->input->post('licence_info');
            $iLicenceId = $this->input->post('iLicenceId');
            if ($iLicenceId == "") {
                $licence_info['iLicenceId'] = $iLicenceId;
                $licence_info['dDate'] = date('y-m-d');
                $licence_info['eVerifiedStatus'] = 'Not Checked';
                if ($_FILES['vDocument']['name'] != '') {
                    $document_name = $this->do_upload_document($licence_info['iDriverId'], 'driver', 'vDocument');
                    $licence_info['vDocument'] = $document_name;
                }
                $iLicenceId = $this->driver_contact_model->add_licence_info($licence_info);
                $this->session->set_flashdata('message', "Driver license information added successfully");
            } else {
                $iLicenceId = $this->input->post('iLicenceId');
                $licence_info['iLicenceId'] = $iLicenceId;
                $licence_info['dDate'] = date('y-m-d');
                $licence_info['eVerifiedStatus'] = 'Not Checked';
                if ($_FILES['vDocument']['name'] != '') {
                    $document_name = $this->do_upload_document($licence_info['iDriverId'], 'driver', 'vDocument');
                    $licence_info['vDocument'] = $document_name;
                }
                $iLicenceId = $this->driver_contact_model->edit_licence_info($licence_info);
                $this->session->set_flashdata('message', "Driver license information updated successfully");
            }
            redirect($this->data['admin_url'] . 'documents');
            exit;
        }
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['tpl_name'] = "documents.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('template.tpl');
    }
    function drivers() {
        $this->data['activeclass'] = 'drivers';
        $iDriverId = $this->data['userdata']['ridein_front_info']['iDriverId'];
        $all_drivers = $this->driver_contact_model->get_sub_driver($iDriverId);
        $this->breadcrumb->add('Dashboard', $this->data['base_url'] . 'dashboard');
        $this->breadcrumb->add('Drivers', '');
        $this->data['bread_crumb'] = $this->breadcrumb->output();
        $totalsubdriver = count($all_drivers);
        $this->data['all_drivers'] = $all_drivers;
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['tpl_name'] = "drivers.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->assign('totalsubdriver', $totalsubdriver);
        $this->smarty->view('template.tpl');
    }
    function addvehicle() {
        $this->data['activeclass'] = 'drivers';
        $this->data['tpl_name'] = "add_vehicle.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('template.tpl');
    }
    function vehicle_document() {
        $this->data['activeclass'] = 'drivers';
        $this->data['base_upload'] = $this->config->item('base_upload');
        $this->data['tpl_name'] = "vehicle_document.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('template.tpl');
    }
    function Countrycode() {
        $iCountryId = $this->uri->segment(3);
        $vCountryMobileCode = $this->driver_contact_model->get_country_code($iCountryId);
        echo $vCountryMobileCode;
        exit;
    }
    function do_upload_document($folderId, $folder, $document) {
        if (!is_dir('uploads/' . $folder . '/')) {
            @mkdir('uploads/' . $folder . '/', 0777);
        }
        if (!is_dir('uploads/' . $folder . '/' . $folderId)) {
            @mkdir('uploads/' . $folder . '/' . $folderId, 0777);
        }
        $filename = $_FILES[$document]['name'];
        $filename = $this->upload->clean_file_name($filename);
        $config = array('allowed_types' => '*', 'upload_path' => 'uploads/' . $folder . '/' . $folderId, 'file_name' => $filename, 'max_size' => 5380334);
        $this->load->library('Upload', $config);
        $this->upload->initialize($config);
        $test = $this->upload->do_upload($document); //do upload
        $image_data = $this->upload->data(); //get icon data
        $img_uploaded = $image_data['file_name'];
        return $img_uploaded;
    }
    function deletedocument() {
        $upload_path = $this->config->item('base_path');
        $iDriverId = $this->input->get('id');
        $iLicenceId = $this->input->get('iLicenceId');
        $tableData['tablename'] = 'drivers_licence';
        $tableData['update_field'] = 'iLicenceId';
        $tableData['image_field'] = 'vDocument';
        $tableData['folder_name'] = 'driver';
        $tableData['field_id'] = $iLicenceId;
        $tableData['remove_field'] = $iDriverId;
        $deleteDocument = $this->delete_licence_document($tableData);
        redirect($this->data['admin_url'] . 'documents');
    }
    function delete_licence_document($tableData) {
        $upload_path = $this->data['base_path'];
        $data = $this->common_model->get_category_details($tableData['field_id'], $tableData);
        $var = unlink($upload_path . 'uploads/' . $tableData['folder_name'] . '/' . $tableData['remove_field'] . '/' . $data[$tableData['image_field']]);
        $crop_image = $tableData['crop_image'];
        if (count($crop_image) > 0) {
            foreach ($crop_image as $value) {
                if ($value != '') {
                    $delete_cropimage = unlink($upload_path . 'uploads/' . $tableData['folder_name'] . '/' . $tableData['remove_field'] . '/' . $value . $data[$tableData['image_field']]);
                }
            }
        }
        $var1 = $this->common_model->delete_image($tableData);
        return $var1;
    }
    function getTripListinginfo() {
        $no = $this->input->get('record');
        $iDriverId = $this->data['userdata']['ridein_front_info']['iDriverId'];
        $getFairDeatils = $this->driver_contact_model->get_driver_trips($iDriverId, $no);
        if (count($getFairDeatils) > 0) {
            foreach ($getFairDeatils as $key => $value) {
                $alldata[$key]['client'] = $value['vFirstName'] . ' ' . $value['vLastName'];
                $alldata[$key]['pickloc'] = $value['vPickupLocation'];
                $alldata[$key]['droploc'] = $value['vDestinationLocation'];
                $alldata[$key]['distance'] = $value['fDistance'] . ' km';
                $alldata[$key]['fares'] = $value['fFinalPayment'] . ' BZ';
                $alldata[$key]['Date'] = $value['dtripDate'];
            }
            $aData['aaData'] = $alldata;
        } else {
            $aData['aaData'] = '';
        }
        $json_lang = json_encode($aData);
        echo $json_lang;
        exit;
    }
    function get_all_driver() {
        $iDriverId = $this->data['userdata']['ridein_front_info']['iDriverId'];
        $get_drivers = $this->driver_contact_model->get_sub_driver($iDriverId);
        // echo "<pre>";print_r($get_drivers);exit;
        if (count($get_drivers) > 0) {
            foreach ($get_drivers as $key => $value) {
                $alldata[$key]['id'] = '<input type="checkbox" name="iId[]" id="iId' . $value['iDriverId'] . '" value="' . $value['iDriverId'] . '">';
                $alldata[$key]['drivername'] = $value['vFirstName'] . '' . $value['vLastName'];
                $alldata[$key]['email'] = $value['vEmail'];
                $alldata[$key]['phoneno'] = $value['iMobileNo'];
                $alldata[$key]['country'] = $value['vCountry'];
                $alldata[$key]['state'] = $value['vState'];
                $alldata[$key]['status'] = $value['eStatus'];
                $alldata[$key]['editlink'] = '<a href="' . $this->data['base_url'] . 'subdriver/update/' . $value['iParentDriverId'] . '/' . $value['iDriverId'] . '"><i class="fa fa-edit"></i></a>';
                $alldata[$key]['deletelink'] = '<a href="#delete-pop-up" class="fancybox-media" onclick="deletedriver(' . $value['iDriverId'] . ');"><i class="fa fa-trash-o"></i></a>';
            }
            $aData['aaData'] = $alldata;
        } else {
            $aData['aaData'] = '';
        }
        // echo "<pre>";print_r($aData['aaData']);exit;
        $json_lang = json_encode($aData);
        echo $json_lang;
        exit;
    }
    function checkValidEmail() {
        /* RECEIVE VALUE */
        $validateValue = $_REQUEST['fieldValue'];
        $validateId = $_REQUEST['fieldId'];
        //$checkEmailAddress=$this->sub_driver_model->checkEmailAddress($validateValue);
        $validateError = "Email address is already taken";
        $validateSuccess = "Email is available";
        /* RETURN VALUE */
        $arrayToJs = array();
        $arrayToJs[0] = $validateId;
        if (count($checkEmailAddress) == 0) { // validate??
            $arrayToJs[1] = true; // RETURN TRUE
            echo json_encode($arrayToJs); // RETURN ARRAY WITH success
            
        } else {
            for ($x = 0;$x < 1000000;$x++) {
                if ($x == 990000) {
                    $arrayToJs[1] = false;
                    echo json_encode($arrayToJs); // RETURN ARRAY WITH ERROR
                    
                }
            }
        }
    }
    function uploadDriverProfilePicture() {
        $iDriverId = $this->data['userdata']['ridein_front_info']['iDriverId'];
        $iParentDriverId = $this->data['userdata']['ridein_front_info']['iParentDriverId'];
        if ($iParentDriverId == 0) {
            if ($iDriverId != '') {
                define('IMAGEPATH', $this->data['base_path'] . 'uploads/driver/' . $iDriverId . '/');
                $licence = $this->driver_contact_model->get_licence_info($iDriverId);
                foreach (glob(IMAGEPATH . '*') as $filename) {
                    $imag[] = basename($filename);
                    $folder_image = basename($filename);
                    if ($folder_image != $licence['vDocument']) {
                        $var = unlink($this->data['base_path'] . "uploads/driver/" . $iDriverId . "/" . $folder_image);
                    }
                }
            }
            $file_array_name = $this->input->post('vProfileImage');
            $size = array();
            $size['width'] = '228';
            $size['height'] = '228';
            $image_uploaded = $this->do_upload_img($iDriverId, 'driver', 'vProfileImage', $size);
            if ($image_uploaded != '') {
                $data['vProfileImage'] = $image_uploaded;
                $updateProfileImage = $this->driver_contact_model->update($data, $iDriverId);
            }
        } else {
            if ($iDriverId != '') {
                define('IMAGEPATH', $this->data['base_path'] . 'uploads/subdriver/' . $iDriverId . '/');
                $licence = $this->driver_contact_model->get_licence_info($iDriverId);
                foreach (glob(IMAGEPATH . '*') as $filename) {
                    $imag[] = basename($filename);
                    $folder_image = basename($filename);
                    if ($folder_image != $licence['vDocument']) {
                        $var = unlink($this->data['base_path'] . "uploads/subdriver/" . $iDriverId . "/" . $folder_image);
                    }
                }
            }
            $file_array_name = $this->input->post('vProfileImage');
            $size = array();
            $size['width'] = '228';
            $size['height'] = '228';
            $image_uploaded = $this->do_upload_img($iDriverId, 'subdriver', 'vProfileImage', $size);
            if ($image_uploaded != '') {
                $data['vProfileImage'] = $image_uploaded;
                $updateProfileImage = $this->driver_contact_model->update($data, $iDriverId);
            }
        }
        echo $image_uploaded;
        exit;
    }
    function get_all_cities() {
        $iStateId = $this->input->get('iStateId');
        $cities = $this->driver_contact_model->get_all_cities($iStateId);
        $options = '';
        if (count($cities) > 0) {
            $options.= '<option value="">-- Select City--</option>';
            for ($i = 0;$i < count($cities);$i++) {
                $options.= '<option value="' . $cities[$i]['iCityId'] . '">' . $cities[$i]['vCity'] . '</option>';
            }
        } else {
            $options.= '<option value="">-- Select City--</option>';
        }
        $json_lang = json_encode($options);
        print $json_lang;
        exit;
    }
    function get_all_state() {
        $iCountryId = $this->input->get('iCountryId');
        $State = $this->driver_contact_model->get_allstates_bycountry($iCountryId);
        $options = '';
        if (count($State) > 0) {
            $options.= '<option value="">-- Select State--</option>';
            for ($i = 0;$i < count($State);$i++) {
                $options.= '<option value="' . $State[$i]['iStateId'] . '">' . $State[$i]['vState'] . '</option>';
            }
        } else {
            $options.= '<option value="">-- Select State--</option>';
        }
        $json_lang = json_encode($options);
        print $json_lang;
        exit;
    }
    function changepassword() {
        $iDriver = $this->session->userdata['ridein_front_info']['iDriverId'];
        $this->data['driver'] = $iDriver;
        if ($this->input->post('Data')) {
            $Data = $this->input->post('Data');
            $iDriverId = $this->session->userdata['ridein_front_info']['iDriverId'];
            $iClientId = $this->session->userdata['ridein_front_info']['iClientId'];
            $vPassword = encrypt($Data["vPassword"]);
            if ($iDriverId) {
                $driver['iDriverId'] = $iDriverId;
                $driver['vPassword'] = $vPassword;
                $iDriverId = $this->driver_contact_model->edit_driver($driver);
            } elseif ($iClientId) {
                $client['vPassword'] = $vPassword;
                $client['iClientId'] = $iClientId;
                $iClientId = $this->client_info_model->edit_client($client);
            }
            $this->session->set_flashdata('message', "Your password has been changed");
            redirect($this->data['base_url'] . 'change-password');
            exit;
        }
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['tpl_name'] = "changepwd.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('template.tpl');
    }
    function ajax_search_data() {
        $searchResult = $_REQUEST['vSearch'];
        $searchDate = explode(" ", $searchResult);
        $date = $searchDate[0];
        $getTrips = $this->driver_contact_model->searchTripDetailsbyDate($date);
        $this->data['TripTotRecord'] = $this->driver_contact_model->searchCountTripDetailsbyDate($date);
        $this->data['getTripDetails'] = $getTrips;
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('ajax_search_date.tpl');
    }
    function ajax_driver_trip_data() {
        $start = $this->uri->segment(3);
        $iDriverId = $this->uri->segment(4);
        $latestTrip = $this->driver_contact_model->getDriverLatestTripData($start, $iDriverId);
        /*echo "<pre>";print_r($latestTrip);exit();*/
        for ($i = 0;$i < count($latestTrip);$i++) {
            $TripDate = new DateTime($latestTrip[$i]['dTripDate']);
            $endDate = new DateTime($latestTrip[$i]['dRideEndDate']);
            $Trip = $TripDate->diff($endDate);
            if ($Trip->d) {
                $tmp['D'] = $Trip->d . ' D ';
            }
            if ($Trip->h) {
                $tmp['H'] = $Trip->h . ' H ';
            }
            if ($Trip->i) {
                $tmp['M'] = $Trip->i . ' M ';
            }
            if ($Trip->s) {
                $tmp['S'] = $Trip->s . ' S';
            }
            $latestTrip[$i]['duration'] = $tmp['D'] . $tmp['H'] . $tmp['M'] . $tmp['S'];
            $latestTrip[$i]['rider_name'] = $this->driver_contact_model->ridername($latestTrip[$i]['iClientId']);
            $latestTrip[$i]['fFinalPayment'] = $latestTrip[$i]['fFinalPayment'];
        }
        $this->data['getTripDetails'] = $latestTrip;
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('ajax_driver_pagination_dashboard_trip_data.tpl');
    }
    function decrypt_text($value) {
        if (!$value) return false;
        $crypttext = base64_decode($value);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, 'SECURE_STRING_1', $crypttext, MCRYPT_MODE_ECB, 'SECURE_STRING_2');
        return trim($decrypttext);
    }
}
?>