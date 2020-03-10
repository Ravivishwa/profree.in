<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$pageTitle?></title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>
<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/gallery.js"></script>

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/venders/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=base_url()?>btPublic/admin/venders/ckfinder/ckfinder.js"></script> 
</head>

<body style="background:#f6f6f6;">
	<?=$this->load->view('admin/header');?>	
<div class="wrapper">
    <?=$this->load->view('admin/left_bar_linksView')?>
    <div class="rightbar">
        	<div class="heading" style="float:left;"><?=$heading?></div>
            <div style="float:right; padding-top:20px;">
            	<a href="<?=base_url().'admin/gallery'?>" class="top_link"><img src="<?=base_url()?>btPublic/admin/images/icons-big/back.png" width="24" height="24" />Back to Portfolio</a>
            </div>
            <div class="clear"></div>                        
            <div align="center" class="error"><?=$Message?></div>
            <?php
			$errorMessage = getMessage('error_message');
			$success_message = getMessage('success_message');
			$info_message = getMessage('info_message');
            if($errorMessage != ''){echo '<div class="error_message">'.$errorMessage.'</div>'; }
			if($success_message != ''){echo '<div class="success_message">'.$success_message.'</div>'; }
			if($info_message != ''){echo '<div class="info_message">'.$info_message.'</div>'; }
			
			if($galleryId == 0){
			?>
            	<form action="<?=base_url().'admin/gallery/add'?>" method="post" onsubmit="return validateInfo();">                
                    <label>Gallery Title / Category: *</label>
                    <div class="clear"></div>
                    <input type="text" name="name" id="name" class="field2" value="<?=$name?>" onkeypress="claerMessage();" onclick="clearFieldValue('name', 'Enter Gallery Title / Category.');" onblur="addFieldValue('name', 'Enter Gallery Title / Category.')"/>
                    <?php echo form_error('name', '<div class="error" id="nameError">', '</div>');?>
                    <div class="pixel_space3"></div>
                    <div class="clear"></div> 
                                                                    
                    <input name="btnAddgallery" type="submit" value="Save" class="button_1"  />
                    <a href="<?=base_url().'admin/gallery'?>" style="text-decoration:none;"><input type="button" value="Cancel" class="button_1"  /></a>
                    <div class="pixel_space3"></div>
                    <div class="clear"></div>
                </form>
            <?php
			}
			else{
			?>
            	<div align="center" id="loading__DIV" style="color:#d20000; display:none; font-family:Verdana, Geneva, sans-serif; font-size:17px;">
                	Uploading photo...<br/>
                	<img src="<?=base_url()?>btPublic/admin/images/loading.gif"  style="margin-top:5px;"/>
               	</div>
            	<form  name="frmIframeView" action="<?=base_url()?>admin/fileUpload/uploadFile_Single/<?=$galleryId?>" method="post" enctype="multipart/form-data" onsubmit="return validateInfoPhoto();">                
                    <label><strong>Gallery Title:</strong> </label><?=$this->general_model->getSingleValue($galleryId, 'ID', 'name', 'tbl_gallery');?>
                    <div class="pixel_space3"></div>
                    <div class="clear"></div> 
                  	
                    <label>Image Title</label>
                    <div class="clear"></div>
                    <input type="text" name="imageTitle" id="imageTitle" class="field2"/>
                    <div class="pixel_space3"></div>
                    <div class="clear"></div>
                    
                    <label>Image Description</label>
                    <div class="clear"></div>
                    <input type="text" name="imageDescription" id="imageDescription" class="field1"/>
                    <div class="pixel_space3"></div>
                    <div class="clear"></div>
                   	
                    <label>Image</label>
                    <div class="clear"></div>
                    <input type="file" name="userfile" id="userfile" class="field2" onchange="claerMessageImg();"/>
                    <div class="pixel_space3"></div>
                    <div class="clear"></div>
                    <input name="btnAddgallery" type="submit" value="Save" class="button_1"  />
                    <a href="<?=base_url().'admin/gallery'?>" style="text-decoration:none;"><input type="button" value="Cancel" class="button_1"  /></a>
                    <div class="pixel_space3"></div>
                    <div class="clear"></div>
                </form>
            <?php	
			}
            ?>
            
            <div align="left" style="margin-top:15px; margin-left:10px;"><h3>Portfolio:</h3></div>
            
            <div style="margin-left:10px;">
            	<?php
				$QUERY_PHOTOS = $this->general_model->getAllDataSingleArgument($galleryId, 'galleryId', 'tbl_gallery_images', '', '', 'ID', 'DESC');
				if((bool)($QUERY_PHOTOS) > 0){
					foreach($QUERY_PHOTOS->result() as $row){	
					?>
                  		<div style="float:left;width:205px; margin-bottom:30px;">
                        	<div align="center">
								<?=$row->imageTitle?><br/>
                            	<img src="<?=base_url().'btPublic/bt-uploads/thumbs/'.$row->imageName?>" />
                           	</div>
                            <div align="center">
                            <a href="<?=base_url().'admin/gallery/updatePhoto/'.$row->ID?>"><img src="<?=base_url().'btPublic/admin/images/edit.png'?>"   style="margin-top:5px;"/></a>&nbsp; 
                            <a href="<?=base_url().'admin/fileUpload/removeImage/'.$row->imageName.'/'.$row->ID.'/'.$galleryId?>"><img src="<?=base_url().'btPublic/admin/images/delete.png'?>"  /></a>
                            </div>
                        </div>  
                    <?php
					}
				}
				else echo '<label>No photos added for this gallery!</label>';
				?>            	
                
                <div class="clear"></div>
            </div>
        </div>        
        <div class="clear"></div>
</div>
<div class="clear"></div>
<?=$this->load->view('admin/footerView')?>
</body>
</html>
