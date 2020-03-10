<!DOCTYPE html>
<html lang="en">
  <?=$this->load->view('include/head_section')?>
<style type="text/css">
.payment{
	background:#F7F7F7;
	padding:10px;
	border:1px solid #CCC;
	border-radius: 5px;
}
</style>  
  <body>     	
    <div class="siteWraper">
    	<?=$this->load->view('include/top_bar')?>
        
        <?=$this->load->view('include/top_header')?>
    	
		
    	<!--detail Block-->
        <div class="detailpagewrap">
        <div class="container">
        	
                     <h3 class="sectitle">Payment Plans</h3>
                     <div class="payinfo"><?=$Message?></div>
                     <div class="payinfo"><?=payment_Status()?></div>
                 	 <ul class="row pricing_plan_table">                        
                         
                         <?php
						
						$userid=$this->session->userdata('agentId');
						$name=$this->session->userdata('userName');
						$email=$this->session->userdata('email');
						
					   $users = $this->general_model->fetchDataAll("ID = ".$userid, 'tbl_agents', 0, 0, 'ID', 'asc');
					   if($users){
					       	foreach($users->result() as $users_data){
					       	    $phone=$users_data->phone;
					       	    $planId=$users_data->plan_id;
					       	    
					       	}
					       
					       
					   }
					   
					  
					   
						
						
						$payment_plans = $this->general_model->fetchDataAll("status = 'YES'", 'tbl_payment_options', 0, 0, 'ID', 'asc');
						if($payment_plans){
							$k=1;
							foreach($payment_plans->result() as $res_payment){
							
							?>
                            
                            
                            <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="single_price_table">
                              <h3 class="tran3s"><?php
									echo $res_payment->title.' ';                                    
                                    ?></h3>
                              <span class="tran3s"><sup><?=$this->general_model->single_value("ID = '1'", 'currency', 'tbl_settings')?></sup> <?=number_format($res_payment->price, 2)?></span>
                              
                              <p><?=$res_payment->shortDescription?></p>
                              
                              <ul>
                                <li>No of Properties: <strong><?=$res_payment->properties?></strong></li>
                              
                              
                              <?php
                              
                             $plan_id=$res_payment->ID;
                             $paymentStr="userid=".$userid."&plan_id=".$plan_id."&product_name=Registration Fees&price=".$res_payment->price."&name=".$name."&phone=".$phone."&email=".$email;
                              
                             if($planId==$plan_id){
                                 
                                 echo '<li style="color:red;">ACTIVATED</li></ul>';
                                 
                             }else{?>
                                 
                                 <a href="http://profree.in/paymentinsta/paymentform.php?<?php echo $paymentStr; ?>"><button class="btn btn-primary" name="btn-<?php echo $k; ?>" >PAY</button></a>
                              
                                 
                             <?php }
                              
                              
                              /*
                              <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                  <input type="hidden" name="cmd" value="_xclick">
                                  <input type="hidden" name="business" value="<?=$this->general_model->single_value("ID = '1'", 'paypal_business_id', 'tbl_settings')?>">
                                  <input type="hidden" name="item_name" value="<?=$res_payment->title?>">
                                  
                                  <input type="hidden" name="currency_code" value="<?=$this->general_model->single_value("ID = '1'", 'currency_code', 'tbl_settings')?>">
                                  <input type="hidden" name="quantity" value="1">
                                  <input type="hidden" name="item_number" value="<?=$res_payment->ID?>">
                                  <input type="hidden" name="amount" value="<?php echo $res_payment->price?>">
                                  <input type="hidden" name="userName" value="<?=$this->session->userdata('userName')?>">
                                  <input type="hidden" name="userId" value="<?=$this->session->userdata('agentId')?>">
                                  <input type="hidden" name="email" value="<?=$this->general_model->single_value("ID = '1'", 'paypal_email', 'tbl_settings')?>">
                                  
                                   <input type="hidden" name="cancel_return" value="<?=base_url().'pFial'?>">
                                   <input type="hidden" name="call_back" value="<?=base_url().'payment/notify';?>">
                                   <input type="hidden" name="return" value="<?=base_url().'payment/notify';?>"/>
                                   <input name="notify_url" value="<?=base_url().'payment/notify';?>" type="hidden">
                                  <input type="image" name="submit"
                                    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
                                    alt="PayPal - The safer, easier way to pay online">
                                </form>
                              */
                              
                              ?>
                              
                              
                              
                              <?php 
                              $k++;
                              ?>
                              </div>
                          </li>
                            
                            <?php	
							}
						}
						?>                         
                    </ul> 
                 
                   
            
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