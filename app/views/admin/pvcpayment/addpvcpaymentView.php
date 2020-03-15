<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=$pageTitle?></title>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>
<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/payment.js"></script>
<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/payment.js"></script>
<script type="text/javascript" src="<?=base_url()?>btPublic/js/vendor/jquery-3.2.1.min.js"></script>
</head>



<body style="background:#f6f6f6;">

	<?=$this->load->view('admin/header');?>

<div class="wrapper">

    <?=$this->load->view('admin/left_bar_linksView')?>

    <div class="rightbar">

        	<div class="heading" style="float:left;"><?=$heading?></div>

            <div style="float:right; padding-top:20px;">

            	<a href="<?=base_url().'admin/pvcpayment'?>" class="top_link"><img src="<?=base_url()?>btPublic/admin/images/icons-big/back.png" width="24" height="24" />Back to Payment Plans</a>

            </div>

            <div class="clear"></div>

            <div align="center" class="error"><?=$Message?></div>

            <form action="<?=base_url().'admin/pvcpayment/add'?>" method="post" onsubmit="return validateInfo();" enctype="multipart/form-data">

                <label>Title: *</label>
                <div class="clear"></div>
            	<!-- <input type="text" name="title" id="title" class="field2" value="<?=$title?>" onkeypress="claerMessage();" /> -->
                <select class="form-control"  name="title" id="title"  required readonly>
                    <option value="" > Select PVC Type </option>
                    <option value="AADHAR PVC Print" > AADHAR PVC Print </option>
                    <option value="TN SMART PVC" > TN SMART PVC </option>
                    <option value="PANCARD PVC" > PANCARD PVC </option>
                    <option value="CM HEALTH INS PVC" > CM HEALTH INS PVC </option>
                    <option value="UAN (EPF) PVC" > UAN (EPF) PVC </option>
                    <option value="PMJAY PVC" > PMJAY PVC </option>
                    <option value="PM-SMY PVC" > PM-SMY PVC </option>
                </select> 
                <?php echo form_error('title', '<div class="error" id="titleError">', '</div>');?>
               	<div class="pixel_space3"></div>
                <div class="clear"></div>




                <label>Price (Printing Charges): *</label>
                <div class="clear"></div>
            	<?php echo $site_currency;?> <input type="number" name="pvcprice" id="pvcprice" class="field2 pvcprice" value="<?=$price?>" required />
               	<div class="pixel_space3"></div>
                <div class="clear"></div>

                <label>Packaging,Handling and Postal Charges *</label>
                <div class="clear"></div>
                <input type="number" name="others" id="others" class="field2 others" value="<?=$others?>" required />
                <div class="pixel_space3"></div>
                <div class="clear"></div>

                <label>Tax (in %) *</label>
                <div class="clear"></div>
                <input type="number" name="tax" id="tax" class="field2" value="<?=$tax?$tax:18?>" required />
                <div class="pixel_space3"></div>
                <div class="clear"></div>

                <label>Total *</label>
                <div class="clear"></div>
                <input type="text" name="total" id="total" class="field2" value="<?=$total?>" required />
                <div class="pixel_space3"></div>
                <div class="clear"></div>

<!--                <label>Allowed Listing Properties(0 For unlimited): *</label>-->
<!--                <div class="clear"></div>-->
<!--            	<input type="text" name="properties" id="properties" class="field2" value="--><?//=$properties?><!--" required />-->
<!--               	<div class="pixel_space3"></div>-->
<!--                <div class="clear"></div>-->

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

<!--              	<label>Picture:</label>-->
<!--                <div class="clear"></div>-->
<!--            	<input type="file" name="userfile" id="userfile" class="field2"  />-->
<!--                --><?php //echo form_error('userfile', '<div class="error" id="userfileError">', '</div>');?>
<!--               	<div class="pixel_space3"></div>-->
<!--                <div class="clear"></div>                                  -->



                <input name="btnAddpvcpayment" type="submit" value="Save" class="button_1"  />

                <a href="<?=base_url().'admin/pvcpayment'?>" style="text-decoration:none;"><input type="button" value="Cancel" class="button_1"  /></a>

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
<script>
    $('#pvcprice,#others,#tax').on('keyup',function(event) {
        var tax = isNaN(parseInt($('#tax').val())) ? 0 : parseInt($('#tax').val());
        var pvcprice = isNaN(parseInt($('#pvcprice').val())) ? 0 : parseInt($('#pvcprice').val());
        var others = isNaN(parseInt($('#others').val())) ? 0 : parseInt($('#others').val());
        var total = pvcprice+others
        var gst = (total*tax)/100
        var totalWithtax = gst+total
        $('#total').val(totalWithtax)
    });

</script>

