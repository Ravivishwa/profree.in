<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General extends CI_Controller {

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
	public function chnageRecordsPerPage($controllerName, $recordsPerPage){
				
		$perPage = array('recordsPerPage' => $recordsPerPage);
		
		$this->session->set_userdata($perPage);
		
		redirect(base_url().'admin/'.$controllerName, 'refresh');
	}
	
	public function chnageRecordsPerPageReports($controllerName, $functionName, $recordsPerPage){
				
		$perPage = array('recordsPerPage' => $recordsPerPage);
		
		$this->session->set_userdata($perPage);
		
		redirect(base_url().'admin/'.$controllerName.'/'.$functionName, 'refresh');
	}
	
	
	public function SearchDATA($controllerName){
						
		$searchValue = $this->input->get('SEARCH_DTA');
		
		$sessionName = $controllerName.'SEARCH_SESS';
				
		$sessSet = array($sessionName=>$searchValue);	
		$this->session->set_userdata($sessSet);	
		
		redirect(base_url().'admin/'.$controllerName, 'refresh');
	}
	
	
	public function SearchDATA_PS(){
		
		$PS_DATE = $this->input->get('PS_DATE');
		$PS_Party_Code = $this->input->get('PS_Party_Code');
		$PS_Type_SRCH = $this->input->get('PS_Type_SRCH');
		
		$sessSet = array('PS_SEARCH_DATA'=> 'YES', 'PS_DATE'=>$PS_DATE, 'PS_Party_Code'=>$PS_Party_Code, 'PS_Type_SRCH'=>$PS_Type_SRCH);		;
		$this->session->set_userdata($sessSet);	
		
		redirect(base_url().'admin/passportStatus', 'refresh');
	}
	
	public function ClearSearchDATA_PS(){
		
		
		$this->session->unset_userdata('PS_SEARCH_DATA');
		$this->session->unset_userdata('PS_DATE');
		$this->session->unset_userdata('PS_Party_Code');
		$this->session->unset_userdata('PS_Type_SRCH');
		
		redirect(base_url().'admin/passportStatus', 'refresh');
	}
	
	public function clearSearchDATA($controllerName){
		
		$sessionName = $controllerName.'SEARCH_SESS';
		
		$this->session->unset_userdata($sessionName);
		
		redirect(base_url().'admin/'.$controllerName, 'refresh');
	}
	
	
	public function SearchDATA_REPORTS($controllerName, $functionName){
				
		$searchValue = $this->input->post('SEARCH_DTA');		
		$sessionName = $controllerName.$functionName.'SEARCH_SESS';
		
		$searchDate1 = $this->input->post('DATE1');		
		$sessionNameD1 = $controllerName.$functionName.'DATE1';
		
		$searchDate2 = $this->input->post('DATE2');		
		$sessionNameD2 = $controllerName.$functionName.'DATE2';
				
		$sessSet = array($sessionName=>$searchValue, $sessionNameD1=>$searchDate1, $sessionNameD2=>$searchDate2);	
		
		$this->session->set_userdata($sessSet);	
		
		redirect(base_url().'admin/'.$controllerName.'/'.$functionName, 'refresh');
	}
	
	public function clearSearchReportDATA($controllerName, $functionName){
		
		$sessionName = $controllerName.$functionName.'SEARCH_SESS';		
		$sessionNameD1 = $controllerName.$functionName.'DATE1';
		$sessionNameD2 = $controllerName.$functionName.'DATE2';
		
		$this->session->unset_userdata($sessionName);
		$this->session->unset_userdata($sessionNameD1);
		$this->session->unset_userdata($sessionNameD2);
		
		redirect(base_url().'admin/'.$controllerName.'/'.$functionName, 'refresh');
	}
	
	function showCitiesList($countryId){
		
		echo $this->general_model->listCities($countryId, 0);		
	}

	public function LoadCalendarFiles_Search(){
				
		$currentDataCalendar = getCurrentDateCalendar();
		$calendarEndLimit = date('Y');
		$calendarStartLimit = ($calendarEndLimit-70);
		?>
		<script>
            $(function() {		
                $(function() {
                    $( "#SEARCH_DTA" ).datepicker({
                        changeYear: true,
                        changeMonth: true,
                        dateFormat: 'yy-mm-dd',
                        yearRange: '<?=$calendarStartLimit?>:<?=$calendarEndLimit?>',
                        maxDate: '<?=$currentDataCalendar?>'
                    });
                });				
            });
        </script>
        <?php		
	}
	
	
	public function sendEmailContactForm(){
		
		$redirectURL = $this->input->post('redirectURL');
		
		$this->email->from($this->input->post('email'), 'User Enquiry');
		$this->email->to($this->general_model->getSingleValue(1, 'ID', 'email', 'tbl_settings')); 
		
		$this->email->subject('SHARP :: Contact');
		
		$mailBody = '<strong>User Details</strong><br/><strong>Name </strong>'.$this->input->post('name').'<br/><strong>Email Address:</strong> '.$this->input->post('email').'<br/><strong>Message:</strong> '.$this->input->post('message');
		
		
		$this->email->message(Email_Template($mailBody));					
				
		if($this->email->send()){		
			setMessage('success_message', 'Email sent! You will get response within 24hours.');
			redirect($redirectURL, 'refresh');
		}
		else{
			setMessage('error_message', 'Email not sent! We are unable to process your email. Please try again letter.');
			redirect($redirectURL, 'refresh');
		}
	}
	
	public function sendSiteForm(){
		
		$redirectURL = $this->input->post('redirectURL');
		
		$this->email->from($this->input->post('email'), 'User Enquiry');
		$this->email->to($this->general_model->getSingleValue(1, 'ID', 'email', 'tbl_settings')); 
		
		$this->email->subject('MNS Advertising :: Site Booking Form');
		
		$mailBody = '<strong>User Details</strong><br/><strong>Name </strong>'.$this->input->post('name').'<br/><strong>Email Address:</strong> '.$this->input->post('email').'<br/><strong>Mobile:</strong> '.$this->input->post('mobile').'<br/><strong>Telephone:</strong> '.$this->input->post('telephone').'<br/><strong>Company Name:</strong> '.$this->input->post('cname').'<br/><strong>Reference Number:</strong> '.$this->input->post('ref_number');
		
		echo Email_Template($mailBody);exit;
		$this->email->message(Email_Template($mailBody));					
				
		if($this->email->send()){		
			setMessage('success_message', 'Email sent! You will get response within 24hours.');
			redirect($redirectURL, 'refresh');
		}
		else{
			setMessage('error_message', 'Email not sent! We are unable to process your email. Please try again letter.');
			redirect($redirectURL, 'refresh');
		}
	}
	
	public function recoverPassword(){
		
		$data['pageTitle'] = $this->project_model->projectName().' :: Recover Password';
		$data['email'] = '';
		$data['Message'] = '<font color="#666666">Password Recovery</font>';
		
		if((bool)($this->input->post('RecoverPassword')) == TRUE){
			
			$data['email'] = $this->input->post('email');			
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			
			if($this->form_validation->run() === TRUE){
				
				if($this->general_model->getSingleValue($data['email'], 'email', 'email', 'tbl_agents') != '0'){
					
					
					$this->email->from($this->general_model->getSingleValue(1, 'ID', 'email', 'tbl_agents'), 'Password Recovery');					
					$this->email->to($data['email']);					
					$this->email->subject($this->project_model->projectName().' :: Password Recovery');
					
					$mailBody = '<strong>Your Login Info Details</strong><br/><strong>User name </strong>'.$this->general_model->getSingleValue($data['email'], 'email', 'userName', 'tbl_agents').'<br/><strong>Password:</strong> '.$this->encrypt->decode($this->general_model->getSingleValue($data['email'], 'email', 'password', 'tbl_agents')).'<br/><br/><a href="'.base_url().'admin/login">'.base_url().'login</a>';
					
					
					$this->email->message(Email_Template($mailBody));					
							
					if($this->email->send()){		
						$data['Message'] = '<font color="#00CC33">Password sent on your email.</font>';
					}
				}
				else{
					$data['Message'] = 'This email address is not registered with us.';
				}
				
				$this->load->view('admin/recoverPassword_view', $data);
			}
			else{
				
				$data['Message'] = 'Invalid email address!';
				$this->load->view('admin/recoverPassword_view', $data);
			}
		}
		else{
			$this->load->view('admin/recoverPassword_view', $data);	
		}
		
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */