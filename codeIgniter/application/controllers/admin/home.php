<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class home extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/home_model', '', TRUE);
      
        if (!isset($this->session->userdata['happyhour_admin_info'])) {
            redirect($this->data['admin_url'] . 'authentication');
            exit;
        }
        $this->smarty->assign("data", $this->data);
    }
    //load dashboard
    function index() {
        $this->data['menuAction'] = 'Dashboard';
        $bookBar = $this->home_model->todayBarReservation();
        //echo "<pre>";print_r($bookBar);exit;
        $this->data['todayBookBar'] = $bookBar;
        $this->data['countOfUsers'] = $this->home_model->totalRegisterUsers();
        $newUsers = $this->home_model->today_signup_user();
        /*echo "<pre>";
        print_r($newUsers);exit;*/
        $this->data['signupUsers'] = $newUsers;
        $this->data['paging_message'] = 'No Records Found';
        $this->data['happyhour_admin_info'] = $this->session->userdata['happyhour_admin_info'];
        $this->data['tpl_name'] = "admin/home/homes.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
    }

    function changepassword() {
        $this->breadcrumb->add('Dashboard', $this->data['admin_url']);
        $this->breadcrumb->add('Change Password', '');
        $this->data['breadcrumb'] = $this->breadcrumb->output();
        $this->data['happyhour_admin_info'] = $this->session->userdata['happyhour_admin_info'];
        $this->data['tpl_name'] = "admin/home/changepassword.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('admin/admin-template.tpl');
        if ($this->input->post('vPassword')) {
            $new_password = $this->input->post('vPassword');
            $user['vPassword'] = encrypt($this->input->post('vPassword'));
            $user['iAdminId'] = $this->data['happyhour_admin_info']['iAdminId'];
            $this->home_model->change_password($user);
            
            redirect($this->data['admin_url']);
        }
    }

    function vehicle_infomation() {
        $getDriverDetails = $this->home_model->get_vehicle_details();

        foreach ($getDriverDetails as $key => $value) {
            $getDriverDetails[$key]['model_image_url'] = $this->data['base_upload'] . 'car_model/' . $value['iModelId'] . '/' . $value['vModelimage'];
        }
        $json_lang = json_encode($getDriverDetails);
        echo $json_lang;
        exit;
    }
}
/* End of file home.php */
/* Location: ./application/controllers/home.php */