<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Login extends CI_Controller {



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

	public function index(){
		//echo $this->encrypt->decode('JU2rNoxrSxl1y+bDAqXvZOLQZYe+h2EwXsrDtHJYYbad4bpgz9B4YfKyHYKNJZbvYafyN5Zd371O6VjPR47Hxw==');exit;				
		$data['title'] = $this->project_model->projectName().' :: Login';
		$data['Message'] = '<font color="#666666">Enter email and password!</font>';
		$data['userName'] = '';
		$data['password'] = '';
		if($this->isUserLoggedin()){
			redirect(base_url().'dashboard', 'refersh');
		}
		$isFormSubmitted = $this->input->post('GetUserLogin');

		if((bool)($isFormSubmitted) == TRUE){
			$data['userName'] = $this->input->post('userName');
			$data['password'] = $this->input->post('password');
			if($this->validateUserInfo($data['userName'], $data['password'])){
				if(!isSuperAdmin()){
					redirect(base_url().'dashboard', 'refersh');
				}
				redirect(base_url().'admin/dashboard', 'refersh');								
			}
			$data['Message'] = 'Invalid email address or password!';
		}
		$this->load->view('login_view', $data);
	}

	

	private function validateUserInfo($userName, $password){
		$dbInfo = $this->general_model->getSingleData_Simple($userName, 'email', 'tbl_agents');
		if($dbInfo != '0'){
			$ipAddress = $_SERVER['REMOTE_ADDR'];
			if($this->encrypt->decode($dbInfo->password) == $password && $userName == $dbInfo->email){
				$sessData = array('agentId' => $dbInfo->ID,'userName' => $dbInfo->userName, 'email' => $dbInfo->email, 'pass' => $password, 'ipAddress' => $ipAddress, 'agentType' => $dbInfo->type, 'recordsPerPage' => 20);
				$this->session->set_userdata($sessData);
				return true;
			}
		}
		return false;
	}

	private function isUserLoggedin(){
		if((bool)($this->session->userdata('email')) == TRUE && (bool)($this->session->userdata('pass')) == TRUE){
			$userName = $this->session->userdata('email');
			$password = $this->session->userdata('pass');
			$dbInfo = $this->general_model->getSingleData_Simple($userName, 'email', 'tbl_agents');
			if($this->encrypt->decode($dbInfo->password) == $password && $userName == $dbInfo->email){
				return true;
			}
		}
		return false;
	}
}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */