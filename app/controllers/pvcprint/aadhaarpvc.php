<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aadhaarpvc extends CI_Controller {
	 
	private $table = 'tbl_content';
	private $pageName = 'contact-us';
	private $requireFieldName = 'pageName';
	private $title = '';
	private $metaTags = '';
	private $details = '';
	private $keywords = '';
	private $heading = '';
	function __construct(){
		
		parent::__construct();
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
	}
	
	public function index(){
		$data['title'] = $this->project_model->projectName().$this->title;
		$data['meta_tags'] = $this->metaTags;		
		$data['keywords'] = $this->keywords;
		$data['details'] = $this->details;		
		$data['page_name'] = $this->pageName;
		$data['heading'] = $this->heading;	
		$data['Message'] = '';
		
		$data['name'] = filter_value('name', '');
		$data['phone'] = filter_value('phone', '');
		$data['email'] = filter_value('email', '');
		$data['message'] = filter_value('message', '');
		$this->load->view('pvcprint/aadharpvc_view');
	}		
	
	public function pageNotFound(){			
		redirect(base_url(), 'refersh');	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */