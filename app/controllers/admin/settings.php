<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();
		
		if(!$this->general_model->isModuleEnabled('settings')){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
	}
		
	public function index()
	{
		$data['pageTitle'] = $this->project_model->projectName().' :: Settings';		
		$data['heading'] = 'Manage Project General Settings:';
		$data['pageName'] = 'settings';
		
		$data['ID'] = 0;
		$data['projectNameAtBackend'] = 'Enter project name.';		
		
		$DATA_INFO = $this->general_model->getSingleData_Simple_No_comparison('tbl_settings');
		$data['countries_list'] = $this->general_model->listCountries($DATA_INFO->site_country_id);
		if($DATA_INFO != '0'){
			$data['ID'] = $DATA_INFO->ID;
			
			$data['projectNameAtBackend'] = $DATA_INFO->projectNameAtBackend;			
			$data['address'] = $DATA_INFO->address;
			$data['phone'] = $DATA_INFO->phone;
			$data['email'] = $DATA_INFO->email;
			$data['fax'] = $DATA_INFO->fax;			
			$data['links'] = $DATA_INFO->links;
			$data['news'] = $DATA_INFO->news;
			$data['content'] = $DATA_INFO->content;
			$data['portfolio'] = $DATA_INFO->portfolio;
			$data['institutes'] = $DATA_INFO->institutes;
			$data['courses'] = $DATA_INFO->courses;
			$data['students'] = $DATA_INFO->students;
			$data['socialLinks'] = $DATA_INFO->socialLinks;
			$data['newsLetters'] = $DATA_INFO->newsLetters;
			$data['gallery'] = $DATA_INFO->gallery;
			$data['agentsActivity'] = $DATA_INFO->agentsActivity;
			$data['faqs'] = $DATA_INFO->faqs;
			$data['testimonials'] = $DATA_INFO->testimonials;
			
			$data['currency'] = $DATA_INFO->currency;
			$data['currency_code'] = $DATA_INFO->currency_code;
			$data['paypal_email'] = $DATA_INFO->paypal_email;
			$data['paypal_business_id'] = $DATA_INFO->paypal_business_id;
		}
		
		$this->load->view('admin/settings/settingsView', $data);
	}
	
	
	public function updateModuleInfo($ID, $newValue, $oldValue){
		
		$DATA = $this->general_model->getSingleData_Simple_No_comparison('tbl_settings');
		
		if($DATA != '0'){
			
			$dbFieldsAry = array($ID);
			$infoAry = array($newValue);
			
			if($this->general_model->updateInfo_Simple($oldValue, $ID, $dbFieldsAry, $infoAry, 'tbl_settings')){
				
				if($newValue == 'YES'){
					setMessage('success_message', 'Another module activated for sub admins!');
				}
				else{
					setMessage('success_message', 'Module deactivated!');	
				}
				
			
				redirect(base_url().'admin/settings', 'refresh');		
			}
		}
		else{
			
			setMessage('error_message', 'You need to set project name before updating module section!');
			
			redirect(base_url().'admin/settings', 'refresh');
		}
	}
	
	public function updateInfoBasic(){
		
		$projectNameAtBackend = $this->input->post('projectNameAtBackend');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$fax = $this->input->post('fax');
		
		$data['currency'] = $this->input->post('currency');
		$data['currency_code'] = $this->input->post('currency_code');
		$data['site_country_id'] = $this->input->post('country');
		$data['paypal_email'] = $this->input->post('paypal_email');
		$data['paypal_business_id'] = $this->input->post('paypal_business_id');
			//print_r($data); exit;
		$ID = $this->input->post('ID');
				
		if($projectNameAtBackend != '' && $projectNameAtBackend != 'Enter project name.'){
														
				$dbFieldsAry = array('projectNameAtBackend', 'address', 'phone', 'email', 'fax', 'currency', 'currency_code', 'paypal_email', 'paypal_business_id','site_country_id');
				$infoAry = array($projectNameAtBackend, $address, $phone, $email, $fax, $data['currency'], $data['currency_code'], $data['paypal_email'], $data['paypal_business_id'],$data['site_country_id']);
				if($this->general_model->updateInfo_Simple($ID, 'ID', $dbFieldsAry, $infoAry, 'tbl_settings')){										
					setMessage('success_message', 'Project info updated successfully!');			
					redirect(base_url().'admin/settings', 'refresh');	
				}
				else{				
					setMessage('error_message', 'Unable to add project name, please try again later!');			
					redirect(base_url().'admin/settings', 'refresh');	
				}
		}
		else{
			
			setMessage('error_message', 'you have not entered project name!');			
			redirect(base_url().'admin/settings', 'refresh');
		}
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */