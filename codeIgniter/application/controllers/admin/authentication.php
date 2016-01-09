<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/authentication_model', '', TRUE);
        $this->smarty->assign("data", $this->data);
        $this->smarty->assign("Name", "Welcome To Happy Hour Admin Panel");
    }
    // check authentication
    public function index() {
        $this->data['message'] = $this->session->flashdata('message');
        if (isset($this->session->userdata['happyhour_admin_info'])) {
            redirect($this->data['base_url'] . 'admin/home');
        } else if ($this->input->post()) {
            $vEmail = $this->input->post('vEmail');
            $vPassword = $this->encrypt($this->input->post('vPassword'));
            $auth_exists = $this->authentication_model->check_auth($vEmail, $vPassword);
            if ($auth_exists) {
                $auth_exists['logged_in'] = TRUE;
                $datestring = "%Y-%m-%d  %h:%i:%s";
                $time = time();
                $dLoginDate = mdate($datestring, $time);
                $logindata['iAdminId'] = $auth_exists['iAdminId'];
                $logindata['vFirstName'] = $auth_exists['vFirstName'];
                $logindata['vLastName'] = $auth_exists['vLastName'];
                $logindata['vEmail'] = $auth_exists['vEmail'];
                $logindata['vIP'] = $this->input->ip_address();
                $logindata['dLoginDate'] = $dLoginDate;
                $auth_exists['iLoginLogId'] = $iLoginLogId;
                $this->session->set_userdata('happyhour_admin_info', $auth_exists);
                redirect($this->data['admin_url']);
                // echo "123<pre>";print_r($this->data['admin_url']);exit();
                exit;
            } else {
                $this->session->set_flashdata('message', "Sorry! Email Id or Password seems to be wrong!");
                redirect($this->data['admin_url'] . 'authentication');
                exit;
            }
        } else {
            $this->data['tpl_name'] = "admin/login.tpl";
            $this->smarty->assign('data', $this->data);
            $this->smarty->view('admin/login.tpl');
        }
    }

    // forgot passward
    function forgotpassword() {
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['tpl_name'] = "admin/forgotpassword.tpl";
        if ($this->input->post()) {
        
            $vEmail = $this->input->post('vEmail');
            if ($vEmail) {
                $check_admin_email = $this->authentication_model->getAdminRecord($vEmail);
                /*$check_user_email = $this->authentication_model->getUserRecord($vEmail);*/

                if ($check_admin_email['iAdminId']!='') {
                    $vActivationCode = random_string('alnum',10);
                    $forgotdata['vPassword'] = $this->encrypt($vActivationCode);
                    $forgotdata['vEmail'] = $checkemail['vEmail'];
                    //$iUserId = $this->authentication_model->updatecode($forgotdata);

                    $this->session->set_flashdata('message',' Email ID does exist');
                    $this->smarty->assign('data', $this->data);
                    redirect($this->data['admin_url'] . 'authentication/forgotpassword');
                    exit;
                }else{
                    $this->session->set_flashdata('message','Sorry, Email ID does not exist');
                    $this->smarty->assign('data', $this->data);
                    redirect($this->data['admin_url'] . 'authentication/forgotpassword');
                    exit;
                }
            }else{
                $this->session->set_flashdata('message','Please Enter valid Email ID.');
                $this->smarty->assign('data', $this->data);
                redirect($this->data['admin_url'] . 'authentication/forgotpassword');
                exit;
            }

                
        }
       
        $this->data['path'] = $this->config->item('base_url');
       
        $this->data['message'] = $this->session->flashdata('message');
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/forgotpassword.tpl');     
    }

    // check email of admin fogot passward ans mail to admin
    function checkemail() {
        if ($this->input->post()) {
            $fpass = $this->input->post();
            $emailid = $fpass['vEmail'];
            $getadminDetail = $this->client_model->checkadmin_mail($emailid);
            if (count($getadminDetail) > 0) {
                $vActivationCode = random_string('alnum', 10);
                $forgotdata['vPassword'] = $this->encrypt($vActivationCode);
                $forgotdata['vEmail'] = $getadminDetail['vEmail'];
                $iUserId = $this->client_model->updatecode($forgotdata);
                //$getadminDetail['vPassword']=$this->decrypt($getadminDetail['vPassword']);
                $name1 = $getadminDetail['vFirstName'] . ' ' . $getadminDetail['vLastName'];
                $name = ucfirst($name1);
                $siteurl = $this->config->item('base_url');
                $MailFooter = $this->data['MAIL_FOOTER'];
                $siteName = 'Ride In';
                $this->data['COMPANY_NAME'] = 'Ride In';
                $link = $siteurl . 'admin/authentication';
                //echo '<pre>';print_r($link);exit;
                if ($_SERVER["HTTP_HOST"] == 'ridein.ca') {
                    $baseurl = 'http://ridein.ca';
                } else {
                    $baseurl = 'http://quicknetlimo.com';
                }
                $image_url = $baseurl;
                $bodyArr = array("#NAME#", "#PASSWORD#", "#EMAIL#", "#SITEURL#", "#MAILFOOTER#", "#LINK#", "#SITE_NAME#", "#IMAGE_URL#");
                $postArr = array($name, $vActivationCode, $forgotdata['vEmail'], $siteurl, $MailFooter, $link, $siteName, $image_url);
                $sendAdmin = $this->Send("FORGOTPASSWORD", "Admin", $forgotdata['vEmail'], $bodyArr, $postArr);
                $this->session->set_flashdata('message', "We have sent you a New Password Kindly check your Email ID!");
                redirect($this->data['admin_url'] . 'authentication');
                exit;
            } else {
                $this->session->set_flashdata('message', "Please Enter Valid Email ID");
                redirect($this->data['admin_url'] . 'authentication/forgotpassword');
                exit;
            }
        } else {
            $this->session->set_flashdata('message', "Please Enter Valid Email ID !");
            redirect($this->data['admin_url'] . 'authentication');
            exit;
        }
    }
    
    //destroy session data and redirect to login page.
    function logout() {
        $datestring = "%Y-%m-%d  %h:%i:%s";
        $time = time();
        $dLogoutDate = mdate($datestring, $time);
        $logindata['iLoginLogId'] = $this->data['happyhour_admin_info']['iLoginLogId'];
        $logindata['dLogoutDate'] = $dLogoutDate;
        $this->session->unset_userdata("happyhour_admin_info");
        redirect($this->data['admin_url'] . 'authentication');
        exit();
    }
}
/* End of file authentication.php */
/* Location: ./application/controllers/authentication.php */
?>