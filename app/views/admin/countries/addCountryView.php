<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=$pageTitle?></title>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />



<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/countries.js"></script>


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

            	<a href="<?=base_url().'admin/countries'?>" class="top_link"><img src="<?=base_url()?>btPublic/admin/images/icons-big/back.png" width="24" height="24" />Back to countries</a>

            </div>

            <div class="clear"></div>                        

            <div align="center" class="error"><?=$Message?></div>

            <form action="<?=base_url().'admin/countries/add'?>" method="post" onsubmit="return validateInfo();" enctype="multipart/form-data">

            	<label>Country name: *</label>

                <div class="clear"></div>

            	<input type="text" name="name" id="name" class="field2" value="<?=$name?>" onkeypress="claerMessage();" onclick="clearFieldValue('name', 'Enter country name.');" onblur="addFieldValue('name', 'Enter country name.')"/>

                <?php echo form_error('name', '<div class="error" id="nameError">', '</div>');?>

               	<div class="pixel_space3"></div>

                

                

                <div class="clear"></div>

                <label>Currency code: <font color="#666666">(eg: <strong>USD</strong> for US dollars, <strong>GBP</strong> for UK pounds, <strong>EUR</strong> for Euro, <strong>PKR</strong> for pakistani rupees) <a href="<?=base_url()?>admin/countries/currency-codes-symbols" target="_blank" class="top_link">View Symbols Chart</a></font></label>

                <div class="clear"></div>

            	<input type="text" name="currency" id="currency" class="field2" value="<?=$currency?>" onclick="clearFieldValue('currency', 'Enter country currency code.');" onblur="addFieldValue('currency', 'Enter country currency code.')"/>

                <div class="pixel_space3"></div>

                

                

                <div class="clear"></div>

                <label>Currency signature: <font color="#666666">(eg: <strong>$</strong> for US dollars, <strong>£</strong> for UK pounds, <strong>€</strong> for Euro, <strong>Rs</strong> for pakistani rupees) <a href="<?=base_url()?>admin/countries/currency-codes-symbols" target="_blank" class="top_link">View Symbols Chart</a></font></label>

                <div class="clear"></div>

            	<input type="text" name="currencySignature" id="currencySignature" class="field2" value="<?=$currencySignature?>" onclick="clearFieldValue('currencySignature', 'Enter country currency signature.');" onblur="addFieldValue('currencySignature', 'Enter country currency signature.')" />

                <div class="clear"></div>

                <div class="pixel_space3"></div>

             	<label>Description / Details: </label>
                <div class="clear"></div>
                <textarea name="details" id="details" rows="15" cols="107"><?=$details?></textarea>                
				 <script type="text/javascript">
					var editor = CKEDITOR.replace( 'details',
					{						
						enterMode : CKEDITOR.ENTER_BR
					});
					CKFinder.setupCKEditor(  editor, { basePath : 'ckfinder/', rememberLastFolder : true } );
				</script>
                
               	<div class="pixel_space3"></div>

                <div class="clear"></div>                             

              	<label>Picture:</label>
                <div class="clear"></div>
            	<input type="file" name="userfile" id="userfile" class="field2"  />
                <?php echo form_error('userfile', '<div class="error" id="userfileError">', '</div>');?>
               	<div class="pixel_space3"></div>                
                <div class="clear"></div>
                
                <label>Display on front:</label>
                &nbsp;
            	<font color="#666666">Yes</font> <input type="radio" name="displayOnFront" id="displayOnFront" <?php if($displayOnFront == 'YES') echo 'checked';?>  value="YES"/>&nbsp; &nbsp; &nbsp;
                <font color="#666666">No</font> <input type="radio" name="displayOnFront" id="displayOnFront" <?php if($displayOnFront == 'NO') echo 'checked';?> value="NO"/>                
               	<div class="pixel_space3"></div>                              
                <div class="clear"></div>
                                                   

                <input name="btnAddCountry" type="submit" value="Add new country" class="button_1"  />

                <a href="<?=base_url().'admin/countries'?>" style="text-decoration:none;"><input type="button" value="Cancel" class="button_1"  /></a>

            </form>

            <div class="pixel_space3"></div>                              
             <div class="clear"></div>

        </div>

        <div class="clear"></div>

</div>

<div class="clear"></div>

<?=$this->load->view('admin/footerView')?>

</body>

</html>

