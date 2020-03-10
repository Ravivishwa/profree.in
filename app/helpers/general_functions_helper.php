<?php

function selectLink($link, $selectedLink){
	
	if($link == $selectedLink){
		return  'class="selected"';	
	}
	
	return '';
}

function payment_Status(){
	$CI = & get_instance();
	$user_id = $CI->session->userdata('agentId');
	$payment_plan = $CI->general_model->single_value("user_id = '$user_id' and status = 'YES'", 'plan_id','tbl_user_payment');
	if($payment_plan){
		$payment_name = $CI->general_model->single_value("ID = '$payment_plan' and status = 'YES'", 'title','tbl_payment_options');
		return '<h4 style="padding-left:20px; padding-top:10px;"><img src="'.base_url().'btPublic/html/images/success.png" width="28"/> You have selected <font color="#2B3372"><strong>'.$payment_name.'</strong></font> payment paln.</h4>';
	}
	return '<h4 style="padding-left:20px; padding-top:10px; color:#d20000;"><img src="'.base_url().'btPublic/html/images/fail.png" width="28"/> Please choose one of payment plan to upload properties.</h4>';
}

function payment_plan(){
	$CI = & get_instance();
	$user_id = $CI->session->userdata('agentId');
	$payment_plan = $CI->general_model->single_value("user_id = '$user_id' and status = 'YES'", 'plan_id','tbl_user_payment');
	if($payment_plan){
		return $CI->general_model->single_value("ID = '$payment_plan' and status = 'YES'", 'title','tbl_payment_options');		
	}
	return 'You have not added any payment plan.';
}

function allowed_properties(){
	$CI = & get_instance();
	$user_id = $CI->session->userdata('agentId');
	$payment_plan = $CI->general_model->single_value("user_id = '$user_id' and status = 'YES'", 'plan_id','tbl_user_payment');
	if($payment_plan){
		return $properties = $CI->general_model->single_value("ID = '$payment_plan' and status = 'YES'", 'properties','tbl_payment_options');
	}
}

function remaining_proeprties(){
	$CI = & get_instance();
	$user_id = $CI->session->userdata('agentId');
	return (allowed_properties()-$CI->general_model->total_rows("agentId = '$user_id'", 'property_id', 'tbl_properties_list'));
}

function isPayment(){
	$CI = & get_instance();
	$user_id = $CI->session->userdata('agentId');
	$payment_plan = $CI->general_model->single_value("user_id = '$user_id' and status = 'YES'", 'plan_id','tbl_user_payment');
	if($payment_plan){
		return true;
	}
	return false;
}

function menuLink($link, $selectedLink){
	if($link == $selectedLink){
		return  'class="active"';	
	}
	
	if($link == 'home' && $selectedLink == ''){
		return 'class="active"';
	}
	return '';
}

function selectLinkTop($link, $selectedLink){
	
	if($link == $selectedLink){
		return  'class="active"';	
	}
	
	return '';
}

function filter_value($field_name, $empty_title = ''){
	$CI = & get_instance();
	if($CI->input->post($field_name)){
		return 	$CI->input->post($field_name);
	}
	return $empty_title;
}

function front_end_link($link, $selectedLink){
	if($selectedLink == ''){
		$selectedLink = 'home';	
	}
	if($link == $selectedLink){
		return  'style="color: #4591ed; border:1px solid #4591ed;"';	
	}
	
	return '';
}

function setMessage($MessageID, $Message){
	
	$CI = & get_instance();
		
	$sessData = array($MessageID => $Message);
	$CI->session->set_userdata($sessData);
}

function isSuperAdmin(){
	
	$CI = & get_instance();
	
	if($CI->session->userdata('agentType') == 0){
		return true;
	}
	
	return false;
}

function isLogin(){	
	$CI = & get_instance();	
	if($CI->session->userdata('email') && $CI->session->userdata('pass')){
		return true;
	}	
	return false;
}

function getMessage($MessageID){
	
	$CI = & get_instance();
	$messageData = '';
	if((bool)($CI->session->userdata($MessageID)) == TRUE){
		$messageData = $CI->session->userdata($MessageID);
		$CI->session->unset_userdata($MessageID);
	}
	
	return $messageData;
}


function showStatus($currentStatus){
	
	if($currentStatus == 'YES'){
		return '<img src="'.base_url().'btPublic/admin/images/check.png">Enabled';
	}
	
	return '<img src="'.base_url().'btPublic/admin/images/uncheck.png">Disabled';
}

function showStatusVoucher($currentStatus){
	
	if($currentStatus == 'YES'){
		return '<img src="'.base_url().'btPublic/admin/images/check.png">Approved';
	}
	
	return '<img src="'.base_url().'btPublic/admin/images/uncheck.png">Not Approved';
}


function longitudeLatitude($address){
	
	$key = 'AIzaSyCqUZJSyc4qiqBxVSSZSgu2jC2nxcwEMRA';

	$opt = array (
		'address'	=> urlencode($address) ,
		'output'	=> 'xml' 
	);
	
	$url = 'http://maps.google.com/maps/geo?q='.$opt['address'].'&output='.$opt['output'].'&oe=utf8&key='.$key;
				
	$dom = new DOMDocument();
	$dom->load($url);
		
	$xpath = new DomXPath($dom);
	$xpath->registerNamespace('ge', 'http://earth.google.com/kml/2.0');
		
	$statusCode = $xpath->query('//ge:Status/ge:code');
	
	$INFO = array();
		
	if ($statusCode->item(0)->nodeValue == '200') {
		
		$pointStr = $xpath->query('//ge:coordinates');
		$point = explode(",", $pointStr->item(0)->nodeValue);
		
		$INFO['latitude'] = '';
		$INFO['longitude'] = '';
		
		if($point[1] != ''){			
			$INFO['latitude'] = $point[1];
		}
		
		if($point[1] != ''){			
			$INFO['longitude'] = $point[0];
		}				
	}
	else{
		$INFO['latitude'] = '';
		$INFO['longitude'] = '';
	}
	
	return $INFO;
}


function getCurrentDate(){
	
	date_default_timezone_set('Asia/Karachi');
	
	return date('Y-m-d');
}

function getCurrentTime(){
	
	date_default_timezone_set('Asia/Karachi');
	
	return date('h:i A', time());
}

function getCurrentDateCalendar(){
	
	date_default_timezone_set('Asia/Karachi');
	
	return date('m/d/Y');
}

function changeCalendar($date){
	
	if($date == ''){
		return '';	
	}
	$count = 0;
	$tok = strtok($date, "/");	
	$month = $tok;
	while ($tok !== false) {
		$count++;	
		$tok = strtok("/");
		if($count == 1){
			$day = $tok;	
		}
		else{
			$year = $tok;
			break;	
		}
	}
	return $year.'-'.$month.'-'.$day;
	
}

function changeCalendarDate($date){
	
	if($date == '0000-00-00'){
		return '';	
	}
	$count = 0;
	$tok = strtok($date, "-");	
	$year = $tok;
	while ($tok !== false) {
		$count++;	
		$tok = strtok("-");
		if($count == 1){
			$month = $tok;	
		}
		else{
			$day = $tok;
			break;	
		}
	}
	return $month.'/'.$day.'/'.$year;
	
}


function passportStatus($Type){
	if($Type == 'Received'){
		return '<font color="#FF9900">Received</font>';
	}
	return '<font color="#009900">Delivered</font>';
	
}
function displayDate($date){
	
	$count = 0;
	$tok = strtok($date, "-");	
	$year = $tok;
	while ($tok !== false) {
		$count++;	
		$tok = strtok("-");
		if($count == 1){
			$month = $tok;	
		}
		else{
			$day = $tok;
			break;	
		}
	}	
	
	$month_code = $month;
	switch($month_code){
		case '01':
			$month = 'Janurary';
		break;
		
		case '02':
			$month = 'Feburary';
		break;
		
		case '03':
			$month = 'March';
		break;
		
		case '04':
			$month = 'April';
		break;
		
		case '05':
			$month = 'May';
		break;
		
		case '06':
			$month = 'June';
		break;
		
		case '07':
			$month = 'July';
		break;
		
		case '08':
			$month = 'August';
		break;
		
		case '09':
			$month = 'September';
		break;
		
		case '10':
			$month = 'October';
		break;
		
		case '11':
			$month = 'November';
		break;
		
		case '12':
			$month = 'December';
		break;	
	}
	
	return $day.', '.$month.' '.$year;
	
}

function displayDateShort($date){
	
	$count = 0;
	$tok = strtok($date, "-");	
	$year = $tok;
	while ($tok !== false) {
		$count++;	
		$tok = strtok("-");
		if($count == 1){
			$month = $tok;	
		}
		else{
			$day = $tok;
			break;	
		}
	}	
	
	$month_code = $month;
	switch($month_code){
		case '01':
			$month = 'Jan';
		break;
		
		case '02':
			$month = 'Feb';
		break;
		
		case '03':
			$month = 'Mar';
		break;
		
		case '04':
			$month = 'Apr';
		break;
		
		case '05':
			$month = 'May';
		break;
		
		case '06':
			$month = 'Jun';
		break;
		
		case '07':
			$month = 'Jul';
		break;
		
		case '08':
			$month = 'Aug';
		break;
		
		case '09':
			$month = 'Sep';
		break;
		
		case '10':
			$month = 'Oct';
		break;
		
		case '11':
			$month = 'Nov';
		break;
		
		case '12':
			$month = 'Dec';
		break;	
	}
	
	return $day.', '.$month.' '.$year;
}




function isNumber($Value){
	
	if(preg_match('/^\d+$/',$Value)) {
	  return true;
	} 
	
	return false;
}

function paginationList(){
		
	$CI = & get_instance();	
	$perPage = $CI->session->userdata('recordsPerPage');
	
	$option1 = '';
	$option2 = '';
	$option3 = '';
	$option4 = '';
	$option5 = '';
	
	switch($perPage){
		
		case 20:
			$option1 = 'selected';
		break;
		
		case 50:
			$option2 = 'selected';
		break;
		
		case 100:
			$option3 = 'selected';
		break;
		
		case 200:
			$option4 = 'selected';
		break;
		
		case 500:
			$option5 = 'selected';
		break;
	}
	
	return '
			<select name="records_per_page" id="records_per_page" style="margin:6px 4px 0 0; border: 1px solid #CCCCCC; width: 50px;" onchange="changeRecordsPerPage();">
				<option value="20" '.$option1.'>20</option>
				<option value="50" '.$option2.'>50</option>
				<option value="100" '.$option3.'>100</option>
				<option value="200" '.$option4.'>200</option>
				<option value="500" '.$option5.'>500</option>
			</select>
			<input type="hidden" id="base___URL"  value="'.base_url().'"/>
			';
}

function paginationListFront($controllerName){
		
	$CI = & get_instance();	
	$perPage = $CI->session->userdata('recordsPerPage');
	
	$option1 = '';
	$option2 = '';
	$option3 = '';
	$option4 = '';
	$option5 = '';
	
	switch($perPage){
		
		case 20:
			$option1 = 'selected';
		break;
		
		case 50:
			$option2 = 'selected';
		break;
		
		case 100:
			$option3 = 'selected';
		break;
		
		case 200:
			$option4 = 'selected';
		break;
		
		case 500:
			$option5 = 'selected';
		break;
	}
	
	return '
			<select name="records_per_page" id="records_per_page" style="margin:6px 4px 0 0; border: 1px solid #CCCCCC; width: 50px;" onchange="changeRecordsPerPage();">
				<option value="20" '.$option1.'>20</option>
				<option value="50" '.$option2.'>50</option>
				<option value="100" '.$option3.'>100</option>
				<option value="200" '.$option4.'>200</option>
				<option value="500" '.$option5.'>500</option>
			</select>
			<input type="hidden" id="base___URL"  value="'.base_url().'"/>
			<input type="hidden" id="CONTROLLER_NAME"  value="'.$controllerName.'"/>
			';
}


function Email_Template($mailBody){
	
	$CI = & get_instance();
	
	$emailHeader = '<div style="background:#F1F2F6; width:1000px; height: auto; padding: 10px; color:#374953; font-family: arial,sans-serif;"><a href="'.base_url().'"><img src="'.base_url().'btPublic/html/images/logo.png'.'"></a></div>';
	
	$emailFooter = '<div style="padding:10px; background:#F1F2F6; width:1000px;  color:#374953; font-family: arial,sans-serif;">
						<hr color="#CCCCCC">
						<div align="right"><a href="'.base_url().'">Get2Let.com</a></div>
					</div>';
	
	return $emailHeader.'<div style="padding:10px; background:#F1F2F6;  width:1000px;  color:#374953; font-family: arial,sans-serif;">'.$mailBody.'</div>'.$emailFooter;
}


function shortDescription($string, $numberOfWords, $readMoreLink){
	
	$stringtArray = preg_split('//', $string, -1, PREG_SPLIT_NO_EMPTY);
	
	$arraySize  = sizeof($stringtArray);
	
	$newString = '';
	
	if($arraySize > $numberOfWords){
		
		for($i=0; $i<$numberOfWords; $i++){
			$newString.= $stringtArray[$i];	
		}
		
		return $newString.$readMoreLink;
	}
	
	return $string;
		
}



function initializeImageSettings(){
	
	$CI = & get_instance();
	$imagePath = '../btPublic/bt-uploads/';
	
	$config['upload_path'] = realpath(APPPATH . $imagePath);
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']	= 0;
	$config['max_width']  = 0;
	$config['max_height']  = 0;
	$config['encrypt_name'] = 0;
	$CI->upload->initialize($config);	
}

function initializeFileSettings(){
	
	$CI = & get_instance();
	$imagePath = '../btPublic/bt-uploads/';
	
	$config['upload_path'] = realpath(APPPATH . $imagePath);
	$config['allowed_types'] = 0;
	$config['max_size']	= 0;
	
	$config['encrypt_name'] = 0;
	$CI->upload->initialize($config);	
}


function resize_image($image_name, $new_directory, $newWidth, $newHeight){
	
	$CI = & get_instance();
	$imagePath = '../btPublic/bt-uploads/';
	
	$config_img = array();
	$config_img['image_library'] = 'gd2';
	$config_img['source_image'] = realpath(APPPATH . $imagePath . $image_name);
	
	if($new_directory != ''){
	   $config_img['new_image'] = realpath(APPPATH . $imagePath.$new_directory.'/');
	}
	
	$config_img['maintain_ratio'] = TRUE;
	$config_img['width'] = $newWidth;
	if($newHeight > 0){
		$config_img['height'] = $newHeight;
	}
	
	$config['create_thumb'] = TRUE;
	$config['maintain_ratio'] = TRUE;
	
	$CI->image_lib->initialize($config_img);
	
	if ( ! $CI->image_lib->resize()){
	  return false;
	}
	
	return true;
}

function resize_image_main($image_name, $newWidth, $newHeight){
	
	$CI = & get_instance();
	$imagePath = '../btPublic/bt-uploads/';
	
	$config_img = array();
	$config_img['image_library'] = 'gd2';
	$config_img['source_image'] = realpath(APPPATH . $imagePath . $image_name);
	
	$config_img['new_image'] = realpath(APPPATH . $imagePath.'/');
	
	
	$config_img['maintain_ratio'] = TRUE;
	$config_img['width'] = $newWidth;
	if($newHeight > 0){
		$config_img['height'] = $newHeight;
	}
	
	$config['create_thumb'] = TRUE;
	$config['maintain_ratio'] = TRUE;
	
	$CI->image_lib->initialize($config_img);
	
	if ( ! $CI->image_lib->resize()){
	  return false;
	}
	
	return true;
}


function removeImage($imageName){
	
	$imagePath = '../btPublic/bt-uploads/';
	
	unlink(realpath(APPPATH.$imagePath.'/'.$imageName));
	unlink(realpath(APPPATH.$imagePath.'medium'.'/'.$imageName));
	unlink(realpath(APPPATH.$imagePath.'thumbs'.'/'.$imageName));
}

function removeReportFile($imageName){
	
	$imagePath = '../btPublic/bt-uploads/';
	
	unlink(realpath(APPPATH.$imagePath.'/'.$imageName));
}

function isSelected($pageName, $type){
	
	$returnValue = '';
	
	switch($type){
		
		case 1:
			if($pageName == ''){
				$returnValue = 'id="current"';
			}
		break;	
		
		case 2:
			if($pageName == 'aims-objectives' || $pageName == 'achievements' || $pageName == 'accomplishments' || $pageName == 'assist-sharp'){
				$returnValue = 'id="current"';
			}
		break;	
		
		case 3:
			if($pageName == 'sharp-and-unhcr' || $pageName == 'sharp-and-iscos' || $pageName == 'hv-aids-project' || $pageName == 'child-care-center' || $pageName == 'human-trafficking' || $pageName == 'sharp-actionad' || $pageName == 'AlQanoon-magazine' || $pageName == 'idps-sharp'){
				$returnValue = 'id="current"';
			}
		break;	
		
		case 4:
			if($pageName == 'employee-of-year'){
				$returnValue = 'id="current"';
			}
		break;	
		
		case 5:
			if($pageName == 'reports'){
				$returnValue = 'id="current"';
			}
		break;	
		
		case 6:
			if($pageName == 'vacancy'){
				$returnValue = 'id="current"';
			}
		break;	
		
		case 7:
			if($pageName == 'contact'){
				$returnValue = 'id="current"';
			}
		break;	
	}
	
	return $returnValue;
	
}

function message($text = 'Add / Update Successfull.', $type = 'success'){
	$return_msg = '';
	switch($type){
		case 'error':
			$return_msg = '<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Error!</strong> '.$text.'
							</div>';
		break;
		
		case 'success':
			$return_msg = '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Success!</strong> '.$text.'
							</div>';
		break;
		
		case 'info':
			$return_msg = '<div class="alert alert-info">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Message!</strong> '.$text.'
							</div>';
		break;
		
		case 'warning':
			$return_msg = '<div class="alert">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Warning!</strong> '.$text.'
							</div>	';
		break;	
	}
	return $return_msg;
																														
}

function captcha(){
	$CI = &get_instance();	
	$vals = array(
			'img_path'      => 'btPublic/captcha/',
			'img_url'       => base_url().'btPublic/captcha/',
			'font_path'     => 'btPublic/captcha/fonts/texb.ttf',
			'img_width'     => '200',
			'img_height'    => 40,
			'expiration'    => 10,
			'word_length'   => 5,
			'font_size'     => 32,
			'img_id'        => 'Imageid',
			'pool'          => '0123456789abcdefghijklmnopqrstuvwxyz',        
	);
	$cap = create_captcha($vals);
	$sess_array = array('captcha_text' => trim($cap['word']));
	$CI->session->set_userdata($sess_array);
	return $cap['image'];
}
function captcha_field($className = ''){
	return '<input type="text" name="captcha_field" id="captcha_field" class="'.$className.'" required/>';
}

function captcha_match(){
	$CI = & get_instance();	
	if(trim($CI->input->post('captcha_field')) == $CI->session->userdata('captcha_text')){
		return true;	
	}
	return false;
}

function full_url(){
	$s = &$_SERVER;
	$ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
	$sp = strtolower($s['SERVER_PROTOCOL']);
	$protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
	$port = $s['SERVER_PORT'];
	$port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
	$host =(isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : isset($s['HTTP_HOST'])) ? $s['HTTP_HOST'] : $s['SERVER_NAME'];
	return $protocol . '://' . $host . $port . $s['REQUEST_URI'];
}

function email_signature(){
	$signature = '<br/><br/><b>Thank You</b><br/>
					Team Get2Let.com<br/>
					<a href="'.base_url().'">'.base_url().'</a>	
				';
	return $signature;
}
?>