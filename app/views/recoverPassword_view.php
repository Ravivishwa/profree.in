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
                 <form action="<?=base_url()?>general/recoverPassword" method="post">
                 <div class="formwraper">
                     <div class="titlehead">Login</div>                     
                 	 <div class="formint"> 
                     	<div class="input-group" style="padding-left:10px;">
                        <?=$Message?>
                        </div>
                                            	                        
                        <div class="input-group">
                        <label class="input-group-addon"> Email Address<span>*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required value="<?=$email?>">                        
                        <?php echo form_error('userName', '<div style="color:#D9534F;" id="userNameError">', '</div>');?>
                        </div>
                        
                                                                                                
                        <input type="hidden" name="GetUserLogin" value="userLogin" />
                         <div align="center">                         
                         <input type="submit" value="Submit" name="RecoverPassword" id="RecoverPassword" class="btn btn-success" />
                         <A href="<?=base_url().'login'?>"><input type="button" value="Go to login" class="btn btn-success" /></A>
                         </div>
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