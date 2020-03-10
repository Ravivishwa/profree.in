<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

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
	private $pageName = 'property-search';
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
	
	public function property(){
		$data['title'] = $this->project_model->projectName().$this->title;
		$data['meta_tags'] = $this->metaTags;		
		$data['keywords'] = $this->keywords;
		$data['details'] = $this->details;		
		$data['page_name'] = $this->pageName;
		$data['heading'] = 'Search Results:';
		
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['counter'] = $page;
		$data['page'] = $page;
		
		$this->db->select('*');
		$this->db->from('tbl_properties_list');		
		
		if($this->input->get('type')){
			$this->db->where("type", $this->input->get('type'));		
		}		
		if($this->input->get('sub_type')){
			if($this->input->get('sub_type') == 'Homes' || $this->input->get('sub_type') == 'Plots' || $this->input->get('Commercial')){
				$this->db->where("sub_type", $this->input->get('sub_type'));
			}
			else{
				$this->db->where("sub_type1", $this->input->get('sub_type'));
			}
		}	
		if($this->input->get('title')){
			$title = $this->input->get('title');
			$this->db->where("title LIKE '%$title%'");
		}	
		if($this->input->get('location')){
			$location = $this->input->get('location');
			$this->db->where("location LIKE '%$location%'");
		}
		if($this->input->get('price_from') && $this->input->get('price_to')){
			$pFrom = $this->input->get('price_from');
			$pTo = $this->input->get('price_to');
			$this->db->where("price BETWEEN '$pFrom' AND '$pTo'");		
		}
		else{
			if($this->input->get('price_from')){
				$pFrom = $this->input->get('price_from');
				$this->db->where("price >= '$pFrom'");
			}
			if($this->input->get('price_to')){
				$pTO = $this->input->get('price_to');
				$this->db->where("price <= '$pTO'");
			}
		}
		
		if($this->input->get('bedrooms')){
			$this->db->where("bedrooms", $this->input->get('bedrooms'));		
		}
		
		if($this->input->get('bathrooms')){
			$this->db->where("bathrooms", $this->input->get('bathrooms'));		
		}
		
		if($this->input->get('area')){
			$area = $this->input->get('area');
			$this->db->where("area LIKE '%$area%'");	
		}		

		$this->db->order_by('property_id', 'desc');
		$data['QUERY'] = $this->db->get();

		$data['total_rows'] = $data['QUERY']->num_rows;
		$this->load->view('property_listing', $data);
	}		
	
	public function pageNotFound(){
		redirect(base_url(), 'refersh');
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */