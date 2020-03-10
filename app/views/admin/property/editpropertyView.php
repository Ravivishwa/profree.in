<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=$pageTitle?></title>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />



<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>
<script type="text/javascript" src="<?=base_url()?>btPublic/admin/venders/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/projects.js"></script>



<script type="text/javascript" src="<?=base_url()?>btPublic/venders/ckeditor/ckeditor.js"></script>

<!------	JQuery PopUp Window files		------->
<link href="<?=base_url()?>btPublic/admin/venders/jquery-popup/style/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="<?=base_url()?>btPublic/admin/venders/jquery-popup/js/script.js"></script>
<style type="text/css">
.add_pics{
	background:#d20000;
	padding:7px;
	width:93px;	
}
.add_pics a{
	color:#F6F6F6; font-size:18px; text-decoration:none;	
}
.add_pics:hover{
	background:#F6F6F6;
	padding:7px;
	width:93px;	
}
.add_pics:hover a{
	color:#d20000;
}
</style>
</head>



<body style="background:#f6f6f6;">

	<?=$this->load->view('admin/header');?>	

<div class="wrapper">

    <?=$this->load->view('admin/left_bar_linksView')?>

    <div class="rightbar">
        	<div class="heading" style="float:left;"><?=$heading?></div>
            <div style="float:right; padding-top:20px;">
            	<a href="<?=base_url().'admin/property/p/'.$page?>" class="top_link"><img src="<?=base_url()?>btPublic/admin/images/icons-big/back.png" width="24" height="24" />Back to Properties</a>
            </div>
            
            <div class="clear"></div>
            <?php
			$errorMessage = getMessage('error_message');
			$success_message = getMessage('success_message');
			$info_message = getMessage('info_message');
            if($errorMessage != ''){echo '<div class="error_message">'.$errorMessage.'</div>'; }
			if($success_message != ''){echo '<div class="success_message">'.$success_message.'</div>'; }
			if($info_message != ''){echo '<div class="info_message">'.$info_message.'</div>'; }
			?>
            <div class="clear"></div>

            <form action="<?=base_url().'admin/property/update/'.$property_id.'/'.$page?>" method="post" onsubmit="return validateInfo();">
				<label>Title: *</label>
                <div class="clear"></div>
            	<input type="text" name="title" id="title" class="field2" value="<?=$title?>" required />
                <?php echo form_error('title', '<div class="error" id="titleError">', '</div>');?>
               	<div class="pixel_space3"></div>
                <div class="clear"></div>
                                                
                <div style="background:#DDEBF9; padding:10px; margin:10px; border-radius:10px;">
                    <div class="add_pics"><a href="#" class="topopup">Add Pictures</a></div>
                    <div class="loader"></div>
                    <div class="clear"></div>
                    <?=$currentPicture?>
                    <div class="pixel_space3"></div>
                    <div class="clear"></div>
                </div>
                <div class="pixel_space3"></div>
                <div class="clear"></div> 
                
                <label>Property Type</label>
                <div class="clear"></div>
                <select class="field2" name="type" id="type" required>
                	<option value="">Select Property Type...</option>
                    <option value="Rent" <?php if($type == 'Rent') echo 'selected';?>>Rent</option>
                    <option value="Sale" <?php if($type == 'Sale') echo 'selected';?>>Sale</option>
                    <option value="Wanted" <?php if($type == 'Wanted') echo 'selected';?>>Wanted</option>
                </select>
               	<div class="pixel_space3"></div>
                <div class="clear"></div>
                
                
                <label>Sub Type</label>
                <div class="clear"></div>
                 <select class="field2" name="sub_type" id="sub_type" required onchange="loadOtherDetails('<?=base_url()?>', this.value);">
                	<option value="">Select Property Sub Type...</option>
                    <option value="Homes" <?php if($sub_type == 'Homes') echo 'selected';?>>Homes</option>
                    <option value="Plots" <?php if($sub_type == 'Plots') echo 'selected';?>>Plots</option>
                    <option value="Commercial" <?php if($sub_type == 'Commercial') echo 'selected';?>>Commercial</option>
                </select>
               	<div class="pixel_space3"></div>
                <div class="clear"></div>
                
                <label>Other Details</label>
                <div class="clear"></div>
                 <select class="field2" name="sub_type1" id="sub_type1" required>
                	<option value="">Select Other Details...</option>
                    <?php
					if($sub_type == 'Homes'){
						?>
                        <option value="Houses" <?php if($sub_type1 == 'Houses') echo 'selected';?>>Houses</option>
                        <option value="Flats" <?php if($sub_type1 == 'Flats') echo 'selected';?>>Flats</option>
                        <option value="Upper Portions" <?php if($sub_type1 == 'Upper Portions') echo 'selected';?>>Upper Portions</option>
                        <option value="Lower Portions" <?php if($sub_type1 == 'Lower Portions') echo 'selected';?>>Lower Portions</option>
                        <option value="Farm Houses" <?php if($sub_type1 == 'Farm Houses') echo 'selected';?>>Farm Houses</option>
                        <option value="Rooms" <?php if($sub_type1 == 'Rooms') echo 'selected';?>>Rooms</option>
                        <option value="Penthouse" <?php if($sub_type1 == 'Penthouse') echo 'selected';?>>Penthouse</option>
                        <?php
					}
					if($sub_type == 'Plots'){						
                    	?>
                        <option value="Residential Plots" <?php if($sub_type1 == 'Residential Plots') echo 'selected';?>>Residential Plots</option>
                        <option value="Commercial Plots" <?php if($sub_type1 == 'Commercial Plots') echo 'selected';?>>Commercial Plots</option>
                        <option value="Agricultural Land" <?php if($sub_type1 == 'Agricultural Land') echo 'selected';?>>Agricultural Land</option>
                        <option value="Industrial Land" <?php if($sub_type1 == 'Industrial Land') echo 'selected';?>>Industrial Land</option>
                        <option value="Plot Forms" <?php if($sub_type1 == 'Plot Forms') echo 'selected';?>>Plot Forms</option>
                        <?php
					}
					if($sub_type == 'Commercial'){
						?>                    
                        <option value="Offices" <?php if($sub_type1 == 'Offices') echo 'selected';?>>Offices</option>
                        <option value="Shops" <?php if($sub_type1 == 'Shops') echo 'selected';?>>Shops</option>
                        <option value="Warehouses" <?php if($sub_type1 == 'Warehouses') echo 'selected';?>>Warehouses</option>
                        <option value="Factories" <?php if($sub_type1 == 'Factories') echo 'selected';?>>Factories</option>
                        <option value="Buildings" <?php if($sub_type1 == 'Buildings') echo 'selected';?>>Buildings</option>
                        <?php
					}
					?>
                        <option value="Other" <?php if($sub_type1 == 'Other') echo 'selected';?>>Other</option>
                </select>
               	<div class="pixel_space3"></div>
                <div class="clear"></div>
                
                <label>Area</label>
                <div class="clear"></div>
            	<input type="text" name="area" id="area" class="field2" value="<?=$area?>" required />
               	<div class="pixel_space3"></div>
                <div class="clear"></div>
                
                <label>Bedrooms</label>
                <div class="clear"></div>
                <select class="field2" name="bedrooms" id="bedrooms">
                	<option value="">Choose Option...</option>
                	<?php
                    for($i=1; $i<=10; $i++){
						?>
                        <option value="<?=$i?>" <?php if($bedrooms == $i) echo 'selected';?>><?=$i?></option>
                        <?php
					}
					?>
                </select>
               	<div class="pixel_space3"></div>
                <div class="clear"></div>
                
                <label>Kitchen</label>
                <div class="clear"></div>
                <select class="field2" name="kitchen" id="kitchen">
                	<option value="">Choose Option...</option>
                	<?php
                    for($i=1; $i<=10; $i++){
						?>
                        <option value="<?=$i?>" <?php if($kitchen == $i) echo 'selected';?>><?=$i?></option>
                        <?php
					}
					?>
                </select>
               	<div class="pixel_space3"></div>
                <div class="clear"></div>                                
                
                <label>Bathrooms</label>
                <div class="clear"></div>
                <select class="field2" name="bathrooms" id="bathrooms">
                	<option value="">Choose Option...</option>
                	<?php
                    for($i=1; $i<=10; $i++){
						?>
                        <option value="<?=$i?>" <?php if($bathrooms == $i) echo 'selected';?>><?=$i?></option>
                        <?php
					}
					?>
                </select>
               	<div class="pixel_space3"></div>
                <div class="clear"></div>                                                                
                
                <label>Price</label>
                <div class="clear"></div>
            	<input type="text" name="price" id="price" class="field2" value="<?=$price?>" required />
               	<div class="pixel_space3"></div>
                <div class="clear"></div>                                                               
                
                <label>Country: </label>
               	<div class="clear"></div>
                    <?=$countries?>
               	<div class="pixel_space3"></div>
				<div class="clear"></div>
                
                <label>City: </label>
              	<div class="clear"></div>
               	<div id="cities_view">
              		<?=$cities?>
               	</div>
                
                <div class="pixel_space3"></div>
				<div class="clear"></div>
                
                <label>Location</label>
                <div class="clear"></div>
            	<input type="text" name="location" id="location" class="field1" value="<?=$location?>" required />
               	<div class="pixel_space3"></div>
                <div class="clear"></div>                                                                                              
                
                <label>Keywords</label>
                <div class="clear"></div>
            	<input type="text" name="keywords" id="keywords" class="field1" value="<?=$keywords?>" />
               	<div class="pixel_space3"></div>
                <div class="clear"></div>
                
                <label>Short Description</label>
                <div class="clear"></div>
            	<textarea name="meta_decription" id="meta_decription" style="width:99%; height:150px;"><?=$meta_decription?></textarea>
               	<div class="pixel_space3"></div>
                <div class="clear"></div>
                
                <div style="background:#DCEBF9; padding:10px; border-radius:10px;">
                    <label><strong>Parking:</strong> </label>&nbsp;
                    <input type="radio" name="parking" id="parking" value="YES" <?php if($parking == 'YES') echo 'checked';?> /> YES &nbsp;
                    <input type="radio" name="parking" id="parking" value="NO" <?php if($parking == 'NO') echo 'checked';?>/> NO
                    <div class="pixel_space3"></div>
                    <div class="clear"></div>
                    
                    <label><strong>Featured:</strong> </label>&nbsp;
                    <input type="radio" name="featured" id="featured" value="YES" <?php if($featured == 'YES') echo 'checked';?> /> YES &nbsp;
                    <input type="radio" name="featured" id="featured" value="NO" <?php if($featured == 'NO') echo 'checked';?>/> NO                    
                </div> 
                <div class="pixel_space3"></div>
               	<div class="clear"></div>                               
                
                <label>Details:</label>
                <div class="clear"></div>
                <textarea name="details" id="details" rows="15" cols="107"><?=$details?></textarea>                
				 <script type="text/javascript" src="<?php echo base_url();?>btPublic/venders/ckeditor/ckeditor.js"></script>
