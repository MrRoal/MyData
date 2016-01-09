<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_Libraries extends CI_Controller {
	function __construct(){
		
    	parent::__construct();
    	$this->load->helper('cookie');	
        $this->load->library('session');
        $this->load->helper('date');
        $this->load->helper('url');
        $this->load->helper('common_func');
        
        $this->load->helper('global_variable');
        $this->load->database();
        $this->load->library('curl');
        $this->load->library('email');
        $this->load->helper('file');
        $this->load->library('encrypt');
        $this->load->library('upload'); 
        $this->load->library('image_lib'); //load library
        $this->load->model('common_model');
	   
        getGeneralVar();
        $this->data=$GLOBALS['Configration_value'];		
        $this->data['base_CK']  = $this->config->item('base_CK');
        $this->data['fancy']  = $this->config->item('front_fancybox');
        $this->data['timepicker']  = $this->config->item('front_timepicker');
        $this->data['base_upload']  = $this->config->item('base_upload');
        $this->data['base_path']    = $this->config->item('base_path');
        $this->data['base_lib']     = $this->config->item('base_lib');
        $this->data['userdata'] = $this->session->all_userdata();
	    $this->data['url_name'] = $this->uri->segment(2, 0);
	    $this->data['base_url']     = $this->config->item('base_url');
    }

	// USE FOR Send Mail	
	// USE FOR Send Mail	
	function Send($EmailCode,$vEmail,$bodyArr,$postArr){
		$email_info = $this->common_model->list_sysemaildata($EmailCode)->result(); 
		$Subject = strtr($email_info[0]->vEmailSubject, "\r\n" , "  " );
        $body =stripslashes($email_info[0]->tEmailMessage);
        $vFromName = $email_info[0]->vFromName;
        $body = str_replace($bodyArr,$postArr, $body);
        require_once 'PHPMailer-master/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;       
        $mail->SMTPDebug = 0;                               // Enable SMTP authentication
        $mail->Username = 'demo1.testing1@gmail.com';       // SMTP username
        $mail->Password = 'demo1234'; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Port = 587;                                  // TCP port to connect to
        $mail->From = 'demo1.testing1@gmail.com';
        $mail->FromName = 'Happy Hour';
        $mail->addAddress($vEmail);                          // Add a recipient
        
        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $Subject;
        $mail->Body    = $body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        if(!$mail->send()) {
            $res = 0;
        } else {
            $res = 1;
        }
        return $res;
		 
	}
	
	// generate uniq url text.
	function seo_urltext($sURL,$tot){
		$sURL = strtolower($sURL);
		$sURL = preg_replace("/\W+/", " ", $sURL);
		$sURL = trim($sURL);
		$sURL = str_replace(" ", "-", $sURL);
		return $sURL."-".$tot;
	}
	
	//remove extra spaces and special characters.
	function seo_url($sURL) {
		$sURL = strtolower($sURL);
		$sURL = preg_replace("/\W+/", " ", $sURL);
		$sURL = trim($sURL);
		$sURL = str_replace(" ", "-", $sURL);
		return $sURL;
	}
	
	function rand_number(){
		$rnd1 = rand(0,99);
		return $rnd1 ;
	}


	// USE FOR UPLOAD IMAGES
	function do_upload_img($folderId,$folder,$image,$size){	

	
		if(!is_dir('uploads/'.$folder.'/')){
			@mkdir('uploads/'.$folder.'/', 0777);
		}
		if(!is_dir('uploads/'.$folder.'/'.$folderId)){
			@mkdir('uploads/'.$folder.'/'.$folderId, 0777);
		}
		
		$img=$this->data['base_path'].'uploads/'.$folder.'/'.$folderId.'/'.$_FILES[$image]['name'];		
		
		if (file_exists($img)) {			
			$rnd1=$this->rand_number();			
			$name='copy_'.$rnd1.$_FILES[$image]['name'];
			/*$file_name=str_replace(' ','_',$name);*/
			$file_name=preg_replace("/[^.A-Za-z0-9\-]/", "_",$name);
		} else {
			$file_name=preg_replace("/[^.A-Za-z0-9\-]/", "_",$_FILES[$image]['name']);
			/*$file_name=str_replace(' ','_',$_FILES[$image]['name']);*/			
		}
		
		$config = array(
			'allowed_types' => 'JPG|jpg|JPEG|jpeg|',
			'upload_path' => 'uploads/'.$folder.'/'.$folderId,
			'file_name' => str_replace(' ','',$file_name),
			'max_size'=>0
			/*'max_size'=>5380334*/
		);
		
		$this->load->library('Upload', $config);          
		$this->upload->initialize($config);
		$this->upload->do_upload($image); //do upload
		$image_data = $this->upload->data(); //get icon data		
		if($size){
			$name='uploads/'.$folder.'/'.$folderId.'/'.$size['width'].'X'.$size['height'].'_'.$image_data['file_name'];
			$config1 = array(
			  'source_image' => $image_data['full_path'], //get original image			
			  'new_image' => $name, //save as new image //need to create thumbs first
			  'maintain_ratio' => false,
			  'width' => $size['width'],
			  'height' => $size['height']
			);		
		}		
		$this->load->library('image_lib', $config1); //load library
		$this->image_lib->initialize($config1);
		$test1 = $this->image_lib->resize(); //do whatever specified in config		
		$image_data = $this->upload->data(); //get image data
		
		if($size['height2']!='' && $size['width2']!=''){
			$name2='uploads/'.$folder.'/'.$folderId.'/'.$size['width2'].'X'.$size['height2'].'_'.$image_data['file_name'];
			$config2 = array(
			  'source_image' => $image_data['full_path'], //get original image			  
			  'new_image' => $name2, //save as new image //need to create thumbs first
			  'maintain_ratio' => false,
			  'width' => $size['width2'],
			  'height' => $size['height2']
			);
			
			
			
		}
		$this->load->library('image_lib', $config2); //load library
		$this->image_lib->initialize($config2);
		$test1 = $this->image_lib->resize(); //do whatever specified in config		
		$image_data = $this->upload->data(); //get image data
		
		
		if($size['height3']!='' && $size['width3']!=''){
			$name3='uploads/'.$folder.'/'.$folderId.'/'.$size['width3'].'X'.$size['height3'].'_'.$image_data['file_name'];
			$config3 = array(
			  'source_image' => $image_data['full_path'], //get original image			 
			  'new_image' => $name3, //save as new image //need to create thumbs first
			  'maintain_ratio' => false,
			  'width' => $size['width3'],
			  'height' => $size['height3']
			);	
		}
		$this->load->library('image_lib', $config3); //load library
		$this->image_lib->initialize($config3);
		$test1 = $this->image_lib->resize(); //do whatever specified in config		
		$image_data = $this->upload->data(); //get image data
		if($size['height4']!='' && $size['width4']!=''){
			$name4='uploads/'.$folder.'/'.$folderId.'/'.$size['width4'].'X'.$size['height4'].'_'.$image_data['file_name'];
			$config4 = array(
			  'source_image' => $image_data['full_path'], //get original image
			  //'new_image' => 'uploads/'.$folder.'/'.$folderId.'/267x175_'.$image_data['file_name'], //save as new image //need to create thumbs first
			  'new_image' => $name4, //save as new image //need to create thumbs first
			  'maintain_ratio' => false,
			  'width' => $size['width4'],
			  'height' => $size['height4']
			);	
		}
		$this->load->library('image_lib', $config4); //load library
		$this->image_lib->initialize($config4);
		$test1 = $this->image_lib->resize(); //do whatever specified in config		
		$image_data = $this->upload->data(); //get image data		
		/*echo "<pre>";print_r($image_data);exit;*/
		$img_uploaded = $image_data['file_name'];          
		return $img_uploaded;
		
	}

	function do_upload_song($folderId,$folder,$image){
		if(!is_dir('uploads/'.$folder.'/')){
			@mkdir('uploads/'.$folder.'/', 0777);
		}
		if(!is_dir('uploads/'.$folder.'/'.$folderId)){
			@mkdir('uploads/'.$folder.'/'.$folderId, 0777);
		}
		
		$img=$this->data['base_path'].'uploads/'.$folder.'/'.$folderId.'/'.mysql_real_escape_string($_FILES[$image]['name']);
		if (file_exists($img)) {	
			$name='copy_'.$rnd1.mysql_real_escape_string($_FILES[$image]['name']);
			$file_name=str_replace(' ','_',$name);
			} else {
			$name = mysql_real_escape_string($_FILES[$image]['name']);
			$file_name=str_replace(' ','_',$name);			
		}
			
		$config = array(
			'allowed_types' => 'mp3|wav',
			'upload_path' => 'uploads/'.$folder.'/'.$folderId,
			'file_name' => str_replace(' ','',$file_name),
			/*'max_size'=>'0'*/
		);
		$this->load->library('Upload', $config);          
		$this->upload->initialize($config);
		$this->upload->do_upload($image); //do upload
		$image_data = $this->upload->data(); //get icon data		
		
		$img_uploaded = $image_data['file_name'];          
		return $img_uploaded;
		
	}


	function do_upload_doc($folderId,$folder,$image,$size){	

		/*echo $folderId."<br>".$folder."<br>".$image;exit;*/
		if(!is_dir('uploads/'.$folder.'/')){
			@mkdir('uploads/'.$folder.'/', 0777);
		}
		if(!is_dir('uploads/'.$folder.'/'.$folderId)){
			@mkdir('uploads/'.$folder.'/'.$folderId, 0777);
		}
		
		$img=$this->data['base_path'].'uploads/'.$folder.'/'.$folderId.'/'.$_FILES[$image]['name'];		
		if (file_exists($img)) {			
			$rnd1=$this->rand_number();			
			$name='copy_'.$rnd1.$_FILES[$image]['name'];
			$file_name=str_replace(' ','_',$name);
		} else {
			$file_name=str_replace(' ','_',$_FILES[$image]['name']);			
		}
		
		$config = array(
			'allowed_types' => '*',
			'upload_path' => 'uploads/'.$folder.'/'.$folderId,
			'file_name' => str_replace(' ','',$file_name),
			'max_size'=>5380334
		);
		
		$this->load->library('Upload', $config);          
		$this->upload->initialize($config);
		$this->upload->do_upload($image); //do upload
		$image_data = $this->upload->data(); //get icon data		
		if($size){
			$name='uploads/'.$folder.'/'.$folderId.'/'.$size['width'].'X'.$size['height'].'_'.$image_data['file_name'];
			$config1 = array(
			  'source_image' => $image_data['full_path'], //get original image			
			  'new_image' => $name, //save as new image //need to create thumbs first
			  'maintain_ratio' => false,
			  'width' => $size['width'],
			  'height' => $size['height']
			);		
		}		
		$this->load->library('image_lib', $config1); //load library
		$this->image_lib->initialize($config1);
		$test1 = $this->image_lib->resize(); //do whatever specified in config		
		$image_data = $this->upload->data(); //get image data
		
		if($size['height2']!='' && $size['width2']!=''){
			$name2='uploads/'.$folder.'/'.$folderId.'/'.$size['width2'].'X'.$size['height2'].'_'.$image_data['file_name'];
			$config2 = array(
			  'source_image' => $image_data['full_path'], //get original image			  
			  'new_image' => $name2, //save as new image //need to create thumbs first
			  'maintain_ratio' => false,
			  'width' => $size['width2'],
			  'height' => $size['height2']
			);
			
			
			
		}
		$this->load->library('image_lib', $config2); //load library
		$this->image_lib->initialize($config2);
		$test1 = $this->image_lib->resize(); //do whatever specified in config		
		$image_data = $this->upload->data(); //get image data
		
		
		if($size['height3']!='' && $size['width3']!=''){
			$name3='uploads/'.$folder.'/'.$folderId.'/'.$size['width3'].'X'.$size['height3'].'_'.$image_data['file_name'];
			$config3 = array(
			  'source_image' => $image_data['full_path'], //get original image			 
			  'new_image' => $name3, //save as new image //need to create thumbs first
			  'maintain_ratio' => false,
			  'width' => $size['width3'],
			  'height' => $size['height3']
			);	
		}
		$this->load->library('image_lib', $config3); //load library
		$this->image_lib->initialize($config3);
		$test1 = $this->image_lib->resize(); //do whatever specified in config		
		$image_data = $this->upload->data(); //get image data
		if($size['height4']!='' && $size['width4']!=''){
			$name4='uploads/'.$folder.'/'.$folderId.'/'.$size['width4'].'X'.$size['height4'].'_'.$image_data['file_name'];
			$config4 = array(
			  'source_image' => $image_data['full_path'], //get original image
			  //'new_image' => 'uploads/'.$folder.'/'.$folderId.'/267x175_'.$image_data['file_name'], //save as new image //need to create thumbs first
			  'new_image' => $name4, //save as new image //need to create thumbs first
			  'maintain_ratio' => false,
			  'width' => $size['width4'],
			  'height' => $size['height4']
			);	
		}
		$this->load->library('image_lib', $config4); //load library
		$this->image_lib->initialize($config4);
		$test1 = $this->image_lib->resize(); //do whatever specified in config		
		$image_data = $this->upload->data(); //get image data		
		
		$img_uploaded = $image_data['file_name'];          
		return $img_uploaded;
		
	}

	//USE FOR DELETE UPLOADED IMAGES
	function delete_image($tableData){
		
        $upload_path =$this->data['base_path'];
        $data= $this->common_model->get_category_details($tableData['field_id'],$tableData);

        $var=unlink($upload_path.'uploads/'.$tableData['folder_name'].'/'.$tableData['field_id'].'/'.$data[$tableData['image_field']]);
	
	   $crop_image=$tableData['crop_image'];
	   
	   if(count($crop_image)>0){
		foreach($crop_image as $value){
		  if($value!=''){			
			  $delete_cropimage=unlink($upload_path.'uploads/'.$tableData['folder_name'].'/'.$tableData['field_id'].'/'.$value.$data[$tableData['image_field']]);
		  }
		}
	   }	   
        $var1 = $this->common_model->delete_image($tableData);
        return  $var1;      
    }


    function delete_doc($tableData){
		//echo "<pre>";print_r($tableData);exit;
        $upload_path =$this->data['base_path'];
        $data= $this->common_model->get_category_details($tableData['field_id'],$tableData);
        $var=unlink($upload_path.'uploads/'.$tableData['folder_name'].'/'.$tableData['subdriver_id'].'/'.$data[$tableData['image_field']]);
	
	   $crop_image=$tableData['crop_image'];
	   if(count($crop_image)>0){
		foreach($crop_image as $value){
		  if($value!=''){			
			  $delete_cropimage=unlink($upload_path.'uploads/'.$tableData['folder_name'].'/'.$tableData['subdriver_id'].'/'.$value.$data[$tableData['image_field']]);
		  }
		}
	   }	   
        $var1 = $this->common_model->delete_image($tableData);
        return  $var1;      
    }

    
    //update status.
    
    function update_status($ids,$action,$tableData){
    	switch($this->input->post('action')){
			case "Inactive":
			case "Active":
			case "Approve":
			case "Rejected":		
				$iId = $this->common_model->get_update_all($ids,$action,$tableData);  								                                       
				return $iId;                    
				break;
			case "Delete":		            
				$upload_path =$this->data['base_path'];	
				
				foreach ($ids as $row){		            	
				   $data= $this->common_model->get_category_details($row,$tableData);	
				   $url=$upload_path.'uploads/'.$tableData['folder_name'].'/'.$row.'/';
				    array_map('unlink',glob($url."/*"));
				   /*unlink($upload_path.'uploads/'.$tableData['folder_name'].'/'.$row.'/'.$data[$tableData['image_field']]);
				   unlink($upload_path.'uploads/'.$tableData['folder_name'].'/'.$row.'/'.'228*228_'.$data[$tableData['image_field']]);*/
				   rmdir($upload_path.'uploads/'.$tableData['folder_name'].'/'.$row);
				}

				$iId = $this->common_model->delete_record($ids,$tableData);
				//echo $iId;exit;
				return $iId;                    
				break;
        }
    }

    function encrypt($data){
		for($i = 0, $key = 27, $c = 48; $i <= 255; $i++){
			$c = 255 & ($key ^ ($c << 1));
			$table[$key] = $c;
			$key = 255 & ($key + 1);
		}
		$len = strlen($data);
		for($i = 0; $i < $len; $i++){
			$data[$i] = chr($table[ord($data[$i])]);
		}
		return base64_encode($data);
	}
	
	function decrypt($data){
		$data = base64_decode($data);
		for($i = 0, $key = 27, $c = 48; $i <= 255; $i++){
			$c = 255 & ($key ^ ($c << 1));
			$table[$c] = $key;
			$key = 255 & ($key + 1);
		}
		$len = strlen($data);
		for($i = 0; $i < $len; $i++){
			$data[$i] = chr($table[ord($data[$i])]);
		}		
		return $data;
	}
}
 

