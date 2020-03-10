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
                     <div class="titlehead">Login</div>                     
                 	 <div class="formint"> 
                     	<div class="input-group" style="padding-left:10px;">
                        <?=$Message?>
                        </div>
                                            	                        
                        <div class="input-group">
                        <label class="input-group-addon"> Email Address<span>*</span></label>
                        <input type="email" name="userName" id="userName" class="form-control" placeholder="Email Address" required value="<?=$userName?>">                        
                        <?php echo form_error('userName', '<div style="color:#D9534F;" id="userNameError">', '</div>');?>
                        </div>
                        
                        <div class="input-group">
                        <label class="input-group-addon">Password </label>
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password" required value="<?=$password?>">
                        </div>                                                                        
                        <input type="hidden" name="GetUserLogin" value="userLogin" />
                         <div align="center">                         
                         <input type="submit" value="Login" class="btn btn-success" />
                         <A href="<?=base_url().'general/recoverPassword'?>"><input type="button" value="Forget Password" class="btn btn-success" /></A>
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