<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=$pageTitle?></title>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />



<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/content.js"></script>

<script type="text/javascript" src="<?=base_url()?>btPublic/venders/ckeditor/ckeditor.js"></script>

</head>



<body style="background:#f6f6f6;">

	<?=$this->load->view('admin/header');?>	

<div class="wrapper">

    <?=$this->load->view('admin/left_bar_linksView')?>

    <div class="rightbar">

        	<div class="heading" style="float:left;"><?=$heading?></div>

            <div style="float:right; padding-top:20px;">

            	<a href="<?=base_url().'admin/content'?>" class="top_link"><img src="<?=base_url()?>btPublic/admin/images/icons-big/back.png" width="24" height="24" />Back to Content</a>

            </div>

            <div class="clear"></div>                        

            <div align="center" class="error"><?=$Message?></div>

            <form action="<?=base_url().'admin/content/add'?>" method="post" onsubmit="return validateInfo();">

            	<label>Page name: *</label>

                <div class="clear"></div>

            	<input type="text" name="page__name" id="page__name" class="field2" value="<?=$page__name?>" onkeypress="claerMessage();" onclick="clearFieldValue('page__name', 'Enter page name.');" onblur="addFieldValue('page__name', 'Enter page name.')"/>

                <?php echo form_error('page__name', '<div class="error" id="page__nameError">', '</div>');?>

               	<div class="pixel_space3"></div>

                <div class="clear"></div>

                

                <label>Page title: *</label>

                <div class="clear"></div>

                <input type="text" name="title" id="title" class="field2" value="<?=$title?>" onkeypress="claerMessage();" onclick="clearFieldValue('title', 'Enter page title.');" onblur="addFieldValue('title', 'Enter page title.')"/>

                <?php echo form_error('title', '<div class="error" id="titleError">', '</div>');?>

               	<div class="pixel_space3"></div>

                <div class="clear"></div>

                

                <label>Description:</label>

                <div class="clear"></div>

                <textarea name="metaTags" id="metaTags" style="width:90%; height:150px; margin-left:2px;"><?=$metaTags?></textarea>

               	<div class="pixel_space3"></div>

                <div class="clear"></div>

                

                <label>Keywords: <font color="#666666">Exp. keyword1 keyword2...</font></label>

                <div class="clear"></div>

                <textarea name="keywords" id="keywords" style="width:90%; height:150px; margin-left:2px;"><?=$keywords?></textarea>

               	<div class="pixel_space3"></div>

                <div class="clear"></div>

                

                <label>Full Content / Description: </label>

                <div class="clear"></div>                
				<textarea name="details" id="details"><?=$details?></textarea>

                
				
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
               	<div class="pixel_space3"></div>

                <div class="clear"></div>

                                                

                                                

                <input name="btnAddcontent" type="submit" value="Save" class="button_1"  />

                <a href="<?=base_url().'admin/content'?>" style="text-decoration:none;"><input type="button" value="Cancel" class="button_1"  /></a>

                <div class="pixel_space3"></div>

                <div class="clear"></div>

            </form>

            

        </div>

        <div class="clear"></div>

</div>

<div class="clear"></div>

<?=$this->load->view('admin/footerView')?>

</body>

</html>