// Use common controller in front side
class Front_Controller extends Common_Libraries{
	function __construct(){
		parent::__construct();
    	$this->load->library('Breadcrumb');
		$this->data['base_url']     = $this->config->item('base_url');
		$this->data['base_bootstrap']=$this->data['base_url']."assets/bootstrap/";
        $this->data['front_js']     = $this->config->item('front_js');
        $this->data['front_css']    = $this->config->item('front_css');
        $this->data['front_slick']    = $this->config->item('front_slick');
        $this->data['front_image']  = $this->config->item('front_image');
        $this->data['url_name']     = $this->uri->segment(1, 0);
        /*getstaticpages();
        $this->data['Static_Page']=$GLOBALS['Staticpage_value'];
        $this->data['cities']=$this->common_model->getcity();
        $this->data['slider']=$this->common_model->getslider();*/
        
        $this->data['happyhour_front_info']=$this->session->userdata['happyhour_front_info'];
        if($this->data['happyhour_front_info']['iDriverId'] == '' && $this->data['happyhour_front_info']['iCompanyId'] == ''){
        	 $this->data['driverdetail']['vPassword']=$this->decrypt($this->data['driverdetail']['vPassword']);
        }
        else{
        	$this->data['driverdetail']['vPassword']=$this->decrypt($this->data['driverdetail']['vPassword']);
        }
        $this->smarty->assign('data', $this->data); 
    }
    