<link href="<?php echo base_url();?>btPublic/venders/ckeditor/contents.css" type="text/css" />
<?php $path = base_url().'btPublic/venders/ckfinder/';//realpath(APPPATH . '../venders/').'/ckfinder/'; 
//echo $path = realpath(APPPATH . '../venders/').'ckfinder/';
?>
<script type="text/javascript">
var editor = CKEDITOR.replace( 'details',
{
height:"250", width:"650",
enterMode : CKEDITOR.ENTER_BR,
shiftEnterMode: CKEDITOR.ENTER_P,
filebrowserBrowseUrl : '<?php echo $path; ?>ckfinder.html',
filebrowserImageBrowseUrl : '<?php echo $path; ?>ckfinder.html?type=Images',
filebrowserFlashBrowseUrl : '<?php echo $path; ?>ckfinder.html?type=Flash',
filebrowserUploadUrl : '<?php echo $path; ?>core/connector/php/connector.php?command=QuickUpload&type=Files',
filebrowserImageUploadUrl : '<?php echo $path; ?>core/connector/php/connector.php?command=QuickUpload&type=Images',
filebrowserFlashUploadUrl : '<?php echo $path; ?>core/connector/php/connector.php?command=QuickUpload&type=Flash'
});


</script>                        
                <div class="clear"></div>                    
               	<div class="pixel_space3"></div>
                <div class="clear"></div>
                
                <input name="btnUpdateproperty" type="submit" value="Update Property" class="button_1"  />

                <a href="<?=base_url().'admin/property/p/'.$page?>" style="text-decoration:none;"><input type="button" value="Cancel" class="button_1"  /></a>

                <div class="clear"></div>

                <div class="pixel_space3"></div>

            </form>

            

        </div>

        <div class="clear"></div>

</div>

<div class="clear"></div>

<?=$this->load->view('admin/footerView')?>

<!--Image Upload Popup Start-->
<div id="toPopup"> 
    	
        <div class="close"></div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup_content"> <!--your content start-->
        	<h2 style="color:#d20000;">Upload Picture:</h2>
            <label id="picture_loading_status" style="display:none;"><img src="<?=base_url()?>btPublic/admin/images/loading.gif" /></label>
            <p>Choose image file to upload new picture of this Section.</p>
            <p>
            	<div style="color:#d20000; margin:5px 0px;">Allowed picture types: Gif, Jpg, Png</div>
                <div class="clear"></div>
                <form id="frm_Picture" action="<?=base_url().'admin/property/addPicture/'.$property_id.'/'.$page?>" method="post" enctype="multipart/form-data">
                    <input type="file" name="userFiles[]" multiple id="userFiles[]" class="field2"   onchange="SubmitPictureForm();"/> Width: 640px, Height: Auto
                    <?php echo form_error('userfile', '<div class="error" id="userfileError">', '</div>');?>
                    <div class="pixel_space3"></div>
                    <div class="clear"></div>
                </form>
            </p>
        </div> <!--your content end-->
    
    </div>
<div id="backgroundPopup"></div>
<!-- @ Image Upload Popup End-->

</body>

</html>

<script type="text/javascript">
function loadOtherDetails(baseUrl, ID){
	
	$data = '';	
	$.ajax({
		url: baseUrl+"admin/property/AddOther_details/"+ID,  
		type: "GET",        
		data: $data,     
		//cache: false,
		success: function (html) {  
			$('#sub_type1').html(html);     
		}       
	});
}
</script>