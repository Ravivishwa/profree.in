<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Cities extends CI_Controller {



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

	 

	private $Table = 'tbl_cities';

	

	private $sortBy = 'name';

	private $sortType = 'asc';

	private $sortBySession = 'cities_orderBy';

	private $sortTypeSession = 'cities_orderType';

	

	private $SEARCH_SESSION = 'citiesSEARCH_SESS';

	private $searchString = '';

	 
	function __construct(){
		
		parent::__construct();
		
		if(!$this->general_model->isModuleEnabled('cities')){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
	}
	
	public function index()

	{

		$data['pageTitle'] = $this->project_model->projectName().' :: Cities';

		$data['Message'] = '';	

		$data['heading'] = 'Cities';

		$data['pageName'] = 'cities';

		

		$config['base_url'] = base_url().'admin/cities/p/';

		$config['total_rows'] = $this->general_model->getTotalDataSimple('ID', $this->Table);	

		

		$data['sessionSearch'] = $this->SEARCH_SESSION;

		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){

			$data['sessionSearch'] = $this->SEARCH_SESSION;

			$this->searchString = $this->session->userdata($this->SEARCH_SESSION);

			$dbFieldsArray = array('name');			

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

		

		$this->load->view('admin/cities/citiesView', $data);

	}

	

	public function p(){

		

		$data['pageTitle'] = $this->project_model->projectName().' :: Cities';

		$data['Message'] = '';	

		$data['heading'] = 'Cities';

		$data['pageName'] = 'cities';

		

		$config['base_url'] = base_url().'admin/cities/p/';

		$config['total_rows'] = $this->general_model->getTotalDataSimple('ID', $this->Table);

		

		$data['sessionSearch'] = $this->SEARCH_SESSION;

		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){

			$data['sessionSearch'] = $this->SEARCH_SESSION;

			$this->searchString = $this->session->userdata($this->SEARCH_SESSION);

			$dbFieldsArray = array('name');			

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

		

		$this->load->view('admin/cities/citiesView', $data);

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

			redirect(base_url().'admin/cities', 'refresh');

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

		

		redirect(base_url().'admin/cities','refresh');

	}

	

	

	public function add(){

		$data['pageTitle'] = $this->project_model->projectName().' :: Countries : Add city';

		$data['Message'] = '';	

		$data['heading'] = 'Add New City';

		$data['pageName'] = 'cities';

		

		$data['name'] = 'Enter city name.';

		$data['countries'] = $this->general_model->listCountries(0);

		

		if((bool)($this->input->post('btnAddCity')) == TRUE){

						

			$data['name'] = $this->input->post('name');

			$data['countryId'] = $this->input->post('country');

			$data['countries'] = $this->general_model->listCountries($data['countryId']);

			

			$this->form_validation->set_rules('name', 'City Name', 'trim|required');

			$this->form_validation->set_rules('country', 'Country Name', 'trim|required');	

			

			if($this->form_validation->run() === TRUE){

				

				$Lon_Lat = longitudeLatitude($data['name'].' '.$this->general_model->getSingleValue($data['countryId'], 'ID', 'name', 'tbl_countries'));

				$agentId = $this->session->userdata('agentId');

				$Date = getCurrentDate();

				$Time = getCurrentTime();

				

				

				$alreadyExist = $this->general_model->getSingleData_TwoArguments($data['countryId'], 'countryId', $data['name'], 'name', $this->Table);

				if($alreadyExist != '0'){

										

					setMessage('error_message', 'City with same name already exists!');

					redirect(base_url().'admin/cities', 'refresh');	

				}

				

				$DbFieldsAry = array('agentId', 'countryId', 'name', 'longitude', 'latitude', 'date', 'time', 'status');

				$InfoAry = array($agentId, $data['countryId'], $data['name'], $Lon_Lat['longitude'], $Lon_Lat['latitude'],$Date, $Time, 'YES');

				

				if($this->general_model->addInfo_Simple($DbFieldsAry, $InfoAry, $this->Table)){

										

					$activityIdData = $this->general_model->getSingleData_ThreeArguments($data['name'], 'name', $Lon_Lat['latitude'], 'latitude', $Time, 'time', $this->Table);

					if($activityIdData != '0'){

						$activityId	 = $activityIdData->ID;

					}

					

					$this->general_model->addAgentActivity($agentId, $this->Table, $activityId, 'added new city', $Date, $Time);

					

					setMessage('success_message', 'New city added successfully!');

					redirect(base_url().'admin/cities', 'refresh');

				}

				else{

					setMessage('error_message', 'Unable to perofrm this operation, please try again later!');

					redirect(base_url().'admin/cities', 'refresh');	

				}

			}

			else{

				$this->load->view('admin/cities/addCityView', $data);

			}

			

		}

		else{

			$this->load->view('admin/cities/addCityView', $data);

		}

	}

	

	

	public function delete($cityId = NULL, $page = NULL){		

		if($cityId == NULL || $page == NULL){

			setMessage('error_message', 'Unable to delete city, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/cities', 'refresh');

		}

		

		if($this->general_model->getSingleValue($cityId, 'ID', 'ID', $this->Table) > 0 && isNumber($cityId)){

			

			if($this->general_model->deleteData($cityId, 'ID', $this->Table)){
								
				$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $cityId, 'removed city', getCurrentDate(), getCurrentTime());

								

				setMessage('success_message', 'City removed successfully!');

				redirect(base_url().'admin/cities/p/'.$page, 'refresh');

			}

		}

		else{

			

			setMessage('error_message', 'Unable to delete city, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/cities', 'refresh');

		}

		

	}

	

	private function deleteSubTableData($ID, $compareFieldName, $tableName){

		

		$this->general_model->deleteData($ID, $compareFieldName, $tableName);

	}

	

	public function update($ID = NULL, $page = NULL){		

		

		$data['pageTitle'] = $this->project_model->projectName().' :: Countries : Update city';

		$data['Message'] = '';	

		$data['heading'] = 'Update City';

		$data['pageName'] = 'cities';

		

		$data['page'] = $page;

		$data['ID'] = $ID;

			

		$DATA = $this->general_model->getSingleData_Simple($ID, 'ID', $this->Table);

		

		if((bool)($this->input->post('btnUpdateCity')) == TRUE){

			

			$data['countryId'] = $this->input->post('country');

			$data['name'] = $this->input->post('name');

			$data['longitude'] = $this->input->post('longitude');

			$data['latitude'] = $this->input->post('latitude');

			$data['countries'] = $this->general_model->listCountries($data['countryId']);

			

			$this->form_validation->set_rules('name', 'City Name', 'trim|required');	

			$this->form_validation->set_rules('country', 'Country Name', 'trim|required');

			

			if($this->form_validation->run() === TRUE){

				

				$updateDbFieldsAry = array('countryId', 'name', 'longitude', 'latitude');

				$updateInfoAry = array($data['countryId'], $data['name'], $data['longitude'], $data['latitude']);

				

				$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);

				

				$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'updated city', getCurrentDate(), getCurrentTime());

				

				setMessage('success_message', 'City updated successfully!');

				redirect(base_url().'admin/cities/p/'.$page, 'refresh');

			}

			else{

				$this->load->view('admin/cities/editCityView', $data);	

			}

		}

		else{

			$data['countryId'] = $DATA->countryId;

			$data['name'] = $DATA->name;

			$data['longitude'] = $DATA->longitude;

			$data['latitude'] = $DATA->latitude;

			$data['latitude'] = $DATA->latitude;

			$data['countries'] = $this->general_model->listCountries($DATA->countryId);

			

			$this->load->view('admin/cities/editCityView', $data);	

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

		

		redirect(base_url().'admin/cities/p/'.$page, 'refresh');

	}

	

	

	private function changeStatusALL($ID, $status){

				

		$updateDbFieldsAry = array('status');

		$updateInfoAry = array($status);

		$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);

		

		$this->general_model->updateInfo_Simple($ID, 'countryId', $updateDbFieldsAry, $updateInfoAry, 'tbl_cities');

		

		$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'changed status', getCurrentDate(), getCurrentTime());		

	}

	

	

	private function deleteAll($cityId){		

			

		if($this->general_model->deleteData($cityId, 'ID', $this->Table)){

			

			$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $cityId, 'removed city', getCurrentDate(), getCurrentTime());										

		}		

	}

	

	public function changeStatus($ID, $status, $page){

		

		if($ID == NULL || $status == NULL || $page == NULL){

			setMessage('error_message', 'Unable to change status, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/cities', 'refresh');

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

		redirect(base_url().'admin/cities/p/'.$page,'refresh');

	}

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */