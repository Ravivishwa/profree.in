<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Agents extends CI_Controller {
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
	 
	private $Table = 'tbl_agents';
	
	private $sortBy = 'name';
	private $sortType = 'asc';
	private $sortBySession = 'agents_orderBy';
	private $sortTypeSession = 'agents_orderType';
	
	private $SEARCH_SESSION = 'agentsSEARCH_SESS';
	private $searchString = ''; 
	
	
	function __construct(){		
		parent::__construct();				
	}
	
	public function index()
	{
		if(!$this->general_model->isModuleEnabled('agents')){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
		if($this->session->userdata('agentType') != 0){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
		$data['pageTitle'] = $this->project_model->projectName().' :: Agents';
		$data['Message'] = '';	
		$data['heading'] = 'Agents';
		$data['pageName'] = 'agents';
		
		$config['base_url'] = base_url().'admin/agents/p/';
		$config['total_rows'] = $this->general_model->getTotalDataSingleArgument('0', 'type !=', 'ID', $this->Table);
		
		$data['sessionSearch'] = $this->SEARCH_SESSION;
		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){
			$data['sessionSearch'] = $this->SEARCH_SESSION;
			$this->searchString = $this->session->userdata($this->SEARCH_SESSION);
			$dbFieldsArray = array('name', 'userName', 'email', 'address', 'phone');			
			$config['total_rows'] = $this->general_model->getTotalDataSingleArgumentSearch($this->searchString, $dbFieldsArray, 'ID', $this->Table);
		}
		
		$config['uri_segment'] = 3;
		$config['per_page'] = $this->session->userdata('recordsPerPage');
		$data['per_page'] = $this->session->userdata('recordsPerPage');
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['counter'] = $page;
		$data['page'] = $page;
		$data['bgColor'] = '#f4f1f1';
		$data['chkCount'] = 0;		
		
		$sort = $this->getSort();		
		$data['QUERY'] = $this->general_model->getAllDataSingleArgument('0', 'type !=', $this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);
		
		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){						
			$data['QUERY'] = $this->general_model->getAllDataSingleArgumentSEARCH($this->searchString, $dbFieldsArray, $this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);
		}
		
		$this->load->view('admin/agents/agentsView', $data);
	}
	
	public function p(){
		
		if(!$this->general_model->isModuleEnabled('agents')){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
		
		if($this->session->userdata('agentType') != 0){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
		
		$data['pageTitle'] = $this->project_model->projectName().' :: agents';
		$data['Message'] = '';	
		$data['heading'] = 'agents';
		$data['pageName'] = 'agents';
		
		$config['base_url'] = base_url().'admin/agents/p/';
		$config['total_rows'] = $this->general_model->getTotalDataSingleArgument('0', 'type !=', 'ID', $this->Table);
		
		$data['sessionSearch'] = $this->SEARCH_SESSION;
		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){
			$this->searchString = $this->session->userdata($this->SEARCH_SESSION);
			$dbFieldsArray = array('name', 'userName', 'email', 'address', 'phone', 'company');			
			$config['total_rows'] = $this->general_model->getTotalDataSingleArgumentSearch($this->searchString, $dbFieldsArray, 'ID', $this->Table);
		}		
		$config['uri_segment'] = 4;
		$config['per_page'] = $this->session->userdata('recordsPerPage');
		$data['per_page'] = $this->session->userdata('recordsPerPage');
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['counter'] = $page;
		$data['page'] = $page;
		$data['bgColor'] = '#f4f1f1';
		$data['chkCount'] = 0;		
		
		$sort = $this->getSort();		
		$data['QUERY'] = $this->general_model->getAllDataSingleArgument('0', 'type !=', $this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);
		
		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){						
			$data['QUERY'] = $this->general_model->getAllDataSingleArgumentSEARCH($this->searchString, $dbFieldsArray, $this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);
		}
		
		$this->load->view('admin/agents/agentsView', $data);
	}
	
	private function addSort($orderBy, $orderType){
		
		$data = array($this->sortBySession => $orderBy, $this->sortTypeSession => $orderType);
		
		$this->session->set_userdata($data);
		
		
	}
	
	private function getSort(){
				
		if((bool)($this->session->userdata($this->sortBySession)) == TRUE && (bool)($this->session->userdata($this->sortTypeSession)) == TRUE){
			
			$this->sortBy = $this->session->userdata($this->sortBySession);
			$this->sortType = $this->session->userdata($this->sortTypeSession);			
		}
		
		$sort = array('by' => $this->sortBy, 'type' => $this->sortType);
		return $sort;
		
		
	}
	
	public function Sort($sortBy = NULL){
	
		if($sortBy == NULL){
			setMessage('error_message', 'Unable to sort, something went wrong from your side. Please try again later with proper procedure!');
			redirect(base_url().'admin/agents', 'refresh');
		}
			
		$currentSortType = $this->session->userdata($this->sortTypeSession);
		$currentSortBy = $this->session->userdata($this->sortBySession);
		
		if($currentSortBy != '' && $currentSortType != ''){
			
			if($currentSortType == 'asc'){
				$newSortType = 'desc';
			}
			else{
				$newSortType = 'asc';
			}
			
			if($currentSortBy != $sortBy){
				$newSortType = 'asc';
			}
		}
		else{
			
			$newSortType = 'desc';			
		}				
		
		$this->addSort($sortBy, $newSortType);
		
		redirect(base_url().'admin/agents','refresh');
	}
	
	
	public function add(){		
		if(!$this->general_model->isModuleEnabled('agents')){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
		$data['pageTitle'] = $this->project_model->projectName().' :: Agents : Add agent';
		$data['Message'] = '';	
		$data['heading'] = 'Add New Agent';
		$data['pageName'] = 'agents';
		
		$data['agentType'] = 1;
		$data['name'] = 'Enter agent name.';
		$data['userName'] = 'Enter user name.';
		$data['password'] = '';
		$data['Cpassword'] = '';
		$data['email'] = 'Enter email address.';		
		$data['address'] = 'Enter address.';
		$data['city'] = 'Choose city name.';
		$data['country'] = 'Choose country name.';
		$data['phone'] = 'Enter phone number.';
		$data['picture'] = '';
		$data['countries'] = $this->general_model->listCountries(0);
		$data['cities'] = $this->general_model->listCities(0, 0);		
		
		if((bool)($this->input->post('btnAddAgent')) == TRUE){
			
			$data['agentType'] = $this->input->post('agentType');			
			$data['name'] = $this->input->post('name');
			$data['userName'] = $this->input->post('userName');
			$data['password'] = $this->input->post('password');
			$data['Cpassword'] = $this->input->post('Cpassword');
			$data['email'] = $this->input->post('email');
			
			$data['address'] = $this->input->post('address');
			$data['city'] = $this->input->post('city');
			$data['country'] = $this->input->post('country');
			$data['phone'] = $this->input->post('phone');
			$data['picture'] = '';
			$data['countries'] = $this->general_model->listCountries($data['country']);
			$data['cities'] = $this->general_model->listCities($data['country'], $data['city']);
			
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('userName', 'User Name', 'required|min_length[4]|max_length[12]|callback_validateUsername|callback_usernameAvailabilityCheck');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[12]');	
			$this->form_validation->set_rules('Cpassword','Password confirmation','required|min_length[4]|max_length[12]|matches[password]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_emailAvailabilityCheck');				
			
			if($this->form_validation->run() === TRUE){
												
				$agentId = $this->session->userdata('agentId');
				$Date = getCurrentDate();
				$Time = getCurrentTime();
				
				$DbFieldsAry = array('type', 'name', 'userName', 'password', 'email', 'address', 'city', 'country', 'phone', 'picture', 'joinDate', 'lastLogin', 'ipAddress', 'featured', 'status');
				$InfoAry = array($data['agentType'], $data['name'], $data['userName'], $this->encrypt->encode($data['password']), $data['email'], $data['address'], $data['city'], $data['country'], $data['phone'], $data['picture'], $Date, '', $_SERVER['REMOTE_ADDR'], 'NO', 'YES');
				
				if($this->general_model->addInfo_Simple($DbFieldsAry, $InfoAry, $this->Table)){
															
					$activityId = $this->general_model->getSingleValue($data['userName'], 'userName', 'ID', $this->Table);					
					$this->general_model->addAgentActivity($agentId, $this->Table, $activityId, 'added new agent', $Date, $Time);										
					
					setMessage('success_message', 'New agent added successfully!');
					redirect(base_url().'admin/agents', 'refresh');
				}
				else{
					setMessage('error_message', 'Unable to perofrm this operation, please try again later!');
					redirect(base_url().'admin/agents', 'refresh');	
				}
			}
			else{
				$this->load->view('admin/agents/addAgentView', $data);
			}
			
		}
		else{
			$this->load->view('admin/agents/addAgentView', $data);
		}
	}
	
	
	public function usernameAvailabilityCheck($username){		
		if($this->general_model->duplicateEntry('userName', $username, $this->Table)){
			 $this->form_validation->set_message('usernameAvailabilityCheck', $username.' : is not available as username.');
			return false;
		}
		return true;		
	}
	
	
		/************	Check User Name is valid ??		******************/
	public function validateUsername($username){		
		if (!preg_match('/^[\w]+$/', $username)) {
		 	 $this->form_validation->set_message('validateUsername', 'Enter valid username, do not special characters');
			return false;
		}
		return true;
	}
	
	
		/************	Check Email Address availability		*******************/
	public function emailAvailabilityCheck($email){		
		if($this->general_model->duplicateEntry('email', $email, $this->Table)){
			 $this->form_validation->set_message('emailAvailabilityCheck', $email.' is not available as email address.');
			return false;
		}
		return true;		
	}
	
	
	public function delete($agentId = NULL, $page = NULL){		
		if(!$this->general_model->isModuleEnabled('agents')){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
		if($agentId == NULL || $page == NULL){
			setMessage('error_message', 'Unable to delete city, something went wrong from your side. Please try again later with proper procedure!');
			redirect(base_url().'admin/agents', 'refresh');
		}
		
		if($this->general_model->getSingleValue($agentId, 'ID', 'ID', $this->Table) > 0 && isNumber($agentId)){
			
			if($this->general_model->deleteData($agentId, 'ID', $this->Table)){
				
				$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed agent', getCurrentDate(), getCurrentTime());
								
				setMessage('success_message', 'Agent removed successfully!');
				redirect(base_url().'admin/agents/p/'.$page, 'refresh');
			}
		}
		else{
			
			setMessage('error_message', 'Unable to delete agent, something went wrong from your side. Please try again later with proper procedure!');
			redirect(base_url().'admin/agents', 'refresh');
		}
		
	}
	
	
	public function update($ID = NULL, $page = NULL){		
		
		if(!$this->general_model->isModuleEnabled('agents') && $ID != $this->session->userdata('agentId')){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
		$data['pageTitle'] = $this->project_model->projectName().' :: Agents : Update agent';
		$data['Message'] = '';	
		$data['heading'] = 'Update Agent';
		$data['pageName'] = 'agents';
		
		$data['page'] = $page;
		$data['ID'] = $ID;
			
		$DATA = $this->general_model->getSingleData_Simple($ID, 'ID', $this->Table);
		
		if((bool)($this->input->post('btnUpdateAgent')) == TRUE){
			$data['name'] = $this->input->post('name');
			$data['userName'] = $this->input->post('userName');
			$data['password'] = $this->input->post('password');
			$data['Cpassword'] = $this->input->post('Cpassword');
			$data['email'] = $this->input->post('email');
			$data['address'] = $this->input->post('address');
			$data['city'] = $this->input->post('city');
			$data['country'] = $this->input->post('country');
			$data['phone'] = $this->input->post('phone');
			$data['featured'] = $this->input->post('featured');
			$data['countries'] = $this->general_model->listCountries($data['country']);
			$data['cities'] = $this->general_model->listCities($data['country'], $data['city']);
			
			$this->form_validation->set_rules('name', 'Name', 'trim|required');			
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[12]');	
			$this->form_validation->set_rules('Cpassword','Password confirmation','required|min_length[4]|max_length[24]|matches[password]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');				
			
						
			if($this->form_validation->run() === TRUE){																
				
				
				$image_name = $this->input->post('picture');
				$data['image'] = $image_name;
				
				initializeImageSettings();
				if ($this->upload->do_upload()){
					$img_data = array($this->upload->data());
					$image_name = $img_data[0]['file_name'];							
					resize_image($image_name, 'medium', 577, 577);
					resize_image($image_name, 'thumbs', 60, 60);
					
					if($data['image'] != ''){removeImage($data['image']);}								
				}
				$updateDbFieldsAry = array('name', 'password', 'email', 'address', 'city', 'country', 'phone', 'picture', 'featured');
				$updateInfoAry = array($data['name'], $this->encrypt->encode($data['password']), $data['email'], $data['address'], $data['city'], $data['country'], $data['phone'], $image_name, $data['featured']);
				
				$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);								
				
				$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'updated agent', getCurrentDate(), getCurrentTime());
				
				setMessage('success_message', 'Agent updated successfully!');
				redirect(base_url().'admin/dashboard', 'refresh');				
			}
			else{
				$this->load->view('admin/agents/editAgentview', $data);
			}
		}
		else{
			$data['agentType'] = $DATA->type;
			$data['name'] = $DATA->name;
			$data['userName'] = $DATA->userName;
			$data['password'] = $this->encrypt->decode($DATA->password);
			$data['Cpassword'] = $this->encrypt->decode($DATA->password);
			$data['email'] = $DATA->email;			
			$data['address'] = $DATA->address;
			$data['city'] = $DATA->city;
			$data['country'] = $DATA->country;
			$data['phone'] = $DATA->phone;
			$data['featured'] = $DATA->featured;
			$data['countries'] = $this->general_model->listCountries($DATA->country);
			$data['cities'] = $this->general_model->listCities($DATA->country, $DATA->city);
			$data['picture'] = $DATA->picture;		
			$this->load->view('admin/agents/editAgentview', $data);	
		}
	}
	
	
	public function performAction($page){
		
		$action = $_POST['actionType'];				
		
		$totalRows = $_POST['counter_number'];
		
		switch($action){
			
			case 'activeAll':
				for($i=1; $i<=$totalRows; $i++){
					
					if((bool)($this->input->post('CB'.$i)) == TRUE){
						$ID = $this->input->post('CB'.$i);	
						$this->changeStatusALL($ID, 'YES');
					}
				}
				setMessage('success_message', 'Status updated successfully!');
			break;
			
			case 'inActiveAll':
				for($i=1; $i<=$totalRows; $i++){
					
					if((bool)($this->input->post('CB'.$i)) == TRUE){
						$ID = $this->input->post('CB'.$i);	
						$this->changeStatusALL($ID, 'NO');
					}
				}
				setMessage('success_message', 'Status updated successfully!');
			break;
			
			case 'deleteAll':
				for($i=1; $i<=$totalRows; $i++){
					
					if((bool)($this->input->post('CB'.$i)) == TRUE){
						$ID = $this->input->post('CB'.$i);	
						$this->deleteAll($ID);
					}
				}
				setMessage('success_message', 'Removed successfully!');
			break;
		}
		
		redirect(base_url().'admin/agents/p/'.$page, 'refresh');
	}
	
	
	private function changeStatusALL($ID, $status){
				
		$updateDbFieldsAry = array('status');
		$updateInfoAry = array($status);
		$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);
		
		$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'changed status', getCurrentDate(), getCurrentTime());		
	}
	
	
	private function deleteAll($agentId){		
			
		if($this->general_model->deleteData($agentId, 'ID', $this->Table)){
			
			$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed city', getCurrentDate(), getCurrentTime());										
		}		
	}
	
	public function changeStatus($ID, $status, $page){
		
		if($ID == NULL || $status == NULL || $page == NULL){
			setMessage('error_message', 'Unable to change status, something went wrong from your side. Please try again later with proper procedure!');
			redirect(base_url().'admin/agents', 'refresh');
		}
		
		if($status == 'YES'){
			$newStatus = 'NO';	
		}
		else{
			$newStatus = 'YES';
		}
		
		$updateDbFieldsAry = array('status');
		$updateInfoAry = array($newStatus);
		$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);
		
		$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'changed status', getCurrentDate(), getCurrentTime());
		
		redirect(base_url().'admin/agents/p/'.$page,'refresh');
	}	
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */