<?php

function send_mail($Subject, $mail_body, $from, $to){
	
	$headers = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	$headers .= "From: ".$from."\r\n"; 
	//$headers .= "CC: info@binarytracks.com\r\n"; 
	//$headers .= "BCC: info@binarytracks.com\r\n"; 	
	if(mail($to, $Subject, $mail_body, $headers)){
		return true;	
	}
	else
		return false;
}
?>