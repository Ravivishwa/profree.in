<!DOCTYPE html>

<html lang="en">
      <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>
      <?=$p_title?>
      </title>
      <link href="<?=base_url().'btPublic/html/'?>css/style.css" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>

      <!-- Bootstrap -->

      <link href="<?=base_url().'btPublic/html/'?>css/bootstrap.min.css" rel="stylesheet">
      <link href="<?=base_url().'btPublic/html/'?>css/font-awesome.min.css" rel="stylesheet">

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

      <!--[if lt IE 9]>

          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

          <script src="https://oss.maxcdn.com/libs/respond.<?=base_url().'btPublic/html/'?>js/1.4.2/respond.min.js"></script>

        <![endif]-->

      <style type="text/css">
.alert-danger, .alert-error {
	background-color: #f2dede;
	border-color: #eed3d7;
	color: #b94a48;
}
</style>
      </head>

      <body>
<div class="siteWraper">
        <?=$this->load->view('include/top_bar')?>
        <?=$this->load->view('include/top_header')?>
        
        <!--detail Block-->
        
        <div class="detailpagewrap">
    <div class="container">
            <div class="row">
        <div class="col-md-10"> 
                
                <!--Account info-->
                
                <form action="<?=base_url().'property/add'?>" method="post" enctype="multipart/form-data">
            	<div class="formwraper">
                    <h3 class="sectitle">Add New Property</h3>
                    <?php

                     echo $Message;

					 if(!$allowed){

						echo '<div align="center" class="error">'.$warning.'</div>';

					 }

					 else{

					 ?>
                    <div class="formint">
                <div class="input-group">
                        <label class="input-group-addon" style="color:#303980; padding-left:20px;">Payment Plan: <b>
                          <?=payment_plan()?>
                          </b> (You can upload
                    <?=remaining_proeprties()?>
                    properties more).</label>
                      </div>
                <div class="input-group">
                        <label class="input-group-addon">Title: <span>*</span></label>
                        <input type="text" name="title" id="title" class="form-control" value="<?=$title?>" required />
                        <?php echo form_error('title', '<div class="error" id="titleError">', '</div>');?> </div>
                <div class="input-group">
                        <label class="input-group-addon">Property Type</label>
                        <select class="form-control" name="type" id="type" required>
                    <option value="">Select Property Type...</option>
                    <option value="Rent" <?php if($type == 'Rent') echo 'selected';?>>Rent</option>
                    <option value="Sale" <?php if($type == 'Sale') echo 'selected';?>>Sale</option>
                    <option value="Wanted" <?php if($type == 'Wanted') echo 'selected';?>>Wanted</option>
                  </select>
                      </div>
                <div class="input-group">
                        <label class="input-group-addon">Sub Type</label>
                        <div class="clear"></div>
                        <select class="form-control" name="sub_type" id="sub_type" required onchange="loadOtherDetails('<?=base_url()?>', this.value);">
                    <option value="">Select Property Sub Type...</option>
                    <option value="Homes" <?php if($sub_type == 'Homes') echo 'selected';?>>Homes</option>
                    <option value="Plots" <?php if($sub_type == 'Plots') echo 'selected';?>>Plots</option>
                    <option value="Commercial" <?php if($sub_type == 'Commercial') echo 'selected';?>>Commercial</option>
                  </select>
                      </div>
                <!--<div class="input-group">-->
                <!--        <label class="input-group-addon">Other Details</label>-->
                <!--        <div class="clear"></div>-->
                <!--        <select class="form-control" name="sub_type1" id="sub_type1" required>-->
                <!--    <option value="">Select Other Details...</option>-->
                <!--  </select>-->
                <!--      </div>-->
                <div class="input-group">
                        <label class="input-group-addon">Area</label>
                        <div class="clear"></div>
                        <input type="text" name="area" id="area" class="form-control" value="<?=$area?>" required />
                      </div>
                <div class="input-group">
                        <label class="input-group-addon">Bedrooms</label>
                        <div class="clear"></div>
                        <select class="form-control" name="bedrooms" id="bedrooms">
                    <option value="">Choose Option...</option>
                    <?php

                            for($i=1; $i<=10; $i++){

                                ?>
                    <option value="<?=$i?>" <?php if($bedrooms == $i) echo 'selected';?>>
                          <?=$i?>
                          </option>
                    <?php

                            }

                            ?>
                  </select>
                      </div>
                <div class="input-group">
                        <label class="input-group-addon">Kitchen</label>
                        <div class="clear"></div>
                        <select class="form-control" name="kitchen" id="kitchen">
                    <option value="">Choose Option...</option>
                    <?php

                            for($i=1; $i<=10; $i++){

                                ?>
                    <option value="<?=$i?>" <?php if($kitchen == $i) echo 'selected';?>>
                          <?=$i?>
                          </option>
                    <?php

                            }

                            ?>
                  </select>
                      </div>
                <div class="input-group">
                        <label class="input-group-addon">Bathrooms</label>
                        <div class="clear"></div>
                        <select class="form-control" name="bathrooms" id="bathrooms">
                    <option value="">Choose Option...</option>
                    <?php

                            for($i=1; $i<=10; $i++){

                                ?>
                    <option value="<?=$i?>" <?php if($bathrooms == $i) echo 'selected';?>>
                          <?=$i?>
                          </option>
                    <?php

                            }

                            ?>
                  </select>
                      </div>
                <div class="input-group">
                        <label class="input-group-addon">Price</label>
                        <div class="clear"></div>
                        <input type="text" name="price" id="price" class="form-control" value="<?=$price?>" required />
                      </div>
                <div class="input-group">
                        <label class="input-group-addon">Country: </label>
                        <div class="clear"></div>
                        <?=str_replace('class="dropDown"', 'class="form-control"', $countries)?>
                      </div>
                <div class="input-group">
                        <label class="input-group-addon">City: </label>
                        <div class="clear"></div>
                        <div id="cities_view">
                    <?=str_replace('class="dropDown"', 'class="form-control"', $cities)?>
                  </div>
                      </div>
                <div class="input-group">
                        <label class="input-group-addon">Location</label>
                        <div class="clear"></div>
                        <input type="text" name="location" id="location" class="form-control" value="<?=$location?>" required />
                      </div>
                <input type="hidden" name="keywords" id="keywords" class="form-control" value="<?=$keywords?>" />
                <input type="hidden" name="meta_decription" id="meta_decription" class="form-control" value="<?=$meta_decription?>" />
               <textarea name="sessionTxt" style="visibility:hidden;"><?php echo json_encode( $this->session->userdata); ?></textarea>
              
                
                <div class="input-group">
                        <label class="input-group-addon"> Parking: </label>
                        <input type="radio" name="parking" id="parking" value="YES" <?php if($parking == 'YES') echo 'checked';?> />
                        YES &nbsp;
                        <input type="radio" name="parking" id="parking" value="NO" <?php if($parking == 'NO') echo 'checked';?>/>
                        NO </div>
                <div class="input-group">
                        <label class="input-group-addon">Featured: </label>
                        <input type="radio" name="featured" id="featured" value="YES" <?php if($featured == 'YES') echo 'checked';?> />
                        YES &nbsp;
                        <input type="radio" name="featured" id="featured" value="NO" <?php if($featured == 'NO') echo 'checked';?>/>
                        NO </div>
                <div class="input-group" style="width:100%;">
                        <label class="input-group-addon" style="width:24.5%;">Details:</label>
                        <textarea name="details" id="details"><?=$details?>
</textarea>
                        <script type="text/javascript" src="<?php echo base_url();?>btPublic/venders/ckeditor/ckeditor.js"></script>
                        <link href="<?php echo base_url();?>btPublic/venders/ckeditor/contents.css" type="text/css" />
                        <?php $path = base_url().'btPublic/venders/ckfinder/';//realpath(APPPATH . '../venders/').'/ckfinder/'; 

        //echo $path = realpath(APPPATH . '../venders/').'ckfinder/';

        ?>
                        <script type="text/javascript">

        var editor = CKEDITOR.replace( 'details',

        {

        height:"150", width:"100%",

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
                      </div>
                <div align="right">
                        <input type="submit" name="submit" value="Submit" class="btn btn-success" />
                      </div>
              </div>
                    <?php

					 }

					 ?>
                  </div>
          </form>
             
        </div>
        <!--/Job Detail-->
        
        <?=$this->load->view('include/right_side_ads_bar')?>
      </div>
          </div>
  </div>
        
        <!--/detail Block-->
        
        <div class="buildings"></div>
        
        <!--Footer-->
        
        <?=$this->load->view('include/footer')?>
      </div>
<?=$this->load->view('include/bottom_files')?>
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