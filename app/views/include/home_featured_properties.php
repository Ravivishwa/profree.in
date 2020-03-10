<?php
$featured_propertes = $this->general_model->fetchDataAll("featured = 'YES' and status = 'YES'", 'tbl_properties_list', 0, 0, 'property_id', 'RANDOM');
if($featured_propertes){
	echo '<div class="featProperty">
        <div class="titlebar">		
		<h3 class="sectitle">Featured Properties</h3>
		<div class="propertycount"><strong>Total - '.$featured_propertes->num_rows.'</strong>   |   <a href="'.base_url().'property/featured">View all</a></div>
		</div>
        
        <ul class="newprojectlist row">';
		$count = 0;
		$mcount=0;
	foreach($featured_propertes->result() as $res_featured){
		$count++;
		$mcount++;
		echo '<li class="col-md-4">
				<div class="iteminner">
					<div class="imagebox">
					<a href="'.base_url().'property/info/'.url_title($res_featured->title, 'dash', true).'-'.$res_featured->property_id.'">
						<img src="'.base_url().'btPublic/bt-uploads/thumbs/'.$this->general_model->single_value("property_id = '$res_featured->property_id' and cover = 'YES'", 'picture', 'tbl_property_pictures').'" />
					</a>
					</div>
					<h3><a href="'.base_url().'property/info/'.url_title($res_featured->title, 'dash', true).'-'.$res_featured->property_id.'">'.$res_featured->title.'</a></h3>
					<div class="location">'.$res_featured->location.'</div>
				</div>
				</li>';
		if($count == 2){
			echo '<div style="clear:both;"></div>';
			$count=0;
		}
		if($mcount==2)break;
	}
	echo '</ul>
		</div>';
}
?>            

        