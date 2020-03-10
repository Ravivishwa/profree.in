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
                     <div class="titlehead">Create New Account</div>
                     <?=$Message?>
                 	 <div class="formint">
                     	
                        <div class="input-group">
                      	<label class="input-group-addon">User Type <span>*</span></label>
                      	<select name="agentType" id="agentType" class="form-control" required>
                            <option value="">Please select</option>
                                <option value="1" <?php if($agentType == '1') echo 'selected';?>>Agent</option>
                                <option value="2" <?php if($agentType == '2') echo 'selected';?>>Individual</option>                    
                        </select>
                    	</div>
                        <div class="input-group">
                        <label class="input-group-addon"> Name / Company<span>*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Company Name / Your Name" required value="<?=$name?>">                        
                        <?php echo form_error('name', '<div style="color:#D9534F;" id="nameError">', '</div>');?>
                        </div>
                        
                        <div class="input-group">
                        <label class="input-group-addon">Company Logo </label>
                        <input type="file" class="form-control" name="userfile" id="userfile">
                        </div>
                        
                        <div class="input-group">
                        <label class="input-group-addon"> Phone <span>*</span></label>
                        <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone" required value="<?=$phone?>">
                        </div>
                        
                        <div class="input-group">
                        <label class="input-group-addon">Website </label>
                        <input type="text" class="form-control" placeholder="Website" id="website" name="website" value="<?=$website?>">
                        </div>
                                                                        
                        <div class="input-group">
                        <label class="input-group-addon">Email address <span>*</span></label>
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" required value="<?=$email?>">
                        </div>
                                                
                        <div class="input-group">
                        <label class="input-group-addon">Password <span>*</span></label>
                        <input type="password" class="form-control" placeholder="at least 8 characters" name="password" id="password" required value="<?=$password?>">
                        <?php echo form_error('password', '<div style="color:#D9534F;" id="passwordError">', '</div>');?>
                        </div>
                        
                        <div class="input-group">
                        <label class="input-group-addon">Confirm Password <span>*</span></label>
                        <input type="password" class="form-control" placeholder="at least 8 characters" id="Cpassword" name="Cpassword" required value="<?=$Cpassword?>">
                        <?php echo form_error('Cpassword', '<div style="color:#D9534F;" id="CpasswordError">', '</div>');?>
                        </div>                                                                	
                    	                                                   
                        
                        <div class="formsparator">                        
                        <div class="input-group">
                        <label class="input-group-addon">Verification Code</label>
                        <?php echo @captcha()?>
                        </div>
                        
                        <div class="input-group">
                        <label class="input-group-addon">Enter the above code <span>*</span></label>
                        <?=captcha_field('form-control')?>
                        </div>                            
                        </div>
                        
                         <div align="center"><input type="submit" value="Sign Up" class="btn btn-success" /></div>
                         
                         <p>By registering you accept our <a href="<?=base_url().'content/terms-of-use'?>">Terms of Use</a> and <a href="<?=base_url().'content/privacy-policy'?>">Privacy and agree</a> that we and our selected partners may contact you with relevant offers and services. You may unsubscribe or update your preferences at any time in <a href="mailto:info.profree@gmail.com">info.profree@gmail.com</a>.</p>                                                                  
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