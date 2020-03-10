<?php
$featured_propertes = $this->general_model->fetchDataAll("status = 'YES'", 'tbl_properties_list', 0, 0, 'property_id', 'desc');
if($featured_propertes){
	echo '<div class="container">
        <h3 class="sectitle">Latest Properties</h3>
        <div class="propertycount"><a href="/property/featured">View all</a></div>
				
            <ul class="row latestProperty">';
			$mcount=0;
	foreach($featured_propertes->result() as $res_featured){
		$mcount++;
		echo '<li class="col-md-3">
                    <div class="propertyinner">
                        <div class="imagewrp"><img src="'.base_url().'btPublic/bt-uploads/thumbs/'.$this->general_model->single_value("property_id = '$res_featured->property_id' and cover = 'YES'", 'picture', 'tbl_property_pictures').'"></div>
                        <div class="contentbox">
                        <h3>'.$res_featured->title.'</h3>
                        <div class="location">'.$res_featured->location.'</div>
                        
                        <div class="price"><span>'.$this->general_model->single_value("ID = '1'", 'currency', 'tbl_settings').'</span> '.$res_featured->price.'</div> <a href="'.base_url().'property/info/'.url_title($res_featured->title, 'dash', true).'-'.$res_featured->property_id.'" class="seemore">Read More</a>
                        <div class="clearfix"></div>
                        
                        
                        </div>
                        <div class="includebox">
                          <ul class="properties_history">
							  <li>
								<div class="row">
								  <div class="col-md-8 col-sm-8 col-xs-8"><i class="fa fa-wheelchair" aria-hidden="true"></i> Bathrooms</div>
								  <div class="col-md-4 col-sm-4 col-xs-4"><strong data-toggle="tooltip" data-placement="top" title="Bathrooms">'.$res_featured->bathrooms.'</strong></div>
								</div>
							  </li>
							  <li>
								<div class="row">
								  <div class="col-md-8 col-sm-8 col-xs-8"><i class="fa fa-cutlery" aria-hidden="true"></i> Kitchen</div>
								  <div class="col-sm-4 col-xs-4"><strong data-toggle="tooltip" data-placement="top" title="Kitchen">'.$res_featured->kitchen.'</strong></div>
								</div>
							  </li>
							  <li>
								<div class="row">
								  <div class="col-md-8 col-sm-8 col-xs-8"><i class="fa fa-bed" aria-hidden="true"></i> Bedrooms</div>
								  <div class="col-sm-4 col-xs-4"><strong data-toggle="tooltip" data-placement="top" title="Bedrooms">'.$res_featured->bedrooms.'</strong></div>
								</div>
							  </li>
							</ul>
                        </div>
                    </div>
                </li>';
		if($mcount==4)break;
	}
	echo '</ul>
</div>';
}
?>