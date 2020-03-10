<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Gallery extends CI_Controller {



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

	 

	private $Table = 'tbl_gallery';

	private $imagePath = '../btPublic/bt-uploads/';

	private $sortBy = 'name';

	private $sortType = 'asc';

	private $sortBySession = 'gallery_orderBy';

	private $sortTypeSession = 'gallery_orderType';

	

	private $SEARCH_SESSION = 'gallerySEARCH_SESS';

	private $searchString = '';

	function __construct(){
		
		parent::__construct();
		
		if(!$this->general_model->isModuleEnabled('gallery')){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
	}
	 

	public function index()

	{

		$data['pageTitle'] = $this->project_model->projectName().' :: gallery';

		$data['Message'] = '';	

		$data['heading'] = 'Portfolio';

		$data['pageName'] = 'gallery';

		

		$config['base_url'] = base_url().'admin/gallery/p/';

		$config['total_rows'] = $this->general_model->getTotalDataSimple('ID', $this->Table);

		

		$data['sessionSearch'] = $this->SEARCH_SESSION;

		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){

			$data['sessionSearch'] = $this->SEARCH_SESSION;

			$this->searchString = $this->session->userdata($this->SEARCH_SESSION);

			$dbFieldsArray = array('title', 'description');			

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

		

		$this->load->view('admin/gallery/galleryView', $data);

	}

	

	public function p(){

		

		$data['pageTitle'] = $this->project_model->projectName().' :: gallery';

		$data['Message'] = '';	

		$data['heading'] = 'Portfolio';

		$data['pageName'] = 'gallery';

		

		$config['base_url'] = base_url().'admin/gallery/p/';

		$config['total_rows'] = $this->general_model->getTotalDataSimple('ID', $this->Table);

		

		$data['sessionSearch'] = $this->SEARCH_SESSION;

		if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){

			$data['sessionSearch'] = $this->SEARCH_SESSION;

			$this->searchString = $this->session->userdata($this->SEARCH_SESSION);

			$dbFieldsArray = array('title', 'description');		

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

		

		$this->load->view('admin/gallery/galleryView', $data);

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

			redirect(base_url().'admin/gallery', 'refresh');

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

		

		redirect(base_url().'admin/gallery','refresh');

	}

	

	

	public function addImageDetails($galleryId){

		

	}

	

	

	public function add($galleryId = 0){

		

		$data['pageTitle'] = $this->project_model->projectName().' :: Add Portfolio';

		$data['Message'] = '';	

		$data['heading'] = 'Add Portfolio';

		if($galleryId > 0){

			$data['heading'] = 'Add Photos in gallery';

		}

		$data['pageName'] = 'gallery';

		$data['galleryId'] = $galleryId;

		

		$data['name'] = 'Enter Gallery Title / Category.';

		

		if((bool)($this->input->post('btnAddgallery')) == TRUE){

					

			$data['name'] = $this->input->post('name');

			

			$this->form_validation->set_rules('name', 'Portfolio title', 'trim|required|callback_isGalleryNameAvailable');							

			

			if($this->form_validation->run() === TRUE){

												

				$agentId = $this->session->userdata('agentId');

				$Date = getCurrentDate();

				$Time = getCurrentTime();

				$DbFieldsAry = array('name', 'agentId', 'date', 'status');

				$InfoAry = array($data['name'], $agentId, $Date, 'YES');

								

				if($this->general_model->addInfo_Simple($DbFieldsAry, $InfoAry, $this->Table)){

										

					$activityId = $this->general_model->getSingleValue($data['name'], 'name', 'ID', $this->Table);

					

					$this->general_model->addAgentActivity($agentId, $this->Table, $activityId, 'added new Portfolio', $Date, $Time);

					

					setMessage('success_message', 'New Portfolio added successfully!');

					redirect(base_url().'admin/gallery/add/'.$activityId, 'refresh');

				}

				else{

					setMessage('error_message', 'Unable to perofrm this operation, please try again later!');

					redirect(base_url().'admin/gallery', 'refresh');	

				}

			}

			else{

				$this->load->view('admin/gallery/addgalleryView', $data);

			}

			

		}

		else{

			

			$this->load->view('admin/gallery/addgalleryView', $data);

		}

	}

	

	

	public function updatePhoto($photoID = 0){

		

		$data['pageTitle'] = $this->project_model->projectName().' :: Update Portfolio';

		$data['Message'] = '';	

		$data['heading'] = 'Update Photo';

		$data['pageName'] = 'gallery';

		

		$data['photoId'] = $photoID;

		$data['galleryId'] = $this->general_model->getSingleValue($photoID, 'ID', 'galleryId', 'tbl_gallery_images');

		$data['imageName'] = $this->general_model->getSingleValue($photoID, 'ID', 'imageName', 'tbl_gallery_images');

		$data['imageTitle'] = $this->general_model->getSingleValue($photoID, 'ID', 'imageTitle', 'tbl_gallery_images');

		$data['imageDescription'] = $this->general_model->getSingleValue($photoID, 'ID', 'imageDescription', 'tbl_gallery_images');

		$this->load->view('admin/gallery/updatePhotoView', $data);

	}

			



	public function isGalleryNameAvailable($name){

		

		if($this->general_model->duplicateEntry('name', $name, $this->Table)){

			 $this->form_validation->set_message('isGalleryNameAvailable', 'Portfolio with same title already exists!');

			return false;

		}

		return true;

	}

	

	public function delete($agentId = NULL, $page = NULL){		

		if($agentId == NULL || $page == NULL){

			setMessage('error_message', 'Unable to delete gallery, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/gallery', 'refresh');

		}

		

		if($this->general_model->getSingleValue($agentId, 'ID', 'ID', $this->Table) > 0 && isNumber($agentId)){

			

			

			if($this->general_model->deleteData($agentId, 'ID', $this->Table)){

				$this->deleteGalleryPhotos($agentId);

				

				$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed gallery', getCurrentDate(), getCurrentTime());

								

				setMessage('success_message', 'gallery removed successfully!');

				redirect(base_url().'admin/gallery/p/'.$page, 'refresh');

			}

		}

		else{

			

			setMessage('error_message', 'Unable to delete gallery, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/gallery', 'refresh');

		}

		

	}

	

	private function deleteGalleryPhotos($galleryId){

		

		$imageQuery = $this->general_model->getAllDataSingleArgument($galleryId, 'galleryId', 'tbl_gallery_images', '', '', 'ID', 'ASC') ;

		

		if((bool)($imageQuery) == TRUE){

			

			foreach($imageQuery->result() as $imageInfo){

				

				$imageId = $imageInfo->ID;

				$imageName = $imageInfo->imageName;

				

				if($this->general_model->deleteData($imageId, 'ID', 'tbl_gallery_images')){

					unlink(realpath(APPPATH.$this->imagePath.'/'.$imageName));

					unlink(realpath(APPPATH.$this->imagePath.'medium'.'/'.$imageName));

					unlink(realpath(APPPATH.$this->imagePath.'thumbs'.'/'.$imageName));

				}

			}

		}

		

	}

	

	public function update($ID = NULL, $page = NULL){		

		

		$data['pageTitle'] = $this->project_model->projectName().' :: gallery : Update Page gallery';

		$data['Message'] = '';	

		$data['heading'] = 'Update gallery';

		$data['pageName'] = 'gallery';

		

		$data['page'] = $page;

		$data['ID'] = $ID;

			

		$DATA = $this->general_model->getSingleData_Simple($ID, 'ID', $this->Table);

		

		if((bool)($this->input->post('btnUpdategallery')) == TRUE){

			

			$data['name'] = $this->input->post('name');

			

			$this->form_validation->set_rules('name', 'Gallery title', 'trim|required');		

						

			if($this->form_validation->run() === TRUE){																

				

				$updateDbFieldsAry = array('name', 'agentId');

				$updateInfoAry = array($data['name'], $this->session->userdata('agentId'));

				

				$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);			

				

				$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'updated gallery', getCurrentDate(), getCurrentTime());

				

				setMessage('success_message', 'Page gallery updated successfully!');

				redirect(base_url().'admin/gallery/p/'.$page, 'refresh');				

			}

			else{

				$this->load->view('admin/gallery/editgalleryView', $data);

			}

		}

		else{		

			$data['name'] = $DATA->name;		

			$this->load->view('admin/gallery/editgalleryView', $data);	

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

						$this->deleteGalleryPhotos($ID);

					}

				}

				setMessage('success_message', 'Removed successfully!');

			break;

		}

		

		redirect(base_url().'admin/gallery/p/'.$page, 'refresh');

	}

	

	

	private function changeStatusALL($ID, $status){

				

		$updateDbFieldsAry = array('status');

		$updateInfoAry = array($status);

		$this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);

		

		$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'changed status', getCurrentDate(), getCurrentTime());		

	}

	

	

	private function deleteAll($agentId){		

			

		if($this->general_model->deleteData($agentId, 'ID', $this->Table)){

			

			$this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed gallery', getCurrentDate(), getCurrentTime());										

		}		

	}

	

	public function changeStatus($ID, $status, $page){

		

		if($ID == NULL || $status == NULL || $page == NULL){

			setMessage('error_message', 'Unable to change status, something went wrong from your side. Please try again later with proper procedure!');

			redirect(base_url().'admin/gallery', 'refresh');

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

		

		redirect(base_url().'admin/gallery/p/'.$page,'refresh');

	}

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */