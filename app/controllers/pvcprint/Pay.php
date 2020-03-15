<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pay extends CI_Controller {
	 
	private $table = 'tbl_pvcpayment_options';
	private $requireFieldName = 'title';
	private $title = '';
	private $metaTags = '';
	private $details = '';
	private $keywords = '';
	private $heading = '';
	function __construct(){
		
		parent::__construct();
		$ContentData = $this->general_model->getAllDataSingleArgument($this->input->get('p'), $this->requireFieldName, $this->table, '', '', 'ID', 'ASC');
		if((bool)($ContentData) != '0'){
			foreach($ContentData->result() as $DATA){
				$this->agentId = $DATA->agentId; 
				$this->price = $DATA->price;
				$this->tax = $DATA->tax;
				$this->others = $DATA->others;				
				$this->total = $DATA->total;				
			}
		}
	}
	
	public function index(){
		$data['agentId'] = $this->agentId;		
		$data['tax'] = $this->tax;
		$data['others'] = $this->others;		
		$data['price'] = $this->price;		
		$data['total'] = $this->total;
		$data['service'] =$this->input->get('p');
		$this->load->view('pvcprint/pay_view',$data);
	}		
	
	public function pageNotFound(){			
		redirect(base_url(), 'refersh');	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */