<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agents extends CI_Controller {

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
	private $pageName = 'agents';
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
	
	public function index(){
		$data['title'] = $this->project_model->projectName().$this->title;
		$data['meta_tags'] = $this->metaTags;		
		$data['keywords'] = $this->keywords;
		$data['details'] = $this->details;		
		$data['page_name'] = $this->pageName;
		$data['heading'] = $this->heading;
		
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
		$config['base_url'] = base_url().'agents/index/';
		$config['total_rows'] = $this->general_model->total_rows("type = '1'", 'ID', 'tbl_agents');
		$data['total_rows'] = $config['total_rows'];
		$config['uri_segment'] = 4;
		$config['per_page'] = 10;
		$data['per_page'] = 10;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['counter'] = $page;
		$data['page'] = $page;
		
		$this->db->select('*');
		$this->db->from('tbl_agents');
		$this->db->where("type = '1'");
		$this->db->limit($config['per_page'], $page);
		$this->db->order_by('name', 'desc');
		$data['QUERY'] = $this->db->get();
		if(!$data['QUERY']->num_rows){
			$this->pageNotFound();	
		}
		$this->load->view('listing_agents', $data);
	}
	
	public function property($agent_id){
		$pdata=explode('-',$agent_id);
		$pdata=array_reverse($pdata);
		$agent_id = ($pdata)?$pdata[0]:$agent_id;
		$agent_id= intval($agent_id);	
		
		$data['title'] = $this->project_model->projectName().$this->title;
		$data['meta_tags'] = $this->metaTags;		
		$data['keywords'] = $this->keywords;
		$data['details'] = $this->details;		
		$data['page_name'] = $this->pageName;
		$data['heading'] = $this->heading;
		
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
		$config['base_url'] = base_url().'agents/property/'.$agent_id.'/';
		$config['total_rows'] = $this->general_model->total_rows("agentId = '$agent_id'", 'property_id', 'tbl_properties_list');
		$data['total_rows'] = $config['total_rows'];
		$config['uri_segment'] = 4;
		$config['per_page'] = 10;
		$data['per_page'] = 10;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['counter'] = $page;
		$data['page'] = $page;
		
		$this->db->select('*');
		$this->db->from('tbl_properties_list');
		$this->db->where("agentId = '$agent_id'");
		$this->db->limit($config['per_page'], $page);
		$this->db->order_by('property_id', 'desc');
		$row = $this->db->get();
		$data['QUERY']=$row;
		/*if(!$data['QUERY']->num_rows){
			$this->pageNotFound();	
		}*/
		
		$data['agent_name'] = $this->general_model->single_value("ID = '$agent_id'", 'name', 'tbl_agents');
		
		$slug= url_title($data['agent_name'], 'dash', true).'-'.$agent_id;

		if($this->uri->segment(3)!=$slug){
			redirect(base_url('agents/property/'.$slug));	
			exit;
		}
		
		
		$this->load->view('property_listing_agents', $data);
	}		
	
	public function contact($agent_id, $property_id){
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
		
		$this->form_validation->set_rules('name', 'Your Name', 'trim|required');
		
		if($this->form_validation->run() === TRUE){
			$agent_info = $this->general_model->fetchDataSingle("ID = '$agent_id'", 'tbl_agents', 0, 0, 'ID', 'asc');
			$this->email->from($data['email'], 'User Contact');
			$this->email->to($agent_info->email);
			$this->email->subject('Get2Let.com :: User Contact');			
			$mailBody = '<b>Hi '.$agent_info->name.',</b><br/>
						One of user has shown interest in your following property.<br/>
						<a href="'.base_url().'property/info/'.$property_id.'">'.base_url().'property/info/'.$property_id.'</a><br/><br/>
						<strong>User Details:</strong><br/>
						<strong>Name </strong>'.$data['name'].'<br/>
						<strong>Email Address:</strong> '.$data['email'].'<br/>
						<strong>Phone:</strong> '.$data['phone'].'<br/>
						<strong>Message:</strong> '.$data['message'].email_signature();
			
			//echo Email_Template($mailBody);exit;
			$this->email->message(Email_Template($mailBody));
			
			$captha_valid = true;
			if(!captcha_match()){
				$captha_valid = true;
				$data['Message'] = message('Invalid verification code.', 'error');
			}
			else{					
				if($this->email->send()){
					$data['Message'] = message('Email sent! You will get response within 24hours.', 'success');
				}
				else{
					$data['Message'] = message('Email not sent! We are unable to process your email. Please try again letter.', 'error');
				}
			}
		}
		
		$this->load->view('contact_agent', $data);	
	}
	
	public function pageNotFound(){
		redirect(base_url(), 'refersh');
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */