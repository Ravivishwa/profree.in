<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pmjaypvc extends CI_Controller {
	function __construct(){
		
		parent::__construct();
	}
	
	public function index(){
		$data['heading'] = "PMJAY PVC CARD PRINT";	
		$data['service'] = "PMJAY PVC";	
		$this->load->view('pvcprint/aadharpvc_view',$data);
	}	
	
	public function pageNotFound(){			
		redirect(base_url(), 'refersh');	
	}
}

/* End of file welcome.p620hp */
/* Location: ./application/controllers/welcome.php */