
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
	 
	private $table = 'tbl_content';
	private $pageName = 'property';
	private $requireFieldName = 'pageName';
	private $title = '';
	private $metaTags = '';
	private $details = '';
	private $keywords = '';
	private $heading = '';
	private $current_date = '';
	private $current_time = '';
	private $search_keyword = '';
	function __construct(){
		
		parent::__construct();
	    $this->load->library('session');
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
	
	public function index($searchby, $page=0){
		$data['title'] = $this->project_model->projectName().$this->title;
		$data['meta_tags'] = $this->metaTags;		
		$data['keywords'] = $this->keywords;
		$data['details'] = $this->details;		
		$data['page_name'] = $this->pageName;
		$data['heading'] = 'Properties '.$searchby;
		
		$config = array(
					'num_links' => 2,
					'use_page_numbers'	=>	FALSE,
					'full_tag_open' => '<ul class="pagination">',
					'full_tag_close' => '</ul>',
					'first_link' => 'First',
					'first_tag_open' => '<li>',
					'first_tag_close' => '</li>',
					'last_tag_open' => '<li>',
					'last_tag_close' => '</li>',
					'next_link' => '<span aria-hidden="true">&raquo;</span>',
					'next_tag_open' => '<li>',
					'next_tag_close' => '</li>',
					'prev_link' => '<span aria-hidden="true">&laquo;</span>',
					'prev_tag_open' => '<li>',
					'prev_tag_close' => '</i>',
					'cur_tag_open' => '<li><a  style="background:#E7E7E7;">',
					'cur_tag_close' => '</a></li>',
					'num_tag_open' => '<li>',
					'num_tag_close' => '</li>'
				);
		$config['base_url'] = base_url().'property/'.$searchby.'/';
		$config['total_rows'] = $this->general_model->total_rows("type = '$searchby' or sub_type = '$searchby'", 'property_id', 'tbl_properties_list');
		$data['total_rows'] = $config['total_rows'];
		$config['uri_segment'] = 3;
		$config['per_page'] = 10;
		$data['per_page'] = 10;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['counter'] = $page;
		$data['page'] = $page;
		
		$this->db->select('*');
		$this->db->from('tbl_properties_list');
		$this->db->where("type = '$searchby' or sub_type = '$searchby'");
		$this->db->limit($config['per_page'], $page);
		$this->db->order_by('property_id', 'desc');
		$data['QUERY'] = $this->db->get();
		$this->load->view('property_listing', $data);
	}
	
	public function user_listing(){
		$agentId = $this->session->userdata('agentId');
		if(!$agentId){
			redirect(base_url().'login', 'refresh');	
		}
		$data['title'] = $this->project_model->projectName().$this->title;
		$data['meta_tags'] = $this->metaTags;		
		$data['keywords'] = $this->keywords;
		$data['details'] = $this->details;		
		$data['page_name'] = $this->pageName;
		$data['heading'] = 'Properties by '.$this->session->userdata('userName');
		
		$config = array(
					'num_links' => 2,
					'use_page_numbers'	=>	FALSE,
					'full_tag_open' => '<ul class="pagination">',
					'full_tag_close' => '</ul>',
					'first_link' => 'First',
					'first_tag_open' => '<li>',
					'first_tag_close' => '</li>',
					'last_tag_open' => '<li>',
					'last_tag_close' => '</li>',
					'next_link' => '<span aria-hidden="true">&raquo;</span>',
					'next_tag_open' => '<li>',
					'next_tag_close' => '</li>',
					'prev_link' => '<span aria-hidden="true">&laquo;</span>',
					'prev_tag_open' => '<li>',
					'prev_tag_close' => '</i>',
					'cur_tag_open' => '<li><a  style="background:#E7E7E7;">',
					'cur_tag_close' => '</a></li>',
					'num_tag_open' => '<li>',
					'num_tag_close' => '</li>'
				);
		$config['base_url'] = base_url().'property/user_listing/';
		$config['total_rows'] = $this->general_model->total_rows("agentId = '$agentId' and status = 'YES'", 'property_id', 'tbl_properties_list');
		$data['total_rows'] = $config['total_rows'];
		$config['uri_segment'] = 3;
		$config['per_page'] = 10;
		$data['per_page'] = 10;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['counter'] = $page;
		$data['page'] = $page;
		
		$this->db->select('*');
		$this->db->from('tbl_properties_list');
		$this->db->where("agentId = '$agentId' and status = 'YES'");
		$this->db->limit($config['per_page'], $page);
		$this->db->order_by('property_id', 'desc');
		$data['QUERY'] = $this->db->get();
		$this->load->view('user_property_listing', $data);
	}
	
	public function add(){
		
		
		
		$this->load->library('session');
		
		if(isset($_POST['submit'])){
		    $this->session->set_userdata(json_decode($_POST['sessionTxt']),true);
		    
		}


		
		
		$agentId = $this->session->userdata('agentId');
		
	
		if(!$agentId){
			redirect(base_url().'login', 'refresh');	
			die();
		}
		if(!isSuperAdmin() && !isPayment()){
			redirect(base_url().'payment', 'refresh');
		}
		
		$data['p_title'] = $this->project_model->projectName().' :: Property : Add New Property';
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
		$data['country'] = filter_value('country', 109);
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
									
			if($this->general_model->addInfo_Simple($DbFieldsAry, $InfoAry, 'tbl_properties_list')){					
				$activityId = $this->general_model->getSingleValue($data['title'], 'title', 'property_id', 'tbl_properties_list');
				setMessage('success_message', 'New property added successfully. Add pictures to property.');
				redirect(base_url().'property/update/'.$activityId.'/0', 'refresh');
			}
			else{
				setMessage('error_message', 'Unable to perofrm this operation, please try again later!');
				redirect(base_url().'property/user_listing', 'refresh');	
			}
			
		}
		
		$data['allowed'] = true;
		$data['warning'] = '';
		
		if(!isSuperAdmin()){
			$total_properties = $this->general_model->getTotalDataSimple1('property_id','tbl_properties_list');
			if(allowed_properties() <= $total_properties){
				$data['allowed'] = false;
				$data['warning'] = '<br/>You have reached to maximum limit of your property upload listing.<br/>Click <a href="'.base_url().'payment">HERE</a> to change payment plan.<br/><br/><br/><br/><br/>';
			}
		}
		$this->load->view('add_property', $data);
		
	}
	
	public function update($property_id = NULL, $page = NULL){				
		$agentId = $this->session->userdata('agentId');
		$pid = $this->general_model->single_value("property_id = '$property_id' and agentId = '$agentId'", 'property_id', 'tbl_properties_list');
		if(!$agentId){
			redirect(base_url().'login', 'refresh');	
		}
		if($property_id != $pid){
			setMessage('error_message', 'You can not update this property!');
			redirect(base_url().'property/user_listing', 'refresh');	
		}
		
		$data['p_title'] = $this->project_model->projectName().' :: Property : Update Property';
		$data['Message'] = '';	
		$data['heading'] = 'Property: Update Property';
		$data['pageName'] = 'property';
		
		$DATA = $this->general_model->getSingleData_Simple($property_id, 'property_id', 'tbl_properties_list');						
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
			$InfoAry = array($agentId, $data['title'], $data['meta_decription'], $data['keywords'], $data['type'], $data['sub_type'], $data['sub_type1'], $data['bedrooms'], $data['kitchen'], $data['parking'], $data['bathrooms'], $data['area'], $data['price'], $data['location'], $data['city'], $data['country'], $data['details'], $data['featured'], $Date);
			$this->general_model->updateInfo_Simple($property_id, 'property_id', $DbFieldsAry, $InfoAry, 'tbl_properties_list');					
			$this->general_model->addAgentActivity($this->session->userdata('agentId'), 'tbl_properties_list', $property_id, 'updated Property', getCurrentDate(), getCurrentTime());				
			setMessage('success_message', 'Property updated successfully!');
			redirect(base_url().'property/user_listing/'.$page, 'refresh');
		}
		$this->load->view('editpropertyView', $data);		
	}
	
	public function delete($agentId = NULL, $page = NULL){		
		
		$agentId1 = $this->session->userdata('agentId');
		
		$pid = $this->general_model->single_value("property_id = '$agentId' and agentId = '$agentId1'", 'property_id', 'tbl_properties_list');
		if(!$agentId1){
			redirect(base_url().'login', 'refresh');	
		}
		
		if($agentId != $pid){
			setMessage('error_message', 'You can not update this property!');
			redirect(base_url().'property/user_listing', 'refresh');	
		}		
		if($agentId == NULL || $page == NULL){
			setMessage('error_message', 'Unable to delete Property, something went wrong from your side. Please try again later with proper procedure!');
			redirect(base_url().'property/user_listing', 'refresh');
		}

		if($this->general_model->getSingleValue($agentId, 'property_id', 'property_id', 'tbl_properties_list') > 0 && isNumber($agentId)){
			if($this->general_model->deleteData($agentId, 'property_id', 'tbl_properties_list')){
				$this->deleteInstitueImage($agentId);				
				setMessage('success_message', 'Property removed successfully!');
				redirect(base_url().'property/user_listing/'.$page, 'refresh');
			}
		}
		else{
			setMessage('error_message', 'Unable to delete Property, something went wrong from your side. Please try again later with proper procedure!');
			redirect(base_url().'property/user_listing', 'refresh');
		}
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
				redirect(base_url().'property/update/'.$property_id.'/'.$page,'refresh');
			}
		}
		setMessage('success_message', 'New picture added successfully!');
		redirect(base_url().'property/update/'.$property_id.'/'.$page,'refresh');		
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
					<a href="'.base_url().'property/removePicture/'.$property_id.'/'.$ID.'/'.$page.'/'.urlencode($picture).'/YES"><img src="'.base_url().'btPublic/admin/images/delete.png" style="margin:5px;"></a>
					';
		}
		
		return '<a href="'.base_url().'property/changePictureStatus/'.$property_id.'/'.$ID.'/'.$page.'" title="Click to set as cover image?"><img src="'.base_url().'btPublic/admin/images/not_selected.png" style="margin:5px;" title="Click to set as cover image?"></a>
				<a href="'.base_url().'property/removePicture/'.$property_id.'/'.$ID.'/'.$page.'/'.urlencode($picture).'/NO"><img src="'.base_url().'btPublic/admin/images/delete.png" style="margin:5px;"></a>
				';
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
			redirect(base_url().'property/update/'.$property_id.'/'.$page,'refresh');			
		}
		else{			
			setMessage('error_message', 'Unable to remove picture, please try again later!');		
			redirect(base_url().'property/update/'.$property_id.'/'.$page,'refresh');	
		}		
	}
	
	public function changePictureStatus($property_id = 0, $pictureId = 0, $page = 0){
		
		$updateDbFieldsAry = array('cover');
		$updateInfoAry = array('NO');											
		$this->general_model->updateInfo_Simple($property_id, 'property_id', $updateDbFieldsAry, $updateInfoAry, 'tbl_property_pictures');
		
		$updateDbFieldsAry = array('cover');
		$updateInfoAry = array('YES');											
		$this->general_model->updateInfo_Simple($pictureId, 'ID', $updateDbFieldsAry, $updateInfoAry, 'tbl_property_pictures');
		
		setMessage('success_message', 'Cover image changed!');
		redirect(base_url().'property/update/'.$property_id.'/'.$page, 'refresh');
	}
	
	public function featured(){
		$data['title'] = $this->project_model->projectName().$this->title;
		$data['meta_tags'] = $this->metaTags;		
		$data['keywords'] = $this->keywords;
		$data['details'] = $this->details;		
		$data['page_name'] = $this->pageName;
		$data['heading'] = 'Featured Properties';
		
		$config = array(
					'num_links' => 2,
					'use_page_numbers'	=>	FALSE,
					'full_tag_open' => '<ul class="pagination">',
					'full_tag_close' => '</ul>',
					'first_link' => 'First',
					'first_tag_open' => '<li>',
					'first_tag_close' => '</li>',
					'last_tag_open' => '<li>',
					'last_tag_close' => '</li>',
					'next_link' => '<span aria-hidden="true">&raquo;</span>',
					'next_tag_open' => '<li>',
					'next_tag_close' => '</li>',
					'prev_link' => '<span aria-hidden="true">&laquo;</span>',
					'prev_tag_open' => '<li>',
					'prev_tag_close' => '</i>',
					'cur_tag_open' => '<li><a  style="background:#E7E7E7;">',
					'cur_tag_close' => '</a></li>',
					'num_tag_open' => '<li>',
					'num_tag_close' => '</li>'
				);
		$config['base_url'] = base_url().'property/featured/';
		$config['total_rows'] = $this->general_model->total_rows("featured = 'YES' and status = 'YES'", 'property_id', 'tbl_properties_list');
		$data['total_rows'] = $config['total_rows'];
		$config['uri_segment'] = 3;
		$config['per_page'] = 10;
		$data['per_page'] = 10;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['counter'] = $page;
		$data['page'] = $page;
		
		$this->db->select('*');
		$this->db->from('tbl_properties_list');
		$this->db->where("featured = 'YES' and status = 'YES'");
		$this->db->limit($config['per_page'], $page);
		$this->db->order_by('property_id', 'desc');
		$data['QUERY'] = $this->db->get();
		$this->load->view('property_listing', $data);	
	}
	public function info($property_id, $agent_fav_id = 0){
		$pdata=explode('-',$property_id);
		$pdata=array_reverse($pdata);
		$property_id = ($pdata)?$pdata[0]:$property_id;
		$property_id= intval($property_id);	
		$data['title'] = $this->project_model->projectName().$this->title;
		$data['meta_tags'] = $this->metaTags;		
		$data['keywords'] = $this->keywords;
		$data['details'] = $this->details;		
		$data['page_name'] = $this->pageName;
		$data['heading'] = $this->heading;
		
		$this->db->select('*');
		$this->db->from('tbl_properties_list');
		$this->db->where("property_id = '$property_id'");
		$row = $this->db->get()->row();
		$data['QUERY'] = $row;
		$slug= url_title($row->title, 'dash', true).'-'.$row->property_id;

		if($this->uri->segment(3)!=$slug){
			redirect(base_url('property/info/'.$slug));	
			exit;
		}
		
		$data['favourite'] = '<li><a href="'.base_url().'property/info/'.$data['QUERY']->property_id.'/'.$this->session->userdata('agentId').'"><i class="fa fa-heart"></i> Save to favourites</a></li>';
		if($agent_fav_id){
			$new_fav_property = true;
			$DbFieldsAry = array('property_id', 'user_id', 'Date', 'status');
			$InfoAry = array($property_id, $agent_fav_id, $this->current_date, 'YES');
			if($this->general_model->single_value("property_id = '$property_id' and user_id = '$agent_fav_id'", 'ID', 'tbl_favourites')){
				$data['favourite'] = message('This Property already present in your Favourites list.','info');
				$new_fav_property = false;
			}
			
			if($new_fav_property){
				if($this->general_model->addInfo_Simple($DbFieldsAry, $InfoAry, 'tbl_favourites')){
					$data['favourite'] = message('','success');
				}
			}
		}		
		$data['cover_picture'] = $this->cover_picture($property_id);
		$data['pictures'] = $this->general_model->fetchDataAll("property_id = '$property_id' and cover = 'NO'", 'tbl_property_pictures', 0, 0, 'ID', 'Desc');
		$this->load->view('property_details', $data);
	}
	
	private function cover_picture($property_id){
		return $this->general_model->single_value("property_id = '$property_id' and cover = 'YES'", 'picture', 'tbl_property_pictures');	
	}
	public function pageNotFound(){
		redirect(base_url(), 'refersh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */