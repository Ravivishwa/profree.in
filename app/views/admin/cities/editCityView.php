<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$pageTitle?></title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>
<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/cities.js"></script>
</head>

<body style="background:#f6f6f6;">
	<?=$this->load->view('admin/header');?>	
<div class="wrapper">
    <?=$this->load->view('admin/left_bar_linksView')?>
    <div class="rightbar">
        	<div class="heading" style="float:left;"><?=$heading?></div>
            <div style="float:right; padding-top:20px;">
            	<a href="<?=base_url().'admin/cities/p/'.$page?>" class="top_link"><img src="<?=base_url()?>btPublic/admin/images/icons-big/back.png" width="24" height="24" />Back to cities</a>
            </div>
            <div class="clear"></div>                        
            
            <form action="<?=base_url().'admin/cities/update/'.$ID.'/'.$page?>" method="post" onsubmit="return validateInfo();">
            	<label>City name: *</label>
                <div class="clear"></div>
            	<input type="text" name="name" id="name" class="field2" value="<?=$name?>" onkeypress="claerMessage();" onclick="clearFieldValue('name', 'Enter city name.');" onblur="addFieldValue('name', 'Enter city name.')"/>
                <?php echo form_error('name', '<div class="error" id="nameError">', '</div>');?>
               	<div class="pixel_space3"></div>
                
                
                <div class="clear"></div>
                <label>Country name: *</label>
                <div class="clear"></div>
            	<?=$countries?>
                <?php echo form_error('country', '<div class="error" id="countryError">', '</div>');?>
               	<div class="pixel_space3"></div>
                
                <div class="clear"></div>
                <label>Longitude:</label>
                <div class="clear"></div>
            	<input type="text" name="longitude" id="longitude" class="field2" value="<?=$longitude?>" />
                
                <div class="clear"></div>
                <label>Latitude:</label>
                <div class="clear"></div>
            	<input type="text" name="latitude" id="latitude" class="field2" value="<?=$latitude?>" />
                
                <div class="clear"></div>
                <div class="pixel_space3"></div>
                                
                <input name="btnUpdateCity" type="submit" value="Update city" class="button_1"  />
                <a href="<?=base_url().'admin/cities/p/'.$page?>" style="text-decoration:none;"><input type="button" value="Cancel" class="button_1"  /></a>
            </form>
            
        </div>
        <div class="clear"></div>
</div>
<div class="clear"></div>
<?=$this->load->view('admin/footerView')?>
</body>
</html>
