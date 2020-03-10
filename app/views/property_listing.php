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
                            <div class="titlewraper"><?=$heading?> <strong>(<?=$total_rows?>)</strong></div>
                            
                            <ul class="listinglist">
                            	<?php
								foreach($QUERY->result() as $res){
									$picture = base_url().'btPublic/html/images/not_available.jpg';
									$get_picture = $this->general_model->single_value("property_id = '$res->property_id' and cover = 'YES'", 'picture', 'tbl_property_pictures');
									if($get_picture){
										$picture = base_url().'btPublic/bt-uploads/thumbs/'.$get_picture;	
									}
									?>
                                	<li>
                                        <h1><a href="<?=base_url().'property/info/'.url_title($res->title, 'dash', true).'-'.$res->property_id?>"><?=$res->title?></a></h1>                                        
                                        <div class="row">
                                        	<div class="col-md-3">
                                                <div class="mainimage"><a href="<?=base_url().'property/info/'.url_title($res->title, 'dash', true).'-'.$res->property_id?>"><img src="<?=$picture?>" width="150" /></a></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="price"><?=$this->general_model->single_value("ID = '1'", 'currency', 'tbl_settings')?><?=number_format($res->price)?></div>
                                                <div class="whatinside">
                                                	<span><img src="<?=base_url().'btPublic/html/'?>images/icons/icon-3.png" /> <?=$res->bedrooms?></span>
                                                    <span><img src="<?=base_url().'btPublic/html/'?>images/icons/icon-1.png" /> <?=$res->bathrooms?></span>
                                                    <span><img src="<?=base_url().'btPublic/html/'?>images/icons/icon-2.png" height="14" /> <?=$res->kitchen?></span>                                                    
                                                </div>
                                                
                                                <p style="text-align:justify;"><?=shortDescription($res->meta_decription, 150, '...')?></p>
                                                
                                                <div class="viiewoptions">
                                                    <a href="<?=base_url().'property/info/'.url_title($res->title, 'dash', true).'-'.$res->property_id?>"><i class="fa fa-external-link-square"></i> View Details</a> <a href="<?=base_url().'agents/contact/'.$res->agentId.'/'.$res->property_id?>"><i class="fa fa-envelope"></i> Contact Agent</a>
                                                </div>
                                                
                                            </div>
                                            <?php
											$agent_info = $this->general_model->agent_info($res->agentId);
											if($agent_info){
												$agent_pic = base_url().'btPublic/html/images/not_available.jpg';
												if($agent_info->picture){
													$agent_pic = base_url().'btPublic/bt-uploads/thumbs/'.$agent_info->picture;	
												}
												?>
                                                <div class="col-md-3 agentopt">
                                                    <div>Posted By</div>
                                                    <a href="<?=base_url().'agents/property/'.$res->agentId?>"><img src="<?=$agent_pic?>" width="75" /></a>
                                                    <div class="addon">Added on <br/><?=displayDateShort($res->date)?></div>
                                                </div>
                                            	<?php
											}
											?>
                                            
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
                        <div  class="hedingbar" style="background:none; color:#272E68;">No result found!<br/>Try to search again with different keywords.</div>
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