<!DOCTYPE html>
<html lang="en">
  <?=$this->load->view('include/head_section')?>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-9696836543099965",
        enable_page_level_ads: true
      });
    </script>
  <body>
   	
    <div class="siteWraper">
    	<!--Header-->
        <?=$this->load->view('include/top_bar')?>
        
        <?=$this->load->view('include/top_header')?>
        <!--/Header-->
    	
        <!--Search Block-->
        <?=$this->load->view('include/home_search_box')?>
        <!--/Search Block-->
		
        <!--Cities Block-->
        <div class="citiesWraper">
        <?php
		$CITIES = $this->general_model->fetchDataAll("countryId = '$defaultCountry' and status = 'YES'", 'tbl_cities', 24, 0, 'ID', 'RANDOM');
		if($CITIES){
			echo '<div class="container">
					<div class="citiesbox">
						<h3 class="sectitle">Popular Cities in <span>'.$defaultCountryName.'</span></h3>
						<div class="citiesinnr">
						<ul class="citiesList row">';
						foreach($CITIES->result() as $res_cities){
							echo '<li class="col-md-3 col-sm-4 col-xs-6"><a href="'.base_url().'city/'.url_title($res_cities->name, 'dash', true).'-'.$res_cities->ID.'">'.$res_cities->name.'</a></li>';
						}
						
						echo '<div class="clear"></div>
						</ul>
						</div>
					</div>
				</div>';
		}
		?> 
        </div>
    	<!--Cities Block End-->		 
       
        <!--Featured Properties-->
        <div class="container">
        <?=$this->load->view('include/home_featured_properties')?>
        </div>
        <!--/Featured Properties-->
        
        <!--Featured Agents-->
        <div class="featagents">
        <?=$this->load->view('include/home_featured_agents')?>
        </div>
        <!--/Featured Agents-->
        
        <!--Latest Propeties-->
        <div class="latestproperties">
        <?=$this->load->view('include/home_latest_properties')?>
        </div>
        <!--/Latest Propeties-->
                
        <!--buy Propeties-->
        <div class="container">
            <div class="wheredowraper">
            	<div class="row">
                	<div class="col-md-8">                    
            		<h3 class="sectitle">
                    Where do you want to buy, sell a property? <span>Choose your area and category of Homes</span>                    
                    </h3>
                	
                    <?php
					$CITIES = $this->general_model->fetchDataAll("countryId = '$defaultCountry' and status = 'YES'", 'tbl_cities', 0, 0, 'name', 'asc');
					if($CITIES){
						echo '<div class="locationwrp">                        
								<h4>Search Properties by cities</h4>
								<ul class="locationlist row">';
								foreach($CITIES->result() as $res_cities){
									echo '<li class="col-md-4 col-sm-4"><a href="'.base_url().'city/'.url_title($res_cities->name, 'dash', true).'-'.$res_cities->ID.'">'.$res_cities->name.' <span>('.$this->general_model->properties_in_city($res_cities->ID).')</span></a></li>';	
								}						
						echo 	'</ul>								
							</div>';						
					}
					?>                   
                    
               
                	</div>
                	<?php
                    	
						$ADS = $this->general_model->fetchDataAll("type = 'ad' and status = 'YES'", 'tbl_news', 6, 0, 'ID', 'RANDOM');
						if($ADS){
							echo '<div class="col-md-4"><ul class="homadslist row">';
							foreach($ADS->result() as $res_ads){
								echo '
								<li class="col-md-6">
								<img src="'.base_url().'btPublic/bt-uploads/medium/'.$res_ads->picture.'" />
								</li>
								';
							}
							echo '</ul></div>';
						}
						?>                  
                </div>
            </div>
        </div>
        
        <div class="buildings"></div>
        <!--Footer-->
        <?=$this->load->view('include/footer')?>        
    </div>
   <?=$this->load->view('include/bottom_files')?>
  </body>
</html>