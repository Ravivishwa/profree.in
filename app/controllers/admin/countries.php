<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Countries extends CI_Controller {



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

		 

	private $Table = 'tbl_countries';

	

	private $sortBy = 'name';

	private $sortType = 'asc';

	private $sortBySession = 'countries_orderBy';

	private $sortTypeSession = 'countries_orderType';

	

	private $SEARCH_SESSION = 'countriesSEARCH_SESS';

	private $searchString = '';

	
	function __construct(){
		
		parent::__construct();
		
		if(!$this->general_model->isModuleEnabled('countries')){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
	}
	
	public function index(){				
		

		$data['pageTitle'] = $this->project_model->projectName().' :: Countries';

		$data['Message'] = '';	

		$data['heading'] = 'Countries';

		$data['pageName'] = 'countries';				

		

		$config['base_url'] = base_url().'admin/countries/';

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

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;	

		if(!isNumber($page)){

			redirect(base_url().'admin/countries', 'refersh');

		}	

		$this->pagination->initialize($config);

		$data['counter'] = $page;

		$data['page'] = $page;

		$data['bgColor'] = '#f4f1f1';

		$data['chkCount'] = 0;		

		

		$sort = $this->getSort();		

		$data['QUERY'] = $this->general_model->getAllDataSimple($this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);

		

		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){						

			$data['QUERY'] = $this->general_model->getAllDataSingleArgumentSEARCH($this->searchString, $dbFieldsArray, $this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);

		}

		

		$this->load->view('admin/countries/countriesView', $data);

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

			redirect(base_url().'admin/countries', 'refresh');

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

		

		redirect(base_url().'admin/countries','refresh');

	}

	

	

	public function changeStatus($ID, $status, $page){

		

		if($ID == NULL || $status == NULL || $page == NULL){

			setMessage('error_message', 'Unable to change status, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/countries', 'refresh');

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

		

		$this->general_model->updateInfo_Simple($ID, 'countryId', $updateDbFieldsAry, $updateInfoAry, 'tbl_cities');

		

		$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'changed country status', getCurrentDate(), getCurrentTime());

		

		redirect(base_url().'admin/countries/'.$page,'refresh');

	}

	

	

	public function add(){

		$data['pageTitle'] = $this->project_model->projectName().' :: Countries : Add country';

		$data['Message'] = '';	

		$data['heading'] = 'Add New Country';

		$data['pageName'] = 'countries';

		

		$data['name'] = 'Enter country name.';

		$data['currency'] = 'Enter country currency code.';

		$data['currencySignature'] = 'Enter country currency signature.';
		
		$data['details'] = '';
		
		$data['displayOnFront'] = 'YES';
		
		$isValid = false;

		if((bool)($this->input->post('btnAddCountry')) == TRUE){

						

			$data['name'] = $this->input->post('name');

			$data['currency'] = $this->input->post('currency');

			$data['currencySignature'] = $this->input->post('currencySignature');
			
			$data['details'] = $this->input->post('details');
		
			$data['displayOnFront'] = $this->input->post('displayOnFront');
			

			$this->form_validation->set_rules('name', 'Country Name', 'trim|required');	

			

			if($this->form_validation->run() === TRUE){

				

				$Lon_Lat = longitudeLatitude($data['name']);

				$agentId = $this->session->userdata('agentId');

				$Date = getCurrentDate();

				$Time = getCurrentTime();
						
				if($this->general_model->getSingleValue($data['name'], 'name', 'ID', $this->Table) > 0){
					
					setMessage('error_message', 'Country with same name already exists!');
					redirect(base_url().'admin/countries', 'refresh');
				}

				
				$image_name = '';
				$isValid = true;
				if (!empty($_FILES['userfile']['name'])){
					
					initializeImageSettings();
					if ($this->upload->do_upload()){
						$img_data = array($this->upload->data());
						$image_name = $img_data[0]['file_name'];							
						resize_image($image_name, 'medium', 500, 500);
						resize_image($image_name, 'thumbs', 111, 111);
					}
					else{
						$error = array($this->upload->display_errors());
						$data['Message'] = $error[0];
						$isValid = false;				
					}	
				}
				
				if($isValid){
					$DbFieldsAry = array('agentId', 'name', 'currency', 'currencySignature', 'longitude', 'latitude', 'picture', 'details', 'displayOnFront', 'date', 'time', 'status');
	
					$InfoAry = array($agentId, $data['name'], $data['currency'], $data['currencySignature'], $Lon_Lat['longitude'], $Lon_Lat['latitude'],$image_name, $data['details'],$data['displayOnFront'], $Date, $Time, 'YES');
	
					
	
					if($this->general_model->addInfo_Simple($DbFieldsAry, $InfoAry, $this->Table)){
	
											
	
						$activityIdData = $this->general_model->getSingleData_ThreeArguments($data['name'], 'name', $Lon_Lat['latitude'], 'latitude', $Time, 'time', $this->Table);
	
						if($activityIdData != '0'){
	
							$activityId	 = $activityIdData->ID;
	
						}
	
						
	
						$this->general_model->addAgentActivity($agentId, $this->Table, $activityId, 'added new country', $Date, $Time);
	
						
	
						setMessage('success_message', 'New country added successfully!');
	
						redirect(base_url().'admin/countries', 'refresh');
	
					}
	
					else{
	
						setMessage('error_message', 'Unable to perofrm this operation, please try again later!');
	
						redirect(base_url().'admin/countries', 'refresh');	
	
					}
				}
				else{
					$this->load->view('admin/countries/addCountryView', $data);	
				}

			}

			else{				
				$this->load->view('admin/countries/addCountryView', $data);

			}

			

		}

		else{

			$this->load->view('admin/countries/addCountryView', $data);

		}

	}

	

	

	public function delete($countryId = NULL, $page = NULL){		

		if($countryId == NULL || $page == NULL){

			setMessage('error_message', 'Unable to delete country, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/countries', 'refresh');

		}

		

		if($this->general_model->getSingleValue($countryId, 'ID', 'ID', $this->Table) > 0 && isNumber($countryId)){

			
			$imageName = $this->general_model->getSingleValue($countryId, 'ID', 'picture', $this->Table);
			if($this->general_model->deleteData($countryId, 'ID', $this->Table) && $this->general_model->deleteData($countryId, 'countryId', 'tbl_cities')){

				if($imageName != ''){removeImage($imageName); }	
				
				$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $countryId, 'removed country', getCurrentDate(), getCurrentTime());

								

				setMessage('success_message', 'Country removed successfully!');

				redirect(base_url().'admin/countries/'.$page, 'refresh');

			}

		}

		else{

			

			setMessage('error_message', 'Unable to delete country, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/countries', 'refresh');

		}

		

	}

	

	

	public function update($ID = NULL, $page = NULL){		

		

		$data['pageTitle'] = $this->project_model->projectName().' :: Countries : Update country';

		$data['Message'] = '';	

		$data['heading'] = 'Update Country';

		$data['pageName'] = 'countries';

		

		$data['page'] = $page;

		$data['ID'] = $ID;
		
		$isValid = false;			

		$DATA = $this->general_model->getSingleData_Simple($ID, 'ID', $this->Table);

		

		if((bool)($this->input->post('btnUpdateCountry')) == TRUE){

			

			$data['name'] = $this->input->post('name');

			$data['currency'] = $this->input->post('currency');

			$data['currencySignature'] = $this->input->post('currencySignature');

			$data['longitude'] = $this->input->post('longitude');

			$data['latitude'] = $this->input->post('latitude');

			$data['details'] = $this->input->post('details');
		
			$data['displayOnFront'] = $this->input->post('displayOnFront');
			$data['picture'] = $this->input->post('picture');
			
			$this->form_validation->set_rules('name', 'Country Name', 'trim|required');	

			

			if($this->form_validation->run() === TRUE){

				
				$image_name = $data['picture'];
				$isValid = true;
				if (!empty($_FILES['userfile']['name'])){
					
					initializeImageSettings();
					if ($this->upload->do_upload()){
						$img_data = array($this->upload->data());
						$image_name = $img_data[0]['file_name'];							
						resize_image($image_name, 'medium', 500, 500);
						resize_image($image_name, 'thumbs', 111, 111);
						
						if($data['picture'] != ''){removeImage($data['picture']);}
					}
					else{
						$error = array($this->upload->display_errors());
						$data['Message'] = $error[0];
						$isValid = false;				
					}	
				}
				
				if($isValid){
					$updateDbFieldsAry = array('name', 'currency', 'currencySignature', 'longitude', 'latitude', 'picture', 'details', 'displayOnFront');
					$updateInfoAry = array($data['name'], $data['currency'], $data['currencySignature'], $data['longitude'], $data['latitude'], $image_name, $data['details'], $data['displayOnFront']);
										
					$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);				
					$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'updated country', getCurrentDate(), getCurrentTime());				
					setMessage('success_message', 'Country updated successfully!');
					redirect(base_url().'admin/countries/'.$page, 'refresh');
				}
				else{
					$this->load->view('admin/countries/editCountryView', $data);
				}

			}

			else{

				$this->load->view('admin/countries/editCountryView', $data);	

			}

		}

		else{

			$data['name'] = $DATA->name;

			$data['currency'] = $DATA->currency;

			$data['currencySignature'] = $DATA->currencySignature;

			$data['longitude'] = $DATA->longitude;

			$data['latitude'] = $DATA->latitude;
			
			$data['details'] = $DATA->details;
		
			$data['displayOnFront'] = $DATA->displayOnFront;				
			
			$data['picture'] = $DATA->picture;
			$this->load->view('admin/countries/editCountryView', $data);	

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
						
						$imageName = $this->general_model->getSingleValue($ID, 'ID', 'picture', $this->Table);
						
						$this->deleteAll($ID);
						
						if($imageName != ''){removeImage($imageName);}
					}

				}

				setMessage('success_message', 'Removed successfully!');

			break;

		}

		

		redirect(base_url().'admin/countries/'.$page, 'refresh');

	}

	

	

	private function changeStatusALL($ID, $status){

				

		$updateDbFieldsAry = array('status');

		$updateInfoAry = array($status);

		$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);

		

		$this->general_model->updateInfo_Simple($ID, 'countryId', $updateDbFieldsAry, $updateInfoAry, 'tbl_cities');

		

		$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'changed country status', getCurrentDate(), getCurrentTime());		

	}

	

	

	private function deleteAll($countryId){		

			

		if($this->general_model->deleteData($countryId, 'ID', $this->Table) && $this->general_model->deleteData($countryId, 'countryId', 'tbl_cities')){

			

			$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $countryId, 'removed country', getCurrentDate(), getCurrentTime());										

		}		

	}

	

	public function currencyCodeSymbols(){

		$data['pageTitle'] = $this->project_model->projectName().' :: Countries : Currency Symbols';

		$data['Message'] = '';	

		$data['heading'] = 'Currency Codes / Symbols';

		$data['pageName'] = 'countries';

		

		$this->load->view('admin/countries/currencySymbol', $data);

	}

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */