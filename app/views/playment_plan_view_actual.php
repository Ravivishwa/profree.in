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
        	<div class="row">
        	 <div class="col-md-10">
             	
                 <!--Account info-->
                 <div class="formwraper">
                     <div class="titlehead">Payment Plans sdfasfasf</div>
                     <?=$Message?>
                     <?=payment_Status()?>
                 	 <div class="formint">                        
                         <?php
						$payment_plans = $this->general_model->fetchDataAll("status = 'YES'", 'tbl_payment_options', 0, 0, 'ID', 'asc');
						if($payment_plans){
							foreach($payment_plans->result() as $res_payment){
							?>
                            <div class="payment">
                            	<h2 style="padding:0; margin:0;">
									<?php
									echo $res_payment->title.' ';
                                    if($res_payment->picture){
                                        echo '<img src="'.base_url().'btPublic/bt-uploads/thumbs/'.$res_payment->picture.'" height="60"/>';
                                    }
                                    ?>
                                </h2>                            	
                                <p style="margin:0; padding-top:5px;"><?=$res_payment->shortDescription?></p>
                                <h4><?=number_format($res_payment->price, 2)?> <?=$this->general_model->single_value("ID = '1'", 'currency', 'tbl_settings')?></h4> 
                                <h5>No of Properties: <?=$res_payment->properties?></h5>                                
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                  <input type="hidden" name="cmd" value="_cart">
                                  <input type="hidden" name="business" value="<?=$this->general_model->single_value("ID = '1'", 'paypal_business_id', 'tbl_settings')?>">
                                  <input type="hidden" name="item_name" value="<?=$res_payment->title?>">
                                  
                                  <input type="hidden" name="currency_code" value="USD">
                                  <input type="hidden" name="quantity" value="1">
                                  <input type="hidden" name="item_number" value="<?=$res_payment->ID?>">
                                  <input type="hidden" name="amount" value="<?=$res_payment->price?>">
                                  <input type="hidden" name="userName" value="<?=$this->session->userdata('userName')?>">
                                  <input type="hidden" name="userId" value="<?=$this->session->userdata('agentId')?>">
                                  <input type="hidden" name="email" value="<?=$this->general_model->single_value("ID = '1'", 'paypal_email', 'tbl_settings')?>">
                                  
                                   <input type="hidden" name="cancel_return" value="<?=base_url().'pFial'?>">
                                   <input type="hidden" name="call_back" value="<?=base_url().'payment.php?payment=vfdjhjh&uid='.$this->session->userdata('userName').'&pid='.$res_payment->ID.'&amnt='.$res_payment->price?>">
                                   <input type="hidden" name="return" value="<?=base_url().'payment.php?payment=vfdjhjh&uid='.$this->session->userdata('userName').'&pid='.$res_payment->ID.'&amnt='.$res_payment->price?>"/>
                                  <input type="image" name="submit"
                                    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
                                    alt="PayPal - The safer, easier way to pay online">
                                </form>
                            </div>
                            <hr/>
                            <div style="clear:both;"></div>
                            <?php	
							}
						}
						?>                         
                    </div> 
                 </div>
                   
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