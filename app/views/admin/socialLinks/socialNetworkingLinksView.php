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

                       

            <form action="<?=base_url()?>admin/socialLinks/updateInfoBasic/<?=$ID?>" method="post">             
                <div style="margin-top:15px;">

                	<label class="label1">Facebook:</label>
                    <input type="text" name="facebookLink" id="facebookLink" class="field1" value="<?=$facebookLink?>"/>
                    
                    <br/>
                    
                    <label class="label1">Twitter:</label>
                    <input type="text" name="twitterLink" id="twitterLink" class="field1" value="<?=$twitterLink?>"/>
                    
                    <br/>
                    <label class="label1">LinkedIn:</label>
                    <input type="text" name="linkedinLink" id="linkedinLink" class="field1" value="<?=$linkedinLink?>"/>
                    
                    <label class="label1">Google Plus:</label>
                    <input type="text" name="mySpace" id="mySpace" class="field1" value="<?=$mySpace?>"/>
                    
                     <br/>
                    <label class="label1">Pintrest:</label>
                    <input type="text" name="otherLink1" id="otherLink1" class="field1" value="<?=$otherLink1?>"/>
                    
                     <br/>
                    
                    <input type="hidden" name="otherLink2" id="otherLink2" class="field1" value="<?=$otherLink2?>"/>
                    
                    <input type="hidden" name="otherLink3" id="otherLink3" class="field1" value="<?=$otherLink3?>"/>
                    <br/>
                </div>
                <input type="hidden" name="ID"  value="<?=$ID?>" />
                <div class="pixel_space2"></div>
                <input name="btnUpdate" type="submit" value="Update" class="button_1"  />
                <a href="<?=base_url().'admin/dashboard'?>" style="text-decoration:none;"><input type="button" value="Cancel" class="button_1"  /></a>
            </form>                                                             

                

            

            

            

            <!--<div style="margin-top:30px;" class="heading1">Manage Modules:</div>-->                       

                                                

        </div>

        <div class="clear"></div>

</div>

<div class="clear"></div>

<?=$this->load->view('admin/footerView')?>

</body>

</html>