    function yearDropdown($startYear, $endYear,$id="month"){ 
          $opt = "";  
          for ($i=$startYear;$i<=$endYear;$i++){ 
          	$opt .= "<option value=".$i.">".$i."</option>n";     
          } 
        return $opt;
    }

    function monthDropdown(){ 
    	$opt = ""; 
       for( $i = 1; $i <= 12; $i++ ) {
            $month_num = date( 'm', mktime( 0, 0, 0, $i + 1, 0, 0, 0 ) );
            $month_name = date( 'F', mktime( 0, 0, 0, $i + 1, 0, 0, 0 ) );
            $month_options .= '<option value="' .$month_num. '">' . $month_name . '</option>';
        }
    	return $month_options; 
    }
    
    function currency_format($text,$parameter=2,$defCurrency='$'){
        
        if($text==0) return '00.00'; else
        return (($defCurrency) ? $defCurrency . '' : '') . number_format($text,$parameter,'.',',');
    }
    
    public function currency_format_smarty($text,$parameter=2,$defCurrency='$'){        
        if($text==0) return '00.00'; else
        echo  (($defCurrency) ? $defCurrency . '' : '') . number_format($text,$parameter,'.',',');
    }

    function printdata($value){
    	echo "<pre>";print_r($value);exit;
    }		
}


