<!DOCTYPE html>
<html lang="en">
  <?=$this->load->view('include/head_section')?>
<script>
function rProperty(URL){
	if(confirm("Are you sure you want to delete this property!")){
		location.href = URL;
	}
}
</script>  
<style type="text/css">
.success_message{
	color:#099;	
}
.error_message{
	color:#d20000;	
}
</style>
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
                            	<div style="margin:20px;">
                            	<?php					
								$errorMessage = getMessage('error_message');
								$success_message = getMessage('success_message');
								$info_message = getMessage('info_message');
								if($errorMessage != ''){echo '<div class="error_message">'.$errorMessage.'</div>'; }
								if($success_message != ''){echo '<div class="success_message">'.$success_message.'</div>'; }
								if($info_message != ''){echo '<div class="info_message">'.$info_message.'</div>'; }			
								 ?>
                               	</div>
                                
                            	<?php
								foreach($QUERY->result() as $res){
									$picture = base_url().'btPublic/html/images/not_available.jpg';
									$get_picture = $this->general_model->single_value("property_id = '$res->property_id' and cover = 'YES'", 'picture', 'tbl_property_pictures');
									if($get_picture){
										$picture = base_url().'btPublic/bt-uploads/thumbs/'.$get_picture;	
									}
									?>
                                	<li>
                                        <h1><a href="<?=base_url().'property/info/'.$res->property_id?>"><?=$res->title?></a></h1>                                        
                                        <div class="row">
                                        	<div class="col-md-3">
                                                <div class="mainimage"><a href="<?=base_url().'property/info/'.$res->property_id?>"><img src="<?=$picture?>" width="150" /></a></div>
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
                                                    <a href="<?=base_url().'property/info/'.$res->property_id?>"><i class="fa fa-external-link-square"></i> View Details</a> <a href="<?=base_url().'agents/contact/'.$res->agentId.'/'.$res->property_id?>"><i class="fa fa-envelope"></i> Contact Agent</a>
                                                </div>
                                                
                                            </div>
                                            <?php
											$agent_info = $this->general_model->agent_info($res->agentId);
											if($agent_info){												
												?>
                                                <div class="col-md-3 agentopt" style="padding-top:50px;">
                                                    <a href="<?=base_url().'property/update/'.$res->property_id.'/'.$page?>" title="Edit / Update Property ??"><img src="<?=base_url().'btPublic/html/images/p_edit.png'?>" width="60"/></a>
                                                    <a href="javascript: void(0);" onClick="rProperty('<?=base_url().'property/delete/'.$res->property_id.'/'.$page?>');" title="Delete Property ??"><img src="<?=base_url().'btPublic/html/images/p_delete.png'?>" width="60"/></a>
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
                        <div  class="hedingbar" style="background:none; color:#272E68;">You have not added any property.<br/><a href="<?=base_url().'property/add'?>">+ ADD NEW PROPERTY</a></div>
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