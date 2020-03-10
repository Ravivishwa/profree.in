<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

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
	private $pageName = 'payment-plans';
	private $requireFieldName = 'pageName';
	private $title = '';
	private $metaTags = '';
	private $details = '';
	private $keywords = '';
	private $heading = '';
	private $current_date = '';
	private $current_time = '';
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
		
		if(!isLogin()){
			redirect(base_url().'admin/login', 'refersh');	
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
		$this->load->view('playment_plan_view', $data);
	}
	
	public function pageNotFound(){
		redirect(base_url(), 'refersh');
	}
	
	public function notify(){
		$item_no            = @$_REQUEST['item_number'];
		$item_transaction   = @$_REQUEST['tx']; // Paypal transaction ID
		$item_price         = @$_REQUEST['amt']; // Paypal received amount
		$item_currency      = @$_REQUEST['cc']; // Paypal received currency type
		$data= json_encode(@$_REQUEST);
		$price = @$_GET['amnt'];
		$uid = @$_GET['uid'];
		$pid = @$_GET['pid'];
		
		//Rechecking the product price and currency details
		//if($item_price==$price && trim($item_currency)!='' && ($item_transaction) != '')
		if($item_transaction!='')
		{
			$DATE = date('Y-m-d');
			$insert = "insert into tbl_user_payment(user_id, plan_id, date, status, data)
						values('$uid', '$pid', '$DATE', 'YES','$data')";
			if(mysqli_query($conId, $insert)){
				echo "success";	
			}	
		}
		else{
				echo "failed";
			}
	}
}
