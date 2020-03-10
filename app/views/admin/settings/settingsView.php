<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$pageTitle?></title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />
<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>
<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/settings.js"></script>
</head>
<body style="background:#f6f6f6;">
	<?=$this->load->view('admin/header');?>	
<div class="wrapper">
    <?=$this->load->view('admin/left_bar_linksView')?>
    <div class="rightbar">
        	<div class="heading"><?=$heading?></div>
            
            <?php
			$errorMessage = getMessage('error_message');
			$success_message = getMessage('success_message');
			$info_message = getMessage('info_message');
            if($errorMessage != ''){echo '<div class="error_message">'.$errorMessage.'</div>'; }
			if($success_message != ''){echo '<div class="success_message">'.$success_message.'</div>'; }
			if($info_message != ''){echo '<div class="info_message">'.$info_message.'</div>'; }
			?>
                       
            <form action="<?=base_url()?>admin/settings/updateInfoBasic" method="post">             
                <div style="margin-top:15px;">
                	<label class="label1">Project name:</label>
					<br/>
                    <input type="text" name="projectNameAtBackend" id="projectNameAtBackend" class="field2" value="<?=$projectNameAtBackend?>" onclick="clearFieldValue('projectNameAtBackend', 'Enter project name.');" onblur="addFieldValue('projectNameAtBackend', 'Enter project name.')"/>                    
                    <div class="pixel_space2"></div>
                    <label class="label1">Phone:</label><br/>
                    <input type="text" name="phone" id="phone" class="field2" value="<?=$phone?>" />
                    
                    <div class="pixel_space2"></div>
                    <label class="label1">Email address:</label><br/>
                    <input type="text" name="email" id="email" class="field2" value="<?=$email?>" />
                    
                    <div class="pixel_space2"></div>
                    <label class="label1">Fax number:</label><br/>
                    <input type="text" name="fax" id="fax" class="field2" value="<?=$fax?>"/>
                    
                    <div class="pixel_space2"></div>
                    <label class="label1">Default Country:</label><br/>
                    <?php echo $countries_list;?>
                    
                    <div class="pixel_space2"></div>
                    <label class="label1">Currency Symbol:</label><br/>
                    <input type="text" name="currency" id="currency" class="field2" value="<?=$currency?>"/>
                    
                    <div class="pixel_space2"></div>
                    <label class="label1">Currency Code:</label><br/>
                    <input type="text" name="currency_code" id="currency_code" class="field2" value="<?=$currency_code?>"/>

                    <div class="pixel_space2"></div>
                    <label class="label1">Paypal Email:</label><br/>
                    <input type="text" name="paypal_email" id="paypal_email" class="field2" value="<?=$paypal_email?>"/>
                    
                    <div class="pixel_space2"></div>
                    <label class="label1">Paypal Business ID / Marchant ID:</label><br/>
                    <input type="text" name="paypal_business_id" id="paypal_business_id" class="field2" value="<?=$paypal_business_id?>"/>
					
                    <div class="pixel_space2"></div>
                    <label class="label1">Address:</label><br/>
                    <input type="text" name="address" id="address" class="field1" value="<?=$address?>" />
                </div>
                <input type="hidden" name="ID"  value="<?=$ID?>" />
                <input name="btnUpdate" type="submit" value="Update" class="button_1"  />
                <a href="<?=base_url().'admin/dashboard'?>" style="text-decoration:none;"><input type="button" value="Cancel" class="button_1"  /></a>
            </form>
			<!--
                <div style="margin-top:25px;"><h2>Sub administrators permissions: </h2></div>                                             
                
            
            
            
            <!--<div style="margin-top:30px;" class="heading1">Manage Modules:</div>-->
            
            
                                                
        </div>
        <div class="clear"></div>
</div>
<div class="clear"></div>
<?=$this->load->view('admin/footerView')?>
</body>
</html>
