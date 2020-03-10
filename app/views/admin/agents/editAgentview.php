<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=$pageTitle?></title>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />



<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/venders/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/agents.js"></script>

</head>



<body style="background:#f6f6f6;">

	<?=$this->load->view('admin/header');?>	

<div class="wrapper">

    <?=$this->load->view('admin/left_bar_linksView')?>

    <div class="rightbar">

        	<div class="heading" style="float:left;"><?=$heading?></div>

            <div style="float:right; padding-top:20px;">

            	<a href="<?=base_url().'admin/agents/p/'.$page?>" class="top_link"><img src="<?=base_url()?>btPublic/admin/images/icons-big/back.png" width="24" height="24" />Back to agents</a>

            </div>

            <div class="clear"></div>            

            <form action="<?=base_url().'admin/agents/update/'.$ID.'/'.$page?>" method="post" onsubmit="return validateInfo();" enctype="multipart/form-data">
                            

                <div class="clear"></div>

            	<input type="text" name="name" id="name" class="field2" value="<?=$name?>" onkeypress="claerMessage();" onclick="clearFieldValue('name', 'Enter agent name.');" onblur="addFieldValue('name', 'Enter agent name.')"  autocomplete = "off"/>

                <?php echo form_error('name', '<div class="error" id="nameError">', '</div>');?>

               	<div class="pixel_space3"></div>

                

                <label>User name: *</label>

                <div class="clear"></div>

            	<input type="text" name="userName" id="userName" class="field2" value="<?=$userName?>" onkeypress="claerMessage();" onclick="clearFieldValue('userName', 'Enter user name.');" onblur="addFieldValue('userName', 'Enter user name.')" autocomplete = "off" readonly="readonly"/>

                <?php echo form_error('userName', '<div class="error" id="userNameError">', '</div>');?>

               	<div class="pixel_space3"></div>

                

                

                <label>Password: *</label>

                <div class="clear"></div>

            	<input type="password" name="password" id="password" class="field2" value="<?=$password?>"   autocomplete = "off"/>

                <?php echo form_error('password', '<div class="error" id="passwordError">', '</div>');?>

               	<div class="pixel_space3"></div>

                

                

                <label>Confirm Password: *</label>

                <div class="clear"></div>

            	<input type="password" name="Cpassword" id="Cpassword" class="field2" value="<?=$Cpassword?>"  autocomplete = "off"/>

                <?php echo form_error('Cpassword', '<div class="error" id="CpasswordError">', '</div>');?>

               	<div class="pixel_space3"></div>

                

                

                <label>Email Address: *</label>

                <div class="clear"></div>

            	<input type="text" name="email" id="email" class="field2" value="<?=$email?>" onkeypress="claerMessage();" onclick="clearFieldValue('email', 'Enter email address.');" onblur="addFieldValue('email', 'Enter email address.')"  autocomplete = "off"/>

                <?php echo form_error('email', '<div class="error" id="emailError">', '</div>');?>

               	<div class="pixel_space3"></div>                                                  

                      

                    <label>Phone #: </label>

                    <div class="clear"></div>

                    <input type="text" name="phone" id="phone" class="field2" value="<?=$phone?>" onkeypress="claerMessage();" onclick="clearFieldValue('phone', 'Enter phone number.');" onblur="addFieldValue('phone', 'Enter phone number.')"  autocomplete = "off"/>

                    <div class="pixel_space3"></div>

                    

                    <label>Address: </label>

                    <div class="clear"></div>

                    <input type="text" name="address" id="address" class="field2" value="<?=$address?>" onkeypress="claerMessage();" onclick="clearFieldValue('address', 'Enter address.');" onblur="addFieldValue('address', 'Enter address.')"  autocomplete = "off"/>

                    <div class="pixel_space3"></div>
                    <div class="clear"></div>

              		<?php
					if(isSuperAdmin()){
						?>
                        <label>Featured: </label>&nbsp;
                    	YES <input type="radio" name="featured" id="featured" value="YES" <?php if($featured == 'YES') echo 'checked';?>/>&nbsp; &nbsp;
                        NO <input type="radio" name="featured" id="featured" value="NO" <?php if($featured == 'NO') echo 'checked';?>/>
                    	<div class="pixel_space3"></div>
                        <div class="clear"></div>
                        <?php
					}
					else{
						echo '<input type="hidden" name="featured" id="featured" value="'.$featured.'"/>';
					}
					?>

                    
                    <label>Picture: <?php if(trim($picture) != ''){ echo '<img src="'.base_url().'btPublic/bt-uploads/thumbs/'.$picture.'" /> </label>';}?>
                    <div class="clear"></div>
                    <input type="file" name="userfile" id="userfile" class="field2"  />
                    <?php echo form_error('userfile', '<div class="error" id="userfileError">', '</div>');?>
                    <div class="pixel_space3"></div>
                    <div class="clear"></div>
                                    
                    <input type="hidden" name="picture" value="<?=$picture?>" />
                

                    <label>Country: </label>

                    <div class="clear"></div>

                    <?=$countries?>

                    <div class="pixel_space3"></div>

                    

                    

                    <label>City: </label>

                    <div class="clear"></div>

                    <div id="cities_view">

                        <?=$cities?>

                    </div>

                    <div class="pixel_space3"></div>
               
                <input name="btnUpdateAgent" type="submit" value="Update agent" class="button_1"  />

                <a href="<?=base_url().'admin/agents/p/'.$page?>" style="text-decoration:none;"><input type="button" value="Cancel" class="button_1"  /></a>

                <div class="pixel_space4"></div>

            </form>

            

        </div>

        <div class="clear"></div>

</div>

<div class="clear"></div>

<?=$this->load->view('admin/footerView')?>

</body>

</html>