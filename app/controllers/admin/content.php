<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Content extends CI_Controller {



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

	 

	private $Table = 'tbl_content';

	

	private $sortBy = 'pageName';

	private $sortType = 'asc';

	private $sortBySession = 'content_orderBy';

	private $sortTypeSession = 'content_orderType';

	

	private $SEARCH_SESSION = 'contentSEARCH_SESS';

	private $searchString = '';

	function __construct(){
		
		parent::__construct();
		
		if(!$this->general_model->isModuleEnabled('content')){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
	}
	

	public function index()

	{

		$data['pageTitle'] = $this->project_model->projectName().' :: Content';

		$data['Message'] = '';	

		$data['heading'] = 'Content';

		$data['pageName'] = 'content';

		

		$config['base_url'] = base_url().'admin/content/p/';

		$config['total_rows'] = $this->general_model->getTotalDataSimple('ID', $this->Table);

		

		$data['sessionSearch'] = $this->SEARCH_SESSION;

		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){

			$data['sessionSearch'] = $this->SEARCH_SESSION;

			$this->searchString = $this->session->userdata($this->SEARCH_SESSION);

			$dbFieldsArray = array('pageName', 'title', 'metaTags', 'keywords', 'details');			

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

		

		$this->load->view('admin/content/contentView', $data);

	}

	

	public function p(){

		

		$data['pageTitle'] = $this->project_model->projectName().' :: Content';

		$data['Message'] = '';	

		$data['heading'] = 'Content';

		$data['pageName'] = 'content';

		

		$config['base_url'] = base_url().'admin/content/p/';

		$config['total_rows'] = $this->general_model->getTotalDataSimple('ID', $this->Table);

		

		$data['sessionSearch'] = $this->SEARCH_SESSION;

		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){

			$data['sessionSearch'] = $this->SEARCH_SESSION;

			$this->searchString = $this->session->userdata($this->SEARCH_SESSION);

			$dbFieldsArray = array('pageName', 'title', 'metaTags', 'keywords', 'details');			

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

		

		$this->load->view('admin/content/contentView', $data);

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

			redirect(base_url().'admin/content', 'refresh');

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

		

		redirect(base_url().'admin/content','refresh');

	}

	

	

	public function add(){

		

		$data['pageTitle'] = $this->project_model->projectName().' :: Content : Add Page Content';

		$data['Message'] = '';	

		$data['heading'] = 'Add New Page Content';

		$data['pageName'] = 'content';

				

		$data['page__name'] = 'Enter page name.';

		$data['title'] = 'Enter page title.';

		$data['metaTags'] = '';

		$data['keywords'] = '';

		$data['details'] = '';		

		

		if((bool)($this->input->post('btnAddcontent')) == TRUE){

					

			$data['page__name'] = $this->input->post('page__name');	

			$data['title'] = $this->input->post('title');

			$data['metaTags'] = $this->input->post('metaTags');

			$data['keywords'] = $this->input->post('keywords');

			$data['details'] = $this->input->post('details');

			

			$this->form_validation->set_rules('page__name', 'Page name', 'trim|required');

			$this->form_validation->set_rules('title', 'Page title', 'trim|required');							

			

			if($this->form_validation->run() === TRUE){

												

				$agentId = $this->session->userdata('agentId');

				$Date = getCurrentDate();

				$Time = getCurrentTime();

				$DbFieldsAry = array('agentId', 'pageName', 'title', 'metaTags', 'keywords', 'details', 'date', 'status');

				$InfoAry = array($agentId, $data['page__name'], $data['title'], $data['metaTags'], $data['keywords'], $data['details'], $Date, 'YES');

				

				if(!$this->general_model->duplicateEntry('pageName', $data['page__name'], $this->Table)){

					if($this->general_model->addInfo_Simple($DbFieldsAry, $InfoAry, $this->Table)){

											

						$activityId = $this->general_model->getSingleValue($data['page__name'], 'pageName', 'ID', $this->Table);

						

						$this->general_model->addAgentActivity($agentId, $this->Table, $activityId, 'added new page Content', $Date, $Time);

						

						setMessage('success_message', 'New Page Content added successfully!');

						redirect(base_url().'admin/content', 'refresh');

					}

					else{

						setMessage('error_message', 'Unable to perofrm this operation, please try again later!');

						redirect(base_url().'admin/content', 'refresh');	

					}

				}

				else{

					$data['Message'] = 'Page with same name already exists. Please change page name or update already added page to make changes!';

					$this->load->view('admin/content/addcontentView', $data);

				}

			}

			else{

				$this->load->view('admin/content/addcontentView', $data);

			}

			

		}

		else{

			$this->load->view('admin/content/addcontentView', $data);

		}

	}

			

	

	

	public function delete($agentId = NULL, $page = NULL){		

		if($agentId == NULL || $page == NULL){

			setMessage('error_message', 'Unable to delete Content, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/content', 'refresh');

		}

		

		if($this->general_model->getSingleValue($agentId, 'ID', 'ID', $this->Table) > 0 && isNumber($agentId)){

			

			if($this->general_model->deleteData($agentId, 'ID', $this->Table)){

				

				$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed Content', getCurrentDate(), getCurrentTime());

								

				setMessage('success_message', 'Content removed successfully!');

				redirect(base_url().'admin/content/p/'.$page, 'refresh');

			}

		}

		else{

			

			setMessage('error_message', 'Unable to delete Content, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/content', 'refresh');

		}

		

	}

	

	

	public function update($ID = NULL, $page = NULL){		

		

		$data['pageTitle'] = $this->project_model->projectName().' :: Content : Update Page Content';

		$data['Message'] = '';	

		$data['heading'] = 'Update Content';

		$data['pageName'] = 'content';

		

		$data['page'] = $page;

		$data['ID'] = $ID;

			

		$DATA = $this->general_model->getSingleData_Simple($ID, 'ID', $this->Table);

		

		if((bool)($this->input->post('btnUpdatecontent')) == TRUE){

			

			$data['page__name'] = $this->input->post('page__name');

			$data['title'] = $this->input->post('title');

			$data['metaTags'] = $this->input->post('metaTags');

			$data['keywords'] = $this->input->post('keywords');

			$data['details'] = $this->input->post('details');

			

			$this->form_validation->set_rules('title', 'Page title', 'trim|required');		

						

			if($this->form_validation->run() === TRUE){																

				

				$updateDbFieldsAry = array('agentId', 'title', 'metaTags', 'keywords', 'details');

				$updateInfoAry = array($this->session->userdata('agentId'), $data['title'], $data['metaTags'], $data['keywords'], $data['details']);

				

				$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);			

				

				$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'updated Content', getCurrentDate(), getCurrentTime());

				

				setMessage('success_message', 'Page content updated successfully!');

				redirect(base_url().'admin/content/p/'.$page, 'refresh');				

			}

			else{

				$this->load->view('admin/content/editcontentView', $data);

			}

		}

		else{		

			$data['page__name'] = $DATA->pageName;

			$data['title'] = $DATA->title;

			$data['metaTags'] = $DATA->metaTags;

			$data['keywords'] = $DATA->keywords;

			$data['details'] = $DATA->details;		

			$this->load->view('admin/content/editcontentView', $data);	

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

		

		redirect(base_url().'admin/content/p/'.$page, 'refresh');

	}

	

	

	private function changeStatusALL($ID, $status){

				

		$updateDbFieldsAry = array('status');

		$updateInfoAry = array($status);

		$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);

		

		$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'changed status', getCurrentDate(), getCurrentTime());		

	}

	

	

	private function deleteAll($agentId){		

			

		if($this->general_model->deleteData($agentId, 'ID', $this->Table)){

			

			$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed Content', getCurrentDate(), getCurrentTime());										

		}		

	}

	

	public function changeStatus($ID, $status, $page){

		

		if($ID == NULL || $status == NULL || $page == NULL){

			setMessage('error_message', 'Unable to change status, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/content', 'refresh');

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

		

		redirect(base_url().'admin/content/p/'.$page,'refresh');

	}

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */