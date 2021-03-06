<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	private $table = 'tbl_content';
	private $pageName = 'register';
	private $requireFieldName = 'pageName';
	private $title = '';
	private $metaTags = '';
	private $details = '';
	private $keywords = '';
	private $heading = '';
	private $current_date = '';
	private $current_time = '';
	function __construct(){
		
		parent::__construct();
		
		$ContentData = $this->general_model->getAllDataSingleArgument($this->pageName, $this->requireFieldName, $this->table, '', '', 'ID', 'ASC');
		if((bool)($ContentData) != '0'){
			foreach($ContentData->result() as $DATA){
				$this->heading = $DATA->title;
				if($DATA->title != ''){ $this->title = ' :: '.$DATA->title;}
				$this->metaTags = $DATA->metaTags;
				$this->keywords = $DATA->keywords;
				$this->details = $DATA->details;				
			}
		}
		$this->current_date = getCurrentDate();
		$this->current_time = getCurrentTime();
	}
	
	public function index(){
		$data['title'] = $this->project_model->projectName().$this->title;
		$data['meta_tags'] = $this->metaTags;		
		$data['keywords'] = $this->keywords;
		$data['details'] = $this->details;		
		$data['page_name'] = $this->pageName;
		$data['heading'] = $this->heading;
		
		$data['agentType'] = filter_value('agentType' ,'');
		$data['name'] = filter_value('name' ,'');
		$data['userName'] = filter_value('userName' ,'');
		$data['password'] = filter_value('password' ,'');
		$data['Cpassword'] = filter_value('Cpassword' ,'');
		$data['email'] = filter_value('email' ,'');
		$data['address'] = filter_value('address' ,'');
		$data['city'] = filter_value('city' ,82);
		$data['country'] = filter_value('country' ,102);
		$data['phone'] = filter_value('phone' ,'');
		$data['website'] = filter_value('website', '');
		$data['userfile'] = filter_value('userfile' ,'');
		$data['countries'] = $this->general_model->listCountries($data['country']);
		$data['cities'] = $this->general_model->listCities($data['country'], $data['city']);
		$data['Message'] = '';
		
		$this->form_validation->set_rules('name', 'Agent Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[12]');
		$this->form_validation->set_rules('Cpassword','Password confirmation','required|min_length[4]|max_length[12]|matches[password]');
		
		if($this->form_validation->run() === TRUE){
			$data['Message'] = message('User with this <font color="#666666">('.$data['email'].')</font> Email already exists!', 'error');
			$valid_upload = true;
			$image_name = '';
			if(!empty($_FILES['userfile']['name'])){
				initializeImageSettings();
				if ($this->upload->do_upload()){
					$img_data = array($this->upload->data());
					$image_name = $img_data[0]['file_name'];
					resize_image($image_name, 'medium', 577, 577);
					resize_image($image_name, 'thumbs', 60, 60);
				}
				else{
					$valid_upload = false;
					$data['Message'] = message('Logo not uploaded. Please try again uploading with valid file type & file size upto 2MB.', 'error');
				}
			}
			
			$DbFieldsAry = array('type', 'name', 'userName', 'password', 'email', 'address', 'city', 'country', 'phone', 'website', 'picture', 'joinDate', 'lastLogin', 'ipAddress', 'status');
			$InfoAry = array($data['agentType'], $data['name'], $data['name'], $this->encrypt->encode($data['password']), $data['email'], $data['address'], $data['city'], $data['country'], $data['phone'], $data['website'], $image_name, $this->current_date, '', $_SERVER['REMOTE_ADDR'], 'YES');
			
			$captha_valid = true;
			if(!captcha_match()){
				$captha_valid = true;
				$data['Message'] = message('Invalid verification code.', 'error');
			}			
			if($this->unique_info($data['email']) && $valid_upload && $captha_valid){
				if($this->general_model->addInfo_Simple($DbFieldsAry, $InfoAry, 'tbl_agents')){
					$agentId = $this->general_model->getSingleValue($data['email'], 'email', 'ID', 'tbl_agents');
					$sessData = array('agentId' => $agentId,'userName' => $data['name'], 'email' => $data['email'], 'pass' => $data['password'], 'ipAddress' => $_SERVER['REMOTE_ADDR'], 'agentType' => $data['agentType'], 'recordsPerPage' => 20);
					$this->session->set_userdata($sessData);
					setMessage('message', message('<b>Hi '.$data['name'].',</b> Welcome on Get2Let.com One of the best Realestate plateform.', 'success'));
				
					redirect(base_url().'dashboard', 'refresh');
				}
				else{
					$data['Message'] = message('Unable to perofrm this operation, please try again later!', 'error');
				}
			}
		}
		$this->load->view('register_page_view', $data);
	}
	
	
	public function success(){
		$data['title'] = $this->project_model->projectName().$this->title;
		$data['meta_tags'] = $this->metaTags;
		$data['keywords'] = $this->keywords;
		$data['details'] = $this->details;
		$data['page_name'] = $this->pageName;
		$data['heading'] = $this->heading;
		$this->load->view('dashboard', $data);
	}
	
	private function unique_info($email){
		if(!$this->general_model->duplicateEntry('email', $email, 'tbl_agents')){
			return true;
		}
		return false;
	}
	
	public function pageNotFound(){
		redirect(base_url(), 'refersh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */