<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HomeSlider extends CI_Controller {



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

	 

	private $Table = 'tbl_homeslider';
	private $sortBy = 'date';
	private $sortType = 'desc';
	private $sortBySession = 'homeSlider_orderBy';
	private $sortTypeSession = 'homeSlider_orderType';

	
	private $SEARCH_SESSION = 'homeSliderSEARCH_SESS';
	private $searchString = '';

	/************		Image Processing	******************/
	private $imagePath = '../btPublic/bt-uploads/';
	
	function __construct(){
		
		parent::__construct();
		
		if(!$this->general_model->isModuleEnabled('homeSlider')){
			redirect(base_url().'admin/dashboard', 'refresh');
		}				
		
	}
	

	public function index()

	{

		$data['pageTitle'] = $this->project_model->projectName().' :: Home Slider';
		
		$data['Message'] = '';	

		$data['heading'] = 'Home Slider';

		$data['pageName'] = 'homeSlider';

		

		$config['base_url'] = base_url().'admin/homeSlider/p/';

		$config['total_rows'] = $this->general_model->getTotalDataSimple('ID', $this->Table);

		

		$data['sessionSearch'] = $this->SEARCH_SESSION;

		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){

			$data['sessionSearch'] = $this->SEARCH_SESSION;

			$this->searchString = $this->session->userdata($this->SEARCH_SESSION);

			$dbFieldsArray = array('title');

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

		$data['QUERY'] = $this->general_model->getAllDataSimple($this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);

		

		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){						

			$data['QUERY'] = $this->general_model->getAllDataSingleArgumentSEARCH($this->searchString, $dbFieldsArray, $this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);

		}

		

		$this->load->view('admin/homeSlider/homeSliderView', $data);

	}

	

	public function p(){

		

		$data['pageTitle'] = $this->project_model->projectName().' :: Home Slider';

		$data['Message'] = '';	

		$data['heading'] = 'Home Slider';

		$data['pageName'] = 'homeSlider';

		

		$config['base_url'] = base_url().'admin/homeSlider/p/';

		$config['total_rows'] = $this->general_model->getTotalDataSimple('ID', $this->Table);

		

		$data['sessionSearch'] = $this->SEARCH_SESSION;

		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){

			$data['sessionSearch'] = $this->SEARCH_SESSION;

			$this->searchString = $this->session->userdata($this->SEARCH_SESSION);

			$dbFieldsArray = array('title');			

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

		$data['QUERY'] = $this->general_model->getAllDataSimple($this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);

		

		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){						

			$data['QUERY'] = $this->general_model->getAllDataSingleArgumentSEARCH($this->searchString, $dbFieldsArray, $this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);

		}

		

		$this->load->view('admin/homeSlider/homeSliderView', $data);

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

			redirect(base_url().'admin/homeSlider', 'refresh');

		}

			

		$currentSortType = $this->session->userdata($this->sortTypeSession);

		$currentSortBy = $this->session->userdata($this->sortBySession);

		

		if($currentSortBy != '' && $currentSortType != ''){

			

			if($currentSortType == 'asc'){

				$homeSliderortType = 'desc';

			}

			else{

				$homeSliderortType = 'asc';

			}

			

			if($currentSortBy != $sortBy){

				$homeSliderortType = 'asc';

			}

		}

		else{

			

			$homeSliderortType = 'desc';			

		}				

		

		$this->addSort($sortBy, $homeSliderortType);

		

		redirect(base_url().'admin/homeSlider','refresh');

	}

	

	

	public function add(){		

		$data['pageTitle'] = $this->project_model->projectName().' :: HomeSlider : Add Home Slider';
		$data['Message'] = '';	
		$data['heading'] = 'Home Slider: Add Home Slider';
		$data['pageName'] = 'homeSlider';				
		$isValid = false;
		
		$data['title'] = '';
		$data['description'] = '';
		$data['userfile'] = '';

		if((bool)($this->input->post('btnAddhomeSlider')) == TRUE){

			$data['title'] = $this->input->post('title');
			$data['description'] = $this->input->post('description');
								
			initializeImageSettings();
			if ($this->upload->do_upload()){
				$img_data = array($this->upload->data());
				$image_name = $img_data[0]['file_name'];							
				resize_image($image_name, 'medium', 577, 577);
				resize_image($image_name, 'thumbs', 60, 60);
				
				$agentId = $this->session->userdata('agentId');
				$Date = getCurrentDate();
				$Time = getCurrentTime();
				$DbFieldsAry = array('agentId', 'title', 'image', 'description', 'date', 'status');
				$InfoAry = array($agentId, $data['title'], $image_name, $data['description'], $Date, 'YES');				

				if($this->general_model->addInfo_Simple($DbFieldsAry, $InfoAry, $this->Table)){
					
					$activityId = $this->general_model->getSingleValue($image_name, 'image', 'ID', $this->Table);					
					$this->general_model->addAgentActivity($agentId, $this->Table, $activityId, 'added new Home Slider', $Date, $Time);
					setMessage('success_message', 'Home Slider added successfully!');
					redirect(base_url().'admin/homeSlider', 'refresh');
				}
				else{
					setMessage('error_message', 'Unable to perofrm this operation, please try again later!');
					redirect(base_url().'admin/homeSlider', 'refresh');	
				}
			}
			else{
				$error = array($this->upload->display_errors());
				$data['Message'] = $error[0];
				$this->load->view('admin/homeSlider/addhomeSliderView', $data);			
			}															
		}
		else{
			$this->load->view('admin/homeSlider/addhomeSliderView', $data);
		}
	}
			

	

	

	public function delete($agentId = NULL, $page = NULL){
		if($agentId == NULL || $page == NULL){
			setMessage('error_message', 'Unable to delete homeSlider, something went wrong from your side. Please try again later with proper procedure!');
			redirect(base_url().'admin/homeSlider', 'refresh');
		}

		

		if($this->general_model->getSingleValue($agentId, 'ID', 'ID', $this->Table) > 0 && isNumber($agentId)){
			$imageName = $this->general_model->getSingleValue($agentId, 'ID', 'image', $this->Table);
			if($this->general_model->deleteData($agentId, 'ID', $this->Table)){
				if($imageName != ''){removeImage($imageName); }	
				$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed homeSlider', getCurrentDate(), getCurrentTime());
												
				setMessage('success_message', 'homeSlider removed successfully!');
				redirect(base_url().'admin/homeSlider/p/'.$page, 'refresh');
			}
		}
		else{			
			setMessage('error_message', 'Unable to delete homeSlider, something went wrong from your side. Please try again later with proper procedure!');
			redirect(base_url().'admin/homeSlider', 'refresh');
		}		
	}

	

	

	public function update($ID = NULL, $page = NULL){		

		$data['pageTitle'] = $this->project_model->projectName().' :: homeSlider : Update Home Slider';
		$data['Message'] = '';	
		$data['heading'] = 'Home Slider: Update Home Slider';
		$data['pageName'] = 'homeSlider';

		$data['page'] = $page;
		$data['ID'] = $ID;
		$isValid = false;
		
		$DATA = $this->general_model->getSingleData_Simple($ID, 'ID', $this->Table);

		if((bool)($this->input->post('btnUpdatehomeSlider')) == TRUE){
			
			$data['title'] = $this->input->post('title');
			$data['description'] = $this->input->post('description');									
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
			$updateDbFieldsAry = array('agentId', 'title', 'image', 'description');
			$updateInfoAry = array($this->session->userdata('agentId'), $data['title'], $image_name, $data['description']);								
			$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);				

			$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'updated home slider', getCurrentDate(), getCurrentTime());				
			setMessage('success_message', 'Home Slider updated successfully!');
			redirect(base_url().'admin/homeSlider/p/'.$page, 'refresh');
						
		}

		else{
			$data['title'] = $DATA->title;
			$data['description'] = $DATA->description;
			$data['picture'] = $DATA->image;
			$this->load->view('admin/homeSlider/edithomeSliderView', $data);
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
						
						$imageName = $this->general_model->getSingleValue($ID, 'ID', 'image', $this->Table);
						
						$this->deleteAll($ID);
						
						if($imageName != ''){removeImage($imageName);}					
					}

				}

				setMessage('success_message', 'Removed successfully!');

			break;

		}

		

		redirect(base_url().'admin/homeSlider/p/'.$page, 'refresh');

	}

	

	

	private function changeStatusALL($ID, $status){

				

		$updateDbFieldsAry = array('status');

		$updateInfoAry = array($status);

		$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);

		

		$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'changed status', getCurrentDate(), getCurrentTime());		

	}

	

	

	private function deleteAll($agentId){		

			

		if($this->general_model->deleteData($agentId, 'ID', $this->Table)){

			

			$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed homeSlider', getCurrentDate(), getCurrentTime());										

		}		

	}

	

	public function changeStatus($ID, $status, $page){

		

		if($ID == NULL || $status == NULL || $page == NULL){

			setMessage('error_message', 'Unable to change status, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/homeSlider', 'refresh');

		}

		

		if($status == 'YES'){

			$homeSlidertatus = 'NO';	

		}

		else{

			$homeSlidertatus = 'YES';

		}

		

		$updateDbFieldsAry = array('status');

		$updateInfoAry = array($homeSlidertatus);

		$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);

		

		$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'changed status', getCurrentDate(), getCurrentTime());

		

		redirect(base_url().'admin/homeSlider/p/'.$page,'refresh');

	}

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */