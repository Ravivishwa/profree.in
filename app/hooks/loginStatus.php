<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LoginStatus {

    public function __construct() {
       
    }

    function set_back_from_login() {
        $CI = & get_instance();
       	$segment_1 = $CI->uri->segment(1);
        $segment_2 = $CI->uri->segment(2);
        $segment_3 = $CI->uri->segment(3);
		$segment_4 = $CI->uri->segment(4);
		$segment_5 = $CI->uri->segment(5);
		
		$invalid1 = false;
		$invalid2 = false;
		
		
		/*********		Admin Panel section checking	**********************/		
        if (
				($segment_1 == 'admin' && $segment_2 == "dashboard") || 
				($segment_1 == 'admin' && $segment_2 == "logout") ||
				($segment_1 == 'admin' && $segment_2 == "activity-log") ||
				($segment_1 == 'admin' && $segment_2 == "activityLog") ||
				($segment_1 == 'admin' && $segment_2 == "agents") ||
				($segment_1 == 'admin' && $segment_2 == "property") ||
				($segment_1 == 'admin' && $segment_2 == "favourites") ||
				($segment_1 == 'admin' && $segment_2 == "content") ||
				($segment_1 == 'admin' && $segment_2 == "payment") ||
				($segment_1 == 'admin' && $segment_2 == "pvcpayment") ||
				($segment_1 == 'admin' && $segment_2 == "news") ||
				($segment_1 == 'admin' && $segment_2 == "newsLetters") ||
				($segment_1 == 'admin' && $segment_2 == "fileUpload") ||
				($segment_1 == 'admin' && $segment_2 == "gallery") ||
				($segment_1 == 'admin' && $segment_2 == "faqs") ||
				($segment_1 == 'admin' && $segment_2 == "homeSlider") ||
				($segment_1 == 'admin' && $segment_2 == "testimonials") ||
				($segment_1 == 'admin' && $segment_2 == "socialLinks") ||
				($segment_1 == 'admin' && $segment_2 == "countries") ||
				($segment_1 == 'admin' && $segment_2 == "settings") ||
				($segment_1 == 'admin' && $segment_2 == "cities") ||
				($segment_1 == 'admin' && $segment_2 == "settings")
			)
		{									
			
			$is_member_login = $CI->session->userdata('email');
			$agentType = $CI->session->userdata('agentType');
			if (((bool)($is_member_login) == FALSE) || ($agentType != 0)) {				
				$CI->session->set_userdata('back_from_login', $CI->uri->uri_string);
				$invalid1 = true;	
			}
			
			$ipAddress = $CI->session->userdata('ipAddress');
			$currentIp = $_SERVER['REMOTE_ADDR'];
			if($ipAddress != $currentIp){
				$CI->session->set_userdata('back_from_login', $CI->uri->uri_string);
				$invalid1 = true;
			}			
		}		
		
		if($invalid1){
			$CI->session->sess_destroy();
			redirect(base_url().'admin/login', 'refresh');
		}
    }
}