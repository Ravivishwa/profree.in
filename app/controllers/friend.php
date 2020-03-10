<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friend extends CI_Controller {

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
	private $pageName = 'email-friend';
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
	
	
	public function email($property_id){
		$data['title'] = $this->project_model->projectName().$this->title;
		$data['meta_tags'] = $this->metaTags;		
		$data['keywords'] = $this->keywords;
		$data['details'] = $this->details;		
		$data['page_name'] = $this->pageName;
		$data['heading'] = $this->heading;
		$data['Message'] = '';
		
		$data['name'] = filter_value('name', '');
		$data['email'] = filter_value('email', '');
		$data['your_email'] = filter_value('your_email', $this->session->userdata('email'));
		$data['message'] = filter_value('message', '');
		
		$this->form_validation->set_rules('name', 'Your Name', 'trim|required');
		
		if($this->form_validation->run() === TRUE){
			$this->email->from($data['your_email'], 'Friend Sharing');
			$this->email->to($data['email']);
			$this->email->subject('Get2Let.com :: Property Sahred by Friend.');			
			$mailBody = '<b>Hi '.$data['name'].',</b><br/>
						One of your friend has shared following property.<br/>
						<a href="'.base_url().'property/info/'.$property_id.'">'.base_url().'property/info/'.$property_id.'</a><br/><br/>
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
		
		$this->load->view('contact_friend', $data);	
	}
	
	public function pageNotFound(){
		redirect(base_url(), 'refersh');
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */