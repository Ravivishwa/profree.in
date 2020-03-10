<!DOCTYPE html>
<html lang="en">
  <?=$this->load->view('include/head_section')?>
  <body>
   	
    <div class="siteWraper">
    	<!--Header-->
        <?=$this->load->view('include/top_bar')?>
        
        <?=$this->load->view('include/top_header')?>
        <!--/Header-->
    	
		
    	<!--Listing Block-->
        <div class="searchlisting">
        	<div class="container">
            <div class="row">
            	<div class="col-md-3">
                	<?=$this->load->view('include/advance_search_left_side')?>
                </div>
                
                <div class="col-md-7">
                	<?php
					if($QUERY->num_rows){
						?>
                        <div class="listingwraper">
                            <div class="titlewraper"><b>Agents</b></div>
                            
                            <ul class="listinglist">
                            	<?php
								foreach($QUERY->result() as $res){
									$picture = base_url().'btPublic/html/images/not_available.jpg';
									$get_picture = $res->picture;
									if($get_picture){
										$picture = base_url().'btPublic/bt-uploads/'.$get_picture;	
									}
									?>
                                	<li>
                                        <h1><a href="<?=base_url().'agents/property/'.url_title($res->name, 'dash', true).'-'.$res->ID?>"><?=$res->name?></a></h1>                                        
                                        <div class="row">
                                        	<div class="col-md-3">
                                                <div class="mainimage"><a href="<?=base_url().'agents/property/'.url_title($res->name, 'dash', true).'-'.$res->ID?>"><img src="<?=$picture?>" width="150" /></a></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="price">Member Since: <?=displayDate($res->joinDate)?></div>
                                                <div class="whatinside">
                                                	                            
                                                </div>
                                                
                                                <p style="text-align:justify;">
                                                <strong>Phone:</strong> <?=$res->phone?><br/>
                                                <strong>Email:</strong> <?=$res->email?>
                                                </p>
                                                
                                                <div class="viiewoptions">
                                                    <a href="<?=base_url().'agents/property/'.url_title($res->name, 'dash', true).'-'.$res->ID?>"><i class="fa fa-external-link-square"></i> View Listing</a>
                                                </div>
                                                
                                            </div>
                                            
                                            
                                        </div>
                                        
                                    </li>
                                	<?php									
								}
								?>
                            </ul>
                            
                            <!--Pagination-->
                            <div class="pagesteps">
                            	<?=$this->pagination->create_links()?>
                              	<!--<ul class="pagination">
                                <li>
                                  <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                  </a>
                                </li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                  <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                  </a>
                                </li>
                              </ul>-->
                            </div>                                                        
                        </div>
                        <?php
					}
					else{
						?>
                        <div  class="hedingbar" style="background:none; color:#272E68;">No result found!<br/>Try Search Again with Proper Keyword!</div>
                        <?php
					}
					?>
                    
                </div>
                
                <!--Ads Block-->
                <?=$this->load->view('include/right_side_ads_bar')?> 
            </div>
            </div>
        </div>
        <!--/Listing Block-->
        
        <div class="buildings"></div>
        <!--Footer-->
         <?=$this->load->view('include/footer')?>
        
    </div>
	<?=$this->load->view('include/bottom_files')?>
  </body>
</html>