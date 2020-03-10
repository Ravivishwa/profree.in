<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=$pageTitle?></title>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />



<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>

</head>



<body style="background:#f6f6f6;">

	<?=$this->load->view('admin/header');?>	

<div class="wrapper">

    <?=$this->load->view('admin/left_bar_linksView')?>

    <div class="rightbar">

        	<div class="heading" style="float:left;"><?=$heading?></div>

            <div style="float:right; padding-top:20px;">

            	<a href="<?=base_url().'admin/testimonials/p/'.$page?>" class="top_link"><img src="<?=base_url()?>btPublic/admin/images/icons-big/back.png" width="24" height="24" />Back to testimonials</a>

            </div>

            <div class="clear"></div>                        

            

            <form action="<?=base_url().'admin/testimonials/update/'.$ID.'/'.$page?>" method="post" onsubmit="return validateInfo();">

            	<label>Name: </label>
                <div class="clear"></div>
            	<label style="color:#666"><?=$name?></label>
               	<div class="pixel_space3"></div>
                <div class="clear"></div> 
                
                <label>Email Address: </label>
                <div class="clear"></div>
            	<label style="color:#666"><?=$email?></label>
               	<div class="pixel_space3"></div>
                <div class="clear"></div>                                                  

               	<label>Details: </label>
                <div class="clear"></div>
            	<div style="color:#666; text-align:justify;" ><?=$details?></div>
               	<div class="pixel_space3"></div>
                <div class="clear"></div>                                  

                <a href="<?=base_url().'admin/testimonials/p/'.$page?>" style="text-decoration:none;"><input type="button" value="Back to testimonials" class="button_1"  /></a>

                <div class="clear"></div>

                <div class="pixel_space3"></div>

            </form>

            

        </div>

        <div class="clear"></div>

</div>

<div class="clear"></div>

<?=$this->load->view('admin/footerView')?>

</body>

</html>

