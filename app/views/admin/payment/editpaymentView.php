<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=$pageTitle?></title>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />



<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/payment.js"></script>
<script type="text/javascript" src="<?=base_url()?>btPublic/venders/ckeditor/ckeditor.js"></script>

</head>



<body style="background:#f6f6f6;">

	<?=$this->load->view('admin/header');?>	

<div class="wrapper">

    <?=$this->load->view('admin/left_bar_linksView')?>

    <div class="rightbar">

        	<div class="heading" style="float:left;"><?=$heading?></div>

            <div style="float:right; padding-top:20px;">

            	<a href="<?=base_url().'admin/payment/p/'.$page?>" class="top_link"><img src="<?=base_url()?>btPublic/admin/images/icons-big/back.png" width="24" height="24" />Back to Payment Plans</a>

            </div>

            <div class="clear"></div>                        

            <div align="center" class="error"><?=$Message?></div>

            <form action="<?=base_url().'admin/payment/update/'.$ID.'/'.$page?>" method="post" onsubmit="return validateInfo();" enctype="multipart/form-data">				 
                            
            	<label>Title: *</label>
                <div class="clear"></div>
            	<input type="text" name="title" id="title" class="field2" value="<?=$title?>" onkeypress="claerMessage();" />
                <?php echo form_error('title', '<div class="error" id="titleError">', '</div>');?>
               	<div class="pixel_space3"></div>
                <div class="clear"></div> 
                
                <label>Price (Plan Charges): *</label>
                <div class="clear"></div>
            	<?php echo $site_currency;?> <input type="text" name="price" id="price" class="field2" value="<?=$price?>" required />
               	<div class="pixel_space3"></div>
                <div class="clear"></div> 
                
                <label>Allowed Listing Properties (0 For unlimited): *</label>
                <div class="clear"></div>
            	<input type="text" name="properties" id="properties" class="field2" value="<?=$properties?>" required />
               	<div class="pixel_space3"></div>
                <div class="clear"></div> 
                
                <input type="hidden" name="time_period" id="time_period" class="field2" value="<?=$time_period?>" required />
                <!--
                <label>Time Period (No of days): *</label>
                <div class="clear"></div>
            	<input type="hidden" name="time_period" id="time_period" class="field2" value="<?=$time_period?>" required />
               	<div class="pixel_space3"></div>
                <div class="clear"></div>-->
                
                <label>Short Description: </label>
                <div class="clear"></div>
                <textarea name="shortDescription" id="shortDescription" rows="6" cols="100"><?=$shortDescription?></textarea>
                <div class="pixel_space3"></div>
                <div class="clear"></div>
                
                <label>Description / Details: </label>
                <div class="clear"></div>
                <textarea name="description" id="description" rows="15" cols="107"><?=$description?></textarea>                
				<script type="text/javascript" src="<?php echo base_url();?>btPublic/venders/ckeditor/ckeditor.js"></script>
<link href="<?php echo base_url();?>btPublic/venders/ckeditor/contents.css" type="text/css" />
<?php $path = base_url().'btPublic/venders/ckfinder/';//realpath(APPPATH . '../venders/').'/ckfinder/'; 
//echo $path = realpath(APPPATH . '../venders/').'ckfinder/';
?>
<script type="text/javascript">
var editor = CKEDITOR.replace( 'description',
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
                
               	<div class="pixel_space3"></div>

                <div class="clear"></div>                             

              	<?php
                if($picture){
					?>
                    <label>Picture: <img src="<?=base_url().'btPublic/bt-uploads/thumbs/'.$picture;?>" /> </label>
                    <?php
				}
				?>
                <div class="clear"></div>
            	<input type="file" name="userfile" id="userfile" class="field2"  />
                <?php echo form_error('userfile', '<div class="error" id="userfileError">', '</div>');?>
               	<div class="pixel_space3"></div>
                <div class="clear"></div>
                                
				<input type="hidden" name="picture" value="<?=$picture?>" />
                <input name="btnUpdatepayment" type="submit" value="Update Payment Plan" class="button_1"  />

                <a href="<?=base_url().'admin/payment/p/'.$page?>" style="text-decoration:none;"><input type="button" value="Cancel" class="button_1"  /></a>

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

