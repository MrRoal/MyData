<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Front_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('common_model', '', TRUE);
	}
	//use for display home template
	function index() {
		$this->data['ActiveClass'] = 'HomeActive';
		$imgpath = $this->data['base_upload'];
		$this->data['tpl_name'] = "home.tpl";
		
		$this->smarty->assign('data', $this->data);
		$this->smarty->assign('imgpath', $imgpath);
		$this->smarty->view('template.tpl');
	}

	function reset_password(){
		$hashcode = $this->uri->segment(3);
		$userId = $this->common_model->getUserIdByHashCode($hashcode);
		
		$iUserId = $userId['iUserId'];

		$this->data['ActiveClass'] = 'HomeActive';
		$imgpath = $this->data['base_upload'];

		if ($this->input->post()) {
			$resetPassword = $this->input->post();
			$user['iUserId'] = $this->input->post('iUserId');
			$user['vPassword'] = encrypt($this->input->post('vPassword'));

			$iUserId = $this->common_model->editResetPassword($user);

			$this->session->set_flashdata('message', "Password Reset successfully");
            redirect($this->data['base_url'].'home/thankyou');
            exit;
		}

		$this->data['tpl_name'] = "changepassword.tpl";
		
		$this->smarty->assign('data', $this->data);
		$this->smarty->assign('iUserId', $iUserId);
		$this->smarty->assign('imgpath', $imgpath);
		$this->smarty->view('template.tpl');
	}

	function contact_us(){
		$vFirstName = $_REQUEST['vFirstName'];
		$vLastName = $_REQUEST['vLastName'];
		$vEmail = $_REQUEST['vEmail'];
        $iMobileNo = $_REQUEST['iMobileNo'];
        $tMassage = $_REQUEST['tMassage'];

        if($_SERVER["HTTP_HOST"] == '192.168.1.170'){
            $baseurl = $this->data['base_url'];
        }else {
            $baseurl = $this->data['base_url'];
        }
        $adminEmail = $this->data['EMAIL_ADMIN'];
        $image = $baseurl.'/assets/logo.png';
        
        $bodyArr = array("#FIRSTNAME#","#LASTNAME#","#EMAIL#","#MOBILE#","#MESSAGE#","#IMAGE_URL#");
        $postArr = array($vFirstName,$vLastName,$vEmail,$iMobileNo,$tMassage,$image);

        $sendmailjourney = $this->Send("CONTACTUS",$adminEmail,$bodyArr,$postArr);

        if ($sendmailjourney>0) {
        	$data['vFirstName'] = $vFirstName;
			$data['vLastName'] = $vLastName;
			$data['vEmail'] = $vEmail;
			$data['iMobileNo'] = $iMobileNo;
			$data['tMassage'] = $tMassage;
			$data['dAddedDate']	= date('Y-m-d h:i:s');

			$contact = $this->common_model->saveContactUs($data);
			redirect($this->data['base_url'].'home');
		}   
	}

	function thankyou(){
		$hashcode = $this->uri->segment(3);
		$userId = $this->common_model->getUserIdByHashCode($hashcode);
		
		$iUserId = $userId['iUserId'];

		$this->data['ActiveClass'] = 'HomeActive';
		$imgpath = $this->data['base_upload'];

		$this->data['tpl_name'] = "thankyou.tpl";
		
		$this->smarty->assign('data', $this->data);
		$this->smarty->view('template.tpl');
	}
}
?>