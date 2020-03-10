<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class City extends CI_Controller {

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
	private $pageName = 'city-properties';
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
	
	public function index($city_id){
		$cdata=explode('-',$city_id);
		$cdata=array_reverse($cdata);
		$city_id = ($cdata)?$cdata[0]:$city_id;
		$city_id= intval($city_id);	
		
		$data['title'] = $this->project_model->projectName().$this->title;
		$data['meta_tags'] = $this->metaTags;		
		$data['keywords'] = $this->keywords;
		$data['details'] = $this->details;		
		$data['page_name'] = $this->pageName;
		$cityname=$this->general_model->single_value("ID = '$city_id'", 'name', 'tbl_cities');
		$data['heading'] = 'Properties in <b>'.$cityname.'</b>';
		
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
		$slug= url_title($cityname, 'dash', true).'-'.$city_id;
		$config['base_url'] = base_url().'city/'.$slug.'/';
		$config['total_rows'] = $this->general_model->total_rows("city = '$city_id'", 'property_id', 'tbl_properties_list');
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
		$this->db->where("city = '$city_id'");
		$this->db->limit($config['per_page'], $page);
		$this->db->order_by('property_id', 'desc');
		$data['QUERY'] = $this->db->get();
		if(!$data['QUERY']->num_rows){
			//$this->pageNotFound();	
		}
		
		

		if($this->uri->segment(2)!=$slug){
			redirect(base_url('city/'.$slug));	
			exit;
		}
		
		
		$this->load->view('property_listing', $data);
	}		
	
	public function pageNotFound(){
		redirect(base_url(), 'refersh');
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */