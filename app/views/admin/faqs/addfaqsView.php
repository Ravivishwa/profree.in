<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=$pageTitle?></title>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>
<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/faqs.js"></script>

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

            	<a href="<?=base_url().'admin/faqs'?>" class="top_link"><img src="<?=base_url()?>btPublic/admin/images/icons-big/back.png" width="24" height="24" />Back to faqs</a>

            </div>

            <div class="clear"></div>                        

            <div align="center" class="error"><?=$Message?></div>

            <form action="<?=base_url().'admin/faqs/add'?>" method="post" onsubmit="return validateInfo();">

            	<label>Question: *</label>

                <div class="clear"></div>

            	<input type="text" name="question" id="question" class="field1" value="<?=$question?>" onkeypress="claerMessage();" onclick="clearFieldValue('question', 'Enter question.');" onblur="addFieldValue('question', 'Enter question.')"/>

                <?php echo form_error('question', '<div class="error" id="questionError">', '</div>');?>

               	<div class="pixel_space3"></div>

                <div class="clear"></div>                

                

                <label>Answer: </label>

                <div class="clear"></div>                

                <textarea name="answer" id="answer" rows="15" cols="107"><?=$answer?></textarea>                
				 <script type="text/javascript">
					var editor = CKEDITOR.replace( 'answer',
					{						
						enterMode : CKEDITOR.ENTER_BR
					});
					CKFinder.setupCKEditor(  editor, { basePath : 'ckfinder/', rememberLastFolder : true } );
				</script>
                
               	<div class="pixel_space3"></div>

                <div class="clear"></div>

                                                

                                                

                <input name="btnAddfaqs" type="submit" value="Save" class="button_1"  />

                <a href="<?=base_url().'admin/faqs'?>" style="text-decoration:none;"><input type="button" value="Cancel" class="button_1"  /></a>

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

