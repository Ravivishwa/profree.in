<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tnsmatpvc extends CI_Controller {
	function __construct(){
		
		parent::__construct();
	}
	
	public function index(){
		$data['heading'] = "TN SMART PVC CARD PRINT";	
		$data['service'] = "TN SMART PVC";	
		$this->load->view('pvcprint/aadharpvc_view',$data);
	}		
	
	public function pageNotFound(){			
		redirect(base_url(), 'refersh');	
	}
}

/* End of file welcome.p620hp */
/* Location: ./application/controllers/welcome.php */