<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Faqs extends CI_Controller {



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

	 

	private $Table = 'tbl_faqs';

	

	private $sortBy = 'question';

	private $sortType = 'asc';

	private $sortBySession = 'faqs_orderBy';

	private $sortTypeSession = 'faqs_orderType';

	

	private $SEARCH_SESSION = 'faqsSEARCH_SESS';

	private $searchString = '';

	function __construct(){
		
		parent::__construct();
		
		if(!$this->general_model->isModuleEnabled('faqs')){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
	}
	

	public function index()

	{

		$data['pageTitle'] = $this->project_model->projectName().' :: Faqs';
		
		$data['Message'] = '';	

		$data['heading'] = 'FAQs';

		$data['pageName'] = 'faqs';

		

		$config['base_url'] = base_url().'admin/faqs/p/';

		$config['total_rows'] = $this->general_model->getTotalDataSimple('ID', $this->Table);

		

		$data['sessionSearch'] = $this->SEARCH_SESSION;

		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){

			$data['sessionSearch'] = $this->SEARCH_SESSION;

			$this->searchString = $this->session->userdata($this->SEARCH_SESSION);

			$dbFieldsArray = array('question', 'answer');

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

		

		$this->load->view('admin/faqs/faqsView', $data);

	}

	

	public function p(){

		

		$data['pageTitle'] = $this->project_model->projectName().' :: FAQs';

		$data['Message'] = '';	

		$data['heading'] = 'FAQs';

		$data['pageName'] = 'faqs';

		

		$config['base_url'] = base_url().'admin/faqs/p/';

		$config['total_rows'] = $this->general_model->getTotalDataSimple('ID', $this->Table);

		

		$data['sessionSearch'] = $this->SEARCH_SESSION;

		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){

			$data['sessionSearch'] = $this->SEARCH_SESSION;

			$this->searchString = $this->session->userdata($this->SEARCH_SESSION);

			$dbFieldsArray = array('question', 'answer');			

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

		

		$this->load->view('admin/faqs/faqsView', $data);

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

			redirect(base_url().'admin/faqs', 'refresh');

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

		

		redirect(base_url().'admin/faqs','refresh');

	}

	

	

	public function add(){

		

		$data['pageTitle'] = $this->project_model->projectName().' :: FAQs : Add Question';

		$data['Message'] = '';	

		$data['heading'] = 'FAQs: Add New Question';

		$data['pageName'] = 'faqs';

				

		$data['question'] = 'Enter question.';	

		$data['answer'] = '';		

		

		if((bool)($this->input->post('btnAddfaqs')) == TRUE){

					

			$data['question'] = $this->input->post('question');	
			
			$data['answer'] = $this->input->post('answer');
			
			$this->form_validation->set_rules('question', 'Question', 'trim|required');						

			

			if($this->form_validation->run() === TRUE){

												

				$agentId = $this->session->userdata('agentId');

				$Date = getCurrentDate();

				$Time = getCurrentTime();

				$DbFieldsAry = array('agentId', 'question', 'answer', 'date', 'status');

				$InfoAry = array($agentId, $data['question'], $data['answer'], $Date, 'YES');

				

				if($this->general_model->addInfo_Simple($DbFieldsAry, $InfoAry, $this->Table)){

										

					$activityId = $this->general_model->getSingleValue($data['question'], 'question', 'ID', $this->Table);

					

					$this->general_model->addAgentActivity($agentId, $this->Table, $activityId, 'added new question(FAQs)', $Date, $Time);

					

					setMessage('success_message', 'New question(FAQs) added successfully!');

					redirect(base_url().'admin/faqs', 'refresh');

				}

				else{

					setMessage('error_message', 'Unable to perofrm this operation, please try again later!');

					redirect(base_url().'admin/faqs', 'refresh');	

				}				

			}

			else{

				$this->load->view('admin/faqs/addfaqsView', $data);

			}

			

		}

		else{

			$this->load->view('admin/faqs/addfaqsView', $data);

		}

	}

			

	

	

	public function delete($agentId = NULL, $page = NULL){		

		if($agentId == NULL || $page == NULL){

			setMessage('error_message', 'Unable to delete faqs, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/faqs', 'refresh');

		}

		

		if($this->general_model->getSingleValue($agentId, 'ID', 'ID', $this->Table) > 0 && isNumber($agentId)){

			

			if($this->general_model->deleteData($agentId, 'ID', $this->Table)){

				

				$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed faqs', getCurrentDate(), getCurrentTime());

								

				setMessage('success_message', 'faqs removed successfully!');

				redirect(base_url().'admin/faqs/p/'.$page, 'refresh');

			}

		}

		else{

			

			setMessage('error_message', 'Unable to delete faqs, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/faqs', 'refresh');

		}

		

	}

	

	

	public function update($ID = NULL, $page = NULL){		

		

		$data['pageTitle'] = $this->project_model->projectName().' :: FAQs : Update Question';

		$data['Message'] = '';	

		$data['heading'] = 'FAQs: Update question';

		$data['pageName'] = 'faqs';

		

		$data['page'] = $page;

		$data['ID'] = $ID;

			

		$DATA = $this->general_model->getSingleData_Simple($ID, 'ID', $this->Table);

		

		if((bool)($this->input->post('btnUpdatefaqs')) == TRUE){

			

			$data['question'] = $this->input->post('question');

			$data['answer'] = $this->input->post('answer');

			

			$this->form_validation->set_rules('question', 'Question', 'trim|required');		

						

			if($this->form_validation->run() === TRUE){																

				

				$updateDbFieldsAry = array('agentId', 'question', 'answer');

				$updateInfoAry = array($this->session->userdata('agentId'), $data['question'], $data['answer']);
				
				$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);			

				

				$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'updated question(FAQs)', getCurrentDate(), getCurrentTime());

				

				setMessage('success_message', 'Question(FAQs) updated successfully!');

				redirect(base_url().'admin/faqs/p/'.$page, 'refresh');				

			}

			else{

				$this->load->view('admin/faqs/editfaqsView', $data);

			}

		}

		else{		

			$data['question'] = $DATA->question;

			$data['answer'] = $DATA->answer;	

			$this->load->view('admin/faqs/editfaqsView', $data);	

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

		

		redirect(base_url().'admin/faqs/p/'.$page, 'refresh');

	}

	

	

	private function changeStatusALL($ID, $status){

				

		$updateDbFieldsAry = array('status');

		$updateInfoAry = array($status);

		$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);

		

		$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'changed status', getCurrentDate(), getCurrentTime());		

	}

	

	

	private function deleteAll($agentId){		

			

		if($this->general_model->deleteData($agentId, 'ID', $this->Table)){

			

			$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed faqs', getCurrentDate(), getCurrentTime());										

		}		

	}

	

	public function changeStatus($ID, $status, $page){

		

		if($ID == NULL || $status == NULL || $page == NULL){

			setMessage('error_message', 'Unable to change status, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/faqs', 'refresh');

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

		

		redirect(base_url().'admin/faqs/p/'.$page,'refresh');

	}

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */