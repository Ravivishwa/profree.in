<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Favourites extends CI_Controller {



	/**

	 * Index Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://example.com/index.phindex/welcome

	 *	- or -  

	 * 		http://example.com/index.phindex/welcome/index

	 *	- or -

	 * Since this controller is set as the default controller in 

	 * config/routes.php, it's displayed at http://example.com/

	 *

	 * So any other public methods not prefixed with an underscore will

	 * map to /index.phindex/welcome/<method_name>

	 * @see http://codeigniter.com/user_guide/general/urls.html

	 */

	 

	private $Table = 'tbl_favourites';

	

	private $sortBy = 'ID';

	private $sortType = 'desc';

	private $sortBySession = 'favourites_orderBy';

	private $sortTypeSession = 'favourites_orderType';
	
	private $totalCourses = 0;
	

	private $SEARCH_SESSION = 'favouritesSEARCH_SESS';

	private $searchString = '';
	private $agent_id = 0;

	/************		Image Processing	******************/
	private $imagePath = '../btPublic/bt-uploads/';
	
	function __construct(){
		
		parent::__construct();
		
		if(!$this->general_model->isModuleEnabled('favourites')){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
		$this->agent_id = $this->session->userdata('agentId');				
		
	}
	

	public function index(){
		$data['pageTitle'] = $this->project_model->projectName().' :: Favourites';
		$data['Message'] = '';
		$data['heading'] = 'Favourites';
		$data['pageName'] = 'favourites';

		$config['base_url'] = base_url().'admin/favourites/index/';
		$config['total_rows'] = $this->general_model->total_rows("user_id = '$this->agent_id'", 'ID', $this->Table);	
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
		$data['QUERY'] = $this->general_model->fetchDataAll("user_id = '$this->agent_id'", $this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);	
		$this->load->view('admin/favourites/favouritesView', $data);
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
			redirect(base_url().'admin/favourites', 'refresh');
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
		
		redirect(base_url().'admin/favourites','refresh');
	}	
	
	
	
	public function delete($agentId = NULL, $page = NULL){		
		if($agentId == NULL || $page == NULL){
			setMessage('error_message', 'Unable to delete Property, something went wrong from your side. Please try again later with proper procedure!');
			redirect(base_url().'admin/favourites', 'refresh');
		}
		if($this->general_model->getSingleValue($agentId, 'ID', 'ID', $this->Table) > 0 && isNumber($agentId)){
			if($this->general_model->deleteData($agentId, 'ID', $this->Table)){
				$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed property', getCurrentDate(), getCurrentTime());
				setMessage('success_message', 'favourite property removed successfully!');
				redirect(base_url().'admin/favourites/index/'.$page, 'refresh');
			}
		}
		else{
			setMessage('error_message', 'Unable to delete Property, something went wrong from your side. Please try again later with proper procedure!');
			redirect(base_url().'admin/favourites', 'refresh');
		}
	}

	
	

	public function performAction($page){

		

		$action = $_POST['actionType'];				

		

		$totalRows = $_POST['counter_number'];

		

		switch($action){

			

			case 'activeAll':

				for($i=1; $i<=$totalRows; $i++){

					

					if((bool)($this->input->post('CB'.$i)) == TRUE){

						$property_id = $this->input->post('CB'.$i);	

						$this->changeStatusALL($property_id, 'YES');

					}

				}

				setMessage('success_message', 'Status updated successfully!');

			break;

			

			case 'inActiveAll':

				for($i=1; $i<=$totalRows; $i++){

					

					if((bool)($this->input->post('CB'.$i)) == TRUE){

						$property_id = $this->input->post('CB'.$i);	

						$this->changeStatusALL($property_id, 'NO');

					}

				}

				setMessage('success_message', 'Status updated successfully!');

			break;

			

			case 'deleteAll':

				for($i=1; $i<=$totalRows; $i++){

					

					if((bool)($this->input->post('CB'.$i)) == TRUE){

						$property_id = $this->input->post('CB'.$i);	

						$this->deleteAll($property_id);
						
						$this->deleteInstitueImage($property_id);
					}

				}

				setMessage('success_message', 'Removed successfully!');

			break;

		}

		

		redirect(base_url().'admin/favourites/index/'.$page, 'refresh');

	}
		

	private function changeStatusALL($property_id, $status){

				

		$updateDbFieldsAry = array('status');

		$updateInfoAry = array($status);

		$this->general_model->updateInfo_Simple($property_id, 'property_id', $updateDbFieldsAry, $updateInfoAry, $this->Table);

		

		$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $property_id, 'changed status', getCurrentDate(), getCurrentTime());		

	}

	

	

	private function deleteAll($agentId){		

			

		if($this->general_model->deleteData($agentId, 'property_id', $this->Table)){

			

			$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed favourites', getCurrentDate(), getCurrentTime());										

		}		

	}

	

	public function changeStatus($property_id, $status, $page){

		

		if($property_id == NULL || $status == NULL || $page == NULL){

			setMessage('error_message', 'Unable to change status, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/favourites', 'refresh');

		}

		

		if($status == 'YES'){

			$newStatus = 'NO';	

		}

		else{

			$newStatus = 'YES';

		}

		

		$updateDbFieldsAry = array('status');

		$updateInfoAry = array($newStatus);

		$this->general_model->updateInfo_Simple($property_id, 'property_id', $updateDbFieldsAry, $updateInfoAry, $this->Table);

		

		$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $property_id, 'changed status', getCurrentDate(), getCurrentTime());

		

		redirect(base_url().'admin/favourites/index/'.$page,'refresh');

	}
}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */