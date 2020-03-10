<!DOCTYPE html>

<html lang="en">
<?=$this->load->view('include/head_section')?>
<script type="text/javascript">

  function PrintThisPage(){

		window.print();  

  }

  </script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-9696836543099965",
        enable_page_level_ads: true
      });
    </script>
<body>
<div class="siteWraper">
  <?=$this->load->view('include/top_bar')?>
  <?=$this->load->view('include/top_header')?>
  
  <!--detail Block-->
  
  <div class="detailpagewrap">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
            
            <div class="adtitiles">
              <h1>
                <?=$QUERY->title?>
              </h1>
              <h2>
                <?=$this->general_model->single_value("ID = '1'", 'currency', 'tbl_settings')?>
                <?=number_format($QUERY->price)?>
              </h2>
            </div>
            <div class="imageswraper">
              <div class="bigimage"><a class="group1" href="<?=base_url().'btPublic/bt-uploads/'.$cover_picture?>" title="<?=$QUERY->title?>"><img src="<?=base_url().'btPublic/bt-uploads/medium/'.$cover_picture?>"  width="750"/></a></div>
              <div class="thumbnails">
                <?php

								if($pictures){

									echo '<ul class="thumblist"> ';

									foreach($pictures->result() as $res_pic){

										echo '<li><a class="group1" href="'.base_url().'btPublic/bt-uploads/'.$res_pic->picture.'" title="'.$QUERY->title.'">

												<img src="'.base_url().'btPublic/bt-uploads/thumbs/'.$res_pic->picture.'" width="150" /></a>

											</li> ';

									}

									echo '</ul>';

								}

								?>
                <div class="clearfix"></div>
              </div>
            </div>
            <div class="itemdetail">
              <h4>Property Overview</h4>
              <ul class="detailist">
                <li>Property Id: <strong>
                  <?=$QUERY->property_id?>
                  </strong></li>
                <li>Type: <strong>
                  <?=$QUERY->type?>
                  </strong></li>
                <li>Status: <strong>
                  <?=$QUERY->sub_type?>
                  </strong></li>
                <li>Bedrooms: <strong>
                  <?=$QUERY->bedrooms?>
                  </strong></li>
                <li>Kitchen: <strong>
                  <?=$QUERY->kitchen?>
                  </strong></li>
                <li>Parking: <strong>
                  <?=$QUERY->parking?>
                  </strong></li>
                <li>Bathrooms: <strong>
                  <?=$QUERY->bathrooms?>
                  </strong></li>
                <li>Area: <strong>
                  <?=$QUERY->area?>
                  </strong></li>
              </ul>
              <?=$QUERY->details?>
            </div>
        </div>
        
        <!--Ads Block-->
        
        <div class="col-md-4">
          <?php

					$picture = base_url().'btPublic/html/images/not_available.jpg';

					$get_picture = $this->general_model->single_value("property_id = '$QUERY->property_id' and cover = 'YES'", 'picture', 'tbl_property_pictures');

					if($get_picture){

						$picture = base_url().'btPublic/bt-uploads/thumbs/'.$get_picture;	

					}

					$agent_id = $QUERY->agentId;

					?>
          
          <!--Agebt info-->
          
          <div class="rignbarbox">
            <div class="hedingbar">Marketed by</div>
            <div class="boxinnr">
              <div class="agentlogo"><img src="<?=$picture?>" width="76" /></div>
              <div class="adtext">
                <?=$this->general_model->single_value("ID = '$agent_id'", 'name', 'tbl_agents')?>
                <div class="viiewoptions"><a href="<?=base_url().'agents/property/'.$QUERY->agentId?>">View Listing</a> <a href="<?=base_url().'agents/contact/'.$QUERY->agentId.'/'.$QUERY->property_id?>">Contact Agent</a></div>
              </div>
              <div class="clearfix"></div>
              <div class="agentloc">
                <?=$this->general_model->single_value("ID = '$agent_id'", 'address', 'tbl_agents')?>
              </div>
              <div class="agentset">
                <?=$this->general_model->single_value("ID = '$agent_id'", 'phone', 'tbl_agents')?>
              </div>
            </div>
          </div>
          
          <!--Useful links-->
          
          <div class="rignbarbox">
            <ul class="propertynav">
              <?php

						if($this->session->userdata('agentId')){

							echo $favourite;

						}

						else{

							echo '<li><a href="'.base_url().'login"><i class="fa fa-heart"></i> Save to favourites</a></li>';

						}

						$location = $QUERY->location.', '.$this->general_model->single_value("ID = '$QUERY->city'", "name", "tbl_cities").', '.$this->general_model->single_value("ID = '$QUERY->country'", "name", "tbl_countries");

						?>
              <li><a href="javascript();" onClick="PrintThisPage();" target="_blank"><i class="fa fa-print"></i> Print this page</a></li>
              <li><a href="<?=base_url().'friend/email/'.$QUERY->property_id?>"><i class="fa fa-envelope"></i> Email a friend</a></li>
            </ul>
          </div>
          
          <!--Google map-->
          
          <div class="gmap">
            <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?=$location?>&output=embed"></iframe>
          </div>
          
          <!--Social share--> 
          
          <!--<div class="rignbarbox">

                    	<div class="hedingbar">Share this property</div>

                        

                        <div class="boxinnr">

							<div class="socialicons">

                            <a href="#"><i class="fa fa-facebook-square"></i></a>

                            <a href="#"><i class="fa fa-twitter-square"></i></a>

                            <a href="#"><i class="fa fa-google-plus-square"></i></a>

                            </div>

                        </div>

                        

                    </div>

                    <div class="detailad"><img src="http://www.theeca.com/newsletters/pictars/eca_ads/ECA_336x280.jpg" /></div>--> 
          
        </div>
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
<link rel="stylesheet" href="<?=base_url().'btPublic/colorbox/'?>colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?=base_url().'btPublic/colorbox/'?>jquery.colorbox.js"></script>
<script>

	$(document).ready(function(){

		//Examples of how to assign the Colorbox event to elements

		$(".group1").colorbox({rel:'group1'});

		$(".ajax").colorbox();

		$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});

		$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});

		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});

		$(".inline").colorbox({inline:true, width:"50%"});

		$(".callbacks").colorbox({

			onOpen:function(){ alert('onOpen: colorbox is about to open'); },

			onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },

			onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },

			onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },

			onClosed:function(){ alert('onClosed: colorbox has completely closed'); }

		});

		//Example of preserving a JavaScript event for inline calls.

		$("#click").click(function(){ 

			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");

			return false;

		});

	});

</script>