// Use common controller in admin side
class Admin_Controller extends Common_Libraries {
 	function __construct(){
		parent::__construct();
		$this->load->library('Breadcrumb');
		$this->data['admin_url']= $this->config->item('admin_url');     
		$this->data['admin_css_path']=$this->config->item('admin_css_path');        
		$this->data['admin_image_path']=$this->config->item('admin_image_path');
		$this->data['admin_js_path']=$this->config->item('admin_js_path');
		$this->data['admin_fonts']=$this->config->item('admin_fonts');
		$this->data['base_image'] = $this->config->item('base_image');
		$this->data['admin_boostrap']=$this->config->item('admin_boostrap');
		$this->data['happyhour_admin_info']=$this->session->userdata['happyhour_admin_info'];
		$this->data['admin_base_url']= $this->config->item('base_url');
		$this->data['admindetail'] = $this->common_model->get_admin_details($this->data['happyhour_admin_info']['iAdminId'],'');

		/* Admin Module Permission*/
		/* Get Module*/
		if($this->data['happyhour_admin_info']['eRole'] == 'Subadmin'){
			$leftsidebar = $this->common_model->getleftbar();
			foreach ($leftsidebar as $key => $value) {
				$leftsidebar[$key]['submodule'] = $this->getsubmodule($value['iModuleId']);
			}
			$this->data['leftsidebar']=$leftsidebar;
		   
		    if($this->data['happyhour_admin_info']['eRole'] == 'Subadmin'){
		    	$admindetail = $this->common_model->get_adminper_details($this->data['happyhour_admin_info']['iAdminId'],'Subadmin');

				$admindetail['tListing'] = explode(",",$admindetail['tListing']);
				$admindetail['tAdd'] = explode(",",$admindetail['tAdd']);
				$admindetail['tUpdate'] = explode(",",$admindetail['tUpdate']);
				$admindetail['tDelete'] = explode(",",$admindetail['tDelete']);
				$admindetail['tActive'] = explode(",",$admindetail['tActive']);
				$admindetail['tInactive'] = explode(",",$admindetail['tInactive']);

				$admindetail['tExportMerchant'] = explode(",",$admindetail['tExportMerchant']);
				$admindetail['tExportUsers'] = explode(",",$admindetail['tExportUsers']);
				$admindetail['tSendPushnotification'] = explode(",",$admindetail['tSendPushnotification']);

				for($i=0;$i<count($admindetail['tListing']);$i++){
					$list[$i]=$this->common_model->getparentid($admindetail['tListing'][$i]);
				}
				if($admindetail['iAccessId'] != ''){
					$admindetail['tListing']=array_unique(array_merge($list,$admindetail['tListing']));
				}
				$this->data['adminpermidetail']=$admindetail;
		    }else{
		    	$admindetail = $this->common_model->get_adminper_details($this->data['happyhour_admin_info']['iAdminId'],'Subadmin');
		    }

		    if($this->uri->segment(2) == ''){
				$this->data['url']='home';
			}
			else{
				$this->data['url']=$this->uri->segment(2);
			}
			$modulearray = $this->common_model->getmoduleid($this->data['url']);
			$this->data['checkmoduleid'] = $modulearray['iModuleId'];
			$this->data['iParentId']=$modulearray['iParentId'];

		}
		/* End of Admin Module Permission*/

		$this->smarty->assign('data', $this->data);
		//$this->smarty->assign('mycontobj', $this);
	}

	/* Not delete This function*/
	public function getsubmodule($iModuleId){
		return $this->common_model->getmodulename($iModuleId);
	}
	
	function currency_format_admin($text,$parameter=2,$defCurrency='$'){
        
		if($text==0) return '00.00'; else
			return (($defCurrency) ? $defCurrency . '' : '') . number_format($text,$parameter,'.',',');
	}
    
	public function currency_format_smarty_admin($text,$parameter=2,$defCurrency='$'){        
		if($text==0) return '00.00'; else
		echo  (($defCurrency) ? $defCurrency . '' : '') . number_format($text,$parameter,'.',',');
	}
}
?>