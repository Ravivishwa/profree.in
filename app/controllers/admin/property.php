<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends CI_Controller {



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

	 

	private $Table = 'tbl_properties_list';

	

	private $sortBy = 'title';

	private $sortType = 'asc';

	private $sortBySession = 'property_orderBy';

	private $sortTypeSession = 'property_orderType';
	
	private $totalCourses = 0;
	

	private $SEARCH_SESSION = 'propertySEARCH_SESS';

	private $searchString = '';
	private $agent_id = 0;

	/************		Image Processing	******************/
	private $imagePath = '../btPublic/bt-uploads/';
	
	function __construct(){		
		parent::__construct();		
		if(!$this->general_model->isModuleEnabled('property')){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
		if(!isSuperAdmin() && !isPayment()){
			redirect(base_url().'payment', 'refresh');
		}
		$this->agent_id = $this->session->userdata('agentId');
	}
	

	public function index(){
		$data['pageTitle'] = $this->project_model->projectName().' :: Property';
		$data['Message'] = '';
		$data['heading'] = 'Manage Properties';
		$data['pageName'] = 'property';

		
		$config['base_url'] = base_url().'admin/property/index/';
		$config['total_rows'] = $this->general_model->getTotalDataSimple1('property_id', $this->Table);

		
		$data['sessionSearch'] = $this->SEARCH_SESSION;
		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){
			$data['sessionSearch'] = $this->SEARCH_SESSION;
			$this->searchString = $this->session->userdata($this->SEARCH_SESSION);
			$dbFieldsArray = array('property_id', 'title', 'details');	
			$config['total_rows'] = $this->general_model->getTotalDataSingleArgumentSearch1($this->searchString, $dbFieldsArray, 'property_id', $this->Table);		
		}
		$config['uri_segment'] = 4;
		/*$config['per_page'] = $this->session->userdata('recordsPerPage');
		$data['per_page'] = $this->session->userdata('recordsPerPage');*/
		$config['per_page'] = $this->session->userdata('recordsPerPage');
		$data['per_page'] = $this->session->userdata('recordsPerPage');
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['counter'] = $page;
		$data['page'] = $page;
		$data['bgColor'] = '#f4f1f1';
		$data['chkCount'] = 0;
		$sort = $this->getSort();
		$data['QUERY'] = $this->general_model->getAllDataSimple1($this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);
		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){
			$data['QUERY'] = $this->general_model->getAllDataSingleArgumentSEARCH1($this->searchString, $dbFieldsArray, $this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);
		}
		$this->load->view('admin/property/propertyView', $data);
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
			redirect(base_url().'admin/property', 'refresh');
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
		
		redirect(base_url().'admin/property','refresh');
	}	
	
	
	public function add(){
		
		$data['pageTitle'] = $this->project_model->projectName().' :: Property : Add New Property';
		$data['Message'] = '';	
		$data['heading'] = 'Property: Add New Property';
		$data['pageName'] = 'property';
		
		$data['title'] = filter_value('title', '');
		$data['meta_decription'] = filter_value('meta_decription', '');
		$data['keywords'] = filter_value('keywords', '');
		$data['type'] = filter_value('type', '');
		$data['sub_type'] = filter_value('sub_type', '');
		$data['sub_type1'] = filter_value('sub_type1', '');
		$data['bedrooms'] = filter_value('bedrooms', '');
		$data['kitchen'] = filter_value('kitchen', '');
		$data['parking'] = filter_value('parking', 'YES');
		$data['bathrooms'] = filter_value('bathrooms', '');
		$data['area'] = filter_value('area', '');
		$data['price'] = filter_value('price', '0.00');
		$data['location'] = filter_value('location', '');
		$data['city'] = filter_value('city', 82);
		$data['country'] = filter_value('country', 102);
		$data['details'] = filter_value('details', '');
		$data['featured'] = filter_value('featured', 'NO');
		
		$data['countries'] = $this->general_model->listCountries($data['country']);
		$data['cities'] = $this->general_model->listCities($data['country'], $data['city']);
		
		$this->form_validation->set_rules('title', 'Property title', 'trim|required');
		if($this->form_validation->run() === TRUE){
			$agentId = $this->session->userdata('agentId');
			$Date = getCurrentDate();
			$Time = getCurrentTime();
			$DbFieldsAry = array('agentId', 'title', 'meta_decription', 'keywords', 'type', 'sub_type', 'sub_type1', 'bedrooms', 'kitchen', 'parking', 'bathrooms', 'area', 'price', 'location', 'city', 'country', 'details', 'featured', 'date');
			$InfoAry = array($agentId, $data['title'], $data['meta_decription'], $data['keywords'], $data['type'], $data['sub_type'], $data['sub_type1'], $data['bedrooms'], $data['kitchen'], $data['parking'], $data['bathrooms'], $data['area'], $data['price'], $data['location'], $data['city'], $data['country'], $data['details'], $data['featured'], $Date);				
							
			if(!$this->general_model->duplicateEntry('title', $data['title'], 'tbl_properties_list')){				
				if($this->general_model->addInfo_Simple($DbFieldsAry, $InfoAry, $this->Table)){					
					$activityId = $this->general_model->getSingleValue($data['title'], 'title', 'property_id', $this->Table);
					setMessage('success_message', 'New property added successfully. Add pictures to property.');
					redirect(base_url().'admin/property/update/'.$activityId.'/0', 'refresh');
				}
				else{
					setMessage('error_message', 'Unable to perofrm this operation, please try again later!');
					redirect(base_url().'admin/property', 'refresh');	
				}
			}
			else{
				$data['Message'] = 'project with this <font color="#666666">('.$data['name'].')</font> name already exists!';
				$this->load->view('admin/property/addpropertyView', $data);
			}
		}
		
		$data['allowed'] = true;
		$data['warning'] = '';
		
		if(!isSuperAdmin()){
			$total_properties = $this->general_model->getTotalDataSimple1('property_id', $this->Table);
			if(allowed_properties() <= $total_properties){
				$data['allowed'] = false;
				$data['warning'] = 'You have reached to maximum limit of your property upload listing.<br/>Click <a href="'.base_url().'payment">HERE</a> to change payment plan.';
			}
		}
		$this->load->view('admin/property/addpropertyView', $data);
		
	}
			

	

	

	public function delete($agentId = NULL, $page = NULL){		

		if($agentId == NULL || $page == NULL){

			setMessage('error_message', 'Unable to delete Property, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/property', 'refresh');

		}

		

		if($this->general_model->getSingleValue($agentId, 'property_id', 'property_id', $this->Table) > 0 && isNumber($agentId)){

			

			if($this->general_model->deleteData($agentId, 'property_id', $this->Table)){

				$this->deleteInstitueImage($agentId);
				$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed project', getCurrentDate(), getCurrentTime());

								

				setMessage('success_message', 'project removed successfully!');

				redirect(base_url().'admin/property/index/'.$page, 'refresh');

			}

		}

		else{

			

			setMessage('error_message', 'Unable to delete Property, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/property', 'refresh');

		}

		

	}

	
	public function getCurrentPicture($property_id, $page){
		
		$counter = 0;
		$currentPictures = 'No picture available!';
		
		$this->db->select('*');
        $this->db->from('tbl_property_pictures');
		$this->db->where('property_id', $property_id);
		$this->db->where('status', 'YES');
		$this->db->order_by('date', 'DESC');		
        $QUERY = $this->db->get();		
		if($QUERY->num_rows > 0){			
			$currentPictures = '';
			foreach($QUERY->result() as $row){	
				$counter++;
				$currentPictures.= '<div style="float:left; margin:5px; 0px; width:140px; text-align:center;">
									<img src="'.base_url().'btPublic/bt-uploads/thumbs/'.$row->picture.'" width="140" /><br/>
									'.$this->checkPictureStatus($row->ID, $property_id, $page, $row->picture).'									
									</div>';
			}  
		}
		return $currentPictures;
	}
	
	private function checkPictureStatus($ID, $property_id, $page, $picture){
		
		$this->db->select('ID');
        $this->db->from('tbl_property_pictures');
		$this->db->where('ID', $ID);
		$this->db->where('cover', 'YES');
		$this->db->where('status', 'YES');
		
        $QUERY = $this->db->get();
		
		if($QUERY->num_rows > 0){
			
			return '<img src="'.base_url().'btPublic/admin/images/selected.png" style="margin:5px;" title="This is set as cover image!">
					<a href="'.base_url().'admin/property/removePicture/'.$property_id.'/'.$ID.'/'.$page.'/'.urlencode($picture).'/YES"><img src="'.base_url().'btPublic/admin/images/delete.png" style="margin:5px;"></a>
					';
		}
		
		return '<a href="'.base_url().'admin/property/changePictureStatus/'.$property_id.'/'.$ID.'/'.$page.'" title="Click to set as cover image?"><img src="'.base_url().'btPublic/admin/images/not_selected.png" style="margin:5px;" title="Click to set as cover image?"></a>
				<a href="'.base_url().'admin/property/removePicture/'.$property_id.'/'.$ID.'/'.$page.'/'.urlencode($picture).'/NO"><img src="'.base_url().'btPublic/admin/images/delete.png" style="margin:5px;"></a>
				';
	}
	
	public function changePictureStatus($property_id = 0, $pictureId = 0, $page = 0){
		
		$updateDbFieldsAry = array('cover');
		$updateInfoAry = array('NO');											
		$this->general_model->updateInfo_Simple($property_id, 'property_id', $updateDbFieldsAry, $updateInfoAry, 'tbl_property_pictures');
		
		$updateDbFieldsAry = array('cover');
		$updateInfoAry = array('YES');											
		$this->general_model->updateInfo_Simple($pictureId, 'ID', $updateDbFieldsAry, $updateInfoAry, 'tbl_property_pictures');
		
		setMessage('success_message', 'Cover image changed!');
		redirect(base_url().'admin/property/update/'.$property_id.'/'.$page, 'refresh');
	}
	
	private function deleteInstitueImage($property_id){
		
		$this->db->select('*');
        $this->db->from('tbl_property_pictures');
		$this->db->where('property_id', $property_id);
		$this->db->where('status', 'YES');
		$this->db->order_by('date', 'DESC');
		
        $QUERY = $this->db->get();
		
		if($QUERY != '0'){
			
			foreach($QUERY->result() as $row){	
				$picture = $row->picture;
				if($this->general_model->deleteData($row->property_id, 'property_id', 'tbl_property_pictures')){
					if($picture != ''){removeImage($picture);}	
				}
			}
		}
	}
	
	public function update($property_id = NULL, $page = NULL){				

		$data['pageTitle'] = $this->project_model->projectName().' :: Property : Update Property';
		$data['Message'] = '';	
		$data['heading'] = 'Property: Update Property';
		$data['pageName'] = 'property';
		
		$DATA = $this->general_model->getSingleData_Simple($property_id, 'property_id', $this->Table);						
		$data['currentPicture'] = $this->getCurrentPicture($property_id, $page);
		
		$data['page'] = $page;
		$data['property_id'] = $property_id;
		$data['title'] = filter_value('title', $DATA->title);
		$data['meta_decription'] = filter_value('meta_decription', $DATA->meta_decription);
		$data['keywords'] = filter_value('keywords', $DATA->keywords);
		$data['type'] = filter_value('type', $DATA->type);
		$data['sub_type'] = filter_value('sub_type', $DATA->sub_type);
		$data['sub_type1'] = filter_value('sub_type1', $DATA->sub_type1);
		$data['bedrooms'] = filter_value('bedrooms', $DATA->bedrooms);
		$data['kitchen'] = filter_value('kitchen', $DATA->kitchen);
		$data['parking'] = filter_value('parking', $DATA->parking);
		$data['bathrooms'] = filter_value('bathrooms', $DATA->bathrooms);
		$data['area'] = filter_value('area', $DATA->area);
		$data['price'] = filter_value('price', $DATA->price);
		$data['location'] = filter_value('location', $DATA->location);
		$data['city'] = filter_value('city', $DATA->city);
		$data['country'] = filter_value('country', $DATA->country);
		$data['details'] = filter_value('details', $DATA->details);		
		$data['featured'] = filter_value('featured', $DATA->featured);
		
		$data['countries'] = $this->general_model->listCountries($DATA->country);
		$data['cities'] = $this->general_model->listCities($DATA->country, $DATA->city);
		
		$this->form_validation->set_rules('title', 'Property name', 'trim|required');
		$Date = getCurrentDate();			
		if($this->form_validation->run() === TRUE){																
			$DbFieldsAry = array('agentId', 'title', 'meta_decription', 'keywords', 'type', 'sub_type', 'sub_type1', 'bedrooms', 'kitchen', 'parking', 'bathrooms', 'area', 'price', 'location', 'city', 'country', 'details', 'featured', 'date');
			$InfoAry = array($this->agent_id, $data['title'], $data['meta_decription'], $data['keywords'], $data['type'], $data['sub_type'], $data['sub_type1'], $data['bedrooms'], $data['kitchen'], $data['parking'], $data['bathrooms'], $data['area'], $data['price'], $data['location'], $data['city'], $data['country'], $data['details'], $data['featured'], $Date);
			$this->general_model->updateInfo_Simple($property_id, 'property_id', $DbFieldsAry, $InfoAry, $this->Table);					
			$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $property_id, 'updated Property', getCurrentDate(), getCurrentTime());				
			setMessage('success_message', 'Property updated successfully!');
			redirect(base_url().'admin/property/index/'.$page, 'refresh');
		}
		$this->load->view('admin/property/editpropertyView', $data);		
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

		

		redirect(base_url().'admin/property/index/'.$page, 'refresh');

	}
		

	private function changeStatusALL($property_id, $status){

				

		$updateDbFieldsAry = array('status');

		$updateInfoAry = array($status);

		$this->general_model->updateInfo_Simple($property_id, 'property_id', $updateDbFieldsAry, $updateInfoAry, $this->Table);

		

		$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $property_id, 'changed status', getCurrentDate(), getCurrentTime());		

	}

	

	

	private function deleteAll($agentId){		

			

		if($this->general_model->deleteData($agentId, 'property_id', $this->Table)){

			

			$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed property', getCurrentDate(), getCurrentTime());										

		}		

	}

	

	public function changeStatus($property_id, $status, $page){

		

		if($property_id == NULL || $status == NULL || $page == NULL){

			setMessage('error_message', 'Unable to change status, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/property', 'refresh');

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

		

		redirect(base_url().'admin/property/index/'.$page,'refresh');

	}
	
	
	
	public function addPicture($property_id = 0, $page = 0){
		
		for ($k = 0; $k < count($_FILES['userFiles']['name']); $k++) {			
			$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$k];
			$_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$k];
			$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$k];
			$_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$k];
			$_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$k];
			
			initializeImageSettings();
			if ($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
               	$image_name = $fileData['file_name'];				
				
				$pathToImage = base_url().'btPublic/bt-uploads/'.$image_name;
				$IMG__DATA = getimagesize($pathToImage);
				$width = $IMG__DATA[0];
				
				resize_image($image_name, 'medium', 750, 750);
				resize_image($image_name, 'thumbs', 380, 380);
				if($width > 950){
					resize_image_main($image_name, 950, 950);
				}
				$defaultStatus = 'YES';
				if($this->general_model->duplicateEntry('property_id', $property_id, 'tbl_property_pictures')){
					$defaultStatus = 'NO';
				}
				$DbFieldsAry = array('property_id', 'picture', 'date', 'cover', 'status');
				$InfoAry = array($property_id, $image_name, getCurrentDate(), $defaultStatus, 'YES');				
				$this->general_model->addInfo_Simple($DbFieldsAry, $InfoAry, 'tbl_property_pictures');
			}
			else{
				setMessage('error_message', $this->upload->display_errors());
				redirect(base_url().'admin/property/update/'.$property_id.'/'.$page,'refresh');
			}
		}
		setMessage('success_message', 'New picture added successfully!');
		redirect(base_url().'admin/property/update/'.$property_id.'/'.$page,'refresh');		
	}
	
	
	public function removePicture($property_id = 0, $ID, $page = 0, $picture, $default){		
		$picture = urldecode($picture);
		if($this->general_model->deleteData($ID, 'ID', 'tbl_property_pictures')){
			if($picture != ''){removeImage($picture);}	
			setMessage('success_message', 'Picture removed successfully!');
			if($default == 'YES'){
				$newproperty_id = $this->general_model->getSingleValue($property_id, 'property_id', 'ID', 'tbl_property_pictures');
				if($newproperty_id > 0 ){
					$updateDbFieldsAry = array('cover');
					$updateInfoAry = array('YES');
					$this->general_model->updateInfo_Simple($newproperty_id, 'ID', $updateDbFieldsAry, $updateInfoAry, 'tbl_property_pictures');
				}
			}			
			redirect(base_url().'admin/property/update/'.$property_id.'/'.$page,'refresh');			
		}
		else{			
			setMessage('error_message', 'Unable to remove picture, please try again later!');		
			redirect(base_url().'admin/property/update/'.$property_id.'/'.$page,'refresh');	
		}		
	}
	
	public function AddOther_details($KEY){
		$return_value = '';
		
		switch($KEY){
			case 'Homes':
				$return_value = '<option value="Houses">Houses</option>
								<option value="Flats">Flats</option>
								<option value="Upper Portions">Upper Portions</option>
								<option value="Lower Portions">Lower Portions</option>
								<option value="Farm Houses">Farm Houses</option>
								<option value="Rooms">Rooms</option>
								<option value="Penthouse">Penthouse</option>
								<option value="Other">Other</option>';
			break;
			
			case 'Plots':
				$return_value = '<option value="Residential Plots">Residential Plots</option>
								<option value="Commercial Plots">Commercial Plots</option>
								<option value="Agricultural Land">Agricultural Land</option>
								<option value="Industrial Land">Industrial Land</option>
								<option value="Plot Forms">Plot Forms</option>
								<option value="Other">Other</option>';
			break;
			
			case 'Commercial':
				$return_value = '<option value="Offices">Offices</option>
								<option value="Shops">Shops</option>
								<option value="Warehouses">Warehouses</option>
								<option value="Factories">Factories</option>
								<option value="Buildings">Buildings</option>
								<option value="Other">Other</option>';
			break;	
			
			default:
				case 'Homes':
				$return_value = '<option value="Houses">Houses</option>
								<option value="Flats">Flats</option>
								<option value="Upper Portions">Upper Portions</option>
								<option value="Lower Portions">Lower Portions</option>
								<option value="Farm Houses">Farm Houses</option>
								<option value="Rooms">Rooms</option>
								<option value="Penthouse">Penthouse</option>';
				$return_value.= '<option value="Residential Plots">Residential Plots</option>
								<option value="Commercial Plots">Commercial Plots</option>
								<option value="Agricultural Land">Agricultural Land</option>
								<option value="Industrial Land">Industrial Land</option>
								<option value="Plot Forms">Plot Forms</option>';
				$return_value.= '<option value="Offices">Offices</option>
								<option value="Shops">Shops</option>
								<option value="Warehouses">Warehouses</option>
								<option value="Factories">Factories</option>
								<option value="Buildings">Buildings</option>
								<option value="Other">Other</option>';
			break;
		}
		echo $return_value;
	}
}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */