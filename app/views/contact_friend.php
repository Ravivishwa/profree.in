<!DOCTYPE html>
<html lang="en">
  <?=$this->load->view('include/head_section')?>
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
                 <form action="" method="post" enctype="multipart/form-data">
                 <div class="formwraper">
                     <div class="titlehead">Share Property with Friend</div>
                     <?=$Message?>
                 	 <div class="formint">

                        <div class="input-group">
                        <label class="input-group-addon"> Friend's Name<span>*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Friend's Name" required value="<?=$name?>">                        
                        <?php echo form_error('name', '<div style="color:#D9534F;" id="nameError">', '</div>');?>
                        </div>                      
                        
                        <div class="input-group">
                        <label class="input-group-addon">Friend's Email address <span>*</span></label>
                        <input type="email" class="form-control" placeholder="Friend's Email" name="email" id="email" required value="<?=$email?>">
                        </div> 
                                                                        
                        <div class="input-group">
                        <label class="input-group-addon">Your Email address <span>*</span></label>
                        <input type="email" class="form-control" placeholder="Your Email" name="your_email" id="your_email" required value="<?=$your_email?>">
                        </div>                                                              	
                    	                                                   
                        
                        <div class="input-group">
                        <label class="input-group-addon">Message</label>
                        <textarea class="form-control" placeholder="Message" name="message" id="message"><?=$email?></textarea>
                        </div> 
                        
                        <div class="formsparator">                        
                        <div class="input-group">
                        <label class="input-group-addon">Verification Code</label>
                        <?=captcha()?>
                        </div>
                        
                        <div class="input-group">
                        <label class="input-group-addon">Enter the above code <span>*</span></label>
                        <?=captcha_field('form-control')?>
                        </div>                            
                        </div>
                        
                        <div align="center"><input type="submit" value="SEND" class="btn btn-success" /></div>                                                                                                                    
                    </div> 
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