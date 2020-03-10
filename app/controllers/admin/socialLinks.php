<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class SocialLinks extends CI_Controller {



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
	
	function __construct(){
		
		parent::__construct();
		
		if(!$this->general_model->isModuleEnabled('socialLinks')){
			redirect(base_url().'admin/dashboard', 'refresh');
		}
	}
		
	public function index()

	{

		$data['pageTitle'] = $this->project_model->projectName().' :: Social Links';		

		$data['heading'] = 'Social Links:';

		$data['pageName'] = 'socialLinks';

		

		$DATA_INFO = $this->general_model->getSingleData_Simple_No_comparison('tbl_sociallinks');

		if($DATA_INFO != '0'){
			$data['ID'] = $DATA_INFO->ID;
			
			$data['facebookLink'] = $DATA_INFO->facebookLink;
			$data['twitterLink'] = $DATA_INFO->twitterLink;
			$data['linkedinLink'] = $DATA_INFO->linkedinLink;
			$data['mySpace'] = $DATA_INFO->mySpace;
			$data['otherLink1'] = $DATA_INFO->otherLink1;
			$data['otherLink2'] = $DATA_INFO->otherLink2;
			$data['otherLink3'] = $DATA_INFO->otherLink3;
		}

		

		$this->load->view('admin/socialLinks/socialNetworkingLinksView', $data);

	}			

	

	public function updateInfoBasic($ID){
																
		$dbFieldsAry = array('facebookLink', 'twitterLink', 'linkedinLink', 'mySpace', 'otherLink1', 'otherLink2', 'otherLink3');

		$infoAry = array($this->input->post('facebookLink'), $this->input->post('twitterLink'), $this->input->post('linkedinLink'), $this->input->post('mySpace'), $this->input->post('otherLink1'), $this->input->post('otherLink2'), $this->input->post('otherLink3'));
		

		if($this->general_model->updateInfo_Simple($ID, 'ID', $dbFieldsAry, $infoAry, 'tbl_sociallinks')){										
			setMessage('success_message', 'Social links updated successfully!');			
			redirect(base_url().'admin/socialLinks', 'refresh');	
		}
		else{				
			setMessage('error_message', 'Unable to update social link, please try again later!');			
			redirect(base_url().'admin/socialLinks', 'refresh');	
		}

	}

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */