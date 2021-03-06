<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=$pageTitle?></title>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>
<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/homeSlider.js"></script>

<script type="text/javascript" src="<?=base_url()?>btPublic/venders/ckeditor/ckeditor.js"></script>

</head>



<body style="background:#f6f6f6;">

	<?=$this->load->view('admin/header');?>	

<div class="wrapper">

    <?=$this->load->view('admin/left_bar_linksView')?>

    <div class="rightbar">

        	<div class="heading" style="float:left;"><?=$heading?></div>

            <div style="float:right; padding-top:20px;">

            	<a href="<?=base_url().'admin/homeSlider'?>" class="top_link"><img src="<?=base_url()?>btPublic/admin/images/icons-big/back.png" width="24" height="24" />Back to Home Slider</a>

            </div>

            <div class="clear"></div>                        

            <div align="center" class="error"><?=$Message?></div>

            <form action="<?=base_url().'admin/homeSlider/add'?>" method="post" onsubmit="return validateInfo();" enctype="multipart/form-data">

            	<label>Title: </label>
                <div class="clear"></div>
            	<input type="text" name="title" id="title" class="field2" value="<?=$title?>" onkeypress="claerMessage();" />
                <?php echo form_error('title', '<div class="error" id="titleError">', '</div>');?>
               	<div class="pixel_space3"></div>
                <div class="clear"></div>                                                       

              	<label>Picture: (W:635, H:540)</label>
                <div class="clear"></div>
            	<input type="file" name="userfile" id="userfile" class="field2"  />
                <?php echo form_error('userfile', '<div class="error" id="userfileError">', '</div>');?>
               	<div class="pixel_space3"></div>
                <div class="clear"></div>                                  

             	<label>Details / Description: </label>
                <div class="clear"></div>
            	<textarea name="description" id="description" style="width:600px; height:200px;"><?=$description?></textarea>
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
                <?php echo form_error('description', '<div class="error" id="descriptionError">', '</div>');?>
               	<div class="pixel_space3"></div>
                <div class="clear"></div>                                   

                <input name="btnAddhomeSlider" type="submit" value="Save" class="button_1"  />

                <a href="<?=base_url().'admin/homeSlider'?>" style="text-decoration:none;"><input type="button" value="Cancel" class="button_1"  /></a>

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

